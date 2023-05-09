<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'pa_web');


function query($query) {

  global $mysqli;
  $query = $mysqli->query($query);
  $res = mysqli_fetch_array($query);

  return $res;
}

function esc_string($field) {
  global $mysqli;
  $res = mysqli_real_escape_string($mysqli, $field);
  return $res;
}

function currency($num) {
  return "Rp " . number_format($num, 0, ',', '.');
}