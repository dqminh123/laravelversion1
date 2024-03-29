@extends('backend.dashboard.layout')
@section('backend')

    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        @php
                            $url = ($config['method'] == 'create') ? route('user.store') : route('user.update', $user->id);
                        @endphp
                        <h6 class="card-title" style="font-weight: bolder;color:gold"> {{__('messages.tableHeading')}}</h6>
                        <form action="{{ $url }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label"> {{__('messages.nameus')}} <span class="text-danger">(*)</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $user->name ?? '') }}" placeholder="Nhập Họ Và Tên">
                                        @if ($errors->has('name'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <label class="form-label"> {{__('messages.birthday')}}</label>
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="date" name="birthday" class="form-control" placeholder="dd/mm/yyyy"
                                            data-input
                                            value="{{ old('birthday', (isset($user->birthday)) ? date('Y-m-d', strtotime($user->birthday)) : '') }}">
                                        <span class="input-group-text input-group-addon" data-toggle><i
                                                data-feather="calendar"></i></span>
                                    </div>
                                </div><!-- Col -->
                                @if ($config['method'] == 'create')
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="Password" class="form-label"> {{__('messages.passus')}}</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                autocomplete="current-password" placeholder="Nhập Mật Khẩu">
                                            @if ($errors->has('password'))
                                                <span class="error-message" style="color: red">*
                                                    {{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label"> {{__('messages.repassus')}} <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="password" name="re_password" id="re_password" class="form-control"
                                                autocomplete="off" placeholder="Nhập Lại Mật Khẩu">
                                            @if ($errors->has('re_password'))
                                                <span class="error-message" style="color: red">*
                                                    {{ $errors->first('re_password') }}</span>
                                            @endif
                                        </div>
                                    </div><!-- Col -->
                                @endif
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label"> {{__('messages.emailus')}} <span class="text-danger">(*)</span></label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                value="{{ old('email', $user->email ?? '') }}" placeholder="Nhập Email">
                                            @if ($errors->has('email'))
                                                <span class="error-message" style="color: red">*
                                                    {{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div><!-- Col -->
                                    @php
                                        $userCatalogue = ['[Chọn Nhóm Thành Viên]', 'Quản Trị Viên', 'Cộng Tác Viên'];

                                    @endphp
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label"> {{__('messages.usc')}} <span
                                                    class="text-danger">(*)</span></label>
                                            <select name="user_catalogue_id" id=""
                                                class="js-example-basic-single form-select" data-width="100%">
                                                @foreach ($userCatalogue as $key => $item)
                                                    <option
                                                        {{ $key == old('user_catalogue_id', isset($user->user_catalogue_id) ? $user->user_catalogue_id : '')
                                                            ? 'selected'
                                                            : '' }}
                                                        value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('user_catalogue_id'))
                                                <span class="error-message" style="color: red">*
                                                    {{ $errors->first('user_catalogue_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"> {{__('messages.ImgLanguage')}}</label>
                                        <input type="text" name="image" id="image" class="form-control upload-image"
                                            value="{{ old('image', $user->image ?? '') }}" data-upload="Images">
                                    </div>
                                </div><!-- Row -->
                            </div><!-- Row -->
                            <!-- end Thông tin chung -->
                            <hr>
                            <h6 class="card-title" style="font-weight: bolder;color:gold"> {{__('messages.tableHeading2')}}</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('messages.pv')}}</label>
                                        <select name="province_id" id="province_id"
                                            class="js-example-basic-single form-select form-control province location" data-width="100%"
                                            data-target ="districts">
                                            <option value="0">[ Chọn Thành Phố ]</option>
                                            @if (isset($provinces))
                                                @foreach ($provinces as $province)
                                                    <option @if (old('province_id') == $province->code) selected @endif
                                                        value="{{ $province->code }}">{{ $province->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('messages.dt')}}</label>
                                        <select name="district_id"
                                            class="js-example-basic-single form-select form-control districts location"
                                            data-width="100%" data-target="wards">
                                            <option value="0">[ Chọn Quận/Huyện ]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('messages.w')}}</label>
                                        <select name="ward_id" class="js-example-basic-single form-select form-control wards"
                                            data-width="100%">
                                            <option value="0">[ Chọn Phường/Xã ]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label"> {{__('messages.addressus')}}</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="{{ old('address', $user->address ?? '') }}"
                                            placeholder="Nhập Địa Chỉ">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label"> {{__('messages.phoneus')}}</label>
                                        <input type="number" name="phone" id="phone" class="form-control"
                                            value="{{ old('phone', $user->phone ?? '') }}"
                                            placeholder="Nhập Số Điện Thoại">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label"> {{__('messages.deusc')}}</label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            value="{{ old('description', $user->description ?? '') }}"
                                            placeholder="Nhập Ghi Chú">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <button type="submit" name="send" value="send" class="btn btn-primary submit">{{__('messages.submitButton')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var province_id = '{{ isset($user->province_id) ? $user->province_id : old('province_id') }}'
        var district_id = '{{ isset($user->district_id) ? $user->district_id : old('district_id') }}'
        var ward_id = '{{ isset($user->ward_id) ? $user->ward_id : old('ward_id') }}'
    </script>
@endsection
