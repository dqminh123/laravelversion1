<form action="{{route('user.catalogue.index')}}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @php
                        $publish = request('publish') ?: old('publish');
                       
                    @endphp
                    <a href="{{ route('post.create') }}" class="btn btn-success"><i class="link-icon" data-feather="edit"></i>
                        {{ config('apps.post.create.title') }}</a>
                    <a href="" class="dropdown-toggle btn btn-warning toolbox" data-bs-toggle='dropdown'>
                        ToolBox <i class="fa fa-wrench"></i>
                    </a>
    
                    <ul class="dropdown-menu dropdown-user">
                        <li><a class="changeStatusAll xxx" data-value="1" data-field="publish"
                                data-model="{{ $model['model'] }}">
                                Publish toàn bộ
                            </a>
                        </li>
                        <li><a class="changeStatusAll xxx" data-value="0" data-field="publish"
                                data-model="{{ $model['model'] }}">
                                UnPublish toàn bộ
                            </a>
                        </li>
                    </ul>
                    <select name="publish" class="js-example-basic-single form-select form-control" style="width: 200px">
                        @foreach (config('apps.general.publish') as $key => $val)
                            <option {{ $publish == $key ? 'selected' : '' }} value="{{ $key }}">
                                {{ $val }}</option>
                        @endforeach
                    </select>
                    <div class="uk-search uk-flex uk-flex-middle mr10">
                        <div class="input-group">
                           <span class="input-group-btn">
                               <button type="submit" name="search" value="search" class="btn btn-primary btn-sm"><i class="link-icon" data-feather="search"></i> Tìm Kiếm
                                </button>
                           </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>