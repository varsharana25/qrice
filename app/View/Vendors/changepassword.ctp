<div class="br-mainpanel">
    <div class="br-pagetitle">
       
        <div>
            <h4><span> <i class="icon ion-ios-gear-outline"></i></span>Change Password</h4>
        </div>
    </div><!-- d-flex -->
    <div class="br-pagebody">
        <div class="br-section-wrapper">

            <form class="form-horizontal validation_form" role="form" id="myForm" name="profile" method="post" enctype="multipart/form-data">            
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Current password <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" id="oldpassword" placeholder="Current Password"  class="form-control validate[required]" name="data[Vendor][oldpassword]" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> New Password <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" id="password" placeholder="New Password"  class="form-control validate[required,minSize[6]]" name="data[Vendor][password]" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Confirm Password <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" id="conpass" placeholder="Confirm Password"  class="form-control validate[required,minSize[6],equals[password]]" name="data[Vendor][cpasswords]"/>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
