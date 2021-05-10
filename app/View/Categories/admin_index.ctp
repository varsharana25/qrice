<div id="page_content">
    <div id="page_content_inner">



        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Category List</h3>
                    </div>

                    <div align="right" class="uk-width-medium-2-10">
                        <a href="categoery-add.php" type="button" class="md-btn md-btn-primary">+</a>
                    </div>
                </div>

                <div class="custom-table product-table">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>



                        <tbody>
                            <?php foreach ($categories as $category) { ?>
                            <tr>

                                <td>1001</td>
                                <td><?php echo $category['Category']['name']; ?></td>
                                 <td><img src="<?php echo BASE_URL; ?>files/categoryimages/<?php echo $category['Category']['image'] ?>" class="avatar-sm" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'"/></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>admin/categories/edit/<?php echo $category['Category']['category_id']; ?>"><i class="md-icon material-icons">&#xE254;</i></a>
                                    <a href="<?php echo BASE_URL; ?>admin/categories/delete/<?php echo $category['Category']['category_id']; ?>"><i class="md-icon material-icons">delete</i></a>
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

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Business Categories</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/adminusers/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Business Categories</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <!-- end page title -->
        <?php if (!empty($categories)) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>    
                                        <th scope="col" style="width:100px"></th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Delivery Charge</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($categories as $category) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><img src="<?php echo BASE_URL; ?>files/categoryimages/<?php echo $category['Category']['image'] ?>" class="avatar-sm" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'"/></td>
                                            <td><?php echo $category['Category']['name']; ?></td>   
                                            <td><label class="badge badge-<?php echo $category['Category']['status']; ?>"><?php echo $category['Category']['status']; ?></label></td>   
                                            <td>Rs. <?php echo (!empty($category['Category']['delivery_charge'])) ? $category['Category']['delivery_charge']:"-"; ?></td>
                                            <td>
                                                <div class="btn-group hidden-xs-down">
                                                    <a href="<?php echo BASE_URL; ?>admin/categories/edit/<?php echo $category['Category']['category_id']; ?>" class="green btn btn-outline-info" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
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
