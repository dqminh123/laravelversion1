@extends('backend.dashboard.layout')
@section('backend')
    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', [
            'title' => $config['seo'][$config['method']]['title'],
        ])
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        @php
                            $url =
                                $config['method'] == 'create'
                                    ? route('language.store')
                                    : route('language.update', $language->id);
                        @endphp
                        {{-- <h6 class="card-title" style="font-weight: bolder;color:gold">Thông Tin Chung</h6>
                        <form action="{{ $url }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="mb-3">
                                    <label class="form-label">{{__('messages.namelg')}} <span class="text-danger">(*)</span></label>
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
                                        <label class="form-label">{{__('messages.canonicalLanguage')}} <span class="text-danger">(*)</span></label>
                                        <input type="text" name="canonical" id="canonical" class="form-control"
                                            value="{{ old('canonical', $language->canonical ?? '') }}"
                                            placeholder="Nhập Canonical">
                                        @if ($errors->has('canonical'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('canonical') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{__('messages.ImgLanguage')}} <span class="text-danger">(*)</span></label>
                                        <input type="text" name="image" id="image" class="form-control upload-image" data-type= "Images"
                                            value="{{ old('image', $language->image ?? '') }}" placeholder="Chọn Ảnh">
                                        @if ($errors->has('image'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('image') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{__('messages.delg')}} <span class="text-danger">(*)</span></label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            value="{{ old('description', $language->description ?? '') }}" placeholder="Nhập Mô Tả">
                                        @if ($errors->has('description'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <!-- Col -->
                                    <button type="submit" name="send" value="send"
                                        class="btn btn-primary submit">{{__('messages.submitButton')}}</button>
                        </form> --}}

                        @extends('backend.dashboard.layout')
                    @section('backend')
                        <div class="page-content">
                            @include('backend.dashboard.component.breadcrumb', [
                                'title' => $config['seo'][$config['method']]['title'],
                            ])
                            <div class="row">
                                <div class="col-md-12 stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            @php
                                                $url =
                                                    $config['method'] == 'create'
                                                        ? route('language.store')
                                                        : route('language.update', $language->id);
                                            @endphp
                                            <form action="{{ $url }}" method="post" class="box">
                                                @csrf
                                                <div class="wrapper wrapper-content animated fadeInRight">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <div class="panel-head">
                                                                <div class="panel-title"
                                                                    style="color:red;font-weight:bold;font-size:18px">
                                                                    {{ __('messages.tableHeading') }}</div>
                                                                <div class="panel-description">
                                                                    <p>{{ __('messages.dep') }}</p>
                                                                    <p>{{ __('messages.note') }} <span
                                                                            class="text-danger">(*)</span>
                                                                        {{ __('messages.note_rq') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="ibox">
                                                                <div class="ibox-content">
                                                                    <div class="row mb15">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-row">
                                                                                <label
                                                                                    class="form-label">{{ __('messages.namelg') }}
                                                                                    <span
                                                                                        class="text-danger">(*)</span></label>
                                                                                <input type="text" name="name"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('name', $language->name ?? '') }}"
                                                                                    placeholder="Nhập Tên Ngôn Ngữ">
                                                                                @if ($errors->has('name'))
                                                                                    <span class="error-message"
                                                                                        style="color: red">*
                                                                                        {{ $errors->first('name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6" style="margin-bottom: 5px">
                                                                            <div class="form-row">
                                                                                <label
                                                                                    class="form-label">{{ __('messages.canonicalLanguage') }}
                                                                                    <span
                                                                                        class="text-danger">(*)</span></label>
                                                                                <input type="text" name="canonical"
                                                                                    id="canonical" class="form-control"
                                                                                    value="{{ old('canonical', $language->canonical ?? '') }}"
                                                                                    placeholder="Nhập Canonical">
                                                                                @if ($errors->has('canonical'))
                                                                                    <span class="error-message"
                                                                                        style="color: red">*
                                                                                        {{ $errors->first('canonical') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12" style="margin-bottom: 5px">
                                                                            <div class="form-row">
                                                                                <label
                                                                                    class="form-label">{{ __('messages.ImgLanguage') }}
                                                                                    <span
                                                                                        class="text-danger">(*)</span></label>
                                                                                <input type="text" name="image"
                                                                                    id="image"
                                                                                    class="form-control upload-image"
                                                                                    data-type= "Images"
                                                                                    value="{{ old('image', $language->image ?? '') }}"
                                                                                    placeholder="Chọn Ảnh">
                                                                                @if ($errors->has('image'))
                                                                                    <span class="error-message"
                                                                                        style="color: red">*
                                                                                        {{ $errors->first('image') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-row">
                                                                                <label
                                                                                    class="form-label">{{ __('messages.delg') }}
                                                                                    <span
                                                                                        class="text-danger">(*)</span></label>
                                                                                <input type="text" name="description"
                                                                                    id="description" class="form-control"
                                                                                    value="{{ old('description', $language->description ?? '') }}"
                                                                                    placeholder="Nhập Mô Tả">
                                                                                @if ($errors->has('description'))
                                                                                    <span class="error-message"
                                                                                        style="color: red">*
                                                                                        {{ $errors->first('description') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-left" style="margin-left: 920px">
                                                        <button class="btn btn-primary" type="submit" name="send"
                                                            value="send">{{ __('messages.submitButton') }}</button>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endsection


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
