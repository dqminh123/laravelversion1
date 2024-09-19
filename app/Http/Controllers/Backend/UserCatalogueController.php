<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserCatalogue;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\HTTP\Requests\StoreUserRequest;
use App\HTTP\Requests\StoreUserCatalogueRequest;
use App\HTTP\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Gate;

class UserCatalogueController extends Controller
{

    protected $permissionRepository;
    protected $userCatalogueRepository;
    protected $userCatalogueService;

    public function __construct(
        UserCatalogueRepository  $userCatalogueRepository,
        UserCatalogueService $userCatalogueService,

        PermissionRepository $permissionRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        if(! Gate::allows('modules','user.catalogue.index')){
            return redirect()->route('home.error403');
        }
        $model = [
            'model' => 'UserCatalogue'
        ];
        $tem = 'backend.user.catalogue.index';
        $config = $this->config();
        $config['seo'] = __('messages.userCatalogue');
        $userCatalogues = $this->userCatalogueService->paginate($request);
        return view('backend.dashboard.layout', compact('userCatalogues', 'config','model','tem'));
    }

    public function create(Request $request)
    {
        if(! Gate::allows('modules','user.catalogue.create')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.user.catalogue.store';
        $config['method'] = 'create';
        $config['seo'] = __('messages.userCatalogue');
        return view('backend.dashboard.layout', compact(
            'config',
            'tem'
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
        if(! Gate::allows('modules','user.catalogue.update')){
            return redirect()->route('home.error403');
        }
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $tem = 'backend.user.catalogue.store';
        $config['method'] = 'edit';
        $config['seo'] = __('messages.userCatalogue');
        return view('backend.dashboard.layout', compact(
            'config',
            'userCatalogue',
            'tem'
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
        if(! Gate::allows('modules','user.catalogue.destroy')){
            return redirect()->route('home.error403');
        }
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $tem = 'backend.user.catalogue.delete';
        $config['seo'] = __('messages.userCatalogue');
        $config['method'] = 'delete';
        return view('backend.dashboard.layout', compact(
            'config',
            'userCatalogue',
            'tem'
        ));
    }

    public function destroy($id){
        if ($this->userCatalogueService->destroy($id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }

    public function permission(){
        $userCatalogues = $this->userCatalogueRepository->all(['permissions']);
        $tem = 'backend.user.catalogue.permission';
        $permissions = $this->permissionRepository->all();
        $config['seo'] = __('messages.userCatalogue');
        $config['method'] = 'permission';
        return view('backend.dashboard.layout', compact(
            'config',
            'permissions',
            'userCatalogues',
            'tem'
        ));
    }

    public function updatePermission(Request $request){
       if($this->userCatalogueService->setPermission($request)){
        return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật quyền thành công');
       }
       return redirect()->route('user.catalogue.index')->with('error', 'Có vấn đề xảy ra. Hãy thử lại');
    }

    private function config()
    {
    }
}
