<?php
$setting = ClassRegistry::init('Sitesetting')->find('first');
?>
<div class="uk-container uk-container-center">
    <div class="md-card">
        <div class="md-card-content padding-reset">
            <div class="uk-grid uk-grid-collapse">
                <div class="uk-width-large-2-3 uk-hidden-medium uk-hidden-small">
                    <div class="login_page_info uk-height-1-1" style="background-image: url('<?php echo BASE_URL; ?>theme/assets/img/custom/manager-cover.jpg')">
                        <div class="info_content">
                            <h1 class="heading_b">QRice</h1>
It is the 1st online rice store in Bengaluru, which is going to commence its services in certain areas of Bengaluru. After covering certain areas, we would also love to extend our services to the whole of Bengaluru city very soon.                        </div>
                    </div>
                </div>
                <div class="uk-width-large-1-3 uk-width-medium-2-3 uk-container-center">
                    <div class="login_page_forms">
                        <div id="login_card">
                            <div id="login_form">
                                <div class="login_heading">
                                    <div class="user_avatar">
                                        <img src="<?php echo BASE_URL; ?>theme/assets/img/custom/index.png">
                                    </div>
                                </div>
                                <h2 align="center" class="heading_a uk-margin-large-bottom">Admin Login</h2>
                                <form method="POST" action="#" class="validation_form">
                                    <div class="uk-form-row">
                                        <label for="login_email">Email Id</label>
                                        <input class="md-input validate[required,custom[email]]" type="text" id="login_email" name="data[Adminuser][email]" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label for="login_password">Password</label>
                                        <input class="md-input validate[required]" type="password" id="login_password" name="data[Adminuser][password]" />
                                    </div>
                                    <div class="uk-margin-top">
                                        <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck />
                                        <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="uk-margin-medium-top">
                                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>