<?php

namespace App\Services;

use App\Models\PostCatalogue;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\Interfaces\BaseServiceInterface;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Str;

class PostCatalogueService extends BaseService implements PostCatalogueServiceInterface
{

    protected $postCatalogueRepository;
    protected $routerRepository;
    protected $nestedset;
    protected $language;
    protected $controllerName =  'PostCataloguesController';

    public function __construct(

        PostCatalogueRepository   $postCatalogueRepository,
        RouterRepository $routerRepository
    ) {
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage()
        ]);
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->routerRepository = $routerRepository;
        $this->language = $this->currentLanguage();
    }

    public function paginate($request)
    {
        $perPage = $request->integer('perpage');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['tb2.language_id', '=', $this->language]
            ]
        ];
        // tham số thứ 1 là cái mảng select
        // tham số thứ 2 là cái mảng điều kiện $conditon
        // tham số thứ 3 là số trang (dữ iệu kiểu int)
        // tham số thứ 4 là mảng
        $postCatalogues = $this->postCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            [
                'post_catalogues.lft', 'ASC',
            ],
            [
                'path' => 'post.catalogue.index',
            ],
            [
                ['post_catalogue_language as tb2', 'tb2.post_catalogue_id', '=', 'post_catalogues.id']
            ],
            
        );
        return $postCatalogues;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $postCatalogue = $this->createCatalogue($request);
            if($postCatalogue->id > 0){
                $this->updateLanguageForCatalogue($postCatalogue, $request);
                $this->createRouter($postCatalogue, $request, $this->controllerName);
                $this->nestedset();
            }
            // $this->nestedset->Get('level ASC', 'order ASC'); // Lay du lieu
            // $this->nestedset->Recursive(0, $this->nestedset->Set()); // tinh toan lai lft rgt tung node
            // $this->nestedset->Action(); // goi action cap nhat gia tri lft rgt

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $postCatalogue = $this->postCatalogueRepository->findById($id);
            $flag = $this->updateCatalogue($postCatalogue, $request);
            
            if ($flag == TRUE){
                $this->updateLanguageForCatalogue($postCatalogue,$request);
                $this->updateRouter($postCatalogue ,$request, $this->controllerName);
                $this->nestedset();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $postCatalogue = $this->postCatalogueRepository->delete($id);
            $this->nestedset->Get('level ASC', 'order ASC'); // Lay du lieu
            $this->nestedset->Recursive(0, $this->nestedset->Set()); // tinh toan lai lft rgt tung node
            $this->nestedset->Action(); // goi action cap nhat gia tri lft rgt

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
            $language = $this->postCatalogueRepository->update($post['modelId'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($post)
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $flag =  $this->postCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function payload()
    {
        return [
                'parent_id', 
                'follow', 
                'publish', 
                'image', 
                'album'
            ];
    }
    private function payloadLanguage()
    {
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }
    private function paginateSelect()
    {
        return [
            'post_catalogues.id',
            'post_catalogues.publish',
            'post_catalogues.image',
            'post_catalogues.album',
            'post_catalogues.level',
            'post_catalogues.order',
            'tb2.name',
            'tb2.canonical',
        ];
    }

    private function createCatalogue($request){
        $payload = $request->only($this->payload());
        dd($payload);
        $payload['album'] = $this->formatAlbum($request);
        $payload['user_id'] = Auth::id();
        $postCatalogue = $this->postCatalogueRepository->create($payload);
        return $postCatalogue;
    }
    private function updateCatalogue($postCatalogue, $request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $flag = $this->postCatalogueRepository->update($postCatalogue->id, $payload);
        return $flag;
    }
    private function updateLanguageForCatalogue($postCatalogue, $request){
        $payload = $this->formatLanguagePayload($postCatalogue, $request);
        $postCatalogue->languages()->detach([$this->language, $postCatalogue->id]);
        $language = $this->postCatalogueRepository->createPivot($postCatalogue, $payload, 'languages');
        return $language;
    }

    private function formatLanguagePayload($postCatalogue, $request){
        $payload = $request->only($this->payloadLanguage());
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] =  $this->language;
        $payload['post_catalogue_id'] = $postCatalogue->id;
        return $payload;
    }
}
