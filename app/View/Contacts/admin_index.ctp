
<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">App Contacts List</h3>
                    </div>
                </div>
                <div class="custom-table offer-table">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date & Time</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($results as $result) {
                                ?>
                                <tr>
                                    <td><?php echo sprintf("%02d", $i); ?></td>
                                    <td><?php echo $result['Contact']['name']; ?></td>
                                    <td><?php echo $result['Contact']['email']; ?></td>
                                    <td><?php echo $result['Contact']['phone']; ?></td>
                                    <td><?php echo $result['Contact']['subject']; ?></td>
                                    <td><?php echo $result['Contact']['message']; ?></td>
                                    <td><?php echo $result['Contact']['message']; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?php echo BASE_URL; ?>admin/contacts/delete/<?php echo $result['Contact']['contact_id']; ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
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
