<div class="wrap">
    <section class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="widget p-lg">
                    <?php if (!empty($emailcontents)) { ?>
                        <div class="table-responsive">
                            <table class="table table-striped nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Title </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($emailcontents as $emailcontent) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $emailcontent['Emailcontent']['Title']; ?>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo BASE_URL; ?>admin/emailcontents/edit/<?php echo $emailcontent['Emailcontent']['emailcontent_id'] ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="no-data text-center">
                            <img src="<?php echo BASE_URL; ?>img/no-data.png"/>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>