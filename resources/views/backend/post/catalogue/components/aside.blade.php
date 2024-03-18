<div class="ibox">
    <div class="ibox-content">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left dm">Chọn
                        danh mục cha
                        <span class="text-danger">(*)</span></label>
                    <span class="text-danger notice">Chọn Root nếu không có danh mục
                        cha</span>
                    <select name="parent_id" class="js-example-basic-single form-select form-control" data-width="100%">
                        @foreach ($dropdown as $key => $val)
                            <option  {{ $key == old('parent_id', isset($postCatalogue->parent_id) ? $postCatalogue->parent_id : '') ? 'selected' : '' }}
                                value="{{ $key }}">>{{ $val }}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('parent_id'))
                        <span class="error-message" style="color: red">*
                            {{ $errors->first('parent_id') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Chọn
            Ảnh Đại Diện</h5>
    </div>
    <hr>
    <div class="ibox-content">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="image img-cover image-target"><img
                            src="{{ (old('image',$postCatalogue->image ?? url('public/upload/noimage.jpeg')) ?? url('public/upload/noimage.jpeg')) }}" alt=""
                            style="width:250px"></span>
                    <input type="hidden" name="image" value="{{ old('image', $postCatalogue->image ?? '') }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title mb-3">
        <h5>Cấu Hình Nâng Cao</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="form-row">
                    <div class="row mb-3">
                        <select name="follow" class="js-example-basic-single form-select form-control"
                            data-width="100%">
                            @foreach (config('apps.general.follow') as $key => $value)
                                <option
                                    {{ $key == old('follow', isset($postCatalogue->follow) ? $postCatalogue->follow : '') ? 'selected' : '' }}
                                    value="{{ $key }}">
                                    {{ $value }}</option>
                            @endforeach

                        </select>
                    </div>
                    <select name="publish" class="js-example-basic-single form-select form-control" data-width="100%">
                        @foreach (config('apps.general.publish') as $key => $value)
                            <option
                                {{ $key == old('publish', isset($postCatalogue->publish) ? $postCatalogue->publish : '') ? 'selected' : '' }}
                                value="{{ $key }}">{{ $value }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
