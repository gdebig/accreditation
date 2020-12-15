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
                <h3 class="card-title">Form Menambah Kode Prodi</h3>
              </div>
              <?php
              if ($status == "gagal"){
              ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Kesalahan!</h5>
                    <?php echo validation_errors(); ?>
                </div>
              <?php
              }
              ?>
              <br />
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?=base_url('prodi/docreate')?>" method="post">
                <div class="card-body">
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
                  <div class="form-group row">
                    <label for="inputJenjang" class="col-sm-2 col-form-label">Jenjang</label>
                    <div class="col-sm-10">                     
                    <select name="inputJenjang" class="form-control select2" style="width: 100%;">
                        <option value="s1reg" <?php echo set_value('inputJenjang') == "s1reg" ? "selected" : ""?>>S1 Reguler</option>
                        <option value="s1par" <?php echo set_value('inputJenjang') == "s1par" ? "selected" : ""?>>S1 Paralel</option>
                        <option value="s1int" <?php echo set_value('inputJenjang') == "s1int" ? "selected" : ""?>>S1 Internasional</option>
                        <option value="s2" <?php echo set_value('inputJenjang') == "s2" ? "selected" : ""?>>S2</option>
                        <option value="s3" <?php echo set_value('inputJenjang') == "s3" ? "selected" : ""?>>S3</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kodeProdi" class="col-sm-2 col-form-label">Kode Prodi *)</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kodeProdi" placeholder="Kode Prodi" name="kodeprodi" value="<?=set_value('kodeProdi');?>">
                    </div>
                  </div>
                </div>
                <div>
                *) Wajib diisi.
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="btncreate" value="buat">Buat Kode Prodi</button>
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