<table id="dataTableExample" class="table table-striped">
    <thead>
      <tr>
        <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th> 
        <th>Ảnh</th>
        <th>Tên Ngôn Ngữ</th>
        <th>Canonical</th>
        <th>Mô tả</th>
        <th class="text-center">Tình trạng</th>
        <th class="text-center">Thao Tác</th>
      </tr>
    </thead>
    <tbody>
      @if (isset($languages) && is_object($languages)) 
      @foreach ($languages as $language)
      <tr>
        <td><input type="checkbox" value="{{$language->id}}"  class="input-checkbox checkBoxItem"></td>
        <td>
          <span class="image"><img src="{{$language->image}}" alt="" style="height:50px;width:50px"></span>
        </td>
        <td>
        {{$language->name}}
        </td>
        <td>
          {{$language->canonical}}
          </td>
        <td>
        {{$language->description}}
        </td>
        <td class="text-center js-switch-{{$language->id}}">
            <input type="checkbox" class="js-switch status " data-field="publish" data-model="{{$model['model']}}" value="{{$language->publish}}"
            {{ ($language->publish == 1)? 'checked' : '' }} data-modelId="{{$language->id}}">
        </td>
        <td class="text-center">
          <a href="{{route('language.edit', $language->id)}}" class="btn btn-success"><i class="link-icon" data-feather="edit"></i></a>
          <a href="{{route('language.delete', $language->id)}}" class="btn btn-danger"><i class="link-icon" data-feather="delete"></i></a>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
