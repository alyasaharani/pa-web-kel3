<?php

require "../koneksi.php";

$query = "SELECT * FROM bakpia";
$result = mysqli_query($conn, $query);

?>

<html>
  <body>
      <h1>Halaman Utama</h1>
      <a href="../admin/create.php">Tambah</a>
      <table border="1" cellpadding="19" cellspacing="0">
          <tr>
            <th>No</th>
            <th>Rasa</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Ubah</th>
            <th>Hapus</th>
          </tr>
          <?php
          $i = 1;
          while( $row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td style="text-alogn: center;"><?php echo $i ?></td>
            <td><?php echo $row["rasa"] ?></td>
            <td><?php echo $row["harga"] ?></td>
            <td><?php echo $row["stok"] ?></td>
            <td><a href="../admin/update.php?id=<?php echo $row["id"] ?>">Update</a></td>
            <td><a href="../admin/delete.php?id=<?php echo $row["id"] ?>">Hapus</a></td>
          </tr>
            <?php $i++ ?>
            <?php } ?>
      </table>
    <footer>
      <p>Created by Kelompok 3 A2 | © 2023</p>
    </footer>
  </body>  
</html>