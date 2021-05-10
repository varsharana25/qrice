<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
<?php
$category_ids = explode(',', $entry['Entry']['category_id']);
$categories = ClassRegistry::init('Category')->find('all', array('conditions' => array('category_id' => $category_ids)));
$registered_in = '';
foreach ($categories as $category) {
    $registered_in .= $category['Category']['name'] . ',';
}
?>
<div class="section lb">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="col-md-4">
                    <img src="<?php echo BASE_URL; ?>files/entries/<?php echo $entry['Entry']['image'] ?>" class="nominee-img"/>
                </div>
                <div class="col-md-8">
                    <h2 style="margin-top: 0;"><?php echo $entry['Entry']['title']; ?></h2>
                    <h3>Registered In:  <?php echo $registered_in; ?></h3>
                    <?php
                    $checkvote = (!empty($this->Session->read('User.user_id'))) ? ClassRegistry::init('Entryvote')->find('first', array('conditions' => array('entry_id' => $entry['Entry']['entry_id'], 'user_id' => $this->Session->read('User.user_id')))) : array();
                    if (empty($checkvote)) {
                        ?>
                        <p><a href="<?php echo BASE_URL; ?>home/entryvote/<?php echo $entry['Entry']['entry_id']; ?>" class="btn btn-primary">VOTE</a></p>
                    <?php } else {
                        ?>
                        <p><a href="javascript:;" class="btn btn-primary">VOTED</a></p>
                    <?php }
                    ?>
                </div>
            </div><!-- end col -->
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row list-items">
            <div class="col-md-9">
                <h3>Objective</h3>
                <p><?php echo $entry['Entry']['objective']; ?></p>
                <h3>Strategy</h3>
                <p><?php echo $entry['Entry']['strategy']; ?></p>
                <h3>Results</h3>
                <p><?php echo $entry['Entry']['results']; ?></p>
            </div>
            <div class="col-md-3">
                <h4>Agency Name</h4>
                <p><?php echo $entry['Entry']['agency_name']; ?></p>
                <h4>Client Name</h4>
                <p><?php echo $entry['Entry']['client_name']; ?></p>
                <h4>Company Name</h4>
                <p><?php echo $entry['Entry']['company_name']; ?></p>
                <h4>Produced By</h4>
                <p><?php echo $entry['Entry']['produced_by']; ?></p>
                <h4>Link</h4>
                <ul class="list-unstyled">
                    <?php
                    $links = explode(',', $entry['Entry']['link']);
                    foreach ($links as $link) {
                        ?>
                        <li><a href="<?php echo $link; ?>" target="_blank" style="word-wrap: break-word"><?php echo $link; ?></a></li>
                    <?php }
                    ?>
                </ul>
                <a class="btn btn-primary" data-toggle="modal" data-target="#contact">Contact Creator</a>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->

<!-- Modal -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">CONTACT THE CREATOR OF THIS ENTRY</h4>
            </div>
            <form method="POST" action="#" class="validation_form">
                <div class="modal-body"> 
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate[required]" name="name"/>
                    </div>
                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate[required]" name="title"/>
                    </div>
                    <div class="form-group">
                        <label>Company <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate[required]" name="company"/>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate[required]" name="email"/>
                    </div>
                    <div class="form-group">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate[required]" name="phone_number"/>
                    </div>
                    <div class="form-group">
                        <label>Why are you interested in connecting?</label>
                        <textarea class="form-control" name="interested"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.site-small-desc').matchHeight();
</script>