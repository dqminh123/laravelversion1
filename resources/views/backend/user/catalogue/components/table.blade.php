<table id="dataTableExample" class="table table-striped">
    <thead>
      <tr>
        <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>    
        <th>{{__('messages.nameusc')}}</th>
        <th class="text-center">Số thành viên</th>
        <th>{{__('messages.delg')}}</th>
        <th class="text-center">{{__('messages.tableStatus')}}</th>
        <th class="text-center">{{__('messages.tableActive')}}</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($userCatalogues) && is_object($userCatalogues)) 
      @foreach($userCatalogues as $userCatalogue)
      <tr>
        <td><input type="checkbox" value="{{$userCatalogue->id}}"  class="input-checkbox checkBoxItem"></td>
        <td>
        {{$userCatalogue->name}}
        </td>
        <td class="text-center">
          {{ $userCatalogue->users_count }} người
      </td>
        <td>
        {{$userCatalogue->description}}
        </td>
        <td class="text-center js-switch-{{$userCatalogue->id}}">
          <input type="checkbox" class="js-switch status " data-field="publish" data-model="{{$model['model']}}" value="{{$userCatalogue->publish}}"
          {{ ($userCatalogue->publish == 1)? 'checked' : '' }} data-modelId="{{$userCatalogue->id}}">
      </td>
        <td class="text-center">
          <a href="{{route('user.catalogue.edit', $userCatalogue->id)}}" class="btn btn-success"><i class="link-icon" data-feather="edit"></i></a>
          <a href="{{route('user.catalogue.delete', $userCatalogue->id)}}" class="btn btn-danger"><i class="link-icon" data-feather="delete"></i></a>
         
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>