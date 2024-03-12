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

    public function index()
    {
        $config = $this->config();
        $config['seo'] = config('apps.language');
        $languages = Language::all()->sortByDesc('created_at');
        return view('backend.language.index', compact('languages', 'config'));
    }

    public function create(Request $request)
    {
        $config = $this->configData();
        $config['method'] = 'create';
        $config['seo'] = config('apps.language');
        return view('backend.language.store', compact(
            'config',
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
        $config['seo'] = config('apps.language');
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
        $config['seo'] = config('apps.language');
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
}
