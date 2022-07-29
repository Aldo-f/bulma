@php
$_startItems = [];
$_endItems = [];

$end = ['login', 'register'];
$prepend = [
    [
        'title' => 'main::lang.menu_home',
        'code' => 'home',
        'type' => 'theme-page',
        'reference' => 'local' . DIRECTORY_SEPARATOR . 'home',
    ],
];

foreach ($prepend as &$navItem) {
    $navItem = (object) $navItem;

    // defaults
    $navItem->isActive = false;
    $navItem->isChildActive = null;
    $navItem->extraAttributes = null;
    $navItem->items = [];

    if ($navItem->reference) {
        if (strpos($navItem->reference, 'local') === 0) {
            $navItem->url = site_url(str_replace('local' . DIRECTORY_SEPARATOR, '', $navItem->reference));
        } else {
            $navItem->url = $navItem->reference;
        }
        unset($navItem->reference);
    }
    unset($navItem->type);
}

array_unshift($items, ...$prepend);

$_logged_in = Auth::isLogged();
$_skip = $_logged_in ? ['login', 'register'] : ['account', 'recent-orders'];

foreach ($items as $navItem) {
    if (in_array($navItem->code, $_skip)) {
        continue;
    }

    if (in_array($navItem->code, $end)) {
        $_endItems[] = $navItem;
    } else {
        $_startItems[] = $navItem;
    }
}
@endphp




<div class="navbar-start">

    @foreach ($_startItems as $navItem)
        @continue(Auth::isLogged() && in_array($navItem->code, ['login', 'register']))
        @continue(!Auth::isLogged() && in_array($navItem->code, ['account', 'recent-orders']))

        @if ($navItem->items)
            <div @class([
                'navbar-item has-dropdown is-hoverable',
                'active' => $navItem->isActive || $navItem->isChildActive,
            ])>
                <a class="navbar-link">
                    @lang($navItem->title)
                </a>

                <div class="navbar-dropdown">
                    @foreach ($navItem->items as $item)
                        <a class="navbar-item" href="{{ $item->url }}">
                            @lang($item->title)
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <a @class(['navbar-item', 'active' => $navItem->isActive]) href="{{ $navItem->url }}">
                @lang($navItem->title)
            </a>
        @endif
    @endforeach

</div>

<div class="navbar-end">
    <div class="navbar-item">
        <div class="buttons">

            @foreach ($_endItems as $navItem)
                @if ($navItem->code === 'register')
                    <a class="button is-primary">
                        <strong>@lang($navItem->title)</strong>
                    </a>
                @else
                    <a class="button is-light">
                        @lang($navItem->title)
                    </a>
                @endif
            @endforeach

        </div>
    </div>
</div>
