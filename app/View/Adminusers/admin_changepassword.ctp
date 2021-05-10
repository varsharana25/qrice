<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Change Password</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active" href='<?php echo BASE_URL; ?>users/changepassword'>Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" action="#" class="validation_form" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Current Password</label>
                                <div class="col-md-10">
                                    <input type="password" name="data[Adminuser][oldpassword]" class="form-control validate[required]" placeholder="Current Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">New Password</label>
                                <div class="col-md-10">
                                    <input type="password" id="password" name="data[Adminuser][password]" class="form-control validate[required]" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Confirm Password</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control validate[required,equals[password]]" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-danger waves-effect waves-light">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
