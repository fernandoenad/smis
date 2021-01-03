<?php
require('../maincore.php');

$creatTable=dbquery("CREATE TABLE IF NOT EXISTS `student_corevalues` (
  `coreval_no` int(6) NOT NULL AUTO_INCREMENT,
  `coreval_stud_no` int(6) NOT NULL,
  `coreval_enrol_sy` int(4) NOT NULL,
  `coreval_q1` text NOT NULL,
  `coreval_q2` text NOT NULL,
  `coreval_q3` text NOT NULL,
  `coreval_q4` text NOT NULL,
  `coreval_q5` text NOT NULL,
  `coreval_q6` text NOT NULL,
  `coreval_q7` text NOT NULL,
  PRIMARY KEY (`coreval_no`),
  KEY `coreval_stud_no` (`coreval_stud_no`,`coreval_enrol_sy`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

header("Location: ".$_SERVER['HTTP_REFERER']);
?>
