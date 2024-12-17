<?php 
session_start();
include '../koneksi.php';
$nip = $_POST['nip'];
$password = $_POST['password'];
$login = mysqli_query($koneksi,"select * from guru where nip_guru='$nip' and pass_guru='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	$_SESSION['nip'] = $nip;
	$_SESSION['status'] = "login";
	header("location:halaman_guru.php");
}else{
	header("location:index.php?pesan=gagal");
}
 
?>