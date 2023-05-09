<?php
session_start();
require "../koneksi.php";

$id = $_GET["id"];

$query = "SELECT * FROM product WHERE id = '$id'";
$result = mysqli_query($mysqli, $query);

if( !isset($_GET["id"]) ){
    header("Location: ../admin/read.php");
    exit;
}else if( mysqli_num_rows( $result ) == 1 ){

}else{
    header("Location: ../admin/read.php");
    exit;
}

function updateProduct($id, $name, $price, $image, $description){
    global $mysqli;

    $query = "UPDATE product SET 
                name = '$name', 
                price = '$price', 
                image = '$image', 
                description = '$description' 
                WHERE id = '$id'";
    mysqli_query($mysqli, $query);
    return mysqli_affected_rows($mysqli);
}

if( isset($_POST["update"]) ){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $description = $_POST["description"];

    if( updateProduct($id, $name, $price, $image, $description) > 0 ){
        echo "<script>
                alert('Berhasil Mengubah Data');
                document.location.href = '../admin/read.php';
                </script>";
    }else{
    echo "<script>
            alert('Gagal Mengubah Data');
            </script>";
    }
}

?>

<html>
    <style>
        body{
	font-family: sans-serif;
	background: #d5f0f3;
}
 
h1{
	text-align: center;
	/*ketebalan font*/
	font-weight: 300;
}
 
.tulisan_login{
	text-align: center;
	/*membuat semua huruf menjadi kapital*/
	text-transform: uppercase;
}
 
.kotak_login{
	width: 350px;
	background: white;
	/*meletakkan form ke tengah*/
	margin: 80px auto;
	padding: 30px 20px;
}
 
label{
	font-size: 11pt;
}
 
.form_login{
	/*membuat lebar form penuh*/
	box-sizing : border-box;
	width: 100%;
	padding: 10px;
	font-size: 11pt;
	margin-bottom: 20px;
}
 
.tombol_login{
	background: #46de4b;
	color: white;
	font-size: 11pt;
	width: 100%;
	border: none;
	border-radius: 3px;
	padding: 10px 20px;
}
 
.link{
	color: #232323;
	text-decoration: none;
	font-size: 10pt;
}
    </style>
    <body>
        <div class="kotak_login">
        <h1 class="tulisan_login">Ubah Data Bakpia</h1>
        <form action="" method="post">
            <?php while( $row = mysqli_fetch_assoc($result)) {?>
            <input type="hidden" name="id" class="form_login" value="<?php echo $row['id']?>">
            Nama :
            <input type="text" name="name" class="form_login" value="<?php echo $row['name']?>">
            <br>
            Harga :
            <input type="text" name="price" class="form_login" value="<?php echo $row['price']?>">
            <br>
            Gambar :
            <input type="file" name="image" class="form_login" value="<?php echo $row['image']?>">
            <br>
            Deskripsi :
            <textarea name="description" class="form_login"><?php echo $row['description']?></textarea>
            <br>
            <button type="submit" name="update" class="tombol_login">UPDATE</button>
            <?php } ?>
        </form>
            </div>
        <footer>
            <p>Created by Kelompok 3 A2 | © 2023</p>
        </footer>
    </body>
</html>
