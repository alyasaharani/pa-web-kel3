<?php
session_start();
require "../koneksi.php";

if(isset($_POST['submit'])) {

    // get input values
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $description = $_POST['description'];

    // image upload directory
    $target_dir = "../images/";

    // generate unique image name
    $image_name = time() . '_' . basename($image);

    // move uploaded file to image directory
    $target_file = $target_dir . $image_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // insert data into database
    $query = "INSERT INTO product (name, price, image, description) VALUES ('$name', '$price', '$image_name', '$description')";
    $result = mysqli_query($mysqli, $query);

    if($result) {
        echo "<script>
                alert('Berhasil Menambahkan Data');
                window.location.href = '../admin/read.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
}
?>

<html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bakpiaku</title>
  <link href="../assets/css/main.css" rel="stylesheet">
</head>
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
    <nav id="navbar" class="navbar">
        <ul>
          <li><a href="read.php">Home</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="kotak_login">
        <p class="tulisan_login" style="font-size: 18pt;">Tambah Menu Bakpia</p>

        <form action="" method="post" enctype="multipart/form-data">
            Rasa:
            <input type="text" name="name" class="form_login">
            <br>
            Harga :
            <input type="number" name="price" class="form_login">
            <br>
            Foto :
            <input type="file" name="image" class="form_login">
            <br>
            Deskripsi :
            <textarea name="description" class="form_login"></textarea>
            <br>
            <button type="submit" name="submit" class="tombol_login">TAMBAH</button>

            <br/>
			<br/>
			<center>
				<a class="link" href="read.php">kembali</a>
			</center>
        </form>

</div>
<footer>
    <center>
    <br><p>Created by Kelompok 3 A2 | © 2023</p>
    </center>  
    </footer>
    </body>
</html>
