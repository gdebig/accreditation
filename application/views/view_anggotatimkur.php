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
            <a href="<?=base_url('manajemen/timkurikulum')?>"><i class='fas fa-arrow-left'></i> Kembali ke Daftar Tim Kurikulum</a>
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
                <a href="<?=base_url('manajemen/createanggotatimkur/'.$timkur_id)?>" class="btn btn-block btn-primary">Tambah Anggota Tim Kurikulum Baru</a>
            </div>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                <?php
                if ($anggotatimkur=="kosong"){
                    echo "Belum ada data.";
                }else{
                ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Nama Dosen</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach ($anggotatimkur as $a){
                    ?>
                    <tr>
                    <td><?=$i;?></td>
                    <td><?=$a->nama_tim;?></td>
                    <td>
                      <?php echo $a->gelar_depan." ".$a->name." ".$a->gelar_belakang;?>
                    </td>
                    <td><?=$a->Jabatan?></td>
                    <td><!--<a href="<?=base_url('manajemen/ubahtimkur/'.$a->timkur_id)?>" class="btn btn-block btn-warning"><i class='fas fa-user-edit'></i> Ubah</a>--><a href="<?=base_url('manajemen/hapusanggotatimkur/'.$a->user_id.'/'.$a->timkur_id.'/'.$a->anggota_id)?>" class="btn btn-block btn-danger" onclick="return confirm('Apakah yakin mau menghapus data anggota tim kurikulum?')"><i class='fas fa-eraser'></i> Hapus</a></td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Nama Dosen</th>
                    <th>Jabatan</th>
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