<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('Dashboard/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('Dashboard/img/brand/logo-white.png') }}" class="main-logo dark-theme"
                alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('Dashboard/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('Dashboard/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    @if (auth('admin')->check())
        @include('Dashboard.layouts.main-sidebar.admin-sidebar')
    @endif

    @if (auth('doctor')->check())
        @include('Dashboard.layouts.main-sidebar.doctor-sidebar')
    @endif

    @if (auth('ray_employee')->check())
        @include('Dashboard.layouts.main-sidebar.ray-sidebar')
    @endif

    @if (auth('lab_employee')->check())
        @include('Dashboard.layouts.main-sidebar.lab-sidebar')
    @endif

    @if (auth('patient')->check())
        @include('Dashboard.layouts.main-sidebar.patient-sidebar')
    @endif

</aside>
<!-- main-sidebar -->
