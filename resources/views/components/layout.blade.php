<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>{{$title}} | RSPO - PTPN 5</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- [Favicon] icon -->
    <link rel="icon" href="/../assets/images/logo-RSPO.png" type="image/x-icon"> <!-- [Google Font] Family -->
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

</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <div class="loader-bg">
        <div class="loader-track"></div>
    </div>

    <x-navbar></x-navbar>

    <x-header></x-header>

    {{ $slot }}



    <!-- [Page Specific JS] start -->
    <script src="/../assets/js/plugins/apexcharts.min.js"></script>
    <script src="/../assets/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="/../assets/js/plugins/popper.min.js"></script>
    <script src="/../assets/js/plugins/simplebar.min.js"></script>
    <script src="/../assets/js/plugins/bootstrap.min.js"></script>
    <script src="/../assets/js/pcoded.js"></script>
    <script src="/../assets/js/plugins/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





    <script>
        layout_change('light');
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>



</body>
<!-- [Body] end -->

</html>