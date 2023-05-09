<?php
require('../koneksi.php');
session_start();



$user_id = $_SESSION['id'];
$orders = $mysqli->query("SELECT order.id, order.total_price, order.status, user.username FROM `order` INNER JOIN user ON order.user_id=user.id WHERE order.user_id='$user_id'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pesanan</title>
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

  <!-- Table -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

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
          <li><a href="../menu">Home</a></li>
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
    <section id="pesanan" class="menu d-flex align-items-center mt-5">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Pesanan </h2>
          <p>Cek Pesanan <span>Bakpiaku <?= $_SESSION['id'] ?></span></p>
        </div>
        <table class="table" id="orderTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Pemesan</th>
              <th scope="col">Total</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
            function status($status) {
              if ($status === 'progress') {
                return array('color' => 'warning', 'text' => 'Proses');
              } else if ($status === 'success') {
                return array('color' => 'success', 'text' => 'Sukses');
              } else if ($status === 'cancelled') {
                return array('color' => 'danger', 'text' => 'Gagal');
              }
            }
            $index = 1;
            while ($order = mysqli_fetch_array($orders)) : ?>
              <tr>
                <th scope="row"><?= $index ?></th>
                <td><?= $order['username'] ?></td>
                <td><?= currency($order['total_price'])  ?></td>
                <td>
                  <span class="badge text-bg-<?= status($order['status'])['color'] ?>">
                    <?= status($order['status'])['text'] ?>
                  </span>
                </td>
                <td>
                  <div style="width: 100%;">
                    <?php if ($order['status'] === 'progress') : ?>
                      <i data-id="<?= $order['id'] ?>" data-status="cancelled" class="bi bi-x-circle btn-status me-3" style="color: red"></i>
                      <i data-id="<?= $order['id'] ?>" data-status="success" class="bi bi-check-circle btn-status" style="color: green;"></i>
                    <?php endif ?>
                  </div>
                </td>
              </tr>
              <?php $index += 1 ?>

            <?php endwhile ?>

          </tbody>
        </table>
      </div>
    </section><!-- End Menu Section -->
  </main><!-- End #main -->

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
  <script src="../assets/js/jquery-3.6.4.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <!-- Swal -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Table -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

  <script>
    // Event Change Status
    $(document).on('click', '.btn-status', function() {
      const id = $(this).data('id');
      const status = $(this).data('status');

      Swal.fire({
        title: `Yakin ingin ${status === 'success' ? 'Mensukseskan' : 'Membatalkan'} Pesanan`,
        icon: 'warning',
        confirmButtonText: `Ya, sudah yakin`,
        showDenyButton: true,
        denyButtonText: `Tidak, Ntar Duls`,
      }).then(async (r) => {
        if (r.isConfirmed) {
          const body = new FormData();
          body.append('id', id);
          body.append('status', status);
          console.log(status);

          const res = await fetch('../api/order/update-status.php', {
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
            }).then(() => {
              window.location.reload();
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

    function getStatus(status) {
      if (status === 'progress') {
        return {
          'color': 'warning',
          'text': 'Proses'
        };
      } else if (status === 'success') {
        return {
          'color': 'success',
          'text': 'Sukses'
        };
      } else if (status === 'cancelled') {
        return {
          'color': 'danger',
          'text': 'Gagal'
        };
      }
    }

    let table = new DataTable('#orderTable', {
      ajax: '../api/order/getAll.php?id=3',
      columns: [{
          className: 'dt-control',
          orderable: false,
          data: null,
          defaultContent: '',
        },
        {
          data: 'username'
        },
        {
          data: 'total_price',
          render: function(data) {
            return currency(data)
          }
        },
        {
          data: 'status',
          render: function(data) {
            return `<span class="badge text-bg-${getStatus(data).color}">
                    ${getStatus(data).text}
                  </span>`
          }
        },
        {
          orderable: false,
          render: function(data, type, row) {
            if (row.status === 'progress') {
              return `<i data-id="${row.id}" data-status="cancelled" class="bi bi-x-circle btn-status me-3" style="color: red"></i>
                      <i data-id="${row.id}" data-status="success" class="bi bi-check-circle btn-status" style="color: green;"></i>`
            } else {
              return ''
            }
          },
          data: 'status',
        }
      ],
      order: [
        [1, 'asc']
      ],
    });

    function currency(duit) {
      return Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0
      }).format(parseFloat(duit));
    }

    function format(d) {
      // `d` is the original data object for the row
      return (
        `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;"> 
        ${d.orderProduct.map((op) => `
          <tr> 
            <td>${op.name}</td>
            <td>${currency(op.price)} x ${op.amount} </td>
            <td>=</td>
            <td>${currency(op.total)}</td>
          </tr>
          `).join('')}
        </table>`
      );
    }
    // Add event listener for opening and closing details
    $('#orderTable tbody').on('click', 'td.dt-control', function() {
      var tr = $(this).closest('tr');
      var row = table.row(tr);

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      } else {
        // Open this row
        row.child(format(row.data())).show();
        tr.addClass('shown');
      }
    });
  </script>



</body>

</html>