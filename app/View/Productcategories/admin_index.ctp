<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Productcategory List</h3>
                    </div>
                    <div align="right" class="uk-width-medium-2-10">
                        <a href="<?php echo BASE_URL; ?>admin/productcategories/add" class="md-btn md-btn-primary">+</a>
                    </div>
                </div>
                <div class="custom-table product-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productcategories as $category) {
                                $parent_category = ClassRegistry::init('Productcategory')->find('first', array('conditions' => array('procategory_id' => $category["Productcategory"]['parent_id'])));
                                ?>
                                <tr>
                                    <td><?php echo ($category['Productcategory']['procategory_id'] + 1000); ?></td>
                                    <td><?php echo $category['Productcategory']['name']; ?></td>                                  
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/productcategories/edit/<?php echo $category['Productcategory']['procategory_id']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/productcategories/delete/<?php echo $category['Productcategory']['procategory_id']; ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
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