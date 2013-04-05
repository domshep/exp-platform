SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

DROP TABLE IF EXISTS `bmi_achievements`;
CREATE TABLE IF NOT EXISTS `bmi_achievements` (
  `user_id` int(11) NOT NULL,
  `latest_bmi` double(5,2) NOT NULL default '0.00',
  `change_since_start` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bmi_screeners`;
CREATE TABLE IF NOT EXISTS `bmi_screeners` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `height_cm` int(11) NOT NULL,
  `start_weight_kg` int(11) NOT NULL,
  `start_bmi` double(5,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `bmi_weekly`;
CREATE TABLE IF NOT EXISTS `bmi_weekly` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `week_beginning` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `height_cm` int(11) default NULL,
  `weight_kg` int(11) default NULL,
  `bmi` double(5,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `what_worked` text,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uc_weekUserID` (`week_beginning`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `fiveaday_achievements`;
CREATE TABLE IF NOT EXISTS `fiveaday_achievements` (
  `user_id` int(11) NOT NULL,
  `healthy_days_last_week` int(11) NOT NULL default '0',
  `total_days_healthy` int(11) NOT NULL default '0',
  `total_full_weeks_healthy` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `consec_healthy_weeks` int(10) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `fiveaday_screeners`;
CREATE TABLE IF NOT EXISTS `fiveaday_screeners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `veg_often` int(11) NOT NULL,
  `veg_no` int(11) NOT NULL,
  `salad_often` int(11) NOT NULL,
  `salad_no` int(11) NOT NULL,
  `whole_fruit_often` int(11) NOT NULL,
  `whole_fruit_no` int(11) NOT NULL,
  `medium_fruit_often` int(11) NOT NULL,
  `medium_fruit_no` int(11) NOT NULL,
  `small_fruit_often` int(11) NOT NULL,
  `small_fruit_no` int(11) NOT NULL,
  `tinned_fruit_often` int(11) NOT NULL,
  `tinned_fruit_no` int(11) NOT NULL,
  `dried_fruit_often` int(11) NOT NULL,
  `dried_fruit_no` int(11) NOT NULL,
  `fruit_juice_often` int(11) NOT NULL,
  `fruit_juice_no` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `fiveaday_weekly`;
CREATE TABLE IF NOT EXISTS `fiveaday_weekly` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `week_beginning` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `monday` int(11) default NULL,
  `tuesday` int(11) default NULL,
  `wednesday` int(11) default NULL,
  `thursday` int(11) default NULL,
  `friday` int(11) default NULL,
  `saturday` int(11) default NULL,
  `sunday` int(11) default NULL,
  `total` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `what_worked` text NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uc_weekUserID` (`week_beginning`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `version` decimal(10,0) unsigned NOT NULL,
  `type` varchar(20) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `base_url` varchar(75) NOT NULL,
  `icon_url` varchar(100) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

DROP TABLE IF EXISTS `module_users`;
CREATE TABLE IF NOT EXISTS `module_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `position` int(11) unsigned NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `motivation_screeners`;
CREATE TABLE IF NOT EXISTS `motivation_screeners` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) NOT NULL,
  `article` blob NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `height_cm` int(10) unsigned DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

DROP TABLE IF EXISTS `simple_health_test_achievements`;
CREATE TABLE IF NOT EXISTS `simple_health_test_achievements` (
  `user_id` int(11) NOT NULL,
  `healthy_days_last_week` int(11) NOT NULL default '0',
  `total_days_healthy` int(11) NOT NULL default '0',
  `total_full_weeks_healthy` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `consec_healthy_weeks` int(10) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `simple_health_test_screeners`;
CREATE TABLE IF NOT EXISTS `simple_health_test_screeners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `healthy` varchar(1) NOT NULL,
  `score` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `simple_health_test_weekly`;
CREATE TABLE IF NOT EXISTS `simple_health_test_weekly` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `week_beginning` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `monday` int(11) default NULL,
  `tuesday` int(11) default NULL,
  `wednesday` int(11) default NULL,
  `thursday` int(11) default NULL,
  `friday` int(11) default NULL,
  `saturday` int(11) default NULL,
  `sunday` int(11) default NULL,
  `total` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `what_worked` text,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uc_weekUserID` (`week_beginning`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
