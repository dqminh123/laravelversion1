<table id="dataTableExample" class="table table-striped">
    <thead>
      <tr>
        <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
        <th> {{__('messages.ImgLanguage')}}</th>
        <th> {{__('messages.nameus')}}</th>
        <th> {{__('messages.emailus')}}</th>
        <th> {{__('messages.phoneus')}}</th>
        <th> {{__('messages.addressus')}}</th>
        <th> {{__('messages.usc')}}</th>
        <th class="text-center"> {{__('messages.tableStatus')}}</th>
        <th class="text-center"> {{__('messages.tableActive')}}</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($users) && is_object($users)) 
      @foreach($users as $user)
      <tr>
        <td><input type="checkbox" value="{{$user->id}}"  class="input-checkbox checkBoxItem"></td>
        <td><span class="image"><img src="{{$user->image}}" alt="" style="height:50px;width:50px"></span></td>
        <td>
        {{$user->name}}
        </td>
        <td>
          {{$user->email}}
        </td>
        <td>
          {{$user->phone}}
        </td>
        <td>
          {{$user->address}}
        </td>
        <td>
          {{$user->user_catalogues->name}}
        </td>
        <td class="text-center js-switch-{{$user->id}}">
          <input type="checkbox" class="js-switch status " data-field="publish" data-model="{{$model['model']}}" value="{{$user->publish}}"
          {{ ($user->publish == 1)? 'checked' : '' }} data-modelId="{{$user->id}}">
      </td>
        <td class="text-center">
          <a href="{{route('user.edit', $user->id)}}" class="btn btn-success"><i class="link-icon" data-feather="edit"></i></a>
          <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger"><i class="link-icon" data-feather="delete"></i></a>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>