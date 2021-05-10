<?php $settings = ClassRegistry::init('Sitesetting')->find('first'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $settings['Sitesetting']['site_title']; ?></title>
        <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
    </head>
    <body>
        <style>
            p{
                margin-bottom: 5px;
            }
        </style>
        <div class="wrapper" style="background: #e9ebee;padding:20px 50px;font-family: calibri;font-size:16px;">
            <h4 style="font-size: 30px;margin: 0;color: #188ae2;"><strong><?php echo $settings['Sitesetting']['site_title']; ?></strong></h4>
            <div style="background: #fff;margin:15px 0;">
                <div style="padding: 20px;">
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
            <div style="background: #fff;padding: 10px;text-align: center;">
                <p style="margin:0;"> © <?php echo date('Y') ?> <?php echo $settings['Sitesetting']['site_title']; ?>. </p>
            </div>
        </div>
    </body>
</html>
