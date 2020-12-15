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
            <div class="row">
                <a href="<?=base_url('prodi/create')?>" class="btn btn-block btn-primary">Buat Kode Prodi</a>
            </div>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                <?php
                if ($allprodi=="kosong"){
                    echo "Belum ada data.";
                }else{
                ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenjang</th>
                    <th>Kode Prodi</th>
                    <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach ($allprodi as $a){
                    ?>
                    <tr>
                    <td><?=$i;?></td>
                    <td>
                      <?php
                        if ($a->nama == "elektro") { echo "Teknik Elektro"; }
                        if ($a->nama == "komputer") { echo "Teknik Komputer"; }
                        if ($a->nama == "biomedik") { echo "Teknik Biomedik"; }
                      ?>
                    </td>
                    <td>
                      <?php
                        if ($a->jenjang == "s1reg") { echo "S1 Reguler"; }
                        if ($a->jenjang == "s1par") { echo "S1 Paralel"; }
                        if ($a->jenjang == "s1int") { echo "S1 Internasional"; }
                        if ($a->jenjang == "s2") { echo "S2"; }
                        if ($a->jenjang == "s3") { echo "S3"; }
                      ?>
                    </td>
                    <td><?=$a->kode_prodi?></td>
                    </td>
                    <td><!--<a href="<?=base_url('manajemen/ubah/'.$a->man_id)?>" class="btn btn-block btn-warning"><i class='fas fa-user-edit'></i> Ubah</a>--><a href="<?=base_url('prodi/hapus/'.$a->prodi_id)?>" class="btn btn-block btn-danger" onclick="return confirm('Apakah yakin mau menghapus data kode prodi?')"><i class='fas fa-eraser'></i> Hapus</a></td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenjang</th>
                    <th>Kode Prodi</th>
                    <th>Aksi</th>
                    </tr>
                    </tfoot>
                </table>
                <?php
                }
                ?>
                </div>
                <!-- /.card-body -->
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