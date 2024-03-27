<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\HTTP\Requests\StoreUserRequest;
use App\HTTP\Requests\UpdateUserRequest;


class UserController extends Controller
{

    protected $provinceRepository;
    protected $userRepository;
    protected $userService;

    public function __construct(
        ProvinceRepository $provinceRepository,
        UserRepository  $userRepository,
        UserService $userService
    ) {
        $this->provinceRepository = $provinceRepository;
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $model = [
            'model' => 'User'
        ];
        $config = $this->configData();
        $config['seo'] = __('messages.user');
        $users = $this->userService->paginate($request);
        return view('backend.user.user.index', compact('users', 'config','model'));
    }

    public function create(Request $request)
    {

        $provinces = $this->provinceRepository->all();
        $config = $this->configData();
        $config['method'] = 'create';
        $config['seo'] = __('messages.user');
        return view('backend.user.user.store', compact(
            'config',
            'provinces',
            
        ));
    }

    public function store(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        $config = $this->configData();
        $provinces = $this->provinceRepository->all();
        $config['method'] = 'edit';
        $config['seo'] = __('messages.user');
        return view('backend.user.user.store', compact(
            'config',
            'provinces',
            'user',
        ));
    }

    public function update($id, UpdateUserRequest $request)
    {
        if ($this->userService->update($id, $request)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        $user = $this->userRepository->findById($id);
        $config['seo'] = __('messages.user');
        $config['method'] = 'delete';
        return view('backend.user.user.delete', compact(
            'config',
            'user',
        ));
    }

    public function destroy($id){
        if ($this->userService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }


    private function config()
    {
    }
    private function configData()
    {
    }
}
