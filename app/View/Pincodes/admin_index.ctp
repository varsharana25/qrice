<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Pincodes List</h3>
                    </div>
                    <div align="right" class="uk-width-medium-2-10">
                        <a href="<?php echo BASE_URL;?>admin/pincodes/add" type="button" class="md-btn md-btn-primary">+</a>
                    </div>
                </div>

                <div class="custom-table product-table">
                     <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pincodes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                $i=1;
                                foreach($result as $result){ ?>
                                 <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $result['Pincode']['pincode']; ?></td>
                                <td>
                                   <a href="<?php echo BASE_URL; ?>admin/pincodes/delete/<?php echo $result['Pincode']['pin_id']; ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
                                </td>
                                </tr>
                                <?php }$i++; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>