<?php
session_start();
require('koneksi.php');
var_dump($_SESSION);

$products = $mysqli->query("SELECT * FROM product");

$isUpdate = false;

if (isset($_GET['update'])) {
  $id = $_GET['update'];
  $product = query("SELECT * FROM product WHERE id='$id'");
  $isUpdate = $product !== null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <title>Produk</title>
</head>

<body>
  <?php include('components/Navbar.php') ?>
  <main class="container mt-5">

    <?php if ($isUpdate && $_SESSION['role'] === 'admin') : ?> <!-- Update -->
      <div class="px-4 py-5 my-5 ">
        <h1 class="display-6 fw-bold">Update Produk</h1>
        <form id="update-form-product" name="update-form-product" action="produk.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Nama Barang</label>
            <input type="text" value="<?= $product['name'] ?>" class="form-control" id="name" placeholder="Masukkan Nama Barang">
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Harga Barang</label>
            <input type="number" value="<?= $product['price'] ?>" class="form-control" id="price" placeholder="Masukkan Harga">
          </div>
          <div class="mb-3">
            <p class="form-label">Gambar</p>
            <label for="image">
              <img class="img img-thumbnail" width="120px" accept="image/*" src="<?= $product['image'] ?>">
            </label>
            <input style="display: none;" id="image" class="input" name="image" type="file" placeholder="Contoh: Sapi">
          </div>
          <div aria-level="desc" class="mb-3">
            <label for="price" class="form-label">Deskripsi</label>
            <div class="" id="editor"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
        </form>
      </div>
    <?php elseif (isset($_GET['add']) && $_SESSION['role'] === 'admin') : ?> <!-- Add -->
      <div class="px-4 py-5 my-5 ">
        <h1 class="display-6 fw-bold">Tambah Produk</h1>
        <form id="form-product" name="form-product" action="produk.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Barang">
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Harga Barang</label>
            <input type="number" class="form-control" id="price" placeholder="Masukkan Harga">
          </div>
          <div class="mb-3">
            <p class="form-label">Gambar</p>
            <label for="image">
              <img class="img img-thumbnail" width="120px" accept="image/*" src="img/placeholder.png">
            </label>
            <input style="display: none;" id="image" class="input" name="image" type="file" placeholder="Contoh: Sapi">
          </div>
          <div aria-level="desc" class="mb-3">
            <label for="price" class="form-label">Deskripsi</label>
            <div class="" id="editor"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
        </form>
      </div>
    <?php else : ?> <!-- List Product -->
      <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="display-5 fw-bold">Produk</h1>
        <div class="col-lg-6 mx-auto">
          <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a id="add" type="button" href="produk.php?add" class="btn btn-primary btn-lg px-4 gap-3">Tambah Produk</a>
            <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
          </div>
        </div>
      </div>
      <div class="row">
        <?php while ($product = mysqli_fetch_array($products)) : ?>
          <div class="col-sm-6 mb-5 mb-sm-0">
            <div class="card">
              <div class="card-img-top" style="background-image: url('<?= $product['image'] ?>'); background-size: cover; height: 400px; background-position: center;"></div>
              <!-- <img src="<?= $product['image'] ?>" style="max-height: 200px;" class="card-img-top" alt="..."> -->
              <div class="card-body">
                <h5 class="card-title"><?= $product['name'] ?></h5>
                <p class="card-text"><?= currency($product['price']) ?></p>
                <a href="produk.php?id=<?= $product['id'] ?>" class="btn btn-primary">Lihat Detail</a>
                <?php if ($_SESSION['role'] === 'admin') : ?>
                  <a href="produk.php?update=<?= $product['id'] ?>" class="btn btn-warning">Edit</a>
                  <button data-name="<?= $product['name'] ?>" data-id="<?= $product['id'] ?>" class="btn btn-danger del-btn">Hapus</a>
                  <?php endif ?>
              </div>
            </div>
          </div>
        <?php endwhile ?>
      </div>
    <?php endif ?>
  </main>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cash/8.1.5/cash.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <?php if (isset($_GET['add']) || $isUpdate) : ?>
    <script src="add-product.js"></script>
  <?php endif ?>

  <?php if ($isUpdate) : ?>
    <script>
      quill.root.innerHTML = '<?= $product['description'] ?>';

      $('#update-form-product').on('submit', async (e) => {
        e.preventDefault();
        e.stopPropagation();

        const input = document.querySelector('#image');

        const formData = new FormData();
        formData.append('id', '<?= $id ?>')
        formData.append('image', input.files[0]);
        formData.append('name', $('#name').val());
        formData.append('price', $('#price').val());
        formData.append('desc', quill.root.innerHTML);

        const response = await fetch('api/product/update.php', {
          method: "POST",
          headers: {
            'Accept': '*/*',
          },
          body: formData
        });
        const res = await response.json();

        if (res.success) {
          Swal.fire({
            title: res.message,
            icon: "success",
          }).then(() => {
            // window.location.replace('produk.php')
          });
        } else {
          Swal.fire({
            title: res.message,
            icon: "error",
          });
        }
        console.log(res);
      })
    </script>
  <?php endif ?>


  <script>
    $('#form-product').on('submit', async (e) => {
      e.preventDefault();
      e.stopPropagation();

      const input = document.querySelector('#image');

      const formData = new FormData();
      <?php if ($isUpdate) : ?>
        formData.append('id', $('#id').val());
      <?php endif ?>
      formData.append('image', input.files[0]);
      formData.append('name', $('#name').val());
      formData.append('price', $('#price').val());
      formData.append('desc', quill.root.innerHTML);

      const response = await fetch('api/product/add.php', {
        method: "POST",
        headers: {
          'Accept': '*/*',
        },
        body: formData
      });

      const res = await response.json();

      if (res.success) {
        Swal.fire({
          title: res.message,
          icon: "success",
        }).then(() => {
          // window.location.replace('produk.php')
        });
      } else {
        Swal.fire({
          title: res.message,
          icon: "error",
        });
      }
      console.log(res);

    });

    <?= $_SESSION['role'] === 'admin' ?>
    $('.del-btn').on('click', function() {
      const id = $(this).data('id');
      const name = $(this).data('name');

      Swal.fire({
        title: `Yakin ingin Mengahapus Produk '${name}?'`,
        text: 'Produk yang sudah dihapus tidak dapat dikembalikan',
        icon: 'warning',
        confirmButtonText: 'Ya, Hapus',
        showDenyButton: true,
        denyButtonText: `Tidak, jangan hapus`,
      }).then(async (result) => {
        if (result.isConfirmed) {
          const formData = new FormData();
          formData.append('id', id);

          const res = await fetch(`api/product/delete.php`, {
            method: 'POST',
            headers: {
              'Accept': '*/*',
            },
            body: formData,
          });

          const data = await res.json()

          if (data.success) {
            Swal.fire({
              title: data.message,
              icon: 'success'
            }).then(() => window.location.reload());

          } else {
            Swal.fire({
              title: data.message,
              icon: 'error'
            })
          }
          console.log(data);

        }
      })
    })
  </script>
</body>

</html>