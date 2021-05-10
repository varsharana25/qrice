<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Users</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/adminusers/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>  

        <!-- end page title -->
        <?php if (!empty($staticpages)) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Page Name</th>
                                        <th class="text-center"> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = $this->Paginator->counter('{:start}');
                                    foreach ($staticpages as $staticpage) {
                                        ?>
                                        <tr>
                                            <td width="5%"><?php echo $i; ?></td>
                                            <td><?php echo $staticpage['Staticpage']['page_title']; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <?php
                                                    echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit/' . $staticpage['Staticpage']['page_id']), array('escape' => false, 'class' => 'btn btn-default', 'rel' => 'tooltip', 'title' => 'Edit'));
                                                    ?>
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
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-4">
                        <?php
                        echo $this->Paginator->prev('<i class="mdi mdi-chevron-left"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="mdi mdi-chevron-left"></i></a>', array('class' => 'prev disabled page-link', 'tag' => 'li', 'escape' => false));
                        $numbers = $this->Paginator->numbers();
                        if (empty($numbers)) {
                            echo '<li class="active page-link"><a>1</a></li>';
                        } else {
                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'class' => 'page-link', 'first' => 'First page', 'currentClass' => 'active', 'currentTag' => 'a'));
                        }
                        echo $this->Paginator->next('<i class="mdi mdi-chevron-right"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="mdi mdi-chevron-right"></i></a>', array('class' => 'next disabled page-link', 'tag' => 'li', 'escape' => false));
                        ?>
                    </ul>
                </div> <!-- end col-->
            </div>
        <?php } else { ?>
            <div class="no-data text-center">
                <img src="<?php echo BASE_URL; ?>img/no-data.png"/>
            </div>
        <?php } ?>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->