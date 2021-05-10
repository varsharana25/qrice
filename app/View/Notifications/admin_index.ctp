<div id="page_content">
    <div id="page_content_inner">



        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Notifications List</h3>
                    </div>


                </div>

                <div class="custom-table offer-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Notification Id</th>
                                <th width="50%">Notification Description</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>



                        <tbody>
                            <?php foreach ($notifications as $notification) { ?>
                                <tr>

                                    <td><?php echo ($notification['Notification']['id'] + 1000) ?></td>
                                    <td class="off-desc">
                                        <?php
                                        $string = strip_tags($notification['Notification']['text']);
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
                                    <td><?php echo date('d-m-Y', strtotime($notification['Notification']['expiry_date'])); ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/notifications/view/<?php echo $notification['Notification']['id']; ?>"><i class="md-icon material-icons">visibility</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/notifications/delete/<?php echo $notification['Notification']['id']; ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
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
