<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Products</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <div class="card">
            <div class="card-body">
                <a class="btn btn-danger float-right" href="<?php echo BASE_URL; ?>vendors/addproduct">Add <i class="fa fa-plus"></i></a>
                <form method="get" action="<?php echo BASE_URL; ?>vendors/products" class="form-inline">
                    <div class="form-group">
                        <input type="text" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : "" ?>" class="form-control validate[required]" name="s" placeholder="Search"/>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $category) { ?>
                                <option <?php echo (!empty($_REQUEST['category_id']) && $_REQUEST['category_id']==$category['Productcategory']['procategory_id']) ? 'selected' :'' ?> value="<?php echo $category['Productcategory']['procategory_id']; ?>"><?php echo $category['Productcategory']['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php if (!empty($subcategories)) { ?>
                        <div class="form-group">
                            <select class="form-control" name="subcategory_id">
                                <option value="">All Sub Categories</option>
                                <?php foreach ($subcategories as $category) { ?>
                                    <option <?php echo (!empty($_REQUEST['subcategory_id']) && $_REQUEST['subcategory_id']==$category['Productcategory']['procategory_id']) ? 'selected' :'' ?>  value="<?php echo $category['Productcategory']['procategory_id']; ?>"><?php echo $category['Productcategory']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <button class="btn btn-danger top-search" name="search" type="submit">Search</button>
                        <?php if (isset($_REQUEST['search'])) { ?><a class="btn btn-warning" href="<?php echo BASE_URL; ?>vendors/products">Cancel</a><?php } ?> 
                    </div>
                </form>
            </div>
        </div>
        <?php if (!empty($products)) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Price</th>
                                        <th>Subscription</th>
                                        <th  class="text-right"><?php echo __('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="image-logo">
                                    <?php
                                    $i = $this->Paginator->counter('{:start}');
                                    foreach ($products as $product) {
                                        $subcategory = ClassRegistry::init('Productcategory')->find('first', array('conditions' => array('procategory_id' => $product['Product']['subcategory_id'])));
                                        $variation = ClassRegistry::init('Productvariation')->find('all', array('fields' => array('MAX(Productvariation.price) as max', 'MIN(Productvariation.price) as min'), 'conditions' => array('product_id' => $product['Product']['product_id'])));
                                        ?>
                                        <tr>
                                            <td><?php echo h($i); ?></td>
                                            <td><img src="<?php echo BASE_URL; ?><?php echo $sessionvendor['Vendor']['vendor_path'] . '/' . $product['Product']['image']; ?>" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'" class="avatar-sm"/></td>
                                            <td>
                                                <?php echo $product['Product']['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $product['Productcategory']['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $subcategory['Productcategory']['name']; ?>
                                            </td>
                                            <td>
                                                Rs. <?php echo (($product['Product']['variation_type']=='Single') ? $variation[0][0]['max'] : $variation[0][0]['min'] . '-' . $variation[0][0]['max'] ); ?>
                                            </td>
                                            <td>
                                                <?php echo ($product['Product']['subscription'] == '1') ? 'Yes' : 'No'; ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">        
<!--                                                    <a href="<?php echo BASE_URL; ?>vendors/viewproduct/<?php echo $product['Product']['product_id']; ?>" class="btn btn-outline-info" title="View">   
                                                        <i class="fa fa-eye"></i>
                                                    </a>-->
                                                    <a href="<?php echo BASE_URL; ?>vendors/editproduct/<?php echo $product['Product']['product_id']; ?>" class="btn btn-outline-info" title="Edit">   
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo BASE_URL; ?>vendors/deleteproduct/<?php echo $product['Product']['product_id']; ?>" class="delconfirm btn btn-outline-info" title="Delete">   
                                                        <i class="fa fa-trash"></i>
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
