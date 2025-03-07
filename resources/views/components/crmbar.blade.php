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
    <div class="sidebar-brand-text mx-2">iREX CRM</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item @if (Request::is('crmdash')) active @endif">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Customers
</div>

<!-- Nav Item - Messages -->
<li class="nav-item @if (Request::is('messages')) active @endif">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-comments"></i>
        <span>Messages</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Logs
</div>

<!-- Nav Item - Filters -->
<li class="nav-item @if (Request::is('filters')) active @endif">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-filter"></i>
        <span>Filters</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Others
</div>

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