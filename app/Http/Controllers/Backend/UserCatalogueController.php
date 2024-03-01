<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserCatalogue;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\HTTP\Requests\StoreUserRequest;
use App\HTTP\Requests\StoreUserCatalogueRequest;
use App\HTTP\Requests\UpdateUserRequest;


class UserCatalogueController extends Controller
{

    
    protected $userCatalogueRepository;
    protected $userCatalogueService;

    public function __construct(
        UserCatalogueRepository  $userCatalogueRepository,
        UserCatalogueService $userCatalogueService
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function index()
    {
        $config = $this->config();
        $config['seo'] = config('apps.usercatalogue');
        $userCatalogues = UserCatalogue::all()->sortByDesc('created_at');
        return view('backend.user.catalogue.index', compact('userCatalogues', 'config'));
    }

    public function create(Request $request)
    {

        $config['method'] = 'create';
        $config['seo'] = config('apps.usercatalogue');
        return view('backend.user.catalogue.store', compact(
            'config',
        ));
    }

    public function store(StoreUserCatalogueRequest $request)
    {
        if ($this->userCatalogueService->create($request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $config['method'] = 'edit';
        $config['seo'] = config('apps.usercatalogue');
        return view('backend.user.catalogue.store', compact(
            'config',
            'userCatalogue',
        ));
    }

    public function update($id, StoreUserCatalogueRequest $request)
    {
        if ($this->userCatalogueService->update($id, $request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $config['seo'] = config('apps.usercatalogue');
        return view('backend.user.catalogue.delete', compact(
            'config',
            'userCatalogue',
        ));
    }

    public function destroy($id){
        if ($this->userCatalogueService->destroy($id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }


    private function config()
    {
    }
}