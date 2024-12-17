<?php 
session_start();
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi,"delete from pesan where id_pesan='$id'");
header("location:index.php");
?>