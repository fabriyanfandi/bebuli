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

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="content">
        <div class="container" style="margin-bottom:30px;">
          <!-- Main content -->
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-12">

                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Ubah Data</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <form method="POST" action="update.php">
                    <?php
                    $id=$_GET['id'];
                    $pesan = mysqli_query($koneksi,"select * from pesan where id_pesan='$id'");
                    while($p=mysqli_fetch_array($pesan)) {
                    ?>
                  
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inputStatus">Status</label>
                      <select id="inputStatus" name="status" class="form-control custom-select">
                        <option values="menunggu" <?php if ($p['status_pesan'] == 'menunggu') echo 'selected'; ?>>Menunggu</option>
                        <option values="proses" <?php if ($p['status_pesan'] == 'proses') echo 'selected'; ?>>Proses</option>
                        <option values="selesai" <?php if ($p['status_pesan'] == 'selesai') echo 'selected'; ?>>Selesai</option>
                      </select>
                    </div>
                    <input type="hidden" name="id" value="<?=$p['id_pesan'];?>">
                    <div class="form-group">
                      <label for="inputDescription">Tindakan</label>
                      <textarea id="inputDescription" name="tindakan" class="form-control" rows="4"><?=$p['tindakan_pesan']?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <input type="submit" value="Kirim" class="btn btn-success">
                    </div>
                  </div>
                  </form>
                  <?php } ?>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

            </div>
          </div>
          <!-- /.row -->
        </div>

        <!-- /.container-fluid -->
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