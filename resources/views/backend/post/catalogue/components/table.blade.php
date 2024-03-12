<table id="dataTableExample" class="table table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
            <th>Tên Nhóm</th>
            <th>Tình trạng</th>
            <th class="text-center">Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($postCatalogues) && is_object($postCatalogues))
            @foreach ($postCatalogues as $postcatalogue)
                <tr>
                    <td><input type="checkbox" value="{{ $postcatalogue->id }}" class="input-checkbox checkBoxItem"></td>
                    <td>
                        {{  str_repeat('|---',(($postcatalogue->level > 0)?($postcatalogue->level - 1):0)).$postcatalogue->name  }}
                    </td>
                    <td class="text-center">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input status form-switch-{{ $postcatalogue->id }} "
                                data-field="publish" data-model="PostCatalogue" value="{{ $postcatalogue->publish }}"
                                id="formSwitch1" {{ $postcatalogue->publish == 1 ? 'checked' : '' }}
                                data-modelId="{{ $postcatalogue->id }}">
                            <span class="switchery"
                                style="background-color: rgb(26,179,148);border-color:rgb(26,179,148);box-shadow:rgb(26,179,148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"></span>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('post.catalogue.edit', $postcatalogue->id) }}" class="btn btn-success"><i
                                class="link-icon" data-feather="edit"></i></a>
                        <a href="{{ route('post.catalogue.delete', $postcatalogue->id) }}" class="btn btn-danger"><i
                                class="link-icon" data-feather="delete"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{-- {{$postCatalogues->links('pagination::bootstrap-4')}} --}}
