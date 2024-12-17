<?php 
session_start();
include 'koneksi.php';
$nis = $_POST['nis'];
$password = $_POST['password'];
$login = mysqli_query($koneksi,"select * from siswa where nis_siswa='$nis' and pass_siswa='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	$_SESSION['nis'] = $nis;
	$_SESSION['status'] = "login";
	header("location:halaman_siswa.php");
}else{
	header("location:index.php?pesan=gagal");
}
 
?>