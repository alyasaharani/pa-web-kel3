<?php
require('../koneksi.php');
session_start();
$user_id = $_SESSION['id'];
$products = $mysqli->query("SELECT * FROM product");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Menu</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">

  <!-- BS Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    .product {
      position: relative;
    }

    .btn {
      background: var(--color-primary);
      border: 0;
      padding: 10px 40px;
      color: #fff;
      transition: 0.4s;
      border-radius: 50px;
    }

    .btn:hover {
      background: var(--color-primary);
      color: #fff;
    }

    .check-icon {
      display: none;
      position: absolute;
      top: 3px;
      left: 6px;
      color: var(--color-primary);
      font-size: 1.5rem;
    }

    .amount {
      display: none;
      position: absolute;
      width: 4rem;
      top: 3px;
      right: 6px;
    }

    .product-cb:checked~.check-icon {
      display: block;
    }

    .product-cb:checked~.amount {
      display: block;
    }

    .sum {
      padding: 8rem 2rem 0;
      position: fixed;
      top: 0;
      height: 100%;
      left: -400px;
      transition: left .5s ease;
      font-size: 14px;
      background-color: white;
      padding: 50px 0;
      color: black;
    }

    .sum.show {
      left: 0;
      transition: left .5s ease;
    }
  </style>

</head>

<body>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/bakpia 2.jpg" alt="">
        <h1>Bakpiaku<span></span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="../pesanan">Pesanan</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav><!-- .navbar -->

      <a class="" href=""></a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header>
  <main id="main">
    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu d-flex align-items-center mt-5">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Our Menu</h2>
          <p>Check Our <span>Bakpiaku <?= $_SESSION['id'] ?></span></p>
        </div>
        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
          <div class="tab-pane fade active show" id="menu-starters">
            <div class="tab-header text-center">
              <p>Menu</p>
            </div>
            <div class="row gap-2 gy-5 justify-content-center">
              <?php while ($product = mysqli_fetch_array($products)) : ?>
                <label for="product-<?= $product['id'] ?>" data-id="<?= $product['id'] ?>" class="product shadow-sm col-lg-3 menu-item">
                  <!-- Price -->
                  <input class="product-cb" type="checkbox" hidden data-id="<?= $product['id'] ?>" data-name="<?= $product['name'] ?>" value="<?= $product['price'] ?>" name="product[]" id="product-<?= $product['id'] ?>">
                  <!-- Checked -->
                  <i class="bi bi-check-circle-fill check-icon"></i>
                  <!-- Amount -->
                  <input data-id="<?= $product['id'] ?>" class="form-control form-control-sm amount amount-<?= $product['id'] ?>" min="1" value="1" max="999" type="number" placeholder="Qty" aria-label=".form-control-sm example">
                  <img src="../<?= $product['image'] ?>" class="menu-img img-fluid" alt="">
                  <h4><?= $product['name'] ?></h4>
                  <p class="ingredients">
                    <?= $product['description'] ?>
                  </p>
                  <p class="price">
                    <?= currency($product['price']) ?>
                  </p>
                </label>
              <?php endwhile ?>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Menu Section -->
  </main><!-- End #main -->
  <div id="sum" class="sum shadow-lg ">
    <div style="height: 100%;" class="d-flex mt-5 pb-3 flex-column justify-content-between px-3">
      <div class="container d-flex flex-column product-sum"">
      </div>
      <div class=" d-flex justify-content-between align-items-center">
        <div>Total <strong class="total-text">Rp.20000</strong></div>
        <button type="button" class="btn" id="btn-order">Pesan</button>
        <input type="hidden" class="total" name="total">
      </div>
    </div>

  </div>
  <!-- ======= Footer ======= -->
  <!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <!-- Cash (Jquery but smaller) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cash/8.1.5/cash.min.js"></script>

  <!-- Swal -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <script>
    function currency(duit) {
      return Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0
      }).format(parseFloat(duit));
    }

    function countTotal() {
      let totalReal = 0;
      const html = $('input[type="checkbox"]:checked').map(function(_, i) {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const price = $(this).val();
        const amount = $(`.amount-${id}`).val();
        const total = amount * price;
        totalReal += total;
        return `<p style="margin-right: 10px">
          ${name}  
          ${currency(price)} x <span id='amount-text-${id}'>${amount}</span> = <b id="total-text-${id}">${currency(total)}</b>
          </p>`
      }).get();

      $('.total-text').html(currency(totalReal));
      $('.total').val(totalReal);
      return html;
    }

    // Event ketika produk ditekan 
    $('.product-cb').on('change', function(e) {
      const length = $('.product-cb:checked').length;
      if (length > 0 && !$('.sum').hasClass('show')) {
        $('.sum').addClass('show');
      } else if (length == 0 && $('.sum').hasClass('show')) {
        $('.sum').removeClass('show');
      }

      const html = countTotal();

      $('.product-sum').html(html.join(''));
    });

    // Event ketika jumlah pesanan diubah
    $(document).on('change', '.amount', function() {
      console.log("Maka")
      const id = $(this).data('id');
      const price = $(`#product-${id}`).val();
      const amount = $(this).val();
      const total = price * amount;
      console.log(price, amount);

      // Change amount
      $(`#amount-text-${id}`).html(amount);

      // Change Total
      $(`#total-text-${id}`).html(currency(total));

      countTotal();
    });

    // Event Ketika Tombol Pesan Ditekan
    $('#btn-order').on('click', () => {
      Swal.fire({
        title: `Yakin ingin Menambahkan Pesanan`,
        icon: 'warning',
        confirmButtonText: 'Ya, Pesan Makanan',
        showDenyButton: true,
        denyButtonText: `Tidak, Ntar Duls`,
      }).then(async (r) => {
        if (r.isConfirmed) {
          const orders = $('input[type="checkbox"]:checked').map(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).val();
            const amount = $(`.amount-${id}`).val();
            const total = amount * price;
            return {
              id,
              amount,
              name,
              price,
              total,
            }
          }).get();

          const body = new FormData();
          body.append('user_id', <?= $_SESSION['id'] ?? '1' ?>);
          body.append('total_price', $('.total').val());
          body.append('orders', JSON.stringify(orders));

          const res = await fetch('../api/order/create.php', {
            method: 'POST',
            headers: {
              'Accept': '*/*',
            },
            body,
          });

          const data = await res.json();

          if (data.success) {
            Swal.fire({
              title: data.message,
              icon: 'success'
            })
          } else {
            Swal.fire({
              title: data.message,
              icon: 'error'
            })
          }
        }

      })
    })
  </script>

</body>

</html>