<!-- Main content -->
<div class="content-wrapper">

    <!-- Content area -->
    <div class="content container">

        <!-- Simple login form -->
        <?php $settings = ClassRegistry::init('Sitesetting')->find('first'); ?>
     <div class="forgotpassword">
        <form action="" method="post" class="validation_form">
            <div class="panel panel-body login-form">
                <div class="text-center">
                    <img src="<?php echo BASE_URL; ?>img/<?php echo $settings['Sitesetting']['logo']; ?>" style="max-height:55px;"/>
                    <h5 class="content-group">Forgot Password? <small class="display-block">Enter your credentials below</small></h5>
                </div>
                <div class="form-group has-feedback has-feedback-left">
                    <input type="email" name="data[Vendor][email]" id="email" class="form-control validate[required,custom[email]]" placeholder="Email" />
                    <div class="form-control-feedback">
                        <i class="icon-envelop text-muted"></i>
                    </div>
                </div>
                <div class="clearfix form-group">
                    <button type="submit" class="width-35 btn-block btn btn-sm btn-danger"> <i class="la la-lightbulb-o"></i>  <span class="bigger-110">Send Me!</span> </button>
                </div>
                <div class="text-center">
                    <a href="<?php echo BASE_URL; ?>vendors/login">Back to login</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- /simple login form -->
<style>
    .form-control-feedback i {
        display: block;
        padding-top: 0;
        vertical-align: middle;
    }
</style>