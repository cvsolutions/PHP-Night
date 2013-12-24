-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Nov 03, 2013 alle 14:25
-- Versione del server: 5.6.12-log
-- Versione PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_night`
--
CREATE DATABASE IF NOT EXISTS `php_night` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php_night`;

-- --------------------------------------------------------

--
-- Struttura della tabella `pn_auth`
--

CREATE TABLE IF NOT EXISTS `pn_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(45) NOT NULL,
  `usermail` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usermail` (`usermail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `pn_auth`
--

INSERT INTO `pn_auth` (`id`, `fullname`, `usermail`, `pwd`, `role`, `active`) VALUES
(1, 'Concetto', 'info@cvsolutions.it', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'admin', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `pn_categories`
--

CREATE TABLE IF NOT EXISTS `pn_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `pn_categories`
--

INSERT INTO `pn_categories` (`id`, `fullname`, `slug`) VALUES
(1, 'php', 'php'),
(5, 'html', 'html'),
(6, 'ZF2', 'ZF2'),
(7, 'Raccolta script', 'raccolta-script');

-- --------------------------------------------------------

--
-- Struttura della tabella `pn_directory`
--

CREATE TABLE IF NOT EXISTS `pn_directory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `tags` varchar(45) NOT NULL,
  `category_id` int(11) NOT NULL,
  `publication` datetime NOT NULL,
  `auth_id` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `auth_id` (`auth_id`),
  FULLTEXT KEY `fullname` (`fullname`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `pn_directory`
--

INSERT INTO `pn_directory` (`id`, `fullname`, `description`, `website`, `tags`, `category_id`, `publication`, `auth_id`, `active`) VALUES
(2, 'Domain layer and ZendFramework2 using Zend\\ServiceManager', 'In the previous article I gave a brief overview of how the current implementation of my Domain Layer looks. To be able to use these classes inside ZF2 controllers I used a custom ServiceManager Factory. This custom ServiceManager will take care of Dependency Injection and register configured DomainServices\r\n\r\n', 'http://ctrl-f5.net/php/domain-layer-and-zendf', 'ZendFramework2 ,ServiceManager,img', 1, '2013-11-02 16:52:13', 1, 1),
(3, 'ZendSkeletonModule', 'Sample skeleton module for use with the ZF2 MVC layer \r\n', 'https://github.com/zendframework/ZendSkeletonModule', 'ZendFramework2', 6, '2013-11-02 16:55:36', 1, 1),
(4, 'img', '...', 'http://2.s3.envato.com/files/1323772/index.html', 'img', 7, '2013-11-03 11:33:42', 1, 1),
(5, 'Change permissions without the Terminal', 'BatChmod is a utility for manipulating file and folder privileges in Mac OS X.\r\nIt allows the manipulation of ownership as well as the privileges associated to the Owner, Group or others. It can also unlock files in order to apply those privileges and finally, it can remove any ACLs added to a folder or file under Mac OS X 10.5 Leopard or better.', 'http://www.lagentesoft.com/batchmod/', 'BatChmod, Terminal', 7, '2013-11-03 11:34:48', 1, 1);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `pn_directory`
--
ALTER TABLE `pn_directory`
  ADD CONSTRAINT `pn_directory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `pn_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pn_directory_ibfk_2` FOREIGN KEY (`auth_id`) REFERENCES `pn_auth` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
