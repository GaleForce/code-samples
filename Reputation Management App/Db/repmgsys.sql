-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2014 at 06:51 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `repmgsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencysite_settings`
--

CREATE TABLE IF NOT EXISTS `agencysite_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'Id of Reseller User',
  `sitetitle` varchar(255) NOT NULL,
  `siteheadcolor` varchar(255) NOT NULL,
  `sitebarcolor` varchar(255) NOT NULL,
  `sitebackgroundcolor` varchar(255) NOT NULL,
  `sitebackgroundimageurl` varchar(255) NOT NULL,
  `faviconimageurl` varchar(255) NOT NULL,
  `effectivedate` datetime NOT NULL,
  `terminationdate` datetime NOT NULL,
  `settingsdescription` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE IF NOT EXISTS `businesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_Id` int(11) NOT NULL COMMENT 'User ID Of Subscriber User Which is Business Owner',
  `parent_id` int(11) NOT NULL,
  `feedbackthreshold` int(11) NOT NULL,
  `automatedenailattempts` int(11) NOT NULL,
  `emailfrequency` int(11) NOT NULL,
  `automatedpostfeedbackenailattempts` int(11) NOT NULL,
  `postfeedbackemailfrequency` int(11) NOT NULL,
  `businessname` varchar(255) NOT NULL,
  `business_category_id` int(11) NOT NULL,
  `addressline1` varchar(255) NOT NULL,
  `addressline2` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `companywebaddress` varchar(100) NOT NULL,
  `socialsharingchecker` varchar(255) NOT NULL,
  `visibilitychecker` varchar(255) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_parent_business` (`parent_id`),
  KEY `foreign_key_user_role_subscriber` (`user_Id`),
  KEY `foreign_key_category_id` (`business_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `business_categories`
--

CREATE TABLE IF NOT EXISTS `business_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `business_employees`
--

CREATE TABLE IF NOT EXISTS `business_employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'UserId of User having role Employer  or MultiLocationManager ',
  `business_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `foreign_key_users` (`user_id`),
  KEY `foreign_key_business` (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_reviews`
--

CREATE TABLE IF NOT EXISTS `business_reviews` (
  `business_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'UserId of User having role Employer',
  `customer_id` int(11) NOT NULL,
  `ratingstar` int(11) NOT NULL,
  `ratingdescription` int(11) NOT NULL,
  `ratingdate` int(11) NOT NULL,
  `authorization` int(11) NOT NULL,
  `confirmation` int(11) NOT NULL,
  KEY `business_reviews_fk_business_id` (`business_id`),
  KEY `business_reviews_fk_user_id` (`user_id`),
  KEY `business_reviews_fk_customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_social_media`
--

CREATE TABLE IF NOT EXISTS `business_social_media` (
  `business_id` int(11) NOT NULL,
  `social_media_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `inactive` tinyint(4) NOT NULL,
  KEY `Business_SocialMedia_BusinessId` (`business_id`),
  KEY `Business_SocialMedia_SocialMediaId` (`social_media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'UserId of User having role Employer',
  `phonenumber` varchar(255) NOT NULL,
  `feedbackdate` datetime NOT NULL,
  `business_id` int(11) NOT NULL,
  `emailsentdate` datetime NOT NULL,
  `emailsent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_business_id` (`business_id`),
  KEY `fk_customer_employer_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `emailtemplatename` varchar(255) NOT NULL,
  `emailsubject` varchar(255) NOT NULL,
  `sendername` varchar(255) NOT NULL,
  `senderemail` varchar(255) NOT NULL,
  `emailcontent` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_email_template_business_id` (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_settings`
--

CREATE TABLE IF NOT EXISTS `feedback_settings` (
  `business_id` int(11) NOT NULL,
  `displayvideo` int(11) NOT NULL,
  `embedcodemalepostivevideo` text NOT NULL,
  `embedcodefemalepostivevideo` text NOT NULL,
  KEY `fk_feedback_settings_business_id` (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE IF NOT EXISTS `social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mediasitename` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `readrequirelogin` tinyint(4) NOT NULL,
  `writerequirelogin` tinyint(4) NOT NULL,
  `activateddate` datetime NOT NULL,
  `deactivateddate` datetime NOT NULL,
  `accounttype` varchar(255) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE IF NOT EXISTS `trainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `createdat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` enum('admin','reseller','subscriber','employee','multilocationmanager') NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_histories`
--

CREATE TABLE IF NOT EXISTS `user_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `history_fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `visibilities`
--

CREATE TABLE IF NOT EXISTS `visibilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `social_media_id` int(11) NOT NULL,
  `existense` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_visibilities_business_id` (`business_id`),
  KEY `visibilities_social_media_id` (`social_media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agencysite_settings`
--
ALTER TABLE `agencysite_settings`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `businesses`
--
ALTER TABLE `businesses`
  ADD CONSTRAINT `fk_parent_business` FOREIGN KEY (`parent_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_category_id` FOREIGN KEY (`business_category_id`) REFERENCES `business_categories` (`id`),
  ADD CONSTRAINT `foreign_key_user` FOREIGN KEY (`user_Id`) REFERENCES `users` (`id`);

--
-- Constraints for table `business_employees`
--
ALTER TABLE `business_employees`
  ADD CONSTRAINT `foreign_key_business` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`),
  ADD CONSTRAINT `foreign_key_users_role_employee` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `business_reviews`
--
ALTER TABLE `business_reviews`
  ADD CONSTRAINT `business_reviews_fk_business_id` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`),
  ADD CONSTRAINT `business_reviews_fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `business_reviews_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `business_social_media`
--
ALTER TABLE `business_social_media`
  ADD CONSTRAINT `Business_SocialMedia_BusinessId` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`),
  ADD CONSTRAINT `Business_SocialMedia_SocialMediaId` FOREIGN KEY (`social_media_id`) REFERENCES `social_media` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customer_business_id` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`),
  ADD CONSTRAINT `fk_customer_employer_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD CONSTRAINT `fk_email_template_business_id` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`);

--
-- Constraints for table `feedback_settings`
--
ALTER TABLE `feedback_settings`
  ADD CONSTRAINT `fk_feedback_settings_business_id` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`),
  ADD CONSTRAINT `fk_feedback_settings_id` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`);

--
-- Constraints for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD CONSTRAINT `history_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `visibilities`
--
ALTER TABLE `visibilities`
  ADD CONSTRAINT `visibilities_business_id` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`),
  ADD CONSTRAINT `visibilities_social_media_id` FOREIGN KEY (`social_media_id`) REFERENCES `social_media` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
