<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="#" class="header-logo">
            <img src="{!! asset('assets/backend/images/logo.png') !!}" class="img-fluid rounded-normal" alt="">
            <div class="logo-title">
                <span class="text-primary text-uppercase">Streamit</span>
            </div>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="las la-bars"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li><a href="#" class="text-primary"><i class="ri-arrow-right-line"></i><span>Visit
                            site</span></a></li>
                <li><a href="#" class="iq-waves-effect"><i
                            class="las la-home iq-arrow-left"></i><span>Dashboard</span></a></li>
                @if (function_exists('is_setting'))
                    @include('setting::menu.index')
                @endif
            </ul>
        </nav>
    </div>
</div>
