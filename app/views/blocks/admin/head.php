<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from coderthemes.com/hyper/saas/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 13:28:05 GMT -->
<head>
        <meta charset="utf-8" />
        <title>
            <?php
            if(isset($_SESSION['title_page'])) {
                echo $_SESSION['title_page'];
            }
            
            ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <link rel="shortcut icon" type="image/x-icon" href="<?= asset('admin/assets/images/VJ.png') ?>">


        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="<?= asset('admin/assets/vendor/daterangepicker/daterangepicker.css') ?>">

        <!-- Vector Map css -->
        <link rel="stylesheet" href="<?= asset('admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') ?>">

        <!-- Theme Config Js -->
        <script src="<?= asset('admin/assets/js/hyper-config.js') ?>"></script>

        <!-- App css -->
        <link href="<?= asset('admin/assets/css/app-saas.min.css') ?>" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="<?= asset('admin/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- Custom css -->
        <link href="<?= asset('admin/assets/css/custom.css') ?>" rel="stylesheet" type="text/css" />

        <!-- Select 2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


        <!-- Datatable css table responsive database có checkbox -->
        <link href="<?= asset('admin/') ?>assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= asset('admin/') ?>assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <!-- Begin page -->
        <div class="wrapper">