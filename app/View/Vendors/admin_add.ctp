<div class="br-mainpanel">
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-book-outline"></i> 
        <div class="col-md-6">
            <h4>Add Vendor</h4>
        </div>

        <div class="col-md-6">
            <div class="btn-group float-right">
                <a href="<?php echo BASE_URL; ?>admin/vendors/index" class="btn br-menu-link active addbtn"><i class="la la-long-arrow-left"></i>Back To list</a>
            </div>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form method="post" action="#" class="validation_form" enctype="multipart/form-data">
                <div class="form-layout form-layout-4">
                    <div class="row">
                        <label class="col-sm-2 form-control-label">Vendor Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" placeholder="Name" class="form-control validate[required]" name="data[Vendor][full_name]"/>
                        </div>
                    </div><!-- row -->           
                    <div class="row">
                        <label class="col-sm-2 form-control-label">Shop Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" placeholder="Shop Name" class="form-control validate[required]" name="data[Vendor][shop_name]"/>
                        </div>
                    </div><!-- row -->    
                    <div class="row">
                        <label class="col-sm-2 form-control-label">Mobile: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" placeholder="Mobile" class="form-control validate[required]" name="data[Vendor][mobile]"/>
                        </div>
                    </div><!-- row -->  
                    <div class="row">
                        <label class="col-sm-2 form-control-label">Email: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" placeholder="Name" class="form-control validate[required]" name="data[Vendor][email]"/>
                        </div>
                    </div><!-- row -->  
                    <div class="row">
                        <label class="col-sm-2 form-control-label">Location: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" placeholder="Location" class="form-control validate[required]" name="data[Vendor][location]"/>
                        </div>
                    </div><!-- row -->  
                    <div class="row mg-t-20">
                        <?php
                        $categires = ClassRegistry::init('Category')->find('all', array('conditions' => array('status !=' => 'Trash')));
                        ?>
                        <label class="col-sm-2 form-control-label">Category Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select class="form-control validate[required]"  name="data[Vendor][category_id]">
                                <option value="">---Select---</option>
                                <?php foreach ($categires as $categiri) { ?>
                                    <option value="<?php echo $categiri['Category']['category_id'] ?>"><?php echo $categiri['Category']['category_name'] ?></option>
                                <?php } ?>                                
                            </select>  
                        </div>
                    </div>

                    <div class="form-layout-footer mg-t-30">
                        <button class="btn btn-info" type="submit"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
                        <a class="btn btn-secondary" href="<?php echo BASE_URL; ?>admin/products/index">Cancel</a>
                    </div><!-- form-layout-footer -->
                </div>   


            </form>
        </div>
    </div>
</div>