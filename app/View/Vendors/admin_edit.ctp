<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">Sms Contents</span> 
            </h4>

            <a href="<?php echo BASE_URL; ?>admin/smscontent/index/<?php echo (!empty($this->params['pass']['1'])) ? "page:2" : ""; ?>" class="backcss"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>admin/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>admin/smscontent/index">Sms Contents</a></li>
        </ul>
        <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
</div>
<div class="content">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Edit  SMS Content</h5>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal validation_form" method="post" enctype="multipart/form-data">
                    <fieldset class="content-group">
                        <div class="form-group clearfix">
                            <label class="col-lg-3 control-label"> Title </label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control validate[required]" rows="3" name="data[Smscontent][title]" value="<?php echo (!empty($this->request->data['Smscontent']['title'])) ? $this->request->data['Smscontent']['title'] : ""; ?>"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-lg-3 control-label"> Content </label>
                            <div class="col-lg-5">
                                <textarea class="form-control validate[required]" rows="3" name="data[Smscontent][content]"><?php echo (!empty($this->request->data['Smscontent']['content'])) ? $this->request->data['Smscontent']['content'] : ""; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn bg-teal" type="submit"> Submit </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>