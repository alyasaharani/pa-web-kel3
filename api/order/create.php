<?php
require('../../koneksi.php');

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = esc_string($_POST['user_id']);
  $total_price = esc_string($_POST['total_price']);
  $orders = json_decode($_POST['orders'], true);

  try {
    if ($user_id == '1' || $user_id == '2' || !$user_id) {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Hanya User yang bisa menambahkan pesanan"
      ));
      return;
    }
    // date_default_timezone_set("Asian/Kuala Lumpur");
    // $date = date('Y/m/d');
    $res = false;

    $res_order = $mysqli->query("INSERT INTO `order` (user_id, total_price, status) VALUES ('$user_id', '$total_price', 'progress')");
    $order_id = mysqli_insert_id($mysqli);


    foreach ($orders as $order) {
      $product_id = $order['id'];
      $amount = $order['amount'];
      $total = $order['total'];
      $mysqli->query("INSERT INTO order_product (order_id, product_id, amount, total) VALUES ('$order_id', '$product_id', '$amount', '$total')");
    }

    $res = true;

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' =>  "Berhasil Menambahkan Pesanan"
      ));
      return;
    } else {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Gagal Menambahkan Pesanan"
      ));
    }
    return;
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' =>  "Terjadi Kesalahan Saat Menambahkan Pesanan" . $th,
    ));
    return;
  }
} else {
  header("Location: /tiket");
}
