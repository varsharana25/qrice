<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit Category</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href='<?php echo BASE_URL; ?>admin/categories'>Business Categories</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" action="#" class="validation_form" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Category Name</label>
                                <div class="col-md-10">
                                    <?php echo (!empty($this->request->data['Category']['name'])) ? $this->request->data['Category']['name'] : "" ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Category Image</label>
                                <div class="col-md-10">
                                    <input type="file" name="data[Category][image]" class="form-control validate[custom[image]]"/>
                                    <?php if (!empty($this->request->data['Category']['image'])) { ?>
                                        <img src="<?php echo BASE_URL; ?>files/categoryimages/<?php echo $this->request->data['Category']['image'] ?>" style="max-width:60px;margin-top:3px"/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Delivery Charge</label>
                                <div class="col-md-10">
                                    <input type="text" name="data[Category][delivery_charge]" class="form-control validate[required]" value="<?php echo (!empty($this->request->data['Category']['delivery_charge'])) ? $this->request->data['Category']['delivery_charge'] : "" ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Status</label>
                                <div class="col-md-10">
                                    <select class="form-control validate[required]" name="data[Category][status]">
                                        <option  value="Active" <?php echo (!empty($this->request->data['Category']['status']) && $this->request->data['Category']['status'] == 'Active') ? 'selected' : '' ?>>Active</option>
                                        <option  value="Inactive" <?php echo (!empty($this->request->data['Category']['status']) && $this->request->data['Category']['status'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-danger waves-effect waves-light">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>