<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<?php
$category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $_REQUEST['category_id'])));
?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="section-title page-title">
                    <h3 class="small-title">Best <?php echo $category['Category']['name']; ?></h3>
                </div><!-- end text-widget -->
            </div><!-- end col -->
        </div>
    </div>
</div>
<div class="section lb">
    <div class="container">
        <div class="row list-items">
            <?php foreach ($entries as $entry) { ?>
                <div class="col-md-3 col-sm-6 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="site-wrapper">
                        <div class="award-image entry">
                            <a href="<?php echo BASE_URL; ?>home/entrydetail/<?php echo $entry['Entry']['entry_id']; ?>" title="">
                                <img src="<?php echo BASE_URL; ?>files/entries/<?php echo $entry['Entry']['image']; ?>" alt="" class="img-responsive">
                            </a>
                        </div><!-- end image -->

                        <div class="site-small-desc clearfix">  
                            <div class="pull-left">
                                <a href="<?php echo BASE_URL; ?>home/entrydetail/<?php echo $entry['Entry']['entry_id']; ?>" title=""><h4><?php echo $entry['Entry']['title']; ?></h4></a>
                                <p>
                                    <?php
                                    $string = strip_tags($entry['Entry']['objective']);
                                    if (strlen($string) > 100) {
                                        // truncate string
                                        $stringCut = substr($string, 0, 100);
                                        $endPoint = strrpos($stringCut, ' ');
                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '...';
                                    }
                                    echo $string;
                                    ?>
                                </p>
                            </div>
                            <div class="likebutton pull-right text-center">
                                <a href="<?php echo BASE_URL; ?>home/entryvote/<?php echo $entry['Entry']['entry_id']; ?>" class="btn btn-primary">VOTE</a>
                            </div><!-- end pull-right -->
                        </div><!-- end desc -->
                    </div><!-- end site-wrapper -->
                </div><!-- end col -->
            <?php } ?>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->
<style>
    .blog-list a {
        display: block;
        text-align: center;
    }
    .blog-list h4 {
        border-bottom: 1px solid #f7f6f6;
        padding-bottom: 30px;
        margin-bottom: 30px;
        font-size: 29px;
    }
</style>
<script>
    $('.site-small-desc').matchHeight();
</script>