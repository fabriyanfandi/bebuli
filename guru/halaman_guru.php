<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != "login") {
  header("location:index.php?pesan=belum_login");
}
?>
<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');
$data = mysqli_query($koneksi, "select * from guru where nip_guru='$_SESSION[nip]'");
$dataguru = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Guru</title>
  <link rel="icon" href="../assets/img/iconbebuli.png" sizes="16x16" type="image/png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../assets/materialize/icon/icon.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <img src="../assets/img/logo login bebuli.png" alt="BEBULI" width="100">
        </a>

        <button class="navbar-toggler order-3" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="index.php" class="nav-link"><span class="fas fa-home"></span> Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><span class="fas fa-user"></span> <?php echo $dataguru['nama_guru']; ?></a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a class="nav-link" href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>

    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <h1 align="center"><b>Selamat Datang di Halaman Guru</b></h1>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="content">

        <div class="container" style="margin-bottom:30px;">
          <!-- Main content -->
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
<?php
$datapengaduan = mysqli_query($koneksi,"select * from pesan");
$dp=mysqli_num_rows($datapengaduan);
echo "<h3>$dp</h3>";
?>
                      <p>Pengaduan</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-sad"></i>
                    </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                    <?php
$dataproses = mysqli_query($koneksi,"select * from pesan where status_pesan='proses'");
$dpr=mysqli_num_rows($dataproses);
echo "<h3>$dpr</h3>";
?>

                      <p>Proses</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-arrow-graph-up-right"></i>
                    </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                    <?php
$dataselesai = mysqli_query($koneksi,"select * from pesan where status_pesan='selesai'");
$ds=mysqli_num_rows($dataselesai);
echo "<h3>$ds</h3>";
?>

                      <p>Selesai</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-happy"></i>
                    </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                    <?php
$datasiswa = mysqli_query($koneksi,"select * from siswa");
$dsis=mysqli_num_rows($datasiswa);
echo "<h3>$dsis</h3>";
?>

                      <p>Jumlah Siswa</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    </div>
                </div>
                <!-- ./col -->
              </div>
            </div>
            <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Pengaduan Siswa</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          Tanggal
                      </th>
                      <th style="width: 5%">
                          Nama Siswa
                      </th>
                      <th style="width: 1%">
                          Kelas
                      </th>
                      <th style="width: 2%">
                          Status
                      </th>
                      <th style="width: 15%">
                          Tindakan
                      </th>
                      <th style="width: 14%">
                      </th>
                  </tr>
              </thead>
              <tbody>
              <?php
$d = mysqli_query($koneksi, "SELECT pesan.id_pesan, pesan.nis_siswa, pesan.teks_pesan, pesan.audio_pesan, pesan.tgl_pesan, pesan.status_pesan, pesan.tindakan_pesan, siswa.nis_siswa, siswa.nama_siswa, siswa.id_kelas, kelas.id_kelas, kelas.nama_kelas, kelas.nip_guru, guru.nip_guru
FROM pesan, guru, siswa, kelas
WHERE pesan.nis_siswa=siswa.nis_siswa AND guru.nip_guru= kelas.nip_guru AND siswa.id_kelas=kelas.id_kelas AND guru.nip_guru='$_SESSION[nip]'");
                      while ($res = mysqli_fetch_assoc($d)) {
                      echo "<tr>";
                      $oldate = $res["tgl_pesan"];
                      $newdate = date("d M Y H:i:s", strtotime($oldate));
                      echo "<td>$newdate</td>";
                      echo "<td>" . $res['nama_siswa'] . "</td>";
                      echo "<td>" . $res['nama_kelas'] . "</td>";               
                      
                      if ($res["status_pesan"] == 'menunggu') {
                        echo "<td><span class='badge badge-warning'>" . $res['status_pesan'] . "</span></td>";
                      }
                      else if ($res["status_pesan"] == 'proses') {
                        echo "<td><span class='badge badge-info'>" . $res['status_pesan'] . "</span></td>";
                      }
                      else {
                        echo "<td><span class='badge badge-success'>" . $res['status_pesan'] . "</span></td>";
                      }
                      
                      if ($res["tindakan_pesan"] == null) {
                        echo "<td><span class='badge badge-danger'>Belum Ada</span></td>";
                      }
                      else
                      {
                        echo "<td>" . $res['tindakan_pesan'] . "</td>";
                      }

                      echo "<td class='project-actions text-right'>
                          <a class='btn btn-primary btn-sm' href='view.php?id=$res[id_pesan]'>
                              <i class='fas fa-eye'>
                              </i>
                              View
                          </a>
                          <a class='btn btn-info btn-sm' href='ubah.php?id=$res[id_pesan]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                              Ubah
                          </a>
                          <a class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" href='del.php?id=$res[id_pesan]'>
                              <i class='fas fa-trash'>
                              </i>
                              Hapus
                          </a>
                          <a class='btn btn-warning btn-sm' href='log.php?id=$res[id_pesan]'>
                              <i class='fas fa-calendar'>
                              </i>
                              Log
                          </a>
                      </td>";
                    echo "</tr>";
                    }
                    ?>
                
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

          <!-- /.row -->
        </div><!-- /.container-fluid -->


      </div>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Universitas Bina Sarana Informatika
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2024 BEBIBUL
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../assets/dist/js/demo.js"></script>
  <script src="../assets/js/jquery-3.4.1.min.js"></script>
  <script src="../assets/materialize/js/materialize.min.js"></script>

</body>

</html>