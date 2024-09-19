<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCatalogue;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\HTTP\Requests\StorePostCatalogueRequest;
use App\HTTP\Requests\UpdatePostCatalogueRequest;
use App\HTTP\Requests\DeletePostCatalogueRequest;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Facades\Gate;


class PostCatalogueController extends Controller
{


    protected $postCatalogueRepository;
    protected $postCatalogueService;
    protected $nestedset;
    protected $language;

    public function __construct(
        PostCatalogueRepository  $postCatalogueRepository,
        PostCatalogueService $postCatalogueService
    ) {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;

        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            $this->initialize();
            return $next($request);
        });
        
    }
    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 

    public function index(Request $request)
    {
        
        if(! Gate::allows('modules','post.catalogue.index')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.post.catalogue.index';
        $model = [
            'model' => 'PostCatalogue'
        ];
        $config = $this->config();
        $config['seo'] = __('messages.postCatalogue');
        $postCatalogues = $this->postCatalogueService->paginate($request,$this->language);
        return view('backend.dashboard.layout', compact('postCatalogues', 'config','model','tem'));
    }

    public function create(Request $request)
    {
        if(! Gate::allows('modules','post.catalogue.create')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.post.catalogue.store';
        $config['method'] = 'create';
        $config['seo'] = __('messages.postCatalogue');
        $dropdown = $this->nestedset->Dropdown();
        return view('backend.dashboard.layout', compact(
            'config',
            'dropdown',
            'tem'
           
        ));
    }

    public function store(StorePostCatalogueRequest $request)
    {
        if ($this->postCatalogueService->create($request, $this->language)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        if(! Gate::allows('modules','post.catalogue.update')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.post.catalogue.store';
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById(
            $id,
            $this->language
        );
        $dropdown = $this->nestedset->Dropdown();
         $album = json_decode($postCatalogue->album);
        $config['method'] = 'edit';
        $config['seo'] = __('messages.postCatalogue');
        return view('backend.dashboard.layout', compact(
            'config',
            'postCatalogue',
            'dropdown',
            'album',
            'tem'
        ));
    }

    public function update($id, UpdatePostCatalogueRequest $request)
    {
        if ($this->postCatalogueService->update($id, $request, $this->language)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        if(! Gate::allows('modules','post.catalogue.destroy')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.post.catalogue.delete';
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById(
            $id,
            $this->language
        );
        $config['seo'] = __('messages.postCatalogue');
        $config['method'] = 'delete';
        return view('backend.dashboard.layout', compact(
            'config',
            'postCatalogue',
            'tem'
        ));
    }

    public function destroy($id, DeletePostCatalogueRequest $request)
    {
        
        if ($this->postCatalogueService->destroy($id)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }


    private function config()
    {
    }
}
