
<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Promo Codes List</h3>
                    </div>
                    <div align="right" class="uk-width-medium-2-10">
                    </div>
                </div>
                <div class="custom-table product-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Code Id</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Code</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($promocodes as $promocode) { ?>
                                <tr>
                                    <td><?php echo ($promocode['Promocode']['id'] + 1000) ?></td>
                                    <td><?php echo $promocode['Promocode']['type']; ?></td>
                                    <td><?php echo $promocode['Promocode']['value']; ?></td>
                                    <td><?php echo $promocode['Promocode']['code']; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($promocode['Promocode']['expiry_date'])); ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/promocodes/delete/<?php echo $promocode['Promocode']['id'] ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
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