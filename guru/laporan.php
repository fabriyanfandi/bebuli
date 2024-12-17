<?php 
	session_start();
  include '../koneksi.php';
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
	}
?>
<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');
$data=mysqli_query($koneksi,"select * from guru where nip_guru='$_SESSION[nip]'");
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
              <li class="nav-item">
                <a href="laporan.php" class="nav-link"><span class="fas fa-comments"></span> Laporan</a>
              </li>
              <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><span class="fas fa-user"></span> <?php echo $dataguru['nama_guru'];?></a>
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
            <h1 align="center"><b>Selamat Datang</b></h1>
            <h2 align="center"><?php echo $dataguru['nama_guru'];?></h2>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Modal -->
           
        <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Beri Respon</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
            <div class="modal-body">
            
            <h4 style="text-align:left">Buat Pesan Teks</h4>
                <p style="text-align:left">Silahkan masukkkan pesan di bawah ini untuk membuat laporan</p>
                <?php
                    $id_pesan = $_GET['id'];
                    $qpes = mysqli_query($koneksi,"SELECT * FROM pesan WHERE id_pesan='$id_pesan'");
                    $q=mysqli_fetch_array($qpes);
                    ?>
                <form action="laporan.php" method="POST">
                  <div class="form-group">
                 
                   <input type="hidden" name="id_pes" value="<?php echo $q['id_pesan']; ?>">
                    <textarea name="teksrespon" class="form-control" rows="5" placeholder="Masukkan Disini..."></textarea>
                  </div>
                  <button type="submit" name="kirim_pesan" class="btn btn-info"><span class="fas fa-paper-plane "></span> Kirim Pesan</button>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


        <!-- Main content -->

        <div class="content">

          <div class="container" align="center" style="margin-bottom:30px;">
            <div class="row">
              <div style="background-color:white; padding-top:20px; padding-right:20px; padding-left:20px; padding-bottom:50px;" class="col-md-12">
                <h4 style="text-align:left"><b>Laporan Siswa</b></h4>
                <p style="text-align:left">Berikut adalah daftar siswa yang melaporkan tindakan <i>bullying</i></p>
                <form action="laporan.php" method="POST">
                <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style='width: 130px;'>Tanggal Lapor</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Pesan</th>
                      <th style='width: 150px;'>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
	$d=mysqli_query ($koneksi,"SELECT pesan.id_pesan, pesan.nis_siswa, pesan.teks_pesan, pesan.audio_pesan, pesan.tgl_pesan, pesan.status_pesan, pesan.tindakan_pesan, siswa.nis_siswa, siswa.nama_siswa, siswa.id_kelas, kelas.id_kelas, kelas.nama_kelas, kelas.nip_guru, guru.nip_guru
FROM pesan, guru, siswa, kelas
WHERE pesan.nis_siswa=siswa.nis_siswa AND guru.nip_guru= kelas.nip_guru AND siswa.id_kelas=kelas.id_kelas AND guru.nip_guru='$_SESSION[nip]'");
    while ($res = mysqli_fetch_assoc($d)) {
		echo "<tr>";
    $oldate=$res["tgl_pesan"];
    $newdate = date("d M Y H:i:s", strtotime($oldate));
    echo "<td>$newdate</td>";
        echo "<td>".$res['nis_siswa']."</td>";
        echo "<td>".$res['nama_siswa']."</td>";
        echo "<td>".$res['nama_kelas']."</td>";
		    if ($res["teks_pesan"]!=null)
          {
            echo "<td>".$res['teks_pesan']."</td>";
          }
        else if ($res["audio_pesan"]!=null)
          {
			      echo "<td><audio controls><source src='../uploads/$res[audio_pesan]' type='audio/ogg'></audio></td>";
          }
        else
          {
            echo "<td style='color:red'><i>Tidak Ada</i></td>";
          }
        
        if ($res["status_pesan"]!=null)
          {
            echo "<td>".$res['status_pesan']."</td>";
          }
        else 
        {
        echo "<td><a href='halaman_guru.php?id=$res[id_pesan]' type='button' class='btn btn-default' data-toggle='modal' data-target='#modal-default'>
                  Beri Respon
                </a></td>";
        }
        echo "</tr>";
		}
		?>
                  </tbody>

                  </table> 
                </form>
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
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/dist/js/demo.js"></script>
    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/materialize/js/materialize.min.js"></script>
    <script type="text/javascript">
      function initAudioRecording() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
          navigator.mediaDevices.getUserMedia({
              audio: true
            })
            .then(function(stream) {
              window.mediaRecorder = new MediaRecorder(stream);
              btnRecordAudio.removeAttr('disabled');
            })
            .catch(function(err) {
              console.error(err);
              btnRecordAudio.attr('disabled', true);
            });
        } else {
          console.error("Browser not supported");
          btnRecordAudio.attr('disabled', true);
        }
      }

      function recordAudio() {
        if (typeof(mediaRecorder) != 'undefined') {
          var action = btnRecordAudio.hasClass('recording') ? 'stop' : 'record';

          if (action == 'record') {
            btnRecordAudio.children('.material-icons').html('stop');
            btnRecordAudio.removeClass('default').addClass('red');

            window.audioTracks = [];

            mediaRecorder.ondataavailable = function(e) {
              audioTracks.push(e.data);
            };

            mediaRecorder.onstop = function(e) {
              var blob = new Blob(window.audioTracks, {
                type: 'audio/ogg; codecs=opus'
              });
              var audioURL = window.URL.createObjectURL(blob);

              window.audioBlob = blob;
              player[0].src = audioURL;

              btnDownloadRecordedAudio.attr('href', audioURL);
              btnDownloadRecordedAudio.show();
              btnUploadRecordedAudio.show();

              btnPlayRecordedAudio.children('.material-icons').html('play_arrow');
              //btnPlayRecordedAudio.show();
              player.show();
              recordTiming.hide();
            };

            mediaRecorder.onstart = function() {
              setTimeout(function() {
                $('#progress').hide();
                $('#parent-recorder').show();
                window.intvlRecordTiming = setInterval(function() {
                  runRecordTimer();
                }, 1000);
              }, 1000);
            };

            mediaRecorder.start();

            btnRecordAudio.addClass('recording');

            console.log("Recording started");
            console.log(mediaRecorder.state);

            //btnPlayRecordedAudio.hide();
            btnDownloadRecordedAudio.hide();
            btnUploadRecordedAudio.hide();
            player.hide();
            recordTiming.show();
            $('#progress').show();
            $('#parent-recorder').hide();
          } else {
            btnRecordAudio.children('.material-icons').html('mic');
            btnRecordAudio.removeClass('red').addClass('default');

            clearInterval(intvlRecordTiming);
            recordTiming.html("<?= $maxRecordTime; ?>");
            mediaRecorder.stop();

            btnRecordAudio.removeClass('recording');

            console.log("Recording stopped");
            console.log(mediaRecorder.state);
          }
        }
      }

      function runRecordTimer() {
        var time = recordTiming.text();
        time = time.split(':');
        var min = Number(time[0]);
        var sec = Number(time[1]);

        if (sec <= 1) {
          if (min > 0) {
            sec = 59;
            min--;
          } else {
            sec = 0;
            clearInterval(intvlRecordTiming);
            recordTiming.html("<?= $maxRecordTime; ?>");
            btnRecordAudio.trigger('click');
            return;
          }
        } else {
          sec--;
        }

        if (sec < 10) {
          sec = "0" + sec;
        }

        if (min < 10) {
          min = "0" + min;
        }

        recordTiming.html(min + ":" + sec);
      }

      $(document).ready(function() {
        window.recorder = $('#recorder');
        window.player = $('#player');
        window.btnRecordAudio = $('#btnRecordAudio');
        window.btnPlayRecordedAudio = $('#btnPlayRecordedAudio');
        window.btnDownloadRecordedAudio = $('#btnDownloadRecordedAudio');
        window.btnUploadRecordedAudio = $('#btnUploadRecordedAudio');
        window.frmUploadAudio = $('#frmUploadAudio');
        window.recordTiming = $('#recordTiming');

        player[0].onended = function() {
          btnPlayRecordedAudio.removeClass('playing').removeClass('playing');
          btnPlayRecordedAudio.children('.material-icons').html('replay');
        };

        $('.tooltipped').tooltip();
        initAudioRecording();
      });

      $(document).on('click', '#btnRecordAudio', function(e) {
        e.preventDefault();
        recordAudio();
      });

      $(document).on('click', '#btnPlayRecordedAudio', function(e) {
        e.preventDefault();

        var playIcon = $(this).children('.material-icons');

        if ($(this).hasClass('playing')) {
          $(this).removeClass('playing');
          playIcon.html('play_arrow');
          player[0].pause();
        } else {
          playIcon.html('pause');
          $(this).addClass('playing');
          player[0].play();
        }
      });

      $(document).on('click', '#btnUploadRecordedAudio', function(e) {
        e.preventDefault();

        var data = new FormData(frmUploadAudio[0]);
        data.append('recordedFile', audioBlob);

        $('#progress').show();
        $('#parent-recorder').hide();

        $.ajax({
          url: '<?= ""; ?>',
          type: 'POST',
          data: data,
          contentType: false,
          processData: false,
          success: function(data) {
            var jsonData = JSON.parse(data);
            window.uploadMessage = jsonData.message;
          },
          error: function(error) {
            console.log(error);
          },
          complete: function(xhr, status) {
            setTimeout(function() {
              $('#progress').hide();
              $('#parent-recorder').show();
              M.toast({
                html: window.uploadMessage
              });
              delete uploadMessage;
            }, 1000);
          }
        });
      });
    </script>
  </body>

  </html>