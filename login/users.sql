CREATE TABLE `users` (
`id` int(4) NOT NULL auto_increment,
`username` varchar(65) NOT NULL default '',
`password` varchar(65) NOT NULL default '',
PRIMARY KEY (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES (1, 'attacker', '3f858cf8cfd59f25010e71b6b5671428');
INSERT INTO `users` VALUES (2, 'victim', '96d4976b516a16ac19d148f3b744eee1');
