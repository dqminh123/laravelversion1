@extends('backend.dashboard.layout')
@section('backend')
    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        @php
                            $url =
                                $config['method'] == 'create'
                                    ? route('user.catalogue.store')
                                    : route('user.catalogue.update', $userCatalogue->id);
                        @endphp
                        <h6 class="card-title" style="font-weight: bolder;color:gold">{{__('messages.tableHeading')}}</h6>
                        <form action="{{ $url }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">{{__('messages.nameusc')}} <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $userCatalogue->name ?? '') }}" placeholder="Nhập Tên Nhóm Thành Viên">
                                    @if ($errors->has('name'))
                                        <span class="error-message" style="color: red">*
                                            {{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <!-- Col -->
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('messages.deusc')}} <span class="text-danger">(*)</span></label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            value="{{ old('description', $userCatalogue->description ?? '') }}"
                                            placeholder="Nhập Ghi Chú">
                                        @if ($errors->has('description'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <!-- Col -->
                                    <button type="submit" name="send" value="send"
                                        class="btn btn-primary submit">{{__('messages.submitButton')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
