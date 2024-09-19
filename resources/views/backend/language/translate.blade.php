<div class="page-content">
    @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('language.storeTranslate')}}" method="post">
                        @csrf
                        <input type="hidden" name="option[id]" value="{{$option['id']}}">
                        <input type="hidden" name="option[languageId]" value="{{$option['languageId']}}">
                        <input type="hidden" name="option[model]" value="{{$option['model']}}">
                        <div class="wrapper wrapper-content animate fadeInRight">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Thông tin chung</h5>
                                        </div>
                                        <hr>
                                        <div class="ibox-content">
                                            @include('backend.dashboard.component.content', ['model' => ($object) ?? null , 'disabled' =>1])
                                        </div>
                                    </div>
                                    @include('backend.dashboard.component.seo', ['model' => ($object) ?? null, 'disabled' =>1])
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Thông tin chung</h5>
                                        </div>
                                        <hr>
                                        <div class="ibox-content">
                                            @include('backend.dashboard.component.translate', ['model' => ($objectTranslate) ?? null])
                                        </div>
                                    </div>
                                    @include('backend.dashboard.component.seoTranslate', ['model' => ($objectTranslate) ?? null])
                                </div>
                                
                            </div>
                            <div class="text-right button-fix">
                                <button type="submit" name="send" value="send"
                                    class="btn btn-success">{{ __('messages.submitButton') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>