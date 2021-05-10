<div class="section lb">
    <div class="container" style="background: #fff;padding: 30px;">
        <div class="row">
            <div class="col-md-5 match">
                <img src="<?php echo BASE_URL; ?>theme/awards/images/uploads/blog_01.jpg" class="img-responsive" style="height: 100%;object-fit: cover;"/>
            </div>
            <div class="col-md-7 match">
                <h1>ABOUT US</h1>
                <br/>
                <?php
                $page = ClassRegistry::init('Staticpage')->find('first', array('conditions' => array('page_id' => '1')));
                ?>
                <?php echo $page['Staticpage']['page_content']; ?>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end section -->

<script>
    $('.match').matchHeight();
</script>