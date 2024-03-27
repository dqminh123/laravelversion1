<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\HTTP\Requests\StorePostRequest;
use App\HTTP\Requests\UpdatePostRequest;
use App\HTTP\Requests\DeletePostRequest;
use App\Classes\Nestedsetbie;



class PostController extends Controller
{


    protected $postRepository;
    protected $languageRepository;
    protected $postService;
    protected $nestedset;
    protected $language;

    public function __construct(
        PostRepository  $postRepository,
        PostService $postService,
    ) {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => 2
        ]);
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        $model = [
            'model' => 'Post'
        ];
        $config = $this->config();
        $config['seo'] = config('apps.post');
        $dropdown = $this->nestedset->Dropdown();
        $posts = $this->postService->paginate($request);
       
        
        return view('backend.post.post.index', compact('posts', 'config','model','dropdown'));
    }

    public function create(Request $request)
    {
        $config['method'] = 'create';
        $config['seo'] = config('apps.post');
        $dropdown = $this->nestedset->Dropdown();
        return view('backend.post.post.store', compact(
            'config',
            'dropdown',
           
        ));
    }

    public function store(StorePostRequest $request)
    {
        if ($this->postService->create($request)) {
            return redirect()->route('post.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        $post = $this->postRepository->getPostById(
            $id,
            $this->language
        );
        $dropdown = $this->nestedset->Dropdown();
        $album = json_decode($post->album);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.post');
        return view('backend.post.post.store', compact(
            'config',
            'post',
            'dropdown',
            'album'
        ));
    }

    public function update($id, UpdatePostRequest $request)
    {
        if ($this->postService->update($id, $request)) {
            return redirect()->route('post.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        $post = $this->postRepository->getPostById(
            $id,
            $this->language
        );
        $config['seo'] = config('apps.post');
        $config['method'] = 'delete';
        return view('backend.post.post.delete', compact(
            'config',
            'post',
        ));
    }

    public function destroy($id)
    {
        if ($this->postService->destroy($id)) {
            return redirect()->route('post.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }


    private function config()
    {
    }
   
}
