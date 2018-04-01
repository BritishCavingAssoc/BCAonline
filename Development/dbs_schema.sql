SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `remote_addr` varchar(15) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `http_user_agent` varchar(255) DEFAULT NULL,
  `http_referer` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `imported_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `class` enum('CIM','DIM','GRP','') DEFAULT NULL,
  `forename` varchar(25) DEFAULT NULL,
  `surname` varchar(25) DEFAULT NULL,
  `bca_no` int(11) UNSIGNED DEFAULT NULL,
  `organisation` varchar(50) DEFAULT NULL,
  `position` varchar(25) DEFAULT NULL,
  `bca_status` varchar(10) DEFAULT 'Current',
  `insurance_status` varchar(3) DEFAULT NULL,
  `class_code` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `address1` varchar(40) DEFAULT NULL,
  `address2` varchar(40) DEFAULT NULL,
  `address3` varchar(40) DEFAULT NULL,
  `town` varchar(40) DEFAULT NULL,
  `county` varchar(40) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `address_ok` varchar(25) DEFAULT NULL,
  `bca_email_ok` tinyint(1) NOT NULL DEFAULT '0',
  `bcra_email_ok` tinyint(1) NOT NULL DEFAULT '0',
  `forename2` varchar(25) DEFAULT NULL,
  `surname2` varchar(25) DEFAULT NULL,
  `bca_no2` int(11) DEFAULT NULL,
  `insurance_status2` varchar(3) DEFAULT NULL,
  `class_code2` varchar(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `last_logins` (
  `user_id` int(11) NOT NULL COMMENT 'User Id',
  `last_login` datetime NOT NULL,
  `login_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `sent_emails` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `bca_no` int(11) UNSIGNED DEFAULT NULL,
  `from` varchar(100) DEFAULT NULL,
  `to` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `layout` varchar(50) DEFAULT NULL,
  `template` varchar(50) DEFAULT NULL,
  `view_variables` text,
  `message` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `token_code` char(40) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `action` varchar(20) NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `forename` varchar(25) DEFAULT NULL,
  `surname` varchar(25) DEFAULT NULL,
  `organisation` varchar(50) NOT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `position` varchar(25) DEFAULT NULL,
  `bca_status` varchar(10) DEFAULT NULL COMMENT 'Current, Lapsed, Resigned, Deceased',
  `bca_no` int(11) UNSIGNED DEFAULT NULL,
  `class` varchar(4) DEFAULT NULL,
  `class_code` varchar(10) DEFAULT NULL,
  `insurance_status` varchar(3) DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `address1` varchar(40) DEFAULT NULL,
  `address2` varchar(40) DEFAULT NULL,
  `address3` varchar(40) DEFAULT NULL,
  `town` varchar(40) DEFAULT NULL,
  `county` varchar(40) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `address_ok` varchar(25) DEFAULT NULL,
  `allow_club_updates` tinyint(1) NOT NULL DEFAULT '1',
  `admin_email_ok` tinyint(1) NOT NULL DEFAULT '1',
  `bca_email_ok` tinyint(1) NOT NULL DEFAULT '0',
  `bcra_email_ok` tinyint(1) NOT NULL DEFAULT '0',
  `forename2` varchar(25) DEFAULT NULL,
  `surname2` varchar(25) DEFAULT NULL,
  `bca_no2` int(11) DEFAULT NULL,
  `insurance_status2` varchar(3) DEFAULT NULL,
  `class_code2` varchar(10) DEFAULT NULL,
  `roles` varchar(250) DEFAULT NULL,
  `same_person` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DELIMITER $$
CREATE TRIGGER `UsersAfterDelete` AFTER DELETE ON `users` FOR EACH ROW BEGIN
        insert into
            user_audits (audit_datetime, audit_user, audit_type, user_id, username, password, active, 
            email, forename, surname, organisation, short_name, position,
            bca_status, bca_no, class, class_code, insurance_status, date_of_expiry, address1, address2,
            address3, town, county, postcode, country, telephone, website, address_ok, allow_club_updates,
            admin_email_ok, bca_email_ok, bcra_email_ok, forename2, surname2, bca_no2, insurance_status2,
            class_code2, roles, same_person, created, modified)
        values
            (now(), user(), 'D', old.id, old.username, old.password, old.active, 
            old.email, old.forename, old.surname, old.organisation, old.short_name, old.position,
            old.bca_status, old.bca_no, old.class, old.class_code, old.insurance_status, old.date_of_expiry, old.address1, old.address2,
            old.address3, old.town, old.county, old.postcode, old.country, old.telephone, old.website, old.address_ok, old.allow_club_updates,
            old.admin_email_ok, old.bca_email_ok, old.bcra_email_ok, old.forename2, old.surname2, old.bca_no2, old.insurance_status2,
            old.class_code2, old.roles, old.same_person, old.created, old.modified);
     END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UsersAfterInsert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
        insert into
            user_audits (audit_datetime, audit_user, audit_type, user_id, username, password, active, 
            email, forename, surname, organisation, short_name, position,
            bca_status, bca_no, class, class_code, insurance_status, date_of_expiry, address1, address2,
            address3, town, county, postcode, country, telephone, website, address_ok, allow_club_updates,
            admin_email_ok, bca_email_ok, bcra_email_ok, forename2, surname2, bca_no2, insurance_status2,
            class_code2, roles, same_person, created, modified)
        values
            (now(), user(), 'I',  new.id, new.username, new.password, new.active, 
            new.email, new.forename, new.surname, new.organisation, new.short_name, new.position,
            new.bca_status, new.bca_no, new.class, new.class_code, new.insurance_status, new.date_of_expiry, new.address1, new.address2,
            new.address3, new.town, new.county, new.postcode, new.country, new.telephone, new.website, new.address_ok, new.allow_club_updates,
            new.admin_email_ok, new.bca_email_ok, new.bcra_email_ok, new.forename2, new.surname2, new.bca_no2, new.insurance_status2,
            new.class_code2, new.roles, new.same_person, new.created, new.modified);
     END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UsersAfterUpdate` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
        insert into
            user_audits (audit_datetime, audit_user, audit_type, user_id, username, password, active, 
            email, forename, surname, organisation, short_name, position,
            bca_status, bca_no, class, class_code, insurance_status, date_of_expiry, address1, address2,
            address3, town, county, postcode, country, telephone, website, address_ok, allow_club_updates,
            admin_email_ok, bca_email_ok, bcra_email_ok, forename2, surname2, bca_no2, insurance_status2,
            class_code2, roles, same_person, created, modified)
        values
            (now(), user(), 'U',  new.id, new.username, new.password, new.active, 
            new.email, new.forename, new.surname, new.organisation, new.short_name, new.position,
            new.bca_status, new.bca_no, new.class, new.class_code, new.insurance_status, new.date_of_expiry, new.address1, new.address2,
            new.address3, new.town, new.county, new.postcode, new.country, new.telephone, new.website, new.address_ok, new.allow_club_updates,
            new.admin_email_ok, new.bca_email_ok, new.bcra_email_ok, new.forename2, new.surname2, new.bca_no2, new.insurance_status2,
            new.class_code2, new.roles, new.same_person, new.created, new.modified);
     END
$$
DELIMITER ;

CREATE TABLE `user_audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `audit_datetime` datetime DEFAULT NULL,
  `audit_user` varchar(50) DEFAULT NULL,
  `audit_type` char(1) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `forename` varchar(25) DEFAULT NULL,
  `surname` varchar(25) DEFAULT NULL,
  `organisation` varchar(50) DEFAULT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `position` varchar(25) DEFAULT NULL,
  `bca_status` varchar(10) DEFAULT NULL COMMENT 'Current, Lapsed, Resigned, Deceased',
  `bca_no` int(11) UNSIGNED DEFAULT NULL,
  `class` varchar(4) DEFAULT NULL,
  `class_code` varchar(10) DEFAULT NULL,
  `insurance_status` varchar(3) DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `address1` varchar(40) DEFAULT NULL,
  `address2` varchar(40) DEFAULT NULL,
  `address3` varchar(40) DEFAULT NULL,
  `town` varchar(40) DEFAULT NULL,
  `county` varchar(40) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `address_ok` varchar(25) DEFAULT NULL,
  `allow_club_updates` tinyint(1) DEFAULT NULL,
  `admin_email_ok` tinyint(1) DEFAULT NULL,
  `bca_email_ok` tinyint(1) DEFAULT NULL,
  `bcra_email_ok` tinyint(1) DEFAULT NULL,
  `forename2` varchar(25) DEFAULT NULL,
  `surname2` varchar(25) DEFAULT NULL,
  `bca_no2` int(11) DEFAULT NULL,
  `insurance_status2` varchar(3) DEFAULT NULL,
  `class_code2` varchar(10) DEFAULT NULL,
  `roles` varchar(250) DEFAULT NULL,
  `same_person` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `imported_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bca_no_idx` (`bca_no`);

ALTER TABLE `last_logins`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `sent_emails`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token` (`token_code`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_bca_id` (`bca_no`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_class` (`class`),
  ADD KEY `idx_postcode` (`postcode`) USING BTREE,
  ADD KEY `idx_surname` (`surname`);

ALTER TABLE `user_audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `imported_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `sent_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `user_audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
