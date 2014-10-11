CREATE TABLE IF NOT EXISTS `wordpress_rating_post` (
`id_rating_post` int(11) NOT NULL AUTO_INCREMENT,
`numero_post` smallint(6) NOT NULL,
`ip_user` varchar(16) NOT NULL,
`val_rating` tinyint(4) NOT NULL,
`timestamp_rating` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id_rating_post`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;