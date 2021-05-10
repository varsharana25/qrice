<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Add Product</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/products">Products</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <!-- end page title -->
        <form class="validation_form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">                    
                            <div class="form-group">
                                <label class=" control-label"> Product Name <span class="tx-danger">*</span></label>
                                <div class="">
                                    <input type="text" class="form-control validate[required]" name="data[Product][name]" value="<?php echo (!empty($this->request->data['Product']['name'])) ? $this->request->data['Product']['name'] : ""; ?>"/>
                                </div>
                            </div>      
                            <div class="form-group">
                                <label class=" control-label"> Product Description <span class="tx-danger">*</span></label>
                                <div class="">
                                    <input type="text" class="form-control" name="data[Product][description]" value="<?php echo (!empty($this->request->data['Product']['description'])) ? $this->request->data['Product']['description'] : ""; ?>"/>
                                </div>
                            </div>      
                            <div class="form-group">
                                <label class=" control-label"> Product Category <span class="tx-danger">*</span></label>
                                <select class="form-control" id="maincategory" name="data[Product][category_id]">
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option <?php echo (!empty($this->request->data['Product']['category_id']) && $this->request->data['Product']['category_id'] == $category['Productcategory']['procategory_id']) ? 'selected' : '' ?> value="<?php echo $category['Productcategory']['procategory_id']; ?>"><?php echo $category['Productcategory']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label"> Sub Category <span class="tx-danger">*</span></label>
                                <select class="form-control" name="data[Product][subcategory_id]" id="subcategory">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label"> Variation Type <span class="tx-danger">*</span></label>
                                <select class="form-control" name="data[Product][variation_type]" id="variation_type">
                                    <option value="">Select Variation Type</option>
                                    <option <?php echo (!empty($this->request->data['Product']['variation_type']) && $this->request->data['Product']['variation_type'] == 'Single') ? 'selected' : '' ?>  value="Single">Single</option>
                                    <option  <?php echo (!empty($this->request->data['Product']['variation_type']) && $this->request->data['Product']['variation_type'] == 'Multiple') ? 'selected' : '' ?>  value="Multiple">Multiple</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label no-padding-right">Product Image<span class="tx-danger">*</span></label>
                                <div class="">                                      
                                    <input type="file" name="data[Product][image]" class="form-control validate[custom[image]]"/>
                                    <p><small>Recommended Size: 100*100</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-body"> 
                            <div id="variation">
                                <div  class="variation-div row form-group">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control validate[required]" name="data[Productvariation][variation][]" placeholder="Variation"/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control validate[required]" name="data[Productvariation][mrp][]" placeholder="Mrp"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="data[Productvariation][salesprice][]" placeholder="Sales Price"/>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control validate[required]" name="data[Productvariation][availability][]">
                                            <option value="">Availability</option>
                                            <option value="In Stock">In Stock</option>
                                            <option value="Out Of Stock">Out Of Stock</option>
                                        </select>

                                    </div>
                                    <div class="col-md-1">
                                        <a class="remove remove-div" href="javascript:;" style="display:none"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                                <div class="mg-t-20 addmore-div" style="display:none">
                                    <a class="variationaddmore" href="javascript:;">Add More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button class="btn btn-danger" type="submit"> Submit </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).on('change', '#maincategory', function() {
        if ($(this).val() != '') {
            $.ajax({
                url: "<?php echo BASE_URL; ?>vendors/ajaxSubcategory/" + $(this).val(),
                cache: false,
                success: function(html) {
                    $("#subcategory").html(html);
                }
            });
        } else {
            $("#subcategory").html('');
        }
    });
    $(document).on('click', '.variationaddmore', function() {
        var html = '<div class="row form-group">';
        html += '<div class="col-md-3">';
        html += '<input type="text" class="form-control validate[required]" name="data[Productvariation][variation][]" placeholder="Variation"/>';
        html += '</div>';
        html += '<div class="col-md-2">';
        html += '<input type="text" class="form-control validate[required]" name="data[Productvariation][mrp][]" placeholder="Mrp"/>';
        html += '</div>';
        html += '<div class="col-md-3">';
        html += '<input type="text" class="form-control" name="data[Productvariation][salesprice][]" placeholder="Sales Price"/>';
        html += '</div>';
        html += '<div class="col-md-3">';
        html += '<select class="form-control validate[required]" name="data[Productvariation][availability][]"><option value="">Availability</option>';
        html += '<option name="In Stock">In Stock</option>';
        html += '<option name="Out Of Stock">Out Of Stock</option>';
        html += '</select>';
        html += '</div>';
        html += '<div class="col-md-1">';
        html += '<a class="remove" href="javascript:;"><i class="fa fa-trash"></i></a>';
        html += '</div>';
        html += '</div>';
        $(this).before(html);
    });
    $(document).on('click', '.remove', function() {
        $(this).parents('.variation-div').remove();
    });

    $(document).on('change', '#variation_type', function() {
        if ($(this).val() == 'Single') {
            $('.variation-div').not('.variation-div:first').remove();
            $('.addmore-div').hide();
            $('.remove-div').hide();
        } else {
            $('.addmore-div').show();
            $('.remove-div').show();
            $('.addmore').trigger('click');
        }
    });
</script>