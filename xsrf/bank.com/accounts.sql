-- Table structure for table `account`
CREATE TABLE IF NOT EXISTS `account` (
  `victim` int(11) NOT NULL,
  `attacker` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 
-- Dumping data for table `account`
INSERT INTO `account` (`victim`, `attacker`) VALUES
(10000, 500);