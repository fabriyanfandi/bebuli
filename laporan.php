<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:index.php?pesan=belum_login");
}
?>

<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST["kirim_pesan"]))
{
   $tekspesan=$_POST["tekspesan"];
   $tanggal=date('Y-m-d H:i:s');
   mysqli_query ($koneksi,"insert into pesan (nis_siswa,teks_pesan,audio_pesan,tgl_pesan,status_pesan,tindakan_pesan) values ('$_SESSION[nis]', '$tekspesan', '','$tanggal','menunggu','')");

}
?>   

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Siswa</title>
    <link rel="icon" href="assets/img/iconbebuli.png" sizes="16x16" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="assets/materialize/icon/icon.css" />

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="assets/img/logo login bebuli.png" alt="BEBULI" width="100">
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
                        <li class="nav-item">
                            <a href="laporan.php" class="nav-link"><span class="fas fa-comments"></span> Laporan</a>
                        </li>
                        <?php
            $datasiswa = mysqli_query($koneksi, "select * from siswa  where nis_siswa='$_SESSION[nis]'");
            $ds = mysqli_fetch_assoc($datasiswa);
            ?>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><span class="fas fa-user"></span> <?php echo $ds['nama_siswa']; ?></a>
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
                    <h1 align="center"><b>Laporan Kamu</b></h1>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
    <section class="content">
    <div class="container" align="center" style="margin-bottom:30px;">
        <div class="row">
        <div style="padding-right:20px; padding-left:20px; padding-bottom:50px;" class="col-md-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Tanggal Lapor</th>
                      <th>Isi Laporan</th>
                      <th>Status</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
	$data=mysqli_query ($koneksi,"select * from pesan where nis_siswa='$_SESSION[nis]' order by tgl_pesan desc");
    while ($res = mysqli_fetch_assoc($data)) {
		echo "<tr>";       
        $oldate=$res["tgl_pesan"];
        $newdate = date("d M Y H:i:s", strtotime($oldate));
        echo "<td>$newdate</td>";
		if ($res["teks_pesan"]!=null)
        {
            echo "<td>".$res['teks_pesan']."</td>";
            
        }
        else if ($res["audio_pesan"]!=null)
        {
            echo "<td><audio controls><source src='uploads/$res[audio_pesan]' type='audio/ogg'></audio></td>";
        }

        echo "<td><span class='badge badge-warning'>Menunggu</span></td>";
        if ($res["tindakan_pesan"]!=null)
        {
            echo "<td>".$res['tindakan_pesan']."</td>";
            
        }
        else
        {
        echo "<td><span class='badge badge-danger'>Belum Ada</span></td>";
        }
        echo "</tr>";
	}
	?>
    </tbody>
    </table>
            </div>
            <!-- /.card -->

       
            <!-- /.card -->
          </div>
          
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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