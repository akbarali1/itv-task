<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">Sneat</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
        <li class="menu-item">
            <a href="{{ route('subject.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                @lang('form.subjects')
            </a>
        </li>
       {{-- <li class="menu-item">
            <a href="{{ route('topic.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                @lang('form.topics')
            </a>
        </li>--}}
    </ul>
</aside>
