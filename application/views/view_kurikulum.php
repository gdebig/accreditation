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
            <h1 class="m-0 text-dark"><?=$page?></h1>
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
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Kurikulum</th>
                  <th>Tahun</th>
                  <th>Nama Program Studi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>01.03.04.01-2020</td>
                  <td>2020</td>
                  <td>Teknik Elektro</td>
                  <td>Ubah | Hapus</td>
                </tr>
                <tr>
                  <td>01.03.04.01-2016</td>
                  <td>2016</td>
                  <td>Teknik Elektro</td>
                  <td>Ubah | Hapus</td>
                </tr>
                <tr>
                  <td>02.03.04.01-2020</td>
                  <td>2020</td>
                  <td>Teknik Komputer</td>
                  <td>Ubah | Hapus</td>
                </tr>
                <tr>
                  <td>02.03.04.01-2016</td>
                  <td>2016</td>
                  <td>Teknik Komputer</td>
                  <td>Ubah | Hapus</td>
                </tr>
                <tr>
                  <td>12.03.04.01-2020</td>
                  <td>2020</td>
                  <td>Teknik Biomedik</td>
                  <td>Ubah | Hapus</td>
                </tr>
                <tr>
                  <td>12.03.04.01-2018</td>
                  <td>2018</td>
                  <td>Teknik Biomedik</td>
                  <td>Ubah | Hapus</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Kurikulum</th>
                  <th>Tahun</th>
                  <th>Nama Program Studi</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
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