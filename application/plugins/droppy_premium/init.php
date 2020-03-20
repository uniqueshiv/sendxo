<?php

require_once dirname(__FILE__) . '/autoloader.php';

if(isset($_SESSION['droppy_premium'])) {
    $clsSettings = new PremiumSettings();

    if($clsSettings->checkSettings())
    {
        $premium_settings = $clsSettings->getSettings();

        // Premium upload settings
        $this->CI->config->config['max_size'] = $premium_settings['max_size'];
        $this->CI->config->config['pm_pass_enabled'] = 'true';
        $this->CI->config->config['expire'] = $premium_settings['expire_time'];
        $this->CI->config->config['ad_enabled'] = $premium_settings['ad_enabled'];
        if ($this->CI->config->config['ad_enabled'] == 'false')
        {
            $this->CI->config->config['ad_1_enabled'] = 'false';
            $this->CI->config->config['ad_2_enabled'] = 'false';
        }
    }
}

