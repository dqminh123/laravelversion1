@php
    $segment = request()->segments(1);
@endphp
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('home.index') }}" class="sidebar-brand">
            Easy<span>Learning</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <div id="accordion">
            @foreach ((__('sidebar.module')) as $key => $val)
                <li class="nav-item nav-category">{{ $val['name'] }}</li>
                <li class="nav-item{{ (in_array($val['name'],$segment)) ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="{{'#'.$val['name']}}" role="button" aria-expanded="false"
                        aria-controls="emails">
                        <i class="{{ $val['icon'] }}"></i>
                        <span class="link-title">{{ $val['title'] }}</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="{{$val['name']}}" data-parent="#accordion">
                        @if (isset($val['subModule']))
                            <ul class="nav sub-menu">
                                @foreach ($val['subModule'] as $module)
                                    <li class="nav-item">
                                        <a href="{{ route($module['route']) }}"
                                            class="nav-link">{{ $module['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </li>
            @endforeach
        </div>
            <li class="nav-item">
                <a href="pages/apps/chat.html" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Chat</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                </a>
            </li>
            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
