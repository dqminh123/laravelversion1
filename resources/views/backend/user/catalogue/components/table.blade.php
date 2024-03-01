<table id="dataTableExample" class="table table-striped">
    <thead>
      <tr>
        <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>    
        <th>Tên Nhóm Thành Viên</th>
        <th>Mô tả</th>
        <th>Tình trạng</th>
        <th class="text-center">Thao Tác</th>
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
        <td>
        {{$userCatalogue->description}}
        </td>
        <td class="text-center">
          <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input status form-switch-{{$userCatalogue->id}} " data-field="publish" data-model="UserCatalogue" value="{{$userCatalogue->publish}}" id="formSwitch1" 
            {{ ($userCatalogue->publish == 1)? 'checked' : '' }} data-modelId="{{$userCatalogue->id}}">
            <span class="switchery" style="background-color: rgb(26,179,148);border-color:rgb(26,179,148);box-shadow:rgb(26,179,148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"></span>
          </div>
        </td>
        <td class="text-center">
          <a href="{{route('user.catalogue.edit', $userCatalogue->id)}}" class="btn btn-success"><i class="link-icon" data-feather="edit-2"></i></a>
          <a href="{{route('user.catalogue.delete', $userCatalogue->id)}}" class="btn btn-danger"><i class="link-icon" data-feather="delete"></i></a>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>