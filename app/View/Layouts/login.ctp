<?php
$setting = ClassRegistry::init('Sitesetting')->find('first');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no" />
        <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">
        <title><?php echo (!empty($pagename)) ? $pagename . " | " : "" ?> <?php echo $setting['Sitesetting']['site_title']; ?></title>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
        <!-- uikit -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>theme/bower_components/uikit/css/uikit.almost-flat.min.css" />
        <!-- altair admin login page -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>theme/assets/css/login_page.css" />
        <!-- Flaticon -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>theme/assets/custom-fonts/flaticon/flaticon.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/css/validationEngine.jquery.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/css/sweetalert.css" />
        <!-- Modal End -->
        <!-- common functions -->

        <script>
            // check for theme
            if (typeof (Storage) !== "undefined") {
                var root = document.getElementsByTagName('html')[0],
                        theme = localStorage.getItem("altair_theme");
                if (theme == 'app_theme_dark' || root.classList.contains('app_theme_dark')) {
                    root.className += ' app_theme_dark';
                }
            }

        </script>

    <body class="login_page login_page_v2">
        <?php echo $this->fetch('content'); ?>
    </body>
    <script src="<?php echo BASE_URL; ?>theme/assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="<?php echo BASE_URL; ?>theme/assets/js/uikit_custom.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo BASE_URL; ?>theme/assets/js/altair_admin_common.min.js"></script>
    <!-- altair login page functions -->
    <script src="<?php echo BASE_URL; ?>theme/assets/js/pages/login.min.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets//js/sweetalert.min.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets/js/jquery.validationEngine.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets/js/jquery.validationEngine-en.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <?php
    $success = $this->Session->flash('loginsuccess');
    if (!empty($success)) {
        ?>
        <script>
                swal("Success!", "<?php echo $success; ?>!", "success")
        </script>
    <?php } ?>
    <?php
    $danger = $this->Session->flash('loginerror');
    if (!empty($danger)) {
        ?>
        <script>
            swal("Error!", "<?php echo $danger; ?>!", "error")
        </script>
    <?php } ?>
    <script>
        $(document).ready(function() {
            $('.validation_form').validationEngine('attach', {
                binded: false
            });
        });
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
        $(document).on('click', ".delconfirm", function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var title = "Delete Confirmation";
            $('.dlt_href').attr('href', href);
            $('.delete_modal').modal('show');
        });
        $("[rel=tooltip]").tooltip({html: true});
        $(document).ready(function() {
            $('.table').DataTable({
                responsive: true
            });
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
        });
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
</html>
