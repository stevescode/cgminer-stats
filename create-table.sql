/* SQL SCRIPT FOR TABLE CREATION
 * This can be run directly in phpmyadmin
*/

CREATE TABLE IF NOT EXISTS `mining_stats` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `thetime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `temp` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fan` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `shares` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `theload` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rate` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)