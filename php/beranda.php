<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <li>Home</li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

        <?php
        $role = $_SESSION['role'];
        if($role == 'user'){ ?>
        <!-- Isi konten user disini -->
        <h1>Selamat datang di menu user</h1>
        <?php }

        elseif($role == 'admin') { ?>
        <!-- Isi konten admin disini -->
        <h1>Selamat datang di menu admin</h1>
        <?php }

        elseif($role == 'owner'){ ?>
        <!-- Isi konten owner disini -->
        <h1>Selamat datang di menu owner</h1>
        <?php }  ?> 
    
</body>
</html>