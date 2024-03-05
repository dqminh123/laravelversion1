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
                    <select name="user_catalogue_id"
                        class="js-example-basic-single form-select form-control"
                        data-width="100%">
                        <option value="0">Chọn danh mục cha</option>
                        <option value="1">Root</option>
                        <option value="2">...</option>
                    </select>
                    @if ($errors->has('user_catalogue_id'))
                                        <span class="error-message" style="color: red">*
                                            {{ $errors->first('user_catalogue_id') }}</span>
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
                            src="{{ url('public/upload/noimage.jpeg') }}"
                            alt="" style="width:250px"></span>
                    <input type="hidden" name="image" value="">
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
                        <select name=""
                            class="js-example-basic-single form-select form-control"
                            data-width="100%">
                            @foreach (config('apps.general.follow') as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}</option>
                            @endforeach

                        </select>
                    </div>
                    <select name=""
                        class="js-example-basic-single form-select form-control"
                        data-width="100%">
                        @foreach (config('apps.general.publish') as $key => $value)
                            <option value="{{ $key }}">{{ $value }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>