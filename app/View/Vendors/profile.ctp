<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Update Profile Settings</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Update Profile Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <!-- end page title -->
        <form class="validation_form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">                    
                            <div class="form-group">
                                <label class=" control-label"> Name <span class="tx-danger">*</span></label>
                                <div class="">
                                    <input type="text" class="form-control validate[required]" name="data[Vendor][full_name]" value="<?php echo $sessionvendor['Vendor']['full_name']; ?>"/>
                                </div>
                            </div>      
                            <div class="form-group">
                                <label class=" control-label"> Shop Name <span class="tx-danger">*</span></label>
                                <div class="">
                                    <input type="text" class="form-control validate[required]" name="data[Vendor][shop_name]" value="<?php echo $sessionvendor['Vendor']['shop_name']; ?>"/>
                                </div>
                            </div>                        
                            <div class="form-group">
                                <label class=" control-label"> Email <span class="tx-danger">*</span></label>
                                <div class="">
                                    <input type="text" class="form-control validate[required,custom[email]]" name="data[Vendor][email]" value="<?php echo $sessionvendor['Vendor']['email']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label"> Phone No <span class="tx-danger">*</span></label>
                                <div class="">
                                    <input type="text"  class="form-control validate[required]" name="data[Vendor][mobile]" value="<?php echo $sessionvendor['Vendor']['mobile']; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body"> 
                            <div class="form-group">
                                <label class="control-label no-padding-right">Location</label>
                                <div class="">
                                    <input type="text" class="form-control  validate[required]" name="data[Vendor][location]" value="<?php echo $sessionvendor['Vendor']['location']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label no-padding-right">District</label>
                                <div class="">
                                    <input type="text" class="form-control  validate[required]" name="data[Vendor][district]" value="<?php echo $sessionvendor['Vendor']['district']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label no-padding-right">State</label>
                                <div class="">
                                    <input type="text" class="form-control  validate[required]" name="data[Vendor][state]" value="<?php echo $sessionvendor['Vendor']['state']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label no-padding-right">Pincode</label>
                                <div class="">
                                    <input type="text" class="form-control" name="data[Vendor][pincode]" value="<?php echo $sessionvendor['Vendor']['pincode']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label no-padding-right">Shop Logo<span class="tx-danger">*</span></label>
                                <div class="">                                      
                                    <input type="file" name="data[Vendor][shop_logo]" class="form-control validate[custom[image]]"/>
                                    <p><small>Recommended Size: 100*100</small></p>
                                </div>
                                <img src="<?php echo BASE_URL; ?><?php echo $sessionvendor['Vendor']['vendor_path'] ?>/<?php echo $sessionvendor['Vendor']['shop_logo'] ?>" class="avatar-sm"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label no-padding-right">Shop Opening Time</label>
                                <div class="">
                                    <input type="text" class="form-control timepicker" name="data[Vendor][shop_openingtime]" value="<?php echo date('h:i A', strtotime($sessionvendor['Vendor']['shop_openingtime'])); ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label no-padding-right">Shop Closing Time</label>
                                <div class="">
                                    <input type="text" class="form-control timepicker" name="data[Vendor][shop_closingtime]" value="<?php echo date('h:i A', strtotime($sessionvendor['Vendor']['shop_closingtime'])); ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button class="btn btn-danger" type="submit"> Submit </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('.timepicker').timepicker();
</script>