<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Login | Mantis Bootstrap 5 Admin Template</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description"
    content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords"
    content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="/../assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="/../assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="/../assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="/../assets/fonts/fontawesome.css">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="/../assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="/../assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="/../assets/css/style-preset.css">

  <style>
    /* Wrapper untuk efek animasi */
    .card-animated {
      position: relative;
      overflow: hidden;
      border-radius: 20px;
    }

    /* Animasi gradient mutar */
    .card-animated::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: conic-gradient(#4facfea2,
          #017eebb7,
          #ffffff,
          #017eeb,
          #4facfea2,
          #ffffff,
          #017eeb);
      animation: spin 6s linear infinite;
      z-index: 0;
    }

    /* Lapisan putih di atas gradient */
    .card-animated::after {
      content: "";
      position: absolute;
      inset: 5px;
      background: #fff;
      border-radius: 15px;
      z-index: 1;
    }

    /* Isi card */
    .card-animated .card-body {
      position: relative;
      z-index: 2;
    }

    /* Animasi mutar */
    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Biar card tidak terlalu besar */
    .card-login {
      max-width: 400px;
      margin: 60px auto;
      border-radius: 15px;
      box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
    }

    /* Judul login lebih menarik */
    .login-title {
      font-size: 2rem;
      font-weight: 700;
      text-align: center;
      color: #0d6efd;
      letter-spacing: 1px;
    }
  </style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="/../dashboard/index.html" class="b-brand d-flex align-items-center text-decoration-none">
            <!-- Logo -->
            <img src="/../assets/images/logo-RSPO.png" style="width: 60px;margin-left: 20px;"
              class="img-fluid logo-lg me-1" alt="logo">

            <!-- Teks PTPN 5 -->
            <span
              style="font-family: 'Poppins', sans-serif; color: #30B2EB; font-size: 25px; margin-top: 10px;font-weight: 600;">
              RSPO
            </span>
          </a>
        </div>
        <div class="card card-login card-animated ">
          <div class="card-body p-5">
            <div class="mb-5">
              <h3 class="login-title">LOGIN</h3>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address">
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Password">
            </div>

            <a href="index">
              <div class="d-grid mt-4">
                <button type="button" class="btn btn-primary">Login</button>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="/../assets/js/plugins/popper.min.js"></script>
  <script src="/../assets/js/plugins/simplebar.min.js"></script>
  <script src="/../assets/js/plugins/bootstrap.min.js"></script>
  <script src="/../assets/js/fonts/custom-font.js"></script>
  <script src="/../assets/js/pcoded.js"></script>
  <script src="/../assets/js/plugins/feather.min.js"></script>





  <script>layout_change('light');</script>




  <script>change_box_container('false');</script>



  <script>layout_rtl_change('false');</script>


  <script>preset_change("preset-1");</script>


  <script>font_change("Public-Sans");</script>



</body>
<!-- [Body] end -->

</html>