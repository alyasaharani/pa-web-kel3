<?php
require "../koneksi.php";
session_start();

$user_id = $_SESSION['id'];
$products = $mysqli->query("SELECT * FROM product");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM product WHERE id = ?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

echo "<script>
    alert('Berhasil Menghapus Data');
    window.location.href = '../admin/read.php';
</script>";
?>
