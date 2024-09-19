<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Services\Interfaces\PermissionServiceInterface as PermissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\HTTP\Requests\StorePermissionRequest;
use App\HTTP\Requests\UpdatePermissionRequest;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{

    
    protected $permissionRepository;
    protected $permissionService;

    public function __construct(
        PermissionRepository  $permissionRepository,
        PermissionService $permissionService
    ) {
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
    }
    

    public function index(Request $request)
    {
        if(! Gate::allows('modules','permission.index')){
            return redirect()->route('home.error403');
        }
        $model = [
            'model' => 'Permission'
        ];
        $tem = 'backend.permission.index';
        $config = $this->config();
        $config['seo'] = __('messages.permission');
        $permissions = $this->permissionService->paginate($request);
        return view('backend.dashboard.layout', compact('permissions', 'config','model','tem'));
    }

    public function create(Request $request)
    {
        if(! Gate::allows('modules','permission.create')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.permission.store';
        $config = $this->configData();
        $config['method'] = 'create';
        $config['seo'] = __('messages.permission');
        return view('backend.dashboard.layout', compact(
            'config',
            'tem'
        ));
    }

    public function store(StorePermissionRequest $request)
    {
        if ($this->permissionService->create($request)) {
            return redirect()->route('permission.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('permission.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        if(! Gate::allows('modules','permission.update')){
            return redirect()->route('home.error403');
        }
        $permission = $this->permissionRepository->findById($id);
        $config = $this->configData();
        $tem = 'backend.permission.store';
        $config['method'] = 'edit';
        $config['seo'] = __('messages.permission');
        return view('backend.dashboard.layout', compact(
            'config',
            'permission',
            'tem'
        ));
    }

    public function update($id, UpdatePermissionRequest $request)
    {
        if ($this->permissionService->update($id, $request)) {
            return redirect()->route('permission.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('permission.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        if(! Gate::allows('modules','permission.destroy')){
            return redirect()->route('home.error403');
        }
        $permission = $this->permissionRepository->findById($id);
        $tem = 'backend.permission.delete';
        $config['seo'] = __('messages.permission');
        $config['method'] = 'delete';
        return view('backend.dashboard.layout', compact(
            'config',
            'permission',
            'tem'
        ));
    }

    public function destroy($id){
        if ($this->permissionService->destroy($id)) {
            return redirect()->route('permission.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('permission.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }


    private function config()
    {
    }
    private function configData()
    {
    }
    
}
