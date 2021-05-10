
<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">FAQs List</h3>
                    </div>
                    <div align="right" class="uk-width-medium-2-10">
                    </div>
                </div>
                <div class="custom-table product-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Faq Id</th>
                                <th>Title</th>
                                <th width="40%">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = $this->Paginator->counter('{:start}');
                            foreach ($faqs as $faq) {
                                ?>
                                <tr>
                                    <td width="5%"><?php echo ($i + 1000); ?></td>
                                    <td><?php echo $faq['Faq']['title']; ?></td>
                                    <td>
                                        <?php
                                        $string = strip_tags($faq['Faq']['detail']);
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
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/faqs/edit/<?php echo $faq['Faq']['faq_id'] ?>"><i class="md-icon material-icons">edit</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/faqs/delete/<?php echo $faq['Faq']['faq_id'] ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
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
