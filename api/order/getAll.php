<?php
require('../../koneksi.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $user_id = $_GET['id'];
  try {
    $data = array();
    $orders = $mysqli->query("SELECT order.id, order.total_price, order.status, user.username FROM `order` INNER JOIN user ON order.user_id=user.id WHERE order.user_id='$user_id'");

    while ($order = mysqli_fetch_array($orders)) {
      $dataOrder = array();
      $id = $order['id'];
      $order_products = $mysqli->query("SELECT op.id, op.amount, op.total, p.name, p.price FROM order_product op INNER JOIN product p ON op.product_id=p.id WHERE op.order_id ='$id'");

      while ($op = mysqli_fetch_array($order_products)) {
        array_push($dataOrder, [
          'id' => $op['id'],
          'amount' =>  $op['amount'],
          'total' => $op['total'],
          'name' => $op['name'],
          'price' => $op['price'],
        ]);
      }

      array_push($data, [
        'id' => $order['id'],
        'username' => $order['username'],
        'total_price' => $order['total_price'],
        'status' => $order['status'],
        'orderProduct' => $dataOrder,
      ]);
    };

    if ($orders) {
      echo json_encode(array(
        'success' => true,
        'message' =>  "Berhasil Get Pesanan",
        'data' => $data,
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Gagal Get Pesanan"
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' =>  "Terjadi Kesalahan Get Pesanan" . $th
    ));
  }
} else {
  header("Location: /tiket");
}
