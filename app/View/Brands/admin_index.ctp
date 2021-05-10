<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Brand List</h3>
                    </div>
                    <div align="right" class="uk-width-medium-2-10">
                        <a href="<?php echo BASE_URL; ?>admin/brands/add"  class="md-btn md-btn-primary">+</a>
                    </div>
                </div>
                <div class="custom-table product-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Brand Id</th>
                                <th>Brand Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brands as $brand) { ?>
                                <tr>
                                    <td><?php echo $brand['Brand']['brand_id'] + 1000; ?></td>
                                    <td><?php echo $brand['Brand']['name']; ?></td>   
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/brands/edit/<?php echo $brand['Brand']['brand_id']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/brands/delete/<?php echo $brand['Brand']['brand_id']; ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
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
