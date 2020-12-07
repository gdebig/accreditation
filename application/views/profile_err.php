<?php
$this->load->view("temp/header_view");
$this->load->view("temp/main_side_view");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
              <li class="breadcrumb-item active"><?=$page?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Profile User</h3>
              </div>
              <div class="card-body">
              <?php
              if ($status == "gagal"){
              ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Kesalahan!</h5>
                    <?php echo validation_errors(); ?>
                </div>
              <?php
              } else {
              ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>Profil baru berhasil disimpan</h5>
                </div>
              <?php
              }
              ?>
              </div>
              <br />
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?=base_url('login/doUpdateProfile')?>" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputNama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNama" placeholder="Nama Lengkap" name="namalengkap" value="<?=set_value('namalengkap');?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGelarDepan" class="col-sm-2 col-form-label">Gelar Depan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputGelarDepan" placeholder="Gelar Depan" name="gelardepan" value="<?=set_value('gelardepan');?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGelarBelakang" class="col-sm-2 col-form-label">Gelar Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputGelarBelakang" placeholder="Gelar Belakang" name="gelarbelakang" value="<?=set_value('gelarbelakang');?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputNIP" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNIP" placeholder="NIP" name="nip" value="<?=set_value('nip');?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" value="<?=set_value('username');?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?=set_value('email');?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputNoHP" class="col-sm-2 col-form-label">No HP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNoHP" placeholder="No HP" name="nohp" value="<?=set_value('nohp');?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputProdi" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-10">                      
                    <select name="prodi" class="form-control select2" style="width: 100%;">
                        <option value="elektro" <?php echo set_value('prodi') == "elektro" ? "selected" : ""?>>Teknik Elektro</option>
                        <option value="komputer" <?php echo set_value('prodi') == "komputer" ? "selected" : ""?>>Teknik Komputer</option>
                        <option value="biomedik" <?php echo set_value('prodi') == "biomedik" ? "selected" : ""?>>Teknik Biomedik</option>
                    </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update Profile</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
$this->load->view("temp/footer_view");
?>