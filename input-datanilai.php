<?php 
      include('./input-config.php');
      if ( $_SESSION ["login"] != TRUE){
            header ('location:login.php');
      }

      echo "<div class='container'>";
      echo "Selamat Datang, " . $_SESSION["username"] . "<br>";
      echo "Anda sebagai : " . $_SESSION["role"];
      echo "<a> - </a> <a class='btn btn-sm btn-secondary' href='logout.php'>Logout</a>";
      echo "<hr>";
      echo "<a class='btn btn-sm btn-primary' href='input-datanilai-tambah.php'>Tambah Data</a> <a> - </a>";
      echo "<a class='btn btn-sm btn-warning' href='input-datanilai-pdf.php'>Cetak PDF</a>";
      echo "<hr>";
      // READ - Menampilkan data dari database
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
                        <td>".$rata_rata."</td>
                        <td>
                              <a class='btn btn-sm btn-success' href='input-datanilai-edit.php?nis=".$row["nis"]."'>Edit</a>
                              &nbsp;-&nbsp;
                              <a class='btn btn-sm btn-danger' href='input-datanilai-hapus.php?nis=".$row["nis"]."' 
                              onclick='return confirm(\"Yakin Dek ?\");'>Hapus</a>
                        </td>
                       
                  </tr>
            ";
            $no++;
      }

      echo "
            <table class='table table-dark table-bordered table-striped'>
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
                        <th>Aksi</th>
                  </tr>
                  $tabledata
            </table>
      ";
      echo "</div>";
?>