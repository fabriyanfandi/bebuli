<?php 
session_start();
include '../koneksi.php';
$id = $_POST['id'];
$status = $_POST['status'];
$tindakan = $_POST['tindakan'];
mysqli_query($koneksi,"update pesan set status_pesan='$status', tindakan_pesan='$tindakan' where id_pesan='$id'");
header("location:index.php");
?>