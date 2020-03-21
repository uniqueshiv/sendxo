<?php

require_once dirname(__FILE__) . '/../../autoloader.php';

?>
<?php
$ci=& get_instance();
$ci->load->model("language");
$language_list = $ci->language->getAll();
$ci->load->model("socials");
$socials = $ci->socials->getAll();
$ci->load->model("backgrounds");
$backgrounds = $ci->backgrounds->getAllOrderID();
$clsSettings = new PremiumSettings();
$pmset = $clsSettings->getSettings();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="description" content="<?php echo $this->config->item('site_desc'); ?>">
        <meta name="author" content="<?php echo $this->config->item('site_name'); ?>">
        <meta name="keywords" content="<?php echo $this->config->item('site_keywords'); ?>"/>
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">

        <title><?php echo $this->config->item('site_title'); ?></title>

        <base href="<?php echo $this->config->item('site_url') ?>">

        <link href="<?php echo $this->config->item('site_url') . $this->config->item('favicon_path'); ?>" rel="shortcut icon" type="image/png">

        <link href="assets/themes/<?php echo $this->config->item('theme') ?>/css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/themes/<?php echo $this->config->item('theme') ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/themes/<?php echo $this->config->item('theme') ?>/css/vegas.min.css">
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
		<script src="assets/themes/<?php echo $this->config->item('theme') ?>/js/bootstrap.bundle.min.js"></script>
		  <link href="assets/themes/<?php echo $this->config->item('theme') ?>/css/all.min.css" rel="stylesheet">
		  <link href="assets/themes/<?php echo $this->config->item('theme') ?>/css/animate.css" rel="stylesheet">
		  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
		  <script data-ad-client="ca-pub-1729932274357916" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>

    <body>
        <header class="mainheader">
		<div class="container">
			<div class="row">
				<div class="col-6 col-md-3"><a href="<?php echo $this->config->item('site_url') ?>"><img src="<?php echo $this->config->item('logo_path'); ?>" alt="Logo" class="headerlogo"></a></div>	
				<div class="col-6 col-md-6 navrespon">
					<nav class="mainnav navbar navbar-expand-lg navbar-light">
						<button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNavDropdown">
						
							<ul class="nav navbar-nav">
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>" class="tablinks"><?php echo lang('home_nav'); ?></a></li>
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>about" class="tablinks"><?php echo lang('about_nav'); ?></a></li>
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>contact" class="tablinks"><?php echo lang('contact_nav'); ?></a></li>
								<?php if(isset($_SESSION['droppy_user'])) : ?>
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>login" class="tablinks"><?php echo lang('acc_nav'); ?></a></li>
								<?php elseif(isset($_SESSION['droppy_premium'])): ?>
								<?php
								$clsUser = new PremiumUser();
								$clsSubs = new PremiumSubs();
								$pm_id = '';
								$user = $clsUser->getByID($pm_id);
								$session_id = $_SESSION['droppy_premium'];
								$user = $clsUser->getByID($session_id);
								$row = $clsSubs->getBySubID($user['sub_id']);
								
								?>
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>login" class="tablinks"><?php echo lang('acc_nav'); ?><?php echo $row['name']; ?></a></li>									
								<?php else: ?>			
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>login"class="tablinks"><?php echo lang('login_nav'); ?></a></li>
								<?php endif; ?>	
								<?php if(isset($_SESSION['droppy_user'])) : ?>
								<?php elseif(isset($_SESSION['droppy_premium'])): ?>	
								<li class="nav-item"><a href="<?php echo $this->config->item('site_url') ?>page/premium?action=logout" class="tablinks"><?php echo lang('logout'); ?></a></li>
								<?php else: ?>			
								<li class="nav-item"><a href="<?php echo $this->config->item('site_url') ?>page/premium" class="tablinks"><?php echo lang('premium_nav'); ?></a></li>
								<?php endif; ?>
							</ul>
			
						</div>
					</nav>
				</div>
				
				<div class="col-6 col-md-3 topbar" style="clear: both;">
					<img src="assets/themes/<?php echo $this->config->item('theme') ?>/img/noton.png" class="infobar" alt="notifications">
					<img src="assets/themes/<?php echo $this->config->item('theme') ?>/img/msgon.png" class="infobar" alt="messages">
					
					
					<div class="toplang langpick lng lngPicker">
					<ul id="lang">
						<li>
						<a href="" class="first"><span id="flag_<?php echo $_SESSION['language']; ?>">&nbsp;</span><?php echo $_SESSION['language']; ?></a>
							<ul id="languagePicker">
								<?php
								foreach($language_list as $row)
								{
									echo '<li value="' . $row->path . '"><a href="#"><span id="flag_' . $row->path . '">&nbsp;</span> ' . $row->name . '</a></li>';
								}
								?>
							</ul>
						</li>
					</ul>
					</div>
				
				</div>
			</div>
		</div>
	</header>
	<?php
		if(isset($_GET['payment'])) {
			if($_GET['payment'] == 'canceled_user') {
				echo '<div class="alert alert-warning" role="alert" style="text-align: center; margin-bottom: 0;">' . lang('premium_canceled_payment') . '</div>';
			}
			if($_GET['payment'] == 'pending') {
				echo '<div class="alert alert-warning" role="alert" style="text-align: center; margin-bottom: 0;">' . lang('premium_pending_payment') . '</div>';
			}
			if($_GET['payment'] == 'reverse') {
				echo '<div class="alert alert-warning" role="alert" style="text-align: center; margin-bottom: 0;">' . lang('premium_reverse_payment') . '</div>';
			}
			if($_GET['payment'] == 'created') {
				echo '<div class="alert alert-warning" role="alert" style="text-align: center; margin-bottom: 0;">' . lang('premium_received_payment') . '</div>';
			}
		}
		if($_GET['action'] == 'payment_confirm'){
			echo '<div class="alert alert-warning" role="alert" style="text-align: center; margin-bottom: 0;">' . lang('premium_received_payment_custom') . '</div>';
		}
	?>
	<div class="social">
		<?php
		if(!empty($socials['facebook'])) :
			?>
			<a href="<?php echo $socials['facebook'] ?>" class="facebook" target="_blank"><i class="fab fa-facebook"></i></a>
			<?php
		endif;
		if(!empty($socials['twitter'])) :
			?>
			<a href="<?php echo $socials['twitter'] ?>" class="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
			<?php
		endif;
		if(!empty($socials['tumblr'])) :
			?>
			<a href="<?php echo $socials['tumblr'] ?>" class="tumblr" target="_blank"><i class="fab fa-tumblr"></i></a>
			<?php
		endif;
		if(!empty($socials['google'])) :
			?>
			<a href="<?php echo $socials['google'] ?>" class="google" target="_blank"><i class="fab fa-google"></i></a>
			<?php
		endif;
		if(!empty($socials['instagram'])) :
			?>
			<a href="<?php echo $socials['instagram'] ?>" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
			<?php
		endif;
		if(!empty($socials['github'])) :
			?>
			<a href="<?php echo $socials['github'] ?>" class="github" target="_blank"><i class="fab fa-github"></i></a>
			<?php
		endif;
		if(!empty($socials['pinterest'])) :
			?>
			<a href="<?php echo $socials['pinterest'] ?>" class="google" target="_blank"><i class="fab fa-pinterest"></i></a>
			<?php
		endif;
		?>
	</div>
	<section class="mainfrontsection gopremium">
	<div class="background" id="background"></div>

		<div class="container text-center premiumhead">
			<h1><?php echo lang('premium_go_pro'); ?></h1>
			<p><?php echo lang('premium_intro_text'); ?></p>
			 <a href="#reg" class="btn-yonzi clickregister"><?php echo lang('premium_register'); ?></a>
		</div>
		
		<div class="premiumcontent" id="reg">
			<div class="container">
			<h3 class="text-center" style="margin-bottom: 50px;"><?php echo lang('premium_register_intro'); ?> </h3>
			
			<?php
					if(isset($_GET['manage']) && isset($_SESSION['droppy_premium'])) :
						$sub_id = $_GET['manage'];
						$session_id = $_SESSION['droppy_premium'];

						$clsUser = new PremiumUser();

						$get_info = $clsUser->getBySubIDAndID($session_id, $sub_id);

						if($get_info !== false):
					?>
			<div class="row">
				<div class="col-md-8">
					
					<div class="registerDiv">
                       <div id="errors"></div>
					   <form role="form" method="POST" id="addSubFrom" class="registerForm">
                            <input type="hidden" name="action" value="add_sub">
                            <input type="hidden" name="rd" value="<?php echo base_url(); ?>">
                            <input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="form-control input-lg registerInput" value="<?php echo $get_info['email']; ?>" readonly>
                           </div>
						<div class="col-md-6">
						
						</div>
					</div>
					<div class="row">
					<h4><?php echo lang('premium_pers_details'); ?>:</h4>
						<div class="col-md-6">
						  <input type="text" class="form-control input-lg registerInput" name="name" id="name" placeholder="<?php echo lang('premium_fullname'); ?>" required="required">
						</div>
						<div class="col-md-6">
						  <input type="text" class="form-control input-lg registerInput" name="lastname" id="lastname" placeholder="<?php echo lang('premium_lastname'); ?>" required="required">
						</div>
					</div>
				</div>
				
				</div>
				</div>
				<?php
					endif;
				else:
				?>
				<form role="form" method="POST" id="paymentForm" name="paymentForm" class="registerForm">
				<div class="row">
					<div class="col-md-4">
						<div class="subplanchoose float-right text-center">
						<input type="radio" id="subplanm" name="subplan" value="Monthly" checked><br />
						<span class="plan"><?php echo lang('premium_monthly'); ?></span>
						<span class="plancost">$<?php echo $pmset['sub_price'] ?></span>
						<span class="plandesc"><?php echo lang('monthly_plan_desc'); ?></span>
						</div>
						
					</div>
					<div class="col-md-4">
						<div class="subplanchoose text-center" style="padding-top: 39px;">
							<input type="radio" id="subplany" name="subplan" value="Yearly">
							<span class="plan"><?php echo lang('premium_yearly'); ?></span>
							<span class="plancost">$<?php echo $pmset['sub_year_price']; ?> <span class="plancostsave">($<?php echo $pmset['sub_price']*12; ?>)</span></span>
							<span class="plandesc"><?php echo lang('yearly_plan_desc'); ?></span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="subplanchoose text-center" style="padding-top: 39px;">
							<input type="radio" id="subplany" name="subplan" value="Yearly">
							<span class="plan"><?php echo lang('premium_yearly'); ?></span>
							<span class="plancost">$<?php echo $pmset['sub_year_price']; ?> <span class="plancostsave">($<?php echo $pmset['sub_price']*12; ?>)</span></span>
							<span class="plandesc"><?php echo lang('yearly_plan_desc'); ?></span>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-8">

				<div class="registerDiv">
                  <div id="errors"></div>
                        <input type="hidden" name="action" value="register">
                        <input type="hidden" name="rd" value="<?php echo base_url(); ?>">
					<h4><?php echo lang('premium_login_details'); ?>:</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							<input type="text" class="form-control input-lg registerInput" name="email" id="email" placeholder="<?php echo lang('premium_your_email'); ?>" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<input type="password" class="form-control input-lg registerInput" name="password" id="password" placeholder="<?php echo lang('premium_password'); ?>" required="required">
							</div>
						</div>
						</div>
					</div>
					<h4><?php echo lang('premium_pers_details'); ?>:</h4>
					<div class="row">
						<div class="col-md-6">
						<div class="form-group">
						 <input type="text" class="form-control input-lg registerInput" name="name" id="name" placeholder="<?php echo lang('premium_firstname'); ?>" required="required">
                            <input type="text" class="form-control input-lg registerInput" name="mailingaddress" id="mailingaddress" placeholder="<?php echo lang('premium_mailingaddress'); ?>">
                            <input type="text" class="form-control input-lg registerInput" name="zipcode" id="zipcode" placeholder="<?php echo lang('premium_zipcode'); ?>">
						</div>
						</div>
						
						<div class="col-md-6">
						<div class="form-group">
						 <input type="text" class="form-control input-lg registerInput" name="lastname" id="lastname" placeholder="<?php echo lang('premium_lastname'); ?>" required="required">
                            <input type="text" class="form-control input-lg registerInput" name="city" id="city" placeholder="<?php echo lang('premium_city'); ?>">
                            <select id="country" name="country" class="form-control">
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
						</div>
						<div class="termsAgree">
                                <input type="checkbox" name="terms" id="terms" value="true" required="required"> <?php echo lang('terms_agree_check'); ?>
						</div>
						<input type="hidden" name="payment" value="paypal">
						
						
					</div>
					<?php
					endif;
					?>
					<div class="row" style="padding: 15px;">
					<button type="button" id="submitPayment" class="btn btn-lg btn-yonzi" style="width: 100%;"><?php echo lang('premium_register'); ?></button>
                       </div>
					</div>
				<div class="col-md-4" style="padding-left: 50px;">
					<div class="ordertotal">
					<h4 class="text-center"><?php echo lang('premium_order_count'); ?></h4>
					<hr>
					<div>
					<span id="subtype" class="float-left"></span>
					<span id="planprice" class="float-right">
					
					</span>
					</div>
					<div style="clear:both;"></div>
					<div>
					<span><?php echo lang('premium_order_tax');?></span>
					<span class="float-right">$0.00</span>
					</div>
					<hr>
					<div>
					<span class="float: left;"><?php echo lang('premium_order_total');?></span>
					<span id="planpricetot" class="float-right"></span>
					</div>
					
					</div>
					<script>
					var plansel = $('input[type=radio][name=subplan]:checked').val();
					subtype.innerHTML = 'Premium ' +plansel;
					planprice.innerHTML = '$<?php echo number_format($pmset['sub_price'], 2, '.', ''); ?>';
					planpricetot.innerHTML = '$<?php echo number_format($pmset['sub_price'], 2, '.', ''); ?>';
					document.paymentForm.onclick = function(){
					var plansel = $('input[type=radio][name=subplan]:checked').val();
						
						subtype.innerHTML = 'Premium ' +plansel;
						if (plansel == 'Monthly') {
							planprice.innerHTML = '$<?php echo number_format($pmset['sub_price'], 2, '.', ''); ?>';
							planpricetot.innerHTML = '$<?php echo number_format($pmset['sub_price'], 2, '.', ''); ?>';
						}
						else {
							planprice.innerHTML = '$<?php echo number_format($pmset['sub_year_price'], 2, '.', ''); ?>';
							planpricetot.innerHTML = '$<?php echo number_format($pmset['sub_year_price'], 2, '.', ''); ?>';
						}
					}
					</script>
				<input type="text" class="form-control input-lg registerInput" name="voucher" style="width: 254px;" id="voucher" placeholder="<?php echo lang('premium_voucher'); ?>">
                          
						<div id="paymentFooter">
						<h4><?php echo lang('accepted_payment_methods'); ?></h4>
						    <img src="assets/themes/Yonzi/img/paypal.png" alt="Paypal" style="">
							<img src="assets/themes/Yonzi/img/visa.png" alt="Visa" style="">
							<img src="assets/themes/Yonzi/img/discover.png" alt="Discover" style="">
							<img src="assets/themes/Yonzi/img/master.png" alt="Master" style="">
							<img src="assets/themes/Yonzi/img/amexpress.png" alt="American Express" style="">
                            </div>
                    </form>
				</div>
				
			</div>
			
			</div>
		<div class="container">
			<div class="prembenefits">
				<h2 class="text-center"><?php echo lang('premium_benefits'); ?></h2>
				<div class="row">
					<div class="col-md-6">
						<img class="img-feature img-responsive" src="assets/themes/Yonzi/img/largerfiles.png" alt="Larger files">
					</div>
					<div class="col-md-6 text-left" style="padding: 7% 0;">
						<h3><?php echo lang('premium_larger_uploads_title'); ?></h3>
						<p><?php echo lang('premium_larger_uploads_text'); ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-left" style="padding: 7% 0;">
						<h3><?php echo lang('premium_longer_storage_title'); ?></h3>
						<p><?php echo lang('premium_longer_storage_text'); ?></p>
					</div>
					<div class="col-md-6 text-right">
						<img class="img-feature img-responsive" src="assets/themes/Yonzi/img/betterstorage.png" alt="Better storage">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<img class="img-feature img-responsive" src="assets/themes/Yonzi/img/passwordsecurity.png" alt="Password secured">
					</div>
					<div class="col-md-6 text-left" style="padding: 7% 0;">
						<h3><?php echo lang('premium_password_title'); ?></h3>
						<p><?php echo lang('premium_password_text'); ?></p>
					</div>
				</div>
			</div>
			</div>
		</div>
		
	</section>
	<!--	
	<div class="container">
	<?php
		if($this->config->item('ad_2_enabled') == 'true' && !isset($noad)):
			?>
			<div id="ad_2_div" style="margin: 30px auto 30px 0;">
				<?php echo $this->config->item('ad_2_code'); ?>
			</div>
		<?php
		endif;
		?>
	</div>
	-->
	<footer style="margin-top: -30px">
		<div class="container">
		<?php echo date('Y'); ?><?php echo lang('foot_copyright'); ?>
		</div>
	</footer>	
		
		
<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="assets/plugins/droppy_premium/js/template.js"></script>
<script>
    //Validating and submitting form data
    $(document).ready( function() {
        $('body').on('click', '#submitPayment', function() {
            $('#submitPayment').text('<?php echo lang('premium_processing'); ?>');
            var email 	= document.getElementById('email').value;
            var pass 	= document.getElementById('password').value;
            var name	= document.getElementById('name').value;
		   var lastname	= document.getElementById('lastname').value;
		   var mailingaddress	= document.getElementById('mailingaddress').value;
		   var city	= document.getElementById('city').value;
		   var zip	= document.getElementById('zipcode').value;
            var terms 	= document.getElementById('terms');
            var voucher = document.getElementById('voucher').value;

            if(email == '' || email == null || pass == '' || pass == null || name == '' || name == null || lastname == '' || lastname == null || mailingaddress == '' || mailingaddress == null || city == '' || city == null || zip == '' || zip == null || !terms.checked)
            {
                $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_fill_fields'); ?></div>';
            }
            else
            {
                //Data that will be post to the php file to check if the email already exists in the database
                var dataString = 'action=check_email&email='+email;

                //Ajax post
                $.ajax({
                    type: "POST",
                    url: "",
                    data: dataString,
                    success: function(return_data) {
                        //When the email does not exists
                        if(return_data == 1)
                        {
                            if(voucher == '') {
                                //If the password is shorter than 6 characters
                                if (pass.length < 6) {
                                    $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                                    document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_password_longer'); ?></div>';
                                }
                              else {
                                    //If the passwords are the same
                                //if (pass == re_pass) {
                                        //Submit form
                                   document.getElementById('paymentForm').submit();
                                    //}
                                    //else {
                                     // $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                                     //   document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_password_match'); ?></div>';
                                    //}
                                }
                            }
                            else if(voucher != '') {
                                var dataString = 'action=check_voucher&voucher='+voucher;
                                $.ajax({
                                    type: "POST",
                                    url: "",
                                    data: dataString,
                                    success: function (return_data) {
                                        console.log('Voucher check response');
                                        console.log(return_data);

                                        //When the email does not exists
                                        if(return_data == 1) {
                                            //If the password is shorter than 6 characters
                                            if (pass.length < 6) {
                                                $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                                                document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_password_longer'); ?></div>';
                                            }
                                            else {
                                              //  //If the passwords are the same
                                                //if (pass == re_pass) {
                                                    //Submit form
                                                  document.getElementById('paymentForm').submit();
                                               // }
                                                //else {
                                                  //  $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                                                    //document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_password_match'); ?></div>';
                                                //}
                                           }
                                        }
                                        else
                                        {
                                            $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                                            document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_invalid_voucher'); ?></div>';
                                        }
                                    }
                                });
                            }
                        }
                        if(return_data == 2)
                        {
                            $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                            document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_email_exists'); ?></div>';
                        }
                        if(return_data == 3)
                        {
                            $('#submitPayment').text('<?php echo lang('premium_register'); ?>');
                            document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_invalid_email'); ?></div>';
                        }
                    }
                });
            }
        });
    });
    $(document).ready( function() {
        $('body').on('click', '#submitAddSub', function() {
            $('#submitAddSub').text('<?php echo lang('premium_processing'); ?>');
            var name	= document.getElementById('name').value;
            var terms 	= document.getElementById('terms');

            if(name == '' || name == null || !terms.checked)
            {
                $('#submitAddSub').text('<?php echo lang('premium_checkout'); ?>');
                document.getElementById('errors').innerHTML = '<div class="alert alert-warning" role="alert" style="text-align: center;"><?php echo lang('premium_fill_fields'); ?></div>';
            }
            else
            {
                document.getElementById('addSubFrom').submit();
            }
        });
    });
$('.clickregister').on('click', function() {  
    $('html, body').animate({scrollTop: $(this.hash).offset().top - 0}, 1000);
    return false;
});
    
</script>
	
	<script src="assets/themes/<?php echo $this->config->item('theme') ?>/js/vegas.min.js"></script>
	  <script src="//cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>
	<script> 
	$(document).ready(function(){
	  $("#opensettings").click(function(){
		$("#settings").slideToggle("slow");
	  });
	});
	</script>
<script src="assets/themes/<?php echo $this->config->item('theme') ?>/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.knob.min.js"></script>

<script src="assets/js/jquery.fileupload.js"></script>
<?php if(!empty($this->config->item('recaptcha_key'))): ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
<?php endif; ?>

<script>
    var mobileVersion = "no";
    var maxSize = <?php echo $this->config->item('max_size'); ?>;
    var maxFiles = <?php echo $this->config->item('max_files'); ?>;
    var maxSizeBytes = maxSize * 1024 * 1024;
    var maxChunkSize = <?php echo $this->config->item('max_chunk_size'); ?>;
    var disallowedFiles = "<?php echo $this->config->item('blocked_types'); ?>";
    var process_activate = false;
    var siteUrl = "<?php echo $this->config->item('site_url'); ?>";

        $(document).ready(function() {
        var backgrounds = [
            <?php
            foreach($backgrounds AS $background) {
                $ext = pathinfo($background->src, PATHINFO_EXTENSION);
                echo '{ '.($ext == 'mp4' ? 'video: { src: "' . $background->src . '", mute: true, loop: false },' : 'src: "'.$background->src.'",') . ' clickurl: "'.$background->url.'", '.(!empty($background->duration) && $background->duration > 0 ? 'delay: '.($background->duration * 1000) : 'delay: '.($this->config->item('bg_timer') * 1000)) . '},';
            }
            ?>
        ];

        
        backgrounds.shuffle();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(".background").vegas({
            slides: backgrounds
        });
    });
</script>

<script src="assets/themes/<?php echo $this->config->item('theme') ?>/js/droppy.js?v=<?php echo $this->config->item('version'); ?>"></script>


<?php echo $this->config->item('analytics'); ?>

<!-- Droppy V<?php echo $this->config->item('version') ?> -->

<script>
$(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="' + url + '"]').parent().addClass('active');
        $('ul.nav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');
    });
</script>
<script>
$(document).ready(function(){
  makeActive();
  $("input[type='radio']").on("change",function(){
    makeActive();
  });
});
function makeActive(){
  $("input[type='radio']").each(function(){
      if($(this).prop("checked")){
        $(this).closest('.subplanchoose').addClass("active");
      }else{
        $(this).closest('.subplanchoose').removeClass("active");
      }
    });
}
</script>
<script>
$(".col-md-6 :radio").hide().click(function(e){
    e.stopPropagation();
});
$(".col-md-6 div").click(function(e){
    $(this).closest(".col-md-6").find("div").removeClass("active");
    $(this).addClass("active").find(":radio").click();
});
</script>
<div class="modal fade" id="termsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Terms of service</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								 <?php
									echo $this->config->item('terms_text');
									?>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	
							  </div>
							</div>
						  </div>
						</div>
</body>
</html>
