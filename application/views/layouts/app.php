<!DOCTYPE html>
<html>
<head>
    <!-- meta -->
    <?php echo @$_meta; ?>

    <!-- css -->
    <?php echo @$_styles; ?>

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- header -->
        <?php echo @$_header; ?>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar -->
        <?php echo @$_sidebar; ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- flash -->
        <?php echo @$_flash; ?>

        <!-- content -->
        <?php echo @$_content; ?>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <!-- footer -->
        <?php echo @$_footer; ?>
    </footer>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    <!-- modals -->
    <?php echo @$_modals_action; ?>
    <?php echo @$_modals_form; ?>
</div>
<!-- ./wrapper -->

<!-- scripts -->
<?php echo @$_scripts; ?>
<?php echo @$_custom_scripts; ?>
</body>
</html>
