<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Laporan Dompdf Codeigniter</title>
</head>
<body>
  <h3><center>DAFTAR PEGAWAI AYONGODING.COM</center></h3>
  <table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Pegawai</th>
        <th>Alamat</th>
        <th>Telp</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no=0;
      foreach ($pegawai as $data) {
        $no++;
        echo "<tr>";
          echo "<td><center>".$no."</center></td>";
          echo "<td>".$data->nama."</td>";
          echo "<td>".$data->alamat."</td>";
          echo "<td>".$data->telp."</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</body>
</html>