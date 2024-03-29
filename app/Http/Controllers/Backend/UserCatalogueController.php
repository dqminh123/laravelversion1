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
        $model = [
            'model' => 'UserCatalogue'
        ];
        $config = $this->config();
        $config['seo'] = __('messages.userCatalogue');
        $userCatalogues = $this->userCatalogueService->paginate($request);
        return view('backend.user.catalogue.index', compact('userCatalogues', 'config','model'));
    }

    public function create(Request $request)
    {
       
        $config['method'] = 'create';
        $config['seo'] = __('messages.userCatalogue');
        return view('backend.user.catalogue.store', compact(
            'config'
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
        $config['seo'] = __('messages.userCatalogue');
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
        $config['seo'] = __('messages.userCatalogue');
        $config['method'] = 'delete';
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

    public function permission(){
        $userCatalogues = $this->userCatalogueRepository->all(['permissions']);
        $permissions = $this->permissionRepository->all();
        $config['seo'] = __('messages.userCatalogue');
        $config['method'] = 'permission';
        return view('backend.user.catalogue.permission', compact(
            'config',
            'permissions',
            'userCatalogues',
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
