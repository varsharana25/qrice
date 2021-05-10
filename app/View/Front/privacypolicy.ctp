<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="section-title page-title">
                    <h3 class="small-title">Privacy Policy</h3>
                </div><!-- end text-widget -->
            </div><!-- end col -->
        </div>
    </div>
</div>
<div class="section lb">
    <div class="container">
        <?php
        $page = ClassRegistry::init('Staticpage')->find('first',array('conditions'=>array('page_id'=>'5')));
        ?>
        <?php echo $page['Staticpage']['page_content']; ?>
    </div><!-- end container -->
</div><!-- end section -->
