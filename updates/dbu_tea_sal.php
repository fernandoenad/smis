<?php
require('../maincore.php');

$creatTable=dbquery("CREATE TABLE IF NOT EXISTS `teachsaln` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

$creatTable1=dbquery("CREATE TABLE IF NOT EXISTS `teachsalndetails` (
  `teachSalnDet_no` int(6) NOT NULL AUTO_INCREMENT,
  `teachSalnDet_teachSaln_no` int(6) NOT NULL,
  `teachSalnDet_type` int(1) NOT NULL,
  `teachSalnDet_details` text NOT NULL,
  `teachSalnDet_cost` double NOT NULL,
  PRIMARY KEY (`teachSalnDet_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

header("Location: ".$_SERVER['HTTP_REFERER']);
?>
