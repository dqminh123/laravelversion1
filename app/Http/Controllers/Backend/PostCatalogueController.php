<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\HTTP\Requests\StorePostCatalogueRequest;
use App\HTTP\Requests\UpdatePostCatalogueRequest;



class PostCatalogueController extends Controller
{

    
    protected $postCatalogueRepository;
    protected $postCatalogueService;

    public function __construct(
        PostCatalogueRepository  $postCatalogueRepository,
        PostCatalogueService $postCatalogueService
    ) {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function index()
    {
        $config = $this->config();
        $config['seo'] = config('apps.postcatalogue');
        $postCatalogues = PostCatalogue::all()->sortByDesc('created_at');
        return view('backend.post.catalogue.index', compact('postCatalogues', 'config'));
    }

    public function create(Request $request)
    {

        $config['method'] = 'create';
        $config['seo'] = config('apps.postcatalogue');
        return view('backend.post.catalogue.store', compact(
            'config',
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
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.postcatalogue');
        return view('backend.post.catalogue.store', compact(
            'config',
            'postCatalogue',
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
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        $config['seo'] = config('apps.postcatalogue');
        return view('backend.post.catalogue.delete', compact(
            'config',
            'postCatalogue',
        ));
    }

    public function destroy($id){
        if ($this->postCatalogueService->destroy($id)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }


    private function config()
    {
    }
}
