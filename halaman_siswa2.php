<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:index.php?pesan=gagal");
	}
 
	?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Siswa</title>
  <link rel="icon" href="assets/img/iconbebuli.png" sizes="16x16" type="image/png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="assets/index3.html" class="navbar-brand">
        <img src="assets/img/logo login bebuli.png" alt="BEBULI" width="100">
      </a>

      <button class="navbar-toggler order-3" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="index3.html" class="nav-link"><span class="fas fa-home"></span> Beranda</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link"><span class="fas fa-comments"></span> Laporan</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><span class="fas fa-user"></span> <?php echo $_SESSION['username']; ?></a>
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
            <h1 align="center"><b>Buat Laporan</b></h1>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container" align="center" style="margin-bottom:30px;">
        <div class="row">
          <div style="background-color:white; padding-top:20px; padding-right:20px; padding-left:20px; padding-bottom:50px;" class="col-md-12">
            <h4 style="text-align:left">Buat Pesan Teks</h4>
            <p style="text-align:left">Silahkan masukkkan pesan di bawah ini untuk membuat laporan</p>
            <form>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Masukkan Disini..."></textarea>
            </div>
            <button type="submit" class="btn btn-info"><span class="fas fa-paper-plane "></span> Kirim Pesan</button>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="container" align="center" style="margin-bottom:30px;">
        <div class="row">
          <div style="background-color:white; padding:20px;" class="col-md-12">
            <h4 style="text-align:left">Buat Pesan Suara</h4>
            <p style="text-align:left">Silahkan klik tombol di bawah untuk kirim pesan suara</p>
            
          </div>
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
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
