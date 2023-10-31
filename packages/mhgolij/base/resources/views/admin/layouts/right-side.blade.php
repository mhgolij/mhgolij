<nav id="main-nav">

    <ul class="first-nav">
        <li>
            <a href="/admin/dashboard">@lang('mhgolijBase::admin.breadcrumb.dashboard')</a>
        </li>
    </ul>

    @foreach(\mhgolij\base\http\Models\Partial::whereCode('right-side-bar')->get() as $partial)
        @include($partial->address)
    @endforeach
</nav>

