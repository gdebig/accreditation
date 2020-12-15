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
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?=base_url('prodi/docreate')?>" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputProdi" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-10">                      
                    <select name="prodi" class="form-control select2" style="width: 100%;">
                        <option value="elektro">Teknik Elektro</option>
                        <option value="komputer">Teknik Komputer</option>
                        <option value="biomedik">Teknik Biomedik</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputJenjang" class="col-sm-2 col-form-label">Jenjang</label>
                    <div class="col-sm-10">                     
                    <select name="inputJenjang" class="form-control select2" style="width: 100%;">
                        <option value="s1reg">S1 Reguler</option>
                        <option value="s1par">S1 Paralel</option>
                        <option value="s1int">S1 Internasional</option>
                        <option value="s2">S2</option>
                        <option value="s3">S3</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kodeProdi" class="col-sm-2 col-form-label">Kode Prodi *)</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kodeProdi" placeholder="Kode Prodi" name="kodeprodi">
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