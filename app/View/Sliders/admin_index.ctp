<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Banners List</h3>
                    </div>
                </div>
                <div class="custom-table offer-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Banner Id</th>
                                <th>Banner Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($sliders as $slider) {
                                ?>
                                <tr>
                                    <td width="5%"><?php echo $i; ?></td>
                                    <td width="5%"><?php echo (1000 + $slider['Slider']['slider_id']); ?></td>
                                    <td>
                                        <img src="<?php echo BASE_URL; ?>files/sliders/<?php echo $slider['Slider']['image'] ?>" style="max-width:50px;"/>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?php echo BASE_URL; ?>admin/sliders/delete/<?php echo $slider['Slider']['slider_id']; ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
