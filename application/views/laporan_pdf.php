<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>
    </head>

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


</html>
