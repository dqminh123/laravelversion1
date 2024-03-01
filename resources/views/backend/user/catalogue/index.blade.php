@extends('backend.dashboard.layout')
@section('backend')
    <div class="page-content">


        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])
        <div class="ibox-tools">



        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('user.catalogue.create') }}" class="btn btn-success"><i class="link-icon"
                                data-feather="edit"></i> {{ config('apps.usercatalogue.create.title') }}</a>
                        <a href="" class="dropdown-toggle btn btn-warning toolbox" data-bs-toggle='dropdown'>
                            ToolBox <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a class="changeStatusAll" data-value="1" data-field="publish" data-model="UserCatalogue">
                                    Publish toàn bộ
                                </a>
                            </li>
                            <li><a class="changeStatusAll" data-value="0" data-field="publish" data-model="UserCatalogue">
                                    UnPublish toàn bộ
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <h6 class="card-title">{{ $config['seo']['index']['table'] }}</h6>
                        <div class="table-responsive">
                            <div class="action">
                                <div class="uk-flex uk-flex-middle">
                                    <select name="publish" class="js-example-basic-single form-select" data-width="20%">
                                        <option value="-1" selected="selected">Chọn tình trạng</option>
                                        <option value="0">Publish</option>
                                        <option value="1">UnPublish</option>
                                    </select>
                                    <select name="user_catalogue_id" class="js-example-basic-single form-select"
                                        data-width="20%">
                                        <option value="0" selected="selected">Chọn Nhóm Thành Viên</option>
                                        <option value="1">Quản trị Viên</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            @include('backend.user.catalogue.components.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
@endsection