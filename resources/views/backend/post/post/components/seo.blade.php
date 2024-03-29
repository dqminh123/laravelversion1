<div class="ibox">
    <div class="ibox-title">
        <h5>Cấu Hình SEO</h5>
    </div>
    <div class="ibox-content">
        <div class="seo-container">
            <div class="meta-title">
                {{ old('meta_title', $post->meta_title ?? '') ? 
                old('meta_title', $post->meta_title ?? '')
                : 'Bạn chưa có tiều đề SEO' }}
            </div>
            <div class="canonical">
                {{ old('canonical', $post->canonical ?? '')
                    ? config('app.url') . old('canonical', $post->canonical ?? '') . config('apps.general.suffix')
                    : 'http://duong-dan-cua-ban.html' }}
            </div>
            <div class="meta_description">
                {{ old('meta_description', $post->meta_description ?? '')? 
                old('meta_description', $post->meta_description ?? '') 
                : 'Bạn chưa có mô tả SEO' }}
            </div>
            <div class="meta_keyword">
                {{ old('meta_keyword', $post->meta_keyword ?? '')? 
                old('meta_keyword', $post->meta_keyword ?? '') : 'Bạn chưa có từ khóa SEO' }}</div>
        </div>
        <div class="seo-wrapper">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span>Mô Tả SEO</span>
                                <span class="count_meta-title">0 ký tự</span>
                            </div>
                        </label>
                        <input type="text" name="meta_title"
                            value="{{ old('meta_title', $post->meta_title ?? '') }}" class="form-control"
                            placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <span>Từ khóa SEO</span>
                        </label>
                        <input type="text" name="meta_keyword"
                            value="{{ old('meta_keyword', $post->meta_keyword ?? '') }}" class="form-control"
                            placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span>Mô Tả SEO</span>
                                <span class="count_meta-description">0 ký tự</span>
                            </div>
                        </label>
                        <textarea type="text" name="meta_description" class="form-control" placeholder="" autocomplete="off">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <span>Đường dẫn <span class="text-danger">(*)</span></span>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" name="canonical"
                                value="{{ old('canonical', $post->canonical ?? '') }}" class="form-control"
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
