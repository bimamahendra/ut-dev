<!-- Sidebar -->
<ul class="navbar-nav bg-white sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('dashboard'); ?>">
        <img src="<?= base_url('assets/img/logo.png'); ?>" class="rounded mx-auto d-block" width="55">
        <div class="sidebar-brand-text mx-3">United Tractors</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('welcome/admin_dn_raw'); ?>">
            <i class="fas fa-book-open"></i>
            <span>Debit Note (RAW)</span>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('welcome/admin_dn_generate'); ?>">
            <i class="fas fa-book-open"></i>
            <span>Debit Note (Generate)</span>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('welcome/admin_dn_approved'); ?>">
            <i class="fas fa-book-open"></i>
            <span>Debit Note (Approved)</span>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('welcome/admin_dn_rejected'); ?>">
            <i class="fas fa-book-open"></i>
            <span>Debit Note (Rejected)</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 " id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">