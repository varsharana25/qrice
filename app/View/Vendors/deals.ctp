<div class="br-mainpanel">
    <div class="br-pagetitle">
        <div class="col-md-6">
            <h4><span><i class="icon icon ion-ios-book-outline"></i> </span>Outlets</h4>
        </div> 
        <div class="col-md-6">
            <div class="btn-group float-right">
                <a href="<?php echo BASE_URL; ?>vendors/addoutlet" class="btn br-menu-link active addbtn"><i class="la la-barcode"></i>Add Outlet</a>
            </div>
        </div>
    </div><!-- d-flex -->
    <div class="br-pagebody">
        <div class="br-section-wrapper">  
            <?php if (!empty($outlets)) { ?>
                <div class="table-responsive">
                    <table class="table datatable-basic table-bordered">
                        <thead class="thead-colored thead-dark">
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Name</th>                          
                                <th>Category</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Pincode</th>
                                <th>Business Email</th>
                                <th>Business Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = $this->Paginator->counter('{:start}');
                            foreach ($outlets as $outlet) {
                                $category = ClassRegistry::init('Dealcategory')->find('first', array('conditions' => array('id' => $outlet['Outlet']['dealcategory_id'])));
                                ?>
                                <tr class="">
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo BASE_URL; ?>files/outlets/<?php echo $outlet['Outlet']['logo']; ?>"/></td>
                                    <td><?php echo $outlet['Outlet']['outlet_name']; ?></td>
                                    <td><?php echo $category['Dealcategory']['name']; ?></td>
                                    <td><?php echo $outlet['Outlet']['address']; ?></td>
                                    <td><?php echo $outlet['Outlet']['city']; ?></td>
                                    <td><?php echo $outlet['Outlet']['state']; ?></td>
                                    <td><?php echo $outlet['Outlet']['pincode']; ?></td>
                                    <td><?php echo $outlet['Outlet']['business_email']; ?></td>
                                    <td><?php echo $outlet['Outlet']['business_phone']; ?></td>
                                    <td><label class="label label-<?php echo $outlet['Outlet']['status']; ?>"><?php echo $outlet['Outlet']['status']; ?></label></td>
                                    <td>
                                        <div class="btn-group hidden-xs-down">        
                                            <a href="<?php echo BASE_URL; ?>vendors/editoutlet/<?php echo $outlet['Outlet']['outlet_id']; ?>" class="green btn btn-outline-info" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>vendors/deleteoutlet/<?php echo $outlet['Outlet']['outlet_id']; ?>" class="green deleteconfirm btn btn-outline-info" title="Delete">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                                <?php
                                echo $this->Paginator->counter(array(
                                    'format' => __('Page') . ' {:page} ' . __('of') . ' {:pages}, ' . __('showing') . ' {:current} ' . __('records out of') . ' {:count} ' . __('entries')
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers pull-right" id="sample-table-2_paginate">
                                <ul class="pagination">
                                    <?php
                                    echo $this->Paginator->prev('<i class="fa fa-angle-left"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="fa fa-angle-left"></i></a>', array('class' => 'prev disabled page-link', 'tag' => 'li', 'escape' => false));
                                    $numbers = $this->Paginator->numbers();
                                    if (empty($numbers)) {
                                        echo '<li class="active page-link"><a>1</a></li>';
                                    } else {
                                        echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'class' => 'page-link', 'first' => 'First page', 'currentClass' => 'active', 'currentTag' => 'a'));
                                    }
                                    echo $this->Paginator->next('<i class="fa fa-angle-right"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="fa fa-angle-right"></i></a>', array('class' => 'next disabled page-link', 'tag' => 'li', 'escape' => false));
                                    ?>
                                </ul>
                            </div> 
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="text-center">
                    <img src="<?php echo BASE_URL; ?>img/no-data.png" class="img-responsive"/>
                </div>
            <?php } ?>
        </div>
    </div>
</div>