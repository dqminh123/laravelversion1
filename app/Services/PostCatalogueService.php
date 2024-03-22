<?php

namespace App\Services;

use App\Models\PostCatalogue;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\Interfaces\BaseServiceInterface;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Str;

class PostCatalogueService extends BaseService implements PostCatalogueServiceInterface
{

    protected $postCatalogueRepository;
    protected $nestedset;
    protected $language;

    public function __construct(

        PostCatalogueRepository   $postCatalogueRepository,

    ) {
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage()
        ]);
        $this->postCatalogueRepository = $postCatalogueRepository;
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
            $payload = $request->only($this->payload());
            $payload['user_id'] = Auth::id();
            $payload['album'] = json_encode($payload['album']);
            $postCatalogue = $this->postCatalogueRepository->create($payload);
            if ($postCatalogue->id > 0) {
                $payloadLanguage = $request->only($this->payloadLanguage());
                $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $postCatalogue->id;
                $language = $this->postCatalogueRepository->createPivot($postCatalogue, $payloadLanguage, 'languages');
            }
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

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $postCatalogue = $this->postCatalogueRepository->findById($id);
            $payload = $request->only($this->payload());
            $payload['album'] = json_encode($payload['album']);
            $flag = $this->postCatalogueRepository->update($id, $payload);
            if ($flag == TRUE) {
                $payloadLanguage = $request->only($this->payloadLanguage());
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $id;
                $postCatalogue->languages()->detach([$payloadLanguage['language_id'], $id]);  //detach dùng để thêm bản ghi vào bảng trung gian
                $response = $this->postCatalogueRepository->createPivot($postCatalogue, $payloadLanguage,'languages');
            }
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
}
