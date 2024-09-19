<table id="dataTableExample" class="table table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
            <th>Tiêu Đề</th>
            @include('backend.dashboard.component.languageTh')
            <th style="width: 60px" class="text-center">Vị Trí</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($posts) && is_object($posts))
            @foreach ($posts as $post)
                <tr id="{{ $post->id }}">
                    <td><input type="checkbox" value="{{ $post->id }}" class="input-checkbox checkBoxItem"></td>
                    <td>
                        <div class="uk-flex uk-flex-middle">
                            <div class="image mr5">
                                <div class="img-cover image-post"><img src="{{ $post->image }}" alt=""></div>
                            </div>
                            <div class="main-info">
                                <div class="name">
                                    <span class="maintitle">
                                        {{ $post->name }}
                                    </span>
                                </div>
                                <div class="catalogue">
                                    <span class="text-danger">Nhóm hiển thị: </span>
                                    
                                    @foreach ($post->post_catalogues as $value)
                                    @if(!empty($value->languages))
                                        @php
                                            $catName = $value->languages->first()->pivot->name ?? '';
                                            $catRoute = route('post.index', ['post_catalogue_id'=> $value->id])
                                        @endphp
                                        <a href="{{ $catRoute }}" title="">{{ $catName }}</a>
                                    @endif
                                    @endforeach
                               
                                </div>
                            </div>
                        </div>
                    </td>
                    @include('backend.dashboard.component.languageTd', ['model' => $post, 'modeling' => 'Post'])
                    <td class="text-center">
                        <input type="text" name="order" value="{{ $post->order }}"
                            class="form-control sort-order text-center" readonly data-id="{{ $post->id }}"
                            data-model="{{ $model['model'] }}">
                    </td>
                    <td class="text-center js-switch-{{ $post->id }}">
                        <input type="checkbox" class="js-switch status " data-field="publish"
                            data-model="{{ $model['model'] }}" value="{{ $post->publish }}"
                            {{ $post->publish == 1 ? 'checked' : '' }} data-modelId="{{ $post->id }}">
                    </td>
                    <td class="text-center">
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success"><i class="link-icon"
                                data-feather="edit"></i></a>
                        <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger"><i class="link-icon"
                                data-feather="delete"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{-- {{$posts->links('pagination::bootstrap-4')}} --}}
