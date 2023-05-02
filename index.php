<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Document</title>
</head>
<body>
    <br>
      <form action="" method="post">
      <h1>Login</h1>
        <input type="text" name="user" placeholder="Masukkan Username" required /><br><br>
        <input type="password" name="pass" placeholder="Masukkan Password" required /><br><br>
        <input type="submit" name="login" value="Login" />
      </form>
      <?php
       if(isset($_POST['login'])){
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $pass = $_POST['pass'];
        $data_user = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$user' AND password = '$pass'");
        $result = mysqli_fetch_array($data_user);
        $username = $result['username'];
        $password = $result['password'];
        $role = $result['role'];
        if($user == $username && $pass == $password){
            $_SESSION['role']= $role;
            header('location:beranda.php');
            exit();
        } else{
            echo "<script>alert('Maaf akun yang anda inputkan tidak cocok')</script>"; 
        }
       }
      ?>
</body>
</html>
