<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Services\Interfaces\PermissionServiceInterface as PermissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\HTTP\Requests\StorePermissionRequest;
use App\HTTP\Requests\UpdatePermissionRequest;


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
        $model = [
            'model' => 'Permission'
        ];
        $config = $this->config();
        $config['seo'] = __('messages.permission');
        $permissions = $this->permissionService->paginate($request);
        return view('backend.permission.index', compact('permissions', 'config','model'));
    }

    public function create(Request $request)
    {
        
        $config = $this->configData();
        $config['method'] = 'create';
        $config['seo'] = __('messages.permission');
        return view('backend.permission.store', compact(
            'config'
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
        $permission = $this->permissionRepository->findById($id);
        $config = $this->configData();
        $config['method'] = 'edit';
        $config['seo'] = __('messages.permission');
        return view('backend.permission.store', compact(
            'config',
            'permission',
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
        $permission = $this->permissionRepository->findById($id);
        $config['seo'] = __('messages.permission');
        $config['method'] = 'delete';
        return view('backend.permission.delete', compact(
            'config',
            'permission',
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
