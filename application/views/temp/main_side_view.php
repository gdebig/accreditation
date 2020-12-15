                
<?php
  $role = $this->session->userdata('role');
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link">
      <img src="<?=base_url()?>assets/images/icon/index.jpg" height="50" alt="D!Acreditation" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">D!Acreditation</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>assets/template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$name?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
            if ($role[0] == "1"){
          ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Pengaturan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('dashboard/user')?>" class="nav-link">
                  <i class="far fa-circle nav-icon active"></i>
                  <p>Pengaturan User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('manajemen')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaturan Manajemen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('prodi')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaturan Prodi</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            }
            if (($role[0] == "1") || ($role[2] == "1")){
          ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Manajemen Prodi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('manajemen/timkurikulum')?>" class="nav-link">
                  <i class="far fa-circle nav-icon active"></i>
                  <p>Tim Kurikulum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('manajemen/timpdca')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tim PDCA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('manajemen/koordinatormk')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Koordinator Mata Kuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('manajemen/pengampumk')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dosen Pengampu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('manajemen/dosenpeer')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dosen Peer</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            }
            if (($role[0] == "1") || ($role[1] == "1")){
          ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pengaturan Kurikulum
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('kurikulum')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manajemen Kurikulum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mata Kuliah</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            }
            if (($role[0] == "1") || ($role[3] == "1")){
          ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Koordinator Mata Kuliah
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub CPMK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BRP/SAP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Matriks Penilaian</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>