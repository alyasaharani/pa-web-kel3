<?php
session_start();
include '../koneksi.php';

// check if the connection is successful
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}

// query to retrieve data from database
$query = "SELECT * FROM product";
$result = mysqli_query($mysqli, $query);


?>


<html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bakpiaku</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="../assets/css/main.css" rel="stylesheet">
</head>
<style>
  body{
    font-family: Poppins;
}

.header {
    background: rgba(220, 220, 220, 0.7);
    background-size: 3000pt;
    padding: 15px;
    font-family: Poppins;
    font-size: 18px;
    color: black;
    font-weight: bold;
    text-align: center;
    text-shadow: rgb(99, 96, 91) 1px 1px 1px;
  }
 
table {
  font-family: Poppins;
  color: #666;
  text-shadow: 1px 1px 0px #fff;
  background: #eaebec;
  border: #ccc 1px solid;
}
 
table th {
  padding: 15px 35px;
  border-left:1px solid #e0e0e0;
  border-bottom: 1px solid #e0e0e0;
  background: #ededed;
}
 
table th:first-child{  
  border-left:none;  
}
 
table tr {
  text-align: center;
  padding-left: 20px;
}
 
table td:first-child {
  text-align: left;
  padding-left: 20px;
  border-left: 0;
}
 
table td {
  padding: 15px 35px;
  border-top: 1px solid #ffffff;
  border-bottom: 1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;
  background: #fafafa;
  background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
  background: -moz-linear-gradient(top, #fbfbfb, #fafafa);
}
 
table tr:last-child td {
  border-bottom: 0;
}
 
table tr:last-child td:first-child {
  -moz-border-radius-bottomleft: 3px;
  -webkit-border-bottom-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
 
table tr:last-child td:last-child {
  -moz-border-radius-bottomright: 3px;
  -webkit-border-bottom-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
 
table tr:hover td {
  background: #f2f2f2;
  background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
  background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0);
}

.footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px; /* Set the fixed height of the footer here */
    line-height: 60px; /* Vertically center the text there */
    background-color: #f5f5f5;
  }
</style>
  <body>
  <nav id="navbar" class="navbar">
        <ul>
          <li><a href="../admin/read.php">Admin Bakpiaku</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav><!-- .navbar -->

      <center><div class="header">
      <h1>Data Bakpia</h1>
    </div></center>
      <hr>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="../admin/create.php" role="button">Tambah Menu</a>
      <br><br>
      <center><table border="1" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Ubah</th>
            <th>Hapus</th>
          </tr>
        </thead>
          
          <?php
          while( $row = mysqli_fetch_assoc($result)) { ?>
          <tbody>
          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["price"] ?></td>
            <td><img src="<?php echo $row["image"] ?>" width="100"></td>
            <td><?php echo $row["description"] ?></td>
            <td><a href="../admin/update.php?id=<?php echo $row["id"] ?>">Ubah</a></td>
            <td><a href="../admin/delete.php?id=<?php echo $row["id"] ?>">Hapus</a></td>
          </tr>
          </tbody>
          
          <?php } ?>
      </table></center>
      </div>

    <footer>
    <center>
    <br><p>Created by Kelompok 3 A2 | © 2023</p>
    </center>  
    </footer>
  </body>  
</html>

<?php
// close database connection
mysqli_close($mysqli);
?>
