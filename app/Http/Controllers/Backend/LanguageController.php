<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\HTTP\Requests\StoreLanguageRequest;
use App\HTTP\Requests\UpdateLanguageRequest;


class LanguageController extends Controller
{

    
    protected $languageRepository;
    protected $languageService;

    public function __construct(
        LanguageRepository  $languageRepository,
        LanguageService $languageService
    ) {
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
    }
    

    public function index(Request $request)
    {
        $model = [
            'model' => 'Language'
        ];
        $config = $this->config();
        $config['seo'] = __('messages.language');
        $languages = $this->languageService->paginate($request);
        return view('backend.language.index', compact('languages', 'config','model'));
    }

    public function create(Request $request)
    {
        
        $config = $this->configData();
        $config['method'] = 'create';
        $config['seo'] = __('messages.language');
        return view('backend.language.store', compact(
            'config'
        ));
    }

    public function store(StoreLanguageRequest $request)
    {
        if ($this->languageService->create($request)) {
            return redirect()->route('language.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('language.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        $language = $this->languageRepository->findById($id);
        $config = $this->configData();
        $config['method'] = 'edit';
        $config['seo'] = __('messages.language');
        return view('backend.language.store', compact(
            'config',
            'language',
        ));
    }

    public function update($id, UpdateLanguageRequest $request)
    {
        if ($this->languageService->update($id, $request)) {
            return redirect()->route('language.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('language.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        $language = $this->languageRepository->findById($id);
        $config['seo'] = __('messages.language');
        $config['method'] = 'delete';
        return view('backend.language.delete', compact(
            'config',
            'language',
        ));
    }

    public function destroy($id){
        if ($this->languageService->destroy($id)) {
            return redirect()->route('language.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('language.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }


    private function config()
    {
    }
    private function configData()
    {
    }
    // đổi ngôn ngữ back end
    public function switchBackendLanguage($id){
        $language = $this->languageRepository->findById($id);
       if($this->languageService->switch($id)){
            session(["app_locale" => $language->canonical]);
            \App::setLocale($language->canonical);
       };
       return back();
        
    }
}
