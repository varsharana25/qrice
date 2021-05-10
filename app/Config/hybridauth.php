<?php

Configure::write('Hybridauth', array(
    // openid providers
    "OpenID" => array(
        "enabled" => false
    ),
    "Yahoo" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => ""),
    ),
    "AOL" => array(
        "enabled" => false
    ),
    "Google" => array(
        "enabled" => true,
        "keys" => array("id" => "367165778652-6ru4br4eoj578vjjttihcs9j4l0m83po.apps.googleusercontent.com", "secret" => "BT78oDJfxltFqrKIOZL3bd8Z"),
    ),
    "Facebook" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => ""),
    ),
    "Twitter" => array(
        "enabled" => false,
        "keys" => array("key" => "", "secret" => "")
    ),
    // windows live
    "Live" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => "")
    ),
    "MySpace" => array(
        "enabled" => false,
        "keys" => array("key" => "", "secret" => "")
    ),
    "LinkedIn" => array(
        "enabled" => false,
        "keys" => array("key" => "", "secret" => "")
    ),
    "Foursquare" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => "")
    ),
));
