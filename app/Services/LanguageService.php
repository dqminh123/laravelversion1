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

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', ]);
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
            $payload[$post['field']] = (($post['value'] == 1) ? 0 : 1);
               
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
               
            $flag=  $this->languageRepository->updateByWhereIn('id',$post['id'],$payload);
           
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    // private function changeUserStatus($post, array $array = []){
        
    //     DB::beginTransaction();
    //     try {
    //         if(isset($post['modelId'])){
    //             $arrayp[] = $post['modelId'];
    //         }else{
    //             $array = $post['id'];
    //         }
    //         $payload[$post['field']] = $post['value'];
    //        $this->languageRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
            
    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         echo $e->getMessage();
    //         die();
    //         return false;
    //     }
    // }

    
}
