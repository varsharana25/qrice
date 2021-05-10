<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">Product Category</span> - List
            </h4>
        </div>
        <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>emailcontents">Product Category</a></li>
            <li class="active">List</li>
        </ul>
        <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 page_head">
        <h3> Email Management</h3>
    </div>
    <div class="col-lg-12 page_content">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left">Add Emailcontent</span>
                <a class="pull-right btn btn-grad" href="<?php echo BASE_URL; ?>admin/emailcontents"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
            </header>
            <div class="panel-body">
                <form class="form-horizontal full_frms full_view_borders " id="myForm" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 r_text">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Email Title <span class="required">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control validate[required]" id="title" name="data[Emailcontent][title]" value="<?php echo!empty($this->request->data['Emailcontent']['title']) ? $this->request->data['Emailcontent']['title'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Label <span class="required">*</span></label>
                            <div class="col-sm-7">
                                <textarea  class="form-control validate[required]" id="label" rows="5" name="data[Emailcontent][label]"><?php echo!empty($this->request->data['Emailcontent']['label']) ? $this->request->data['Emailcontent']['label'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">From Name  <span class="required">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control validate[required]" id="fromname" name="data[Emailcontent][fromname]" value="<?php echo!empty($this->request->data['Emailcontent']['fromname']) ? $this->request->data['Emailcontent']['fromname'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">From Email</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control validate[custom[email]]" id="fromemail" name="data[Emailcontent][fromemail]" value="<?php echo!empty($this->request->data['Emailcontent']['fromemail']) ? $this->request->data['Emailcontent']['fromemail'] : ''; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 r_text">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">To Email</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control validate[custom[email]]" id="toemail" name="data[Emailcontent][toemail]" value="<?php echo!empty($this->request->data['Emailcontent']['toemail']) ? $this->request->data['Emailcontent']['toemail'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">CC Mail</label>
                            <div class="col-sm-7">
                                <textarea  class="form-control" id="ccemail" rows="5" name="data[Emailcontent][ccemail]"><?php echo!empty($this->request->data['Emailcontent']['ccemail']) ? $this->request->data['Emailcontent']['ccemail'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Subject <span class="required">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control validate[required]" id="subject" name="data[Emailcontent][subject]" value="<?php echo!empty($this->request->data['Emailcontent']['subject']) ? $this->request->data['Emailcontent']['subject'] : ''; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 r_text">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea  class="form-control form_view ckeditor validate[required]" id="emailcontent" rows="5" name="data[Emailcontent][emailcontent]"><?php echo!empty($this->request->data['Emailcontent']['emailcontent']) ? $this->request->data['Emailcontent']['emailcontent'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">&nbsp;</label>
                            <div class=" col-sm-5">
                                <button type="submit" class="btn btn-default m-btn m-btn--air m-btn--custom hvr-glow btn-style2"><i class="fa fa-floppy-o"></i> Save Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">
    $('#image').ace_file_input({
        no_file: 'No File ...',
        btn_choose: 'Choose',
        btn_change: 'Change',
        droppable: false,
        onchange: null,
        thumbnail: false
    });
</script>