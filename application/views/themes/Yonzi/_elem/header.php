<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="description" content="<?php echo $settings['site_desc']; ?>">
        <meta name="author" content="<?php echo $settings['site_name']; ?>">
        <meta name="keywords" content="<?php echo $settings['site_keywords']; ?>"/>
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">

        <title><?php echo $settings['site_title']; ?></title>

        <base href="<?php echo $settings['site_url'] ?>">

        <link href="<?php echo $settings['site_url'] . $settings['favicon_path']; ?>" rel="shortcut icon" type="image/png">

        <link href="assets/themes/<?php echo $settings['theme'] ?>/css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/themes/<?php echo $settings['theme'] ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/themes/<?php echo $settings['theme'] ?>/css/vegas.min.css">
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
		<script src="assets/themes/<?php echo $settings['theme'] ?>/js/bootstrap.bundle.min.js"></script>
		  <link href="assets/themes/<?php echo $settings['theme'] ?>/css/all.min.css" rel="stylesheet">
		  <link href="assets/themes/<?php echo $settings['theme'] ?>/css/animate.css" rel="stylesheet">
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
				<div class="col-6 col-md-3"><a href="<?php echo $settings['site_url'] ?>"><img src="<?php echo $settings['logo_path']; ?>" alt="Logo" class="headerlogo"></a></div>	
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
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>login" class="tablinks"><?php echo lang('login_nav'); ?></a></li>
								<?php endif; ?>	
								<?php if(isset($_SESSION['droppy_user'])) : ?>
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>page/premium?action=logout" class="tablinks"><?php echo lang('logout'); ?></a></li>
								<?php elseif(isset($_SESSION['droppy_premium'])): ?>	
								<li class="nav-item"><a href="<?php echo $settings['site_url'] ?>page/premium?action=logout" class="tablinks"><?php echo lang('logout'); ?></a></li>
								<?php else: ?>			
								<li class="nav-item"><a href="<?php echo $this->config->item('site_url') ?>page/premium" class="tablinks"><?php echo lang('premium_nav'); ?></a></li>
								<?php endif; ?>
							</ul>
			
						</div>
					</nav>
				</div>
				
				<div class="col-6 col-md-3 topbar" style="clear: both;">
					<img src="assets/themes/<?php echo $settings['theme'] ?>/img/noton.png" class="infobar" alt="notifications">
					<img src="assets/themes/<?php echo $settings['theme'] ?>/img/msgon.png" class="infobar" alt="messages">
					
					
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
	<section class="mainfrontsection">
	<div class="background" id="background"></div>
		<div class="container">
			
			