<div class="row mb-3">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">{{__('messages.title')}} <span
                    class="text-danger">(*)</span></label>
            <input type="text" name="name" value="{{ old('name', $postCatalogue->name ?? '') }}" class="form-control"
                placeholder="" autocomplete="off">
            @if ($errors->has('name'))
                <span class="error-message" style="color: red">*
                    {{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">{{__('messages.description')}} </label>
            <textarea type="text" name="description" id="ckDescription"
                 class="form-control ck-editor"
                placeholder="Nhập Mô Tả" autocomplete="off" data-height="150">
                {{ old('description', $postCatalogue->description ?? '') }}
            </textarea>
            
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-12">
        <div class="form-row">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <label for="" class="control-label text-left">{{__('messages.content')}}</label>
                <a href="" class="multipleUploadImageCkeditor" data-target="ckContent">{{__('messages.multiImg')}}</a>
            </div>
            <textarea type="text" name="content" id="ckContent" 
                class="form-control ck-editor" placeholder="Nhập Mô Tả" autocomplete="off" data-height="500">
                {{ old('content', $postCatalogue->content ?? '') }}
            </textarea>
        </div>
    </div>
</div>
