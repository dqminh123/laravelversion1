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

    public function paginate($request)
    {

        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $languages = $this->languageRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'language/index'],
            ['id', 'DESC'],
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

    public function switch($id)
    {
        DB::beginTransaction();
        try {
            $language = $this->languageRepository->update($id, ['current' => 1]);
            $payload = ['current' => 0];
            $where = [
                ['id', '!=', $id],
            ];
            $this->languageRepository->updateByWhere($where, $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function saveTranslate($option, $request)
    {
        DB::beginTransaction();
        try {
            $payload = [
                'name' => $request->input('translate_name'),
                'description' => $request->input('translate_description'),
                'content' => $request->input('translate_content'),
                'meta_title' => $request->input('translate_meta_title'),
                'meta_keyword' => $request->input('translate_meta_keyword'),
                'meta_description' => $request->input('translate_meta_description'),
                'canonical' => $request->input('translate_canonical'),
                $this->converModelToField($option['model']) => $option['id'],
                    'language_id' => $option['languageId'],
            ];

            $repositoryNamespace = '\App\Repositories\\' . ucfirst($option['model']) . 'Repository';
            if (class_exists($repositoryNamespace)) {
                $repositoryInstance = app($repositoryNamespace);
            }
            //tim id cua model 
            $model = $repositoryInstance->findById($option['id']);
            //detach du lieu trc khi them moi
            $model->languages()->detach([$option['languageId'], $model->id]);
            $repositoryInstance->createPivot($model, $payload, 'languages');
    

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    // chuyển model thành viết thường
    private function converModelToField($model)
    {
        $temp = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $model));
        return $temp . '_id';
    }

    private function paginateSelect()
    {
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
