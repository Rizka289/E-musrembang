<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">Desa TamanSari</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php if ($this->session->userdata('user') != "dusun") { ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Login/userDusun') ?>">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>User Dusun</span></a>
    </li>
    <hr class="sidebar-divider">
    <?php } ?>

    <!-- Nav Item - Data Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-folder-plus"></i>
            <span>Data</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Input</h6>
                <?php if ($this->session->userdata('user') != "dusun") { ?>
                <a class="collapse-item" href="<?= site_url('InputData') ?>">Tahun</a>
                <?php } ?>
                <a class="collapse-item" href="<?= site_url('InputData/Bidang') ?>">Bidang</a>
                <a class="collapse-item" href="<?= site_url('InputData/subBidang') ?>">Sub Bidang</a>
                <a class="collapse-item" href="<?= site_url('InputData/Usulan') ?>">Usulan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('InputData/RKP') ?>">
            <i class="	far fa-file-excel" aria-hidden="true"></i>
            <span>RKP</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->