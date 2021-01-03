<?php
require('../maincore.php');

$creatTable=dbquery("CREATE TABLE IF NOT EXISTS `teachercontacts` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

header("Location: ".$_SERVER['HTTP_REFERER']);
?>
