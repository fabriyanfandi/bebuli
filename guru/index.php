<?php
error_reporting(0);
	session_start();
	if($_SESSION['status']=="login"){
		header("location:halaman_guru.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN GURU - BEBULI</title>
  <link rel="icon" href="../assets/img/iconbebuli.png" sizes="16x16" type="image/png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<?php
if (isset($_GET['pesan'])) {
  if ($_GET['pesan'] == "gagal") {
    echo "<div class='alert alert-danger alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
NIP dan Password Anda Tidak Sesuai !
</div>";
  } else if ($_GET['pesan'] == "logout") {
    echo "<div class='alert alert-info alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
Anda Telah Keluar dari Halaman Guru
</div>";
  } else if ($_GET['pesan'] == "belum_login") {
    echo "<div class='alert alert-danger alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
Maaf, Anda Harus Login untuk Mengakses Halaman Guru
</div>";
  }
}
?>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img width="250" src="../assets/img/logo login bebuli.png">
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <h4 class="login-box-msg"><b>LOGIN GURU</b></h4>

        <form action="proses_login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="nip" class="form-control" placeholder="NIP">
            <div class="input-group-append">
              <div class="input-group-text">

              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">

              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-danger btn-block"><span class="fas fa-sign-in-alt"></span> LOGIN</button>
            </div>
          </div>

          <!-- /.col -->
      </div>
      </form>


    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>