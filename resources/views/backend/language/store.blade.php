@extends('backend.dashboard.layout')
@section('backend')
    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        @php
                            $url = $config['method'] == 'create' ? route('language.store') : route('language.update', $language->id);
                        @endphp
                        <h6 class="card-title" style="font-weight: bolder;color:gold">Thông Tin Chung</h6>
                        <form action="{{ $url }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="mb-3">
                                    <label class="form-label">Tên Ngôn Ngữ <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $language->name ?? '') }}" placeholder="Nhập Tên Ngôn Ngữ">
                                    @if ($errors->has('name'))
                                        <span class="error-message" style="color: red">*
                                            {{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <!-- Col -->

                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Canonical <span class="text-danger">(*)</span></label>
                                        <input type="text" name="canonical" id="canonical" class="form-control"
                                            value="{{ old('canonical', $language->canonical ?? '') }}"
                                            placeholder="Nhập Canonical">
                                        @if ($errors->has('canonical'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('canonical') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ảnh Đại Diện <span class="text-danger">(*)</span></label>
                                        <input type="text" name="image" id="image" class="form-control upload-image" data-type= "Images"
                                            value="{{ old('image', $language->image ?? '') }}" placeholder="Chọn Ảnh">
                                        @if ($errors->has('image'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('image') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Mô Tả <span class="text-danger">(*)</span></label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            value="{{ old('description', $language->description ?? '') }}" placeholder="Nhập Mô Tả">
                                        @if ($errors->has('description'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <!-- Col -->
                                    <button type="submit" name="send" value="send"
                                        class="btn btn-primary submit">Submit
                                        form</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
