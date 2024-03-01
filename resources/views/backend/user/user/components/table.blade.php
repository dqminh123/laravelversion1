<table id="dataTableExample" class="table table-striped">
    <thead>
      <tr>
        <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
        <th>Ảnh</th>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Nhóm Thành Viên</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao Tác</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($users) && is_object($users)) 
      @foreach($users as $user)
      <tr>
        <td><input type="checkbox" value="{{$user->id}}"  class="input-checkbox checkBoxItem"></td>
        <td><span class="image"><img src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/07/avatar-dep-4.jpg" alt="" style="width: 50px"></span></td>
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
        <td class="text-center">
          <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input status form-switch-{{$user->id}} " data-field="publish" data-model="User" value="{{$user->publish}}" id="formSwitch1" 
            {{ ($user->publish == 1)? 'checked' : '' }} data-modelId="{{$user->id}}">
            <span class="switchery" style="background-color: rgb(26,179,148);border-color:rgb(26,179,148);box-shadow:rgb(26,179,148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"></span>
          </div>
        </td>
        <td class="text-center">
          <a href="{{route('user.edit', $user->id)}}" class="btn btn-success"><i class="link-icon" data-feather="edit-2"></i></a>
          <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger"><i class="link-icon" data-feather="delete"></i></a>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>