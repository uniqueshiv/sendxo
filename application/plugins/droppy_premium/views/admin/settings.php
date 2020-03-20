<div class="form-panel" id="settings" style="overflow:hidden;">
    <h4 class="mb"><i class="fa fa-angle-right"></i> Subscription settings</h4>
    <form class="form-horizontal style-form" method="post" action="<?php echo $this->config->item('site_url') ?>page/premium">
        <input type="hidden" name="action" value="settings_general">
        <input type="hidden" name="goback" value="<?php echo current_url() ?>">
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Username (API Paypal)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username_api" placeholder="Password (API Paypal)" value="<?php echo $premium_settings['username_api']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Password (API Paypal)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password_api" placeholder="Password (API Paypal)" value="<?php echo $premium_settings['password_api']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Signature (API PAYPAL)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="signature_api" placeholder="Signature (Paypal API)" value="<?php echo $premium_settings['signature_api']; ?>">
            </div>
        </div>
        <h3>Product privileges</h3>
        <p>Set the values to the same as your general settings if you want to let the premium user have the same priveleges as the normal user.</p>
        <hr>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Max upload size (Only premium)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="max_size" placeholder="Max upload size (Only for premium users)" value="<?php echo $premium_settings['max_size']; ?>">
                <p><i>Size in MB</i></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Password function enabled (Only premium)</label>
            <div class="col-sm-10">
                <select class="form-control" name="password_enabled">
                    <option value="true" <?php if($premium_settings['password_enabled'] == 'true') { echo 'selected'; } ?>>Allow NON premium users.</option>
                    <option value="false" <?php if($premium_settings['password_enabled'] == 'false') { echo 'selected'; } ?>>Block NON premium users.</option>
                </select>
                <p><i>Select if the password function should be anabled for premium users.</i></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Expire time (Seconds) (Only for premium)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="expire_time" placeholder="Expire time" value="<?php echo $premium_settings['expire_time']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Advertising enabled (Only premium)</label>
            <div class="col-sm-10">
                <select class="form-control" name="ad_enabled">
                    <option value="true" <?php if($premium_settings['ad_enabled'] == 'true') { echo 'selected'; } ?>>Yes</option>
                    <option value="false" <?php if($premium_settings['ad_enabled'] == 'false') { echo 'selected'; } ?>>No</option>
                </select>
                <p><i>Select if the advertising section should be shown for premium users.</i></p>
            </div>
        </div>
        <!-- Product info -->
        <h3>Product details:</h3>
        <hr>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Paypal checkout logo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="logo_paypal" placeholder="Your URL to your logo" value="<?php echo $premium_settings['logo_url']; ?>">
                <p><i>Logo of your company/website that will be shown on the checkout page of paypal.</i></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Item name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="item_name" placeholder="Item name" value="<?php echo $premium_settings['item_name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Subscription description</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="subscription_description" placeholder="Subscription description" value="<?php echo $premium_settings['subscription_desc']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Currency code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="currency" placeholder="Currency code" value="<?php echo $premium_settings['currency']; ?>">
                <p><i>Currrency code list <a href="https://developer.paypal.com/docs/classic/api/currency_codes/">here</a></i></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Monthly price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="price" placeholder="Subscription price" value="<?php echo $premium_settings['sub_price']; ?>">
                <p><i>The price of the monthly subscription.</i></p>
            </div>
        </div>
		<div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Yearly price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="yearlyprice" placeholder="Subscription price" value="<?php echo $premium_settings['sub_year_price']; ?>">
                <p><i>The price of the yearly subscription.</i></p>
            </div>
        </div>
		<!--
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Billing time</label>
            <div class="col-sm-10">
                <select class="form-control" name="recurring_time">
                    <option value="Month" <?php if($premium_settings['recur_time'] == 'Month') { echo 'selected'; } ?>>Month</option>
                    <option value="Week" <?php if($premium_settings['recur_time'] == 'Week') { echo 'selected'; } ?>>Week</option>
                    <option value="Day" <?php if($premium_settings['recur_time'] == 'Day') { echo 'selected'; } ?>>Day</option>
                </select>
                <p><i>Unit for billing during this subscription period.</i></p>
            </div>
        </div>-->
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Billing frequent</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="recurring_freq" placeholder="Recurring frequent" value="<?php echo $premium_settings['recur_freq']; ?>">
                <p><i>Number of billing periods that make up one billing cycle. (See documentation for further information)</i></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Maximum fails</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="max_fails" placeholder="Max failed payments" value="<?php echo $premium_settings['max_fails']; ?>">
                <p><i>Number of scheduled payments that can fail before the profile is automatically suspended. Set 0 to disable this feature (Subscription will continue even when payments are failed).</i></p>
            </div>
        </div>
        <!-- Email messages -->
        <h3>Email messages:</h3>
        <p>Email shortcodes can be found in the documentation</p>
        <hr>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Cancel subscription now subject</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sub_cancel_n_subject" placeholder="Subject" value="<?php echo $premium_settings['sub_cancel_n_subject']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Cancel subscription now text</label>
            <div class="col-sm-10">
                <textarea name="sub_cancel_n_email" class="form-control" style="height: 150px;"><?php echo $premium_settings['sub_cancel_n_email']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Cancel subscription end subject</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sub_cancel_e_subject" placeholder="Subject" value="<?php echo $premium_settings['sub_cancel_e_subject']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Cancel subscription end email</label>
            <div class="col-sm-10">
                <textarea name="sub_cancel_e_email" class="form-control" style="height: 150px;"><?php echo $premium_settings['sub_cancel_e_email']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">New subscription subject</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="new_sub_subject" placeholder="Subject" value="<?php echo $premium_settings['new_sub_subject']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">New subscription email</label>
            <div class="col-sm-10">
                <textarea name="new_sub_email" class="form-control" style="height: 150px;"><?php echo $premium_settings['new_sub_email']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Suspended sub subject</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sus_email_sub" placeholder="Subject" value="<?php echo $premium_settings['sus_email_sub']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Suspended sub email</label>
            <div class="col-sm-10">
                <textarea name="sus_email" class="form-control" style="height: 150px;"><?php echo $premium_settings['sus_email']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Payment failed subject</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="payment_failed_sub" placeholder="Subject" value="<?php echo $premium_settings['payment_failed_sub']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Payment failed email</label>
            <div class="col-sm-10">
                <textarea name="payment_failed_email" class="form-control" style="height: 150px;"><?php echo $premium_settings['payment_failed_email']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Password forgot subject</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="forgot_pass_sub" placeholder="Subject" value="<?php echo $premium_settings['forgot_pass_subject']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Password forgot email</label>
            <div class="col-sm-10">
                <textarea name="forgot_pass_email" class="form-control" style="height: 150px;"><?php echo $premium_settings['forgot_pass_email']; ?></textarea>
            </div>
        </div>
        <div style="float: right; padding-right: 5px;">
            <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i> Save</button>
        </div>
    </form>
</div>