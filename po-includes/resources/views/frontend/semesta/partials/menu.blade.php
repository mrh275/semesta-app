@if (count($menu->children) > 0 && $menu->parent == 0)
    <li class="dropdown nav-menu-lg">
        <a href="{{ url($menu->url) }}" class="nav-link">{!! $menu->title !!}</a>
    @else
    <li class="nav-menu-lg">
        @if ($menu->target == 'none')
            <a href="{{ url($menu->url) }}" class="nav-link">{!! $menu->title !!}</a>
        @else
            <a href="{{ $menu->url }}" class="nav-link" target="_blank">{!! $menu->title !!}</a>
        @endif
@endif
@if (count($menu->children) > 0)
    <ul class="dropdown-lg absolute invisible collapse">
        @foreach ($menu->children as $menu)
            @include(getTheme('partials.submenu'), $menu)
        @endforeach
    </ul>
@endif
</li>
