-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2014 at 05:08 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `autoresto`
--
CREATE DATABASE IF NOT EXISTS `autoresto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `autoresto`;

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `name` varchar(256) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `ic_no` char(20) NOT NULL,
  `contact_no` char(10) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(256) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`name`, `email`, `ic_no`, `contact_no`, `active`, `password`, `isAdmin`) VALUES
('admin', 'admin@gmail.com', 'admin', '12345678', 1, '529ca8050a00180790cf88b63468826a', 1),
('Rieka Erina', 'rieka.erina@hotmail.com', 'F0213539Q', '82465297', 1, '529ca8050a00180790cf88b63468826a', 0),
('David Oktavianus', 'david@gmail.com', 'F2634644N', '35773598', 1, '529ca8050a00180790cf88b63468826a', 0),
('Rosalia Jeo', 'rosa@hotmail.com', 'F2838730W', '72872874', 1, '529ca8050a00180790cf88b63468826a', 0),
('Yosika Yogiaman', 'yosika@hotmail.com', 'F3480625W', '824782746', 1, '529ca8050a00180790cf88b63468826a', 0),
('Jonathan Irvin Gunawan', 'jonathanirvings@gmail.com', 'F4007730T', '28464269', 1, '529ca8050a00180790cf88b63468826a', 0),
('Steven Kester Yuwono', 'steven.kester.yuwono@gmail.com', 'F7214348P', '82462468', 1, '529ca8050a00180790cf88b63468826a', 0),
('Meong', 'meong@hotmail.com', 'G0762141N', '32847288', 1, '529ca8050a00180790cf88b63468826a', 0),
('Sharon Lynn', 'sharon.lynn@gmail.com', 'G5525876M', '82462698', 1, '529ca8050a00180790cf88b63468826a', 0),
('Mister Hehe', 'mister.hehe@hotmail.com', 'G9277718P', '24862466', 1, '529ca8050a00180790cf88b63468826a', 0),
('Alvin Tanudjaja', 'alvin.tanudjaja@ymail.com', 'S0109361D', '28477262', 1, '529ca8050a00180790cf88b63468826a', 0),
('Nathania Christy', 'nathania.christy@gmail.com', 'S1324269J', '84724727', 1, '529ca8050a00180790cf88b63468826a', 0),
('Jonathan Darryl Widjaja', 'jondar@gmail.com', 'S1391845G', '23874262', 1, '529ca8050a00180790cf88b63468826a', 0),
('Hisyam Nursaid Indrakesuma', 'hisyam@gmail.com', 'S1699316F', '74762947', 1, '529ca8050a00180790cf88b63468826a', 0),
('Mark Rustandy Hutagaol', 'mark@gmail.com', 'S2482119F', '82477278', 1, '529ca8050a00180790cf88b63468826a', 0),
('James Djuhartono', 'james.djuhartono@gmail.com', 'S3364567H', '23246713', 1, '529ca8050a00180790cf88b63468826a', 0),
('Heheness Ultimate', 'heheness.ultimate@gmail.com', 'S3844652E', '12342553', 1, '529ca8050a00180790cf88b63468826a', 0),
('Tiffany Wijaya', 'tiffany.wijaya@gmail.com', 'S4504697D', '12348877', 1, '529ca8050a00180790cf88b63468826a', 0),
('Rais Fathin', 'rais.fathin@hotmail.com', 'S4745311I', '24728460', 1, '529ca8050a00180790cf88b63468826a', 0),
('Steven Han', 'steven.han@gmail.com', 'S4788881F', '72382134', 1, '529ca8050a00180790cf88b63468826a', 0),
('Fenny Fong', 'fenny.fong@gmail.com', 'S5425511Z', '24877419', 1, '529ca8050a00180790cf88b63468826a', 0),
('Michael L Tanny', 'michael.l.tanny@hotmail.com', 'S5691320C', '28462477', 1, '529ca8050a00180790cf88b63468826a', 0),
('Tjong Anthony', 'tjong.anthony@gmail.com', 'S5796647E', '27472971', 1, '529ca8050a00180790cf88b63468826a', 0),
('Lantip', 'lantip@gmail.com', 'S6416512G', '28947284', 1, '529ca8050a00180790cf88b63468826a', 0),
('Efrata Puji Harsono', 'efrata.tata@gmail.com', 'S7220672Z', '27469178', 1, '529ca8050a00180790cf88b63468826a', 0),
('Stefano Chiesa', 'stefano.chiesa@hotmail.com', 'S7424464E', '34885992', 1, '529ca8050a00180790cf88b63468826a', 0),
('Gregorius Ivaniddo', 'iddo@ymail.com', 'S9179887E', '82468274', 1, '529ca8050a00180790cf88b63468826a', 0),
('Jonathan Steven', 'jonathan.steven@gmail.com', 'S9225467D', '28467672', 1, '529ca8050a00180790cf88b63468826a', 0),
('Gadis', 'gadis@hotmail.com', 'S9328705C', '82478246', 1, '529ca8050a00180790cf88b63468826a', 0),
('Steven Nilam', 'steven.nilam@gmail.com', 'T1247251F', '28477147', 1, '529ca8050a00180790cf88b63468826a', 0),
('Raynaldo Adeputra', 'ray@gmail.com', 'T9530513F', '87246693', 1, '529ca8050a00180790cf88b63468826a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurant_name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `contact_no` char(10) NOT NULL,
  `cuisine` char(255) DEFAULT NULL,
  `total1seaters` int(11) NOT NULL DEFAULT '0',
  `total2seaters` int(11) NOT NULL DEFAULT '0',
  `total4seaters` int(11) NOT NULL DEFAULT '0',
  `open` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`contact_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_name`, `address`, `contact_no`, `cuisine`, `total1seaters`, `total2seaters`, `total4seaters`, `open`) VALUES
('Becasse', 'Dempsey Hill, Block 10 #01-21, 237700 Singapore', '4798119', 'European', 20, 20, 20, 1),
('Restaurant Burlamacoo Ristorante', '77 Amoy Street, 069896 Singapore', '62201763', 'Italian', 0, 18, 36, 1),
('SQUE Rotisserie & Alehouse', '6 Eu Tong Sen Street #01-70 The Central', '62221887', 'European', 30, 20, 34, 0),
('Alba 1836', '28 Duxton Hill 089610', '62222048', 'Italian', 0, 2, 4, 0),
('Absinthe', '72 Boat Quay, 049860 Singapore', '62229068', 'French', 10, 56, 90, 1),
('Buyan Russian Restaurant and Caviar Bar', '9/10 Duxton Hill, 089593 Singapore', '62237008', 'Russian', 10, 12, 34, 1),
('Napoleon Cake from Flor Patisserie', '2 Duxton Hill #01-01 Singapore', '62238628', 'Dessert', 10, 10, 15, 1),
('Wild Honey Singapore', '333A Orchard Road #03-02 Mandarin Gallery Singapore', '62353900', 'Asian', 10, 12, 40, 1),
('Sun Moulin Bakery', '350 Orchard Road Basement 1 Isetan Scotts', '62356093', 'Belgian', 10, 0, 0, 1),
('Skinny Pizza', '501 Orchard Road #03-04 Wheelock Place Singapore', '62357823', 'Italian', 5, 11, 3, 1),
('Plaisir Sucre from Laurent Bernard Chocolatier', '80 Mohamed Sultan Road #01-11 The Pier @ Robertson Singapore', '62359007', 'Dessert', 10, 10, 20, 1),
('Chocolate Cake from Max Brenner', '8 Raffles Avenue #01-06/08 Esplanade Mall', '62359556', 'Dessert', 10, 12, 20, 1),
('Fatboy''s Burger Bar', '187 Upper Thomson Road', '62528780', 'Western', 5, 5, 5, 1),
('Tanjong Beach Club', '120 Tanjong Beach Walk Tanjong Beach Club Sentosa', '62701355', 'French', 10, 2, 2, 1),
('Portico Singapore', '991 B Alexandra Road, #01-10/11, 119970 Singapore', '62767337', 'Italian', 14, 26, 40, 1),
('Antoinette', '30 Penhas Road', '62933121', 'Asian', 5, 10, 15, 1),
('7 Sensations', '16 Madras Street 187953', '62988198', 'Vegetarian', 10, 6, 10, 0),
('Suprette', '383 Jalan Besar Kam Leng Hotel', '62988962', 'Western', 6, 10, 10, 1),
('Strictly Pancakes', '44A Prinsep Street Singapore', '63334202', 'Western', 4, 4, 4, 1),
('Supply and Demand', '#01-13 Esplanade Mall 8 Raffles Avenue', '63360588', 'French', 5, 5, 5, 1),
('Fern & Kiwi Bar and Eatery', '2C River Valley Road, #01-02/03 The Cannery Clarke Quay, 179024 Singapore', '63362271', 'New Zealand', 30, 15, 45, 1),
('Timbre', '1 Old Parliament Lane #01-04', '63363386', 'Italian', 20, 10, 0, 1),
('Artichoke Cafe', '161 Middle Road', '63366949', 'Dessert', 0, 9, 9, 1),
('Royal China Restaurant', '1 Beach Road #03-09 Raffles Hotel', '63383363', 'Asian', 10, 10, 10, 1),
('Chocolate Amer from Bakerzin', '3 Temasek Boulevard #B1-016 Suntec City Mall', '63384656', 'Dessert', 7, 8, 9, 1),
('Chef D''Table', '#01-29 Chijmes 30 Victoria Street 187996', '63384898', 'French', 0, 6, 10, 1),
('Chiffon Cake from Tampopo Deli', '177 River Valley road #B1-16 Liang Court', '63387386', 'Dessert', 10, 12, 15, 1),
('Food For Thought Cafe', '8 Queen Street', '63389887', 'Western', 5, 5, 5, 1),
('Morton''s The Steakhouse Bar', '5 Raffles Avenue 4F Mandarin Oriental Singapore', '63393740', 'Western', 20, 25, 40, 1),
('The Cliff', '2 Bukit Manis Road Sentosa, 099891 Singapore', '63711425', 'European', 20, 39, 47, 1),
('Ciel Patisserie', '124 Hougang Ave 1 #01-1444', '63830803', 'Belgian', 5, 6, 9, 1),
('Strawberry Souffle from Patisserie Glace', '12 Gopeng Street #01-33/34 ICON Village Singapore', '64000247', 'Dessert', 20, 20, 20, 1),
('Mezza9 Deli', '10 Scotts Road 2F Grand Hyatt', '64167189', 'Belgian', 4, 7, 8, 1),
('OverEasy One Fullerton', '1 Fullerton Road #01-06 One Fullerton', '64230701', 'Western', 6, 6, 12, 1),
('Golden Peony', 'Two Temasek Boulevard', '64327482', 'Cantonese', 30, 29, 74, 0),
('Stellar at 1-Altitude', '1 Raffles Place, 048616 Singapore', '64380410', 'Combination', 12, 30, 60, 1),
('Bakerzin', '1 Harbourfront Walk #01-207 VivoCity', '64388700', 'Belgian', 0, 8, 12, 1),
('Djanoer Koening', '191 Joo Chiat Road 427462', '64400774', 'Indonesian', 0, 2, 4, 1),
('Habitat Coffee', '223 Upper Thomson Road', '64562567', 'French', 2, 5, 8, 1),
('Brazil Churrascaria', '14/16 Sixth Avenue 276476', '64631923', 'Brazilian', 0, 6, 10, 1),
('Feedlot Steakhouse', '#B1-01, 56 Tanglin Road', '64638080', 'French', 0, 4, 10, 1),
('Pepperoni Pizzeria', '6 Greenwood Avenue Hillcrest Park Singapore', '64656556', 'Italian', 4, 3, 3, 1),
('Dancing Crab', 'The Grandstand #01-20/21 200 Turf Club Road', '64663303', 'French', 4, 2, 6, 1),
('Little Diner', '789 Bukit Timah Road, 269763 Singapore', '64664088', 'Irish', 0, 30, 30, 0),
('Riders Cafe', '51 Fairways Drive Bukit Timah Saddle Club', '64669819', 'Western', 10, 20, 20, 1),
('Casa Verde', '1 Cluny road Singapore Botanic Gardens', '64677326', 'Italian', 6, 5, 6, 1),
('The Coastal Settlement', '200 Netheravon Road (Near Changi Village)', '64750200', 'French', 6, 2, 5, 1),
('Barracks Cafe House Dempsey', '8D Dempsey Road #01-01 to 06 Tanglin Village', '64757787', 'Western', 9, 9, 9, 1),
('Roadhouse Restaurant', '13 Dempsey Road #01-07', '64762922', 'Western', 3, 10, 15, 1),
('Yan Ting', '29 Tanglin Road, 247911 Singapore', '65066887', 'Chinese', 23, 24, 40, 1),
('Zafferano Restaurant, Bar and Lounge', 'Ocean FInancial Centre Level 43 10 Collyer Quat, 049315 Singapore', '65091565', 'Italian', 30, 30, 70, 0),
('Two Men Bagel House', '16 Enggor St Singapore 079717', '65094125', 'Western', 30, 15, 15, 1),
('Paradise Pavilion', '8A Marina Boulevard #02-01 Marina Bay Link Mall', '65099308', 'Asian', 14, 25, 26, 1),
('Alkaff Mansion Ristorante', '10 Telok Blangah Green, 108178 Singapore', '65103068', 'Italian', 10, 15, 50, 1),
('Peach Garden', '65 Chulia Street #33-01 OCBC Centre', '65357833', 'Asian', 6, 12, 14, 1),
('D''Bell', '43 North Canal Road, 059299 Singapore', '65364046', 'Western', 0, 20, 47, 1),
('Canopy Garden Dining & Bar', 'Bishan Park 2 1382 Ang Mo Kio Ave 1 Singapore 569931', '65561533', 'Western', 10, 10, 10, 1),
('Forest', 'Resort World Sentosa, Equarius Hotel, Level 1, 8 Sentosa Gateway, 098269 Singapore', '65777788', 'Chinese', 18, 30, 47, 0),
('Lantern Rooftop Bar', '80 Collyer Quay The Fullerton Bay Hotel Singapore', '65975299', 'French', 10, 4, 2, 1),
('Ochre', '181 Orchard Road #11-03/04 Orchard Central', '66340423', 'Italian', 6, 9, 9, 1),
('Relish Restaurant', '1 Maju Avenue #02-07/09 myVillage at Serangoon Garden', '66343422', 'Western', 10, 10, 10, 1),
('Arossa Wine & Grill', 'Scotts Square (Next to Grand Hyatt Hotel), No. 6, Scotts Road, #02-01, 228209 Singapore', '66362951', 'Australian', 0, 50, 50, 1),
('sixty40', '#01-05 Rochester Mall 35 Rochester Dr 138639', '66849028', 'Western', 6, 5, 10, 1),
('Ku De Ta', '10 Bayfront Avenue, 018956 Singapore', '66887688', 'Combination', 38, 60, 40, 0),
('Imperial Treasure Fine Chinese Cuisine', '#L2-04, Marina Bay Sands 10 Bayfront Avenue', '66887788', 'Asian', 20, 20, 20, 1),
('Osteria Pizzeria Mozza', '2 Bayfront Ave #B1-42/46 The Shoppes @ Marina Bay Sands Singapore', '66888522', 'Italian', 4, 7, 9, 1),
('DB Bistro', '10 Bayfront Avenue #B1-48 Galleria Level', '66888525', 'Western', 24, 20, 14, 1),
('&Made', '#01-04/05/06 Pacific Plaza 9 Scotts Road', '66907566', 'Western', 30, 30, 30, 1),
('il Cielo Restaurant & Bar', 'Level 24, Hilton Singapore 581 Orchard Road, 238883 Singapore', '67303395', 'Italian', 30, 30, 30, 1),
('Bangkok Jam', '#02-26 Great World City 1 Kim Seng Promenade 237994', '67324523', 'Thai', 6, 10, 10, 1),
('Cedele Restaurant & Bakery', '501 Orchard Road #03-14 Wheelock Place', '67328520', 'Western', 10, 10, 20, 1),
('Bella Pizza', '30 Robertson Quay #01-14 Riverside View Singapore', '67340139', 'Italian', 4, 7, 9, 1),
('Marmalade Pantry', '2 Orchard Turn #03-22', '67342700', 'Dessert', 4, 8, 9, 1),
('Kith Cafe @ Sentosa Cove', '31 Ocean Way, Quayside Isle, #01-08, 098375 Singapore', '67349007', 'Japanese', 0, 29, 41, 0),
('Fat Cow', 'Camden Medical Centre #01-01 1 Orchard Boulevard 248649', '67350308', 'Japanese', 25, 10, 5, 1),
('Bodega Y Tapas', '442 Orchard Road, #01-29 Orchard Hotel, 238879 Singapore', '67353476', 'Mediterranean', 15, 20, 46, 1),
('Antoinette Patisserie', '390 Orchard Road #B1-08/09/10C Palais Renaissance', '67356392', 'Belgian', 5, 5, 0, 1),
('Patara Fine Thai Cuisine', '163 Tanglin Road #03-14, 247933 Singapore', '67370818', 'Thai', 0, 40, 20, 1),
('Huber''s Butchery & Bistro', '18A Dempsey Road', '67371588', 'Western', 19, 15, 13, 1),
('Boomarang Cafe', '60 Robertson Quay #01-15 The Quayside', '67381077', 'Dessert', 4, 4, 4, 1),
('Matcha from Canele Patisserie', '11 Unity Street #01-09 Robertson Walk Singapore', '67388145', 'Dessert', 10, 10, 20, 1),
('La Nonna', '76 Namly Place', '67621587', 'Italian', 5, 4, 5, 1),
('Omakase Burger', '200 Turf Club Road #01-05 The Grandstand', '67632698', 'Western', 10, 20, 30, 1),
('Da Paolo', '3 Rochester Park Singapore', '67745537', 'Italian', 7, 5, 6, 1),
('Prive bakery cafe', '2 Keppel Bay Vista GF Marina @ Keppel Bay', '67760777', 'Western\r\n', 6, 7, 8, 1),
('Tony''s Pizza Bugis Junction', '#01-68A Bugis Junction 200 Victoria St 188021', '67774992', 'Western', 10, 5, 5, 1),
('Lady M', '1 Fullerton Road One Fullerton #01-10', '68200830', 'Belgian', 7, 6, 7, 1),
('Man Fu Yuan', '80 Middle Road 2F Intercontinental Hotel', '68251062', 'Asian', 10, 10, 10, 1),
('Edge Food Theatre @ Pan Pacific Singapore', '7 Raffles Boulevard, Marina Square, 039595 Singapore', '68268240', 'Combination', 20, 35, 27, 1),
('Pool Grill', '320 Orchard Road Singapore, 238865 Singapore', '68314627', 'Western', 20, 20, 20, 1),
('Lobby Lounge @ Pan Pacific Orchard', '10 Claymore Road, 229540 Singapore', '68316626', 'Western', 13, 17, 0, 0),
('Jiang-Nan Chun', '190 Orchard Boulevard Four Seasons Hotel', '68317220', 'Asian', 30, 40, 50, 1),
('California Pizza Kitchen', '583 Orchard Road #01-42 Forum The Shopping Mall Singapore', '68360110', 'Italian', 5, 2, 4, 1),
('Spruce Cafe Bakery', '320 Tanglin Road Phoenix Park Singapore', '68365528', 'Western', 10, 20, 30, 1),
('33 Cuppage Terrace Trattoria', 'Cuppage Terrace 33 Cuppage Road, 229458 Singapore', '68365738', 'Japanese', 24, 40, 36, 1),
('Grand Shanghai', '#01-01 King''s Centre 392 Havelock Road 169663', '68366867', 'Asian', 0, 0, 5, 1),
('Equinox', 'Level 70, Swissotel The Stamford, 2 Stamford Road, 178882 Singapore', '68373322', 'European', 34, 32, 45, 1),
('The Lighthouse', '1 Fullerton Square, 049178 Singapore', '68778933', 'Italian', 8, 16, 80, 0),
('J''s', '7, Purvis Strees, 01-01, 188586 Singapore', '68874787', 'Latin American', 34, 0, 50, 0),
('Epicurious Cafe', '392 Upper Bukit Timah Road The Rail Mall', '68945926', 'Western', 10, 10, 10, 1),
('IKYU', '5 Yong Siak Street, 168643 Singapore', '96632003', 'Japanese', 10, 30, 48, 0),
('Ps Cafe', '45 Ann Siang Road', '97970648', 'French', 4, 4, 4, 1);

--
-- Constraints for dumped tables
--


-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `booker_ic_no` varchar(256) NOT NULL DEFAULT '',
  `restaurant_contact_no` varchar(256) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `session` char(10) NOT NULL DEFAULT '',
  `booked1seaters` int(11) NOT NULL DEFAULT '0',
  `booked2seaters` int(11) NOT NULL DEFAULT '0',
  `booked4seaters` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`booker_ic_no`,`restaurant_contact_no`,`date`,`session`),
  KEY `restaurant_contact_no` (`restaurant_contact_no`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`restaurant_contact_no`) REFERENCES `restaurant` (`contact_no`) ON UPDATE CASCADE,
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`booker_ic_no`) REFERENCES `customer` (`ic_no`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booker_ic_no`, `restaurant_contact_no`, `date`, `session`, `booked1seaters`, `booked2seaters`, `booked4seaters`) VALUES
('F0213539Q', '64669819', '2015-03-03', 'lunch', 2, 0, 0),
('F0213539Q', '64757787', '2015-10-02', 'lunch', 2, 0, 0),
('F0213539Q', '67370818', '2014-10-23', 'lunch', 2, 1, 0),
('F0213539Q', '68268240', '2014-10-17', 'lunch', 2, 0, 0),
('F2634644N', '62359007', '2015-09-19', 'lunch', 2, 0, 0),
('F2634644N', '62528780', '2015-05-16', 'lunch', 0, 1, 0),
('F2634644N', '63366949', '2015-01-09', 'dinner', 0, 0, 0),
('F2634644N', '63384656', '2014-01-17', 'dinner', 1, 0, 0),
('F2634644N', '64757787', '2015-06-24', 'dinner', 0, 0, 0),
('F2634644N', '65561533', '2015-05-01', 'dinner', 2, 1, 0),
('F2634644N', '68365738', '2014-07-02', 'lunch', 1, 0, 0),
('F2634644N', '96632003', '2015-08-11', 'lunch', 2, 0, 0),
('F2838730W', '62221887', '2014-07-12', 'dinner', 1, 1, 0),
('F2838730W', '66849028', '2015-05-03', 'lunch', 2, 0, 0),
('F2838730W', '67340139', '2014-09-28', 'dinner', 0, 1, 0),
('F3480625W', '65364046', '2014-10-06', 'dinner', 0, 1, 0),
('F3480625W', '65561533', '2014-02-15', 'dinner', 1, 0, 0),
('F3480625W', '67745537', '2015-02-23', 'lunch', 1, 1, 0),
('F3480625W', '68251062', '2014-04-22', 'dinner', 1, 0, 0),
('F3480625W', '68365738', '2014-07-01', 'dinner', 0, 1, 0),
('F4007730T', '62701355', '2015-09-05', 'lunch', 1, 0, 0),
('F4007730T', '64388700', '2014-04-21', 'lunch', 1, 0, 0),
('F4007730T', '64388700', '2014-05-15', 'dinner', 2, 1, 0),
('F4007730T', '64757787', '2014-09-16', 'lunch', 0, 0, 0),
('F4007730T', '66362951', '2015-11-20', 'dinner', 1, 1, 0),
('F4007730T', '67324523', '2014-11-05', 'dinner', 1, 1, 0),
('F4007730T', '67621587', '2015-12-26', 'dinner', 2, 1, 0),
('F7214348P', '65364046', '2014-02-10', 'dinner', 2, 0, 0),
('F7214348P', '67760777', '2014-04-11', 'lunch', 1, 1, 0),
('F7214348P', '67760777', '2014-06-10', 'lunch', 2, 1, 0),
('F7214348P', '67760777', '2014-09-26', 'lunch', 1, 1, 0),
('F7214348P', '68251062', '2015-02-22', 'dinner', 2, 1, 0),
('G0762141N', '63366949', '2015-05-22', 'lunch', 2, 0, 0),
('G0762141N', '63383363', '2015-03-02', 'lunch', 1, 1, 0),
('G0762141N', '64750200', '2015-09-17', 'lunch', 0, 0, 0),
('G0762141N', '65561533', '2015-12-12', 'dinner', 1, 0, 0),
('G0762141N', '66849028', '2014-05-10', 'lunch', 0, 0, 0),
('G0762141N', '67370818', '2014-07-20', 'dinner', 0, 1, 0),
('G5525876M', '62767337', '2014-11-21', 'dinner', 0, 0, 0),
('G5525876M', '67388145', '2014-11-28', 'dinner', 1, 0, 0),
('G5525876M', '96632003', '2015-08-11', 'dinner', 1, 1, 0),
('G9277718P', '64562567', '2015-09-04', 'dinner', 2, 1, 0),
('G9277718P', '65364046', '2015-09-16', 'lunch', 0, 1, 0),
('G9277718P', '67324523', '2015-10-08', 'dinner', 2, 1, 0),
('S0109361D', '62359556', '2015-07-18', 'lunch', 2, 1, 0),
('S0109361D', '62767337', '2015-04-07', 'lunch', 2, 1, 0),
('S0109361D', '64656556', '2015-09-18', 'dinner', 0, 1, 0),
('S0109361D', '67371588', '2015-09-03', 'dinner', 0, 0, 0),
('S0109361D', '68316626', '2015-03-01', 'lunch', 0, 1, 0),
('S0109361D', '68365738', '2015-02-08', 'lunch', 0, 1, 0),
('S1324269J', '62933121', '2014-01-09', 'lunch', 2, 0, 0),
('S1324269J', '64631923', '2015-04-09', 'dinner', 0, 1, 0),
('S1324269J', '65094125', '2015-10-22', 'dinner', 1, 1, 0),
('S1324269J', '65364046', '2015-04-02', 'lunch', 2, 0, 0),
('S1324269J', '65777788', '2014-07-03', 'dinner', 1, 0, 0),
('S1324269J', '67370818', '2014-08-15', 'dinner', 2, 1, 0),
('S1324269J', '67621587', '2014-07-09', 'dinner', 0, 0, 0),
('S1324269J', '67774992', '2014-02-28', 'dinner', 1, 1, 0),
('S1391845G', '63393740', '2015-05-25', 'dinner', 0, 0, 0),
('S1391845G', '64762922', '2014-08-16', 'lunch', 2, 0, 0),
('S1391845G', '67349007', '2014-05-01', 'dinner', 2, 1, 0),
('S1391845G', '67370818', '2014-10-19', 'dinner', 2, 0, 0),
('S1699316F', '64000247', '2014-11-20', 'dinner', 2, 1, 0),
('S1699316F', '66888525', '2014-05-04', 'dinner', 2, 0, 0),
('S1699316F', '97970648', '2014-05-27', 'lunch', 1, 1, 0),
('S2482119F', '64631923', '2014-02-24', 'lunch', 2, 1, 0),
('S2482119F', '66362951', '2015-03-24', 'lunch', 2, 0, 0),
('S3364567H', '64750200', '2015-01-17', 'dinner', 1, 0, 0),
('S3364567H', '65561533', '2015-12-04', 'dinner', 2, 1, 0),
('S3364567H', '67324523', '2014-11-22', 'lunch', 0, 1, 0),
('S3364567H', '67370818', '2015-09-11', 'dinner', 0, 0, 0),
('S3364567H', '67760777', '2015-10-01', 'dinner', 0, 1, 0),
('S3364567H', '68778933', '2014-06-14', 'dinner', 2, 0, 0),
('S3844652E', '62988198', '2014-05-22', 'lunch', 0, 1, 0),
('S3844652E', '65103068', '2014-01-15', 'dinner', 1, 1, 0),
('S3844652E', '66362951', '2014-08-12', 'lunch', 2, 0, 0),
('S3844652E', '66907566', '2015-06-24', 'lunch', 0, 1, 0),
('S3844652E', '68317220', '2015-07-24', 'dinner', 2, 0, 0),
('S4504697D', '64380410', '2014-07-13', 'lunch', 0, 0, 0),
('S4504697D', '64380410', '2015-12-27', 'lunch', 2, 0, 0),
('S4504697D', '67324523', '2014-11-21', 'lunch', 0, 1, 0),
('S4504697D', '68365528', '2014-08-23', 'dinner', 0, 1, 0),
('S4504697D', '68366867', '2015-08-22', 'lunch', 2, 1, 0),
('S4504697D', '97970648', '2014-05-08', 'dinner', 2, 1, 0),
('S4745311I', '64656556', '2014-10-16', 'dinner', 2, 1, 0),
('S4788881F', '62356093', '2014-12-06', 'lunch', 2, 1, 0),
('S4788881F', '62357823', '2015-03-01', 'dinner', 1, 0, 0),
('S4788881F', '62767337', '2015-08-13', 'dinner', 2, 0, 0),
('S4788881F', '63360588', '2015-04-04', 'dinner', 0, 0, 0),
('S4788881F', '65066887', '2014-01-06', 'lunch', 1, 0, 0),
('S4788881F', '66340423', '2015-10-20', 'dinner', 2, 1, 0),
('S4788881F', '67340139', '2014-01-07', 'dinner', 1, 1, 0),
('S5425511Z', '62701355', '2014-03-08', 'dinner', 2, 1, 0),
('S5425511Z', '62988198', '2014-08-03', 'lunch', 1, 1, 0),
('S5425511Z', '63384898', '2014-02-27', 'lunch', 1, 1, 0),
('S5425511Z', '64757787', '2015-05-20', 'lunch', 1, 1, 0),
('S5425511Z', '64757787', '2015-06-23', 'lunch', 0, 0, 0),
('S5425511Z', '66887688', '2014-02-17', 'dinner', 2, 0, 0),
('S5425511Z', '67353476', '2015-10-26', 'lunch', 2, 0, 0),
('S5425511Z', '67388145', '2015-08-01', 'dinner', 1, 0, 0),
('S5425511Z', '68365738', '2014-12-08', 'dinner', 0, 1, 0),
('S5691320C', '62356093', '2014-11-06', 'dinner', 0, 0, 0),
('S5691320C', '62701355', '2014-10-06', 'lunch', 2, 1, 0),
('S5691320C', '63334202', '2015-08-28', 'dinner', 2, 1, 0),
('S5691320C', '63393740', '2014-02-07', 'lunch', 2, 1, 0),
('S5691320C', '64388700', '2014-04-02', 'lunch', 2, 0, 0),
('S5691320C', '64677326', '2015-05-24', 'dinner', 1, 0, 0),
('S5691320C', '68316626', '2014-07-24', 'lunch', 0, 1, 0),
('S5796647E', '62528780', '2014-10-15', 'lunch', 1, 1, 0),
('S5796647E', '64388700', '2015-06-07', 'lunch', 0, 0, 0),
('S5796647E', '64757787', '2015-01-06', 'dinner', 1, 1, 0),
('S5796647E', '66888525', '2015-04-05', 'dinner', 0, 1, 0),
('S5796647E', '68360110', '2014-07-28', 'dinner', 0, 0, 0),
('S5796647E', '68373322', '2014-04-25', 'lunch', 2, 1, 0),
('S6416512G', '63366949', '2015-01-22', 'lunch', 1, 1, 0),
('S6416512G', '64638080', '2014-02-02', 'dinner', 1, 0, 0),
('S6416512G', '68365738', '2014-05-03', 'lunch', 0, 1, 0),
('S7220672Z', '63360588', '2015-08-18', 'dinner', 2, 0, 0),
('S7220672Z', '63384898', '2014-01-01', 'lunch', 1, 0, 0),
('S7220672Z', '64664088', '2015-11-22', 'dinner', 1, 1, 0),
('S7220672Z', '67342700', '2015-08-28', 'dinner', 0, 1, 0),
('S7220672Z', '67356392', '2014-11-06', 'lunch', 2, 0, 0),
('S7220672Z', '67632698', '2014-11-18', 'lunch', 1, 0, 0),
('S7424464E', '63362271', '2015-12-07', 'lunch', 1, 1, 0),
('S7424464E', '63384656', '2015-10-08', 'lunch', 2, 0, 0),
('S7424464E', '64656556', '2015-06-12', 'dinner', 0, 0, 0),
('S7424464E', '65103068', '2014-05-08', 'dinner', 0, 1, 0),
('S7424464E', '66343422', '2014-11-07', 'lunch', 0, 1, 0),
('S7424464E', '66849028', '2015-09-14', 'dinner', 2, 1, 0),
('S7424464E', '67388145', '2015-11-14', 'lunch', 1, 0, 0),
('S7424464E', '97970648', '2014-05-09', 'lunch', 0, 1, 0),
('S9179887E', '63363386', '2014-12-13', 'dinner', 2, 1, 0),
('S9179887E', '67388145', '2015-12-18', 'lunch', 1, 1, 0),
('S9179887E', '68366867', '2015-08-11', 'lunch', 1, 1, 0),
('S9179887E', '97970648', '2014-11-26', 'dinner', 0, 0, 0),
('S9225467D', '64762922', '2014-07-13', 'lunch', 2, 0, 0),
('S9328705C', '63366949', '2015-07-14', 'lunch', 2, 0, 0),
('S9328705C', '63384898', '2015-02-02', 'lunch', 2, 0, 0),
('S9328705C', '65091565', '2014-09-02', 'lunch', 0, 0, 0),
('S9328705C', '67370818', '2015-03-02', 'lunch', 1, 1, 0),
('T1247251F', '62221887', '2014-09-11', 'dinner', 2, 1, 0),
('T1247251F', '65777788', '2015-07-28', 'dinner', 2, 1, 0),
('T1247251F', '67353476', '2015-01-13', 'dinner', 2, 1, 0),
('T1247251F', '67370818', '2014-04-28', 'lunch', 2, 1, 0),
('T1247251F', '68200830', '2014-07-08', 'lunch', 1, 0, 0),
('T9530513F', '63383363', '2014-01-08', 'dinner', 2, 1, 0),
('T9530513F', '64380410', '2014-11-01', 'dinner', 0, 0, 0),
('T9530513F', '64762922', '2014-03-25', 'dinner', 0, 1, 0),
('T9530513F', '66343422', '2015-11-25', 'dinner', 1, 0, 0),
('T9530513F', '68317220', '2014-06-23', 'dinner', 1, 1, 0);

-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
