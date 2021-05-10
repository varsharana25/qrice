<div class="section text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>INFLUENCER</h3>
                <?php
                $categories = ClassRegistry::init('Category')->find('all', array('conditions' => array('status' => "Active", 'parent_id' => '0', 'type' => 'INFLUENCERS')));
                foreach ($categories as $category) {
                    $subcategories = ClassRegistry::init('Category')->find('all', array('conditions' => array('status' => "Active", 'parent_id' => $category['Category']['category_id'], 'type' => 'INFLUENCERS')));
                    if (!empty($subcategories)) {
                        ?>
                        <div class="col-md-6">
                            <div class="bx-shadow">
                                <p class="h4"><?php echo $category['Category']['name']; ?></p>
                                <ul class="list-unstyled">
                                    <?php foreach ($subcategories as $subcategory) { ?>
                                        <li><a href="<?php echo BASE_URL; ?>nominees/index?category_id=<?php echo $subcategory['Category']['category_id']; ?>"><?php echo $subcategory['Category']['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-2">
                <div style="height:100%;border-right: 1px solid #ccc;width: 0.1px;margin: 0 auto;"></div>
            </div>
            <div class="col-md-5"> 
                <h3>BRANDS & ORG</h3>
                <?php
                $categories = ClassRegistry::init('Category')->find('all', array('conditions' => array('status' => "Active", 'parent_id' => '0', 'type' => 'BRANDS & ORGANIZATIONS')));
                foreach ($categories as $category) {
                    $subcategories = ClassRegistry::init('Category')->find('all', array('conditions' => array('status' => "Active", 'parent_id' => $category['Category']['category_id'], 'type' => 'BRANDS & ORGANIZATIONS')));
                    if (!empty($subcategories)) {
                        ?>
                        <div class="col-md-6">
                            <div class="bx-shadow">
                                <h5><?php echo $category['Category']['name']; ?></h5>
                                <ul class="list-unstyled">
                                    <?php foreach ($subcategories as $subcategory) { ?>
                                        <li><a href="<?php echo BASE_URL; ?>nominees/index?category_id=<?php echo $subcategory['Category']['category_id']; ?>"><?php echo $subcategory['Category']['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end section -->
<style>
    .bx-shadow {
        -webkit-box-shadow: -1px 0px 18px -4px rgba(247,217,247,1);
        -moz-box-shadow: -1px 0px 18px -4px rgba(247,217,247,1);
        box-shadow: 0px 1px 9px 0px rgb(245, 231, 243);
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 10px;
    }
    h3 {
        margin-bottom: 40px;
    }
</style>