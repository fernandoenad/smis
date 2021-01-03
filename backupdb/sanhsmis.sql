-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2018 at 10:28 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sanhsmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `anecdotal`
--

DROP TABLE IF EXISTS `anecdotal`;
CREATE TABLE IF NOT EXISTS `anecdotal` (
  `anec_no` int(6) NOT NULL AUTO_INCREMENT,
  `anec_stud_no` int(6) NOT NULL,
  `anec_date` date NOT NULL,
  `anec_desc` varchar(50) NOT NULL,
  `anec_details` text NOT NULL,
  `anec_user_name` varchar(25) NOT NULL,
  PRIMARY KEY (`anec_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `anecdotal`
--


-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `att_no` int(11) NOT NULL AUTO_INCREMENT,
  `att_stud_no` int(6) NOT NULL,
  `att_datetime` datetime NOT NULL,
  `att_state` int(1) NOT NULL,
  `att_checked` int(1) NOT NULL,
  PRIMARY KEY (`att_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `attendance`
--


-- --------------------------------------------------------

--
-- Table structure for table `bill_assessment`
--

DROP TABLE IF EXISTS `bill_assessment`;
CREATE TABLE IF NOT EXISTS `bill_assessment` (
  `ass_no` int(6) NOT NULL AUTO_INCREMENT,
  `ass_bill_no` int(6) NOT NULL,
  `ass_sy` int(4) NOT NULL,
  `ass_stud_no` int(6) NOT NULL,
  `ass_amount` int(6) NOT NULL,
  `ass_remarks` varchar(100) NOT NULL,
  `ass_invoice_no` int(6) NOT NULL,
  PRIMARY KEY (`ass_no`),
  KEY `ass_stud_no` (`ass_stud_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bill_assessment`
--


-- --------------------------------------------------------

--
-- Table structure for table `bill_bills`
--

DROP TABLE IF EXISTS `bill_bills`;
CREATE TABLE IF NOT EXISTS `bill_bills` (
  `bill_no` int(6) NOT NULL AUTO_INCREMENT,
  `bill_category` varchar(50) NOT NULL,
  `bill_sy` int(4) NOT NULL,
  `bill_desc` varchar(100) NOT NULL,
  `bill_amount` double NOT NULL,
  `bill_prio` int(2) NOT NULL,
  PRIMARY KEY (`bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bill_bills`
--


-- --------------------------------------------------------

--
-- Table structure for table `bill_ledger`
--

DROP TABLE IF EXISTS `bill_ledger`;
CREATE TABLE IF NOT EXISTS `bill_ledger` (
  `ledger_no` int(6) NOT NULL AUTO_INCREMENT,
  `ledger_stud_no` int(6) NOT NULL,
  `ledger_sy` int(4) NOT NULL,
  `ledger_receipt_no` int(6) NOT NULL,
  `ledger_ass_no` int(6) NOT NULL,
  PRIMARY KEY (`ledger_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bill_ledger`
--


-- --------------------------------------------------------

--
-- Table structure for table `bill_receipt`
--

DROP TABLE IF EXISTS `bill_receipt`;
CREATE TABLE IF NOT EXISTS `bill_receipt` (
  `receipt_no` int(6) NOT NULL AUTO_INCREMENT,
  `receipt_amtPaid` int(6) NOT NULL,
  `receipt_stud_no` int(6) NOT NULL,
  `receipt_amtTendered` double NOT NULL,
  `receipt_amtChange` double NOT NULL,
  `receipt_sy` int(4) NOT NULL,
  `receipt_datetime` datetime NOT NULL,
  `receipt_user` int(6) NOT NULL,
  `receipt_active` int(1) NOT NULL,
  PRIMARY KEY (`receipt_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bill_receipt`
--


-- --------------------------------------------------------

--
-- Table structure for table `checkinout`
--

DROP TABLE IF EXISTS `checkinout`;
CREATE TABLE IF NOT EXISTS `checkinout` (
  `USERID` int(6) NOT NULL,
  `CHECKTIME` datetime NOT NULL,
  `CHECKTYPE` varchar(1) NOT NULL,
  `VERIFYCODE` int(1) NOT NULL,
  `SENDORID` int(1) NOT NULL,
  `Memoinfo` varchar(1) NOT NULL,
  `WorkCode` int(1) NOT NULL,
  `sn` bigint(13) NOT NULL,
  `UserExtFmt` int(1) NOT NULL,
  KEY `CHECKTIME` (`CHECKTIME`),
  KEY `USERID` (`USERID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkinout`
--


-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_no` int(6) NOT NULL AUTO_INCREMENT,
  `class_sy` double NOT NULL,
  `class_sem` int(2) NOT NULL,
  `class_pros_no` int(6) NOT NULL,
  `class_section_no` int(6) NOT NULL,
  `class_timeslots` varchar(100) DEFAULT NULL,
  `class_days` varchar(15) NOT NULL,
  `class_room` varchar(25) NOT NULL,
  `class_user_name` varchar(25) NOT NULL,
  PRIMARY KEY (`class_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `class`
--


-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `class_no` int(6) NOT NULL AUTO_INCREMENT,
  `class_sy` int(4) NOT NULL,
  `class_stud_no` int(6) NOT NULL,
  `class_pros_no` int(6) NOT NULL,
  `class_section_no` int(6) NOT NULL,
  `class_timeslots` varchar(15) NOT NULL,
  `class_days` varchar(15) NOT NULL,
  `class_room` varchar(25) NOT NULL,
  `class_q1` int(3) DEFAULT NULL,
  `class_q2` int(3) DEFAULT NULL,
  `class_q3` int(3) DEFAULT NULL,
  `class_q4` int(3) DEFAULT NULL,
  `class_final` int(3) DEFAULT NULL,
  `class_remarks` varchar(25) NOT NULL,
  `class_user_name` varchar(25) NOT NULL,
  PRIMARY KEY (`class_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`class_no`, `class_sy`, `class_stud_no`, `class_pros_no`, `class_section_no`, `class_timeslots`, `class_days`, `class_room`, `class_q1`, `class_q2`, `class_q3`, `class_q4`, `class_final`, `class_remarks`, `class_user_name`) VALUES
(1, 2015, 151929, 13, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(2, 2015, 151929, 14, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(3, 2015, 151929, 15, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(4, 2015, 151929, 16, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(5, 2015, 151929, 17, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(6, 2015, 151929, 18, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(7, 2015, 151929, 19, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(8, 2015, 151929, 20, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(9, 2015, 151929, 21, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(10, 2015, 151929, 22, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(11, 2015, 151929, 23, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon'),
(12, 2015, 151929, 24, 13, '00:00-00:00', 'MON-FRI', 'TBA', 0, 0, 0, 0, 0, 'ENROLLED', '302887_aomarzon');

-- --------------------------------------------------------

--
-- Table structure for table `dropdowns`
--

DROP TABLE IF EXISTS `dropdowns`;
CREATE TABLE IF NOT EXISTS `dropdowns` (
  `field_no` int(3) NOT NULL AUTO_INCREMENT,
  `field_category` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `field_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `field_ext` varchar(150) NOT NULL,
  PRIMARY KEY (`field_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=424 ;

--
-- Dumping data for table `dropdowns`
--

INSERT INTO `dropdowns` (`field_no`, `field_category`, `field_name`, `field_ext`) VALUES
(102, 'RELIGION', 'CHRISTIANITY', ''),
(103, 'RELIGION', 'HINDUISM', ''),
(104, 'RELIGION', 'ISLAM', ''),
(105, 'RELIGION', 'JUDAISM', ''),
(106, 'RELIGION', 'NO RELIGION', ''),
(107, 'RELIGION', 'OTHERS', ''),
(108, 'RELIGION', 'SIKHISM', ''),
(109, 'RELIGION', 'TAOISM', ''),
(110, 'DIALECT', 'AKLANON', ''),
(111, 'DIALECT', 'BIKOL', ''),
(112, 'DIALECT', 'CEBUANO', ''),
(113, 'DIALECT', 'CHABACANO', ''),
(114, 'DIALECT', 'HILIGAYNON', ''),
(115, 'DIALECT', 'ILOKO', ''),
(116, 'DIALECT', 'IVATAN', ''),
(117, 'DIALECT', 'KAPAMPANGAN', ''),
(118, 'DIALECT', 'KINARAY-A', ''),
(119, 'DIALECT', 'MAGUINDANAOAN', ''),
(120, 'DIALECT', 'MARANAO', ''),
(121, 'DIALECT', 'OTHERS', ''),
(122, 'DIALECT', 'PANGASINENSE', ''),
(123, 'DIALECT', 'SAMBAL', ''),
(124, 'DIALECT', 'SURIGAONON', ''),
(125, 'DIALECT', 'TAGALOG', ''),
(126, 'DIALECT', 'TAUSUG', ''),
(127, 'DIALECT', 'WARAY', ''),
(128, 'DIALECT', 'YAKAN', ''),
(129, 'DIALECT', 'YBANAG', ''),
(130, 'CCT', 'YES', ''),
(131, 'CCT', 'NO', ''),
(132, 'GENDER', 'MALE', ''),
(133, 'GENDER', 'FEMALE', ''),
(134, 'RESIDENCE', 'CALANGAHAN, SAGBAYAN, BOHOL', ''),
(135, 'RESIDENCE', 'CANMANO, SAGBAYAN, BOHOL', ''),
(136, 'RESIDENCE', 'CANMAYA CENTRO, SAGBAYAN, BOHOL', ''),
(137, 'RESIDENCE', 'CANMAYA DIOT, SAGBAYAN, BOHOL', ''),
(138, 'RESIDENCE', 'DAGNAWAN, SAGBAYAN, BOHOL', ''),
(139, 'RESIDENCE', 'KABASACAN, SAGBAYAN, BOHOL', ''),
(140, 'RESIDENCE', 'KAGAWASAN, SAGBAYAN, BOHOL', ''),
(141, 'RESIDENCE', 'KATIPUNAN, SAGBAYAN, BOHOL', ''),
(142, 'RESIDENCE', 'LANGTAD, SAGBAYAN, BOHOL', ''),
(143, 'RESIDENCE', 'LIBERTAD NORTE, SAGBAYAN, BOHOL', ''),
(144, 'RESIDENCE', 'LIBERTAD SUR, SAGBAYAN, BOHOL', ''),
(145, 'RESIDENCE', 'MANTALONGON, SAGBAYAN, BOHOL', ''),
(146, 'RESIDENCE', 'POBLACION, SAGBAYAN, BOHOL', ''),
(147, 'RESIDENCE', 'SAGBAYAN SUR, SAGBAYAN, BOHOL', ''),
(148, 'RESIDENCE', 'SAN AGUSTIN, SAGBAYAN, BOHOL', ''),
(149, 'RESIDENCE', 'SAN ANTONIO, SAGBAYAN, BOHOL', ''),
(150, 'RESIDENCE', 'SAN ISIDRO, SAGBAYAN, BOHOL', ''),
(151, 'RESIDENCE', 'SAN RAMON, SAGBAYAN, BOHOL', ''),
(152, 'RESIDENCE', 'SAN ROQUE, SAGBAYAN, BOHOL', ''),
(153, 'RESIDENCE', 'SAN VICENTE NORTE, SAGBAYAN, BOHOL', ''),
(154, 'RESIDENCE', 'SAN VICENTE SUR, SAGBAYAN, BOHOL', ''),
(155, 'RESIDENCE', 'SANTA CATALINA, SAGBAYAN, BOHOL', ''),
(156, 'RESIDENCE', 'SANTA CRUZ, SAGBAYAN, BOHOL', ''),
(157, 'RESIDENCE', 'UBOJAN, SAGBAYAN, BOHOL', ''),
(158, 'RESIDENCE', 'BONBON, CLARIN, BOHOL', ''),
(159, 'RESIDENCE', 'BONTUD, CLARIN, BOHOL', ''),
(160, 'RESIDENCE', 'BUACAO, CLARIN, BOHOL', ''),
(161, 'RESIDENCE', 'BUANGAN, CLARIN, BOHOL', ''),
(162, 'RESIDENCE', 'CABOG, CLARIN, BOHOL', ''),
(163, 'RESIDENCE', 'CABOY, CLARIN, BOHOL', ''),
(164, 'RESIDENCE', 'CALUWASAN, CLARIN, BOHOL', ''),
(165, 'RESIDENCE', 'CANDAJEC, CLARIN, BOHOL', ''),
(166, 'RESIDENCE', 'CANTOYOC, CLARIN, BOHOL', ''),
(167, 'RESIDENCE', 'COMAANG, CLARIN, BOHOL', ''),
(168, 'RESIDENCE', 'DANAHAO, CLARIN, BOHOL', ''),
(169, 'RESIDENCE', 'KATIPUNAN, CLARIN, BOHOL', ''),
(170, 'RESIDENCE', 'LAJOG, CLARIN, BOHOL', ''),
(171, 'RESIDENCE', 'MATAUB, CLARIN, BOHOL', ''),
(172, 'RESIDENCE', 'NAHAWAN, CLARIN, BOHOL', ''),
(173, 'RESIDENCE', 'POBLACION CENTRO, CLARIN, BOHOL', ''),
(174, 'RESIDENCE', 'POBLACION NORTE, CLARIN, BOHOL', ''),
(175, 'RESIDENCE', 'POBLACION SUR, CLARIN, BOHOL', ''),
(176, 'RESIDENCE', 'TANGARAN, CLARIN, BOHOL', ''),
(177, 'RESIDENCE', 'TONTUNAN, CLARIN, BOHOL', ''),
(178, 'RESIDENCE', 'TUBOD, CLARIN, BOHOL', ''),
(179, 'RESIDENCE', 'VILLAFLOR, CLARIN, BOHOL', ''),
(180, 'ETHNICITY', 'BADJAO', ''),
(181, 'ETHNICITY', 'IBATAN', ''),
(101, 'RELIGION', 'BUDDHISM', ''),
(190, 'ETHNICITY', 'NONE', ''),
(184, 'FIELD_EXT', 'JR', ''),
(185, 'FIELD_EXT', 'SR', ''),
(186, 'FIELD_EXT', 'III', ''),
(187, 'FIELD_EXT', 'IV', ''),
(188, 'FIELD_EXT', 'V', ''),
(192, 'RESIDENCE', 'BAHAN, INABANGA, BOHOL', ''),
(193, 'RESIDENCE', 'DATAG, INABANGA, BOHOL', ''),
(194, 'RESIDENCE', 'CAMBITOON, INABANGA, BOHOL', ''),
(195, 'FIELD_EXT', NULL, ''),
(196, 'RELATION', 'PARENT', ''),
(197, 'RELATION', 'RELATIVE', ''),
(198, 'RELATION', 'NON-RELATIVE', ''),
(199, 'PROMOTED', 'PROMOTED', ''),
(200, 'PROMOTED', 'IRREGULAR', ''),
(201, 'PROMOTED', 'RETAINED', ''),
(202, 'ENROLLED', 'IRREGULAR', ''),
(203, 'ENROLLED', 'REGULAR', ''),
(204, 'ENROLLED', 'TRANSFERRED IN', ''),
(205, 'INACTIVE', 'TRANSFERRED OUT', ''),
(206, 'INACTIVE', 'DROPPED OUT', ''),
(207, 'TRANSFEREE', 'RETAINED', ''),
(208, 'TRANSFEREE', 'PROMOTED', ''),
(209, 'TRANSFEREE', 'IRREGULAR', ''),
(211, 'ETHNICITY', 'ESCAYA', ''),
(216, 'RESIDENCE', 'BOGTONGBOD, CLARIN, BOHOL', ''),
(218, 'FIELD_EXT', 'II', ''),
(219, 'RESIDENCE', 'BACANI, CLARIN, BOHOL', ''),
(220, 'ENROLLED', 'LATE/REGULAR', ''),
(324, 'TRACK', 'SHS-TVL-HE', ''),
(222, 'RESIDENCE', 'LA VICTORIA, CARMEN, BOHOL', ''),
(223, 'CSTATUS', 'SINGLE', ''),
(224, 'CSTATUS', 'MARRIED', ''),
(225, 'CSTATUS', 'SEPARATED', ''),
(228, 'CSTATUS', 'WIDOWED', ''),
(229, 'TEACHERIDS', 'SSS', ''),
(230, 'TEACHERIDS', 'GSIS', ''),
(231, 'TEACHERIDS', 'PAG-IBIG', ''),
(232, 'TEACHERIDS', 'PHIL. HEALTH', ''),
(233, 'TEACHERIDS', 'PRC', ''),
(234, 'POSITION', 'JHS T1', '1_JHS Teacher I'),
(235, 'POSITION', 'JHS T2', '1_JHS Teacher II'),
(236, 'POSITION', 'JHS T3', '1_JHS Teacher III'),
(237, 'POSITION', 'HT1', '0_Head Teacher I'),
(238, 'POSITION', 'HT2', '0_Head Teacher II'),
(239, 'POSITION', 'PRINCIPAL1', '0_Principal I'),
(240, 'POSITION', 'PRINCIPAL2', '0_Principal II'),
(241, 'POSITION', 'JHS MT1', '1_JHS Master Teacher I'),
(242, 'POSITION', 'JHS MT2', '1_JHS Master Teacher II'),
(243, 'POSITION', 'SHS T1', '1_SHS Teacher I'),
(244, 'POSITION', 'SHS T2', '1_SHS Teacher II'),
(245, 'POSITION', 'SHS T3', '1_SHS Teacher III'),
(246, 'POSITION', 'SHS MT1', '1_SHS Master Teacher I'),
(247, 'POSITION', 'SHS MT2', '1_SHS Master Teacher II'),
(248, 'POSITION', 'SHS MT3', '1_SHS Master Teacher III'),
(249, 'POSITION', 'SHS MT4', '1_SHS Master Teacher IV'),
(252, 'FUNDING', 'NATIONAL', ''),
(253, 'FUNDING', 'MUNICIPAL', ''),
(254, 'FUNDING', 'PROVINCIAL', ''),
(255, 'FUNDING', 'REGIONAL', ''),
(256, 'STATUS', 'PROBATIONARY', ''),
(257, 'STATUS', 'CONTRACTUAL', ''),
(258, 'STATUS', 'REGULAR-PERMANENT', ''),
(310, 'RESIDENCE', 'POBLACION, CORELLA, BOHOL', ''),
(260, 'CURRICULUM', '2012', ''),
(264, 'TRACK', 'SHS GENERAL', ''),
(263, 'TRACK', 'JHS GENERAL', ''),
(265, 'TRACK', 'SHS-ACAD-GAS', ''),
(267, 'TRACK', 'SHS-TVL-ICT', ''),
(268, 'TIMELSLOTS', '07:45-08:45', '-'),
(269, 'TIMELSLOTS', '08:45-09:45', ''),
(270, 'TIMELSLOTS', '10:00-11:00', ''),
(271, 'TIMELSLOTS', '11:00-12:00', ''),
(272, 'TIMELSLOTS', '13:00-14:00', ''),
(273, 'TIMELSLOTS', '14:00-15:00', ''),
(274, 'TIMELSLOTS', '15:00-16:00', '-'),
(275, 'TIMELSLOTS', '16:00-17:00', ''),
(314, 'CCT', 'YES (MCCV)', ''),
(278, 'TIMELSLOTS', '07:45-09:45', '-'),
(279, 'TIMELSLOTS', '10:00-12:00', ''),
(282, 'TIMELSLOTS', '13:00-15:00', ''),
(283, 'TIMELSLOTS', '15:00-17:00', ''),
(284, 'RESIDENCE', 'DANAHAW, CLARIN, BOHOL', ''),
(286, 'RESIDENCE', 'MATUB, CLARIN, BOHOL', ''),
(287, 'RESIDENCE', 'ALEGRIA, CARMEN, BOHOL', ''),
(288, 'TIMELSLOTS', '10:00-15:00', ''),
(309, 'CURRICULUM', '1994', ''),
(290, 'POSITION', 'AO1', '0_Administrative Officer I'),
(291, 'POSITION', 'AO2', '0_Administrative Officer II'),
(292, 'POSITION', 'AO3', '0_Administrative Officer III'),
(293, 'BILL_CAT', 'PTA', ''),
(294, 'BILL_CAT', 'STEP', ''),
(295, 'BILL_CAT', 'SSG', ''),
(296, 'BILL_CAT', 'SPP', ''),
(297, 'BILL_CAT', 'OTHERS', ''),
(298, 'EDUCLEVEL', 'ELEMENTARY', ''),
(299, 'EDUCLEVEL', 'SECONDARY', ''),
(300, 'EDUCLEVEL', 'VOCATIONAL', ''),
(301, 'EDUCLEVEL', 'TERTIARY', ''),
(302, 'EDUCLEVEL', 'MASTERAL', ''),
(303, 'EDUCLEVEL', 'DOCTORAL', ''),
(307, 'TRACK', 'SHS APPLIED', ''),
(306, 'TIMELSLOTS', '08:00-12:00', '-'),
(315, 'TRANSFERRED IN', 'TRANSFERRED IN', ''),
(304, 'TIMELSLOTS', '13:00-17:00', ''),
(329, 'TRACK', 'SHS-ACAD-HUM', ''),
(322, 'TRACK', 'SHS-ACAD-ABM', ''),
(321, 'RESIDENCE', 'POBLACION, PANGLAO, BOHOL', ''),
(320, 'CURRICULUM', '2002', ''),
(328, 'TIMELSLOTS', '14:00-16:00', '-'),
(330, 'POSITION', 'REGISTRAR1', '0_Registrar I'),
(394, 'RESIDENCE', 'CANTUBOD, DANAO, BOHOL', ''),
(332, 'RESIDENCE', 'TAGBILARAN, BOHOL', ''),
(334, 'CLASSTYPE', 'Kindergarten', ''),
(335, 'CLASSTYPE', 'Primary School', ''),
(336, 'CLASSTYPE', 'Junior High School', ''),
(337, 'CLASSTYPE', 'Senior High School', ''),
(342, 'TRACKS', 'ACADEMICS', ''),
(343, 'TRACKS', 'SPORTS', ''),
(344, 'TRACKS', 'ARTS-DESIGN', ''),
(345, 'TRACKS', 'TVL', ''),
(346, 'STRAND-ACADEMICS', 'GAS', ''),
(347, 'STRAND-ACADEMICS', 'HUM', ''),
(348, 'STRAND-ACADEMICS', 'ABM', ''),
(349, 'STRAND-ACADEMICS', 'STEM', ''),
(350, 'STRAND-TVL', 'AF', ''),
(351, 'STRAND-TVL', 'HE', ''),
(352, 'STRAND-TVL', 'IA', ''),
(353, 'STRAND-TVL', 'ICT', ''),
(354, 'STRAND-ARTS-DESIGN', 'ARTS-DESIGN', ''),
(355, 'STRAND-SPORTS', 'SPORTS', ''),
(356, 'COMBO-GAS', 'General Academic Strand', ''),
(357, 'COMBO-ABM', 'Accountancy, Business, & Management', ''),
(358, 'COMBO-HUM', 'Humanities', ''),
(359, 'COMBO-HE', 'Bread & Pastry NCII, Bread & Beverage NCII, Cookery NCII', ''),
(360, 'COMBO-HE', 'Bread & Pastry NCII, Bread & Beverage NCII, Hair Dressing NCII', ''),
(361, 'COMBO-ICT', 'Programming Java NCIII, Animation NCII', ''),
(367, 'RESIDENCE', 'MAGTONGTONG, CALAPE, BOHOL', ''),
(368, 'RESIDENCE', 'CAUSWAGAN NORTE, CATIGBIAN, BOHOL', ''),
(369, 'POSITION', 'ADAS1', '0_Administrative Assistant I'),
(370, 'POSITION', 'ADAS2', '0_Administrative Assistant II'),
(371, 'POSITION', 'ADAS3', '0_Administrative Assistant III'),
(372, 'POSITION', 'ADAS4', '0_Administrative Assistant IV'),
(373, 'POSITION', 'ADAS5', '0_Administrative Assistant V'),
(374, 'POSITION', 'AO4', '0_Administrative Officer IV'),
(375, 'POSITION', 'AO5', '0_Administrative Officer V'),
(376, 'POSITION', 'REGISTRAR2', '0_Registrar II'),
(377, 'POSITION', 'REGISTRAR3', '0_Registrar III'),
(378, 'POSITION', 'REGISTRAR4', '0_Registrar IV'),
(379, 'POSITION', 'PRINCIPAL3', '0_Principal III'),
(380, 'POSITION', 'PRINCIPAL4', '0_Principal IV'),
(383, 'POSITION', 'JHS MT3', '1_JHS Master Teacher III'),
(384, 'POSITION', 'JHS MT4', '1_JHS Master Teacher IV'),
(385, 'POSITION', 'HT3', '0_Head Teacher III'),
(386, 'POSITION', 'HT4', '0_Head Teacher IV'),
(395, 'POSITION', 'GC1', '0_Guidance Counselor I'),
(392, 'RESIDENCE', 'CANGAWA, BUENAVISTA, BOHOL', ''),
(396, 'RESIDENCE', 'HAGUILANAN GRANDE, BALILIHAN, BOHOL', ''),
(397, 'RESIDENCE', 'POBLACION, PRES. CARLOS P. GARCIA, BOHOL', ''),
(398, 'RESIDENCE', 'POOC ORIENTAL, TUBIGON, BOHOL', ''),
(399, 'RESIDENCE', 'SUBA, ANDA, BOHOL', ''),
(400, 'RESIDENCE', 'MA. ROSARIO, INABANGA, BOHOL', ''),
(402, 'POSITION', 'GC2', '0_Guidance Counselor II'),
(403, 'TEACHERIDS', 'WORK ID', '-'),
(404, 'RESIDENCE', 'SALVADOR, SIERRA BULLONES, BOHOL', ''),
(405, 'TEACHERIDS', 'POSTAL ID', '-'),
(406, 'TEACHERIDS', 'COMELEC ID', '-'),
(407, 'RESIDENCE', 'MANTALONGON SAGBAYAN BOHOL', ''),
(408, 'RESIDENCE', 'DAGNAWAN, INABANGA, BOHOL', ''),
(409, 'RESIDENCE', 'STA. CRUZ, SAGBAYAN, BOHOL', ''),
(410, 'RESIDENCE', 'BUAYA,LLC', ''),
(411, 'RESIDENCE', 'SAGBAYAN CES', ''),
(412, 'RESIDENCE', 'FORTUNAN,CLARIN,BOHOL', ''),
(413, 'RESIDENCE', 'MANLICO,HINUNANGAN,SO.LEYTE', ''),
(414, 'COMBO-HE', 'DRESSMAKING, TAILORING', ''),
(415, 'TRACK', 'SHS-TVL-HE', ''),
(416, 'TRACK', 'ES GENERAL', '-'),
(417, 'POSITION', 'ES T1', '1_ES Teacher I'),
(418, 'POSITION', 'ES T2', '1_ES Teacher II'),
(419, 'POSITION', 'ES T3', '1_ES Teacher III'),
(420, 'POSITION', 'ES MT1', '1_ES Master Teacher I'),
(421, 'POSITION', 'ES MT2', '1_ES Master Teacher II'),
(422, 'POSITION', 'ES MT3', '1_ES Master Teacher III'),
(423, 'POSITION', 'ES MT4', '1_ES Master Teacher IV');

-- --------------------------------------------------------

--
-- Table structure for table `earlyregistry`
--

DROP TABLE IF EXISTS `earlyregistry`;
CREATE TABLE IF NOT EXISTS `earlyregistry` (
  `er_no` int(6) NOT NULL AUTO_INCREMENT,
  `er_stud_no` int(6) NOT NULL,
  `er_sy` int(6) NOT NULL,
  `er_level` int(6) NOT NULL,
  `er_disability` varchar(100) NOT NULL,
  `er_prevschool` varchar(100) NOT NULL,
  `er_creds` varchar(100) NOT NULL,
  `er_remarks` varchar(100) NOT NULL,
  `er_lastmoddatetime` datetime NOT NULL,
  `er_lastmod_user_no` int(6) NOT NULL,
  PRIMARY KEY (`er_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `earlyregistry`
--


-- --------------------------------------------------------

--
-- Table structure for table `frei_banned_users`
--

DROP TABLE IF EXISTS `frei_banned_users`;
CREATE TABLE IF NOT EXISTS `frei_banned_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `frei_banned_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `frei_chat`
--

DROP TABLE IF EXISTS `frei_chat`;
CREATE TABLE IF NOT EXISTS `frei_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `from_name` varchar(30) NOT NULL,
  `to` int(11) NOT NULL,
  `to_name` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  `time` double(15,4) NOT NULL,
  `GMT_time` bigint(20) NOT NULL,
  `message_type` int(11) NOT NULL DEFAULT '0',
  `room_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `frei_chat`
--


-- --------------------------------------------------------

--
-- Table structure for table `frei_config`
--

DROP TABLE IF EXISTS `frei_config`;
CREATE TABLE IF NOT EXISTS `frei_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) DEFAULT 'NULL',
  `cat` varchar(20) DEFAULT 'NULL',
  `subcat` varchar(20) DEFAULT 'NULL',
  `val` varchar(500) DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `frei_config`
--

INSERT INTO `frei_config` (`id`, `key`, `cat`, `subcat`, `val`) VALUES
(1, 'PATH', 'NULL', 'NULL', 'freichat/'),
(2, 'show_name', 'NULL', 'NULL', 'guest'),
(3, 'displayname', 'NULL', 'NULL', 'username'),
(4, 'chatspeed', 'NULL', 'NULL', '10'),
(5, 'fxval', 'NULL', 'NULL', 'true'),
(6, 'draggable', 'NULL', 'NULL', 'enable'),
(7, 'conflict', 'NULL', 'NULL', ''),
(8, 'msgSendSpeed', 'NULL', 'NULL', '10'),
(9, 'show_avatar', 'NULL', 'NULL', 'none'),
(10, 'debug', 'NULL', 'NULL', 'false'),
(11, 'freichat_theme', 'NULL', 'NULL', 'basic'),
(12, 'lang', 'NULL', 'NULL', 'english'),
(13, 'load', 'NULL', 'NULL', 'show'),
(14, 'time', 'NULL', 'NULL', '7'),
(15, 'JSdebug', 'NULL', 'NULL', 'false'),
(16, 'busy_timeOut', 'NULL', 'NULL', '500'),
(17, 'offline_timeOut', 'NULL', 'NULL', '1000'),
(18, 'cache', 'NULL', 'NULL', 'enabled'),
(19, 'GZIP_handler', 'NULL', 'NULL', 'ON'),
(20, 'plugins', 'file_sender', 'show', 'true'),
(21, 'plugins', 'file_sender', 'file_size', '2000'),
(22, 'plugins', 'file_sender', 'expiry', '300'),
(23, 'plugins', 'file_sender', 'valid_exts', 'jpeg,jpg,png,gif,zip'),
(24, 'plugins', 'send_conv', 'show', 'true'),
(25, 'plugins', 'send_conv', 'mailtype', 'smtp'),
(26, 'plugins', 'send_conv', 'smtp_server', 'smtp.gmail.com'),
(27, 'plugins', 'send_conv', 'smtp_port', '465'),
(28, 'plugins', 'send_conv', 'smtp_protocol', 'ssl'),
(29, 'plugins', 'send_conv', 'from_address', 'you@domain.com'),
(30, 'plugins', 'send_conv', 'from_name', 'FreiChat'),
(31, 'playsound', 'NULL', 'NULL', 'true'),
(32, 'ACL', 'filesend', 'user', 'allow'),
(33, 'ACL', 'filesend', 'guest', 'noallow'),
(34, 'ACL', 'chatroom', 'user', 'allow'),
(35, 'ACL', 'chatroom', 'guest', 'allow'),
(36, 'ACL', 'mail', 'user', 'allow'),
(37, 'ACL', 'mail', 'guest', 'allow'),
(38, 'ACL', 'save', 'user', 'allow'),
(39, 'ACL', 'save', 'guest', 'allow'),
(40, 'ACL', 'smiley', 'user', 'allow'),
(41, 'ACL', 'smiley', 'guest', 'allow'),
(42, 'polling', 'NULL', 'NULL', 'disabled'),
(43, 'polling_time', 'NULL', 'NULL', '30'),
(44, 'link_profile', 'NULL', 'NULL', 'disabled'),
(46, 'sef_link_profile', 'NULL', 'NULL', 'disabled'),
(47, 'plugins', 'chatroom', 'location', 'bottom'),
(48, 'plugins', 'chatroom', 'autoclose', 'true'),
(49, 'content_height', 'NULL', 'NULL', 'auto'),
(50, 'chatbox_status', 'NULL', 'NULL', 'false'),
(51, 'BOOT', 'NULL', 'NULL', 'yes'),
(52, 'exit_for_guests', 'NULL', 'NULL', 'no'),
(53, 'plugins', 'chatroom', 'offset', '50px'),
(54, 'plugins', 'chatroom', 'label_offset', '0.8%'),
(55, 'addedoptions_visibility', 'NULL', 'NULL', 'HIDDEN'),
(56, 'ug_ids', 'NULL', 'NULL', ''),
(57, 'ACL', 'chat', 'user', 'allow'),
(58, 'ACL', 'chat', 'guest', 'allow'),
(59, 'plugins', 'chatroom', 'override_positions', 'yes'),
(60, 'ACL', 'video', 'user', 'allow'),
(61, 'ACL', 'video', 'guest', 'allow'),
(62, 'ACL', 'chatroom_crt', 'user', 'allow'),
(63, 'ACL', 'chatroom_crt', 'guest', 'noallow'),
(64, 'plugins', 'chatroom', 'chatroom_expiry', '3600'),
(65, 'chat_time_shown_always', 'NULL', 'NULL', 'no'),
(66, 'allow_guest_name_change', 'NULL', 'NULL', 'yes'),
(67, 'ACL', 'groupchat', 'user', 'allow'),
(68, 'ACL', 'groupchat', 'guest', 'noallow');

-- --------------------------------------------------------

--
-- Table structure for table `frei_groupchat`
--

DROP TABLE IF EXISTS `frei_groupchat`;
CREATE TABLE IF NOT EXISTS `frei_groupchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `group_author` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_created` int(11) NOT NULL,
  `group_participants` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `frei_groupchat`
--


-- --------------------------------------------------------

--
-- Table structure for table `frei_rooms`
--

DROP TABLE IF EXISTS `frei_rooms`;
CREATE TABLE IF NOT EXISTS `frei_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_author` varchar(100) NOT NULL,
  `room_name` varchar(200) NOT NULL,
  `room_type` tinyint(4) NOT NULL,
  `room_password` varchar(100) NOT NULL,
  `room_created` int(11) NOT NULL,
  `room_last_active` int(11) NOT NULL,
  `room_order` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_name` (`room_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `frei_rooms`
--

INSERT INTO `frei_rooms` (`id`, `room_author`, `room_name`, `room_type`, `room_password`, `room_created`, `room_last_active`, `room_order`) VALUES
(1, 'admin', 'Public Chat', 0, '', 1373557250, 1512606694, 1);

-- --------------------------------------------------------

--
-- Table structure for table `frei_session`
--

DROP TABLE IF EXISTS `frei_session`;
CREATE TABLE IF NOT EXISTS `frei_session` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `time` int(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `permanent_id` int(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `status_mesg` varchar(100) NOT NULL,
  `guest` tinyint(3) NOT NULL,
  `in_room` int(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permanent_id` (`permanent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7539 ;

--
-- Dumping data for table `frei_session`
--

INSERT INTO `frei_session` (`id`, `username`, `time`, `session_id`, `permanent_id`, `status`, `status_mesg`, `guest`, `in_room`) VALUES
(7538, 'SYSTEM ADMINISTRATOR', 1528295313, '1', 1528791636, 1, 'I am available', 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `frei_smileys`
--

DROP TABLE IF EXISTS `frei_smileys`;
CREATE TABLE IF NOT EXISTS `frei_smileys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `frei_smileys`
--

INSERT INTO `frei_smileys` (`id`, `symbol`, `image_name`) VALUES
(1, ':S', 'worried55231.gif'),
(2, '(wasntme)', 'itwasntme55198.gif'),
(3, 'x(', 'angry55174.gif'),
(4, '(doh)', 'doh55146.gif'),
(5, '|-()', 'yawn55117.gif'),
(6, ']:)', 'evilgrin55088.gif'),
(7, '|(', 'dull55062.gif'),
(8, '|-)', 'sleepy55036.gif'),
(9, '(blush)', 'blush54981.gif'),
(10, ':P', 'tongueout54953.gif'),
(11, '(:|', 'sweat54888.gif'),
(12, ';(', 'crying54854.gif'),
(13, ':)', 'smile54593.gif'),
(14, ':(', 'sad54749.gif'),
(15, ':D', 'bigsmile54781.gif'),
(16, '8)', 'cool54801.gif'),
(17, ':o', 'wink54827.gif'),
(18, '(mm)', 'mmm55255.gif'),
(19, ':x', 'lipssealed55304.gif');

-- --------------------------------------------------------

--
-- Table structure for table `frei_video_session`
--

DROP TABLE IF EXISTS `frei_video_session`;
CREATE TABLE IF NOT EXISTS `frei_video_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT NULL COMMENT 'unique room id',
  `from_id` int(11) NOT NULL,
  `msg_type` varchar(10) NOT NULL,
  `msg_label` int(2) NOT NULL,
  `msg_data` varchar(3000) NOT NULL,
  `msg_time` decimal(15,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `frei_video_session`
--


-- --------------------------------------------------------

--
-- Table structure for table `frei_webrtc`
--

DROP TABLE IF EXISTS `frei_webrtc`;
CREATE TABLE IF NOT EXISTS `frei_webrtc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frm_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `participants_id` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `frei_webrtc`
--


-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `grade_no` int(6) NOT NULL AUTO_INCREMENT,
  `grade_sy` double NOT NULL,
  `grade_sem` int(2) NOT NULL,
  `grade_class_no` int(6) NOT NULL,
  `grade_stud_no` int(6) NOT NULL,
  `grade_q1` int(3) DEFAULT NULL,
  `grade_q2` int(3) DEFAULT NULL,
  `grade_q3` int(3) DEFAULT NULL,
  `grade_q4` int(3) DEFAULT NULL,
  `grade_final` int(3) DEFAULT NULL,
  `grade_remarks` varchar(25) DEFAULT NULL,
  `grade_lastuser_no` int(6) DEFAULT NULL,
  `grade_lastupdated` datetime DEFAULT NULL,
  `grade_remedialgrade` int(3) DEFAULT NULL,
  `grade_recomputedfinalgrade` int(3) DEFAULT NULL,
  `grade_finalremarks` varchar(25) DEFAULT NULL,
  `grade_notes` text,
  PRIMARY KEY (`grade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grade`
--


-- --------------------------------------------------------

--
-- Table structure for table `hacklogs`
--

DROP TABLE IF EXISTS `hacklogs`;
CREATE TABLE IF NOT EXISTS `hacklogs` (
  `hacklog_no` int(6) NOT NULL AUTO_INCREMENT,
  `hacklog_stud_no` int(6) NOT NULL,
  `hacklog_datetime` datetime NOT NULL,
  PRIMARY KEY (`hacklog_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hacklogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `iis_menu`
--

DROP TABLE IF EXISTS `iis_menu`;
CREATE TABLE IF NOT EXISTS `iis_menu` (
  `iis_menu_no` int(6) NOT NULL AUTO_INCREMENT,
  `iis_menuname` varchar(50) NOT NULL,
  `iis_menuparent_menu_no` int(6) NOT NULL,
  `iis_menusort` int(6) NOT NULL,
  PRIMARY KEY (`iis_menu_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `iis_menu`
--

INSERT INTO `iis_menu` (`iis_menu_no`, `iis_menuname`, `iis_menuparent_menu_no`, `iis_menusort`) VALUES
(1, 'Home', 0, 1),
(2, 'About Us', 0, 2),
(21, 'Prospective Students', 2, 3),
(3, 'Resources', 0, 3),
(4, 'Transparency Board', 0, 4),
(5, 'Contact Us', 0, 5),
(7, 'DepEd VMV', 2, 4),
(8, 'Organizational Structure', 2, 3),
(9, 'Curriculum Offerings', 2, 2),
(10, 'School Profile', 2, 1),
(11, 'Memoranda', 3, 1),
(12, 'Department Orders', 3, 2),
(13, 'Templates/Forms', 3, 3),
(16, 'MOOE Funds', 4, 1),
(17, 'PTA Funds', 4, 2),
(18, 'Canteen Funds', 4, 3),
(19, 'YECS Funds', 4, 4),
(20, 'Other School Funds', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `iis_page`
--

DROP TABLE IF EXISTS `iis_page`;
CREATE TABLE IF NOT EXISTS `iis_page` (
  `iis_page_no` int(6) NOT NULL AUTO_INCREMENT,
  `iis_pagetitle` varchar(100) NOT NULL,
  `iis_pagecontent` text NOT NULL,
  `iis_page_menu_no` int(6) NOT NULL,
  `iis_page_user_no` int(6) NOT NULL,
  `iis_pagepublishdate` datetime NOT NULL,
  PRIMARY KEY (`iis_page_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `iis_page`
--

INSERT INTO `iis_page` (`iis_page_no`, `iis_pagetitle`, `iis_pagecontent`, `iis_page_menu_no`, `iis_page_user_no`, `iis_pagepublishdate`) VALUES
(1, 'Vision, Mission, Core Values, and Mandate', '<p><strong>DepEd Vision</strong></p>\r\n<p>We dream of Filipinos</p>\r\n<p>who passionately love their country</p>\r\n<p>and whose competencies and values</p>\r\n<p>enable them to realize their full potential and contribute meaningfully to building the nation.</p>\r\n<p>&nbsp;</p>\r\n<p>As a learner-centered public institution,</p>\r\n<p>the Department of Education</p>\r\n<p>continuously improves itself</p>\r\n<p>to better serve its stakeholders.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>DepEd Mission</strong></p>\r\n<p>To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete basic education where:</p>\r\n<ul>\r\n<li>Students learn in a child-friendly, gender-sensitive, safe, and motivating environment</li>\r\n<li>Teachers facilitate learning and constantly nurture every learner</li>\r\n<li>Administrators and staff, as stewards of the institution, ensure an enabling and supportive environment for effective learning to happen.</li>\r\n<li>Family, community, and other stakeholders are actively engaged and share responsibility for developing life-long learners.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>DepEd Core Values</strong></p>\r\n<p>Maka-Diyos</p>\r\n<p>Makatao</p>\r\n<p>Maka-kalikasan</p>\r\n<p>Makabansa</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n</ul>', 7, 1, '2017-02-24 15:19:15'),
(6, 'Admission Requirements', '<p><strong>Incoming Grade 7 / Transferees (Junior High School):</strong></p>\r\n<ul>\r\n<li>Elementary School Card <span>&nbsp;/ Form 138 duly signed by the principal (original)</span></li>\r\n<li>Colored 2"x2" Recent Photo (2 copies)</li>\r\n<li>Birth Certificate (photocopy)</li>\r\n<li>Certificate of Good Moral Character from previous school attended (original)</li>\r\n<li>Thick Brown Envelop (1 pc)</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Incoming Grade 11 / <strong>(Senior High School):</strong></strong></p>\r\n<ul>\r\n<li>Junior High School Card / Form 138 duly signed by the principal (original)</li>\r\n<li>Certfificate of Completion (photocopy)</li>\r\n<li>NCAE Result (photocopy)</li>\r\n<li>Colored 2"x2" Recent Photo (2 copies)</li>\r\n<li>Birth Certificate (photocopy)</li>\r\n<li>Certificate of Good Moral Character from previous school attended <span>(original)</span></li>\r\n<li>Thick Brown Envelop (1 pc)</li>\r\n</ul>', 21, 1, '2017-02-25 16:16:22'),
(4, 'Curricular Offerings', '<p><span style="font-size: small;"><strong>Junior High School</strong></span></p>\r\n<ul>\r\n<li>Grade 7</li>\r\n<li>Grade 8</li>\r\n<li>Grade 9     \r\n<ul>\r\n<li><strong>TLE Majors:</strong> \r\n<ul>\r\n<li>Computer Systems Servicing&nbsp;<span>NCII</span></li>\r\n<li>Cookery&nbsp;<span>NCII</span></li>\r\n<li>Beauty/Nail Care Services&nbsp;<span>NCII</span></li>\r\n<li>Dressmaking <span>NCII</span></li>\r\n<li>Electrical Installation and Maintenance&nbsp;<span>NCII</span></li>\r\n<li>Agri-Crop Production&nbsp;<span>NCII</span></li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<ul>\r\n<li>Grade 10      \r\n<ul>\r\n<li><strong>TLE Majors:</strong> \r\n<ul>\r\n<li>Computer Systems Servicing&nbsp;<span>NCII</span></li>\r\n<li>Cookery&nbsp;<span>NCII</span></li>\r\n<li>Wellness Massage&nbsp;<span>NCII</span></li>\r\n<li>Dressmaking</li>\r\n<li>Electrical Installation and Maintenance&nbsp;<span>NCII</span></li>\r\n<li>Agri-Crop Production&nbsp;<span>NCII</span></li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p><br /><span style="font-size: small;"><strong>Senior High School</strong> </span></p>\r\n<ul>\r\n<li><strong>Academics Track:</strong> \r\n<ul>\r\n<li>General Academic Strand</li>\r\n</ul>\r\n</li>\r\n<li><strong>Tech-Voc Track:</strong> \r\n<ul>\r\n<li>ICT Strand (Programming Java NC III, Animation NCII)</li>\r\n<li>HE Strand (Bread &amp; Pastry <span>NCII</span>, Food &amp; Beverage <span>NCII</span>, Hairdressing <span>NCII</span>)</li>\r\n<li>HE Strand (Bread &amp; Pastry&nbsp;<span>NCII</span>, Food &amp; Beverage <span>NCII</span>, Cookery NCII)</li>\r\n</ul>\r\n</li>\r\n</ul>', 9, 1, '2017-02-25 07:44:28'),
(5, 'Organizational Structure', '<p><strong>Administrators:</strong></p>\r\n<ul>\r\n<li>Nilo P. Samputon, School Principal</li>\r\n<li>Perlita L. Enad, Property Custodian - Designate</li>\r\n<li>Jose B. Lamoste, Plant Coordinator - Designate</li>\r\n<li>Roque P. Ngoho, PESS Coordinator - Designate</li>\r\n<li>Fernando B. Enad, Administrative Assistant - Designate</li>\r\n</ul>\r\n<p><br /><strong>Section Advisers:</strong></p>\r\n<ul>\r\n<li>Alicia P. Reyes, Grade 7 - Amethyst</li>\r\n<li>Ermilinda G. Rociento, Grade 7 - Garnet</li>\r\n<li>Sueden S. Lanje, Grade 7 - Fluorite</li>\r\n<li>Marigine E. Macabodbod, Grade 7 - Jasper</li>\r\n<li>Aida T. Lumagod, Grade 7 - Opal</li>\r\n<li>Rosita D. Tapayan, Grade 8 - Emerald</li>\r\n<li>Erlinda B. Micabani, Grade 8 - Jacinth</li>\r\n<li>Miraflor D. Comamao, Grade 8 - Onyx</li>\r\n<li>Bienvenida I. Sumipo, Grade 8 - Ruby</li>\r\n<li>Jeramie E. Bulawan, Grade 8 - Silver</li>\r\n<li>Hilaria U. Paquiabas, Grade 9 - Diamond</li>\r\n<li>Perigrita J. Datahan, Grade 9 - Jade</li>\r\n<li>Rhea Marie D. Enad, Grade 9 - Pearl</li>\r\n<li>Elisa M. Garcia, Grade 9 - Topaz</li>\r\n<li>Rosemarie M. Satumcacal, Grade 10 - Beryl</li>\r\n<li>Rowena T. Tahanlangit, Grade 10 - Gold</li>\r\n<li>Alejandra O. Marzon, Grade 10 - Sapphire</li>\r\n<li>Anna Liza L. Gines, Grade 10 - Zircon</li>\r\n</ul>\r\n<p><br /><strong>Faculty Members:</strong></p>\r\n<ul>\r\n<li>Erlinda M. Polinar, Faculty Member</li>\r\n<li>Liza L. Abejaron, Faculty Member</li>\r\n<li>Raymund Q. Cabantan, Faculty Member</li>\r\n<li>Marie Stefanie C. Hora, Faculty Member</li>\r\n<li>Doris C. Miano, Faculty Member</li>\r\n<li>Junalyn L. Amba, Faculty Member</li>\r\n<li>Grace C. Manatad, Faculty Member</li>\r\n<li>Ian Bhel B. Tero, Faculty Member</li>\r\n<li>Jenny Ann L. Tumale, Faculty Member</li>\r\n</ul>', 8, 1, '2017-02-25 07:45:41'),
(3, 'School Profile', '<p>The municipality of Sagbayan, being part of the province of Bohol has twenty four (24) barangays. One of the biggest barangays is San Agustin where San Agustin National High School is located.</p>\r\n<p>&nbsp;</p>\r\n<p>Fighting the problem on high illiteracy rate among the community populace opens the door of the first public secondary school of Sagbayan. Its institutional history is anchored on the reality where people hungered for knowledge and education sow the seed of what is now the San Agustin National High School.</p>\r\n<p>&nbsp;</p>\r\n<p>The school was conceived by the late Maximo Villamor, former Provincial DILG officer of the province of Bohol. His passion to be a man for others kindled his courage to make the first step to help the low &ndash; income families whose children have the lesser opportunity to continue secondary education. And for the benefit of the young learners whose parents cannot afford to send them to distant neighbouring public and private high schools, together with the former barangay captain Tito Soquillo and his councilmen, he was able to convince the late Dr. Edilberto Jumamoy, former mayor of Inabanga, to donate part of his lot for the establishment of a new public secondary school.</p>\r\n<p>&nbsp;</p>\r\n<p>The school had undergone metamorphosis from a lone classroom made of &ldquo;nipa&rdquo; thatched roofing and &ldquo;amakan&rdquo; as a wall to a modern twelve (13) concrete classrooms. From its first year of operation in the year 1994, it grows in terms of its human resource and capacity. From an enrolment of 54 students, it is now almost nine (9) hundred. From a manpower of two teachers, the faculty is now composed of thirty-seven (37) qualified mentors.</p>\r\n<p>&nbsp;</p>\r\n<p>The year 1997 marks another important milestone in the history of San Agustin National High School, when it was integrated in the general appropriation thru Republic Act. No. 8319 authored by the late Erico B. Aumentado, former Congressman in the 2<sup>nd</sup> District of Bohol.</p>\r\n<p>&nbsp;</p>\r\n<p>The school is one of the four (4) complete secondary schools in the District of Sagbayan with the biggest number of enrollment. Vegetables are the common source of income for the school.</p>\r\n<p>&nbsp;</p>\r\n<p>Now, the journey continues in search for better outcomes. More aspirations, more opportunities were identified. Thus hopes drive the spirit of unity for all to see the rays of dawn.</p>', 10, 1, '2017-02-24 15:50:34'),
(7, 'Contact Us', 'There are several ways you can contact me. You can email me directly at \r\n<a href=''mailto:''>sanhs.sagbayan@gmail.com</a>.  Alternatively, you can fill in\r\nthe form on this page which sends your message to me via Email.<br /><br />\r\n<form name=''userform'' method=''post'' action=''contact.php''>\r\n<table cellpadding=''0'' cellspacing=''0'' class=''center''>\r\n<tr>\r\n<td width=''100'' class=''tbl''>Name:</td>\r\n<td class=''tbl''><input type=''text'' name=''mailname'' maxlength=''50'' class=''textbox'' style=''width: 200px;'' /></td>\r\n</tr>\r\n<tr>\r\n<td width=''100'' class=''tbl''>Email Address:</td>\r\n<td class=''tbl''><input type=''text'' name=''email'' maxlength=''100'' class=''textbox'' style=''width: 200px;'' /></td>\r\n</tr>\r\n<tr>\r\n<td width=''100'' class=''tbl''>Subject:</td>\r\n<td class=''tbl''><input type=''text'' name=''subject'' maxlength=''50'' class=''textbox'' style=''width: 200px;'' /></td>\r\n</tr>\r\n<tr>\r\n<td width=''100'' class=''tbl''>Message:</td>\r\n<td class=''tbl''><textarea name=''message'' rows=''10'' class=''textbox'' cols=''50''></textarea></td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=''center'' colspan=''2'' class=''tbl''>\r\n<input type=''submit'' name=''sendmessage'' value=''Send Message'' class=''button'' /></td>\r\n</tr>\r\n</table>\r\n</form>', 5, 1, '2017-02-25 16:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

DROP TABLE IF EXISTS `license`;
CREATE TABLE IF NOT EXISTS `license` (
  `current_school_code` int(6) NOT NULL,
  `current_school_name` varchar(150) NOT NULL,
  `current_school_full` varchar(150) NOT NULL,
  `current_school_short` varchar(150) NOT NULL,
  `current_school_address` varchar(150) NOT NULL,
  `current_school_district` varchar(150) NOT NULL,
  `current_school_division` varchar(150) NOT NULL,
  `current_school_region` varchar(150) NOT NULL,
  `current_school_reg_code` int(1) NOT NULL,
  `current_school_contact` varchar(150) NOT NULL,
  `current_school_email` varchar(150) NOT NULL,
  `current_school_minlevel` int(2) NOT NULL,
  `current_school_maxlevel` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`current_school_code`, `current_school_name`, `current_school_full`, `current_school_short`, `current_school_address`, `current_school_district`, `current_school_division`, `current_school_region`, `current_school_reg_code`, `current_school_contact`, `current_school_email`, `current_school_minlevel`, `current_school_maxlevel`) VALUES
(302887, 'San Agustin National High School', 'San Agustin NHS', 'SANHS', 'Sagbayan, Bohol', 'Sagbayan', 'Bohol', 'Region VII, Central Visayas', 7, '+63.920.500.1182', 'sanhs.sagbayan@gmail.com', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `missinglogs`
--

DROP TABLE IF EXISTS `missinglogs`;
CREATE TABLE IF NOT EXISTS `missinglogs` (
  `ml_no` int(6) NOT NULL AUTO_INCREMENT,
  `ml_userid` int(6) NOT NULL,
  `ml_checkdate` date NOT NULL,
  `ml_checktime` time NOT NULL,
  `ml_checktype` varchar(1) NOT NULL,
  `ml_reason` text NOT NULL,
  `ml_apply_user_no` int(6) NOT NULL,
  `ml_apply_regdatetime` datetime NOT NULL,
  `ml_approve_user_no` int(6) NOT NULL DEFAULT '0',
  `ml_approve_regdatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`ml_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `missinglogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `missinglogsstudent`
--

DROP TABLE IF EXISTS `missinglogsstudent`;
CREATE TABLE IF NOT EXISTS `missinglogsstudent` (
  `ml_no` int(6) NOT NULL AUTO_INCREMENT,
  `ml_userid` int(6) NOT NULL,
  `ml_checkdate` date NOT NULL,
  `ml_checktime` time NOT NULL,
  `ml_checktype` varchar(1) NOT NULL,
  `ml_reason` text NOT NULL,
  `ml_apply_user_no` int(6) NOT NULL,
  `ml_apply_regdatetime` datetime NOT NULL,
  `ml_approve_user_no` int(6) NOT NULL DEFAULT '0',
  `ml_approve_regdatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`ml_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `missinglogsstudent`
--


-- --------------------------------------------------------

--
-- Table structure for table `nut_afh`
--

DROP TABLE IF EXISTS `nut_afh`;
CREATE TABLE IF NOT EXISTS `nut_afh` (
  `af_no` int(6) NOT NULL AUTO_INCREMENT,
  `months` int(6) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ss` double NOT NULL,
  `s` double NOT NULL,
  `n` double NOT NULL,
  `t` double NOT NULL,
  PRIMARY KEY (`af_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=387 ;

--
-- Dumping data for table `nut_afh`
--

INSERT INTO `nut_afh` (`af_no`, `months`, `gender`, `ss`, `s`, `n`, `t`) VALUES
(1, 36, 'MALE', 84.9, 88.6, 103.5, 103.6),
(2, 37, 'MALE', 85.4, 89.1, 104.2, 104.3),
(3, 38, 'MALE', 85.9, 89.7, 105, 105.1),
(4, 39, 'MALE', 86.4, 90.2, 105.7, 105.8),
(5, 40, 'MALE', 86.9, 90.8, 106.4, 106.5),
(6, 41, 'MALE', 87.4, 91.3, 107.1, 107.2),
(7, 42, 'MALE', 87.9, 91.8, 107.8, 107.9),
(8, 43, 'MALE', 88.3, 92.3, 108.5, 108.6),
(9, 44, 'MALE', 88.8, 92.9, 109.1, 109.2),
(10, 45, 'MALE', 89.3, 93.4, 109.8, 109.9),
(11, 46, 'MALE', 89.7, 93.9, 110.4, 110.5),
(12, 47, 'MALE', 90.2, 94.3, 111.1, 111.2),
(13, 48, 'MALE', 90.6, 94.8, 111.7, 111.8),
(14, 49, 'MALE', 91.1, 95.3, 112.4, 112.5),
(15, 50, 'MALE', 91.5, 95.8, 113, 113.1),
(16, 51, 'MALE', 92, 96.3, 113.6, 113.7),
(17, 52, 'MALE', 92.4, 96.8, 114.2, 114.3),
(18, 53, 'MALE', 92.9, 97.3, 114.9, 115),
(19, 54, 'MALE', 93.3, 97.7, 115.5, 115.6),
(20, 55, 'MALE', 93.8, 98.2, 116.1, 116.2),
(21, 56, 'MALE', 94.2, 98.7, 116.7, 116.8),
(22, 57, 'MALE', 94.6, 99.2, 117.4, 117.5),
(23, 58, 'MALE', 95.1, 99.6, 118, 118.1),
(24, 59, 'MALE', 95.5, 100.1, 118.6, 118.7),
(25, 60, 'MALE', 96, 100.6, 119.2, 119.3),
(26, 61, 'MALE', 96.4, 101, 119.4, 119.5),
(27, 62, 'MALE', 96.8, 101.5, 120, 120.1),
(28, 63, 'MALE', 97.3, 101.9, 120.6, 120.7),
(29, 64, 'MALE', 97.7, 102.4, 121.2, 121.3),
(30, 65, 'MALE', 98.1, 102.9, 121.8, 121.9),
(31, 66, 'MALE', 98.6, 103.3, 122.4, 122.5),
(32, 67, 'MALE', 99, 103.8, 123, 123.1),
(33, 68, 'MALE', 99.4, 104.2, 123.6, 123.7),
(34, 69, 'MALE', 99.8, 104.7, 124.1, 124.2),
(35, 70, 'MALE', 100.3, 105.1, 124.7, 124.8),
(36, 71, 'MALE', 100.7, 105.6, 125.2, 125.3),
(37, 72, 'MALE', 101.1, 106, 125.8, 125.9),
(38, 73, 'MALE', 101.5, 106.4, 126.4, 126.5),
(39, 74, 'MALE', 101.9, 106.9, 126.9, 127),
(40, 75, 'MALE', 102.3, 107.3, 127.5, 127.6),
(41, 76, 'MALE', 102.7, 107.7, 128, 128.1),
(42, 77, 'MALE', 103.1, 108.1, 128.5, 128.6),
(43, 78, 'MALE', 103.5, 108.6, 129.1, 129.2),
(44, 79, 'MALE', 103.8, 109, 129.6, 129.7),
(45, 80, 'MALE', 104.2, 109.4, 130.2, 130.3),
(46, 81, 'MALE', 104.6, 109.8, 130.7, 130.8),
(47, 82, 'MALE', 105, 110.2, 131.2, 131.3),
(48, 83, 'MALE', 105.4, 110.7, 131.8, 131.9),
(49, 84, 'MALE', 105.8, 111.1, 132.3, 132.4),
(50, 85, 'MALE', 106.2, 111.5, 132.8, 132.9),
(51, 86, 'MALE', 106.5, 111.9, 133.4, 133.5),
(52, 87, 'MALE', 106.9, 112.3, 133.9, 134),
(53, 88, 'MALE', 107.3, 112.7, 134.4, 134.5),
(54, 89, 'MALE', 107.7, 113.1, 134.9, 135),
(55, 90, 'MALE', 108, 113.5, 135.5, 135.6),
(56, 91, 'MALE', 108.4, 113.9, 136, 136.1),
(57, 92, 'MALE', 108.8, 114.3, 136.5, 136.6),
(58, 93, 'MALE', 109.1, 114.7, 137, 137.1),
(59, 94, 'MALE', 109.5, 115.1, 137.5, 137.6),
(60, 95, 'MALE', 109.9, 115.5, 138.1, 138.2),
(61, 96, 'MALE', 110.2, 115.9, 138.6, 138.7),
(62, 97, 'MALE', 110.6, 116.3, 139.1, 139.2),
(63, 98, 'MALE', 110.9, 116.6, 139.6, 139.7),
(64, 99, 'MALE', 111.3, 117, 140.1, 140.2),
(65, 100, 'MALE', 111.6, 117.4, 140.6, 140.7),
(66, 101, 'MALE', 112, 117.8, 141.1, 141.2),
(67, 102, 'MALE', 112.3, 118.2, 141.6, 141.7),
(68, 103, 'MALE', 112.7, 118.6, 142.1, 142.2),
(69, 104, 'MALE', 113, 118.9, 142.6, 142.7),
(70, 105, 'MALE', 113.4, 119.3, 143.1, 143.2),
(71, 106, 'MALE', 113.7, 119.7, 143.6, 143.7),
(72, 107, 'MALE', 114.1, 120.1, 144.1, 144.2),
(73, 108, 'MALE', 114.4, 120.4, 144.6, 144.7),
(74, 109, 'MALE', 114.8, 120.8, 145.1, 145.2),
(75, 110, 'MALE', 115.1, 121.2, 145.6, 145.7),
(76, 111, 'MALE', 115.5, 121.6, 146.1, 146.2),
(77, 112, 'MALE', 115.8, 121.9, 146.6, 146.7),
(78, 113, 'MALE', 116.2, 122.3, 147.1, 147.2),
(79, 114, 'MALE', 116.5, 122.7, 147.6, 147.7),
(80, 115, 'MALE', 116.8, 123.1, 148.1, 148.2),
(81, 116, 'MALE', 117.2, 123.4, 148.6, 148.7),
(82, 117, 'MALE', 117.5, 123.8, 149.1, 149.2),
(83, 118, 'MALE', 117.9, 124.2, 149.5, 149.6),
(84, 119, 'MALE', 118.2, 124.6, 150, 150.1),
(85, 120, 'MALE', 118.6, 124.9, 150.5, 150.6),
(86, 121, 'MALE', 118.9, 125.3, 151, 151.1),
(87, 122, 'MALE', 119.2, 125.7, 151.5, 151.6),
(88, 123, 'MALE', 119.6, 126.1, 152, 152.1),
(89, 124, 'MALE', 119.9, 126.4, 152.5, 152.6),
(90, 125, 'MALE', 120.3, 126.8, 153, 153.1),
(91, 126, 'MALE', 120.6, 127.2, 153.5, 153.6),
(92, 127, 'MALE', 121, 127.6, 154, 154.1),
(93, 128, 'MALE', 121.3, 128, 154.5, 154.6),
(94, 129, 'MALE', 121.7, 128.4, 155, 155.1),
(95, 130, 'MALE', 122.1, 128.7, 155.5, 155.6),
(96, 131, 'MALE', 122.4, 129.1, 156.1, 156.2),
(97, 132, 'MALE', 122.8, 129.6, 156.6, 156.7),
(98, 133, 'MALE', 123.2, 130, 157.1, 157.2),
(99, 134, 'MALE', 123.6, 130.4, 157.6, 157.7),
(100, 135, 'MALE', 124, 130.8, 158.2, 158.3),
(101, 136, 'MALE', 124.4, 131.2, 158.7, 158.8),
(102, 137, 'MALE', 124.8, 131.6, 159.3, 159.4),
(103, 138, 'MALE', 125.2, 132.1, 159.8, 159.9),
(104, 139, 'MALE', 125.6, 132.5, 160.4, 160.5),
(105, 140, 'MALE', 126, 133, 160.9, 161),
(106, 141, 'MALE', 126.4, 133.4, 161.5, 161.6),
(107, 142, 'MALE', 126.8, 133.9, 162.1, 162.2),
(108, 143, 'MALE', 127.3, 134.3, 162.7, 162.8),
(109, 144, 'MALE', 127.7, 134.8, 163.3, 163.4),
(110, 145, 'MALE', 128.2, 135.3, 163.9, 164),
(111, 146, 'MALE', 128.6, 135.8, 164.5, 164.6),
(112, 147, 'MALE', 129.1, 136.3, 165.1, 165.2),
(113, 148, 'MALE', 129.6, 136.8, 165.7, 165.8),
(114, 149, 'MALE', 130.1, 137.3, 166.3, 166.4),
(115, 150, 'MALE', 130.6, 137.8, 167, 167.1),
(116, 151, 'MALE', 131.1, 138.4, 167.6, 167.7),
(117, 152, 'MALE', 131.6, 138.9, 168.3, 168.4),
(118, 153, 'MALE', 132.1, 139.4, 168.9, 169),
(119, 154, 'MALE', 132.6, 140, 169.6, 169.7),
(120, 155, 'MALE', 133.1, 140.5, 170.2, 170.3),
(121, 156, 'MALE', 133.7, 141.1, 170.9, 171),
(122, 157, 'MALE', 134.2, 141.6, 171.6, 171.7),
(123, 158, 'MALE', 134.7, 142.2, 172.2, 172.3),
(124, 159, 'MALE', 135.3, 142.8, 172.9, 173),
(125, 160, 'MALE', 135.8, 143.3, 173.5, 173.6),
(126, 161, 'MALE', 136.3, 143.9, 174.2, 174.3),
(127, 162, 'MALE', 136.9, 144.4, 174.8, 174.9),
(128, 163, 'MALE', 136.4, 145, 175.5, 175.6),
(129, 164, 'MALE', 137.9, 145.6, 176.1, 176.2),
(130, 165, 'MALE', 138.5, 146.1, 176.7, 176.8),
(131, 166, 'MALE', 139, 146.6, 177.4, 177.5),
(132, 167, 'MALE', 139.5, 147.2, 178, 178.1),
(133, 168, 'MALE', 140, 147.7, 178.6, 178.7),
(134, 169, 'MALE', 140.5, 148.2, 179.1, 179.2),
(135, 170, 'MALE', 141, 148.7, 179.7, 179.8),
(136, 171, 'MALE', 141.5, 149.2, 180.3, 180.4),
(137, 172, 'MALE', 142, 149.7, 180.8, 180.9),
(138, 173, 'MALE', 142.4, 150.2, 181.3, 181.4),
(139, 174, 'MALE', 142.9, 150.7, 181.8, 181.9),
(140, 175, 'MALE', 143.3, 151.1, 182.3, 182.4),
(141, 176, 'MALE', 143.8, 151.6, 182.8, 182.9),
(142, 177, 'MALE', 144.2, 152, 183.3, 183.4),
(143, 178, 'MALE', 144.6, 152.4, 183.7, 183.8),
(144, 179, 'MALE', 145, 152.8, 184.1, 184.2),
(145, 180, 'MALE', 145.4, 153.3, 184.6, 184.7),
(146, 181, 'MALE', 145.8, 153.6, 185, 185.1),
(147, 182, 'MALE', 146.2, 154, 185.4, 185.5),
(148, 183, 'MALE', 146.6, 154.4, 185.7, 185.8),
(149, 184, 'MALE', 147, 154.8, 186.1, 186.2),
(150, 185, 'MALE', 147.3, 155.1, 186.4, 186.5),
(151, 186, 'MALE', 147.6, 155.4, 186.8, 186.9),
(152, 187, 'MALE', 148, 155.8, 187.1, 187.2),
(153, 188, 'MALE', 148.3, 156.1, 187.4, 187.5),
(154, 189, 'MALE', 148.6, 156.4, 187.7, 187.8),
(155, 190, 'MALE', 148.9, 156.7, 187.9, 188),
(156, 191, 'MALE', 149.2, 157, 188.2, 188.3),
(157, 192, 'MALE', 149.5, 157.3, 188.4, 188.5),
(158, 193, 'MALE', 149.8, 157.5, 188.7, 188.8),
(159, 194, 'MALE', 150, 157.8, 188.9, 189),
(160, 195, 'MALE', 150.3, 158, 189.1, 189.2),
(161, 196, 'MALE', 150.5, 158.3, 189.3, 189.4),
(162, 197, 'MALE', 150.8, 158.5, 189.5, 189.6),
(163, 198, 'MALE', 151, 158.7, 189.7, 189.8),
(164, 199, 'MALE', 151.2, 158.9, 189.8, 189.9),
(165, 200, 'MALE', 151.4, 159.1, 190, 190.1),
(166, 201, 'MALE', 151.6, 159.3, 190.1, 190.2),
(167, 202, 'MALE', 151.8, 159.5, 190.2, 190.3),
(168, 203, 'MALE', 152, 159.6, 190.3, 190.4),
(169, 204, 'MALE', 152.1, 159.8, 190.4, 190.5),
(170, 205, 'MALE', 152.3, 159.9, 190.5, 190.6),
(171, 206, 'MALE', 152.4, 160.1, 190.6, 190.7),
(172, 207, 'MALE', 152.6, 160.2, 190.7, 190.8),
(173, 208, 'MALE', 152.7, 160.3, 190.8, 190.9),
(174, 209, 'MALE', 152.9, 160.4, 190.8, 190.9),
(175, 210, 'MALE', 153, 160.5, 190.9, 191),
(176, 211, 'MALE', 153.1, 160.7, 190.9, 191),
(177, 212, 'MALE', 153.2, 160.8, 191, 191.1),
(178, 213, 'MALE', 153.3, 160.8, 191, 191.1),
(179, 214, 'MALE', 153.4, 160.9, 191, 191.1),
(180, 215, 'MALE', 153.5, 161, 191.1, 191.2),
(181, 216, 'MALE', 153.6, 161.1, 191.1, 191.2),
(182, 217, 'MALE', 153.7, 161.2, 191.1, 191.2),
(183, 218, 'MALE', 153.8, 161.3, 191.1, 191.2),
(184, 219, 'MALE', 153.9, 161.3, 191.1, 191.2),
(185, 220, 'MALE', 154, 161.4, 191.1, 191.2),
(186, 221, 'MALE', 154.1, 161.5, 191.1, 191.2),
(187, 222, 'MALE', 154.1, 161.5, 191.1, 191.2),
(188, 223, 'MALE', 154.2, 161.6, 191.2, 191.3),
(189, 224, 'MALE', 154.3, 161.6, 191.2, 191.3),
(190, 225, 'MALE', 154.4, 161.7, 191.2, 191.3),
(191, 226, 'MALE', 154.4, 161.7, 191.1, 191.2),
(192, 227, 'MALE', 154.5, 161.8, 191.1, 191.2),
(193, 228, 'MALE', 154.5, 161.8, 191.1, 191.2),
(194, 36, 'FEMALE', 83.5, 87.3, 102.7, 102.8),
(195, 37, 'FEMALE', 84.1, 87.9, 103.4, 103.5),
(196, 38, 'FEMALE', 84.6, 88.5, 104.2, 104.3),
(197, 39, 'FEMALE', 85.2, 89.1, 105, 105.1),
(198, 40, 'FEMALE', 85.7, 89.7, 105.7, 105.8),
(199, 41, 'FEMALE', 86.2, 90.3, 106.4, 106.5),
(200, 42, 'FEMALE', 86.7, 90.8, 107.2, 107.3),
(201, 43, 'FEMALE', 87.3, 91.4, 107.9, 108),
(202, 44, 'FEMALE', 87.8, 91.9, 108.6, 108.7),
(203, 45, 'FEMALE', 88.3, 92.4, 109.3, 109.4),
(204, 46, 'FEMALE', 88.8, 93, 110, 110.1),
(205, 47, 'FEMALE', 89.2, 93.5, 110.7, 110.8),
(206, 48, 'FEMALE', 89.7, 94, 111.3, 111.4),
(207, 49, 'FEMALE', 90.2, 94.5, 112, 112.1),
(208, 50, 'FEMALE', 90.6, 95, 112.7, 112.8),
(209, 51, 'FEMALE', 91.1, 95.5, 113.3, 113.4),
(210, 52, 'FEMALE', 91.6, 96, 114, 114.1),
(211, 53, 'FEMALE', 92, 96.5, 114.6, 114.7),
(212, 54, 'FEMALE', 92.5, 97, 115.2, 115.3),
(213, 55, 'FEMALE', 92.9, 97.5, 115.9, 116),
(214, 56, 'FEMALE', 93.3, 98, 116.5, 116.6),
(215, 57, 'FEMALE', 93.8, 98.4, 117.1, 117.2),
(216, 58, 'FEMALE', 94.2, 98.9, 117.7, 117.8),
(217, 59, 'FEMALE', 94.6, 99.4, 118.3, 118.4),
(218, 60, 'FEMALE', 95.1, 99.8, 118.9, 119),
(219, 61, 'FEMALE', 95.2, 100, 119.1, 119.2),
(220, 62, 'FEMALE', 95.6, 100.4, 119.7, 119.8),
(221, 63, 'FEMALE', 96, 100.9, 120.3, 120.4),
(222, 64, 'FEMALE', 96.4, 101.3, 120.9, 121),
(223, 65, 'FEMALE', 96.9, 101.8, 121.5, 121.6),
(224, 66, 'FEMALE', 97.3, 102.2, 122, 122.1),
(225, 67, 'FEMALE', 97.7, 102.6, 122.6, 122.7),
(226, 68, 'FEMALE', 98.1, 103.1, 123.2, 123.3),
(227, 69, 'FEMALE', 98.5, 103.5, 123.7, 123.8),
(228, 70, 'FEMALE', 98.9, 103.9, 124.3, 124.4),
(229, 71, 'FEMALE', 99.3, 104.4, 124.8, 124.9),
(230, 72, 'FEMALE', 99.7, 104.8, 125.4, 125.5),
(231, 73, 'FEMALE', 100.1, 105.2, 125.9, 126),
(232, 74, 'FEMALE', 100.4, 105.6, 126.4, 126.5),
(233, 75, 'FEMALE', 100.8, 106, 127, 127.1),
(234, 76, 'FEMALE', 101.2, 106.5, 127.5, 127.6),
(235, 77, 'FEMALE', 101.6, 106.9, 128, 128.1),
(236, 78, 'FEMALE', 102, 107.3, 128.6, 128.7),
(237, 79, 'FEMALE', 102.4, 107.7, 129.1, 129.2),
(238, 80, 'FEMALE', 102.8, 108.1, 129.6, 129.7),
(239, 81, 'FEMALE', 103.1, 108.5, 130.2, 130.3),
(240, 82, 'FEMALE', 103.5, 108.9, 130.7, 130.8),
(241, 83, 'FEMALE', 103.9, 109.4, 131.2, 131.3),
(242, 84, 'FEMALE', 104.3, 109.8, 131.7, 131.8),
(243, 85, 'FEMALE', 104.7, 110.2, 132.3, 132.4),
(244, 86, 'FEMALE', 105.1, 110.6, 132.8, 132.9),
(245, 87, 'FEMALE', 105.5, 111, 133.3, 133.4),
(246, 88, 'FEMALE', 105.9, 111.5, 133.9, 134),
(247, 89, 'FEMALE', 106.3, 111.9, 134.4, 134.5),
(248, 90, 'FEMALE', 106.7, 112.3, 134.9, 135),
(249, 91, 'FEMALE', 107.1, 112.7, 135.5, 135.6),
(250, 92, 'FEMALE', 107.5, 113.1, 136, 136.1),
(251, 93, 'FEMALE', 107.9, 113.6, 136.5, 136.6),
(252, 94, 'FEMALE', 108.3, 114, 137.1, 137.2),
(253, 95, 'FEMALE', 108.7, 114.4, 137.6, 137.7),
(254, 96, 'FEMALE', 109.1, 114.9, 138.2, 138.3),
(255, 97, 'FEMALE', 109.5, 115.3, 138.7, 138.8),
(256, 98, 'FEMALE', 109.9, 115.7, 139.2, 139.3),
(257, 99, 'FEMALE', 110.3, 116.2, 139.8, 139.9),
(258, 100, 'FEMALE', 110.7, 116.6, 140.3, 140.4),
(259, 101, 'FEMALE', 111.1, 117, 140.9, 141),
(260, 102, 'FEMALE', 111.5, 117.5, 141.4, 141.5),
(261, 103, 'FEMALE', 111.9, 117.9, 142, 142.1),
(262, 104, 'FEMALE', 112.4, 118.4, 142.5, 142.6),
(263, 105, 'FEMALE', 112.8, 118.8, 143.1, 143.2),
(264, 106, 'FEMALE', 113.2, 119.3, 143.6, 143.7),
(265, 107, 'FEMALE', 113.6, 119.7, 144.2, 144.3),
(266, 108, 'FEMALE', 114.1, 120.2, 144.7, 144.8),
(267, 109, 'FEMALE', 114.5, 120.6, 145.3, 145.4),
(268, 110, 'FEMALE', 114.9, 121.1, 145.8, 145.9),
(269, 111, 'FEMALE', 115.4, 121.5, 146.4, 146.5),
(270, 112, 'FEMALE', 115.8, 122, 146.9, 147),
(271, 113, 'FEMALE', 116.2, 122.5, 147.5, 147.6),
(272, 114, 'FEMALE', 116.7, 122.9, 148.1, 148.2),
(273, 115, 'FEMALE', 117.1, 123.4, 148.6, 148.7),
(274, 116, 'FEMALE', 117.6, 123.9, 149.2, 149.3),
(275, 117, 'FEMALE', 118, 124.3, 149.7, 149.8),
(276, 118, 'FEMALE', 118.4, 124.8, 150.3, 150.4),
(277, 119, 'FEMALE', 118.9, 125.3, 150.9, 151),
(278, 120, 'FEMALE', 119.3, 125.7, 151.4, 151.5),
(279, 121, 'FEMALE', 119.8, 126.2, 152, 152.1),
(280, 122, 'FEMALE', 120.3, 126.7, 152.6, 152.7),
(281, 123, 'FEMALE', 120.7, 127.2, 153.1, 153.2),
(282, 124, 'FEMALE', 121.2, 127.7, 153.7, 153.8),
(283, 125, 'FEMALE', 121.6, 128.1, 154.3, 154.4),
(284, 126, 'FEMALE', 122.1, 128.6, 154.8, 154.9),
(285, 127, 'FEMALE', 122.6, 129.1, 155.4, 155.5),
(286, 128, 'FEMALE', 123.1, 129.6, 156, 156.1),
(287, 129, 'FEMALE', 123.5, 130.1, 156.6, 156.7),
(288, 130, 'FEMALE', 124, 130.6, 157.1, 157.2),
(289, 131, 'FEMALE', 124.5, 131.1, 157.7, 157.8),
(290, 132, 'FEMALE', 125, 131.6, 158.3, 158.4),
(291, 133, 'FEMALE', 125.4, 132.1, 158.9, 159),
(292, 134, 'FEMALE', 125.9, 132.6, 159.4, 159.5),
(293, 135, 'FEMALE', 126.4, 133.1, 160, 160.1),
(294, 136, 'FEMALE', 126.9, 133.6, 160.6, 160.7),
(295, 137, 'FEMALE', 127.3, 134.1, 161.1, 161.2),
(296, 138, 'FEMALE', 127.8, 134.6, 161.7, 161.8),
(297, 139, 'FEMALE', 128.3, 135.1, 162.2, 162.3),
(298, 140, 'FEMALE', 128.8, 135.6, 162.8, 162.9),
(299, 141, 'FEMALE', 129.2, 136, 163.3, 163.4),
(300, 142, 'FEMALE', 129.7, 136.5, 163.9, 164),
(301, 143, 'FEMALE', 130.2, 137, 164.4, 164.5),
(302, 144, 'FEMALE', 130.6, 137.5, 164.9, 165),
(303, 145, 'FEMALE', 131.1, 137.9, 165.4, 165.5),
(304, 146, 'FEMALE', 131.5, 138.4, 165.9, 166),
(305, 147, 'FEMALE', 131.9, 138.8, 166.4, 166.5),
(306, 148, 'FEMALE', 132.4, 139.2, 166.9, 167),
(307, 149, 'FEMALE', 132.8, 139.7, 167.4, 167.5),
(308, 150, 'FEMALE', 133.2, 140.1, 167.8, 167.9),
(309, 151, 'FEMALE', 133.6, 140.5, 168.3, 168.4),
(310, 152, 'FEMALE', 134, 140.9, 168.7, 168.8),
(311, 153, 'FEMALE', 134.4, 141.3, 169.1, 169.2),
(312, 154, 'FEMALE', 134.7, 141.7, 169.5, 169.6),
(313, 155, 'FEMALE', 135.1, 142, 169.9, 170),
(314, 156, 'FEMALE', 135.5, 142.4, 170.3, 170.4),
(315, 157, 'FEMALE', 135.8, 142.7, 170.6, 170.7),
(316, 158, 'FEMALE', 136.1, 143.1, 171, 171.1),
(317, 159, 'FEMALE', 136.4, 143.4, 171.3, 171.4),
(318, 160, 'FEMALE', 136.8, 143.7, 171.6, 171.7),
(319, 161, 'FEMALE', 137.1, 144, 171.9, 172),
(320, 162, 'FEMALE', 137.3, 144.3, 172.2, 172.3),
(321, 163, 'FEMALE', 137.6, 144.6, 172.5, 172.6),
(322, 164, 'FEMALE', 137.9, 144.8, 172.7, 172.8),
(323, 165, 'FEMALE', 138.1, 145.1, 173, 173.1),
(324, 166, 'FEMALE', 138.4, 145.3, 173.2, 173.3),
(325, 167, 'FEMALE', 138.6, 145.6, 173.5, 173.6),
(326, 168, 'FEMALE', 138.9, 145.8, 173.7, 173.8),
(327, 169, 'FEMALE', 139.1, 146, 173.9, 174),
(328, 170, 'FEMALE', 139.3, 146.2, 174.1, 174.2),
(329, 171, 'FEMALE', 139.5, 146.4, 174.2, 174.3),
(330, 172, 'FEMALE', 139.7, 146.6, 174.4, 174.5),
(331, 173, 'FEMALE', 139.9, 146.8, 174.6, 174.7),
(332, 174, 'FEMALE', 140, 147, 174.7, 174.8),
(333, 175, 'FEMALE', 140.2, 147.1, 174.9, 175),
(334, 176, 'FEMALE', 140.4, 147.3, 175, 175.1),
(335, 177, 'FEMALE', 140.5, 147.4, 175.1, 175.2),
(336, 178, 'FEMALE', 140.7, 147.6, 175.2, 175.3),
(337, 179, 'FEMALE', 140.8, 147.7, 175.3, 175.4),
(338, 180, 'FEMALE', 140.9, 147.8, 175.4, 175.5),
(339, 181, 'FEMALE', 141.1, 147.9, 175.5, 175.6),
(340, 182, 'FEMALE', 141.2, 148, 175.6, 175.7),
(341, 183, 'FEMALE', 141.3, 148.1, 175.7, 175.8),
(342, 184, 'FEMALE', 141.4, 148.2, 175.7, 175.8),
(343, 185, 'FEMALE', 141.5, 148.3, 175.8, 175.9),
(344, 186, 'FEMALE', 141.6, 148.4, 175.9, 176),
(345, 187, 'FEMALE', 141.7, 148.5, 175.9, 176),
(346, 188, 'FEMALE', 141.8, 148.6, 176, 176.1),
(347, 189, 'FEMALE', 141.8, 148.6, 176, 176.1),
(348, 190, 'FEMALE', 141.9, 148.7, 176, 176.1),
(349, 191, 'FEMALE', 142, 148.8, 176.1, 176.2),
(350, 192, 'FEMALE', 142.1, 148.8, 176.1, 176.2),
(351, 193, 'FEMALE', 142.1, 148.9, 176.1, 176.2),
(352, 194, 'FEMALE', 142.2, 149, 176.1, 176.2),
(353, 195, 'FEMALE', 142.2, 149, 176.2, 176.3),
(354, 196, 'FEMALE', 142.3, 149.1, 176.2, 176.3),
(355, 197, 'FEMALE', 142.3, 149.1, 176.2, 176.3),
(356, 198, 'FEMALE', 142.4, 149.1, 176.2, 176.3),
(357, 199, 'FEMALE', 142.4, 149.2, 176.2, 176.3),
(358, 200, 'FEMALE', 142.5, 149.2, 176.2, 176.3),
(359, 201, 'FEMALE', 142.5, 149.3, 176.2, 176.3),
(360, 202, 'FEMALE', 142.6, 149.3, 176.2, 176.3),
(361, 203, 'FEMALE', 142.6, 149.3, 176.2, 176.3),
(362, 204, 'FEMALE', 142.7, 149.4, 176.2, 176.3),
(363, 205, 'FEMALE', 142.7, 149.4, 176.2, 176.3),
(364, 206, 'FEMALE', 142.8, 149.4, 176.2, 176.3),
(365, 207, 'FEMALE', 142.8, 149.5, 176.3, 176.4),
(366, 208, 'FEMALE', 142.8, 149.5, 176.3, 176.4),
(367, 209, 'FEMALE', 142.9, 149.5, 176.3, 176.4),
(368, 210, 'FEMALE', 142.9, 149.6, 176.3, 176.4),
(369, 211, 'FEMALE', 143, 149.6, 176.3, 176.4),
(370, 212, 'FEMALE', 143, 149.6, 176.3, 176.4),
(371, 213, 'FEMALE', 143, 149.7, 176.3, 176.4),
(372, 214, 'FEMALE', 143.1, 149.7, 176.3, 176.4),
(373, 215, 'FEMALE', 143.1, 149.7, 176.3, 176.4),
(374, 216, 'FEMALE', 143.1, 149.7, 176.3, 176.4),
(375, 217, 'FEMALE', 143.2, 149.8, 176.3, 176.4),
(376, 218, 'FEMALE', 143.2, 149.8, 176.3, 176.4),
(377, 219, 'FEMALE', 143.2, 149.8, 176.3, 176.4),
(378, 220, 'FEMALE', 143.3, 149.8, 176.3, 176.4),
(379, 221, 'FEMALE', 143.3, 149.9, 176.3, 176.4),
(380, 222, 'FEMALE', 143.3, 149.9, 176.3, 176.4),
(381, 223, 'FEMALE', 143.3, 149.9, 176.3, 176.4),
(382, 224, 'FEMALE', 143.4, 149.9, 176.3, 176.4),
(383, 225, 'FEMALE', 143.4, 149.9, 176.3, 176.4),
(384, 226, 'FEMALE', 143.4, 149.9, 176.3, 176.4),
(385, 227, 'FEMALE', 143.4, 150, 176.2, 176.3),
(386, 228, 'FEMALE', 143.4, 150, 176.2, 176.3);

-- --------------------------------------------------------

--
-- Table structure for table `nut_bmi`
--

DROP TABLE IF EXISTS `nut_bmi`;
CREATE TABLE IF NOT EXISTS `nut_bmi` (
  `bm_no` int(6) NOT NULL AUTO_INCREMENT,
  `months` int(6) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `sw` double NOT NULL,
  `w` double NOT NULL,
  `n` double NOT NULL,
  `ow` double NOT NULL,
  `o` double NOT NULL,
  PRIMARY KEY (`bm_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=387 ;

--
-- Dumping data for table `nut_bmi`
--

INSERT INTO `nut_bmi` (`bm_no`, `months`, `gender`, `sw`, `w`, `n`, `ow`, `o`) VALUES
(1, 36, 'MALE', 10, 11.2, 18.3, 18.4, 18.5),
(2, 37, 'MALE', 10.1, 11.3, 18.6, 18.7, 18.8),
(3, 38, 'MALE', 10.2, 11.4, 18.8, 18.9, 19),
(4, 39, 'MALE', 10.3, 11.5, 19, 19.1, 19.2),
(5, 40, 'MALE', 10.4, 11.7, 19.3, 19.4, 19.5),
(6, 41, 'MALE', 10.5, 11.8, 19.5, 19.6, 19.7),
(7, 42, 'MALE', 10.6, 11.9, 19.7, 19.8, 19.9),
(8, 43, 'MALE', 10.7, 12, 20, 20.1, 20.2),
(9, 44, 'MALE', 10.8, 12.1, 20.2, 20.3, 20.4),
(10, 45, 'MALE', 10.9, 12.3, 20.5, 20.6, 20.7),
(11, 46, 'MALE', 11, 12.4, 20.7, 20.8, 20.9),
(12, 47, 'MALE', 11.1, 12.5, 20.9, 21, 21.1),
(13, 48, 'MALE', 11.2, 12.6, 21.2, 21.3, 21.4),
(14, 49, 'MALE', 11.3, 12.7, 21.4, 21.5, 21.6),
(15, 50, 'MALE', 11.4, 12.8, 21.7, 21.8, 21.9),
(16, 51, 'MALE', 11.5, 13, 21.9, 22, 22.1),
(17, 52, 'MALE', 11.6, 13.1, 22.2, 22.3, 22.4),
(18, 53, 'MALE', 11.7, 13.2, 22.4, 22.5, 22.6),
(19, 54, 'MALE', 11.8, 13.3, 22.7, 22.8, 22.9),
(20, 55, 'MALE', 11.9, 13.4, 22.9, 23, 23.1),
(21, 56, 'MALE', 12, 13.5, 23.2, 23.3, 23.4),
(22, 57, 'MALE', 12.1, 13.6, 23.4, 23.5, 23.6),
(23, 58, 'MALE', 12.2, 13.7, 23.7, 23.8, 23.9),
(24, 59, 'MALE', 12.3, 13.9, 23.9, 24, 24.1),
(25, 60, 'MALE', 12.4, 14, 24.2, 24.3, 24.4),
(26, 61, 'MALE', 12.7, 14.3, 24.3, 24.4, 24.5),
(27, 62, 'MALE', 12.8, 14.4, 24.4, 24.5, 24.6),
(28, 63, 'MALE', 13, 14.5, 24.7, 24.8, 24.9),
(29, 64, 'MALE', 13.1, 14.7, 24.9, 25, 25.1),
(30, 65, 'MALE', 13.2, 14.8, 25.2, 25.3, 25.4),
(31, 66, 'MALE', 13.3, 14.9, 25.5, 25.6, 25.7),
(32, 67, 'MALE', 13.4, 15.1, 25.7, 25.8, 25.9),
(33, 68, 'MALE', 13.6, 15.2, 26, 26.1, 26.2),
(34, 69, 'MALE', 13.7, 15.3, 26.3, 26.4, 26.5),
(35, 70, 'MALE', 13.8, 15.5, 26.6, 26.7, 26.8),
(36, 71, 'MALE', 13.9, 15.6, 26.8, 26.9, 27),
(37, 72, 'MALE', 12, 12.9, 18.5, 20.7, 20.8),
(38, 73, 'MALE', 12, 12.9, 18.6, 20.8, 20.9),
(39, 74, 'MALE', 12.1, 13, 18.6, 20.8, 20.9),
(40, 75, 'MALE', 12.1, 13, 18.6, 20.9, 21),
(41, 76, 'MALE', 12.1, 13, 18.7, 21, 21.1),
(42, 77, 'MALE', 12.1, 13, 18.7, 21, 21.1),
(43, 78, 'MALE', 12.1, 13, 18.7, 21.1, 21.2),
(44, 79, 'MALE', 12.1, 13, 18.8, 21.2, 21.3),
(45, 80, 'MALE', 12.1, 13, 18.8, 21.3, 21.4),
(46, 81, 'MALE', 12.1, 13, 18.9, 21.3, 21.4),
(47, 82, 'MALE', 12.1, 13, 18.9, 21.4, 21.5),
(48, 83, 'MALE', 12.1, 13, 19, 21.5, 21.6),
(49, 84, 'MALE', 12.2, 13, 19, 21.6, 21.7),
(50, 85, 'MALE', 12.2, 13.1, 19.1, 21.7, 21.8),
(51, 86, 'MALE', 12.2, 13.1, 19.1, 21.8, 21.8),
(52, 87, 'MALE', 12.2, 13.1, 19.2, 21.9, 22),
(53, 88, 'MALE', 12.2, 13.1, 19.2, 22, 22.1),
(54, 89, 'MALE', 12.2, 13.1, 19.3, 22, 22.1),
(55, 90, 'MALE', 12.2, 13.1, 19.3, 22.1, 22.2),
(56, 91, 'MALE', 12.2, 13.1, 19.4, 22.2, 22.3),
(57, 92, 'MALE', 12.2, 13.1, 19.4, 22.4, 22.5),
(58, 93, 'MALE', 12.3, 13.2, 19.5, 22.5, 22.6),
(59, 94, 'MALE', 12.3, 13.2, 19.6, 22.6, 22.7),
(60, 95, 'MALE', 12.3, 13.2, 19.6, 22.7, 22.8),
(61, 96, 'MALE', 12.3, 13.2, 19.7, 22.8, 22.9),
(62, 97, 'MALE', 12.3, 13.2, 19.7, 22.9, 23),
(63, 98, 'MALE', 12.3, 13.2, 19.8, 23, 23.1),
(64, 99, 'MALE', 12.3, 13.2, 19.9, 23.1, 23.2),
(65, 100, 'MALE', 12.3, 13.3, 19.9, 23.3, 23.4),
(66, 101, 'MALE', 12.4, 13.3, 20, 23.4, 23.5),
(67, 102, 'MALE', 12.4, 13.3, 20.1, 23.5, 23.6),
(68, 103, 'MALE', 12.4, 13.3, 20.1, 23.6, 23.7),
(69, 104, 'MALE', 12.4, 13.3, 20.2, 23.8, 23.9),
(70, 105, 'MALE', 12.4, 13.3, 20.3, 23.9, 24),
(71, 106, 'MALE', 12.4, 13.4, 20.3, 24, 24.1),
(72, 107, 'MALE', 12.4, 13.4, 20.4, 24.2, 24.3),
(73, 108, 'MALE', 12.5, 13.4, 20.5, 24.3, 24.4),
(74, 109, 'MALE', 12.5, 13.4, 20.5, 24.4, 24.5),
(75, 110, 'MALE', 12.5, 13.4, 20.6, 24.6, 24.7),
(76, 111, 'MALE', 12.5, 13.4, 20.7, 24.7, 24.8),
(77, 112, 'MALE', 12.5, 13.5, 20.8, 24.9, 25),
(78, 113, 'MALE', 12.5, 13.5, 20.8, 25, 25.1),
(79, 114, 'MALE', 12.6, 13.5, 20.9, 25.1, 25.2),
(80, 115, 'MALE', 12.6, 13.5, 21, 25.3, 25.4),
(81, 116, 'MALE', 12.6, 13.5, 21.1, 25.5, 25.6),
(82, 117, 'MALE', 12.6, 13.6, 21.2, 25.6, 25.7),
(83, 118, 'MALE', 12.6, 13.6, 21.2, 25.8, 25.9),
(84, 119, 'MALE', 12.7, 13.6, 21.3, 25.9, 26),
(85, 120, 'MALE', 12.7, 13.6, 21.4, 26.1, 26.2),
(86, 121, 'MALE', 12.7, 13.7, 21.5, 26.2, 26.3),
(87, 122, 'MALE', 12.7, 13.7, 21.6, 26.4, 26.5),
(88, 123, 'MALE', 12.7, 13.7, 21.7, 26.6, 26.7),
(89, 124, 'MALE', 12.8, 13.7, 21.7, 26.7, 26.8),
(90, 125, 'MALE', 12.8, 13.8, 21.8, 26.9, 27),
(91, 126, 'MALE', 12.8, 13.8, 21.9, 27, 27.1),
(92, 127, 'MALE', 12.8, 13.8, 22, 27.2, 27.3),
(93, 128, 'MALE', 12.9, 13.8, 22.1, 27.4, 27.5),
(94, 129, 'MALE', 12.9, 13.9, 22.2, 27.5, 27.6),
(95, 130, 'MALE', 12.9, 13.9, 22.3, 27.7, 27.8),
(96, 131, 'MALE', 12.9, 13.9, 22.4, 27.9, 28),
(97, 132, 'MALE', 13, 14, 22.5, 28, 28.1),
(98, 133, 'MALE', 13, 14, 22.5, 28.2, 28.3),
(99, 134, 'MALE', 13, 14, 22.6, 28.4, 28.5),
(100, 135, 'MALE', 13, 14, 22.7, 28.5, 28.6),
(101, 136, 'MALE', 13.1, 14.1, 22.8, 28.7, 28.8),
(102, 137, 'MALE', 13.1, 14.1, 22.9, 28.8, 28.9),
(103, 138, 'MALE', 13.1, 14.1, 23, 29, 29.1),
(104, 139, 'MALE', 13.1, 14.2, 23.1, 29.2, 29.3),
(105, 140, 'MALE', 13.2, 14.2, 23.2, 29.3, 29.4),
(106, 141, 'MALE', 13.2, 14.2, 23.3, 29.5, 29.6),
(107, 142, 'MALE', 13.2, 14.3, 23.4, 29.6, 29.7),
(108, 143, 'MALE', 13.3, 14.3, 23.5, 29.8, 29.9),
(109, 144, 'MALE', 13.3, 14.4, 23.6, 30, 30.1),
(110, 145, 'MALE', 13.3, 14.4, 23.7, 30.1, 30.2),
(111, 146, 'MALE', 13.4, 14.4, 23.8, 30.3, 30.4),
(112, 147, 'MALE', 13.4, 14.5, 23.9, 30.4, 30.5),
(113, 148, 'MALE', 13.4, 14.5, 24, 30.6, 30.7),
(114, 149, 'MALE', 13.5, 14.5, 24.1, 30.7, 30.8),
(115, 150, 'MALE', 13.5, 14.6, 24.2, 30.9, 31),
(116, 151, 'MALE', 13.5, 14.6, 24.3, 31, 31.1),
(117, 152, 'MALE', 13.6, 14.7, 24.4, 31.1, 31.2),
(118, 153, 'MALE', 13.6, 14.7, 24.5, 31.3, 31.4),
(119, 154, 'MALE', 13.6, 14.7, 24.6, 31.4, 31.5),
(120, 155, 'MALE', 13.7, 14.8, 24.7, 31.6, 31.7),
(121, 156, 'MALE', 13.7, 14.8, 24.8, 31.7, 31.8),
(122, 157, 'MALE', 13.7, 14.9, 24.9, 31.8, 31.9),
(123, 158, 'MALE', 13.8, 14.9, 25, 31.9, 32),
(124, 159, 'MALE', 13.8, 15, 25.1, 32.1, 32.2),
(125, 160, 'MALE', 13.9, 15, 25.2, 32.2, 32.3),
(126, 161, 'MALE', 13.9, 15.1, 25.2, 32.3, 32.4),
(127, 162, 'MALE', 13.9, 15.1, 25.3, 32.4, 32.5),
(128, 163, 'MALE', 14, 15.1, 25.4, 32.6, 32.7),
(129, 164, 'MALE', 14, 15.2, 25.5, 32.7, 32.8),
(130, 165, 'MALE', 14, 15.2, 25.6, 32.8, 32.9),
(131, 166, 'MALE', 14.1, 15.3, 25.7, 32.9, 33),
(132, 167, 'MALE', 14.1, 15.3, 25.8, 33, 33.1),
(133, 168, 'MALE', 14.2, 15.4, 25.9, 33.1, 33.2),
(134, 169, 'MALE', 14.2, 15.4, 26, 33.2, 33.3),
(135, 170, 'MALE', 14.2, 15.5, 26.1, 33.3, 33.4),
(136, 171, 'MALE', 14.3, 15.5, 26.2, 33.4, 33.5),
(137, 172, 'MALE', 14.3, 15.6, 26.3, 33.5, 33.6),
(138, 173, 'MALE', 14.4, 15.6, 26.4, 33.5, 33.6),
(139, 174, 'MALE', 14.4, 15.6, 26.5, 33.6, 33.7),
(140, 175, 'MALE', 14.4, 15.7, 26.5, 33.7, 33.8),
(141, 176, 'MALE', 14.5, 15.7, 26.6, 33.8, 33.9),
(142, 177, 'MALE', 14.5, 15.8, 26.7, 33.9, 34),
(143, 178, 'MALE', 14.5, 15.8, 26.8, 33.9, 34),
(144, 179, 'MALE', 14.6, 15.9, 26.9, 34, 34.1),
(145, 180, 'MALE', 14.6, 15.9, 27, 34.1, 34.2),
(146, 181, 'MALE', 14.6, 16, 27.1, 34.1, 34.2),
(147, 182, 'MALE', 14.7, 16, 27.1, 34.2, 34.3),
(148, 183, 'MALE', 14.7, 16, 27.2, 34.3, 34.4),
(149, 184, 'MALE', 14.7, 16.1, 27.3, 34.3, 34.4),
(150, 185, 'MALE', 14.8, 16.1, 27.4, 34.4, 34.5),
(151, 186, 'MALE', 14.8, 16.2, 27.4, 34.5, 34.6),
(152, 187, 'MALE', 14.9, 16.2, 27.5, 34.5, 34.6),
(153, 188, 'MALE', 14.9, 16.2, 27.6, 34.6, 34.7),
(154, 189, 'MALE', 14.9, 16.3, 27.7, 34.6, 34.7),
(155, 190, 'MALE', 14.9, 16.3, 27.7, 34.7, 34.8),
(156, 191, 'MALE', 15, 16.4, 27.8, 34.7, 34.8),
(157, 192, 'MALE', 15, 16.4, 27.9, 34.8, 34.9),
(158, 193, 'MALE', 15, 16.4, 27.9, 34.8, 34.9),
(159, 194, 'MALE', 15.1, 16.5, 28, 34.8, 34.9),
(160, 195, 'MALE', 15.1, 16.5, 28.1, 34.9, 35),
(161, 196, 'MALE', 15.1, 16.6, 28.1, 34.9, 35),
(162, 197, 'MALE', 15.2, 16.6, 28.2, 35, 35.1),
(163, 198, 'MALE', 15.2, 16.6, 28.3, 35, 35.1),
(164, 199, 'MALE', 15.2, 16.7, 28.3, 35, 35.1),
(165, 200, 'MALE', 15.2, 16.7, 28.4, 35.1, 35.2),
(166, 201, 'MALE', 15.3, 16.7, 28.5, 35.1, 35.2),
(167, 202, 'MALE', 15.3, 16.8, 28.5, 35.1, 35.2),
(168, 203, 'MALE', 15.3, 16.8, 28.6, 35.2, 35.3),
(169, 204, 'MALE', 15.3, 16.8, 28.6, 35.2, 35.3),
(170, 205, 'MALE', 15.4, 16.9, 28.7, 35.2, 35.3),
(171, 206, 'MALE', 15.4, 16.9, 28.7, 35.2, 35.3),
(172, 207, 'MALE', 15.4, 16.9, 28.8, 35.3, 35.4),
(173, 208, 'MALE', 15.4, 17, 28.9, 35.3, 35.4),
(174, 209, 'MALE', 15.5, 17, 28.9, 35.3, 35.4),
(175, 210, 'MALE', 15.5, 17, 29, 35.3, 35.4),
(176, 211, 'MALE', 15.5, 17, 29, 35.4, 35.5),
(177, 212, 'MALE', 15.5, 17.1, 29.1, 35.4, 35.5),
(178, 213, 'MALE', 15.5, 17.1, 29.1, 35.4, 35.5),
(179, 214, 'MALE', 15.6, 17.1, 29.2, 35.4, 35.5),
(180, 215, 'MALE', 15.6, 17.2, 29.2, 35.4, 35.5),
(181, 216, 'MALE', 15.6, 17.2, 29.2, 35.4, 35.5),
(182, 217, 'MALE', 15.6, 17.2, 29.3, 35.4, 35.5),
(183, 218, 'MALE', 15.6, 17.2, 29.3, 35.5, 35.6),
(184, 219, 'MALE', 15.6, 17.3, 29.4, 35.5, 35.6),
(185, 220, 'MALE', 15.7, 17.3, 29.4, 35.5, 35.6),
(186, 221, 'MALE', 15.7, 17.3, 29.5, 35.5, 35.6),
(187, 222, 'MALE', 15.7, 17.3, 29.5, 35.5, 35.6),
(188, 223, 'MALE', 15.7, 17.4, 29.5, 35.5, 35.6),
(189, 224, 'MALE', 15.7, 17.4, 29.6, 35.5, 35.6),
(190, 225, 'MALE', 15.7, 17.4, 29.6, 35.5, 35.6),
(191, 226, 'MALE', 15.7, 17.4, 29.6, 35.5, 35.6),
(192, 227, 'MALE', 15.7, 17.4, 29.7, 35.5, 35.6),
(193, 228, 'MALE', 15.8, 17.5, 29.7, 35.5, 35.6),
(194, 36, 'FEMALE', 9.6, 10.7, 18.1, 18.2, 18.3),
(195, 37, 'FEMALE', 9.7, 10.8, 18.4, 18.5, 18.6),
(196, 38, 'FEMALE', 9.8, 11, 18.7, 18.8, 18.9),
(197, 39, 'FEMALE', 9.9, 11.1, 19, 19.1, 19.2),
(198, 40, 'FEMALE', 10.1, 11.2, 19.2, 19.3, 19.4),
(199, 41, 'FEMALE', 10.2, 11.4, 19.5, 19.6, 19.7),
(200, 42, 'FEMALE', 10.3, 11.5, 19.8, 19.9, 20),
(201, 43, 'FEMALE', 10.4, 11.6, 20.1, 20.2, 20.3),
(202, 44, 'FEMALE', 10.5, 11.7, 20.4, 20.5, 20.6),
(203, 45, 'FEMALE', 10.6, 11.9, 20.7, 20.8, 20.9),
(204, 46, 'FEMALE', 10.7, 12, 20.9, 21, 21.1),
(205, 47, 'FEMALE', 10.8, 12.1, 21.2, 21.3, 21.4),
(206, 48, 'FEMALE', 10.9, 12.2, 21.5, 21.6, 21.7),
(207, 49, 'FEMALE', 11, 12.3, 21.8, 21.9, 22),
(208, 50, 'FEMALE', 11.1, 12.4, 22.1, 22.2, 22.3),
(209, 51, 'FEMALE', 11.2, 12.6, 22.4, 22.5, 22.6),
(210, 52, 'FEMALE', 11.3, 12.7, 22.6, 22.7, 22.8),
(211, 53, 'FEMALE', 11.4, 12.8, 22.9, 23, 23.1),
(212, 54, 'FEMALE', 11.5, 12.9, 23.2, 23.3, 23.4),
(213, 55, 'FEMALE', 11.6, 13.1, 23.5, 23.6, 23.7),
(214, 56, 'FEMALE', 11.7, 13.2, 23.8, 23.9, 24),
(215, 57, 'FEMALE', 11.8, 13.3, 24.1, 24.2, 24.3),
(216, 58, 'FEMALE', 11.9, 13.4, 24.4, 24.5, 24.6),
(217, 59, 'FEMALE', 12, 13.5, 24.6, 24.7, 24.8),
(218, 60, 'FEMALE', 12.1, 13.6, 24.7, 24.8, 24.9),
(219, 61, 'FEMALE', 12.4, 13.9, 24.8, 24.9, 25),
(220, 62, 'FEMALE', 12.5, 14, 25.1, 25.2, 25.3),
(221, 63, 'FEMALE', 12.6, 14.1, 25.4, 25.5, 25.6),
(222, 64, 'FEMALE', 12.7, 14.2, 25.6, 25.7, 25.8),
(223, 65, 'FEMALE', 12.8, 14.3, 25.9, 26, 26.1),
(224, 66, 'FEMALE', 12.9, 14.5, 26.2, 26.3, 26.4),
(225, 67, 'FEMALE', 13, 14.6, 26.5, 26.6, 26.7),
(226, 68, 'FEMALE', 13.1, 14.7, 26.7, 26.8, 26.9),
(227, 69, 'FEMALE', 13.2, 14.8, 27, 27.1, 27.2),
(228, 70, 'FEMALE', 13.3, 14.9, 27.3, 27.4, 27.5),
(229, 71, 'FEMALE', 13.4, 15.1, 27.6, 27.7, 27.8),
(230, 72, 'FEMALE', 11.6, 12.6, 19.2, 22.1, 22.2),
(231, 73, 'FEMALE', 11.6, 12.6, 19.3, 22.2, 22.3),
(232, 74, 'FEMALE', 11.6, 12.6, 19.3, 22.3, 22.4),
(233, 75, 'FEMALE', 11.6, 12.6, 19.3, 22.4, 22.5),
(234, 76, 'FEMALE', 11.6, 12.6, 19.4, 22.5, 22.6),
(235, 77, 'FEMALE', 11.6, 12.6, 19.4, 22.6, 22.7),
(236, 78, 'FEMALE', 11.6, 12.6, 19.5, 22.7, 22.8),
(237, 79, 'FEMALE', 11.6, 12.6, 19.5, 22.8, 22.9),
(238, 80, 'FEMALE', 11.6, 12.6, 19.6, 22.9, 23),
(239, 81, 'FEMALE', 11.6, 12.6, 19.6, 23, 23.1),
(240, 82, 'FEMALE', 11.6, 12.6, 19.7, 23.1, 23.2),
(241, 83, 'FEMALE', 11.6, 12.6, 19.7, 23.2, 23.3),
(242, 84, 'FEMALE', 11.7, 12.6, 19.8, 23.3, 23.4),
(243, 85, 'FEMALE', 11.7, 12.6, 19.8, 23.4, 23.5),
(244, 86, 'FEMALE', 11.7, 12.7, 19.9, 23.5, 23.6),
(245, 87, 'FEMALE', 11.7, 12.7, 20, 23.6, 23.7),
(246, 88, 'FEMALE', 11.7, 12.7, 20, 23.7, 23.8),
(247, 89, 'FEMALE', 11.7, 12.7, 20.1, 23.9, 24),
(248, 90, 'FEMALE', 11.7, 12.7, 20.1, 24, 24.1),
(249, 91, 'FEMALE', 11.7, 12.7, 20.2, 24.1, 24.2),
(250, 92, 'FEMALE', 11.7, 12.7, 20.3, 24.2, 24.3),
(251, 93, 'FEMALE', 11.7, 12.7, 20.3, 24.4, 24.5),
(252, 94, 'FEMALE', 11.8, 12.8, 20.4, 24.5, 24.6),
(253, 95, 'FEMALE', 11.8, 12.8, 20.5, 24.6, 24.7),
(254, 96, 'FEMALE', 11.8, 12.8, 20.6, 24.8, 24.9),
(255, 97, 'FEMALE', 11.8, 12.8, 20.6, 24.9, 25),
(256, 98, 'FEMALE', 11.8, 12.8, 20.7, 25.1, 25.2),
(257, 99, 'FEMALE', 11.8, 12.8, 20.8, 25.2, 25.3),
(258, 100, 'FEMALE', 11.8, 12.9, 20.9, 25.3, 25.4),
(259, 101, 'FEMALE', 11.9, 12.9, 20.9, 25.5, 25.6),
(260, 102, 'FEMALE', 11.9, 12.9, 21, 25.6, 25.7),
(261, 103, 'FEMALE', 11.9, 12.9, 21.1, 25.8, 25.9),
(262, 104, 'FEMALE', 11.9, 12.9, 21.2, 25.9, 26),
(263, 105, 'FEMALE', 11.9, 13, 21.3, 26.1, 26.2),
(264, 106, 'FEMALE', 12, 13, 21.3, 26.2, 26.3),
(265, 107, 'FEMALE', 12, 13, 21.4, 26.4, 26.5),
(266, 108, 'FEMALE', 12, 13, 21.5, 26.5, 26.6),
(267, 109, 'FEMALE', 12, 13.1, 21.6, 26.7, 26.8),
(268, 110, 'FEMALE', 12, 13.1, 21.7, 26.8, 26.9),
(269, 111, 'FEMALE', 12.1, 13.1, 21.8, 27, 27.1),
(270, 112, 'FEMALE', 12.1, 13.1, 21.9, 27.2, 27.3),
(271, 113, 'FEMALE', 12.1, 13.2, 21.9, 27.3, 27.4),
(272, 114, 'FEMALE', 12.1, 13.2, 22, 27.5, 27.6),
(273, 115, 'FEMALE', 12.2, 13.2, 22.1, 27.6, 27.7),
(274, 116, 'FEMALE', 12.2, 13.3, 22.2, 27.8, 27.9),
(275, 117, 'FEMALE', 12.2, 13.3, 22.3, 27.9, 28),
(276, 118, 'FEMALE', 12.2, 13.3, 22.4, 28.1, 28.2),
(277, 119, 'FEMALE', 12.3, 13.3, 22.5, 28.2, 28.3),
(278, 120, 'FEMALE', 12.3, 13.4, 22.6, 28.4, 28.5),
(279, 121, 'FEMALE', 12.3, 13.4, 22.7, 28.5, 28.6),
(280, 122, 'FEMALE', 12.3, 13.4, 22.8, 28.7, 28.8),
(281, 123, 'FEMALE', 12.4, 13.5, 22.8, 28.8, 28.9),
(282, 124, 'FEMALE', 12.4, 13.5, 22.9, 29, 29.1),
(283, 125, 'FEMALE', 12.4, 13.5, 23, 29.1, 29.2),
(284, 126, 'FEMALE', 12.4, 13.6, 23.1, 29.3, 29.4),
(285, 127, 'FEMALE', 12.5, 13.6, 23.2, 29.4, 29.5),
(286, 128, 'FEMALE', 12.5, 13.6, 23.3, 29.6, 29.7),
(287, 129, 'FEMALE', 12.5, 13.7, 23.4, 29.7, 29.8),
(288, 130, 'FEMALE', 12.6, 13.7, 23.5, 29.9, 30),
(289, 131, 'FEMALE', 12.6, 13.7, 23.6, 30, 30.1),
(290, 132, 'FEMALE', 12.6, 13.8, 23.7, 30.2, 30.3),
(291, 133, 'FEMALE', 12.7, 13.8, 23.8, 30.3, 30.4),
(292, 134, 'FEMALE', 12.7, 13.9, 23.9, 30.5, 30.6),
(293, 135, 'FEMALE', 12.7, 13.9, 24, 30.6, 30.7),
(294, 136, 'FEMALE', 12.8, 13.9, 24.1, 30.8, 30.9),
(295, 137, 'FEMALE', 12.8, 14, 24.2, 30.9, 31),
(296, 138, 'FEMALE', 12.8, 14, 24.3, 31.1, 31.2),
(297, 139, 'FEMALE', 12.9, 14.1, 24.4, 31.2, 31.3),
(298, 140, 'FEMALE', 12.9, 14.1, 24.5, 31.4, 31.5),
(299, 141, 'FEMALE', 12.9, 14.2, 24.7, 31.5, 31.6),
(300, 142, 'FEMALE', 13, 14.2, 24.8, 31.6, 31.7),
(301, 143, 'FEMALE', 13, 14.2, 24.9, 31.8, 31.9),
(302, 144, 'FEMALE', 13.1, 14.3, 25, 31.9, 32),
(303, 145, 'FEMALE', 13.1, 14.3, 25.1, 32, 32.1),
(304, 146, 'FEMALE', 13.1, 14.4, 25.2, 32.2, 32.3),
(305, 147, 'FEMALE', 13.2, 14.4, 25.3, 32.3, 32.4),
(306, 148, 'FEMALE', 13.2, 14.5, 25.4, 32.4, 32.5),
(307, 149, 'FEMALE', 13.2, 14.5, 25.5, 32.6, 32.7),
(308, 150, 'FEMALE', 13.3, 14.6, 25.6, 32.7, 32.8),
(309, 151, 'FEMALE', 13.3, 14.6, 25.7, 32.8, 32.9),
(310, 152, 'FEMALE', 13.4, 14.7, 25.8, 33, 33.1),
(311, 153, 'FEMALE', 13.4, 14.7, 25.9, 33.1, 33.2),
(312, 154, 'FEMALE', 13.4, 14.7, 26, 33.2, 33.3),
(313, 155, 'FEMALE', 13.5, 14.8, 26.1, 33.3, 33.4),
(314, 156, 'FEMALE', 13.5, 14.8, 26.2, 33.4, 33.5),
(315, 157, 'FEMALE', 13.5, 14.9, 26.3, 33.6, 33.7),
(316, 158, 'FEMALE', 13.6, 14.9, 26.4, 33.7, 33.8),
(317, 159, 'FEMALE', 13.6, 15, 26.5, 33.8, 33.9),
(318, 160, 'FEMALE', 13.7, 15, 26.6, 33.9, 34),
(319, 161, 'FEMALE', 13.7, 15.1, 26.7, 34, 34.1),
(320, 162, 'FEMALE', 13.7, 15.1, 26.8, 34.1, 34.2),
(321, 163, 'FEMALE', 13.8, 15.1, 26.9, 34.2, 34.3),
(322, 164, 'FEMALE', 13.8, 15.2, 27, 34.3, 34.4),
(323, 165, 'FEMALE', 13.8, 15.2, 27.1, 34.4, 34.5),
(324, 166, 'FEMALE', 13.9, 15.3, 27.1, 34.5, 34.6),
(325, 167, 'FEMALE', 13.9, 15.3, 27.2, 34.6, 34.7),
(326, 168, 'FEMALE', 13.9, 15.3, 27.3, 34.7, 34.8),
(327, 169, 'FEMALE', 14, 15.4, 27.4, 34.7, 34.8),
(328, 170, 'FEMALE', 14, 15.4, 27.5, 34.8, 34.9),
(329, 171, 'FEMALE', 14, 15.5, 27.6, 34.9, 35),
(330, 172, 'FEMALE', 14, 15.5, 27.7, 35, 35.1),
(331, 173, 'FEMALE', 14.1, 15.5, 27.7, 35.1, 35.2),
(332, 174, 'FEMALE', 14.1, 15.6, 27.8, 35.1, 35.2),
(333, 175, 'FEMALE', 14.1, 15.6, 27.9, 35.2, 35.3),
(334, 176, 'FEMALE', 14.2, 15.6, 28, 35.3, 35.4),
(335, 177, 'FEMALE', 14.2, 15.7, 28, 35.4, 35.5),
(336, 178, 'FEMALE', 14.2, 15.7, 28.1, 35.4, 35.5),
(337, 179, 'FEMALE', 14.2, 15.7, 28.2, 35.5, 35.6),
(338, 180, 'FEMALE', 14.3, 15.8, 28.2, 35.5, 35.6),
(339, 181, 'FEMALE', 14.3, 15.8, 28.3, 35.6, 35.7),
(340, 182, 'FEMALE', 14.3, 15.8, 28.4, 35.7, 35.8),
(341, 183, 'FEMALE', 14.3, 15.9, 28.4, 35.7, 35.8),
(342, 184, 'FEMALE', 14.4, 15.9, 28.5, 35.8, 35.9),
(343, 185, 'FEMALE', 14.4, 15.9, 28.5, 35.8, 35.9),
(344, 186, 'FEMALE', 14.4, 15.9, 28.6, 35.8, 35.9),
(345, 187, 'FEMALE', 14.4, 16, 28.6, 35.9, 36),
(346, 188, 'FEMALE', 14.4, 16, 28.7, 35.9, 36),
(347, 189, 'FEMALE', 14.4, 16, 28.7, 36, 36.1),
(348, 190, 'FEMALE', 14.5, 16, 28.8, 36, 36.1),
(349, 191, 'FEMALE', 14.5, 16.1, 28.8, 36, 36.1),
(350, 192, 'FEMALE', 14.5, 16.1, 28.9, 36.1, 36.2),
(351, 193, 'FEMALE', 14.5, 16.1, 28.9, 36.1, 36.2),
(352, 194, 'FEMALE', 14.5, 16.1, 29, 36.1, 36.2),
(353, 195, 'FEMALE', 14.5, 16.1, 29, 36.1, 36.2),
(354, 196, 'FEMALE', 14.5, 16.1, 29, 36.2, 36.3),
(355, 197, 'FEMALE', 14.5, 16.2, 29.1, 36.2, 36.3),
(356, 198, 'FEMALE', 14.6, 16.2, 29.1, 36.2, 36.3),
(357, 199, 'FEMALE', 14.6, 16.2, 29.1, 36.2, 36.3),
(358, 200, 'FEMALE', 14.6, 16.2, 29.2, 36.2, 36.3),
(359, 201, 'FEMALE', 14.6, 16.2, 29.2, 36.3, 36.4),
(360, 202, 'FEMALE', 14.6, 16.2, 29.2, 36.3, 36.4),
(361, 203, 'FEMALE', 14.6, 16.2, 29.3, 36.3, 36.4),
(362, 204, 'FEMALE', 14.6, 16.3, 29.3, 36.3, 36.4),
(363, 205, 'FEMALE', 14.6, 16.3, 29.3, 36.3, 36.4),
(364, 206, 'FEMALE', 14.6, 16.3, 29.3, 36.3, 36.4),
(365, 207, 'FEMALE', 14.6, 16.3, 29.4, 36.3, 36.4),
(366, 208, 'FEMALE', 14.6, 16.3, 29.4, 36.3, 36.4),
(367, 209, 'FEMALE', 14.6, 16.3, 29.4, 36.3, 36.4),
(368, 210, 'FEMALE', 14.6, 16.3, 29.4, 36.3, 36.4),
(369, 211, 'FEMALE', 14.6, 16.3, 29.4, 36.3, 36.4),
(370, 212, 'FEMALE', 14.6, 16.3, 29.5, 36.3, 36.4),
(371, 213, 'FEMALE', 14.6, 16.3, 29.5, 36.3, 36.4),
(372, 214, 'FEMALE', 14.6, 16.3, 29.5, 36.3, 36.4),
(373, 215, 'FEMALE', 14.6, 16.3, 29.5, 36.3, 36.4),
(374, 216, 'FEMALE', 14.6, 16.3, 29.5, 36.3, 36.4),
(375, 217, 'FEMALE', 14.6, 16.4, 29.5, 36.3, 36.4),
(376, 218, 'FEMALE', 14.6, 16.4, 29.6, 36.3, 36.4),
(377, 219, 'FEMALE', 14.6, 16.4, 29.6, 36.3, 36.4),
(378, 220, 'FEMALE', 14.6, 16.4, 29.6, 36.3, 36.4),
(379, 221, 'FEMALE', 14.6, 16.4, 29.6, 36.2, 36.3),
(380, 222, 'FEMALE', 14.6, 16.4, 29.6, 36.2, 36.3),
(381, 223, 'FEMALE', 14.6, 16.4, 29.6, 36.2, 36.3),
(382, 224, 'FEMALE', 14.6, 16.4, 29.6, 36.2, 36.3),
(383, 225, 'FEMALE', 14.6, 16.4, 29.6, 36.2, 36.3),
(384, 226, 'FEMALE', 14.6, 16.4, 29.6, 36.2, 36.3),
(385, 227, 'FEMALE', 14.6, 16.4, 29.7, 36.2, 36.3),
(386, 228, 'FEMALE', 14.6, 16.4, 29.7, 36.2, 36.3);

-- --------------------------------------------------------

--
-- Table structure for table `proposedsection`
--

DROP TABLE IF EXISTS `proposedsection`;
CREATE TABLE IF NOT EXISTS `proposedsection` (
  `prop_no` int(6) NOT NULL AUTO_INCREMENT,
  `prop_sy` int(4) NOT NULL,
  `prop_lrn` bigint(12) NOT NULL,
  `prop_section` varchar(15) NOT NULL,
  `reg_userno` int(6) NOT NULL,
  `reg_datetime` datetime NOT NULL,
  PRIMARY KEY (`prop_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `proposedsection`
--


-- --------------------------------------------------------

--
-- Table structure for table `prospectus`
--

DROP TABLE IF EXISTS `prospectus`;
CREATE TABLE IF NOT EXISTS `prospectus` (
  `pros_no` int(6) NOT NULL AUTO_INCREMENT,
  `pros_level` int(2) NOT NULL,
  `pros_track` varchar(25) NOT NULL,
  `pros_title` varchar(25) NOT NULL,
  `pros_desc` varchar(100) NOT NULL,
  `pros_cutoff` int(2) NOT NULL,
  `pros_prereq` varchar(50) NOT NULL,
  `pros_unit` double NOT NULL,
  `pros_hoursPerWk` int(2) NOT NULL,
  `pros_curr` int(4) NOT NULL,
  `pros_sem` int(2) NOT NULL,
  `pros_sort` int(2) NOT NULL,
  `pros_part` int(1) NOT NULL,
  PRIMARY KEY (`pros_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=353 ;

--
-- Dumping data for table `prospectus`
--

INSERT INTO `prospectus` (`pros_no`, `pros_level`, `pros_track`, `pros_title`, `pros_desc`, `pros_cutoff`, `pros_prereq`, `pros_unit`, `pros_hoursPerWk`, `pros_curr`, `pros_sem`, `pros_sort`, `pros_part`) VALUES
(1, 10, 'JHS GENERAL', 'FIL 10', 'FILIPINO 10', 75, 'FIL 9', 1, 4, 2012, 12, 1, 1),
(2, 10, 'JHS GENERAL', 'ENG 10', 'ENGLISH 10', 75, 'ENG 9', 1, 4, 2012, 12, 2, 1),
(3, 10, 'JHS GENERAL', 'MATH 10', 'MATHEMATICS 10', 75, 'MATH 9', 1, 4, 2012, 12, 3, 1),
(4, 10, 'JHS GENERAL', 'SCI 10', 'SCIENCE AND TECHNOLOGY 10', 75, 'SCI 9', 1, 4, 2012, 12, 4, 1),
(5, 10, 'JHS GENERAL', 'AP 10', 'ARALING PANLIPUNAN 10', 75, 'AP 9', 1, 4, 2012, 12, 5, 1),
(6, 10, 'JHS GENERAL', 'TLE 10', 'TECHNOLOGY AND LIVELIHOOD EDUCATION 10', 75, 'TLE 9', 1, 4, 2012, 12, 6, 1),
(7, 10, 'JHS GENERAL', 'MAPEH 10', 'MUSIC, ARTS, PHYSICAL EDUCATION, HEALTH 10', 75, 'MAPEH 9', 1, 4, 2012, 12, 7, 1),
(8, 10, 'JHS GENERAL', '*** MUSIC 10', '*** MUSIC 10', 75, '*** MUSIC 9', 0, 0, 2012, 12, 8, 1),
(9, 10, 'JHS GENERAL', '*** ARTS 10', '*** ARTS 10', 75, '*** ARTS 9', 0, 0, 2012, 12, 9, 1),
(10, 10, 'JHS GENERAL', '*** PE 10', '*** PHYSICAL EDUCATION 10', 75, '*** PE 9', 0, 0, 2012, 12, 10, 1),
(11, 10, 'JHS GENERAL', '*** HEALTH 10', '*** HEALTH 10', 75, '*** HEALTH 9', 0, 0, 2012, 12, 11, 1),
(12, 10, 'JHS GENERAL', 'EP 10', 'EDUKASYON SA PAGPAPAKATAO 10', 75, 'EP 9', 1, 2, 2012, 12, 12, 1),
(13, 9, 'JHS GENERAL', 'FIL 9', 'FILIPINO 9', 75, 'FIL 8', 1, 4, 2012, 12, 1, 1),
(14, 9, 'JHS GENERAL', 'ENG 9', 'ENGLISH 9', 75, 'ENG 8', 1, 4, 2012, 12, 2, 1),
(15, 9, 'JHS GENERAL', 'MATH 9', 'MATHEMATICS 9', 75, 'MATH 8', 1, 4, 2012, 12, 3, 1),
(16, 9, 'JHS GENERAL', 'SCI 9', 'SCIENCE AND TECHNOLOGY 9', 75, 'SCI 8', 1, 4, 2012, 12, 4, 1),
(17, 9, 'JHS GENERAL', 'AP 9', 'ARALING PANLIPUNAN 9', 75, 'AP 8', 1, 4, 2012, 12, 5, 1),
(18, 9, 'JHS GENERAL', 'TLE 9', 'TECHNOLOGY AND LIVELIHOOD EDUCATION 9', 75, 'TLE 8', 1, 4, 2012, 12, 6, 1),
(19, 9, 'JHS GENERAL', 'MAPEH 9', 'MUSIC, ARTS, PHYSICAL EDUCATION, HEALTH 9', 75, 'MAPEH 8', 1, 4, 2012, 12, 7, 1),
(20, 9, 'JHS GENERAL', '*** MUSIC 9', '*** MUSIC 9', 75, '*** MUSIC 8', 0, 0, 2012, 12, 8, 1),
(21, 9, 'JHS GENERAL', '*** ARTS 9', '*** ARTS 9', 75, '*** ARTS 8', 0, 0, 2012, 12, 9, 1),
(22, 9, 'JHS GENERAL', '*** PE 9', '*** PHYSICAL EDUCATION 9', 75, '*** PE 8', 0, 0, 2012, 12, 10, 1),
(23, 9, 'JHS GENERAL', '*** HEALTH 9', '*** HEALTH 9', 75, '*** HEALTH 8', 0, 0, 2012, 12, 11, 1),
(24, 9, 'JHS GENERAL', 'EP 9', 'EDUKASYON SA PAGPAPAKATAO 9', 75, 'EP 8', 1, 2, 2012, 12, 12, 1),
(25, 8, 'JHS GENERAL', 'FIL 8', 'FILIPINO 8', 75, 'FIL 7', 1, 4, 2012, 12, 1, 1),
(26, 8, 'JHS GENERAL', 'ENG 8', 'ENGLISH 8', 75, 'ENG 7', 1, 4, 2012, 12, 2, 1),
(27, 8, 'JHS GENERAL', 'MATH 8', 'MATHEMATICS 8', 75, 'MATH 7', 1, 4, 2012, 12, 3, 1),
(28, 8, 'JHS GENERAL', 'SCI 8', 'SCIENCE AND TECHNOLOGY 8', 75, 'SCI 7', 1, 4, 2012, 12, 4, 1),
(29, 8, 'JHS GENERAL', 'AP 8', 'ARALING PANLIPUNAN 8', 75, 'AP 7', 1, 4, 2012, 12, 5, 1),
(30, 8, 'JHS GENERAL', 'TLE 8', 'TECHNOLOGY AND LIVELIHOOD EDUCATION 8', 75, 'TLE 7', 1, 4, 2012, 12, 6, 1),
(31, 8, 'JHS GENERAL', 'MAPEH 8', 'MUSIC, ARTS, PHYSICAL EDUCATION, HEALTH 8', 75, 'MAPEH 7', 1, 4, 2012, 12, 7, 1),
(32, 8, 'JHS GENERAL', '*** MUSIC 8', '*** MUSIC 8', 75, '*** MUSIC 7', 0, 0, 2012, 12, 8, 1),
(33, 8, 'JHS GENERAL', '*** ARTS 8', '*** ARTS 8', 75, '*** ARTS 7', 0, 0, 2012, 12, 9, 1),
(34, 8, 'JHS GENERAL', '*** PE 8', '*** PHYSICAL EDUCATION 8', 75, '*** PE 7', 0, 0, 2012, 12, 10, 1),
(35, 8, 'JHS GENERAL', '*** HEALTH 8', '*** HEALTH 8', 75, '*** HEALTH 7', 0, 0, 2012, 12, 11, 1),
(36, 8, 'JHS GENERAL', 'EP 8', 'EDUKASYON SA PAGPAPAKATAO 8', 75, 'EP 7', 1, 2, 2012, 12, 12, 1),
(38, 7, 'JHS GENERAL', 'ENG 7', 'ENGLISH 7', 75, 'ELEM PROM', 1, 4, 2012, 12, 2, 1),
(39, 7, 'JHS GENERAL', 'MATH 7', 'MATHEMATICS 7', 75, 'ELEM PROM', 1, 4, 2012, 12, 3, 1),
(40, 7, 'JHS GENERAL', 'SCI 7', 'SCIENCE AND TECHNOLOGY 7', 75, 'ELEM PROM', 1, 4, 2012, 12, 4, 1),
(41, 7, 'JHS GENERAL', 'AP 7', 'ARALING PANLIPUNAN 7', 75, 'ELEM PROM', 1, 4, 2012, 12, 5, 1),
(42, 7, 'JHS GENERAL', 'TLE 7', 'TECHNOLOGY AND LIVELIHOOD EDUCATION 7', 75, 'ELEM PROM', 1, 4, 2012, 12, 6, 1),
(43, 7, 'JHS GENERAL', 'MAPEH 7', 'MUSIC, ARTS, PHYSICAL EDUCATION, HEALTH 7', 75, 'ELEM PROM', 1, 4, 2012, 12, 7, 1),
(44, 7, 'JHS GENERAL', '*** MUSIC 7', '*** MUSIC 7', 75, 'ELEM PROM', 0, 0, 2012, 12, 8, 1),
(45, 7, 'JHS GENERAL', '*** ARTS 7', '*** ARTS 7', 75, 'ELEM PROM', 0, 0, 2012, 12, 9, 1),
(46, 7, 'JHS GENERAL', '*** PE 7', '*** PHYSICAL EDUCATION 7', 75, 'ELEM PROM', 0, 0, 2012, 12, 10, 1),
(47, 7, 'JHS GENERAL', '*** HEALTH 7', '*** HEALTH 7', 75, 'ELEM PROM', 0, 0, 2012, 12, 11, 1),
(48, 7, 'JHS GENERAL', 'EP 7', 'EDUKASYON SA PAGPAPAKATAO 7', 75, 'ELEM PROM', 1, 2, 2012, 12, 12, 1),
(98, 7, 'JHS GENERAL', 'FIL 7', 'FILIPINO 7', 75, 'ELEM PROM', 1, 4, 2012, 12, 1, 1),
(99, 11, 'SHS GENERAL', 'ENG 101', 'Oral Communication in Context', 75, 'JHS PROM', 1, 4, 2012, 1, 1, 1),
(100, 11, 'SHS GENERAL', 'FIL 101', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino', 75, 'JHS PROM', 1, 4, 2012, 1, 2, 1),
(101, 11, 'SHS APPLIED', 'FIL 103', 'Pilipino sa Piling Larangan  (Tech-Voc / Academic)', 75, 'JHS PROM', 1, 4, 2012, 1, 7, 1),
(102, 11, 'SHS GENERAL', 'OJT 101', 'Immersion / Shop 1', 75, 'JHS PROM', 0, 4, 2012, 1, 6, 1),
(103, 11, 'SHS GENERAL', 'MATH 101', 'General Mathematics', 75, 'JHS PROM', 1, 4, 2012, 1, 3, 1),
(104, 11, 'SHS GENERAL', 'PE 101', 'Physical Education (20 Hrs.)', 75, 'JHS PROM', 0.25, 1, 2012, 1, 4, 1),
(105, 11, 'SHS GENERAL', 'SOC SCI 101', 'Personal Development / Pansariling Kaunlaran', 75, 'JHS PROM', 1, 4, 2012, 1, 5, 1),
(106, 11, 'SHS APPLIED', 'ENG 104', 'English for Academic and Professional Purposes', 75, 'JHS PROM', 1, 4, 2012, 1, 8, 1),
(107, 11, 'SHS-ACAD-GAS', 'GAS 101', 'Social Science 1: Community Engagement, Solidary and Citizenship', 75, 'JHS PROM', 1, 4, 2012, 1, 9, 1),
(108, 11, 'SHS-ACAD-GAS', 'GAS 102', 'Humanities 1: Creative Writing', 75, 'JHS PROM', 1, 4, 2012, 1, 10, 1),
(113, 11, 'SHS GENERAL', 'ENG 102', 'Reading and Writing Skills', 75, 'ENG 101', 1, 4, 2012, 2, 1, 1),
(114, 11, 'SHS GENERAL', 'ENG 103', '21st Century Literature from the Philippines and the World', 75, 'ENG 101', 1, 4, 2012, 2, 2, 1),
(119, 11, 'SHS GENERAL', 'FIL 102', 'Pagbasa at Pagsusuri ng Ibat-Ibang Teksto Tungo sa Pananaliksik', 75, 'FIL 101', 1, 4, 2012, 2, 3, 1),
(120, 11, 'SHS GENERAL', 'MATH 102', 'Statistics and Probability', 75, 'MATH 102', 1, 4, 2012, 2, 4, 1),
(121, 11, 'SHS GENERAL', 'PE 102', 'Physical Education (20 Hrs.)', 75, 'PE 101', 0.25, 1, 2012, 2, 5, 1),
(122, 11, 'SHS GENERAL', 'SOC SCI 102', 'Understanding Culture, Society and Politics', 75, 'SOC SCI 101', 1, 4, 2012, 2, 7, 1),
(123, 11, 'SHS GENERAL', 'OJT 102', 'Immersion / Shop 2', 75, 'OJT 101', 0, 4, 2012, 2, 6, 1),
(124, 11, 'SHS APPLIED', 'RES 101', 'Practical Research 1', 75, 'ENG 104', 1, 4, 2012, 2, 8, 1),
(125, 11, 'SHS-ACAD-GAS', 'GAS 103', 'Applied Economics', 75, 'JHS PROM', 1, 4, 2012, 2, 9, 1),
(130, 12, 'SHS GENERAL', 'ICT 203', 'Media and Information Literacy', 75, 'JHS PROM', 1, 4, 2012, 1, 1, 1),
(131, 12, 'SHS GENERAL', 'PE 201', 'Physical Education (20 Hrs.)', 75, 'PE 102', 0.25, 1, 2012, 1, 2, 1),
(132, 12, 'SHS GENERAL', 'SCI 201', 'Earth and Life Science', 75, 'JHS PROM', 1, 4, 2012, 1, 3, 1),
(133, 12, 'SHS GENERAL', 'SOC SCI 201', 'Introduction to the Philosophy of the Human Person', 75, 'JHS PROM', 1, 4, 2012, 1, 4, 1),
(134, 12, 'SHS GENERAL', 'SOC SCI 202', 'Contemporary Philippine Arts from the Regions', 75, 'JHS PROM', 1, 4, 2012, 2, 4, 1),
(135, 12, 'SHS GENERAL', 'OJT 201', 'Immersion / Shop 3', 75, 'OJT 102', 0, 4, 2012, 1, 5, 1),
(136, 12, 'SHS APPLIED', 'RES 201', 'Practical Research 2', 75, 'RESEARCH 101', 1, 4, 2012, 1, 7, 1),
(137, 12, 'SHS-ACAD-GAS', 'GAS 204', 'Organization and Management', 75, 'JHS PROM', 1, 4, 2012, 2, 8, 1),
(138, 12, 'SHS-ACAD-GAS', 'GAS 201', 'Elective 1: Fundamentals of Accountancy, Business and Management 1', 75, 'MATH 101', 1, 4, 2012, 1, 8, 1),
(142, 12, 'SHS GENERAL', 'PE 202', 'Physical Education (20 Hrs.)', 75, 'PE 201', 0.25, 1, 2012, 2, 1, 1),
(143, 12, 'SHS GENERAL', 'SCI 202', 'Physical Science', 75, 'SCI 201', 1, 4, 2012, 2, 2, 1),
(144, 12, 'SHS APPLIED', 'ENTREP 201', 'Entrepreneurship', 75, 'JHS PROM', 1, 4, 2012, 1, 6, 1),
(145, 12, 'SHS APPLIED', 'ICT 204', 'Empowerment Technologies (Tech-Voc / Academic)', 75, 'ICT 203', 1, 4, 2012, 2, 6, 1),
(146, 12, 'SHS GENERAL', 'OJT 202', 'Immersion / Shop 4', 75, 'OJT 201', 0, 4, 2012, 2, 3, 1),
(147, 12, 'SHS APPLIED', 'PROJ 201', 'Inquiries, Investigation And Immersion / Research Project/Culminating Activity* ', 75, 'RES 101, RES 201', 1, 4, 2012, 2, 7, 1),
(148, 12, 'SHS-ACAD-GAS', 'GAS 203', 'Elective 2: Fundamentals of Accountancy, Business and Management 2', 75, 'GAS 201', 1, 4, 2012, 2, 7, 1),
(149, 12, 'SHS-ACAD-GAS', 'GAS 202', 'Disaster Readiness and Risk Reduction', 75, 'JHS PROM', 1, 4, 2012, 1, 9, 1),
(157, 7, 'JHS GENERAL', 'FIL', 'Filipino', 75, '-', 1, 4, 1994, 12, 1, 1),
(158, 7, 'JHS GENERAL', 'ENG', 'English', 75, '-', 1, 4, 1994, 12, 2, 1),
(159, 7, 'JHS GENERAL', 'MATH', 'Mathematics', 75, '-', 1, 4, 1994, 12, 3, 1),
(160, 7, 'JHS GENERAL', 'SCI', 'Science', 75, '-', 2, 4, 1994, 12, 4, 1),
(161, 7, 'JHS GENERAL', '* ARAL PAN', '* Araling Panlipunan', 75, '-', 1, 4, 1994, 12, 6, 1),
(162, 7, 'JHS GENERAL', '* T.E.P.P.', '* T. E. P. P.', 75, '-', 1, 4, 1994, 12, 7, 1),
(163, 7, 'JHS GENERAL', '* RHGP', '* R H G P', 75, '-', 0.2, 4, 1994, 12, 9, 1),
(164, 7, 'JHS GENERAL', '* MSEP', '* Musika, Sining, Edukasyong Pangkalusugan', 75, '-', 1, 4, 1994, 12, 8, 1),
(165, 7, 'JHS GENERAL', '* EP', '* Edukasyon sa Pagpapakatao', 75, '-', 1, 4, 1994, 12, 10, 1),
(166, 7, 'JHS GENERAL', 'REL ED', 'Religious Education', 75, '-', 0, 4, 1994, 12, 12, 1),
(167, 7, 'JHS GENERAL', 'COMP ED', 'Computer', 75, '-', 1, 4, 1994, 12, 10, 1),
(168, 8, 'JHS GENERAL', 'FIL', 'Filipino', 75, '-', 1, 4, 1994, 12, 1, 1),
(169, 8, 'JHS GENERAL', 'ENG', 'English', 75, '-', 1, 4, 1994, 12, 2, 1),
(170, 8, 'JHS GENERAL', 'MATH', 'Mathematics', 75, '-', 1, 4, 1994, 12, 3, 1),
(171, 8, 'JHS GENERAL', 'SCI', 'Science', 75, '-', 2, 4, 1994, 12, 4, 1),
(172, 8, 'JHS GENERAL', '* ARAL PAN', '* Araling Panlipunan', 75, '-', 1, 4, 1994, 12, 6, 1),
(173, 8, 'JHS GENERAL', '* T.E.P.P.', '* T. E. P. P.', 75, '-', 1, 4, 1994, 12, 7, 1),
(174, 8, 'JHS GENERAL', '* RHGP', '* R H G P', 75, '-', 0.2, 4, 1994, 12, 10, 1),
(175, 8, 'JHS GENERAL', '* MSEP', '* Musika, Sining, Edukasyong Pangkalusugan', 75, '-', 1, 4, 1994, 12, 8, 1),
(176, 8, 'JHS GENERAL', '* EP', '* Edukasyon sa Pagpapakatao', 75, '-', 1, 4, 1994, 12, 11, 1),
(177, 8, 'JHS GENERAL', 'REL ED', 'Religious Education', 75, '-', 0, 4, 1994, 12, 11, 1),
(178, 8, 'JHS GENERAL', 'COMP ED', 'Computer', 75, '-', 1, 4, 1994, 12, 11, 1),
(179, 9, 'JHS GENERAL', 'FIL', 'Filipino', 75, '-', 1.2, 4, 1994, 12, 1, 1),
(180, 9, 'JHS GENERAL', 'ENG', 'English', 75, '-', 1.5, 4, 1994, 12, 2, 1),
(181, 9, 'JHS GENERAL', 'MATH', 'Mathematics', 75, '-', 1.5, 4, 1994, 12, 3, 1),
(182, 9, 'JHS GENERAL', 'SCI', 'Science', 75, '-', 1.8, 4, 1994, 12, 4, 1),
(183, 9, 'JHS GENERAL', '* ARAL PAN', '* Araling Panlipunan', 75, '-', 1.2, 4, 1994, 12, 6, 1),
(184, 9, 'JHS GENERAL', '* TLE', '* Technology and Livelihood Education', 75, '-', 1.2, 4, 1994, 12, 7, 1),
(185, 9, 'JHS GENERAL', '* MAPEH', '* Music, Arts, Physical Education & Health', 75, '-', 1.2, 4, 1994, 12, 8, 1),
(186, 9, 'JHS GENERAL', '* EP', '* Edukasyon sa Pagpapakatao', 75, '-', 0.9, 4, 1994, 12, 9, 1),
(187, 10, 'JHS GENERAL', 'FIL', 'Filipino', 75, '-', 1.2, 4, 1994, 12, 1, 1),
(188, 10, 'JHS GENERAL', 'ENG', 'English', 75, '-', 1.5, 4, 1994, 12, 2, 1),
(189, 10, 'JHS GENERAL', 'MATH', 'Mathematics', 75, '-', 1.5, 4, 1994, 12, 3, 1),
(190, 10, 'JHS GENERAL', 'SCI', 'Science', 75, '-', 1.8, 4, 1994, 12, 4, 1),
(191, 10, 'JHS GENERAL', '* ARAL PAN', '* Araling Panlipunan', 75, '-', 1.2, 4, 1994, 12, 6, 1),
(192, 10, 'JHS GENERAL', '* TLE', '* Technology and Livelihood Education', 75, '-', 1.2, 4, 1994, 12, 7, 1),
(193, 10, 'JHS GENERAL', '* MAPEH', '* Music, Arts, Physical Education & Health', 75, '-', 1.5, 4, 1994, 12, 8, 1),
(194, 10, 'JHS GENERAL', '* EP', '* Edukasyon sa Pagpapakatao', 75, '-', 0.6, 4, 1994, 12, 9, 1),
(195, 10, 'JHS GENERAL', 'COMP ED', 'Computer', 75, '-', 0, 4, 1994, 12, 10, 1),
(196, 10, 'JHS GENERAL', 'CAT', 'Citizens Army Training', 75, '-', 0, 4, 1994, 12, 11, 1),
(197, 7, 'JHS GENERAL', 'MAKABAYAN', 'MAKABAYAN', 75, '-', 0, 4, 1994, 12, 5, 1),
(198, 8, 'JHS GENERAL', 'MAKABAYAN', 'MAKABAYAN', 75, '-', 0, 4, 1994, 12, 5, 1),
(199, 9, 'JHS GENERAL', 'MAKABAYAN', 'MAKABAYAN', 75, '-', 0, 4, 1994, 12, 5, 1),
(200, 10, 'JHS GENERAL', 'MAKABAYAN', 'MAKABAYAN', 75, '-', 0, 4, 1994, 12, 5, 1),
(201, 7, 'JHS GENERAL', 'FIL', 'Filipino', 75, '-', 1.2, 4, 2002, 12, 1, 1),
(202, 7, 'JHS GENERAL', 'FIL', 'Filipino', 75, '-', 1.2, 4, 1994, 12, 13, 1),
(203, 7, 'JHS GENERAL', 'ENG', 'English', 75, '-', 1.5, 4, 1994, 12, 14, 1),
(204, 7, 'JHS GENERAL', 'MATH', 'Mathematics', 75, '-', 1.5, 4, 1994, 12, 15, 1),
(205, 7, 'JHS GENERAL', 'SCI', 'Science', 75, '-', 1.8, 4, 1994, 12, 16, 1),
(206, 7, 'JHS GENERAL', 'MAKABAYAN', 'MAKABAYAN', 75, '-', 0, 4, 1994, 12, 17, 1),
(207, 7, 'JHS GENERAL', '* AP', '* Araling Panlipunan', 75, '-', 1.2, 4, 1994, 12, 18, 1),
(208, 7, 'JHS GENERAL', '* TLE', '* Technology and Livelihood Education', 75, '-', 1.2, 4, 1994, 12, 19, 1),
(209, 7, 'JHS GENERAL', '* MAPEH', '* Music, Arts, Physical Education & Health', 75, '-', 1.2, 4, 1994, 12, 20, 1),
(210, 7, 'JHS GENERAL', '* EP', '* Edukasyon sa Pagpapakatao', 75, '-', 0.3, 4, 1994, 12, 21, 1),
(211, 8, 'JHS GENERAL', 'FIL', 'Filipino', 75, '-', 1.2, 4, 1994, 12, 13, 1),
(212, 8, 'JHS GENERAL', 'ENG', 'English', 75, '-', 1.5, 4, 1994, 12, 14, 1),
(213, 8, 'JHS GENERAL', 'MATH', 'Mathematics', 75, '-', 1.5, 4, 1994, 12, 15, 1),
(214, 8, 'JHS GENERAL', 'SCI', 'Science', 75, '-', 1.8, 4, 1994, 12, 16, 1),
(215, 8, 'JHS GENERAL', 'MAKABAYAN', 'MAKABAYAN', 75, '-', 0, 4, 1994, 12, 17, 1),
(216, 8, 'JHS GENERAL', '* AP', '* Araling Panlipunan', 75, '-', 1.2, 4, 1994, 12, 18, 1),
(217, 8, 'JHS GENERAL', '* TLE', '* Technology and Livelihood Education', 75, '-', 1.2, 4, 1994, 12, 19, 1),
(218, 8, 'JHS GENERAL', '* MAPEH', '* Music, Arts, Physical Education & Health', 75, '-', 1.2, 4, 1994, 12, 20, 1),
(219, 8, 'JHS GENERAL', '* EP', '* Edukasyon sa Pagpapakatao', 75, '-', 0.6, 4, 1994, 12, 21, 1),
(220, 9, 'JHS GENERAL', 'COMP ED', 'Computer', 75, '-', 0, 4, 1994, 12, 10, 1),
(244, 7, 'JHS GENERAL', 'ICF 7', 'COMPUTER', 75, 'ELEM PROM', 0.6, 4, 1994, 12, 22, 1),
(245, 7, 'JHS GENERAL', 'TLE 7', '* Technology And Livelihood Education', 75, 'ELEM PROM', 0.6, 4, 1994, 12, 23, 1),
(247, 8, 'JHS GENERAL', 'ICF 7', 'COMPUTER', 75, 'ELEM PROM', 0.6, 4, 1994, 12, 22, 1),
(248, 8, 'JHS GENERAL', 'TLE 7', '* Technology And Livelihood Education', 75, 'ELEM PROM', 0.6, 4, 1994, 12, 23, 1),
(271, 11, 'SHS-ACAD-GAS', 'GAS 104', 'Humanities 1: Creative Non-Fiction', 75, 'JHS PROM', 1, 4, 2012, 2, 10, 1),
(272, 12, 'SHS-ACAD-GAS', 'WRK IMM', 'Work Immersion', 75, '320 SPECIALIZATION HRS.', 1, 4, 2012, 2, 9, 1),
(275, 1, 'ES GENERAL', 'MTB 1', 'Mother Tongue Based 1', 75, 'K PROM', 1, 5, 2012, 12, 1, 1),
(276, 1, 'ES GENERAL', 'FIL 1', 'Filipino 1', 75, 'K PROM', 1, 5, 2012, 12, 2, 1),
(277, 1, 'ES GENERAL', 'ENG 1', 'English 1', 75, 'K PROM', 1, 5, 2012, 12, 3, 1),
(278, 1, 'ES GENERAL', 'MATH 1', 'Mathematics 1', 75, 'K PROM', 1, 5, 2012, 12, 4, 1),
(279, 1, 'ES GENERAL', 'SCI 1', 'Science 1', 75, 'K PROM', 1, 5, 2012, 12, 5, 1),
(280, 1, 'ES GENERAL', 'AP 1', 'Araling Panlipunan 1', 75, 'K PROM', 1, 5, 2012, 12, 6, 1),
(281, 1, 'ES GENERAL', 'EPP 1', 'Edukasyong Pantahanan at Pangkabuhayan 1', 75, 'K PROM', 1, 5, 2012, 12, 7, 1),
(282, 1, 'ES GENERAL', 'MAPEH 1', 'Music, Arts, Physical Education, Health 1', 75, 'K PROM', 1, 5, 2012, 12, 8, 1),
(283, 1, 'ES GENERAL', '*** MUSIC 1', '*** Music 1', 75, 'K PROM', 0, 0, 2012, 12, 9, 1),
(284, 1, 'ES GENERAL', '*** ARTS 1', '*** Arts 1', 75, 'K PROM', 0, 0, 2012, 12, 10, 1),
(285, 1, 'ES GENERAL', '*** PE 1', '*** Physical Education 1', 75, 'K PROM', 0, 0, 2012, 12, 11, 1),
(286, 1, 'ES GENERAL', '*** HEALTH 1', '*** Health 1', 75, 'K PROM', 0, 0, 2012, 12, 12, 1),
(287, 1, 'ES GENERAL', 'EP 1', 'Edukasyon Sa Pagpapakatao 1', 75, 'K PROM', 1, 5, 2012, 12, 13, 1),
(288, 2, 'ES GENERAL', 'MTB 2', 'Mother Tongue Based 2', 75, 'MTB 1', 1, 5, 2012, 12, 1, 1),
(289, 2, 'ES GENERAL', 'FIL 2', 'Filipino 2', 75, 'FIL 1', 1, 5, 2012, 12, 2, 1),
(290, 2, 'ES GENERAL', 'ENG 2', 'English 2', 75, 'ENG 1', 1, 5, 2012, 12, 3, 1),
(291, 2, 'ES GENERAL', 'MATH 2', 'Mathematics 2', 75, 'MATH 1', 1, 5, 2012, 12, 4, 1),
(292, 2, 'ES GENERAL', 'SCI 2', 'Science 2', 75, 'SCI 1', 1, 5, 2012, 12, 5, 1),
(293, 2, 'ES GENERAL', 'AP 2', 'Araling Panlipunan 2', 75, 'AP 1', 1, 5, 2012, 12, 6, 1),
(294, 2, 'ES GENERAL', 'EPP 2', 'Edukasyong Pantahanan at Pangkabuhayan 2', 75, 'EPP 1', 1, 5, 2012, 12, 7, 1),
(295, 2, 'ES GENERAL', 'MAPEH 2', 'Music, Arts, Physical Education, Health 2', 75, 'MAPEH 1', 1, 5, 2012, 12, 8, 1),
(296, 2, 'ES GENERAL', '*** MUSIC 2', '*** Music 2', 75, '*** MUSIC 1', 0, 0, 2012, 12, 9, 1),
(297, 2, 'ES GENERAL', '*** ARTS 2', '*** Arts 2', 75, '*** ARTS 1', 0, 0, 2012, 12, 10, 1),
(298, 2, 'ES GENERAL', '*** PE 2', '*** Physical Education 2', 75, '*** PE 1', 0, 0, 2012, 12, 11, 1),
(299, 2, 'ES GENERAL', '*** HEALTH 2', '*** Health 2', 75, '*** HEALTH 1', 0, 0, 2012, 12, 12, 1),
(300, 2, 'ES GENERAL', 'EP 2', 'Edukasyon Sa Pagpapakatao 2', 75, 'EP 1', 1, 5, 2012, 12, 13, 1),
(301, 3, 'ES GENERAL', 'MTB 3', 'Mother Tongue Based 3', 75, 'MTB 2', 1, 5, 2012, 12, 1, 1),
(302, 3, 'ES GENERAL', 'FIL 3', 'Filipino 3', 75, 'FIL 2', 1, 5, 2012, 12, 2, 1),
(303, 3, 'ES GENERAL', 'ENG 3', 'English 3', 75, 'ENG 2', 1, 5, 2012, 12, 3, 1),
(304, 3, 'ES GENERAL', 'MATH 3', 'Mathematics 3', 75, 'MATH 2', 1, 5, 2012, 12, 4, 1),
(305, 3, 'ES GENERAL', 'SCI 3', 'Science 3', 75, 'SCI 2', 1, 5, 2012, 12, 5, 1),
(306, 3, 'ES GENERAL', 'AP 3', 'Araling Panlipunan 3', 75, 'AP 2', 1, 5, 2012, 12, 6, 1),
(307, 3, 'ES GENERAL', 'EPP 3', 'Edukasyong Pantahanan at Pangkabuhayan 3', 75, 'EPP 2', 1, 5, 2012, 12, 7, 1),
(308, 3, 'ES GENERAL', 'MAPEH 3', 'Music, Arts, Physical Education, Health 3', 75, 'MAPEH 2', 1, 5, 2012, 12, 8, 1),
(309, 3, 'ES GENERAL', '*** MUSIC 3', '*** Music 3', 75, '*** MUSIC 2', 0, 0, 2012, 12, 9, 1),
(310, 3, 'ES GENERAL', '*** ARTS 3', '*** Arts 3', 75, '*** ARTS 2', 0, 0, 2012, 12, 10, 1),
(311, 3, 'ES GENERAL', '*** PE 3', '*** Physical Education 3', 75, '*** PE 2', 0, 0, 2012, 12, 11, 1),
(312, 3, 'ES GENERAL', '*** HEALTH 3', '*** Health 3', 75, '*** HEALTH 2', 0, 0, 2012, 12, 12, 1),
(313, 3, 'ES GENERAL', 'EP 3', 'Edukasyon Sa Pagpapakatao 3', 75, 'EP 2', 1, 5, 2012, 12, 13, 1),
(314, 4, 'ES GENERAL', 'MTB 4', 'Mother Tongue Based 4', 75, 'MTB 3', 1, 5, 2012, 12, 1, 1),
(315, 4, 'ES GENERAL', 'FIL 4', 'Filipino 4', 75, 'FIL 3', 1, 5, 2012, 12, 2, 1),
(316, 4, 'ES GENERAL', 'ENG 4', 'English 4', 75, 'ENG 3', 1, 5, 2012, 12, 3, 1),
(317, 4, 'ES GENERAL', 'MATH 4', 'Mathematics 4', 75, 'MATH 3', 1, 5, 2012, 12, 4, 1),
(318, 4, 'ES GENERAL', 'SCI 4', 'Science 4', 75, 'SCI 3', 1, 5, 2012, 12, 5, 1),
(319, 4, 'ES GENERAL', 'AP 4', 'Araling Panlipunan 4', 75, 'AP 3', 1, 5, 2012, 12, 6, 1),
(320, 4, 'ES GENERAL', 'EPP 4', 'Edukasyong Pantahanan at Pangkabuhayan 4', 75, 'EPP 3', 1, 5, 2012, 12, 7, 1),
(321, 4, 'ES GENERAL', 'MAPEH 4', 'Music, Arts, Physical Education, Health 4', 75, 'MAPEH 3', 1, 5, 2012, 12, 8, 1),
(322, 4, 'ES GENERAL', '*** MUSIC 4', '*** Music 4', 75, '*** MUSIC 3', 0, 0, 2012, 12, 9, 1),
(323, 4, 'ES GENERAL', '*** ARTS 4', '*** Arts 4', 75, '*** ARTS 3', 0, 0, 2012, 12, 10, 1),
(324, 4, 'ES GENERAL', '*** PE 4', '*** Physical Education 4', 75, '*** PE 3', 0, 0, 2012, 12, 11, 1),
(325, 4, 'ES GENERAL', '*** HEALTH 4', '*** Health 4', 75, '*** HEALTH 3', 0, 0, 2012, 12, 12, 1),
(326, 4, 'ES GENERAL', 'EP 4', 'Edukasyon Sa Pagpapakatao 4', 75, 'EP 3', 1, 5, 2012, 12, 13, 1),
(327, 5, 'ES GENERAL', 'MTB 5', 'Mother Tongue Based 5', 75, 'MTB 4', 1, 5, 2012, 12, 1, 1),
(328, 5, 'ES GENERAL', 'FIL 5', 'Filipino 5', 75, 'FIL 4', 1, 5, 2012, 12, 2, 1),
(329, 5, 'ES GENERAL', 'ENG 5', 'English 5', 75, 'ENG 4', 1, 5, 2012, 12, 3, 1),
(330, 5, 'ES GENERAL', 'MATH 5', 'Mathematics 5', 75, 'MATH 4', 1, 5, 2012, 12, 4, 1),
(331, 5, 'ES GENERAL', 'SCI 5', 'Science 5', 75, 'SCI 4', 1, 5, 2012, 12, 5, 1),
(332, 5, 'ES GENERAL', 'AP 5', 'Araling Panlipunan 5', 75, 'AP 4', 1, 5, 2012, 12, 6, 1),
(333, 5, 'ES GENERAL', 'EPP 5', 'Edukasyong Pantahanan at Pangkabuhayan 5', 75, 'EPP 4', 1, 5, 2012, 12, 7, 1),
(334, 5, 'ES GENERAL', 'MAPEH 5', 'Music, Arts, Physical Education, Health 5', 75, 'MAPEH 4', 1, 5, 2012, 12, 8, 1),
(335, 5, 'ES GENERAL', '*** MUSIC 5', '*** Music 5', 75, '*** MUSIC 4', 0, 0, 2012, 12, 9, 1),
(336, 5, 'ES GENERAL', '*** ARTS 5', '*** Arts 5', 75, '*** ARTS 4', 0, 0, 2012, 12, 10, 1),
(337, 5, 'ES GENERAL', '*** PE 5', '*** Physical Education 5', 75, '*** PE 4', 0, 0, 2012, 12, 11, 1),
(338, 5, 'ES GENERAL', '*** HEALTH 5', '*** Health 5', 75, '*** HEALTH 4', 0, 0, 2012, 12, 12, 1),
(339, 5, 'ES GENERAL', 'EP 5', 'Edukasyon Sa Pagpapakatao 5', 75, 'EP 4', 1, 5, 2012, 12, 13, 1),
(340, 6, 'ES GENERAL', 'MTB 6', 'Mother Tongue Based 6', 75, 'MTB 5', 1, 5, 2012, 12, 1, 1),
(341, 6, 'ES GENERAL', 'FIL 6', 'Filipino 6', 75, 'FIL 5', 1, 5, 2012, 12, 2, 1),
(342, 6, 'ES GENERAL', 'ENG 6', 'English 6', 75, 'ENG 5', 1, 5, 2012, 12, 3, 1),
(343, 6, 'ES GENERAL', 'MATH 6', 'Mathematics 6', 75, 'MATH 5', 1, 5, 2012, 12, 4, 1),
(344, 6, 'ES GENERAL', 'SCI 6', 'Science 6', 75, 'SCI 5', 1, 5, 2012, 12, 5, 1),
(345, 6, 'ES GENERAL', 'AP 6', 'Araling Panlipunan 6', 75, 'AP 5', 1, 5, 2012, 12, 6, 1),
(346, 6, 'ES GENERAL', 'EPP 6', 'Edukasyong Pantahanan at Pangkabuhayan 6', 75, 'EPP 5', 1, 5, 2012, 12, 7, 1),
(347, 6, 'ES GENERAL', 'MAPEH 6', 'Music, Arts, Physical Education, Health 6', 75, 'MAPEH 5', 1, 5, 2012, 12, 8, 1),
(348, 6, 'ES GENERAL', '*** MUSIC 6', '*** Music 6', 75, '*** MUSIC 5', 0, 0, 2012, 12, 9, 1),
(349, 6, 'ES GENERAL', '*** ARTS 6', '*** Arts 6', 75, '*** ARTS 5', 0, 0, 2012, 12, 10, 1),
(350, 6, 'ES GENERAL', '*** PE 6', '*** Physical Education 6', 75, '*** PE 5', 0, 0, 2012, 12, 11, 1),
(351, 6, 'ES GENERAL', '*** HEALTH 6', '*** Health 6', 75, '*** HEALTH 5', 0, 0, 2012, 12, 12, 1),
(352, 6, 'ES GENERAL', 'EP 6', 'Edukasyon Sa Pagpapakatao 6', 75, 'EP 5', 1, 5, 2012, 12, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `rooms_no` int(6) NOT NULL AUTO_INCREMENT,
  `rooms_name` varchar(25) NOT NULL,
  `rooms_cap` int(2) NOT NULL,
  PRIMARY KEY (`rooms_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rooms`
--


-- --------------------------------------------------------

--
-- Table structure for table `school_days`
--

DROP TABLE IF EXISTS `school_days`;
CREATE TABLE IF NOT EXISTS `school_days` (
  `sch_no` int(6) NOT NULL AUTO_INCREMENT,
  `sch_sy` int(4) NOT NULL,
  `sch_stud_no` int(6) NOT NULL,
  `sch_firstday` date NOT NULL,
  `sch_m1` double NOT NULL,
  `sch_m2` double NOT NULL,
  `sch_m3` double NOT NULL,
  `sch_m4` double NOT NULL,
  `sch_m5` double NOT NULL,
  `sch_m6` double NOT NULL,
  `sch_m7` double NOT NULL,
  `sch_m8` double NOT NULL,
  `sch_m9` double NOT NULL,
  `sch_m10` double NOT NULL,
  `sch_m11` double NOT NULL,
  `sch_m12` double NOT NULL,
  PRIMARY KEY (`sch_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `school_days`
--


-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_no` int(2) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(15) NOT NULL,
  `section_sy` int(4) NOT NULL,
  `section_level` int(2) NOT NULL,
  `section_track` varchar(100) NOT NULL,
  `section_cap` int(2) NOT NULL,
  `section_adviser` varchar(20) NOT NULL,
  PRIMARY KEY (`section_no`),
  KEY `section_name` (`section_name`),
  KEY `section_sy` (`section_sy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `section`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `settings_no` int(4) NOT NULL AUTO_INCREMENT,
  `settings_sy` int(4) NOT NULL,
  `settings_sem` int(1) NOT NULL,
  `settings_month` varchar(10) NOT NULL,
  `settings_pros` int(4) NOT NULL,
  `settings_registrar` varchar(50) NOT NULL,
  `settings_principal` varchar(50) NOT NULL,
  `settings_supervisor` varchar(100) NOT NULL,
  `settings_representative` varchar(50) NOT NULL,
  `settings_superintendent` varchar(50) NOT NULL,
  `settings_bosy` date NOT NULL,
  `settings_eosy` date NOT NULL,
  `settings_late1` date NOT NULL,
  `settings_late2` date NOT NULL,
  `settings_closing` date NOT NULL,
  `settings_earlyreg` tinyint(1) NOT NULL,
  `settings_eosynow` tinyint(1) NOT NULL,
  `settings_loginmessage` text NOT NULL,
  `settings_admissionmessage` text NOT NULL,
  `activated` int(1) NOT NULL,
  PRIMARY KEY (`settings_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_no`, `settings_sy`, `settings_sem`, `settings_month`, `settings_pros`, `settings_registrar`, `settings_principal`, `settings_supervisor`, `settings_representative`, `settings_superintendent`, `settings_bosy`, `settings_eosy`, `settings_late1`, `settings_late2`, `settings_closing`, `settings_earlyreg`, `settings_eosynow`, `settings_loginmessage`, `settings_admissionmessage`, `activated`) VALUES
(1, 2018, 1, 'sch_m1', 2012, 'SCHOOL REGISTRAR', 'SCHOOL PRINCIPAL', 'SUPERVISOR', 'REPRESENTATIVE', 'SUPERINTENDENT', '2018-06-05', '2019-03-31', '2018-06-08', '2018-11-09', '2019-03-31', 0, 0, 'Test Welcome Message!', 'Test Admission Message.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studcontacts`
--

DROP TABLE IF EXISTS `studcontacts`;
CREATE TABLE IF NOT EXISTS `studcontacts` (
  `studCont_no` int(6) NOT NULL AUTO_INCREMENT,
  `studCont_stud_no` int(6) NOT NULL,
  `studCont_stud_glname` varchar(25) DEFAULT NULL,
  `studCont_stud_gfname` varchar(25) DEFAULT NULL,
  `studCont_stud_gmname` varchar(25) DEFAULT NULL,
  `studCont_stud_grelation` varchar(25) DEFAULT NULL,
  `studCont_stud_gcontact` varchar(12) DEFAULT NULL,
  `studCont_stud_flname` varchar(25) DEFAULT NULL,
  `studCont_stud_ffname` varchar(25) DEFAULT NULL,
  `studCont_stud_fmname` varchar(25) DEFAULT NULL,
  `studCont_stud_mlname` varchar(25) DEFAULT NULL,
  `studCont_stud_mfname` varchar(25) DEFAULT NULL,
  `studCont_stud_mmname` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`studCont_no`),
  KEY `studCont_stud_no` (`studCont_stud_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='student table' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `studcontacts`
--


-- --------------------------------------------------------

--
-- Table structure for table `studenroll`
--

DROP TABLE IF EXISTS `studenroll`;
CREATE TABLE IF NOT EXISTS `studenroll` (
  `enrol_no` int(6) NOT NULL AUTO_INCREMENT,
  `enrol_stud_no` int(6) NOT NULL,
  `enrol_sy` double NOT NULL,
  `enrol_school` text NOT NULL,
  `enrol_level` int(2) NOT NULL,
  `enrol_section` varchar(15) DEFAULT NULL,
  `enrol_height` double DEFAULT NULL,
  `enrol_weight` double DEFAULT NULL,
  `enrol_status1` varchar(15) DEFAULT NULL,
  `enrol_status2` varchar(15) DEFAULT NULL,
  `enrol_ti` int(1) NOT NULL,
  `enrol_remarks` text,
  `enrol_track` varchar(100) NOT NULL,
  `enrol_strand` varchar(100) NOT NULL,
  `enrol_combo` varchar(100) NOT NULL,
  `enrol_average` double DEFAULT NULL,
  `enrol_eligibility` varchar(100) NOT NULL,
  `enrol_graddate` date NOT NULL,
  `enrol_admitdate` datetime NOT NULL,
  `enrol_admitdate2` datetime NOT NULL,
  `enrol_gradawards` varchar(200) NOT NULL,
  `enrol_username` int(6) NOT NULL,
  `enrol_updatedate` datetime NOT NULL,
  `enrol_schoolyears` double NOT NULL,
  PRIMARY KEY (`enrol_no`),
  KEY `enrol_sy` (`enrol_sy`),
  KEY `enrol_level` (`enrol_level`),
  KEY `enrol_status1` (`enrol_status1`),
  KEY `enrol_status2` (`enrol_status2`),
  KEY `enrol_admitdate` (`enrol_admitdate`),
  KEY `enrol_admitdate2` (`enrol_admitdate2`),
  KEY `enrol_graddate` (`enrol_graddate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `studenroll`
--


-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `stud_no` int(6) NOT NULL AUTO_INCREMENT,
  `stud_lrn` bigint(12) NOT NULL,
  `stud_lname` varchar(25) NOT NULL,
  `stud_fname` varchar(25) NOT NULL,
  `stud_mname` varchar(25) DEFAULT NULL,
  `stud_xname` varchar(25) NOT NULL,
  `stud_gender` varchar(10) NOT NULL,
  `stud_bdate` date NOT NULL,
  `stud_residence` varchar(75) NOT NULL,
  `stud_religion` varchar(25) DEFAULT NULL,
  `stud_dialect` varchar(25) DEFAULT NULL,
  `stud_ethnicity` varchar(25) DEFAULT NULL,
  `stud_cct` varchar(10) NOT NULL,
  `stud_username` varchar(10) NOT NULL,
  `stud_password` varchar(50) NOT NULL,
  `stud_create_user_id` int(6) NOT NULL,
  `stud_creaatedatetime` datetime NOT NULL,
  `stud_lastmod_user_id` int(6) NOT NULL,
  `stud_lastmoddatetime` datetime NOT NULL,
  `stud_status` int(1) NOT NULL DEFAULT '1',
  `stud_credentials` text NOT NULL,
  PRIMARY KEY (`stud_no`),
  UNIQUE KEY `stud_no` (`stud_no`),
  FULLTEXT KEY `stud_cct` (`stud_cct`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='student table' AUTO_INCREMENT=200007 ;

--
-- Dumping data for table `student`
--


-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teach_no` int(6) NOT NULL AUTO_INCREMENT,
  `teach_id` int(7) NOT NULL,
  `teach_lname` varchar(25) NOT NULL,
  `teach_fname` varchar(25) NOT NULL,
  `teach_mname` varchar(25) DEFAULT NULL,
  `teach_xname` varchar(25) DEFAULT NULL,
  `teach_gender` varchar(10) NOT NULL,
  `teach_bdate` date NOT NULL,
  `teach_residence` varchar(75) NOT NULL,
  `teach_tin` varchar(25) DEFAULT NULL,
  `teach_dialect` varchar(25) DEFAULT NULL,
  `teach_ethnicity` varchar(100) DEFAULT NULL,
  `teach_cstatus` varchar(10) NOT NULL,
  `teach_create_user_no` int(6) NOT NULL,
  `teach_cretedatetime` datetime NOT NULL,
  `teach_lastmod_user_no` int(6) NOT NULL,
  `teach_lastmoddatetime` datetime NOT NULL,
  `teach_status` int(1) NOT NULL,
  `teach_teacher` int(1) NOT NULL,
  `teach_bio_no` int(6) NOT NULL,
  PRIMARY KEY (`teach_no`),
  UNIQUE KEY `teach_no` (`teach_no`),
  FULLTEXT KEY `teach_cstatus` (`teach_cstatus`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='teacher table' AUTO_INCREMENT=100008 ;

--
-- Dumping data for table `teacher`
--


-- --------------------------------------------------------

--
-- Table structure for table `teacherappointments`
--

DROP TABLE IF EXISTS `teacherappointments`;
CREATE TABLE IF NOT EXISTS `teacherappointments` (
  `teacherappointments_no` int(6) NOT NULL AUTO_INCREMENT,
  `teacherappointments_teach_no` int(7) NOT NULL,
  `teacherappointments_item_no` varchar(50) NOT NULL,
  `teacherappointments_position` varchar(50) NOT NULL,
  `teacherappointments_date` date NOT NULL,
  `teacherappointments_status` varchar(20) NOT NULL,
  `teacherappointments_funding` varchar(10) NOT NULL,
  `teacherappointments_active` int(1) NOT NULL,
  PRIMARY KEY (`teacherappointments_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `teacherappointments`
--


-- --------------------------------------------------------

--
-- Table structure for table `teachercontacts`
--

DROP TABLE IF EXISTS `teachercontacts`;
CREATE TABLE IF NOT EXISTS `teachercontacts` (
  `teachCont_no` int(6) NOT NULL AUTO_INCREMENT,
  `teachCont_teach_no` int(6) NOT NULL,
  `teachCont_type` int(1) NOT NULL,
  `teachCont_fname` varchar(50) NOT NULL,
  `teachCont_mname` varchar(50) NOT NULL,
  `teachCont_lname` varchar(50) NOT NULL,
  `teachCont_xname` varchar(50) NOT NULL,
  `teachCont_bdate` date NOT NULL,
  `teachCont_position` varchar(50) NOT NULL,
  `teachCont_office` varchar(100) NOT NULL,
  `teachCont_offadd` varchar(100) NOT NULL,
  `teachCont_offcont` varchar(10) NOT NULL,
  `teachCont_govid` varchar(50) NOT NULL,
  `teachCont_idno` varchar(20) NOT NULL,
  `teachCont_issuedate` date NOT NULL,
  `teachCont_moduser` int(6) NOT NULL,
  `teachCont_moddatetime` datetime NOT NULL,
  PRIMARY KEY (`teachCont_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `teachercontacts`
--


-- --------------------------------------------------------

--
-- Table structure for table `teacherids`
--

DROP TABLE IF EXISTS `teacherids`;
CREATE TABLE IF NOT EXISTS `teacherids` (
  `teacherids_no` int(6) NOT NULL AUTO_INCREMENT,
  `teacherids_teach_no` int(7) NOT NULL,
  `teacherids_id` varchar(15) NOT NULL,
  `teacherids_details` varchar(15) NOT NULL,
  `teacherids_date_issued` date NOT NULL,
  `teacherids_place_issued` varchar(50) NOT NULL,
  PRIMARY KEY (`teacherids_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `teacherids`
--


-- --------------------------------------------------------

--
-- Table structure for table `teacher_ebackground`
--

DROP TABLE IF EXISTS `teacher_ebackground`;
CREATE TABLE IF NOT EXISTS `teacher_ebackground` (
  `eback_no` int(6) NOT NULL AUTO_INCREMENT,
  `eback_teach_no` int(6) NOT NULL,
  `eback_level` varchar(25) NOT NULL,
  `eback_degree` varchar(100) NOT NULL,
  `eback_major` varchar(50) NOT NULL,
  `eback_minor` varchar(50) NOT NULL,
  `eback_units` int(3) NOT NULL,
  PRIMARY KEY (`eback_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `teacher_ebackground`
--


-- --------------------------------------------------------

--
-- Table structure for table `teachsaln`
--

DROP TABLE IF EXISTS `teachsaln`;
CREATE TABLE IF NOT EXISTS `teachsaln` (
  `teachSaln_no` int(6) NOT NULL AUTO_INCREMENT,
  `teachSaln_teach_no` int(6) NOT NULL,
  `teachSaln_filetype` int(1) NOT NULL,
  `teachSaln_issueyear` int(4) NOT NULL,
  `teachSaln_networth` double NOT NULL,
  `teachSaln_status` int(1) NOT NULL,
  `teachSaln_reguser` int(6) NOT NULL,
  `teachSaln_regdatetime` datetime NOT NULL,
  `teachSaln_moduser` int(6) NOT NULL,
  `teachSaln_moddatetime` datetime NOT NULL,
  PRIMARY KEY (`teachSaln_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `teachsaln`
--


-- --------------------------------------------------------

--
-- Table structure for table `teachsalndetails`
--

DROP TABLE IF EXISTS `teachsalndetails`;
CREATE TABLE IF NOT EXISTS `teachsalndetails` (
  `teachSalnDet_no` int(6) NOT NULL AUTO_INCREMENT,
  `teachSalnDet_teachSaln_no` int(6) NOT NULL,
  `teachSalnDet_type` int(1) NOT NULL,
  `teachSalnDet_details` text NOT NULL,
  `teachSalnDet_cost` double NOT NULL,
  PRIMARY KEY (`teachSalnDet_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `teachsalndetails`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_no` int(7) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_role` int(1) NOT NULL,
  `user_status` int(1) NOT NULL,
  PRIMARY KEY (`user_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=200004 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_name`, `user_pass`, `user_fullname`, `user_role`, `user_status`) VALUES
(1, 'sanhs.admin', '94d823efa06ea503d1174ffdbe7a4b26', 'SYSTEM ADMINISTRATOR', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vs_candidate`
--

DROP TABLE IF EXISTS `vs_candidate`;
CREATE TABLE IF NOT EXISTS `vs_candidate` (
  `cand_no` int(6) NOT NULL AUTO_INCREMENT,
  `cand_stud_no` int(6) NOT NULL,
  `cand_pos_no` int(6) NOT NULL,
  `cand_party` varchar(10) NOT NULL,
  `cand_regdatetime` datetime NOT NULL,
  `cand_reguser_no` int(6) NOT NULL,
  `cand_reg_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`cand_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vs_candidate`
--


-- --------------------------------------------------------

--
-- Table structure for table `vs_position`
--

DROP TABLE IF EXISTS `vs_position`;
CREATE TABLE IF NOT EXISTS `vs_position` (
  `pos_no` int(6) NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(50) NOT NULL,
  `pos_dept` int(2) NOT NULL,
  `pos_sort` int(2) NOT NULL,
  PRIMARY KEY (`pos_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `vs_position`
--

INSERT INTO `vs_position` (`pos_no`, `pos_name`, `pos_dept`, `pos_sort`) VALUES
(1, 'President', 0, 1),
(2, 'Vice - President', 0, 2),
(3, 'Senator', 0, 3),
(4, 'Representative G7', 7, 4),
(5, 'Representative G8', 8, 5),
(6, 'Representative G9', 9, 6),
(7, 'Representative G10', 10, 7),
(8, 'Representative G11', 11, 8),
(9, 'Representative G12', 12, 9);

-- --------------------------------------------------------

--
-- Table structure for table `vs_registrant`
--

DROP TABLE IF EXISTS `vs_registrant`;
CREATE TABLE IF NOT EXISTS `vs_registrant` (
  `reg_no` int(5) NOT NULL AUTO_INCREMENT,
  `reg_stud_no` int(6) NOT NULL,
  `reg_passcode` varchar(10) NOT NULL,
  `reg_status` int(1) NOT NULL DEFAULT '1',
  `reg_regdatetime` datetime NOT NULL,
  `reg_reguser_no` int(6) NOT NULL,
  `reg_reg_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`reg_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vs_registrant`
--


-- --------------------------------------------------------

--
-- Table structure for table `vs_user`
--

DROP TABLE IF EXISTS `vs_user`;
CREATE TABLE IF NOT EXISTS `vs_user` (
  `user_no` int(6) NOT NULL AUTO_INCREMENT,
  `user_stud_no` varchar(10) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_accesslevel` int(1) NOT NULL,
  `user_status` int(1) NOT NULL,
  `user_regdatetime` datetime NOT NULL,
  `user_reguser_no` int(6) NOT NULL,
  `user_reg_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`user_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `vs_user`
--

INSERT INTO `vs_user` (`user_no`, `user_stud_no`, `user_password`, `user_accesslevel`, `user_status`, `user_regdatetime`, `user_reguser_no`, `user_reg_ip`) VALUES
(1, '123456', 'c44061ad61ab5cd9091364e1c3be487f', 1, 1, '2017-02-27 22:08:59', 123456, '192.168.1.162');

-- --------------------------------------------------------

--
-- Table structure for table `vs_vote`
--

DROP TABLE IF EXISTS `vs_vote`;
CREATE TABLE IF NOT EXISTS `vs_vote` (
  `vote_no` int(6) NOT NULL AUTO_INCREMENT,
  `vote_stud_no` int(6) NOT NULL,
  `vote_cand_no` int(6) NOT NULL,
  `vote_pos_no` int(6) NOT NULL,
  `vote_regdatetime` datetime NOT NULL,
  `vote_reg_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`vote_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vs_vote`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
