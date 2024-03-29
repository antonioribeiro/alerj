@if ($breadcrumbs)
    <ul class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li>
                    <a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a>
                    <span class="divider">/</span>
                </li>
            @else
                <li class="active">
                    {{{ $breadcrumb->title }}}
                </li>
            @endif
        @endforeach
    </ul>
@endif