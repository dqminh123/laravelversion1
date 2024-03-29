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
                                    ? route('permission.store')
                                    : route('permission.update', $permission->id);
                        @endphp
                        <form action="{{ $url }}" method="post" class="box">
                            @csrf
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="panel-head">
                                            <div class="panel-title" style="color:red;font-weight:bold;font-size:18px">{{__('messages.tableHeading')}}</div>
                                            <div class="panel-description">
                                                <p>{{__('messages.dep')}}</p>
                                                <p>{{__('messages.note')}} <span class="text-danger">(*)</span> {{__('messages.note_rq')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="row mb15">
                                                    <div class="col-lg-6">
                                                        <div class="form-row">
                                                            <label for="" class="control-label text-left">{{__('messages.title')}}
                                                                <span class="text-danger">(*)</span></label>
                                                            <input type="text" name="name"
                                                                value="{{ old('name', $permission->name ?? '') }}"
                                                                class="form-control" placeholder="" autocomplete="off">
                                                                @if ($errors->has('name'))
                                                                <span class="error-message" style="color: red">*
                                                                    {{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-row">
                                                            <label for=""
                                                                class="control-label text-left">{{__('messages.canonicalLanguage')}}<span
                                                                    class="text-danger">(*)</span></label>
                                                            <input type="text" name="canonical"
                                                                value="{{ old('canonical', $permission->canonical ?? '') }}"
                                                                class="form-control" placeholder="" autocomplete="off">
                                                                @if ($errors->has('canonical'))
                                                                <span class="error-message" style="color: red">*
                                                                    {{ $errors->first('canonical') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left" style="margin-left: 950px">
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
