<?php
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    include('./input-config.php');
    $no = 1;
      $tabledata = "";
      $data = mysqli_query($mysqli, " SELECT * FROM data_nilai ");
      while($row = mysqli_fetch_array($data)){
            $rata_rata=($row["nilai_kehadiran"]+$row["nilai_tugas"]+$row["nilai_pts"]+$row["nilai_pas"])/4;
            $tabledata .= "
                  <tr>
                        <td>".$row["nis"]."</td>
                        <td>".$row["nama_lengkap"]."</td>
                        <td>".$row["jenis_kelamin"]."</td>
                        <td>".$row["kelas"]."</td>
                        <td>".$row["nilai_kehadiran"]."</td>
                        <td>".$row["nilai_tugas"]."</td>
                        <td>".$row["nilai_pts"]."</td>
                        <td>".$row["nilai_pas"]."</td>
                        <td>".$rata_rata."</td>dfjcnrdnures
                  </tr>
            ";
            $no++;
      }

      $waktu_cetak = date('d M Y - H:i:s');
      $table = "
            <h1>Laporan Data Nilai</h1>
            <h6>Waktu Cetak : $waktu_cetak</h6>
            <table cellpadding=5 border=1 cellspacing=0>
                  <tr>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Nilai Kehadiran</th>
                        <th>Nilai Tugas</th>
                        <th>Nilai PTS</th>
                        <th>Nilai PAS</th>
                        <th>Rata - Rata</th>
                        
                  </tr>
                  $tabledata
            </table>
      ";

    $mpdf->WriteHTML("$table");
    $mpdf->Output();
?>