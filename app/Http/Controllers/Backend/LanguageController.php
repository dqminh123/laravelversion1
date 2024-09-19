<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\HTTP\Requests\StoreLanguageRequest;
use App\HTTP\Requests\UpdateLanguageRequest;
use App\Http\Requests\StoreTranslateRequest;
use Illuminate\Support\Facades\Gate;

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
        if(! Gate::allows('modules','language.index')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.language.index';
        $model = [
            'model' => 'Language'
        ];
        $config = $this->config();
        $config['seo'] = __('messages.language');
        $languages = $this->languageService->paginate($request);
        return view('backend.dashboard.layout', compact('languages', 'config','model', 'tem'));
    }

    public function create(Request $request)
    {
        if(! Gate::allows('modules','language.create')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.language.store';
        $config = $this->configData();
        $config['method'] = 'create';
        $config['seo'] = __('messages.language');
        return view('backend.dashboard.layout', compact(
            'config',
            'tem'
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
        if(! Gate::allows('modules','language.update')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.language.store';
        $language = $this->languageRepository->findById($id);
        $config = $this->configData();
        $config['method'] = 'edit';
        $config['seo'] = __('messages.language');
        return view('backend.dashboard.layout', compact(
            'config',
            'language',
            'tem'
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
        if(! Gate::allows('modules','language.destroy')){
            return redirect()->route('home.error403');
        }
        $tem = 'backend.language.delete';
        $language = $this->languageRepository->findById($id);
        $config['seo'] = __('messages.language');
        $config['method'] = 'delete';
        return view('backend.dashboard.layout', compact(
            'config',
            'language',
            'tem'
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
        $languages = $this->languageRepository->findById($id);
       if($this->languageService->switch($id)){
            session(["app_locale" => $languages->canonical]);
            \App::setLocale($languages->canonical);
       };
       return back();
        
    }
    // dịch ngôn ngữ
    public function translate($id = 0 , $languageId = 0, $model = ''){
        $repositoryInstance = $this->repositoryInstance($model); // lấy model repository
        $languageInstance = $this->repositoryInstance('Language'); // lấy language hiện tại
        $currentLanguage = $languageInstance->findByCondition([
            ['canonical', '=', session('app_locale')] // điều kiện 
        ]);
        $method = 'get'.$model.'ById';

        $object = $repositoryInstance->{$method}($id, $currentLanguage->id);
        $objectTranslate = $repositoryInstance->{$method}($id, $languageId);
        

        if(! Gate::allows('modules','language.translate')){
            return redirect()->route('home.error403');
        }
        $option = [
            'id' => $id,
            'languageId' => $languageId,
            'model'=> $model
        ];
        $tem = 'backend.language.translate';
        $config['seo'] = __('messages.language');
        return view('backend.dashboard.layout', compact(
            'config',
            'tem',
            'object',
            'objectTranslate',
            'option'
        ));
    }
    //them ngon ngu da dich
    public function storeTranslate(StoreTranslateRequest $request){
        $option = $request->input('option');
        if ($this->languageService->saveTranslate($option,$request)) {
            return redirect()->back()->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->back()->with('error', 'Có vấn đề xảy ra, Hãy thử lại');
    }
    // lấy ra các App\Repositories\ModelNameRepository nào đó
    private function repositoryInstance($model){
        $repositoryNamespace = '\App\Repositories\\' . ucfirst($model) . 'Repository';
        if (class_exists($repositoryNamespace)) {
            $repositoryInstance = app($repositoryNamespace);
        }

        return $repositoryInstance ?? null;
    }
}
