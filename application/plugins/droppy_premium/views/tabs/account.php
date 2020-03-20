<?php
require_once dirname(__FILE__) . '/../../autoloader.php';
?>

<script>
    // Validating and submitting form data
    $(document).ready( function() {
        $('body').on('click', '#submitLogin', function() {
            var email   = $('#email').val();
            var pass    = $('#pwd').val();

            if(email == '' || email == null || pass == '' || pass == null)
            {
                document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_fill_fields'); ?></div>';
            }
            else
            {
                // Data that will be post to the php file to check if the email already exists in the database
                var dataString = 'action=login&email='+email+'&password='+pass;
                // Ajax post
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->config->item('site_url') ?>page/premium",
                    data: dataString,
                    success: function(return_data) {
                        console.log(return_data);
                        //When the email does not exists
                        if(return_data == 1)
                        {
                            window.location = 'login';
                        }
                        if(return_data == 2)
                        {
                            document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_account_suspended'); ?></div>';
                        }
                        if(return_data == 0)
                        {
                            document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('invalid_login'); ?></div>';
                        }
                    }
                });
            }
        });

        $('body .loginDiv input').keypress(function(ev) {
            if (ev.keyCode === 13) {
                // Cancel the default action, if needed
                ev.preventDefault();
                // Trigger the button element with a click
                $('#submitLogin').click();
            }
        });

        $('body .resetDiv input').keypress(function(ev) {
            if (ev.keyCode === 13) {
                // Cancel the default action, if needed
                ev.preventDefault();
                // Trigger the button element with a click
                $('#submitReset').click();
            }
        });

        $('body .forgotDiv input').keypress(function(ev) {
            if (ev.keyCode === 13) {
                // Cancel the default action, if needed
                ev.preventDefault();
                // Trigger the button element with a click
                $('#submitForgot').click();
            }
        });

        $('body').on('click', '#submitForgot', function(ev) {
            ev.preventDefault();

            var email 	= $('#email_forgot').val();

            if(email == '' || email == null)
            {
                console.log('Email not entered');
                document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_fill_fields'); ?></div>';
            }
            else
            {
                console.log('Sending data..');

                // Data that will be post to the php file to check if the email already exists in the database
                var dataString = 'action=forgot&email='+email;
                // Ajax post
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->config->item('site_url') ?>page/premium",
                    data: dataString,
                    success: function(return_data) {
                        console.log('Got data back: ' + return_data);

                        //When the email does not exists
                        if(return_data == 1)
                        {
                            document.getElementById('email_forgot').value = '';
                            document.getElementById('errors').innerHTML = '<div class="alert alert-success" role="alert" style="text-align: center;"><?php echo lang('premium_email_sent'); ?></div>';
                        }
                        if(return_data == 0)
                        {
                            document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_email_not_exists'); ?></div>';
                        }
                    }
                });
            }
        });
        $('body').on('click', '#submitReset', function(ev) {
            ev.preventDefault();

            var pass1 		= document.getElementById('password1').value;
            var pass2 		= document.getElementById('password2').value;
            var reset_code 	= document.getElementById('reset_code').value;

            if(pass1 == '' || pass1 == null || pass2 == '' || pass2 == null)
            {
                document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_fill_fields'); ?></div>';
            }
            else
            {
                if(pass1 == pass2) {
                    var dataString = 'action=reset_pass&pass1='+pass1+'&pass2='+pass2+'&reset='+reset_code;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->config->item('site_url') ?>page/premium",
                        data: dataString,
                        success: function(return_data) {
                            //When the email does not exists
                            if(return_data == 1)
                            {
                                window.location.href = "?goto=custom_account&error=<?php echo lang('premium_pass_changed'); ?>";
                            }
                            if(return_data == 0)
                            {
                                document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_something_wrong'); ?></div>';
                            }
                        }
                    });
                }
                else
                {
                    document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_pass_same'); ?></div>';
                }
            }
        });
        $('body').on('click', '#submitDetailsChange', function(ev) {
            ev.preventDefault();

            var email 	= document.getElementById('email').value;
            var pass 	= document.getElementById('pwd').value;
            var name 	= document.getElementById('name').value;
            var lastname = document.getElementById('lastname').value;
		   var maddress = document.getElementById('mailingaddress').value;
		   var city = document.getElementById('city').value;
		   var zip = document.getElementById('zipcode').value;
		   var country = document.getElementById('country').value;
            var subid	= document.getElementById('sub_id').value;

            if(email == '' || email == null || name == '' || name == null || subid == '' || subid == null)
            {
                document.getElementById('errorsOther').innerHTML = '<p style="color: red;"><?php echo lang('premium_fill_fields'); ?></p>';
            }
            else
            {
                // Data that will be post to the php file to check if the email already exists in the database
                var dataString = 'action=change_details&email='+email+'&password='+pass+'&name='+name+'&lastname='+lastname+'&mailingaddress='+maddress+'&city='+city+'&zipcode='+zip+'&country='+country+'&sub_id='+subid;
                // Ajax post
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->config->item('site_url') ?>page/premium",
                    data: dataString,
                    success: function(return_data) {
                        // When the email does not exists
                        if(return_data == 1)
                        {
                            document.getElementById('pwd').value = '';
                            document.getElementById('emailFrom').value = email;
                            document.getElementById('errorsOther').innerHTML = '<p style="color: green;"><?php echo lang('premium_info_changed'); ?></p>';
                        }
                        if(return_data == 2)
                        {
                            document.getElementById('errorsOther').innerHTML = '<p style="color: red;"><?php echo lang('premium_email_exists'); ?></p>';
                        }
                        if(return_data == 3)
                        {
                            document.getElementById('errorsOther').innerHTML = '<p style="color: red;"><?php echo lang('premium_fill_fields'); ?></p>';
                        }
                    }
                });
            }
        });
        $('body').on('click', '#openForgot', function(ev) {
            ev.preventDefault();
            document.getElementById('loginDiv').style.display = 'none';
            document.getElementById('forgotDiv').style.display = 'block';
        });
        $('body').on('click', '#openLogin', function(ev) {
            ev.preventDefault();
            document.getElementById('loginDiv').style.display = 'block';
            document.getElementById('forgotDiv').style.display = 'none';
        });
    });
</script>
<?php
if(isset($_GET['error'])) :
    ?>
    <div id="errors"><div class="alert alert-info" role="alert" style="text-align: center;"><?php echo $_GET['error'] ?></div></div>
    <?php
else:
    ?>
    <div id="errors"></div>
    <?php
endif;
if(isset($_SESSION['droppy_premium']) || (isset($_SESSION['droppy_premium_suspend']) && $_SESSION['droppy_premium_suspend'])) :
    if(isset($_SESSION['droppy_premium_suspend'])) {
        $pm_id = $_SESSION['droppy_premium_suspend'];
    }
    if(isset($_SESSION['droppy_premium'])) {
        $pm_id = $_SESSION['droppy_premium'];
    }

    $clsUser = new PremiumUser();
    $clsSubs = new PremiumSubs();

    $user = $clsUser->getByID($pm_id);

    if($user !== false) {
        $row = $clsSubs->getBySubID($user['sub_id']);

        if($row !== false) {
            $sub_id 		= $row['sub_id'];
            $name 			= $row['name'];
            $lastname 		= $row['lastname'];
		   $mailingaddress = $row['mailingaddress'];
		   $city           = $row['city'];
		   $zipcode		 = $row['zip'];
		   $country        = $row['country'];
            $payment 		= $row['payment'];
            $paypal_id 		= $row['paypal_id'];
            $sub_status		= $row['status'];
            $next_payment 	= $row['next_date'];
            $email          = $row['email'];
        }
    }

    ?>
    <style>
        #table_value {
            padding-left: 20px;
        }
        #submitDetailsChange {
            float: right;
        }
        #submitNewSub {
            float: right;
        }
    </style>
    <?php
    if($sub_status == 'suspended') :
        ?>
        <div style="padding-top: 10px;"><?php echo lang('premium_hi') . ' ' . $name; ?>
		<span style="float: right;"><a class="btn-yonzi yonzi-logout" href="<?php echo $this->config->item('site_url') ?>page/premium?action=logout"><?php echo lang('logout'); ?></a></span>
		</div>
        <hr>
        <h4><?php echo lang('premium_your_sub_details'); ?>:</h4>
        <table>
            <tr>
                <td><strong><?php echo lang('premium_account_status'); ?>:</strong></td>
                <td id="table_value"><?php echo $sub_status; ?></td>
            </tr>
            <tr>
                <td><strong><?php echo lang('premium_cancel_sub'); ?>:</strong></td>
                <td id="table_value"><a class="btn btn-default btn-xs" href="<?php echo $this->config->item('site_url') ?>page/premium?action=paypal_cancel&id=<?php echo $sub_id; ?>"><?php echo lang('premium_cancel'); ?></a></td>
            </tr>
        </table>
        <p style="font-size: 12px;"><?php echo lang('premium_cancel_sus_text'); ?></p>
        <?php
    elseif($sub_status == 'canceled') :
        ?>
        <h4><?php echo lang('premium_no_sub_found'); ?></h4>
        <p><?php echo lang('premium_no_subscription'); ?></p><br>
        <a class="btn btn-default btn-xs" href="<?php echo $this->config->item('site_url') ?>page/premium?manage=<?php echo $sub_id; ?>#footer"><?php echo lang('premium_create_new_sub'); ?></a>
        <?php
    elseif($sub_status == 'active' || $sub_status == 'canceled_end') :
        ?>
        <div style="padding-top: 10px;"><?php echo lang('premium_hi') . ' ' . $name; ?>
		<span style="float: right;"><a class="btn-yonzi yonzi-logout" href="<?php echo $this->config->item('site_url') ?>page/premium?action=logout"><?php echo lang('logout'); ?></a></span>
		</div>
        <hr>
        <h4><?php echo lang('premium_your_sub_details'); ?>:</h4>
        <table>
            <tr>
                <td><strong><?php echo lang('premium_account_status'); ?>:</strong></td>
                <td id="table_value"><?php echo $sub_status; ?></td>
            </tr>
            <tr>
                <td><strong><?php echo lang('premium_payment_type'); ?>:</strong></td>
                <td id="table_value"><?php echo $payment; ?></td>
            </tr>
            <tr>
                <td><strong>Paypal ID:</strong></td>
                <td id="table_value"><?php echo $paypal_id; ?></td>
            </tr>
            <tr>
                <td><strong><?php echo lang('premium_next_pay_date'); ?>:</strong></td>
                <td id="table_value"><?php echo (!empty($next_payment) ? date("Y-m-d", $next_payment) : ''); ?></td>
            </tr>
            <?php
            if($sub_status == 'canceled_end') :
                ?>
                <tr>
                    <td><strong><?php echo lang('premium_cancel_sub'); ?>:</strong></td>
                    <td id="table_value"><?php echo lang('premium_canceled_on_date') . ' ' . date("Y-m-d", $next_payment); ?></td>
                </tr>
                <?php
            else:
                ?>
                <tr>
                    <td><strong><?php echo lang('premium_cancel_sub'); ?>:</strong></td>
                    <td id="table_value"><a class="btn btn-default btn-xs" href="<?php echo $this->config->item('site_url') ?>page/premium?action=paypal_cancel&type=end&id=<?php echo $sub_id; ?>"><?php echo lang('premium_cancel'); ?></a></td>
                </tr>
                <?php
            endif;
            ?>
        </table>
        <hr>
        <h4><?php echo lang('premium_other_details'); ?>:</h4>
        <div id="errorsOther"></div>
        <form role="form">
            <input type="hidden" id="sub_id" value="<?php echo $sub_id; ?>">
            <div class="form-group">
                <label for="email"><?php echo lang('email'); ?>:</label>
                <input type="email" class="form-control input-sm" id="email" placeholder="<?php echo lang('enter_own_email'); ?>" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="pwd"><?php echo lang('password'); ?>:</label>
                <input type="password" class="form-control input-sm" id="pwd" placeholder="<?php echo lang('password'); ?>">
            </div>
            <div class="form-group">
                <label for="pwd"><?php echo lang('premium_firstname'); ?>:</label>
                <input type="text" class="form-control input-sm" id="name" placeholder="<?php echo lang('premium_firstname'); ?>" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="pwd"><?php echo lang('premium_lastname'); ?>:</label>
                <input type="text" class="form-control input-sm" id="lastname" placeholder="<?php echo lang('premium_lastname'); ?>" value="<?php echo $lastname; ?>">
            </div>
			<div class="form-group">
                <label for="pwd"><?php echo lang('premium_mailingaddress'); ?>:</label>
                <input type="text" class="form-control input-sm" id="mailingaddress" placeholder="<?php echo lang('premium_mailingaddress'); ?>" value="<?php echo $mailingaddress; ?>">
            </div>
			<div class="form-group">
                <label for="pwd"><?php echo lang('premium_city'); ?>:</label>
                <input type="text" class="form-control input-sm" id="city" placeholder="<?php echo lang('premium_city'); ?>" value="<?php echo $city; ?>">
            </div>
			<div class="form-group">
                <label for="pwd"><?php echo lang('premium_zipcode'); ?>:</label>
                <input type="text" class="form-control input-sm" id="zipcode" placeholder="<?php echo lang('premium_zipcode'); ?>" value="<?php echo $zipcode; ?>">
            </div>
			<div class="form-group">
                <label for="pwd"><?php echo lang('premium_country'); ?>:</label>
			   <select id="country" name="country" class="form-control input-sm">
			   <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
			</div>
			
            <button type="button" id="submitDetailsChange" class="btn btn-default btn-sm"><?php echo lang('save'); ?></button>
        </form>
        <?php
    endif;
else:
    ?>
    <style>
        #submitLogin {
            float: right;
        }
        #submitForgot {
            float: right;
        }
        #forgotDiv {
            margin-top: 90px;
            display: none;
        }
        #loginDiv {
            margin-top: 70px;
        }
        #submitReset {
            float: right;
        }
        .openForm {
            font-size: 13px;
            padding-left: 3px;
        }
    </style>
    <?php
    if(isset($_GET['reset'])) :
        ?>
        <div class="loginDiv resetDiv" id="loginDiv">
		<div style="text-align:center; margin-bottom: 30px;">
		<i class="fas fa-user-lock fa-5x"></i></div>
            <form role="form">
                <input type="hidden" name="reset_code" id="reset_code" value="<?php echo $_GET['reset']; ?>">
                <div class="form-group">
                    <label for="pwd"><?php echo lang('password'); ?>:</label>
                    <input type="password" class="form-control" id="password1" placeholder="<?php echo lang('password'); ?>">
                </div>
                <div class="form-group">
                    <label for="pwd"><?php echo lang('premium_password_re'); ?>:</label>
                    <input type="password" class="form-control" id="password2" placeholder="<?php echo lang('premium_password_re'); ?>">
                </div>
                <button type="button" id="submitReset" class="btn btn-default"><?php echo lang('premium_submit'); ?></button>
            </form>
        </div>
        <?php
    else:
        ?>
        <div class="loginDiv" id="loginDiv">
		<div style="text-align:center; margin-bottom: 30px;">
		<i class="fas fa-user-lock fa-5x"></i></div>
            <form role="form">
                <div class="form-group">
                    <label for="email"><?php echo lang('email'); ?>:</label>
                    <input type="email" class="form-control" id="email" placeholder="<?php echo lang('enter_own_email'); ?>">
                </div>
                <div class="form-group">
                    <label for="pwd"><?php echo lang('password'); ?>:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="<?php echo lang('password'); ?>">
                </div>
                <a href="#" id="openForgot" class="openForm"><?php echo lang('premium_forgot_pass'); ?></a>
                <button type="button" id="submitLogin" class="btn btn-default"><?php echo lang('sign_in'); ?></button>
            </form>
        </div>
        <div class="forgotDiv" id="forgotDiv">
		<div style="text-align:center; margin-bottom: 30px;">
		<i class="fas fa-user-lock fa-5x"></i></div>
            <form role="form">
                <div class="form-group">
                    <label for="email"><?php echo lang('email'); ?>:</label>
                    <input type="email" class="form-control" id="email_forgot" placeholder="<?php echo lang('enter_own_email'); ?>">
                </div>
                <a href="#" id="openLogin" class="openForm"><?php echo lang('premium_login_page'); ?></a>
                <button type="button" id="submitForgot" class="btn btn-default"><?php echo lang('premium_submit'); ?></button>
            </form>
        </div>
		
        <?php
    endif;
endif;