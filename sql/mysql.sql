#
# Table structure for table `ncplayer_list`
#
CREATE TABLE `ncplayer_list` (
`id` 		INT( 5 ) NOT NULL AUTO_INCREMENT ,
`url`     	TEXT NOT NULL ,
`uid`     	INT( 5 ) NOT NULL ,
`name`     	VARCHAR( 200 ) NOT NULL ,
`dtime` 	VARCHAR( 50 ) NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE=MyISAM ;

