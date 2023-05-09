<?php
require('../../koneksi.php');
header('Content-Type: application/json');
header('Content-Type: multipart/form-data');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = esc_string($_POST['id']);

  try {
    $res = $mysqli->query("DELETE FROM product WHERE id='$id'");

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' => 'Berhasil Mengahapus Produk',
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' => 'Gagal Menghapus Produk',
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Terjadi Kesalahan Saat Menghapus Produk' . $th,
    ));
  }
}
