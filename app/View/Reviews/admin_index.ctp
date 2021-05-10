<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-4-10 uk-row-first">
                        <h3 class="heading_a">Rate & Review List</h3>
                    </div>
                    <div align="right" class="uk-width-medium-6-10">
                        <!--<label><strong class="color-danger">NOTE : </strong> Approved Rate & Review will be displayed in Play Store.</label>-->
                    </div>
                </div>
                <div class="custom-table offer-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Order Id</th>
                                <th>Rating</th>
                                <th width="40%">Review</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviews as $review) { ?>
                            <?php 
                            $user = ClassRegistry::init('User')->find('first',array('conditions'=>array('user_id'=>$review["Review"]['user_id'])));
                            $order = ClassRegistry::init('Order')->find('first',array('conditions'=>array('order_id'=>$review["Review"]['order_id'])));
                            ?>
                                <tr>
                                    <td><?php echo $review["Review"]['user_id'] + 1000; ?></td>
                                    <td><?php echo !empty($user["User"]['name']) ? $user["User"]['name'] : $user["User"]['email']; ?></td>
                                    <td><?php echo $order["Order"]['orderid']; ?></td>
                                    <td><?php echo $review["Review"]['rating']; ?>/5</td>
                                    <td class="off-desc"><?php echo $review["Review"]['review']; ?></td>
                                    <td>
                                        <!--<a href="<?php echo BASE_URL ?>admin/reviews/updatestatus/<?php echo $review["Review"]['review_id']; ?>" class="md-btn md-btn-<?php echo ($review["Review"]['review_status'] == 'Approved') ? 'primary' : 'danger'; ?> md-btn-mini"><?php echo $review["Review"]['review_status']; ?></a>-->
                                        <a href="<?php echo BASE_URL ?>admin/reviews/delete/<?php echo $review["Review"]['review_id']; ?>"><i class="md-icon material-icons">delete</i></a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>