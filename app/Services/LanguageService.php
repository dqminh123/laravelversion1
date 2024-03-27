<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LanguageService implements LanguageServiceInterface
{

    protected $languageRepository;

    public function __construct(

        LanguageRepository   $languageRepository
    ) {

        $this->languageRepository = $languageRepository;
    }

    public function paginate($request){

        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $languages = $this->languageRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['id','DESC'],
            ['path' => 'language/index'], 
        );
        return $languages;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send',]);
            $payload['user_id'] = Auth::id();
            $language = $this->languageRepository->create($payload);
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
            $payload = $request->except(['_token', 'send']);
            $language = $this->languageRepository->update($id, $payload);
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
            $language = $this->languageRepository->delete($id);
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
            $language = $this->languageRepository->update($post['modelId'], $payload);
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
            $flag =  $this->languageRepository->updateByWhereIn('id', $post['id'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function switch($id){
        DB::beginTransaction();
        try {
           $language = $this->languageRepository->update($id, ['current' => 1]);
            $payload = ['current' =>0];
            $where = [
                ['id', '!=', $id], 
            ];
            $this->languageRepository->updateByWhere( $where ,$payload );
               
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
       
    }

    private function paginateSelect(){
        return [
            'id', 
            'name', 
            'canonical',
            'publish',
            'image',
            'description'
        ];
    }


}
