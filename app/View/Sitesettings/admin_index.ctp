<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Settings</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/adminusers/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" href='#'>Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="validation_form" method="post" action="#" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Site Title</label>
                                        <input type="text" name="data[Sitesetting][site_title]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['site_title'])) ? $result['Sitesetting']['site_title'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Site Logo</label>
                                        <input type="file" name="data[Sitesetting][logo]" class="form-control validate[custom[image]]">
                                        <?php if (!empty($result['Sitesetting']['logo'])) { ?>
                                            <img src="<?php echo BASE_URL; ?>img/<?php echo $result['Sitesetting']['logo'] ?>" class="img-responsive" style="max-width:50px;"/>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fav Icon</label>
                                        <input type="file" name="data[Sitesetting][fav_icon]" class="form-control validate[custom[image]]">
                                        <?php if (!empty($result['Sitesetting']['fav_icon'])) { ?>
                                            <img src="<?php echo BASE_URL; ?>img/<?php echo $result['Sitesetting']['fav_icon'] ?>" class="img-responsive" style="max-width:30px;"/>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="data[Sitesetting][address]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['address'])) ? $result['Sitesetting']['address'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="data[Sitesetting][email]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['email'])) ? $result['Sitesetting']['email'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="data[Sitesetting][phone]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['phone'])) ? $result['Sitesetting']['phone'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="data[Sitesetting][address]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['address'])) ? $result['Sitesetting']['address'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Map Url</label>
                                        <input type="text" name="data[Sitesetting][mapurl]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['mapurl'])) ? $result['Sitesetting']['mapurl'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Facebook url</label>
                                        <input type="text" name="data[Sitesetting][facebook_url]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['facebook_url'])) ? $result['Sitesetting']['facebook_url'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Twitter url</label>
                                        <input type="text" name="data[Sitesetting][twitter_url]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['twitter_url'])) ? $result['Sitesetting']['twitter_url'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Insta url</label>
                                        <input type="text" name="data[Sitesetting][instagram_url]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['instagram_url'])) ? $result['Sitesetting']['instagram_url'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pinterest url</label>
                                        <input type="text" name="data[Sitesetting][pinterest_url]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['pinterest_url'])) ? $result['Sitesetting']['pinterest_url'] : "" ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Website url</label>
                                        <input type="text" name="data[Sitesetting][websiteurl]" class="form-control validate[required]" value="<?php echo (!empty($result['Sitesetting']['websiteurl'])) ? $result['Sitesetting']['websiteurl'] : "" ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-danger" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>