@if (count($menu->children) > 0)
    <li class="dropdown-link-lg">
        <a href="{{ url($menu->url) }}" class="drop-link-lg">{!! $menu->title !!}</a>
    @else
    <li class="dropdown-link-lg">
        @if ($menu->target == 'none')
            <a href="{{ url($menu->url) }}" class="drop-link-lg">{!! $menu->title !!}</a>
        @else
            <a href="{{ $menu->url }}" class="drop-link-lg" target="_blank">{!! $menu->title !!}</a>
        @endif
@endif
@if (count($menu->children) > 0)
    <ul class="drop-1-lg absolute left-full top-20 invisible collapse">
        @foreach ($menu->children as $menu)
            @if (count($menu->children) > 0)
                <li>
                    <a href="{{ url($menu->url) }}" class="drop-link-lg-1 drop-link-short-lg">{!! $menu->title !!}</a>
                @else
                <li>
                    @if ($menu->target == 'none')
                        <a href="{{ url($menu->url) }}" class="drop-link-lg-1 drop-link-short-lg">{!! $menu->title !!}</a>
                    @else
                        <a href="{{ $menu->url }}" class="drop-link-lg-1 drop-link-short-lg" target="_blank">{!! $menu->title !!}</a>
                    @endif
            @endif
            </li>
        @endforeach
    </ul>
@endif
</li>
