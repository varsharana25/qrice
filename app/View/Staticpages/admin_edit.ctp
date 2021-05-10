<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit sttaic page</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href='<?php echo BASE_URL; ?>admin/staticpages'>Static pages</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="#" class="validation_form" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-lg-3 control-label"> Page Name <span class="required">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text"  class="form-control validate[required]" name="data[Staticpage][page_title]" value="<?php echo!empty($this->request->data['Staticpage']['page_title']) ? $this->request->data['Staticpage']['page_title'] : ''; ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="form-field-1"> Banner Image </label>
                                <div class="col-sm-6">
                                    <input type="file" name="data[Staticpage][image]" class="form-control validate[custom[image]]">
                                    <p>Image Size: 1597 X 743 px</p>
                                </div>
                                <div class="col-sm-3">
                                    <div class="img-caption">
                                        <a href="<?php echo BASE_URL ?>img/<?php echo $this->request->data['Staticpage']['image']; ?>" target='_blank' data-popup="lightbox" rel="gallery"><img src="<?php echo BASE_URL ?>img/<?php echo $this->request->data['Staticpage']['image']; ?>" style="max-width:40px;"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label"> Page content <span class="required">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="data[Staticpage][page_content]" class="form-control" id="summernote"><?php echo!empty($this->request->data['Staticpage']['page_content']) ? $this->request->data['Staticpage']['page_content'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-danger" type="submit"> Submit </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
