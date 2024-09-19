<?php

namespace App\Services;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\PostServiceInterface;
use App\Services\Interfaces\BaseServiceInterface;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostService extends BaseService implements PostServiceInterface
{

    protected $postRepository;
    protected $routerRepository;

    public function __construct(

        PostRepository   $postRepository,
        RouterRepository $routerRepository

    ) {
        $this->postRepository = $postRepository;
        $this->routerRepository = $routerRepository;
        $this->controllerName = 'PostController';
    }
    //phân trang
    public function paginate($request,$languageId)
    {
        $perPage = $request->integer('perpage');
        $condition = [
            'keyword' => ($request->input('keyword')) ? addslashes($request->input('keyword')) : '',
            'publish' => $request->integer('publish'),
            'where' => [
                ['tb2.language_id', '=', $languageId],
            ],
        ];
        $paginationConfig = [
            'path' => 'post.index', 
            'groupBy' => $this->paginateSelect()
        ];
        $orderBy = ['posts.id', 'DESC'];
        $relations = [
            [
                'post_catalogues' => function($query) use ($languageId){
                    $query->with('languages', function($query) use ($languageId){
                        $query->where('language_id', $languageId);
                    });
                }
            ]
        ];
        $rawQuery = $this->whereRaw($request, $languageId);
        $joins = [
            ['post_language as tb2', 'tb2.post_id', '=', 'posts.id'],
            ['post_catalogue_post as tb3', 'posts.id', '=', 'tb3.post_id'],
        ];

        $posts = $this->postRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            $paginationConfig, 
            $orderBy, 
            $joins,  
            $relations,
            $rawQuery
        ); 

        return $posts;
    }
    //thêm
    public function create($request,$languageId)
    {
        DB::beginTransaction();
        try {
            $post = $this->createPost($request);
            if ($post->id > 0) {
                $this->updateLanguageForPost($post,$request,$languageId);
                $this->updateCatalogueForPost($post,$request);
                $this->createRouter($post, $request, $this->controllerName,$languageId);
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
    // cập nhật
    public function update($id, $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $post = $this->postRepository->findById($id);
            if ($this->uploadPost($post,$request)) {
                $this->updateLanguageForPost($post,$request,$languageId);
                $this->updateCatalogueForPost($post,$request);
                $this->updateRouter($post ,$request, $this->controllerName, $languageId);
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
    //xóa
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $post = $this->postRepository->delete($id); // soft delete xóa mềm
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    // cập nhật tình trạng
    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
            $language = $this->postRepository->update($post['modelId'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    // cập nhật tất cả tình trạng
    public function updateStatusAll($post)
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $flag =  $this->postRepository->updateByWhereIn('id', $post['id'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    // danh mục cha con
    private function catalogue($request){
        if($request->input('catalogue') != null){
            return array_unique(array_merge($request->input('catalogue'), [$request->post_catalogue_id]));
        }
        return [$request->post_catalogue_id];
    }
    // thêm bài viết
    private function createPost($request){
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['album'] = $this->formatAlbum($request);
        $post = $this->postRepository->create($payload);
        return $post;
    }
    // cập nhật bài viết
    private function uploadPost($post,$request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        return $this->postRepository->update($post->id, $payload);
    }
    // định dạng album
   
    // cập nhật post_language
    private function updateLanguageForPost($post,$request,$languageId){
        $payload = $request->only($this->payloadLanguage());
        $payload = $this->formatLanguagePayload($payload,$post->id,$languageId);
        $post->languages()->detach([$languageId, $post->id]);  //detach dùng để thêm bản ghi vào bảng trung gian
        return $this->postRepository->createPivot($post, $payload,'languages');
    }
    // định dạng cập nhật bài viết
    private function formatLanguagePayload($payload,$postId,$languageId){
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $languageId;
        $payload['post_id'] = $postId;
        return $payload;
    }
    // cập nhật dạnh mục cha con cho bài viết (post,post_catalogues)
    private function updateCatalogueForPost($post,$request){
        $post->post_catalogues()->sync($this->catalogue($request));
    }
    // lấy ra dữ liệu post
    private function payload()
    {
        return [
                'follow', 
                'publish', 
                'image', 
                'album',
                'post_catalogue_id'
            ];
    }
    // lấy ra dữ liệu post_language
    private function payloadLanguage()
    {
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }
    //phan trang
    private function paginateSelect()
    {
        return [
            'posts.id',
            'posts.publish',
            'posts.image',
            'posts.order',
            'tb2.name',
            'tb2.canonical',
        ];
    }

    //Tin tức ( lft = 1, rgt = 10 ) -- > id = 10

    //tin tuwcs 1 (lft = 2 rgt = 3)
    //tin tuwcs 1 ()

    //lay ra id các muc con. whereIn tb3.post_catlaogueid IN (id danh mucj con)

    //$subqueryWhere = (
    //SELECT id FROM post_catalogues WHERE Lft >= ( SELECT lft FROM post_catalogues WHERE id = 10)
    //AND Lft <= ( SELECT Lft FROM post_catalogues WHERE id = 10)
        // whereRaw: truy vấn thuần thông thường
    private function whereRaw($request,$languageId){
        $rawCondition = [];
        if($request->integer('post_catalogue_id') > 0){
            $rawCondition['whereRaw'] =  [
                [
                    'tb3.post_catalogue_id IN (
                        SELECT id
                        FROM post_catalogues
                        JOIN post_catalogue_language ON post_catalogues.id = post_catalogue_language.post_catalogue_id
                        WHERE lft >= (SELECT lft FROM post_catalogues as pc WHERE pc.id = ?)
                        AND rgt <= (SELECT rgt FROM post_catalogues as pc WHERE pc.id = ?)
                        AND post_catalogue_language.language_id = '.$languageId.'
                    )',
                    [$request->integer('post_catalogue_id'), $request->integer('post_catalogue_id')]
                ]
            ];
            
        }
        return $rawCondition;
    }
}
