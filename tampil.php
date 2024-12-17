<?php
session_start();
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST["kirim_pesan"]))
{
   $tekspesan=$_POST["tekspesan"];
   $tanggal=date('Y-m-d H:i:s');
   mysqli_query ($koneksi,"insert into pesan (nis_siswa,teks_pesan,audio_pesan,tgl_pesan) values ('$_SESSION[nis]', '$tekspesan', '','$tanggal')");

}
?>    
    
    <table border="1" width='80%' border=0>
	<tr bgcolor='#DDDDDD'>
		<td><strong>NIS Siswa</strong></td>
		<td><strong>Pesan Teks</strong></td>
		<td><strong>Pesan Suara</strong></td>
        <td><strong>Tanggal</strong></td>
	</tr>

	<?php
	$data=mysqli_query ($koneksi,"select * from pesan");
    while ($res = mysqli_fetch_assoc($data)) {
		echo "<tr>";
		echo "<td>".$res['nis_siswa']."</td>";
		if ($res["teks_pesan"]!=null)
        {
            echo "<td>".$res['teks_pesan']."</td>";
        }
        else
        {
            echo "<td>Tidak Ada Pesan Teks</td>";
        }
            if ($res["audio_pesan"]!=null)
            {
			  echo "<td><audio controls><source src='uploads/$res[audio_pesan]' type='audio/ogg'></audio></td>";
            }
            else
            {
              echo "<td>Tidak Ada Pesan Suara</td>";
            }
            if ($res["tgl_pesan"]!=null)
            {
                echo "<td>".$res['tgl_pesan']."</td>";
            }
            else
            {
                echo "<td>Belum Ada Data</td>";
            }
            echo "</tr>";
		}
		?>
	</table>