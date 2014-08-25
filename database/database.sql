-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 24, 2014 at 06:25 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phalcon_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(12, 'PHP5', 'This a feature of PHP'),
(14, 'VTM ', 'sdsdsdsd');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `categories_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users` (`users_id`),
  KEY `fk_posts_categories` (`categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `created`, `users_id`, `categories_id`) VALUES
(3, 'anh yeu em lam', 'anh yem em', 'sdsfdsffdf', NULL, 1, 14),
(8, 'sfdsfdf', 'fdfdf', 'dfdfdfdf', NULL, 1, 12),
(10, 'wdewew', 'ewew', 'wewe', NULL, 1, 12),
(13, 'anh ', 'chang ', 'lam sao', NULL, 1, 12),
(14, 'Phalcon', 'Framework', 'Wonderful', NULL, 1, 12),
(15, 'asas', 'asasasasasa', '~ ã¯~ [ thÃ´ng tin truyá»n Ä‘áº¡t]\r\n~ N1 ã¯N2 ãŒ\r\nGiáº£i thÃ­ch:\r\nPhÃ¢n cÃ¡ch chá»§ ngá»¯ vÃ  vá»‹ ngá»¯ trong cÃ¢u. TrÃ´ng tin truyá»n Ä‘áº¡t thÆ°á»ng Ä‘á»©ng sau ã¯\r\nLÃ m chá»§ ngá»¯ cá»§a má»‡nh Ä‘á» chÃ­nh.\r\nVÃ­ dá»¥:\r\nç§ï¼ˆã‚ãŸã—ï¼‰ã¯æ—¥æœ¬ï¼ˆã«ã»ã‚“ï¼‰ã®æ–™ç†ï¼ˆã‚Šã‚‡ã†ã‚Šï¼‰ãŒå¥½ï¼ˆã™ï¼‰ãã§ã™ã€‚\r\nTÃ´i thÃ­ch mÃ³n Äƒn Nháº­t\r\nå±±ç”°ï¼ˆã‚„ã¾ã ï¼‰ã•ã‚“ã¯æ—¥æœ¬èªžï¼ˆã«ã»ã‚“ã”ï¼‰ãŒä¸Šæ‰‹ï¼ˆã˜ã‚‡ã†ãšï¼‰ã§ã™ã€‚\r\nAnh Yamada giá»i tiáº¿ng Nháº­t\r\nã“ã®å®¶ï¼ˆã„ãˆï¼‰ã¯ãƒ‰ã‚¤ãŒå¤§ï¼ˆãŠãŠï¼‰ãã„ã§ã™\r\nCÄƒn nhÃ  nÃ y cÃ³ cá»­a lá»›n\r\n\r\nChÃº Ã½:\r\nKhi há»i báº±ng ã¯ thÃ¬ cÅ©ng tráº£ lá»i báº±ng ã¯, vá»›i thÃ´ng tin tráº£ lá»i thay tháº¿ cho tá»« Ä‘á»ƒ há»i\r\nVÃ­ dá»¥:\r\nA: ã“ã‚Œã¯ä½•ã§ã™ã‹ï¼Ÿ\r\nB: ã“ã‚Œã¯ç§ã®çœ¼é¡(ã‚ãŒã­ï¼‰ã§ã™ã€‚\r\nA: CÃ¡i nÃ y lÃ  cÃ¡i gÃ¬?\r\nB: CÃ¡i nÃ y lÃ  máº¯t kÃ­nh cá»§a tÃ´i', NULL, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` char(40) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `profile` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `profile`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
