CREATE TABLE IF NOT EXISTS `#__present` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`product_id` int(11) NOT NULL ,
	`title` text NOT NULL,
	`description` text NOT NULL,
	`file` text NOT NULL,
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`publish_down` date NOT NULL default '0000-00-00',

  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;