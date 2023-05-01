<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAKPIA LEZAT</title>
</head>
<body>
    <?php
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php"); // redirect ke halaman login jika belum login
        exit();
    }
    ?>
    <!-- loader -->
    <div class="bg-loader">
        <div class="loader"></div>
    </div>

    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="beranda_admin.php">Menu Admin</a></h1>
            <ul>
                <li><a href="beranda_admin.php">HOME</a></li>
                <li class="active"><a href="../admin/read.php">BAPIA</a></li>
                <li><a href="../logout.php">Log Out (<?php echo $_SESSION['username']; ?>)</a></li>
            </ul>
        </div>
    </header>

    <!-- label -->
    <section class="label">
        <div class="container">
            <p>HOME / BERANDA</p>
        </div>
    </section>
        <ul>
        <?php
            $role = $_SESSION['role'];
            if($role == 'admin'){ ?>
            <!-- Isi konten admin disini -->
            <h1>Selamat datang di menu admin</h1>
            <?php }?> 
    <footer>
        <p>Created by Kelompok 3 A2 | © 2023</p>
    </footer>
    </body>
</html>