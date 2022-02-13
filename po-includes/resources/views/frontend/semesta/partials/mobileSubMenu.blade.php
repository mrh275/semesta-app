@if (count($menu->children) > 0)
    <li>
        <a href="{{ url($menu->url) }}" class="dropdown-link dropdown-1" data-toggle="dropdown">{!! $menu->title !!}</a>
    @else
    <li>
        @if ($menu->target == 'none')
            <a href="{{ url($menu->url) }}" class="dropdown-link">{!! $menu->title !!}</a>
        @else
            <a href="{{ $menu->url }}" class="dropdown-link" target="_blank">{!! $menu->title !!}</a>
        @endif
@endif
@if (count($menu->children) > 0)
    <ul class="dropdown-menu-1 collapse invisible">
        @foreach ($menu->children as $menu)
            @include(getTheme('partials.mobileSubMenu'), $menu)
        @endforeach
    </ul>
@endif
</li>
