<div id="page_content">
    <div id="page_content_inner">



        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Offers List</h3>
                    </div>


                </div>

                <div class="custom-table offer-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Offer Id</th>
                                <th width="50%">Offer Description</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>



                        <tbody>
                            <?php foreach ($offers as $offer) { ?>
                                <tr>

                                    <td><?php echo ($offer['Offer']['id'] + 1000) ?></td>
                                    <td class="off-desc">
                                        <?php
                                        $string = strip_tags($offer['Offer']['text']);
                                        if (strlen($string) > 80) {
                                            // truncate string
                                            $stringCut = substr($string, 0, 80);
                                            $endPoint = strrpos($stringCut, ' ');

                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '...';
                                        }
                                        echo $string;
                                        ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($offer['Offer']['expiry_date'])); ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/offers/view/<?php echo $offer['Offer']['id']; ?>"><i class="md-icon material-icons">visibility</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/offers/delete/<?php echo $offer['Offer']['id']; ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
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
