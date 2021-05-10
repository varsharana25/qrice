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
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>Sign in to continue to <?php echo $setting['Sitesetting']['site_title']; ?>.</p>
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
                                        <img src="<?php echo BASE_URL; ?>img/<?php echo $setting['Sitesetting']['fav_icon']; ?>" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal validation_form" action="#" method="POST">
                                <div class="form-group">
                                    <a href="javascript:;" class="sendotp float-right">SEND OTP</a>
                                    <label for="email">Mobile Number </label>
                                    <input type="text" class="form-control validate[required,custom[phone]]" name="data[Vendor][mobile]" id="phone_number" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="userpassword">OTP</label>
                                    <input type="text" class="form-control validate[required]" name="data[Vendor][otp]"  id="userpassword" placeholder="OTP">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-danger btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>&copy; <?php echo date('Y') ?> <?php echo $setting['Sitesetting']['site_title']; ?>. Crafted with <i class="mdi mdi-heart text-danger"></i> by Rayaztech</p>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.sendotp', function() {
        var val = $('#phone_number').val();
        if (val != '') {
            $.ajax({
                type: 'POST',
                url: "<?php echo BASE_URL; ?>vendors/sendotp",
                data: {phone: val},
                dataType: "json",
                success: function(resultData) {
                    if (resultData.code == '200') {
                        swal({
                            title: "Success!",
                            text: resultData.message,
                            type: "success",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: resultData.message,
                            type: "error",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            });
        } else {
            swal({
                title: "Error!",
                text: 'Please enter mobile number',
                type: "error",
                showCancelButton: false,
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
</script>