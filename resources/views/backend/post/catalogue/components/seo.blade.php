<div class="ibox">
    <div class="ibox-title">
        <h5>{{__('messages.seo')}}</h5>
    </div>
    <div class="ibox-content">
        <div class="seo-container">
            <div class="meta-title">
                {{ old('meta_title', $postCatalogue->meta_title ?? '') ? 
                old('meta_title', $postCatalogue->meta_title ?? '')
                : __('messages.seo_title') }}
            </div>
            <div class="canonical">
                {{ old('canonical', $postCatalogue->canonical ?? '')
                    ? config('app.url') . old('canonical', $postCatalogue->canonical ?? '') . config('apps.general.suffix')
                    : __('messages.seo_canonical') }}
            </div>
            <div class="meta_description">
                {{ old('meta_description', $postCatalogue->meta_description ?? '')? 
                old('meta_description', $postCatalogue->meta_description ?? '') 
                : __('messages.seo_description') }}
            </div>
            <div class="meta_keyword">
                {{ old('meta_keyword', $postCatalogue->meta_keyword ?? '')? 
                old('meta_keyword', $postCatalogue->meta_keyword ?? '') : __('messages.seo_keyword') }}</div>
        </div>
        <div class="seo-wrapper">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span class="tl">{{__('messages.seo_meta_title')}}</span>
                                <span class="count_meta-title text-left">0 {{__('messages.character')}}</span>
                            </div>
                        </label>
                        <input type="text" name="meta_title"
                            value="{{ old('meta_title', $postCatalogue->meta_title ?? '') }}" class="form-control"
                            placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <span>{{__('messages.seo_meta_keyword')}}</span>
                        </label>
                        <input type="text" name="meta_keyword"
                            value="{{ old('meta_keyword', $postCatalogue->meta_keyword ?? '') }}" class="form-control"
                            placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span class="tl">{{__('messages.seo_meta_title')}}</span>
                                <span class="count_meta-title text-left">0 {{__('messages.character')}}</span>
                            </div>
                        </label>
                        <textarea type="text" name="meta_description" class="form-control" placeholder="" autocomplete="off">{{ old('meta_description', $postCatalogue->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <span>{{__('messages.seo_meta_canonical')}} <span class="text-danger">(*)</span></span>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" name="canonical"
                                value="{{ old('canonical', $postCatalogue->canonical ?? '') }}" class="form-control"
                                placeholder="" autocomplete="off">
                            @if ($errors->has('canonical'))
                                <span class="error-message" style="color: red">*
                                    {{ $errors->first('canonical') }}</span>
                            @endif
                            <span class="baseUrl">{{ config('app.url') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
