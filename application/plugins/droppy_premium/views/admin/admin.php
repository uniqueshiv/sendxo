<?php

require_once dirname(__FILE__) . '/../../autoloader.php';

$clsSettings = new PremiumSettings();

// Check if the premium plugin is installed
if($clsSettings->checkSettings() === false) :
    if(isset($_GET['p']) && $_GET['p'] == 'install') {
        if($clsSettings->installPremium()) {
            sleep(2);
            redirect(current_url());
        }
    }
?>
<section id="main-content">
    <section class="wrapper" style="text-align: center;">
        <br><br>
        <a href="<?php echo current_url() ?>?p=install" class="btn btn-default">Run premium plugin installation</a>
    </section>
</section>
<?php
else:
$premium_settings = $clsSettings->getSettings();
?>
<section id="main-content">
    <section class="wrapper">
        <style>
            #buttonsNav {
                margin: 10px 0;
            }
        </style>

        <div id="buttonsNav">
            <a id="GeneralSettings" href="<?php echo current_url() . '?p=settings'; ?>" class="btn btn-default">General settings</a>
            <a id="SubUsers" href="<?php echo current_url() . '?p=users'; ?>" class="btn btn-default">Users</a>
            <a id="Subs" href="<?php echo current_url() . '?p=subs'; ?>" class="btn btn-default">Subscriptions</a>
            <a id="Subs" href="<?php echo current_url() . '?p=addsub'; ?>" class="btn btn-default">Add user & sub</a>
            <a id="Subs" href="<?php echo current_url() . '?p=vouchers'; ?>" class="btn btn-default">Vouchers</a>
            <a id="Subs" href="<?php echo current_url() . '?p=sys'; ?>" class="btn btn-default">System setup</a>
        </div>

        <?php
        //Check which page is requested
        if(isset($_GET['p']))
        {
            if ($_GET['p'] == 'users') :
                //Get the page
                require_once dirname(__FILE__) . '/users.php';
            elseif ($_GET['p'] == 'subs'):
                //Get the page
                require_once dirname(__FILE__) . '/subs.php';
            elseif ($_GET['p'] == 'sys') :
                //Get the page
                require_once dirname(__FILE__) . '/system.php';
            elseif ($_GET['p'] == 'addsub') :
                //Get the page
                require_once dirname(__FILE__) . '/addsub.php';
            elseif ($_GET['p'] == 'vouchers') :
                //Get the page
                require_once dirname(__FILE__) . '/vouchers.php';
            else:
                //Get the page
                require_once dirname(__FILE__) . '/settings.php';
            endif;
        }
        else
        {
            require_once dirname(__FILE__) . '/settings.php';
        }
        ?>
    </section>
</section>
<?php endif; ?>