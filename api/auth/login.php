<?php
include '../../koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = esc_string($_POST['username']);
  $password = esc_string($_POST['password']);

  try {
    $user = query("SELECT *  FROM user where username='$username' and password='$password'");

    if (!$user) {
      echo json_encode(array('success' => false, 'message' => 'Gagal Login', 'email' => $_POST));
      return;
    }
    $res = array(
      'success' => true,
      'message' => 'Berhasil Login',
      'id' => $user['id'],
      'username' => $user['username'],
      'email' => $user['email'],
      'role' => $user['role']
    );
    echo json_encode($res);
  } catch (\Throwable $th) {
    echo json_encode(array('success' => false, 'message' => 'Terjadi Kesalahan' . $th));
    return;
  }
}
