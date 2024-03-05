<div class="row mb-3">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">Tiêu đề nhóm bài viết <span
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
            <label for="" class="control-label text-left">Mô tả ngắn</label>
            <textarea type="text" name="description" id="ckDescription"
                value="{{ old('description', $postCatalogue->description ?? '') }}" class="form-control ck-editor"
                placeholder="Nhập Mô Tả" autocomplete="off" data-height="150">
            </textarea>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">Nội Dung</label>
            <textarea type="text" name="content" id="ckContent" value="{{ old('content', $postCatalogue->content ?? '') }}"
                class="form-control ck-editor" placeholder="Nhập Mô Tả" autocomplete="off" data-height="500">
            </textarea>
        </div>
    </div>
</div>
