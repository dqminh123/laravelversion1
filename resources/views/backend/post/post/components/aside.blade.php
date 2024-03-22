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
                    <select name="post_catalogue_id" class="js-example-basic-single form-select form-control" data-width="100%">
                        @foreach ($dropdown as $key => $val)
                            <option
                                {{ $key == old('post_catalogue_id', isset($post->post_catalogue_id) ? $post->post_catalogue_id : '') ? 'selected' : '' }}
                                value="{{ $key }}">>{{ $val }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('post_catalogue_id'))
                        <span class="error-message" style="color: red">*
                            {{ $errors->first('post_catalogue_id') }}</span>
                    @endif
                </div>
            </div>
        </div>

            @php
                $catalogue = [];
                if (isset($post)) {
                    foreach ($post->post_catalogues as $key => $value) {
                            $catalogue[] = $value->id;  
                    }
                }
            @endphp

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label" style="font-weight: bold">Danh Mục Phụ</label>
                    <select multiple name="catalogue[]" class="js-example-basic-single form-select form-control"
                        data-width="100%">
                        @foreach ($dropdown as $key => $val)
                        <!--kiem tra mang  chua key cua no nếu có key thì selected -->
                            <option @if (is_array(old('catalogue', isset($catalogue) && count($catalogue) ? $catalogue : [])) && isset($post->post_catalogue_id) && $key !== $post->post_catalogue_id
                                  &&  in_array($key, old('catalogue', isset($catalogue) ? $catalogue : []))) selected @endif value = "{{ $key }}">
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('catalogue'))
                        <span class="error-message" style="color: red">*
                            {{ $errors->first('catalogue') }}</span>
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
                            src="{{ old('image', $post->image ?? url('public/upload/noimage.jpeg')) ?? url('public/upload/noimage.jpeg') }}"
                            alt="" style="width:250px"></span>
                    <input type="hidden" name="image" value="{{ old('image', $post->image ?? '') }}">
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
                                    {{ $key == old('follow', isset($post->follow) ? $post->follow : '') ? 'selected' : '' }}
                                    value="{{ $key }}">
                                    {{ $value }}</option>
                            @endforeach

                        </select>
                    </div>
                    <select name="publish" class="js-example-basic-single form-select form-control" data-width="100%">
                        @foreach (config('apps.general.publish') as $key => $value)
                            <option
                                {{ $key == old('publish', isset($post->publish) ? $post->publish : '') ? 'selected' : '' }}
                                value="{{ $key }}">{{ $value }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
