<?php
$setting = ClassRegistry::init('Sitesetting')->find('first');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no,width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>
        <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">
        <title><?php echo (!empty($pagename)) ? $pagename . " | " : "" ?> <?php echo $setting['Sitesetting']['site_title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- uikit -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
        <!-- select2 -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/bower_components/select2/dist/css/select2.min.css">
        <!-- altair admin -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/css/main.css" media="all">
        <!-- themes -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/css/themes/themes_combined.min.css" media="all">
        <!-- matchMedia polyfill for testing media queries in JS -->
        <!--[if lte IE 9]>
            <script type="text/javascript" src="bower_components/matchMedia/matchMedia.js"></script>
            <script type="text/javascript" src="bower_components/matchMedia/matchMedia.addListener.js"></script>
            <link rel="stylesheet" href="assets/css/ie.css" media="all">
        <![endif]-->
        <!-- Flaticon -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/custom-fonts/flaticon/flaticon.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/css/validationEngine.jquery.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/css/sweetalert.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL ?>theme/assets/css/custom.css" />
        <style>
            .user_actions li > a {
                margin-top: 7px;
            }
            #sidebar_main .sidebar_main_header .sidebar_logo span {
                font-size: 15px;
                margin-top: 15px;
            }
            .dataTables_wrapper .uk-table tbody tr > .sorting_1{
                background: unset !important;
            }
        </style>
    </head>
    <body class="disable_transitions sidebar_main_open sidebar_main_swipe">
        <?php echo $this->Element('admin_header'); ?>
        <?php echo $this->Element('admin_sidebar'); ?>
        <!-- Begin page -->

        <?php echo $this->fetch('content'); ?>
        <?php echo $this->Element('admin_footer'); ?>
    </body>
    <!-- common functions -->
    <script src="<?php echo BASE_URL ?>theme/assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="<?php echo BASE_URL ?>theme/assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="<?php echo BASE_URL ?>theme/assets/js/altair_admin_common.min.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets/js/pages/dashboard.min.js"></script>
    <!-- select2 -->
    <script src="<?php echo BASE_URL ?>theme/bower_components/select2/dist/js/select2.min.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets/js/pages/forms_file_upload.min.js"></script>
    <!-- datatables -->
    <script src="<?php echo BASE_URL ?>theme/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables custom integration -->
    <!--<script src="<?php echo BASE_URL ?>theme/assets/js/custom/datatables/datatables.uikit.min.js"></script>-->
    <!--  datatables functions -->
    <script src="<?php echo BASE_URL ?>theme/assets/js/pages/plugins_datatables.min.js"></script>
    <!--  forms advanced functions -->
    <script src="<?php echo BASE_URL ?>theme/assets/js/pages/forms_advanced.min.js"></script>
    <!--  contact list functions -->
    <script src="<?php echo BASE_URL ?>theme/assets/js/pages/page_contact_list.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Process Orders List change status
            $(".pmpo_status_change").hide();
            $(".pmpo_sc_btn").click(function () {
                var current = $(this);
                current.parents(".pmpo_status_action").find(".pmpo_status_show").hide();
                current.parents(".pmpo_status_action").find(".pmpo_status_change").show();
            });
            $(".pmpo_ss_btn").click(function () {
                var current = $(this);
                current.parents(".pmpo_status_action").find(".pmpo_status_show").show();
                current.parents(".pmpo_status_action").find(".pmpo_status_change").hide();
            });
        });
    </script>
    <script src="<?php echo BASE_URL ?>theme/assets//js/sweetalert.min.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets/js/jquery.validationEngine.js"></script>
    <script src="<?php echo BASE_URL ?>theme/assets/js/jquery.validationEngine-en.js"></script>
    <!--<script src="<?php echo BASE_URL ?>theme/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <?php
    $success = $this->Session->flash('adminsuccess');
    if (!empty($success)) {
        ?>
        <script>
            swal({
                title: "Success!",
                text: "<?php echo $success; ?>",
                type: "success",
                showCancelButton: false,
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php } ?>
    <?php
    $danger = $this->Session->flash('adminerror');
    if (!empty($danger)) {
        ?>
        <script>
            swal({
                title: "Error!",
                text: "<?php echo $danger; ?>",
                type: "error",
                showCancelButton: false,
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php } ?>
    <script>
        $(document).on('click', ".delconfirm", function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var title = "Delete Confirmation";
            $('.dlt_href').attr('href', href);
            $('.delete_modal').modal('show');
        });
        $(document).ready(function () {
            $('#summernote').summernote();
        });
        $(document).ready(function () {
            $('.validation_form').validationEngine('attach', {
                binded: false,
                scroll: false,
                promptPosition: "bottomLeft" 
            });
        });
    </script>


    <script>
        $(document).on('change', '#maincategory', function () {
            if ($(this).val() != '') {
                $.ajax({
                    url: "<?php echo BASE_URL; ?>productcategories/ajaxSubcategory/" + $(this).val(),
                    cache: false,
                    success: function (html) {
                        $("#subcategory").html(html);
                    }
                });
            } else {
                $("#subcategory").html('');
            }
        });
        $(document).on('click', '#generatecode', function () {       
                $.ajax({
                    url: "<?php echo BASE_URL;?>vendors/promo_code",
                    cache: false,
                    success: function (html) {
                        $("#newcode").val(html.toUpperCase());
                    }
                });           
        });
       

        $(document).on('click', '.variationaddmore', function () {
            var html = '<div class="row form-group">';
            html += '<div class="col-md-3">';
            html += '<input type="text" class="md-input validate[required]" name="data[Productvariation][variation][]" placeholder="Variation"/>';
            html += '</div>';
            html += '<div class="col-md-2">';
            html += '<input type="text" class="md-input validate[required]" name="data[Productvariation][mrp][]" placeholder="Mrp"/>';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<input type="text" class="md-input" name="data[Productvariation][salesprice][]" placeholder="Sales Price"/>';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<select class="md-input validate[required]" name="data[Productvariation][availability][]"><option value="">Availability</option>';
            html += '<option name="In Stock">In Stock</option>';
            html += '<option name="Out Of Stock">Out Of Stock</option>';
            html += '</select>';
            html += '</div>';
            html += '<div class="col-md-1">';
            html += '<a class="remove" href="javascript:;"><i class="fa fa-trash"></i></a>';
            html += '</div>';
            html += '</div>';
            $(this).before(html);
        });
        $(document).on('click', '.remove', function () {
            $(this).parents('.variation-div').remove();
        });
        $(document).on('change', '#variation_type', function () {
            if ($(this).val() == 'Single') {
                $('.variation-div').not('.variation-div:first').remove();
                $('.addmore-div').hide();
                $('.remove-div').hide();
            } else {
                $('.addmore-div').show();
                $('.remove-div').show();
                $('.addmore').trigger('click');
            }
        });
    </script>
    <script>
        $(document).on('click', '.edit', function () {
            $('input').prop('disabled', function (i, v) {
                return !v;
            });
            $('.update').show();
            $(this).hide();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.prev_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".prev_file").change(function () {
            readURL(this);
        });

    </script>


    <script>
        $(document).ready(function() {
           $('#dataTable').DataTable({
             "order": [[ 1, "desc" ]]
            });
        });
        function loadFrame() {
            $('div').removeClass('validate[required]');
        }
        window.onload = setTimeout(loadFrame, 2000);
    </script>
    <?php if (isset($_REQUEST['stock'])) { ?>
        <script>
            $('.md-input').prop('disabled', true);
            $('#select_demo_4').prop('disabled', true);
    <?php if ($_REQUEST['stock'] == 'low') { ?>
                $('.lowstock label').text('Low inventory Quantity');
                $('.lowstock .md-input').prop('disabled', false);
//                $('.inventory').hide();
                
    <?php } ?>
    <?php if ($_REQUEST['stock'] == 'outof') { ?>
                $('.inventory label').text('Available inventory Quantity');
                $('.inventory .md-input').prop('disabled', false);
//                $('.lowstock').hide();
    <?php } ?>
    <?php if ($_REQUEST['stock'] == 'instock') { ?>
                $('.inventory .md-input').prop('disabled', false);
                $('.lowstock .md-input').prop('disabled', false);
    <?php } ?>
        </script>
    <?php } ?>
</html>
