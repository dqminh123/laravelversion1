@extends('backend.dashboard.layout')
@section('backend')

    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
            
                        <form action="{{ route('language.destroy', $language->id) }}" method="post" class="box">
                            @csrf
                            @method('DELETE')
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="panel-head">
                                            <div class="panel-title" style="color: blue;font-weight:bold;font-size:15px">Thông tin chung</div>
                                            <div class="panel-description">
                                                <p>Bạn đang muốn xóa ngôn ngữ có tên là: <span class="text-danger">{{ $language->name }}</span></p>
                                                <p>Lưu ý: Không thể khôi phục ngôn ngữ sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="row mb15">
                                                    <div class="col-lg-12">
                                                        <div class="form-row">
                                                            <label for="" class="control-label text-left">Tên nhóm <span class="text-danger">(*)</span></label>
                                                            <input 
                                                                type="text"
                                                                name="name"
                                                                value="{{ old('name', ($language->name) ?? '' ) }}"
                                                                class="form-control"
                                                                placeholder=""
                                                                autocomplete="off"
                                                                readonly
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="text-right" style="margin-left: 920px">
                                    <button class="btn btn-danger" type="submit" name="send" value="send">Xóa dữ liệu</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection
