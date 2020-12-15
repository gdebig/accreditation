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
                <h3 class="card-title">Form Menambah Anggota Tim Kurikulum</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?=base_url('manajemen/docreateanggotatimkur')?>" method="post">
              <input type="hidden" name="timkur_id" value="<?=$timkur_id?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputStaff" class="col-sm-2 col-form-label">Nama Staff</label>
                    <div class="col-sm-10">                  
                        <select name="inputStaff" class="form-control select2" style="width: 100%;">
                        <?php
                            foreach ($alluser as $user){
                                echo "<option value='".$user->user_id."'>".$user->gelar_depan." ".$user->name." ".$user->gelar_belakang."</option>";
                            }
                        ?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">                     
                    <select name="inputJabatan" class="form-control select2" style="width: 100%;">
                        <option value="Ketua">Ketua</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Anggota">Anggota</option>
                    </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="btncreate" value="buat">Tambah Anggota Tim</button>
                  <button type="submit" class="btn btn-default" name="btncreate" value="batal">Batal</button>
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