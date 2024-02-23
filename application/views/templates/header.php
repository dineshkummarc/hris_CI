<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets') ?>/images/system/favicon.png">
    <link rel="icon" type="image/png" href="<?= base_url('assets') ?>/images/system/favicon.png">

    <title><?= $title ?></title>

    <!-- <link href="<?= base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="<?= base_url('assets') ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/css/animate.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/css/style.css" rel="stylesheet">

    <link href="<?= base_url('assets/'); ?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/bootstrap-table@1.21.4/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css" rel="stylesheet">

    <link href="<?= base_url('assets/'); ?>css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">

    <link href="<?= base_url('assets/'); ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <script src="<?= base_url('assets/') ?>js/encrypt.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('node_modules/');?>crypto-js/crypto-js.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="fixed-sidebar">
    <style>
        #toolbar {
            margin: 0;
        }

        #toolbar2 {
            margin: 0;
        }
    </style>
    <div id="wrapper">