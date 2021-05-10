<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">Contact</span> - View
            </h4>
        </div>
        <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL ?>admin/contacts/"><i class="fa fa-list"></i> Contact</a></li>
            <li class="active">View</li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-flat">
            <div class="panel-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset class="content-group">
                        <div class="form-group">
                            <label class="control-label col-lg-3">Name</label>
                            <div class="col-lg-9">
                                <?php echo $result['Contact']['name']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Email</label>
                            <div class="col-lg-9">
                                <?php echo $result['Contact']['email']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Phone</label>
                            <div class="col-lg-9">
                                <?php echo $result['Contact']['phone']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Subject</label>
                            <div class="col-lg-9">
                                <?php echo $result['Contact']['subject']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Message</label>
                            <div class="col-lg-9">
                                <?php echo $result['Contact']['message']; ?>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reply</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo BASE_URL; ?>admin/contacts/reply/<?php echo $this->params['pass']['0']; ?>" class="validation_form" id="myForm">
                    <div class="form-group">
                        <input type="text" class="form-control validate[required]" name="data[Contact][reply_name]" value="<?php echo $result['Contact']['name']; ?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control validate[required]" name="data[Contact][reply_email]" value="<?php echo $result['Contact']['email']; ?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control validate[required]" name="data[Contact][reply_subject]" placeholder="Subject"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control validate[required]" name="data[Contact][reply_message]" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
