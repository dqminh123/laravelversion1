
    <div class="page-content">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])
        <div class="ibox-tools">
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('backend.post.catalogue.components.filter')
                        <hr>
                        <h6 class="card-title">{{ __('messages.postCatalogue.index.table') }}</h6>
                        <div class="table-responsive">
                            @include('backend.post.catalogue.components.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

