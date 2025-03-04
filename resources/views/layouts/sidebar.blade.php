<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('Dashboard') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('Dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.reports.index') }}"">
        <i class="fa-solid fa-users"></i>
      <span>Laporan Masuk</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.petugas.index') }}"">
        <i class="fa-solid fa-users"></i>
      <span>Tambah Data Petugas</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">


</ul>

