<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserCatalogueService implements UserCatalogueServiceInterface
{

    protected $userCatalogueRepository;
    protected $userRepository;

    public function __construct(
        UserCatalogueRepository $userCatalogueRepository,
        UserRepository   $userRepository
    ) {
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->userRepository = $userRepository;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', ]);
           
            $user = $this->userCatalogueRepository->create($payload);
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
          

            $user = $this->userCatalogueRepository->update($id, $payload);
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
            $user = $this->userCatalogueRepository->delete($id);


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
               
            $user = $this->userCatalogueRepository->update($post['modelId'], $payload);
            $this->changeUserStatus($post);
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
               
            $flag=  $this->userCatalogueRepository->updateByWhereIn('id',$post['id'],$payload);
            $this->changeUserStatus($post);
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function changeUserStatus($post, array $array = []){
        
        DB::beginTransaction();
        try {
            if(isset($post['modelId'])){
                $arrayp[] = $post['modelId'];
            }else{
                $array = $post['id'];
            }
            $payload[$post['field']] = $post['value'];
           $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function ConvertBirthdayDate($birthday = '')
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }
}
