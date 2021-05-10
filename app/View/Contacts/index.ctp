<?php $banner= Classregistry::init('Banner')->find('first',array('conditions'=>array('pagename'=>'Contact Us'))) ;
$home = Classregistry::init('Homepagecontent')->find('first');?>
<section class="page-banner-sec" style=" background-image: url('<?php echo BASE_URL ?>files/banner/<?php echo $banner['Banner']['banner'] ?>')">
    <div class="container">
        <h2 class="text-white">CONTACT <span><b> US</b></span></h2>
        <hr>
    </div>
</section>
<?php $settings=ClassRegistry::init('Sitesetting')->find('first',array('conditions'=>array('id'=>'1'))); ?>
<section class="contact_us section contactpage">
    <div class="container">
        <div class="contactform">
            <div class="row">                   
                <div class=" col-md-8 match-height">
                    <form class="contactus-form validation_form" action="" method="post" autocomplete="off">
                        <h4>Send Us Message</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <span class="star">*</span></label>
                                    <input type="text" name="data[Contact][name]" class="form-control validate[required]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email ID <span class="star">*</span></label>
                                    <input type="text" name="data[Contact][email]" class="form-control validate[required]">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telephone </label>
                                    <input type="text" name="data[Contact][phone]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject </label>
                                    <input type="text" name="data[Contact][subject]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="validate[required]" placeholder="Message"  name="data[Contact][message]" rows="4"></textarea>
                        </div>
                        <button class="text-center send-btn">SEND <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <div class="col-md-4 match-height">
                    <div class="contact-details">
                        <div class="media">
                            <div class="media-left">
                                <img src="img/loc.png">
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">ADDRESS</h5>
                                <?php echo $settings['Sitesetting']['address'] ?>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img src="img/mail.png">
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">EMAIL</h5>
                                <p><?php echo $settings['Sitesetting']['email'] ?></p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img src="img/call.png">
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">CONTACT US</h5>
                                <p><?php echo $settings['Sitesetting']['phone'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $setting = Classregistry::init('Sitesetting')->find('first'); ?>
<div class="map-sec">
    <iframe src="<?php echo $setting['Sitesetting']['mapurl'] ?>"  height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>
<section class="contactpage trial-demo section text-center"  style=" background-image: url(img/bg.png)">
    <div class="container">
        <h2 class=""><?php echo $home['Homepagecontent']['start_growing_title'] ?></h2>
        <hr>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <p class="theme-para-color" ><?php echo $home['Homepagecontent']['start_growing_content'] ?></p>
                <div class="row">
                    <div class="col-md-offset-3 col-md-3 col-sm-offset-3 col-sm-3">
                        <button formtarget="_blank" class="header-btn"  onclick="location.href='<?php echo $home['Homepagecontent']['free_trial_link'] ?>'">FREE TRIAL</button>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button formtarget="_blank" class="header-btn" onclick="location.href='<?php echo $home['Homepagecontent']['watch_demo_link'] ?>'">WATCH DEMO</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<script>
    jQuery(function () {
        jQuery('.match-height').matchHeight();
    });
</script>  