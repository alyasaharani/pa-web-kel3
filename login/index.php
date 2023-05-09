<?php
session_start();
include '../koneksi.php';

if (!empty($_POST)) {
  $_SESSION['id'] = $_POST['id'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['name'] = $_POST['username'];
  $_SESSION['role'] = $_POST['role'];

  if ($_POST['role'] === 'user') {
    header('Location: ../menu/');
  } else if ($_POST['role'] === 'admin') {
    header('Location: ../admin/read.php');
  } else if ($_POST['role'] === 'owner') {
    header('Location: ../owner/');
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/login.css " media="screen" title="no title">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <title>Document</title>
</head>

<body>
  <br>
  <form name="login" method="post">
    <h1>Login</h1>
    <input type="text" id="username" name="username" placeholder="Masukkan Username" required /><br><br>
    <input type="password" name="password" id="password" placeholder="Masukkan Password" required /><br><br>
    <input type="hidden" id="role" name="role">
    <input type="hidden" name="id">
    <input type="submit" name="btn-submit" value="Login" />
    <p>Belum Punya Akun?
    <a href="register.php">Register disini</a>
    </p>
  </form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cash/8.1.5/cash.min.js"></script>
  <script>
    $("form[name='login']").on('submit', async (e) => {
      e.preventDefault();
      e.stopPropagation();

      const formData = new FormData();
      formData.append('username', $('#username').val());
      formData.append('password', $('#password').val());

      const response = await fetch('../api/auth/login.php', {
        method: 'POST',
        headers: {
          'Accept': '*/*',
        },
        body: formData
      });

      const res = await response.json();

      if (res.success) {
        Swal.fire({
          title: res.message,
          text: `Selamat Datang ${res.username} 👋`,
          icon: "success",
        }).then(() => {
          $('#username').val(res.username);
          $('#role').val(res.role);
          $('input[name="id"]').val(res.id);

          document.forms['login'].submit();
        });
        console.log(res);
      } else {
        Swal.fire({
          title: res.message,
          text: "Pastikan Email dan Password sesuai",
          icon: "error",
        });
      }
    })
  </script>
</body>

</html>