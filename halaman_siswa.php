<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:index.php?pesan=belum_login");
}
?>

<?php
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $result = [];
  if (isset($_FILES["recordedFile"]) && !$_FILES["recordedFile"]['error']) {
    $filesuara = date("YmdHis") . ".ogg";
    move_uploaded_file($_FILES["recordedFile"]['tmp_name'], "uploads/" . date("YmdHis") . ".ogg");
    $result["error"] = 0;
    $result["message"] = "Audio Berhasil Disimpan";
    mysqli_query($koneksi, "insert into pesan (nis_siswa,teks_pesan,audio_pesan,tgl_pesan,status_pesan,tindakan_pesan) values ('$_SESSION[nis]', '', '$filesuara','$tanggal','menunggu','')");
  } else {
    $result["error"] = 1;
    $result["message"] = "Error: " . $_FILES["recordedFile"]['error'];
  }
  echo json_encode($result);
} else {
  $maxRecordTime = "01:00";
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Siswa</title>
    <link rel="icon" href="assets/img/iconbebuli.png" sizes="16x16" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="assets/materialize/icon/icon.css" />
    <style type="text/css">
      html,
      body {
        height: 100%;
        width: 100%;
        margin: 0;
      }

      body>.main-container {
        min-height: 100%;
        width: 100%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        position: relative;
      }

      .center-child {
        text-align: center;
      }

      #progress {
        width: 50rem;
        display: none;
      }

      .progress {
        position: relative;
        height: 4px;
        display: block;
        width: 100%;
        background-color: #acece6;
        border-radius: 2px;
        margin: 0.5rem 0 1rem 0;
        overflow: hidden;
      }

      .progress .determinate {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        background-color: #26a69a;
        -webkit-transition: width .3s linear;
        transition: width .3s linear;
      }

      .progress .indeterminate {
        background-color: #26a69a;
      }

      .progress .indeterminate:before {
        content: '';
        position: absolute;
        background-color: inherit;
        top: 0;
        left: 0;
        bottom: 0;
        will-change: left, right;
        -webkit-animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
        animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
      }

      .progress .indeterminate:after {
        content: '';
        position: absolute;
        background-color: inherit;
        top: 0;
        left: 0;
        bottom: 0;
        will-change: left, right;
        -webkit-animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
        animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
        -webkit-animation-delay: 1.15s;
        animation-delay: 1.15s;
      }

      @-webkit-keyframes indeterminate {
        0% {
          left: -35%;
          right: 100%;
        }

        60% {
          left: 100%;
          right: -90%;
        }

        100% {
          left: 100%;
          right: -90%;
        }
      }

      @keyframes indeterminate {
        0% {
          left: -35%;
          right: 100%;
        }

        60% {
          left: 100%;
          right: -90%;
        }

        100% {
          left: 100%;
          right: -90%;
        }
      }

      @-webkit-keyframes indeterminate-short {
        0% {
          left: -200%;
          right: 100%;
        }

        60% {
          left: 107%;
          right: -8%;
        }

        100% {
          left: 107%;
          right: -8%;
        }
      }

      @keyframes indeterminate-short {
        0% {
          left: -200%;
          right: 100%;
        }

        60% {
          left: 107%;
          right: -8%;
        }

        100% {
          left: 107%;
          right: -8%;
        }
      }

      .btn-floating.btn-large i {
        line-height: 56px;
      }

      .btn-floating.btn-large {
        width: 56px;
        height: 56px;
        padding: 0;
      }

      .btn-large {
        height: 54px;
        line-height: 54px;
        font-size: 15px;
        padding: 0 28px;
      }

      .btn-floating {
        display: inline-block;
        color: #fff;
        position: relative;
        overflow: hidden;
        z-index: 1;
        width: 40px;
        height: 40px;
        line-height: 40px;
        padding: 0;
        background-color: #26a69a;
        border-radius: 50%;
        -webkit-transition: background-color .3s;
        transition: background-color .3s;
        cursor: pointer;
        vertical-align: middle;
      }

      .btn,
      .btn-large,
      .btn-small {
        text-decoration: none;
        color: #fff;
        background-color: #26a69a;
        text-align: center;
        letter-spacing: .5px;
        -webkit-transition: background-color .2s ease-out;
        transition: background-color .2s ease-out;
        cursor: pointer;
      }

      .btn,
      .btn-large,
      .btn-small,
      .btn-floating,
      .btn-large,
      .btn-small,
      .btn-flat {
        font-size: 14px;
        outline: 0;
      }

      .btn,
      .btn-large,
      .btn-small,
      .btn-flat {
        border: none;
        border-radius: 2px;
        display: inline-block;
        height: 36px;
        line-height: 36px;
        padding: 0 16px;
        text-transform: uppercase;
        vertical-align: middle;
        -webkit-tap-highlight-color: transparent;
      }

      .waves-effect {
        position: relative;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
        vertical-align: middle;
        z-index: 1;
        -webkit-transition: .3s ease-out;
        transition: .3s ease-out;
      }

      .material-tooltip {
        padding: 10px 8px;
        font-size: 1rem;
        z-index: 2000;
        background-color: transparent;
        border-radius: 2px;
        color: #fff;
        min-height: 36px;
        line-height: 120%;
        opacity: 0;
        position: absolute;
        text-align: center;
        max-width: calc(100% - 4px);
        overflow: hidden;
        left: 0;
        top: 0;
        pointer-events: none;
        visibility: hidden;
        background-color: #323232;
      }

      .material-icons {
  text-rendering: optimizeLegibility;
  -webkit-font-feature-settings: 'liga';
     -moz-font-feature-settings: 'liga';
          font-feature-settings: 'liga';
}
    </style>
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
           
            <h3 align="center">Selamat Datang, <i><b><?php echo $ds['nama_siswa']; ?></b></i> </h3>
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
                <form action="laporan.php" method="POST">
                  <div class="form-group">
                    <textarea name="tekspesan" class="form-control" rows="5" placeholder="Masukkan Disini..."></textarea>
                  </div>
                  <button type="submit" name="kirim_pesan" class="btn btn-info"><span class="fas fa-paper-plane "></span> Kirim Pesan</button>
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
                <div id="progress">
                  <div class="progress">
                    <div class="indeterminate"></div>
                  </div>
                </div>
                <div class="center-child" id="parent-recorder">
                  <audio id="recorder" style="display: none;"></audio>
                  <div id="parent-player">
                    <audio id="player" controls style="display: none;"></audio>
                    <span id="recordTiming"><?= $maxRecordTime; ?></span>
                    <br><br>
                  </div>

                  <a class="waves-effect waves-light btn-floating btn-large default" id="btnRecordAudio">
                    <i class="large material-icons">mic</i>
                  </a>

                  <a class="waves-effect waves-light btn-floating btn-large default" id="btnPlayRecordedAudio" style="display: none;">
                    <i class="large material-icons">play_arrow</i>
                  </a>

                  <a class="waves-effect waves-light btn-floating btn-large default tooltipped" id="btnDownloadRecordedAudio" download data-position="right" data-tooltip="Download" style="display: none;">
                    <i class="large material-icons">file_download</i>
                  </a>

                  <a class="waves-effect waves-light btn-floating btn-large default tooltipped" id="btnUploadRecordedAudio" data-tooltip="Upload to Server" style="display: none;">
                    <i class="large material-icons">cloud_upload</i>
                  </a>

                  <form method="POST" enctype="multipart/form-data" id="frmUploadAudio" style="display: none;"></form>
                </div>
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
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/materialize/js/materialize.min.js"></script>
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
            alert('Audio berhasil diunggah!');
            setTimeout(function() {
              window.location.href = 'laporan.php';
            }, 1000);
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
<?php
}
?>