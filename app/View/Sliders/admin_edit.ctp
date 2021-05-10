<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit Slider</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item" href='<?php echo BASE_URL; ?>admin/sliders/index'>Sliders</li>
                            <li class="breadcrumb-item aactive" href='#'>Edit</li>
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
                                <label class="col-md-2 col-form-label">Image</label>
                                <div class="col-md-10">
                                    <input type="file"  class="form-control validate[required,custom[image]]" name="data[Slider][image]"/>
                                    <?php if (!empty($this->request->data['Slider']['image'])) { ?>
                                    <img src="<?php echo BASE_URL; ?>files/sliders/<?php echo $this->request->data['Slider']['image'] ?>" style="max-width:50px;margin-top: 10px;"/>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-danger waves-effect waves-light">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
