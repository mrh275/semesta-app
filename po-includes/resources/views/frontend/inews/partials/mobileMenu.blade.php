@if (count($menu->children) > 0 && $menu->parent == 0)
    <li class="navMenu dropdown z-10">
        <a href="{{ url($menu->url) }}" class="nav-link">{!! $menu->title !!}</a>
    @else
    <li class="navMenu">
        @if ($menu->target == 'none')
            <a href="{{ url($menu->url) }}" class="nav-link">{!! $menu->title !!}</a>
        @else
            <a href="{{ $menu->url }}" class="nav-link" target="_blank">{!! $menu->title !!}</a>
        @endif
@endif
@if (count($menu->children) > 0)
    <ul class="dropdown-menu collapse invisible">
        @foreach ($menu->children as $menu)
            @include(getTheme('partials.mobileSubMenu'), $menu)
        @endforeach
    </ul>
@endif
</li>
