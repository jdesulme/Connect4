-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2012 at 01:40 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jxd1827`
--

-- --------------------------------------------------------

--
-- Table structure for table `546AjaxClass`
--
-- Creation: Oct 28, 2012 at 03:11 PM
-- Last update: Oct 28, 2012 at 03:11 PM
--

DROP TABLE IF EXISTS `546AjaxClass`;
CREATE TABLE `546AjaxClass` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `546AjaxClass`
--

INSERT INTO `546AjaxClass` (`id`, `name`) VALUES
(1, 'fred'),
(2, 'dan'),
(3, 'stan'),
(4, 'sddsd'),
(5, 'ds'),
(6, 'jeanasdad');

-- --------------------------------------------------------

--
-- Table structure for table `546ArchChat`
--
-- Creation: Oct 28, 2012 at 03:11 PM
--

DROP TABLE IF EXISTS `546ArchChat`;
CREATE TABLE `546ArchChat` (
  `messageId` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `message` varchar(200) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`messageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `546ArchChat`
--

INSERT INTO `546ArchChat` (`messageId`, `name`, `message`, `timeStamp`) VALUES
(1, 'danny', 'Hello all', '2012-03-29 00:10:52'),
(2, 'danny', 'anyone here?', '2012-03-29 00:11:27'),
(3, 'fred', 'Hello danny...', '2012-03-29 00:12:06'),
(4, 'Jenny', 'Can I play?', '2012-04-04 14:38:16'),
(5, 'Mike', 'NOooooo', '2012-10-02 04:09:55'),
(6, 'Liz', 'Yay', '2012-10-02 04:09:55'),
(7, 'Landay', 'Yer', '2012-10-02 04:10:13'),
(8, 'ben', 'yayyyyy', '2012-10-02 13:35:26'),
(9, 'jean', 'nooooooooooooo', '2012-10-02 13:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `board`
--
-- Creation: Oct 28, 2012 at 03:09 PM
--

DROP TABLE IF EXISTS `board`;
CREATE TABLE `board` (
  `id_board` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) DEFAULT NULL,
  `board` varchar(45) DEFAULT NULL,
  `turn` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_board`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--
-- Creation: Nov 12, 2012 at 04:24 AM
--

DROP TABLE IF EXISTS `challenges`;
CREATE TABLE `challenges` (
  `id_challenges` int(11) NOT NULL AUTO_INCREMENT,
  `player_1` int(11) DEFAULT NULL,
  `player_2` int(11) DEFAULT NULL,
  `id_game` int(11) DEFAULT NULL,
  `state` enum('W','A','D') DEFAULT 'W' COMMENT 'waiting-W, accepted-A, or declined-D',
  PRIMARY KEY (`id_challenges`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id_challenges`, `player_1`, `player_2`, `id_game`, `state`) VALUES
(1, 12, 13, NULL, 'A'),
(3, 13, 12, NULL, 'D'),
(4, 23, 224, NULL, 'W'),
(5, 12, 13, NULL, 'A'),
(6, 12, 13, NULL, 'A'),
(7, 12, 13, NULL, 'A'),
(8, 12, 13, NULL, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--
-- Creation: Oct 28, 2012 at 03:09 PM
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `time_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `room` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_chat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `message`, `time_stamp`, `room`) VALUES
(53, '13', 'sd', '2012-11-11 04:49:50', 0),
(54, '13', 'asdasdsad', '2012-11-11 04:49:53', 0),
(55, '13', 'sdfsdfsd', '2012-11-11 04:50:52', 0),
(56, '13', 'q', '2012-11-11 04:50:56', 0),
(57, '13', 'jean', '2012-11-11 04:51:01', 0),
(58, '13', 'yooo', '2012-11-11 04:51:05', 0),
(59, '13', 'WTF', '2012-11-11 04:51:09', 0),
(60, '13', 'i don''t get ot', '2012-11-11 04:51:22', 0),
(61, '13', 'dsfsdf', '2012-11-11 04:57:39', 0),
(62, '13', 'sdfs', '2012-11-11 04:57:42', 0),
(63, '13', '&lt;script&gt;alert(&#039;yoooo&#039;)&lt;/sc', '2012-11-11 04:58:10', 0),
(64, '13', 'asdasfd', '2012-11-11 04:58:24', 0),
(65, '13', 'sdfsdfsdfs', '2012-11-11 04:58:25', 0),
(66, '13', 'fdsfsdfdsf', '2012-11-11 04:58:26', 0),
(67, '13', 'ENT_QUOTES', '2012-11-11 04:58:36', 0),
(68, '13', '&lt;script&gt;alert(&#039;yoooo&#039;)&lt;/sc', '2012-11-11 04:58:54', 0),
(69, '13', 'alert(&#39;yoooo&#39;)', '2012-11-11 05:00:49', 0),
(70, '13', 'awesome mofos', '2012-11-11 05:01:03', 0),
(71, '13', '---1=1', '2012-11-11 05:01:22', 0),
(72, '13', 'alert(&#39;yoooo&#39;)', '2012-11-11 05:13:17', 0),
(73, '12', 'wtf', '2012-11-11 05:14:59', 0),
(74, '12', 'haha i&#39;m nice ', '2012-11-11 05:15:09', 0),
(75, '12', 'sadasds', '2012-11-11 05:15:27', 0),
(76, '12', 'asdasasd', '2012-11-11 05:15:28', 0),
(77, '12', 'alert(&#39;heeere&#39;);', '2012-11-11 05:15:48', 0),
(78, '12', 'heyyy', '2012-11-11 05:23:22', 0),
(79, '11', 'csdasfsdf', '2012-11-11 05:27:27', 0),
(80, '11', 'sdsafa', '2012-11-11 05:27:29', 0),
(81, '13', 'dsfsdf', '2012-11-11 05:40:53', 0),
(82, '13', 'asdasdad', '2012-11-11 05:40:55', 0),
(83, '13', 'sdfsfs', '2012-11-11 05:48:16', 0),
(84, '13', 'sdfsdfds', '2012-11-11 05:48:17', 0),
(85, '13', 'wwwwwwwwwww', '2012-11-11 05:48:23', 0),
(86, '13', 'qqqq', '2012-11-11 05:48:42', 0),
(87, '13', 'qqqqq', '2012-11-11 05:48:46', 0),
(88, '13', 'wqw', '2012-11-11 05:50:41', 0),
(89, '13', 'wqwqw', '2012-11-11 05:50:46', 0),
(90, '13', 'dsfs', '2012-11-11 05:57:57', 0),
(91, '15', 'asdasd', '2012-11-11 06:05:51', 0),
(92, '15', 'werwerwerewrewrwerwe', '2012-11-11 06:05:55', 0),
(93, '15', 'rewrewrwerwrerw', '2012-11-11 06:05:57', 0),
(94, '15', 'yooooooooo', '2012-11-11 06:06:03', 0),
(95, '15', 'WTFDDD', '2012-11-11 06:06:06', 0),
(96, '15', 'asas', '2012-11-11 06:06:57', 0),
(97, '15', 'sasa', '2012-11-11 06:06:59', 0),
(98, '14', 'qwqweqwewq', '2012-11-11 06:18:58', 0),
(99, '14', 'qwewqeqwewq', '2012-11-11 06:19:00', 0),
(100, '12', 'asdadfa', '2012-11-11 06:48:19', 0),
(101, '12', 'sfsdfds', '2012-11-11 06:48:25', 0),
(102, '12', 'YOOOO', '2012-11-11 06:48:38', 0),
(103, '12', 'asDADASDSAFDSAFDSG', '2012-11-11 06:49:38', 0),
(104, '12', 'DSAFGDSAFG', '2012-11-11 06:49:39', 0),
(105, '12', 'SDGFSDA', '2012-11-11 06:49:39', 0),
(106, '12', 'FGD', '2012-11-11 06:49:39', 0),
(107, '12', 'SFG', '2012-11-11 06:49:39', 0),
(108, '12', 'SDAFG', '2012-11-11 06:49:40', 0),
(109, '12', 'ASDFG', '2012-11-11 06:49:40', 0),
(110, '12', 'FDS', '2012-11-11 06:49:40', 0),
(111, '12', 'GD', '2012-11-11 06:49:40', 0),
(112, '12', 'AFG', '2012-11-11 06:49:40', 0),
(113, '12', 'FD', '2012-11-11 06:49:41', 0),
(114, '12', 'GDAGASDFGA', '2012-11-11 06:49:42', 0),
(115, '12', 'ASDADA', '2012-11-11 06:50:40', 0),
(116, '12', 'THIS IS JEAN', '2012-11-11 06:52:30', 0),
(117, '12', 'EWEWE', '2012-11-11 06:52:35', 0),
(118, '12', 'WEWE', '2012-11-11 06:52:36', 0),
(119, '12', 'EWWEREWRWER', '2012-11-11 06:52:38', 0),
(120, '12', 'EWREWRWERWER', '2012-11-11 06:52:39', 0),
(121, '12', 'asdasd', '2012-11-11 07:07:28', 0),
(122, '12', 'hey', '2012-11-11 07:08:23', 0),
(123, '12', 'dsd', '2012-11-11 07:09:13', 0),
(124, '12', 'sdsdsfsdfds', '2012-11-11 07:09:19', 0),
(125, '12', 'sdfsdfsdfsfd', '2012-11-11 07:09:20', 0),
(126, '12', 'WTFF', '2012-11-11 07:09:24', 0),
(127, '12', 'aASSSA', '2012-11-11 07:10:44', 0),
(128, '12', 'ASDASDAS', '2012-11-11 07:13:13', 0),
(129, '12', 'SDFS', '2012-11-11 07:13:16', 0),
(130, '12', 'lsdfsdf', '2012-11-11 07:13:17', 0),
(131, '12', 'wjat ', '2012-11-11 07:13:19', 0),
(132, '12', 'what ', '2012-11-11 07:13:21', 0),
(133, '12', 'hey ', '2012-11-11 07:13:23', 0),
(134, '12', 'this shit is instant ', '2012-11-11 07:13:31', 0),
(135, '12', 'sdfsdf', '2012-11-11 07:13:32', 0),
(136, '12', 'sfjea', '2012-11-11 07:13:33', 0),
(137, '12', 'dasdfsa', '2012-11-11 07:13:33', 0),
(138, '12', 'f', '2012-11-11 07:13:33', 0),
(139, '12', 'ds', '2012-11-11 07:13:34', 0),
(140, '12', 'g', '2012-11-11 07:13:34', 0),
(141, '12', 'dsf', '2012-11-11 07:13:34', 0),
(142, '12', 's', '2012-11-11 07:13:34', 0),
(143, '12', 'af', '2012-11-11 07:13:34', 0),
(144, '12', 'asd', '2012-11-11 07:13:34', 0),
(145, '12', 'g', '2012-11-11 07:13:35', 0),
(146, '12', 'df', '2012-11-11 07:13:35', 0),
(147, '12', 'asdsadffdsafs', '2012-11-11 07:14:01', 0),
(148, '12', 'sdfsdf', '2012-11-11 07:14:05', 0),
(149, '12', 'now it&#39;s slow', '2012-11-11 07:14:12', 0),
(150, '12', 'sdfsdf', '2012-11-11 07:14:14', 0),
(151, '12', 'dsfdsfsf', '2012-11-11 07:14:15', 0),
(152, '12', 'fdsfsdfsfddsfdsfsadfasdfas', '2012-11-11 07:14:17', 0),
(153, '12', 'fsafdsafsagsgafgadgfg', '2012-11-11 07:14:20', 0),
(154, '12', 'asdsafdsfds', '2012-11-11 07:14:48', 0),
(155, '12', 'sdfdsfsdaafsdfa', '2012-11-11 07:14:51', 0),
(156, '12', 'dfdsf', '2012-11-11 07:16:25', 0),
(157, '12', 'sdfsdfsfdsf', '2012-11-11 07:16:26', 0),
(158, '14', 'cool', '2012-11-11 07:17:12', 0),
(159, '14', 'asdadf', '2012-11-11 07:17:13', 0),
(160, '14', 'afsdfasf', '2012-11-11 07:17:14', 0),
(161, '14', 'dsfsadfsafsaf', '2012-11-11 07:17:16', 0),
(162, '14', 'what&#39;s going on ', '2012-11-11 07:17:25', 0),
(163, '14', 'cool', '2012-11-11 07:17:38', 0),
(164, '14', 'jkjmdfsdfsd', '2012-11-11 07:17:41', 0),
(165, '12', 'dsfsdf', '2012-11-11 07:17:44', 0),
(166, '15', 'asdasdasd', '2012-11-11 07:19:38', 0),
(167, '15', 'asdasdadads', '2012-11-11 07:19:39', 0),
(168, '15', 'asddasdasdasdsadasfsafdsfasd', '2012-11-11 07:19:42', 0),
(169, '14', 'fsdfgsdgdsg', '2012-11-11 07:19:56', 0),
(170, '14', 'sdssggsdfgdsfgsdfgdf', '2012-11-11 07:20:02', 0),
(171, '14', 'dasdadasda', '2012-11-11 07:20:04', 0),
(172, '14', 'hey', '2012-11-11 07:20:06', 0),
(173, '14', 'yo wah gwan brethren', '2012-11-11 07:20:14', 0),
(174, '15', 'jey', '2012-11-11 07:25:12', 0),
(175, '15', 'sdasdas', '2012-11-11 07:35:12', 0),
(176, '15', 'ok ', '2012-11-11 07:37:22', 0),
(177, '12', 'dfsf', '2012-11-11 08:43:02', 0),
(178, '12', 'cool', '2012-11-11 08:43:06', 0),
(179, '12', 'asfsafd', '2012-11-11 08:47:17', 0),
(180, '12', 'fdsgdgdsgdgdgdsgdsgsdfgd', '2012-11-11 08:47:20', 0),
(181, '12', 'saff', '2012-11-11 18:21:35', 0),
(182, '12', 'xcfxzvxzv', '2012-11-11 19:04:25', 0),
(183, '12', '2323', '2012-11-11 19:18:19', 0),
(184, '12', 'safasf', '2012-11-12 02:45:18', 0),
(185, '12', 'dsfsdfs', '2012-11-12 02:45:18', 0),
(186, '12', 'sdfsdfsfsfs', '2012-11-12 02:45:20', 0),
(187, '15', 'cool', '2012-11-12 02:45:46', 0),
(188, '15', '::-)', '2012-11-12 02:45:52', 0),
(189, '12', 'efwefwerf', '2012-11-12 03:17:29', 0),
(190, '12', 'safd', '2012-11-12 04:22:29', 0),
(191, '12', 'sdfdsfdsf', '2012-11-12 04:22:31', 0),
(192, '12', 'dsfs', '2012-11-12 04:22:31', 0),
(193, '12', 'WTF', '2012-11-12 04:22:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checkers_games`
--
-- Creation: Oct 28, 2012 at 03:11 PM
-- Last update: Oct 28, 2012 at 03:11 PM
--

DROP TABLE IF EXISTS `checkers_games`;
CREATE TABLE `checkers_games` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `whoseTurn` int(1) NOT NULL DEFAULT '0',
  `player0_name` varchar(255) NOT NULL DEFAULT '',
  `player0_pieceID` text,
  `player0_boardI` varchar(255) DEFAULT NULL,
  `player0_boardJ` varchar(255) DEFAULT NULL,
  `player1_name` varchar(255) NOT NULL DEFAULT '',
  `player1_pieceID` text,
  `player1_boardI` varchar(255) DEFAULT NULL,
  `player1_boardJ` varchar(255) DEFAULT NULL,
  `last_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `checkers_games`
--

INSERT INTO `checkers_games` (`game_id`, `whoseTurn`, `player0_name`, `player0_pieceID`, `player0_boardI`, `player0_boardJ`, `player1_name`, `player1_pieceID`, `player1_boardI`, `player1_boardJ`, `last_updated`) VALUES
(38, 1, 'Dan', NULL, NULL, NULL, 'Fred', NULL, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--
-- Creation: Oct 28, 2012 at 03:09 PM
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id_game` int(11) NOT NULL,
  `id_board` int(11) DEFAULT NULL,
  `isTurn` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_game`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--
-- Creation: Oct 28, 2012 at 03:11 PM
-- Last update: Oct 28, 2012 at 03:11 PM
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `PersonID` mediumint(10) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `NickName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`PersonID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`PersonID`, `LastName`, `FirstName`, `NickName`) VALUES
(1, 'Desulme', 'Jeanyhwh', 'Smiley'),
(2, 'Desulme', 'Inri', 'Speedster'),
(3, 'Desulme', 'Nathan', 'Four-Eyes'),
(4, 'Desulme', 'Emma', 'Diva'),
(5, 'Desulme', 'Jean', 'xz'),
(6, 'Desulme', 'Jean', 'xz'),
(7, 'Desulme', 'Jean', 'xz'),
(8, 'Desulme', 'Jean', ''),
(9, 'sddsf', 'march', 'sdfdsf'),
(10, 'Longbottom', 'Becky', ''),
(11, 'Longbottom', 'B', ''),
(12, 'Long', 'B', ''),
(13, 'Smith', 'Joe', 'J-man');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Oct 28, 2012 at 03:09 PM
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `win` int(11) DEFAULT NULL,
  `loss` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nickname`, `password`, `email`, `win`, `loss`, `status`, `last_login`) VALUES
(11, 'reggie', NULL, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'desulmj@sunyit.edu', NULL, NULL, -1, '2012-11-11 05:39:29'),
(12, 'admin', NULL, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jdesulme@gmail.com', NULL, NULL, 1, '2012-11-12 07:38:49'),
(13, 'jean', NULL, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jdesulme@gmail.com', NULL, NULL, 1, '2012-11-11 08:43:34'),
(14, 'andy', NULL, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'asfas@sdfsdf', NULL, NULL, -1, '2012-11-12 02:47:48'),
(15, 'babe', NULL, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'asfas@sdfsdf', NULL, NULL, -1, '2012-11-12 02:47:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
