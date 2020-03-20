<?php
//Get the base dir.
$basedir = APPPATH . 'plugins/droppy_premium/';

?>
<div class="form-panel" id="settings" style="overflow:hidden;">
    <h3>Cron job:</h3>
    <p>You will need to set you cron job to the following directory path: <pre><?php echo $basedir . 'gateway/paypal/cron.php'; ?></pre></p>
    <p>Please take a look to the documentation for more info.</p>
    <br><br>
    <h3>Paypal IPN Path</h3>
    <p>Set the following IPN url in your paypal settings: <pre><?php echo $this->config->item('site_url') . 'page/ipn'; ?></pre></p>
    <p>Please take a look to the your documentation for more info.</p>
</div>