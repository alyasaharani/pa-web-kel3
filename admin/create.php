<?php
require "../koneksi.php";

if(isset($_POST["create"])){
    $rasa = $_POST["rasa"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    $query = "INSERT INTO bakpia (rasa, harga, stok) 
              VALUES ('$rasa', '$harga', '$stok')";
    if(mysqli_query($conn, $query)){
        echo "<script>
                alert('Berhasil Menambahkan Data');
                document.location.href = '../admin/read.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<html>
    <body>
        <h1>Tambah Data</h1>
        <form action="" method="post">
            Rasa:
            <input type="text" name="rasa">
            <br>
            Harga :
            <input type="text" name="harga">
            <br>
            Stok :
            <input type="text" name="stok">
            <br>
            <button type="submit" name="create">TAMBAH</button>
        </form>
        <footer>
            <p>Created by Kelompok 3 A2 | © 2023</p>
        </footer>
    </body>
</html>