<table id="dataTableExample" class="table table-striped">
    <thead>
      <tr>
        <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th> 
        <th>{{__('messages.title')}}</th>
        <th>{{__('messages.canonicalLanguage')}}</th>
        <th class="text-center">{{__('messages.tableActive')}}</th>
      </tr>
    </thead>
    <tbody>
      @if (isset($permissions) && is_object($permissions)) 
      @foreach ($permissions as $permission)
      <tr>
        <td><input type="checkbox" value="{{$permission->id}}"  class="input-checkbox checkBoxItem"></td>
        <td>
        {{$permission->name}}
        </td>
        <td>
          {{$permission->canonical}}
        </td>
        <td class="text-center">
          <a href="{{route('permission.edit', $permission->id)}}" class="btn btn-success"><i class="link-icon" data-feather="edit"></i></a>
          <a href="{{route('permission.delete', $permission->id)}}" class="btn btn-danger"><i class="link-icon" data-feather="delete"></i></a>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
