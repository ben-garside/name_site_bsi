CREATE TABLE `suggestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `user` varchar(45) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `clean` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
