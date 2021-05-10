<?php
$setting = ClassRegistry::init('Sitesetting')->find('first');
?>
<div class="home-btn d-none d-sm-block">
    <a href="#" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-danger">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-danger p-4">
                                    <h5 class="text-danger"> Reset Password</h5>
                                    <p>Re-Password with <?php echo $setting['Sitesetting']['site_title']; ?>.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="<?php echo BASE_URL; ?>theme/assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <a href="#">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="<?php echo BASE_URL; ?>img/<?php echo $setting['Sitesetting']['logo']; ?>" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <div class="alert alert-success text-center mb-4" role="alert">
                                Enter your Email and instructions will be sent to you!
                            </div>
                            <form class="form-horizontal validation_form" action="#" method="POST">
                                <div class="form-group">
                                    <label for="useremail">Email</label>
                                    <input type="email" class="form-control validate[required,custom[email]]" id="useremail" name="data[Adminuser][email]" placeholder="Enter email">
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-danger w-md waves-effect waves-light" type="submit">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>� <?php echo date('Y') ?> <?php echo $setting['Sitesetting']['site_title']; ?>. Crafted with <i class="mdi mdi-heart text-danger"></i> by Moziztech</p>
                </div>
            </div>
        </div>
    </div>
</div>