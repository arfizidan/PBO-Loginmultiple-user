<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center font-weight-bold" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-blog"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Blog</div>
    </a>

    <li class="nav-item {{request()->is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="/dashboard">
        <i class="fas fa-tachometer-alt"></i>
            <span class="font-weight-bold">Dashboard</span></a>
    </li>
    
    
    <hr class="sidebar-divider">
     <!-- Heading -->
     <div class="sidebar-heading">
        Data User
    </div>    
    <!-- Heading -->
    <li class="nav-item {{request()->is('akun') ? 'active' : ''}}">
        <a class="nav-link" href="/akun">
        <i class="fas fa-users"></i>
            <span class="font-weight-bold">Data User</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Blog
    </div>

    <li class="nav-item {{request()->is('blog') ? 'active' : ''}}">
        <a class="nav-link" href="/blog">
        <i class="fas fa-chart-bar"></i>
            <span class="font-weight-bold">Data Blog</span></a>
    </li>

    {{-- <li class="nav-item {{request()->is('blog/create') ? 'active' : ''}}">
        <a class="nav-link" href="/blog/create">
        <i class="fas fa-folder-plus"></i>
            <span class="font-weight-bold">Tambah Blog</span></a>
    </li> --}}

    
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
