<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">{{ __('messages.title') }}<span
                    class="text-danger">(*)</span></label>
            <input type="text" name="translate_name" value="{{ old('translate_name', $model->name ?? '') }}"
                class="form-control" placeholder="" autocomplete="off" {{ isset($disabled) ? 'disabled' : '' }}>
            @if ($errors->has('translate_name'))
                <span class="error-message" style="color: red">*
                    {{ $errors->first('translate_name') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">{{ __('messages.description') }} </label>
            <textarea name="translate_description" class="ck-editor" id="ckDescription_1" {{ isset($disabled) ? 'disabled' : '' }}
                data-height="100">{{ old('translate_description', $model->description ?? '') }}</textarea>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-12">
        <div class="form-row">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <label for="" class="control-label text-left">{{ __('messages.content') }} </label>
                <a href="" class="multipleUploadImageCkeditor"
                    data-target="ckContent_1">{{ __('messages.multiImg') }}</a>
            </div>
            <textarea name="translate_content" class="form-control ck-editor" placeholder="" autocomplete="off" id="ckContent_1"
                data-height="500" {{ isset($disabled) ? 'disabled' : '' }}>{{ old('translate_content', $model->content ?? '') }}</textarea>
        </div>
    </div>
</div>
