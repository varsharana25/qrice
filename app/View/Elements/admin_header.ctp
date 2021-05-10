<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">
            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">fullscreen</i></a></li>
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_image"><img class="md-user-image" style="height: 34px;" src="<?php echo BASE_URL; ?>files/admin/<?php echo $sessionadmin['Adminuser']['profile'] ?>" onerror="src='<?php echo BASE_URL; ?>theme/assets/img/avatars/avatar_11_tn@4x.png'" alt=""/></a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                <li><a href="<?php echo BASE_URL; ?>admin/adminusers/profile">My Profile</a></li>
                                <li><a href="<?php echo BASE_URL; ?>admin/adminusers/logout">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header><!-- main header end -->