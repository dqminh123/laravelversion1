@foreach ($lang as $item)
    @if (session('app_locale') === $item->canonical)
        @continue
    @endif
    <td class="text-center">
        @php
            $translated = $model->languages->contains('id', $item->id);
        @endphp
        <a class="{{ $translated ? '' : 'text-danger' }}"
            href="{{ route('language.translate', ['id' => $model->id, 'languageId' => $item->id, 'model' => $modeling]) }}">{{ $translated ? 'Đã dịch' : 'Chưa dịch' }}</a>
    </td>
@endforeach
