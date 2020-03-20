CREATE TABLE `droppy_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_backgrounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `duration` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `droppy_backgrounds` WRITE;
/*!40000 ALTER TABLE `droppy_backgrounds` DISABLE KEYS */;

INSERT INTO `droppy_backgrounds` (`id`, `src`, `url`)
VALUES
	(1,'assets/backgrounds/default_1.jpg','http://proxibolt.com'),
	(2,'assets/backgrounds/default_2.jpg','http://proxibolt.com'),
	(3,'assets/backgrounds/default_3.jpg','http://proxibolt.com');

/*!40000 ALTER TABLE `droppy_backgrounds` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE `droppy_downloads` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `download_id` varchar(100) NOT NULL,
  `time` int(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_files` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `upload_id` varchar(500) NOT NULL,
  `secret_code` varchar(500) NOT NULL,
  `file` varchar(500) NOT NULL,
  `size` int(20) DEFAULT '0',
  `time` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_language` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `droppy_language` WRITE;
/*!40000 ALTER TABLE `droppy_language` DISABLE KEYS */;

INSERT INTO `droppy_language` (`id`, `name`, `path`)
VALUES
	(1,'English','english'),
	(2,'Dutch','dutch');

/*!40000 ALTER TABLE `droppy_language` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE `droppy_log` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `time` int(100) NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_receivers` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `upload_id` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `private_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_settings` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `site_desc` varchar(200) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `lock_page` varchar(100) NOT NULL,
  `name_on_file` varchar(100) NOT NULL,
  `max_size` int(100) NOT NULL,
  `max_files` int(200) NOT NULL,
  `max_file_reports` int(100) NOT NULL,
  `blocked_types` text,
  `expire` int(100) NOT NULL,
  `upload_dir` varchar(100) NOT NULL,
  `favicon_path` varchar(100) NOT NULL,
  `logo_path` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `bg_timer` int(100) NOT NULL,
  `default_destruct` varchar(100) NOT NULL,
  `default_sharetype` varchar(100) NOT NULL,
  `default_email_to` varchar(100) NOT NULL,
  `password_enabled` varchar(100) NOT NULL,
  `analytics` text NOT NULL,
  `accept_terms` varchar(100) NOT NULL,
  `email_from_name` varchar(100) NOT NULL,
  `email_from_email` varchar(100) NOT NULL,
  `email_to_name` varchar(100) NOT NULL,
  `email_server` varchar(100) NOT NULL,
  `smtp_host` varchar(100) NOT NULL,
  `smtp_auth` varchar(100) NOT NULL,
  `smtp_secure` varchar(100) NOT NULL,
  `smtp_port` int(100) NOT NULL,
  `smtp_username` varchar(100) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,
  `terms_text` text NOT NULL,
  `about_text` text NOT NULL,
  `ad_1_enabled` varchar(100) NOT NULL,
  `ad_1_code` text NOT NULL,
  `ad_2_enabled` varchar(100) NOT NULL,
  `ad_2_code` text NOT NULL,
  `purchase_code` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `last_update_check` int(100) NOT NULL,
  `encrypt_files` int(1) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `droppy_settings` WRITE;
/*!40000 ALTER TABLE `droppy_settings` DISABLE KEYS */;

INSERT INTO `droppy_settings` (`id`, `site_name`, `site_title`, `site_desc`, `site_url`, `lock_page`, `name_on_file`, `max_size`, `max_files`, `max_file_reports`, `blocked_types`, `expire`, `upload_dir`, `favicon_path`, `logo_path`, `language`, `bg_timer`, `default_destruct`, `default_sharetype`, `default_email_to`, `password_enabled`, `analytics`, `accept_terms`, `email_from_name`, `email_from_email`, `email_to_name`, `email_server`, `smtp_host`, `smtp_auth`, `smtp_secure`, `smtp_port`, `smtp_username`, `smtp_password`, `terms_text`, `about_text`, `ad_1_enabled`, `ad_1_code`, `ad_2_enabled`, `ad_2_code`, `purchase_code`, `version`, `last_update_check`, `encrypt_files`)
VALUES
	(1,'Droppy','Droppy - Online file sharing','Online file sharing','','false','droppy',1024,10,2,'',1209600,'uploads/','assets/img/icon.png','assets/img/logo.png','english',5,'no','mail','','true','','yes','No-Reply Droppy','noreply@yourdomain.com','','LOCAL','','true','tls',587,'','','Files sent through this application are only intended for the specific receiver, sharing the files with other people is not allowed','This is an about text that can be modified in the admin panel','false','','false','','','2.1.3',0,0);

/*!40000 ALTER TABLE `droppy_settings` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE `droppy_social` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `google` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `github` varchar(100) NOT NULL,
  `tumblr` varchar(100) NOT NULL,
  `pinterest` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `droppy_social` WRITE;
/*!40000 ALTER TABLE `droppy_social` DISABLE KEYS */;

INSERT INTO `droppy_social` (`id`, `facebook`, `twitter`, `google`, `instagram`, `github`, `tumblr`, `pinterest`)
VALUES
	(1,'http://facebook.com/Proxibolt','http://twitter.com/proxibolt_us','','','http://github.com','','');

/*!40000 ALTER TABLE `droppy_social` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE `droppy_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `lang` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `droppy_templates` WRITE;
/*!40000 ALTER TABLE `droppy_templates` DISABLE KEYS */;

INSERT INTO `droppy_templates` (`id`, `type`, `msg`, `lang`)
VALUES
	(1,'receiver','Dear {email_to},\r\n\r\nYou have received some file(s) from {email_from} with a total size of {size} MB.\r\nThe file(s) will be destroyed after {expire_time}.\r\n\r\n<b>Files:</b>\r\n{file_list}\r\n\r\n<b>Message:</b>\r\n{message}\r\n\r\n{download_btn}\r\n\r\nBest regards,\r\n{site_name}','english'),
	(2,'sender','Dear,\r\n\r\nThanks for using {site_name} your file(s) have been successfully uploaded and an email has been sent to the recipients. The uploaded files will be destroyed after {expire_time}.\r\n\r\n<b>Files sent to:</b>\r\n{email_list}\r\n<b>Files sent:</b>\r\n{file_list}\r\n\r\n{download_btn}\r\n\r\nBest regards,\r\n{site_name}\r\n','english'),
	(3,'destroyed','Dear,\r\n\r\nThis is just an email to let you know that your files on <strong>{site_name}</strong> have been destroyed.\r\n\r\n<b>Files destroyed:</b>\r\n{file_list}\r\n\r\nBest regards,\r\n{site_name}','english'),
	(4,'downloaded','Dear,\r\n\r\n{download_email} has downloaded your file(s) from {site_name}.\r\n\r\n<b>Files downloaded:</b>\r\n{file_list}\r\n\r\n<b>Receivers of files:</b>\r\n{email_list}\r\n\r\n{download_btn}\r\n\r\nBest regards,\r\n{site_name}','english'),
	(5,'receiver_subject','You have received some files !','english'),
	(6,'sender_subject','Your items have been sent !','english'),
	(7,'destroyed_subject','Your items have been destroyed !','english'),
	(8,'downloaded_subject','Someone has downloaded your items !','english'),
	(25,'receiver','Beste,\r\n\r\n{email_from} heeft u bestanden gestuurd met een totale grootte van {size} MB\r\nDe bestanden worden vernietigd over {expire_time}\r\n\r\n<b>Bestanden:</b>\r\n{file_list}\r\n\r\n<b>Bericht:</b>\r\n{message}\r\n\r\n{download_btn}\r\n\r\nMet vriendelijke groet,\r\n{site_name}','dutch'),
	(26,'sender','Beste,\r\n\r\nBedankt voor het gebruiken van {site_name}, de bestanden zijn succesvol naar de ontvangers gestuurd.\r\nDe bestanden worden vernietigd in {expire_time}\r\n\r\n<b>Verstuurd naar:</b>\r\n{email_list}\r\n<b>Bestanden verstuurd:</b>\r\n{file_list}\r\n\r\n{download_btn}\r\n\r\nMet vriendelijke groet,\r\n{site_name}\r\n','dutch'),
	(27,'destroyed','Beste,\r\n\r\nUw bestanden op {site_name} zijn vernietigd.\r\n\r\n<b>Bestanden vernietigd:</b>\r\n{file_list}\r\n<b>Bestanden waren verstuurd  naar:</b>\r\n{email_list}\r\n\r\nMet vriendelijke groet,\r\n{site_name}','dutch'),
	(28,'downloaded','Beste,\r\n\r\nDit is een email om u ervan op hoogte te stellen dat {download_email} uw bestanden heeft gedownload.\r\n\r\n<b>Bestanden:</b>\r\n{file_list}\r\n\r\n<b>Ontvangers:</b>\r\n{email_list}\r\n\r\n{download_btn}\r\n\r\nMet vriendelijke groet,\r\n{site_name}','dutch'),
	(29,'receiver_subject','U heeft bestanden ontvangen','dutch'),
	(30,'sender_subject','Uw bestanden zijn verzonden','dutch'),
	(31,'destroyed_subject','Uw bestanden zijn vernietigd','dutch'),
	(32,'downloaded_subject','Iemand heeft uw bestanden gedownload','dutch');

/*!40000 ALTER TABLE `droppy_templates` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE `droppy_themes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `path` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `droppy_themes` WRITE;
/*!40000 ALTER TABLE `droppy_themes` DISABLE KEYS */;

INSERT INTO `droppy_themes` (`id`, `name`, `path`, `status`)
VALUES
	(1,'Default','default','ready'),
	(2,'OldTimer','oldtimer','stopped'),
	(3,'Grey-Dark','grey','stopped');

/*!40000 ALTER TABLE `droppy_themes` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE `droppy_updates` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `version` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_uploads` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `upload_id` varchar(200) NOT NULL,
  `email_from` varchar(500) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `secret_code` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `time` int(100) NOT NULL,
  `time_expire` int(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `count` int(100) NOT NULL,
  `share` varchar(100) NOT NULL,
  `destruct` varchar(100) NOT NULL,
  `flag` varchar(100) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `encrypt` varchar(500) DEFAULT NULL,
  `pm_email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `droppy_users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;