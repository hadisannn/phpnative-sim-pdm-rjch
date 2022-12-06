<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../sign/user_sign_in.php");
  exit;
}

if($_SESSION["level"] === "Admin") {
  echo "<script>alert('Anda Tidak Dapat Mengakses Halaman Ini');document.location.href = '../../index-admin.php';</script>";
}
if($_SESSION["level"] === "Partisipan") {
  echo "<script>alert('Anda Tidak Dapat Mengakses Halaman Ini');document.location.href = '../../index-partisipan.php';</script>";
}
if($_SESSION["level"] === "Pengajar") {
  echo "<script>alert('Anda Tidak Dapat Mengakses Halaman Ini');document.location.href = '../../index-pengajar.php';</script>";
}

require_once __DIR__ . '/../../vendor/autoload.php';
require "../user_admin/peserta/peserta_functions.php";

$peserta = queryTampilPeserta("SELECT * FROM tbjoin_pesertapendaftar");
$stylesheet = file_get_contents('../../src/css/print.css');
$mpdf = new \Mpdf\Mpdf();

$html = '
        <!DOCTYPE html>
          <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title></title>
            </head>
            <body>
              <img src="../../src/img/logo-rjch-circle.png" width="75px">
              <h2>LAPORAN DATA PESERTA <br> PELATIHAN DIGITAL MARKETING <br> PT. RAJAWALI CIPTA HARAPAN</h2>
              <br>
              <center>
              <table border="1" cellpadding="10" cellspacing="0" width="500px">
                <tr>
                  <th>NO</th>
                  <th>Kode Partisipan</th>
                  <th>Nama Peserta</th>
                  <th>Nama Kelas</th>
                </tr>';
              $i = 1;
              foreach($peserta as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["kode_partisipan"] .'</td>
                  <td>'. $row["nama_pendaftar"] .'</td>
                  <td>'. $row["nama_kelas"] .'</td>
                </tr>';
              }
$html .= '
              </table>
              <div class="ttd">
                <div class="mengetahui">Mengetahui,</div>
                <div class="nama">ZUL FAHMI</div>
                <div class="jabatan">Direktur Utama</div>
              </div>
            </body>
          </html>';

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Laporan Data Peserta.pdf', \Mpdf\Output\Destination::INLINE);

?>

