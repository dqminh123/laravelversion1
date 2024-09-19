<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\HTTP\Requests\StorePostRequest;
use App\HTTP\Requests\UpdatePostRequest;
use App\HTTP\Requests\DeletePostRequest;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Facades\Gate;



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
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            $this->initialize();
            return $next($request);
        });
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->initialize();
    }
    // initialize lay danh muc cha con
    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 

    public function index(Request $request)
    {   
        if(! Gate::allows('modules','post.index')){
            return redirect()->route('home.error403');
        }
        $model = [
            'model' => 'Post'
        ];
        $tem = 'backend.post.post.index';
        $config = $this->config();
        $config['seo'] = config('apps.post');
        $dropdown = $this->nestedset->Dropdown();
        $posts = $this->postService->paginate($request,$this->language);
       
        
        return view('backend.dashboard.layout', compact('posts', 'config','model','dropdown','tem'));
    }

    public function create(Request $request)
    {
        if(! Gate::allows('modules','post.create')){
            return redirect()->route('home.error403');
        }
        $config['method'] = 'create';
        $config['seo'] = config('apps.post');
        $tem = 'backend.post.post.store';
        $dropdown = $this->nestedset->Dropdown();
        return view('backend.dashboard.layout', compact(
            'config',
            'dropdown',
            'tem'
        ));
    }

    public function store(StorePostRequest $request)
    {
        if ($this->postService->create($request,$this->language)) {
            return redirect()->route('post.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        if(! Gate::allows('modules','post.update')){
            return redirect()->route('home.error403');
        }
        $post = $this->postRepository->getPostById(
            $id,
            $this->language
        );
        $dropdown = $this->nestedset->Dropdown();
        $tem = 'backend.post.post.store';
        $album = json_decode($post->album);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.post');
        return view('backend.dashboard.layout', compact(
            'config',
            'post',
            'dropdown',
            'album',
            'tem'
        ));
    }

    public function update($id, UpdatePostRequest $request)
    {
        if ($this->postService->update($id, $request,$this->language)) {
            return redirect()->route('post.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        if(! Gate::allows('modules','post.destroy')){
            return redirect()->route('home.error403');
        }
        $post = $this->postRepository->getPostById(
            $id,
            $this->language
        );
        $config['seo'] = config('apps.post');
        $tem = 'backend.post.post.delete';
        $config['method'] = 'delete';
        return view('backend.dashboard.layout', compact(
            'config',
            'post',
            'tem'
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
