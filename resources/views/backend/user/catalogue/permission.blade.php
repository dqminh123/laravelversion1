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
                        <form action="{{ route('user.catalogue.updatePermission') }}" method="post" class="box">
                            @csrf
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row" style="margin-bottom: 10px">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title" style="margin-bottom: 10px">
                                                <h5>Cấp quyền</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <table class="table table-striped table-bordered">
                                                    <tr>
                                                        <th></th>
                                                        @foreach ($userCatalogues as $key => $userCatalogue)
                                                            <th class="text-center">
                                                                {{ $userCatalogue->name }}
                                                            </th>
                                                        @endforeach
                                                    </tr>
                                                    @foreach ($permissions as $key => $permission)
                                                        <tr>
                                                            <td><a href=""
                                                                    class="uk-flex uk-flex-middle uk-flex-space-between">{{ $permission->name }}
                                                                    <span style="color: red">
                                                                        {{ $permission->canonical }}</span></a></td>
                                                            @foreach ($userCatalogues as $key => $userCatalogue)
                                                                <td>
                                                                    <input {{ collect($userCatalogue->permissions)->contains('id',$permission->id) ? 'checked' : '' }} type="checkbox"
                                                                        name="permission[{{ $userCatalogue->id }}][]"
                                                                        class="form-ctl" style="margin-left: 70px"
                                                                        value="{{ $permission->id }}">
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mb15" style="margin-left: 920px;  margin-bottom: -10px;">
                                    <button class="btn btn-primary" type="submit" name="send" value="send">{{__('messages.submitButton')}}</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
