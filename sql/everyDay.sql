/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 5.6.26 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `everyDay` (
	`id` int (11),
	`dayWork` varchar (765),
	`dayTime` int (11),
	`lifeTimeStart` timestamp ,
	`lifeTimeEnd` timestamp ,
	`status` tinyint (4),
	`comment` varchar (765)
); 
