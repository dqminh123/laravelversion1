@foreach ($lang as $item)
@if (session('app_locale') === $item->canonical)
    @continue
@endif
<th class="text-center"><span class="image img-cover language-flag">
        <img src="{{ $item->image }}" alt="" style="width: 40px;height:40px;margin-left:12px"
            class="language-flag"></span></th>
@endforeach