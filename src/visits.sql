DROP TABLE IF EXISTS `visits_logger`.`visits`;
CREATE TABLE  `visits_logger`.`visits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) NOT NULL,
  `pagenumber` int(10) unsigned NOT NULL,
  `pagetype` varchar(45) NOT NULL,
  `order` int(10) unsigned DEFAULT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;