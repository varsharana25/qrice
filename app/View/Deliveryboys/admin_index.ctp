<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid" data-uk-grid-margin="">
            <div class="uk-width-medium-8-10 uk-row-first">
                <h3 class="heading_a">Delivery List</h3>
            </div>
            <div class="uk-width-medium-2-10" align="right">
                <a href="<?php echo BASE_URL; ?>admin/deliveryboys/add" class="md-btn md-btn-primary">+</a>
            </div>
        </div>
        <h3 class="heading_b uk-margin-bottom"></h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="uk-vertical-align">
                            <div class="uk-vertical-align-middle">
                                <ul id="contact_list_filter" class="uk-subnav uk-subnav-pill uk-margin-remove">
                                    <li class="uk-active"><a href="<?php echo BASE_URL;?>admin/deliveryboys/index">All</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form method="get" action="<?php echo BASE_URL;?>admin/deliveryboys/index"> 
                        <label for="contact_list_search">Search... (min 3 char.)</label>
                        <input class="md-input" type="text" name="s" value="<?php echo !empty($_GET['s']) ? $_GET['s'] : "";?>"/>
                        <input type="submit" class="btn btn-success" value="submit"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="heading_b uk-text-center grid_no_results" style="display:none">No results found</h3>
        <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-5 hierarchical_show" id="contact_list" data-show-delay="280">
            <?php
            foreach ($deliveryboys as $deliveryboy) {
                ?>
                <div data-uk-filter="<?php echo (!empty($deliveryboy['Deliveryboy']['name'])) ? $deliveryboy['Deliveryboy']['name'] : '-'; ?>">
                    <div class="md-card md-card-hover">
                        <div class="md-card-head">
                            <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-right'}">
                                <i class="md-icon material-icons">&#xE5D4;</i>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav">
                                        <li><a href="<?php echo BASE_URL; ?>admin/deliveryboys/view/<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?>">View</a></li>
                                        <li><a href="<?php echo BASE_URL; ?>admin/deliveryboys/edit/<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?>">Edit</a></li>
                                        <li><a href="<?php echo BASE_URL; ?>admin/deliveryboys/delete/<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?>">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="uk-text-center">
                                <img class="md-card-head-avatar" src="<?php echo BASE_URL; ?>files/deliveryboys/<?php echo $deliveryboy['Deliveryboy']['profile'] ?>" onerror="src='<?php echo BASE_URL; ?>img/default.png'" alt="" />
                            </div>
                            <h3 class="md-card-head-text uk-text-center">
                                <?php echo (!empty($deliveryboy['Deliveryboy']['name'])) ? $deliveryboy['Deliveryboy']['name'] : '-'; ?> <span class="uk-text-truncate"><?php echo $deliveryboy['Deliveryboy']['deliveryboyid']; ?></span>
                            </h3>
                            <!--<div class="md-card-employe-status">-->
                            <!--    <input type="checkbox" data-switchery <?php //echo ($deliveryboy['Deliveryboy']['status'] = 'Active') ? 'checked' : '' ?> id="switch_demo_<?php //echo $deliveryboy['Deliveryboy']['deliveryboy_id'] ?>" />-->
                            <!--    <label for="switch_demo_<?php //echo $deliveryboy['Deliveryboy']['deliveryboy_id'] ?>" class="inline-label"><?php //echo $deliveryboy['Deliveryboy']['status']; ?></label>-->
                            <!--</div>-->
                            <div class="userstatus text-center">
                                <a href="<?php echo BASE_URL; ?>admin/deliveryboys/updatestatus/<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?>/<?php echo ($deliveryboy['Deliveryboy']['status'] == 'Active') ? 'Inactive' : 'Active' ?>" class="md-btn md-btn-<?php echo ($deliveryboy['Deliveryboy']['status'] == 'Active') ? 'success' : 'danger' ?> md-btn-mini"><?php echo $deliveryboy['Deliveryboy']['status']; ?></a>
                            </div>
                        </div>
                        <div class="md-card-content">
                            <ul class="md-list">
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Email</span>
                                        <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo (!empty($deliveryboy['Deliveryboy']['email'])) ? $deliveryboy['Deliveryboy']['email'] : '-'; ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Phone</span>
                                        <span class="uk-text-small uk-text-muted"><?php echo $deliveryboy['Deliveryboy']['mobile']; ?></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row newpagination">
                            <div class="col-md-6">
                                <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                                    <?php
                                    echo $this->Paginator->counter(array(
                                        'format' => __('Page') . ' {:page} ' . __('of') . ' {:pages}, ' . __('showing') . ' {:current} ' . __('records out of') . ' {:count} ' . __('entries')
                                    ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6" style="position: absolute;right: 24px;">
                                <div class="dataTables_paginate paging_simple_numbers pull-right" id="sample-table-2_paginate">
                                    <ul class="pagination">
                                        <?php
                                        echo $this->Paginator->prev('Previous', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a>Previous</a>', array('class' => 'prev disabled page-link', 'tag' => 'li', 'escape' => false));
                                        $numbers = $this->Paginator->numbers();
                                        if (empty($numbers)) {
                                            echo '<li class="active page-link"><a>1</a></li>';
                                        } else {
                                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'class' => 'page-link', 'first' => 'First page', 'currentClass' => 'active', 'currentTag' => 'a'));
                                        }
                                        echo $this->Paginator->next('Next', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a>Next</a>', array('class' => 'next disabled page-link', 'tag' => 'li', 'escape' => false));
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
    </div>
</div>
<style>
    input.btn.btn-success {
    background: green;
    color: #fff;
    border: 1px solid green;
    padding: 5px 16px;
    font-size: 14px;
    border-radius: 10px;
    margin-top: 10px;
    margin-bottom: -16px;
}.row.newpagination {
    display: inline-flex;
    width:100%;
}.page-link a {
    background: #ffffff;
    padding: 5px 13px;
    display: inline-block;
    margin-top: 16px;
    margin-left: 4px;
    color: #333;
}ul.pagination {
    display: inline-flex;
    list-style: none;
}li.active.page-link a {
    background: #7cb342;
    color: #fff;
}div#sample-table-2_info {
    margin-top: 21px;
}
</style>