<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\HTTP\Requests\StorePostCatalogueRequest;
use App\HTTP\Requests\UpdatePostCatalogueRequest;
use App\HTTP\Requests\DeletePostCatalogueRequest;
use App\Classes\Nestedsetbie;



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
            'model' => 'PostCatalogue'
        ];
        $config = $this->config();
        $config['seo'] = __('messages.postCatalogue');
        $postCatalogues = $this->postCatalogueService->paginate($request);
        return view('backend.post.catalogue.index', compact('postCatalogues', 'config','model'));
    }

    public function create(Request $request)
    {
        $config['method'] = 'create';
        $config['seo'] = __('messages.postCatalogue');
        $dropdown = $this->nestedset->Dropdown();
        return view('backend.post.catalogue.store', compact(
            'config',
            'dropdown',
           
        ));
    }

    public function store(StorePostCatalogueRequest $request)
    {
        if ($this->postCatalogueService->create($request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById(
            $id,
            $this->language
        );
        $dropdown = $this->nestedset->Dropdown();
         $album = json_decode($postCatalogue->album);
        $config['method'] = 'edit';
        $config['seo'] = __('messages.postCatalogue');
        return view('backend.post.catalogue.store', compact(
            'config',
            'postCatalogue',
            'dropdown',
            'album'
        ));
    }

    public function update($id, UpdatePostCatalogueRequest $request)
    {
        if ($this->postCatalogueService->update($id, $request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById(
            $id,
            $this->language
        );
        $config['seo'] = __('messages.postCatalogue');
        $config['method'] = 'delete';
        return view('backend.post.catalogue.delete', compact(
            'config',
            'postCatalogue',
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
