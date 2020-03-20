DROP TABLE IF EXISTS `droppy_pm_forgot`;

CREATE TABLE `droppy_pm_forgot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `reset` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `droppy_pm_settings`;

CREATE TABLE `droppy_pm_settings` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) NOT NULL,
  `subscription_desc` varchar(500) NOT NULL,
  `currency` varchar(500) NOT NULL,
  `sub_price` varchar(100) NOT NULL,
  `recur_time` varchar(100) NOT NULL,
  `recur_freq` int(100) NOT NULL,
  `max_fails` int(100) NOT NULL,
  `max_size` int(100) NOT NULL,
  `password_enabled` varchar(100) NOT NULL,
  `expire_time` int(100) NOT NULL,
  `ad_enabled` varchar(100) NOT NULL,
  `username_api` varchar(200) NOT NULL,
  `password_api` varchar(200) NOT NULL,
  `signature_api` varchar(200) NOT NULL,
  `logo_url` varchar(200) NOT NULL,
  `sub_cancel_n_subject` text NOT NULL,
  `sub_cancel_n_email` text NOT NULL,
  `sub_cancel_e_subject` text NOT NULL,
  `sub_cancel_e_email` text NOT NULL,
  `new_sub_subject` text NOT NULL,
  `new_sub_email` text NOT NULL,
  `sus_email_sub` text NOT NULL,
  `sus_email` text NOT NULL,
  `payment_failed_sub` text NOT NULL,
  `payment_failed_email` text NOT NULL,
  `forgot_pass_subject` text NOT NULL,
  `forgot_pass_email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `droppy_pm_settings` WRITE;
/*!40000 ALTER TABLE `droppy_pm_settings` DISABLE KEYS */;

INSERT INTO `droppy_pm_settings` (`id`, `item_name`, `subscription_desc`, `currency`, `sub_price`, `recur_time`, `recur_freq`, `max_fails`, `max_size`, `password_enabled`, `expire_time`, `ad_enabled`, `username_api`, `password_api`, `signature_api`, `logo_url`, `sub_cancel_n_subject`, `sub_cancel_n_email`, `sub_cancel_e_subject`, `sub_cancel_e_email`, `new_sub_subject`, `new_sub_email`, `sus_email_sub`, `sus_email`, `payment_failed_sub`, `payment_failed_email`, `forgot_pass_subject`, `forgot_pass_email`)
VALUES
	(1,'Premium package','Premium plan subscription to Droppy - Online file sharing','USD','5','Day',1,1,5120,'false',604800,'false','','','','http://yoururl/assets/images/logo_droppy.png','Your subscription has been canceled','Hello {name},\r\n\r\nThis is an email to let you know that your subscription ( {sub_id} ) has been canceled. Please go this <a href=\"{manage_page}\">page</a> to register a new subscription.\r\n\r\nPlease let us know if we can be of any further assistance.\r\n\r\nBest regards,\r\nCompany','Your subscription has been canceled','<p>Hello {name},</p><br>\r\n<p>This is an email to let you know that your subscription ( {sub_id} ) has been canceled. We will not charge you anymore, you can still use our service till {next_date}</p>\r\n<p>Please go this <a href=\"{manage_page}\">page</a> if you want to register a new subscription.</p><bR>\r\n<p>Please let us know if we can be of any further assistance.</p><br>\r\nBest regards,<br>\r\nCompany','Welcome to the Premium world !','<p>Hello {name},</p><br>\r\n<p>We have successfully received your registration and you will now be able to login <a href=\"{manage_page}\">here</a></p><br>\r\n<p><strong>Registration details:</strong><p><br>\r\n<p><strong>Subscription id:</strong> {sub_id}</p>\r\n<p><strong>Paypal ID:</strong> {paypal_id}</p>\r\n<p><strong>E-Mail:</strong> {email}</p>\r\n<p><strong>Checkout:</strong> {payment}</p>\r\n<p><strong>Name:</strong> {name}</p>\r\n<p><strong>Company:</strong> {company}</p>\r\n<p><strong>Next pay day:</strong> {next_date}</p><br>\r\n<p>Please let us know if we can be of any further assistance.</p><br>\r\n<p>Best regards,<br>\r\nCompany</p>','Subscription has been suspended','Subscription has been suspended','Received a failed payment','<p>Hello {name},</p><br> <p>We would like to let you know that your account/subscription ({sub_id}) has received a <strong>failed/skipped</strong> payment. Please check your recurring profile ({paypal_id}) at Paypal and fix this as soon as possible.</p><br> <p>Please let us know if we can be of any assistance</p><br> <p>Best regards,<br> Company</p>','Your password reset link','Hello,\r\n\r\nThank you for using our service, we have received a request to change your password.\r\nYou can change the password with the following URL mentioned below.\r\n\r\n{reset_url}\r\n\r\nYou can just ignore this email if you did not requested this.\r\n\r\nBest regards,\r\nCompany');

/*!40000 ALTER TABLE `droppy_pm_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table droppy_pm_subs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `droppy_pm_subs`;

CREATE TABLE `droppy_pm_subs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `sub_id` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(200) DEFAULT '',
  `company` varchar(200) DEFAULT '',
  `payment` varchar(100) DEFAULT '',
  `last_date` varchar(200) DEFAULT '',
  `next_date` varchar(200) DEFAULT '',
  `time` int(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT '',
  `paypal_token` varchar(200) DEFAULT '',
  `paypal_id` varchar(200) DEFAULT '',
  `paypal_payerid` varchar(200) DEFAULT '',
  `paypal_email` varchar(200) DEFAULT '',
  `paypal_status` varchar(100) DEFAULT '',
  `paypal_name` varchar(200) DEFAULT '',
  `paypal_country` varchar(200) DEFAULT '',
  `paypal_phone` varchar(100) DEFAULT '',
  `paypal_ordertime` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `droppy_pm_users`;

CREATE TABLE `droppy_pm_users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `sub_id` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `droppy_pm_vouchers`;

CREATE TABLE `droppy_pm_vouchers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `discount_type` varchar(20) DEFAULT NULL,
  `discount_value` int(10) DEFAULT NULL,
  `discount_percentage` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `droppy_uploads` ADD `pm_email` varchar(100) SET DEFAULT NULL;