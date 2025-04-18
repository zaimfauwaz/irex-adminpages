@php
use Illuminate\Support\Facades\Request;
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-2">iREX Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item @if (Request::is('admindash')) active @endif">
    <a class="nav-link" href="{{ url('admindash')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Management
</div>

<!-- Nav Item - Employee -->
<li class="nav-item @if (Request::is('adminemp')) active @endif">
    <a class="nav-link" href="{{ url('adminemp')}}">
        <i class="fas fa-fw fa-users"></i>
        <span>Employee Manager</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Knowledge Base
</div>

<!-- Nav Item - Knowledge Base -->
<li class="nav-item @if (Request::is('product')) active @endif">
    <a class="nav-link" href="{{ url('product')}}">
        <i class="fas fa-fw fa-database"></i>
        <span>Product Manager</span>
    </a>
</li>

<!-- Nav Item - Knowledge Base -->
<li class="nav-item @if (Request::is('faqlist')) active @endif">
    <a class="nav-link" href="{{ url('faqlist')}}">
        <i class="fas fa-fw fa-question-circle"></i>
        <span>FAQ List Manager</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Logs
</div>

<!-- Nav Item - Logs -->
<li class="nav-item @if (Request::is('adminlogs')) active @endif">
    <a class="nav-link" href="{{ url('adminlogs')}}">
        <i class="fas fa-fw fa-history"></i>
        <span>Administrative Logs</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Others
</div>

<!-- Nav Item - Logs -->
<li class="nav-item @if (Request::is('playground')) active @endif">
    <a class="nav-link" href="{{ url('playground')}}">
        <i class="fas fa-fw fa-rocket"></i>
        <span>Playground</span></a>
</li>

<!-- Nav Item - Logout -->
<li class="nav-item">
    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-fw fa-sign-out"></i>
        <span>Log Off</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
<!-- End of Sidebar -->
