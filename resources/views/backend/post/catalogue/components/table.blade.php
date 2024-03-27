<table id="dataTableExample" class="table table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
            <th>{{__('messages.postCatalogue.table.title')}}</th>
            <th class="text-center">{{__('messages.tableStatus')}}</th>
            <th class="text-center">{{__('messages.tableActive')}}</th>
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
                    <td class="text-center js-switch-{{$postcatalogue->id}}">
                        <input type="checkbox" class="js-switch status " data-field="publish" data-model="{{$model['model']}}" value="{{$postcatalogue->publish}}"
                        {{ ($postcatalogue->publish == 1)? 'checked' : '' }} data-modelId="{{$postcatalogue->id}}">
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
