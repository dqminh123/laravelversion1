@extends('backend.dashboard.layout')
@section('backend')

    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
            
                        <h6 class="card-title" style="font-weight: bolder;color:gold">Thông Tin Chung</h6>
                        <form action="{{route('user.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Họ Và Tên <span class="text-danger">(*)</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $user->name ?? '') }}" placeholder="Nhập Họ Và Tên" readonly>
                                        @if ($errors->has('name'))
                                            <span class="error-message" style="color: red">*
                                                {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div><!-- Col -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger">(*)</span></label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                value="{{ old('email', $user->email ?? '') }}" placeholder="Nhập Email" readonly>
                                            @if ($errors->has('email'))
                                                <span class="error-message" style="color: red">*
                                                    {{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div><!-- Col -->
                            </div><!-- Row -->
                            <button type="submit" name="send" value="send" class="btn btn-danger submit">Xóa
                                dữ liệu</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection
