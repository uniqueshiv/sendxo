<?php

// Load the autoloader
require_once dirname(__FILE__) . '/autoloader.php';

$clsUser     = new PremiumUser();
$clsForgot   = new PremiumForgot();
$clsSettings = new PremiumSettings();
$clsSubs     = new PremiumSubs();
$clsVoucher  = new PremiumVoucher();

$premium_settings = $clsSettings->getSettings();
$droppy_settings = $clsSettings->getDroppySettings();



// Getting the paypal functions
require_once (dirname(__FILE__) . '/gateway/paypal/paypalfunctions.php');

$premiumJsonConfig = file_get_contents(dirname(__FILE__) . '/config.json');
$premium_config = json_decode($premiumJsonConfig, true)['premium'];

$clsPaypal = new Paypal($premium_config, $premium_settings);

//Check if there is an action
if(isset($_POST['action']))
{
    //Check if the register function is called and validates password and terms
    if($_POST['action'] == 'register' && $_POST['terms'] == 'true')
    {
        //Getting variables from the form
        $email = $_POST['email'];
        $password = hash('sha512', $_POST['password']);
        $fullname = $_POST['name'];
        $lastname = $_POST['lastname'];
	   $mailingaddress = $_POST['mailingaddress'];
	   $city = $_POST['city'];
	   $zip = $_POST['zipcode'];
	   $country = $_POST['country'];
	   $plan = $_POST['subplan'];
        $payment = $_POST['payment'];
        $date = date("Y-m-d H:i:s");
        $time = time();
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $_SESSION["original_url"] = $_POST['rd'];
        $_SESSION["subscription_id"] = md5(time() . rand());
		
		if ($plan == 'Monthly') {
			$subscription_price = $premium_settings['sub_price'];
			$_SESSION['Payment_Amount'] = $subscription_price;
		}
		else {
			$subscription_price = $premium_settings['sub_year_price'];
			$_SESSION['Payment_Amount'] = $subscription_price;
		}
        $get_user = $clsUser->getByEmail($email);

        // Check if voucher has been given
        if(isset($_POST['voucher']) && !empty($_POST['voucher'])) {
            // Search voucher in DB
            $voucher = $clsVoucher->getByCode($_POST['voucher']);

            // Check if exists
            if (count($voucher) > 0) {
                if($voucher['discount_type'] == 'percentage') {
                    // Calculate the discount price
                    $percentage = ($subscription_price * ($voucher['discount_percentage'] / 100));
                    $subscription_price = ($subscription_price - $percentage);
                }
                elseif($voucher['discount_type'] == 'value') {
                    // Calculate the discount price
                    $subscription_price = ($subscription_price - $voucher['discount_value']);
                }

                if($subscription_price <= 0) {
                    $subscription_price = 0;
                    $payment = 'free';
                }
            }
        }

        // Checks if the user with $email doesn't already exists
        if($get_user === false) {
            $sub_id = $_SESSION['subscription_id'];

            // When the payment method is paypal
            if($payment == 'paypal')
            {
                // The price of the subscription
                $_SESSION["Payment_Amount"] = $subscription_price;

                // The payment type
                $paymentType = 'Sale';

                // Redirection URL when the payment has been successfully completed
                $returnURL = $this->config->item('site_url') . 'page/premium?action=payment_review';

                // When the payment is canceled by the user itself
                $cancelURL = $this->config->item('site_url') . 'page/premium?action=paypal_payment_canceled';

                // Redirection URL when the payment has been successfully completed
                $successUrl = $this->config->item('site_url') . 'page/premium?payment=created';

                $_SESSION['success_url'] = $successUrl;

                // Logo image path of paypal page
                $logoPath = $premium_settings['logo_url'];

                // Sending information
                $resArray = $clsPaypal->CallShortcutExpressCheckout ($_SESSION['Payment_Amount'], $premium_settings['currency'], $paymentType, $returnURL, $cancelURL, $logoPath);
                $ack = strtoupper($resArray["ACK"]);

                // When the payment information is correct
                if(strtoupper($ack)=="SUCCESS" || strtoupper($ack)=="SUCCESSWITHWARNING")
                {
                    $token = $resArray["TOKEN"];

                    $subs_data = array(
                        'sub_id'        => $sub_id,
                        'email'         => $email,
                        'name'          => $fullname,
                        'lastname'       => $lastname,
					'mailingaddress'	=> $mailingaddress,
					'city'			=> $city,
					'zip'			=> $zip,
					'country'		=> $country,
					'plan'			=> $plan,
                        'payment'       => 'paypal',
                        'time'          => $time,
                        'status'        => 'validating',
                        'paypal_token'  => $token
                    );

                    // Inserting the info into the database (This information is not validated yet so the user can not login yet) the review.php file will set the status of the users to ready
                    $clsSubs->insert($subs_data);

                    $users_data = array(
                        'email'     => $email,
                        'password'  => $password,
                        'ip'        => $user_ip,
                        'sub_id'    => $sub_id,
                        'status'    => 'ready'
                    );

                    $clsUser->insert($users_data);

                    $clsPaypal->RedirectToPayPal ( $token );
                }
                else
                {
                    // Display a user friendly Error on the page using any of the following error information returned by PayPal
                    $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                    $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);

                    error_log($ErrorCode);
                    error_log($ErrorLongMsg);
                }
            }
            elseif($payment == 'free') {
                $subs_data = array(
                    'sub_id'        => $sub_id,
                    'email'         => $email,
                    'name'          => $fullname,
                    'lastname'       => $lastname,
					'mailingaddress'	=> $mailingaddress,
					'city'			=> $city,
					'zip'			=> $zip,
					'country'		=> $country,
					'plan'			=> $plan,
                    'payment'       => 'free',
                    'time'          => $time,
                    'status'        => 'active',
                    'paypal_token'  => '',
                    'paypal_id'     => $sub_id
                );

                // Inserting the info into the database (This information is not validated yet so the user can not login yet) the review.php file will set the status of the users to ready
                $clsSubs->insert($subs_data);

                $users_data = array(
                    'email'     => $email,
                    'password'  => $password,
                    'ip'        => $user_ip,
                    'sub_id'    => $sub_id,
                    'status'    => 'ready'
                );

                $clsUser->insert($users_data);

                // Email shortcodes replacements
                $sub_info = $clsSubs->getBySubID($sub_id);
                if($sub_info !== false) {
                    $tokens = array(
                        'next_date'     => date("Y-m-d", $sub_info['next_date']),
                        'paypal_id'     => $sub_info['paypal_id'],
                        'last_date'     => date("Y-m-d", $sub_info['last_date']),
                        'name'          => $sub_info['name'],
						 'lastname'       => $sub_info['lastname'],
						  'mailingaddress'	=> $mailingaddress,
					'city'			=> $city,
					'zip'			=> $zip,
					'country'		=> $country,
                        'status'        => $sub_info['status'],
                        'sub_id'        => $sub_info['sub_id'],
                        'manage_page'   => $droppy_settings['site_url'] . '?goto=custom_account',
                        'email' 		=> $sub_info['email'],
                        'payment' 		=> $sub_info['payment'],
                        'amount' 		=> $subscription_price
                    );

                    $pattern = '{%s}';

                    $map = array();
                    foreach($tokens as $var => $value)
                    {
                        $map[sprintf($pattern, $var)] = $value;
                    }

                    $email_message = strtr($premium_settings['new_sub_email'], $map);
                    $this->email->sendEmailClean($email_message, $premium_settings['new_sub_subject'], array($email));

                    header('Location: ' . $this->config->item('site_url') . 'page/premium?payment=created');
                }
            }
        }
    }
    if($_POST['action'] == 'check_email')
    {
        $postemail = $_POST['email'];

        if (!filter_var($postemail, FILTER_VALIDATE_EMAIL) === false) {
            $check_email = $clsUser->getByEmail($postemail);
            if(!$check_email)
            {
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
        else
        {
            echo 3;
        }
    }
    if($_POST['action'] == 'check_voucher')
    {
        $clsVoucher = new PremiumVoucher();

        $voucher = $clsVoucher->getByCode($_POST['voucher']);
        if(!$voucher)
        {
            echo 0;
        }
        else
        {
            echo 1;
        }
    }
    if($_POST['action'] == 'login')
    {
        $email 		= $_POST['email'];
        $password 	= hash('sha512', $_POST['password']);

        $user = $clsUser->getByEmail($email);
        if($user !== false)
        {
            if($user['password'] == $password) {
                if($user['status'] == 'ready') {
                    $_SESSION['droppy_premium']         = $user['id'];
                    $_SESSION['droppy_premium_email']   = $user['email'];
                    echo 1;
                }
                if($user['status'] == 'suspended_reversal') {
                    $_SESSION['droppy_premium_suspend'] = $user['id'];
                    $_SESSION['droppy_premium_email']   = $user['email'];

                    echo 2;
                }
            }
            else
            {
                echo 0;
            }
        }
        else
        {
            echo 0;
        }
    }
    if($_POST['action'] == 'forgot')
    {
        $user = $clsUser->getByEmail($_POST['email']);

        if($user !== false)
        {
            $reset_code = hash('sha512', md5(rand() . time() . rand()));

            $db_data = array(
                'email' => $_POST['email'],
                'reset' => $reset_code
            );

            $clsForgot->insert($db_data);

            $tokens = array(
                'reset_url'    	=> $droppy_settings['site_url'] . '?goto=custom_account&reset=' . $reset_code
            );

            $pattern = '{%s}';

            $map = array();
            foreach($tokens as $var => $value)
            {
                $map[sprintf($pattern, $var)] = $value;
            }

            $email_message = strtr($premium_settings['forgot_pass_email'], $map);

            $this->email->sendEmailClean($email_message, $premium_settings['forgot_pass_subject'], array($user['email']));

            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    if($_POST['action'] == 'reset_pass')
    {
        $pass1 		= $_POST['pass1'];
        $pass2 		= $_POST['pass2'];

        $res = $clsForgot->getByResetCode($_POST['reset']);
        if($res !== false)
        {
            $email = $res['email'];
            $new_pass = hash('sha512', $pass1);

            $update = array('password' => $new_pass);
            $clsUser->updateByEmail($update, $email);

            $clsForgot->deleteByResetCode($_POST['reset']);

            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    if($_POST['action'] == 'change_details')
    {
        $email 		= $_POST['email'];
        $password 	= hash('sha512', $_POST['password']);
        $name 		= $_POST['name'];
        $lastname 	= $_POST['lastname'];
	    $mailingaddress = $_POST['mailingaddress'];
	    $city 		= $_POST['city'];
	    $zip          = $_POST['zipcode'];
		$country      = $_POST['country'];
        $sub_id 	= $_POST['sub_id'];

        $sub_info = $clsSubs->getBySubID($sub_id);

        if($sub_info !== false) {
            if(!empty($email) || !empty($name) || !empty($sub_id)) {
                if(($email != $sub_info['email'] && $clsUser->getByEmail($email) === false) || $email == $sub_info['email'])
                {
                    $sub_data = array(
                        'email'     => $email,
                        'lastname'   => $lastname,
                        'name'      => $name,
					  'mailingaddress' => $mailingaddress,
					  'city'       => $city,
					  'zip'		=> $zip,
					  'country'   => $country
                    );
                    $clsSubs->updateBySubID($sub_data, $sub_id);

                    if(empty($_POST['password'])) {
                        $clsUser->updateBySubID(array('email' => $email), $sub_id);

                        echo 1;
                    }
                    else
                    {
                        $clsUser->updateBySubID(array('email' => $email, 'password' => $password), $sub_id);

                        echo 1;
                    }
                }
                else
                {
                    echo 2;
                }
            }
            else
            {
                echo 3;
            }
        }
    }
    if($_POST['action'] == 'add_sub') {
        $payment = $_POST['payment'];
        $old_sub_id = $_POST['sub_id'];
        $fullname = $_POST['name'];
        $company = $_POST['company'];
        $date = date("Y-m-d H:i:s");
        $time = time();
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $_SESSION["original_url"] = $site_url . '?goto=custom_account';

        $session_id = $_SESSION['droppy_premium'];
        $_SESSION["subscription_id"] = md5(time() . rand());
        $sub_id = $_SESSION["subscription_id"];

        $get_user_details = $clsUser->getByID($session_id);

        $email = $get_user_details['email'];

        if(isset($_POST['voucher']) && !empty($_POST['voucher'])) {
            $clsVoucher = new PremiumVoucher();

            // Search voucher in DB
            $voucher = $clsVoucher->getByCode($_POST['voucher']);

            // Check if exists
            if (count($voucher) > 0) {
                if($voucher['discount_type'] == 'percentage') {
                    // Calculate the discount price
                    $percentage = ($subscription_price * ($voucher['discount_percentage'] / 100));
                    $subscription_price = ($subscription_price - $percentage);
                }
                elseif($voucher['discount_type'] == 'value') {
                    // Calculate the discount price
                    $subscription_price = ($subscription_price - $voucher['discount_value']);
                }

                if($subscription_price <= 0) {
                    $subscription_price = 0;
                    $payment = 'free';
                }
            }
        }

        //When the payment method is paypal
        if($payment == 'paypal')
        {
            //Getting the paypal functions
            require_once (dirname(__FILE__) . '/gateway/paypal/paypalfunctions.php');

            //The price of the subscription
            $_SESSION["Payment_Amount"] = $subscription_price;

            //The payment type
            $paymentType = 'Sale';

            // Redirection URL when the payment has been successfully completed
            $returnURL = $this->config->item('site_url') . 'page/premium?action=payment_review';

            // When the payment is canceled by the user itself
            $cancelURL = $this->config->item('site_url') . 'page/premium?action=paypal_payment_canceled';

            // Redirection URL when the payment has been successfully completed
            $successUrl = $this->config->item('site_url') . 'page/premium?payment=created';

            $_SESSION['success_url'] = $successUrl;

            //Logo image path of paypal page
            $logoPath = $premium_settings['logo_url'];

            //Sending information
            $resArray = $clsPaypal->CallShortcutExpressCheckout ($_SESSION['Payment_Amount'], $premium_settings['currency'], $paymentType, $returnURL, $cancelURL, $logoPath);
            $ack = strtoupper($resArray["ACK"]);

            //When the payment information is correct

            //When the payment information is correct
            if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
            {
                $token = $resArray["TOKEN"];

                $subs_data = array(
                    'sub_id'        => $sub_id,
                    'email'         => $email,
                    'name'          => $fullname,
                    'company'       => $company,
                    'payment'       => 'paypal',
                    'time'          => $time,
                    'status'        => 'validating',
                    'paypal_token'  => $token
                );

                // Inserting the info into the database (This information is not validated yet so the user can not login yet) the review.php file will set the status of the users to ready
                $clsSubs->insert($subs_data);

                $clsUser->updateBySubID(array('sub_id' => $sub_id), $old_sub_id);

                //logPaypal('[new_subscription] New subscription added to user (' . $email . ') with new Sub. ID '.$sub_id);

                $clsPaypal->RedirectToPayPal ( $token );
            }
            else
            {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);

                //logPaypal('[PAYPAL_ERROR] ' . $ErrorLongMsg);
            }
        }
        elseif($payment == 'free') {
            $subs_data = array(
                'sub_id'        => $sub_id,
                'email'         => $email,
                'name'          => $fullname,
                'company'       => $company,
                'payment'       => 'free',
                'time'          => $time,
                'status'        => 'active',
                'paypal_token'  => '',
                'paypal_id'     => $sub_id
            );

            // Inserting the info into the database (This information is not validated yet so the user can not login yet) the review.php file will set the status of the users to ready
            $clsSubs->insert($subs_data);

            $clsUser->updateBySubID(array('sub_id' => $sub_id), $old_sub_id);

            //Email shortcodes replacements
            $sub_info = $clsSubs->getBySubID($sub_id);
            $tokens = array(
                'next_date'     => date("Y-m-d", $sub_info['next_date']),
                'paypal_id'     => $sub_info['paypal_id'],
                'last_date'     => date("Y-m-d", $sub_info['last_date']),
                'name'          => $sub_info['name'],
                'status'        => $sub_info['status'],
                'company'       => $sub_info['company'],
                'sub_id'        => $sub_info['sub_id'],
                'manage_page'   => $site_url . '?goto=custom_account',
                'email' 		=> $sub_info['email'],
                'payment' 		=> $sub_info['payment'],
                'amount' 		=> $subscription_price
            );

            $pattern = '{%s}';

            $map = array();
            foreach($tokens as $var => $value)
            {
                $map[sprintf($pattern, $var)] = $value;
            }

            $email_message = strtr($premium_settings['new_sub_email'], $map);
            $this->email->sendEmailClean($email_message, $premium_settings['new_sub_subject'], array($email));

            //logPaypal("Free subscription with sub id (".$sub_id.") has been created");

            header('Location: ' . $this->config->item('site_url') . 'page/premium?payment=created');
        }
    }
    if($_POST['action'] == 'settings_general' && $this->session->userdata('admin')) {
        $settings = array(
            'item_name' => $_POST['item_name'],
            'subscription_desc' => $_POST['subscription_description'],
            'currency' => $_POST['currency'],
            'sub_price' => $_POST['price'],
		   'sub_year_price' => $_POST['yearlyprice'],
            'recur_time' => $_POST['recurring_time'],
            'recur_freq' => $_POST['recurring_freq'],
            'max_fails' => $_POST['max_fails'],
            'max_size' => $_POST['max_size'],
            'password_enabled' => $_POST['password_enabled'],
            'expire_time' => $_POST['expire_time'],
            'ad_enabled' => $_POST['ad_enabled'],
            'username_api' => $_POST['username_api'],
            'password_api' => $_POST['password_api'],
            'signature_api' => $_POST['signature_api'],
            'logo_url' => $_POST['logo_paypal'],
            'sub_cancel_n_email' => $_POST['sub_cancel_n_email'],
            'sub_cancel_n_subject' => $_POST['sub_cancel_n_subject'],
            'sub_cancel_e_subject' => $_POST['sub_cancel_e_subject'],
            'sub_cancel_e_email' => $_POST['sub_cancel_e_email'],
            'new_sub_subject' => $_POST['new_sub_subject'],
            'new_sub_email' => $_POST['new_sub_email'],
            'sus_email_sub' => $_POST['sus_email_sub'],
            'sus_email' => $_POST['sus_email_sub'],
            'payment_failed_sub' => $_POST['payment_failed_sub'],
            'payment_failed_email' => $_POST['payment_failed_email'],
            'forgot_pass_subject' => $_POST['forgot_pass_sub'],
            'forgot_pass_email' => $_POST['forgot_pass_email'],
        );

        $clsSettings->update($settings);

        header('Location: '. $_POST['goback']);
    }
    if($_POST['action'] == 'delete_user' && $this->session->userdata('admin')) {
        $id = $_POST['id'];
        $return = $_POST['return'];

        $clsUser->deleteByID($id);

        header('Location: ' . $return);
    }
    if($_POST['action'] == 'cancel_subscription' && $this->session->userdata('admin')) {
        require_once dirname(__FILE__) . '/gateway/paypal/cancel.php';

        $id = $_POST['id'];
        $return = $_POST['return'];

        $sub_info = $clsSubs->getBySubID($id);
        if($sub_info !== false) {
            if($sub_info['payment'] == 'free') {
                $clsSubs->updateByID(array('status' => 'canceled_end'), $sub_info['id']);
            }
            else
            {
                $clsPaypal->change_subscription_status($sub_info['paypal_id'], 'Cancel');
            }
        }

        header('Location: ' . $return);
    }
    if($_POST['action'] == 'activate_sub' && $this->session->userdata('admin')) {
        $id = $_POST['id'];
        $return = $_POST['return'];

        $info = $clsSubs->getBySubID($id);
        if($info !== false) {
            $clsSubs->updateBySubID(array('status' => 'active'), $id);
            $clsPaypal->change_subscription_status($info['paypal_id'], 'Reactivate');
        }

        header('Location: ' . $return);
    }
    if($_POST['action'] == 'add_usersub' && $this->session->userdata('admin')) {
        //Get post data
        $email          = $_POST['email'];
        $fullname       = $_POST['fullname'];
        $lastname   = $_POST['lastname'];
	    $mailingaddress = $_POST['mailingaddress'];
		$city		  = $_POST['city'];
		$zip			  = $_POST['zipcode'];
		$country		  = $_POST['country'];
        $password       = hash('sha512', $_POST['password']);
        $next_date      = strtotime($_POST['expiry']);
        $sub_id         = uniqid(); //Create unique id
        $date           = time(); //Get the current time.
        $pp_name        = $_POST['fullname'] . ' ' . $_POST['lastname'];
        $clsUser->insert(array(
            'email' => $email,
            'password' => $password,
            'ip' => '0.0.0.0',
            'sub_id' => $sub_id,
            'status' => 'ready'
        ));

        $clsSubs->insert(array(
            'sub_id' => $sub_id,
            'email' => $email,
            'name' => $fullname,
            'lastname' => $lastname,
		   'mailingaddress' => $mailingaddress,
		   'city' => $city,
		   'zip' => $zip,
		   'country' => $country,
            'payment' => 'free',
            'last_date' => '',
            'next_date' => $next_date,
            'time' => $date,
            'status' => 'active',
            'paypal_id' => '',
            'paypal_payerid' => $sub_id,
            'paypal_email' => $email,
            'paypal_status' => 'verified',
            'paypal_name' => $pp_name,
            'paypal_country' => 'US',
            'paypal_phone' => '',
            'paypal_ordertime' => ''
        ));

        header('Location: '.$_POST['goback'] . '&p=subs');
    }
    if($_POST['action'] == 'add_voucher' && $this->session->userdata('admin')) {
        //Get post data
        $code           = strtoupper($_POST['code']);
        $discount       = $_POST['discount'];
        $discount_perc  = $_POST['discount_percentage'];

        if(!empty($discount)) {
            //Discount value is set
            $discount_type = 'value';

            $clsVoucher->insert(array(
                'code' => $code,
                'discount_type' => $discount_type,
                'discount_value' => $discount
            ));
        }
        elseif(!empty($discount_perc)) {
            //Discount percentage is set
            $discount_type = 'percentage';

            $clsVoucher->insert(array(
                'code' => $code,
                'discount_type' => $discount_type,
                'discount_percentage' => $discount_perc
            ));
        }

        header('Location: '.$_POST['goback']);
    }
}

if(isset($_GET['action']))
{
    if($_GET['action'] == 'payment_confirm') {
        require_once dirname(__FILE__) . '/gateway/paypal/order_confirm.php';
    }

    if($_GET['action'] == 'payment_review') {
        require_once dirname(__FILE__) . '/gateway/paypal/review.php';
    }

    //Checks if the checkout has been canceld
    if($_GET['action'] == 'paypal_payment_canceled')
    {
        $token = $_GET['token'];

        $info = $clsSubs->getByToken($token);
        if($info !== false)
        {
            $subid = $info['sub_id'];
            $user_email = $info['email'];

            $clsSubs->updateBySubID(array('status' => 'canceled'), $subid);
            $clsUser->deleteBySubID($subid);
        }

        // Redirect to cancel page
        header('Location: ' . $droppy_settings['site_url'] . 'page/premium?payment=canceled_user');
    }
    if($_GET['action'] == 'paypal_cancel')
    {
        $id = $_GET['id'];
        $type = $_GET['type'];

        $info = $clsSubs->getBySubID($id);
        if($info !== false) {
            $clsPaypal->change_subscription_status($info['paypal_id'], 'Cancel');
        }
        header('Location: '.$droppy_settings['site_url'].'?goto=custom_account');
    }
    if($_GET['action'] == 'delete_voucher' && $this->session->userdata('admin')) {
        $clsVoucher->deleteByID($_GET['id']);

        header('Location: '.$_SESSION['goback']);
    }
    if($_GET['action'] == 'logout')
    {
        unset($_SESSION['droppy_premium']);
        unset($_SESSION['droppy_premium_email']);

        header('Location: '.$droppy_settings['site_url'].'');
    }
}