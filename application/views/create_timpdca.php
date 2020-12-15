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
                <h3 class="card-title">Form Membuat Tim PDCA</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?=base_url('manajemen/docreatetimpdca')?>" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputNamaTim" class="col-sm-2 col-form-label">Nama Tim *)</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNamaTim" placeholder="Nama Tim" name="inputNamaTim">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputTahun" class="col-sm-2 col-form-label">Tahun *)</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputTahun" placeholder="Tahun" name="inputTahun">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSemester" class="col-sm-2 col-form-label">Semester</label>
                    <div class="col-sm-10">                      
                    <select name="inputSemester" class="form-control select2" style="width: 100%;">
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">                          
                    <select name="inputStatus" class="form-control select2" style="width: 100%;">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                  *) Wajib diisi.
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="btncreate" value="buat">Buat Tim PDCA</button>
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