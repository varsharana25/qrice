<div id="page_content">
    <div id="page_content_inner">
        <div action="" class="uk-form-stacked" id="user_edit_form">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-7-10">
                    <div class="md-card">
                        <form action="<?php echo BASE_URL; ?>admin/adminusers/profile" method="post" class="validation_form" enctype="multipart/form-data">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="<?php echo BASE_URL; ?>files/admin/<?php echo $sessionadmin['Adminuser']['profile']; ?>" onerror="src='<?php echo BASE_URL; ?>theme/assets/img/avatars/user.png'" alt="user avatar"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                            <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                            <input type="file" name="data[Adminuser][profile]" class="validate[custom[image]]" id="user_edit_avatar_control">
                                        </span>
                                        <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                    </div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"><?php echo $sessionadmin['Adminuser']['adminname']; ?></span></h2>
                                </div>
                            </div>
                            <div class="edit-profile">
                                <h3 class="full_width_in_card heading_c">
                                    Personal Information
                                </h3>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <i class="md-list-addon-icon material-icons">face</i>
                                                </span>
                                                <label>Full Name</label>
                                                <input type="text" class="md-input form-control validate[required]" name="data[Adminuser][adminname]" value="<?php echo $sessionadmin['Adminuser']['adminname']; ?>" />
                                            </div>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                </span>
                                                <label>Email</label>
                                                <input type="text" class="md-input form-control validate[required,custom[email]]" name="data[Adminuser][email]" value="<?php echo $sessionadmin['Adminuser']['email']; ?>" />
                                            </div>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                </span>
                                                <label>Phone Number</label>
                                                <input type="text" class="md-input validate[required,custom[phone]]" name="data[Adminuser][mobile]" value="<?php echo $sessionadmin['Adminuser']['mobile']; ?>" />
                                            </div>
                                        </div>
                                        <div class="mp-update-btn">
                                            <button type="submit" class="md-btn md-btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </form>
                    </div>
                </div>
                <div class="uk-width-large-3-10">
                    <form method="post" action="<?php echo BASE_URL; ?>admin/adminusers/changepassword" class="validation_form">
                        <div class="md-card">
                            <div class="edit-profile">
                                <h3 class="full_width_in_card heading_c">
                                    Set New Password
                                </h3>
                                <div class="uk-grid">

                                    <div class="uk-width-1-1">
                                        <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-1" data-uk-grid-margin>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <i class="md-list-addon-icon material-icons">lock</i>
                                                </span>
                                                <label>Old Password</label>
                                                <input type="password" class="md-input validate[required,minSize[6]]" name="data[Adminuser][oldpassword]" value="" />
                                            </div>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <i class="md-list-addon-icon material-icons">lock</i>
                                                </span>
                                                <label>New Password</label>
                                                <input type="password" id="password" class="md-input validate[required,minSize[6]]" />
                                            </div>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <i class="md-list-addon-icon material-icons">lock</i>
                                                </span>
                                                <label>Confirm Password</label>
                                                <input type="password" class="md-input validate[required,minSize[6],equals[password]]" name="data[Adminuser][password]" value="" />
                                            </div>
                                        </div>
                                        <div class="mp-update-btn">
                                            <button type="submit"  class="md-btn md-btn-primary">SET PASSWORD</button>
                                        </div>
                                    </div>

                                </div>	
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
