<?php
require('../../koneksi.php');
header('Content-Type: application/json');
header('Content-Type: multipart/form-data');

function random_filename($length, $directory = '', $extension = '') {
  // default to this files directory if empty...
  $dir = !empty($directory) && is_dir($directory) ? $directory : dirname(__FILE__);

  do {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
      $key .= $keys[array_rand($keys)];
    }
  } while (file_exists($dir . '/' . $key . (!empty($extension) ? '.' . $extension : '')));

  return $key . (!empty($extension) ? '.' . $extension : '');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $id = esc_string($_POST['id']);
    $name = esc_string($_POST['name']);
    $price = esc_string($_POST['price']);
    $desc = esc_string($_POST['desc']);

    $file_name =  $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp =  $_FILES['image']['tmp_name'];
    $file_type =  $_FILES['image']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $extensions = array("jpeg", "jpg", "png");

    if (!in_array($file_ext, $extensions) && $file_name) {
      echo json_encode(array(
        'success' => false,
        'message' => 'Ekstensi File harus jpeg, jpg, atau png'
      ));
      return;
    }

    if ($file_size > 2097152 && $file_name) {
      echo json_encode(array(
        'success' => false,
        'message' => 'Gambar Tidak Boleh Lebih dari 2MB'
      ));
      return;
    }

    $res = false;

    if ($file_name) {
      $filename =  random_filename(30, '../../', $file_ext);

      $moved = move_uploaded_file($file_tmp, "../../img/" . $filename);

      $animal_old = query("SELECT image FROM product WHERE id='$id'");
      $isRemoved = unlink('../../' . $animal_old['image']);

      if ($isRemoved)
        $res = $mysqli->query("UPDATE product SET name='$name', price='$price', description='$desc', image='img/$filename' WHERE id='$id'");
    } else {
      $res = $mysqli->query("UPDATE product SET name='$name', price='$price', description='$desc' WHERE id='$id'");
    }

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' =>  "Berhasil Update Data Produk",
      ));
      return;
    } else {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Gagal Update Data Produk",
      ));
      return;
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Terjadi Kesalahan' . $th
    ));
    return;
  }
} else {
  header("Location: produk.php");
}
