<div class="page-content">
    @include('backend.dashboard.component.breadcrumb', [
        'title' => $config['seo'][$config['method']]['title'],
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    @php
                        $url = $config['method'] == 'create' ? route('post.store') : route('post.update', $post->id);
                    @endphp
                    <form action="{{ $url }}" method="post">
                        @csrf
                        <div class="wrapper wrapper-content animate fadeInRight">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Thông tin chung</h5>
                                        </div>
                                        <hr>
                                        <div class="ibox-content">
                                            @include('backend.post.post.components.general')
                                        </div>
                                    </div>
                                    @include('backend.dashboard.component.album')
                                    @include('backend.post.post.components.seo')
                                </div>
                                <div class="col-lg-3">
                                    @include('backend.post.post.components.aside')
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
