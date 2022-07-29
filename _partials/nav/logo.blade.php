<a class="navbar-item" href="{{ page_url('home') }}">
    @if ($this->theme->logo_image)
        <img alt="{{ setting('site_name') }}" src="{{ uploads_url($this->theme->logo_image) }}" />
    @elseif ($this->theme->logo_text)
        <span class="text-logo">{{ $this->theme->logo_text }}</span>
    @else
        <img alt="{{ setting('site_name') }}" src="{{ uploads_url(setting('site_logo')) }}" />
    @endif
</a>
