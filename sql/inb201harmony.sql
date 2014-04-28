-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.firelabs.com.au
-- Generation Time: Apr 28, 2014 at 06:13 AM
-- Server version: 5.1.56
-- PHP Version: 5.4.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inb201harmony`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE IF NOT EXISTS `admissions` (
  `admission_Id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `bed_id` int(8) NOT NULL COMMENT 'FK',
  `admission_date` date NOT NULL,
  `discharge_date` date DEFAULT NULL,
  `resource_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `last_updated_by` varchar(20) NOT NULL,
  PRIMARY KEY (`admission_Id`),
  KEY `patientid` (`patient_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`admission_Id`, `patient_id`, `bed_id`, `admission_date`, `discharge_date`, `resource_id`, `account_id`, `notes`, `last_updated_by`) VALUES
(4, 4, 0, '2014-03-14', NULL, 3, 4, ' PATIENT PRESENTED WITH A SEVERELY BROKEN ARM', 'KRIOFARR'),
(2, 2, 0, '2014-03-14', NULL, 2, 2, ' PATIENT PRESENTED WITH SEVERED LEG', 'KIRJAMIS'),
(3, 3, 0, '2014-03-14', NULL, 3, 3, ' PATIENT HAS BEEN CHECKED IN FOR RADIATION TREATMENT FOR LYMPHOMA', 'ARMKOSH'),
(1, 1, 0, '2014-03-14', '2015-06-21', 1, 1, 'TEST', 'JESCREEC'),
(15, 0, 0, '2007-06-02', NULL, 0, 0, '', ''),
(16, 0, 0, '2005-09-03', NULL, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admission_account`
--

CREATE TABLE IF NOT EXISTS `admission_account` (
  `account_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `insurance_provider_id` int(11) NOT NULL,
  `provider_client_number` varchar(60) NOT NULL,
  `expiry_date_of_cover` date NOT NULL,
  `cover_type` char(100) NOT NULL,
  `last_updated_by` varchar(20) NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `admission_id` (`admission_id`),
  KEY `insurance_provider_id` (`insurance_provider_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admission_account`
--

INSERT INTO `admission_account` (`account_id`, `admission_id`, `insurance_provider_id`, `provider_client_number`, `expiry_date_of_cover`, `cover_type`, `last_updated_by`) VALUES
(4, 4, 4, '11121314', '2015-11-01', 'BASIC', 'KRIOFARR'),
(2, 2, 2, '43256789', '2019-10-15', 'HOSPITAL', 'KIRJAMIS'),
(3, 3, 3, '23476598', '2018-01-01', 'HOSPITALANDEXTRAS', 'ARMKOSH'),
(1, 1, 1, '18531884', '2017-02-12', 'BASIC', 'JESCREEC');

-- --------------------------------------------------------

--
-- Table structure for table `allergies_conditions`
--

CREATE TABLE IF NOT EXISTS `allergies_conditions` (
  `disorder_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(10) NOT NULL,
  PRIMARY KEY (`disorder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `allergies_conditions`
--

INSERT INTO `allergies_conditions` (`disorder_id`, `name`, `description`) VALUES
(1, 'Penicillin', 'Allergy'),
(2, 'Choline', 'Allergy'),
(3, 'Peanuts', 'Allergy'),
(4, 'Bees', 'Allergy'),
(5, 'ADHD', 'Condition '),
(6, 'Autism', 'Condition '),
(7, 'Asthma', 'Condition'),
(8, 'Diabetes', 'Condition');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE IF NOT EXISTS `beds` (
  `bed_id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `bed_description` varchar(255) DEFAULT NULL,
  `ward_id` int(8) NOT NULL COMMENT 'FK',
  PRIMARY KEY (`bed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `beds`
--


-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk',
  `admission_id` int(11) NOT NULL COMMENT 'fk',
  `resource_id` int(11) NOT NULL COMMENT 'fk',
  `procedure_id` int(11) NOT NULL COMMENT 'fk',
  `staff_id` int(11) NOT NULL COMMENT 'fk',
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `finish_time` time NOT NULL,
  `last_updated_by` varchar(20) NOT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `uc_admissionbookingstart` (`admission_id`,`booking_date`,`start_time`),
  UNIQUE KEY `uc_resourcebookingstart` (`resource_id`,`booking_date`,`start_time`),
  UNIQUE KEY `uc_admissionbookingfinish` (`admission_id`,`booking_date`,`finish_time`),
  UNIQUE KEY `uc_resourcebookingfinish` (`resource_id`,`booking_date`,`finish_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `admission_id`, `resource_id`, `procedure_id`, `staff_id`, `booking_date`, `start_time`, `finish_time`, `last_updated_by`) VALUES
(31, 1, 4, 9, 100077, '2014-06-10', '18:30:00', '19:15:00', '100077'),
(30, 1, 4, 5, 100077, '2014-06-10', '23:00:00', '23:59:00', '100077'),
(29, 1, 4, 6, 100077, '2014-06-10', '17:00:00', '17:30:00', '100077'),
(28, 1, 4, 5, 100077, '2014-06-10', '11:00:00', '12:30:00', '100077'),
(27, 1, 4, 9, 100077, '2014-06-10', '09:00:00', '11:00:00', '100077');

-- --------------------------------------------------------

--
-- Table structure for table `clinical_history_detail`
--

CREATE TABLE IF NOT EXISTS `clinical_history_detail` (
  `clinical_history_detail_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `response_to_medication` varchar(255) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `date_entered` date NOT NULL,
  `last_updated_by` varchar(20) NOT NULL,
  `medical_image` varchar(100) DEFAULT NULL,
  `test_notes` varchar(255) NOT NULL,
  PRIMARY KEY (`clinical_history_detail_id`),
  KEY `admission_id` (`admission_id`),
  KEY `procedure_id` (`procedure_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clinical_history_detail`
--

INSERT INTO `clinical_history_detail` (`clinical_history_detail_id`, `admission_id`, `procedure_id`, `response_to_medication`, `staff_id`, `date_entered`, `last_updated_by`, `medical_image`, `test_notes`) VALUES
(4, 4, 4, NULL, 3, '2014-03-15', 'KRIOFARR', '', ''),
(3, 3, 3, NULL, 4, '2014-03-15', 'ARMKOSH', '', ''),
(2, 2, 2, NULL, 2, '2014-03-15', 'KIRJAMIS', '', ''),
(1, 1, 9, NULL, 1, '2014-03-15', 'James', '../testresultsimg/xray.jpg', 'TESTTESTTESTTEST');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(25) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1877 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(505, 'Nicaragua'),
(504, 'Honduras'),
(503, 'El Salvador'),
(502, 'Guatemala'),
(500, 'Falkland Islands'),
(501, 'Belize'),
(423, 'Liechtenstein'),
(421, 'Slovakia'),
(420, 'Czech Republic'),
(389, 'Macedonia'),
(387, 'Bosnia and Herzegovina'),
(386, 'Slovenia'),
(385, 'Croatia'),
(382, 'Montenegro'),
(383, 'Serbia'),
(381, 'Kosovo'),
(380, 'Ukraine'),
(378, 'San Marino'),
(377, 'Monaco'),
(376, 'Andorra'),
(375, 'Belarus'),
(374, 'Armenia'),
(373, 'Moldova'),
(372, 'Estonia'),
(371, 'Latvia'),
(370, 'Lithuania'),
(359, 'Bulgaria'),
(358, 'Finland'),
(356, 'Malta'),
(357, 'Cyprus'),
(355, 'Albania'),
(353, 'Ireland'),
(354, 'Iceland'),
(351, 'Portugal'),
(352, 'Luxembourg'),
(350, 'Gibraltar'),
(299, 'Greenland'),
(298, 'Faroe Islands'),
(297, 'Aruba'),
(291, 'Eritrea'),
(290, 'Saint Helena'),
(269, 'Comoros'),
(268, 'Swaziland'),
(267, 'Botswana'),
(266, 'Lesotho'),
(265, 'Malawi'),
(264, 'Namibia'),
(263, 'Zimbabwe'),
(262, 'Mayotte'),
(261, 'Madagascar'),
(260, 'Zambia'),
(258, 'Mozambique'),
(257, 'Burundi'),
(256, 'Uganda'),
(255, 'Tanzania'),
(254, 'Kenya'),
(253, 'Djibouti'),
(252, 'Somalia'),
(251, 'Ethiopia'),
(250, 'Rwanda'),
(249, 'Sudan'),
(248, 'Seychelles'),
(245, 'Guinea-Bissau'),
(244, 'Angola'),
(243, 'Democratic Republic of th'),
(242, 'Republic of the Congo'),
(241, 'Gabon'),
(240, 'Equatorial Guinea'),
(239, 'Sao Tome and Principe'),
(238, 'Cape Verde'),
(237, 'Cameroon'),
(236, 'Central African Republic'),
(235, 'Chad'),
(234, 'Nigeria'),
(233, 'Ghana'),
(232, 'Sierra Leone'),
(231, 'Liberia'),
(230, 'Mauritius'),
(229, 'Benin'),
(228, 'Togo'),
(227, 'Niger'),
(226, 'Burkina Faso'),
(225, 'Ivory Coast'),
(224, 'Guinea'),
(223, 'Mali'),
(222, 'Mauritania'),
(221, 'Senegal'),
(220, 'Gambia'),
(218, 'Libya'),
(216, 'Tunisia'),
(213, 'Algeria'),
(212, 'Morocco'),
(98, 'Iran'),
(95, 'Burma (Myanmar)'),
(94, 'Sri Lanka'),
(93, 'Afghanistan'),
(92, 'Pakistan'),
(91, 'India'),
(90, 'Turkey'),
(86, 'China'),
(84, 'Vietnam'),
(82, 'South Korea'),
(81, 'Japan'),
(66, 'Thailand'),
(65, 'Singapore'),
(64, 'New Zealand'),
(63, 'Philippines'),
(62, 'Indonesia'),
(61, 'Australia'),
(60, 'Malaysia'),
(58, 'Venezuela'),
(57, 'Colombia'),
(56, 'Chile'),
(55, 'Brazil'),
(54, 'Argentina'),
(53, 'Cuba'),
(52, 'Mexico'),
(51, 'Peru'),
(49, 'Germany'),
(48, 'Poland'),
(47, 'Norway'),
(46, 'Sweden'),
(45, 'Denmark'),
(44, 'United Kingdom'),
(42, 'Isle of Man'),
(43, 'Austria'),
(41, 'Switzerland'),
(40, 'Romania'),
(39, 'Italy'),
(38, 'Holy See (Vatican City)'),
(36, 'Hungary'),
(34, 'Spain'),
(33, 'France'),
(32, 'Belgium'),
(31, 'Netherlands'),
(30, 'Greece'),
(27, 'South Africa'),
(20, 'Egypt'),
(7, 'Russia'),
(17, 'Kazakhstan'),
(1, 'United States'),
(11, 'Puerto Rico'),
(10, 'Canada'),
(506, 'Costa Rica'),
(507, 'Panama'),
(508, 'Saint Pierre and Miquelon'),
(509, 'Haiti'),
(590, 'Saint Barthelemy'),
(591, 'Bolivia'),
(592, 'Guyana'),
(593, 'Ecuador'),
(595, 'Paraguay'),
(597, 'Suriname'),
(598, 'Uruguay'),
(599, 'Netherlands Antilles'),
(670, 'Timor-Leste'),
(672, 'Antarctica'),
(671, 'Norfolk Island'),
(673, 'Brunei'),
(674, 'Nauru'),
(675, 'Papua New Guinea'),
(676, 'Tonga'),
(677, 'Solomon Islands'),
(678, 'Vanuatu'),
(679, 'Fiji'),
(680, 'Palau'),
(681, 'Wallis and Futuna'),
(682, 'Cook Islands'),
(683, 'Niue'),
(685, 'Samoa'),
(686, 'Kiribati'),
(687, 'New Caledonia'),
(688, 'Tuvalu'),
(689, 'French Polynesia'),
(690, 'Tokelau'),
(691, 'Micronesia'),
(692, 'Marshall Islands'),
(850, 'North Korea'),
(852, 'Hong Kong'),
(853, 'Macau'),
(855, 'Cambodia'),
(856, 'Laos'),
(870, 'Pitcairn Islands'),
(880, 'Bangladesh'),
(886, 'Taiwan'),
(960, 'Maldives'),
(961, 'Lebanon'),
(962, 'Jordan'),
(963, 'Syria'),
(964, 'Iraq'),
(965, 'Kuwait'),
(966, 'Saudi Arabia'),
(967, 'Yemen'),
(968, 'Oman'),
(969, 'Gaza Strip'),
(970, 'West Bank'),
(971, 'United Arab Emirates'),
(972, 'Israel'),
(973, 'Bahrain'),
(974, 'Qatar'),
(975, 'Bhutan'),
(976, 'Mongolia'),
(977, 'Nepal'),
(992, 'Tajikistan'),
(993, 'Turkmenistan'),
(994, 'Azerbaijan'),
(995, 'Georgia'),
(996, 'Kyrgyzstan'),
(998, 'Uzbekistan'),
(1242, 'Bahamas'),
(1246, 'Barbados'),
(1264, 'Anguilla'),
(1268, 'Antigua and Barbuda'),
(1284, 'British Virgin Islands'),
(1340, 'US Virgin Islands'),
(1345, 'Cayman Islands'),
(1441, 'Bermuda'),
(1473, 'Grenada'),
(1599, 'Saint Martin'),
(1649, 'Turks and Caicos Islands'),
(1664, 'Montserrat'),
(1670, 'Northern Mariana Islands'),
(1671, 'Guam'),
(1684, 'American Samoa'),
(1758, 'Saint Lucia'),
(1767, 'Dominica'),
(1784, 'Saint Vincent and the Gre'),
(1809, 'Dominican Republic'),
(1868, 'Trinidad and Tobago'),
(1869, 'Saint Kitts and Nevis'),
(1876, 'Jamaica');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `department_description` varchar(255) NOT NULL,
  `number_of_wards` int(4) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1' COMMENT 'used to flag decommissioned departments',
  `department_prefix` char(8) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2147483648 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_description`, `number_of_wards`, `active`, `department_prefix`) VALUES
(201, 'ACCIDENT AND EMERGENCY', 0, '1', 'AE'),
(204, 'CARDIOLOGY', 0, '1', 'CARD'),
(209, 'EAR NOSE AND THROAT', 0, '1', 'ENT'),
(211, 'GENERAL SURGERY', 0, '1', 'GS'),
(215, 'NEUROLOGY', 0, '1', 'NEURO'),
(219, 'ONCOLOGY', 0, '1', 'ONC'),
(220, 'ORTHOPAEDICS', 0, '1', 'ORTH'),
(222, 'RADIOTHERAPY', 0, '1', 'RADIO'),
(226, 'UROLOGY', 0, '1', 'UROL');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_providers`
--

CREATE TABLE IF NOT EXISTS `insurance_providers` (
  `insurance_provider_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `insurance_provider_code` char(3) NOT NULL,
  `insurance_provider_name` char(45) NOT NULL,
  PRIMARY KEY (`insurance_provider_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `insurance_providers`
--

INSERT INTO `insurance_providers` (`insurance_provider_id`, `insurance_provider_code`, `insurance_provider_name`) VALUES
(1, 'ACA', 'ACA Health Benefits Fund'),
(2, 'AHM', 'ahm Health Insurance'),
(3, 'AUF', 'Australian Unity Health Limited'),
(4, 'BUP', 'Bupa Australia Pty Ltd'),
(5, 'CBH', 'CBHS Health Fund Limited'),
(6, 'CDH', 'CDH Benefits Fund'),
(7, 'CWH', 'Central West Health Cover'),
(8, 'CPS', 'CUA Health Limited'),
(9, 'AHB', 'Defence Health Limited'),
(10, 'AMA', 'Doctors'' Health Fund'),
(11, 'GMF', 'GMF Health'),
(12, 'GMH', 'GMHBA Limited'),
(13, 'FAI', 'Grand United Corporate Health'),
(14, 'HBF', 'HBF Health Limited'),
(15, 'HCF', 'HCF'),
(16, 'HCI', 'Health Care Insurance Limited'),
(17, 'HIF', 'Health Insurance Fund of Australia Limited'),
(18, 'SPS', 'Health Partners'),
(19, 'HEA', 'health.com.au'),
(20, 'LHS', 'Latrobe Health Services'),
(21, 'MBP', 'Medibank Private Limited'),
(22, 'MDH', 'Mildura District Hospital Fund Ltd'),
(23, 'OMF', 'National Health Benefits Australia Pty Ltd'),
(24, 'NHB', 'Navy Health Ltd'),
(25, 'NIB', 'NIB Health Funds Ltd.'),
(26, 'LHM', 'Peoplecare Health Insurance'),
(27, 'PWA', 'Phoenix Health Fund Limited'),
(28, 'SPE', 'Police Health'),
(29, 'QCH', 'Queensland Country Health Fund Ltd'),
(30, 'RTE', 'Railway and Transport Health Fund Limited'),
(31, 'RBH', 'Reserve Bank Health Society Ltd'),
(32, 'SLM', 'St.Lukes Health'),
(33, 'NTF', 'Teachers Health Fund'),
(34, 'TFS', 'Transport Health Pty Ltd'),
(35, 'QTU', 'TUH'),
(36, 'WFD', 'Westfund Limited');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE IF NOT EXISTS `medical_history` (
  `medical_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL COMMENT 'foreign key',
  `doctors_notes` varchar(512) NOT NULL,
  `nurses_notes` varchar(512) NOT NULL,
  `current_medication` varchar(100) DEFAULT NULL,
  `allergies` varchar(255) DEFAULT NULL,
  `conditions` varchar(255) DEFAULT NULL,
  `height` smallint(6) NOT NULL,
  `weight` smallint(6) NOT NULL,
  `disorder_id` int(11) NOT NULL,
  `last_updated_by` varchar(20) NOT NULL,
  PRIMARY KEY (`medical_history_id`),
  KEY `patient_id` (`patient_id`),
  KEY `disorder_id` (`disorder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`medical_history_id`, `patient_id`, `doctors_notes`, `nurses_notes`, `current_medication`, `allergies`, `conditions`, `height`, `weight`, `disorder_id`, `last_updated_by`) VALUES
(1, 1, 'given antibiotics to treat infection', 'gave patient morphine ', 'antibiotics', 'Choline', 'Diabetes', 180, 85, 0, 'JESCREEC'),
(2, 2, 'SEVERED LEG NEEDS TO BE REPAIRED', 'KEEP PATIENT MONITORED HALF HOURLY UNTILL SURGERY', NULL, 'Penicillin,Choline,Peanuts', '', 160, 78, 0, 'KIRJAMIS'),
(3, 3, 'RADIATION TREATMENT SCHEDULED', 'KEEP PATIENT COMFORTABLE AND MONITORED DURING TREATMENT', NULL, 'Penicillin,Choline,Peanuts', '', 155, 65, 0, 'ARMKOSH'),
(4, 4, 'BROKEN ARM NEEDS TO BE RESET AND CAST', 'PATIENT CAN BE DISCHARGED AFTER PROCEDURE', NULL, 'Penicillin,Choline,Peanuts', '', 155, 65, 0, 'KRIOFARR'),
(15, 0, '', '', NULL, 'bees', 'ADHD', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE IF NOT EXISTS `patient_details` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `carer1_name` varchar(50) NOT NULL,
  `carer1_address` varchar(150) NOT NULL,
  `carer1_phone_number` int(10) NOT NULL,
  `carer2_name` varchar(50) DEFAULT NULL,
  `carer2_address` varchar(150) DEFAULT NULL,
  `carer2_phone_number` int(10) DEFAULT NULL,
  `send_bill_to` varchar(50) NOT NULL,
  `billing_address` varchar(150) NOT NULL,
  `signature` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `address_line` varchar(100) NOT NULL,
  `postcode` int(4) NOT NULL,
  `phone_number` int(8) DEFAULT NULL,
  `mobile_number` int(10) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `country_id` int(100) NOT NULL DEFAULT '1' COMMENT 'foreign key',
  `spoken_language` varchar(100) NOT NULL,
  `last_updated_by` varchar(20) NOT NULL,
  `medicare_number` char(11) NOT NULL,
  `medicare_expiry_date` date NOT NULL,
  `hospital_transfer` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`patient_id`),
  UNIQUE KEY `indx_patientunique` (`first_name`,`last_name`,`date_of_birth`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`patient_id`, `first_name`, `middle_name`, `last_name`, `carer1_name`, `carer1_address`, `carer1_phone_number`, `carer2_name`, `carer2_address`, `carer2_phone_number`, `send_bill_to`, `billing_address`, `signature`, `date_of_birth`, `date_of_death`, `address_line`, `postcode`, `phone_number`, `mobile_number`, `gender`, `country_id`, `spoken_language`, `last_updated_by`, `medicare_number`, `medicare_expiry_date`, `hospital_transfer`) VALUES
(3, 'OLIVER', 'SCOTT', 'MCNICOL', 'SARAH MCNICOL', '32 Sunny Ave, Wavell Heights, QLD 4012', 732567889, 'JOHN MCNICOL', '3 HOBLER COURT, 4054', 732178523, 'JOHN MCNICOL', '3 HOBLER COURT, 4054', '', '1986-02-10', '0000-00-00', '3 HOBLER COURT', 4054, 732178523, 419765467, 'M', 61, 'ENGLISH', 'ARMKOSH', '3282933541', '0000-00-00', NULL),
(4, 'JUSTIN', 'LEE', 'LIN', 'DESLEIGH LIN', '3 GEMINI TERRACE, QLD 4014', 733661223, NULL, NULL, NULL, 'DESLEIGH LIN', '3 GEMINI TERRACE, QLD 4014', '', '1980-01-01', NULL, '3 GEMINI TERRACE', 4014, 733661223, 40065122, 'M', 886, 'MANDARIN', 'KRIOFARR', '5382933541', '0000-00-00', NULL),
(2, 'CHRISTOPHER', 'JAMES', 'SMITH', 'Amy Smith', '6 STEPHENSON STREET, QLD 4064', 733696364, 'Patrick Smith', '6 STEPHENSON STREET, QLD 4064', 733696364, 'Amy & Patrick Smith', '6 STEPHENSON STREET, QLD 4064', '', '1990-11-08', NULL, '6 STEPHENSON STREET', 4064, 733696364, 411344484, 'M', 61, 'ENGLISH', 'KIRJAMIS', '4882333845', '0000-00-00', NULL),
(1, 'JAMES', 'Neil', 'RYAN', 'Anna Ryan', '2 Erneton St, Newmarket, QLD 4051', 732567700, 'Dominic Ryan', '34 Mossman St, Newmarket, QLD 4051', 732896364, 'Dominic Ryan', '34 Mossman St, Newmarket, QLD 4051', '', '1972-09-30', NULL, '34 MOSSMAN STREET, Newmarket', 4051, 732896364, 412345678, 'M', 61, 'ENGLISH', 'JESCREEC', '4772322845', '0000-00-00', 'TEST'),
(9, 'Ryan ', 'Max', 'Davidson', 'Sienna Davidson', '1 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 733561849, 'John Davidson', '1 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 733561849, 'Sienna & John Davidson', '1 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 's.davidson', '2010-05-05', NULL, '1 Eatons Crossing Rd, QLD', 4037, 733561849, 440365897, 'M', 1, 'None', 'kiraj', '4589785612', '2015-01-01', NULL),
(10, 'Lauren', 'Claire', 'Davidson', 'Sienna Davidson', '42 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 733561849, 'John Davidson', '42 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 733561889, 'John Davidson', '42 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 'j.davidson', '2009-12-12', NULL, '42 Eatons Crossing Rd, Eatons Hill, QLD', 4037, 733561849, 440365897, 'M', 1, 'Russian', 'kiraj', '45897856145', '2022-01-15', NULL),
(11, 'Emma', '', 'Dickinson', 'Louise Dickinson', '1 Testing St, QLD 4032', 733561849, '', '', 0, 'Louise Dickinson', '1 Testing St, QLD 4032', 'l.dickinson', '2005-08-20', NULL, '1 Testing St, QLD', 4032, 733561849, 440365897, 'F', 1, 'Russian', 'kiraj', '4589785612', '2020-01-01', NULL),
(12, 'John', 'Alexander', 'Hart', '1 Testing St, QLD 4032', '733561849', 0, '', '', 0, '', '', '', '0000-00-00', NULL, '', 0, 0, 0, 'M', 1, '', 'kiraj', '', '0000-00-00', NULL),
(13, 'test', 'test', 'test', 'test', 'test', 733561849, '', '', 0, 'test', 'test', 'test', '2001-01-01', NULL, 'test', 4037, 733561849, 440365897, 'F', 1, 'test', 'kiraj', '4589785612', '2020-02-02', NULL),
(14, 'Lexie', '', 'Smith', 'test', '1 Testing St, QLD 4032', 733561849, '', '', 0, 'test', '1 Testing St, QLD 4032', 'test', '2010-05-20', NULL, '1 Testing St, QLD', 4037, 733561849, 440365897, 'F', 0, '', 'kiraj', '4589785612', '2020-01-01', NULL),
(15, 'Emma', 'Claire', 'Doe', 'Sienna Doe', '42 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 733561849, '', '', 0, 'Sienna Doe', '42 Eatons Crossing Rd, Eatons Hill, QLD, 4037', 's.doe', '2009-08-08', NULL, '42 Eatons Crossing Rd, Eatons Hill, QLD', 4037, 733561849, 440365897, 'F', 17, 'None', 'kiraj', '4589785612', '2020-02-20', NULL),
(26, 'bob', NULL, 'smith', '', '', 0, NULL, NULL, NULL, '', '', '', '2005-03-02', NULL, '', 0, NULL, NULL, '', 1, '', '', '', '0000-00-00', NULL),
(27, 'james', NULL, 'test', '', '', 0, NULL, NULL, NULL, '', '', '', '2000-06-02', NULL, '', 0, NULL, NULL, '', 1, '', '', '', '0000-00-00', NULL),
(25, 'bob', NULL, 'test', '', '', 0, NULL, NULL, NULL, '', '', '', '2005-03-02', NULL, '', 0, NULL, NULL, '', 1, '', '', '', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_services`
--

CREATE TABLE IF NOT EXISTS `patient_services` (
  `patient_procedure_id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_id` int(11) NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `service_start_date` date NOT NULL,
  `service_end_date` date DEFAULT NULL,
  `consent_received` bit(1) NOT NULL DEFAULT b'1',
  `guardian_name` varchar(20) NOT NULL,
  `guardian_signature` varchar(100) NOT NULL,
  `consent_date` date NOT NULL,
  `last_updated_by` varchar(20) NOT NULL,
  PRIMARY KEY (`patient_procedure_id`),
  KEY `fk_admission_id` (`admission_id`),
  KEY `fk_procedure_id` (`procedure_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `patient_services`
--

INSERT INTO `patient_services` (`patient_procedure_id`, `admission_id`, `procedure_id`, `staff_id`, `service_start_date`, `service_end_date`, `consent_received`, `guardian_name`, `guardian_signature`, `consent_date`, `last_updated_by`) VALUES
(3, 1, 11, 100077, '2014-03-14', NULL, '1', 'Dominic Ryan', 'Dominic_Ryan_signature.png', '2014-04-18', '100056'),
(19, 1, 9, 100077, '2014-06-10', '2014-06-10', '1', 'Dominic Ryan', 'Dominic Ryan_signature.png', '2014-04-24', '100077'),
(18, 1, 5, 100077, '2014-06-10', '2014-06-10', '1', 'Dominic Ryan', 'Dominic Ryan_signature.png', '2014-04-24', '100077'),
(17, 1, 6, 100077, '2014-06-10', '2014-06-10', '1', 'Dominic Ryan', 'Dominic Ryan_signature.png', '2014-04-24', '100077'),
(16, 1, 5, 100077, '2014-06-10', '2014-06-10', '1', 'Dominic Ryan', 'Dominic Ryan_signature.png', '2014-04-24', '100077'),
(14, 1, 9, 100077, '2014-06-10', '2014-06-10', '1', 'Dominic Ryan', 'Dominic Ryan_signature.png', '2014-04-24', '100077');

-- --------------------------------------------------------

--
-- Table structure for table `procedure_listing`
--

CREATE TABLE IF NOT EXISTS `procedure_listing` (
  `procedure_id` int(11) NOT NULL AUTO_INCREMENT,
  `procedure_description` varchar(255) NOT NULL,
  `procedure_fee` double NOT NULL,
  `medicare_rebate` double NOT NULL,
  `last_updated_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`procedure_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10006 ;

--
-- Dumping data for table `procedure_listing`
--

INSERT INTO `procedure_listing` (`procedure_id`, `procedure_description`, `procedure_fee`, `medicare_rebate`, `last_updated_by`) VALUES
(3, 'Radiation Therapy', 180, 175, '100054'),
(2, 'Limb Repair', 9000, 8500, '100054'),
(1, 'Open Heart Surgery', 12000, 11500, '100054'),
(4, 'Bone Setting and Casting', 4000, 3500, '100054'),
(5, 'General Surgery', 3000, 2500, '100054'),
(6, 'MRI Scan', 750, 600, '100054'),
(7, 'CT Scan', 550, 450, '100054'),
(8, 'Blood Test', 50.5, 42.5, '100054'),
(9, 'X-ray Scan', 89.9, 78.9, '100054'),
(10, 'Blood Transfusion', 155.5, 129.5, '100054'),
(11, 'Hospital Stay', 125.5, 115, '100054');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `resource_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk',
  `department_id` int(11) NOT NULL COMMENT 'fk',
  `resource_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`resource_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `department_id`, `resource_description`) VALUES
(1, 207, 'CT Scan Lab'),
(2, 207, 'X-ray Lab'),
(3, 207, 'MRI Lab'),
(4, 211, 'Operating Theatre #1'),
(5, 211, 'Operating Theatre #2'),
(6, 211, 'Operating Theatre #3'),
(7, 219, 'Oncology Lab'),
(8, 211, 'Pathology Lab');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` enum('1','2','3','4','5','6') NOT NULL,
  `role_description` varchar(255) NOT NULL,
  `access_permissions` varchar(255) NOT NULL,
  `sql_view` varchar(255) NOT NULL,
  `access_area` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_description`, `access_permissions`, `sql_view`, `access_area`) VALUES
('4', ' HEAD DOCTOR', 'READ AND WRITE', 'MODERATE', 'patient_tab;doctors_tab;surgery_tab;facilities_tab;costs_tab;'),
('3', ' DOCTOR', 'READ AND WRITE', 'LIMITED', 'patient_tab;doctors_tab;surgery_tab;facilities_tab;'),
('2', 'HEAD NURSE', 'READ AND WRITE', 'LIMITED', 'patient_tab;nurses_tab;surgery_tab;facilities_tab;'),
('1', ' NURSE', 'READ', 'LIMITED', 'patient_tab;nurses_tab;facilities_tab;'),
('5', ' HOSPITAL MANAGER', 'READ', 'LIMITED', 'admin_tab;'),
('6', ' SYSTEM ADMINISTRATOR', 'READ AND WRITE', 'UNLIMITED', 'admin_tab;patient_tab;doctors_tab;nurses_tab;surgery_tab;facilities_tab;costs_tab;');

-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE IF NOT EXISTS `staff_details` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `username` char(18) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `approving_officer` varchar(255) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `postcode` int(4) NOT NULL,
  `phone_number` int(8) NOT NULL,
  `mobile_number` int(10) NOT NULL,
  `role_id` enum('1','2','3','4','5','6') NOT NULL COMMENT 'foreign key',
  `gender` char(1) NOT NULL,
  `department_id` int(11) NOT NULL COMMENT 'foreign key',
  `second_language` varchar(50) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `sick_leave_start` date DEFAULT NULL,
  `sick_leave_end` date DEFAULT NULL,
  `sick_leave_cert` enum('yes','no') NOT NULL,
  `annual_leave_start` date NOT NULL,
  `annual_leave_end` date NOT NULL,
  `blue_card` enum('yes','no') NOT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  KEY `department_id` (`department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100081 ;

--
-- Dumping data for table `staff_details`
--

INSERT INTO `staff_details` (`staff_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `username`, `password`, `salt`, `approving_officer`, `address_line`, `postcode`, `phone_number`, `mobile_number`, `role_id`, `gender`, `department_id`, `second_language`, `email_address`, `sick_leave_start`, `sick_leave_end`, `sick_leave_cert`, `annual_leave_start`, `annual_leave_end`, `blue_card`) VALUES
(100080, 'Jesse Test', 'R', 'Creech', '2014-04-22', 'CreechJ100080', '$5$pgT440zYWyhqhpwm$kfvs3lGVfbE8D5x6smPvveS7f2URGkvtLnNHKHhBqfD', 'pgT440zYWyhqhpwmRKda', '', '3a Browning Street', 4101, 2147483647, 2147483647, '4', 'm', 0, 'no', 'jesse@trustinblack.com', NULL, NULL, 'yes', '0000-00-00', '0000-00-00', 'yes'),
(100075, 'krissy', '', 'ofarrell', '0000-00-00', 'ofarrek100075', '$5$pPngCOXyG2wZlqOR$G6UP2HsFY7Y/FLbv4JukLRp7xD1IG.ucvTs7dHR6dJC', 'pPngCOXyG2wZlqORDoCs', '', '', 0, 0, 0, '4', 'm', 0, '', '', NULL, NULL, 'yes', '0000-00-00', '0000-00-00', 'yes'),
(100074, 'krissy', '', 'ofarrell', '0000-00-00', 'ofarrek100074', '$5$st5ZFlKUZ2LiBMah$IB9mr5nCNCRXMsxbjdZ3CF5FLZP3DwMFwJCc0X9KyT9', 'st5ZFlKUZ2LiBMah3CAn', '', '', 0, 0, 0, '4', 'm', 0, '', '', NULL, NULL, 'yes', '0000-00-00', '0000-00-00', 'yes'),
(100078, 'Krissy', 'gerardagh', 'Ofarrell', '2013-06-11', 'OfarreK100078', '$5$EarIE1IGgpKo8jCE$DW4sXk2.cjyOOGjKOtqd647VYbKjgFqRoyBywxaCegB', 'EarIE1IGgpKo8jCEpmpq', '', '4 Moira Street', 4055, 2147483647, 2147483647, '4', 'f', 0, 'everything', 'krissy.ofarrell@gmail.com', NULL, NULL, 'yes', '0000-00-00', '0000-00-00', 'no'),
(100079, 'Kristen', 'sadiofh', 'sdh', '2014-04-08', 'sdhK100079', '$5$PwKFOynqWB8ol8eH$8bU5JLY0h2qz.DwqES9in0KmZgPmDx5aCPHzBRiQP39', 'PwKFOynqWB8ol8eH27nJ', '', '4 Moira Street', 4055, 2147483647, 2147483647, '2', 'm', 0, 'nothing', 'krissy.ofarrell@gmail.com', NULL, NULL, 'yes', '0000-00-00', '0000-00-00', 'no'),
(100076, 'Peter', 'Alexander', 'Cole', '1986-03-12', 'ColeP100076', '$5$EALAnKGI3nzMOJ4x$p5zPzqaxNDL2aEg7DN8UaZptV25AIagYw.3DsEcyP9.', 'EALAnKGI3nzMOJ4xCrZr', '', '42 Eatons Crossing Rd, Eatons Hill, QLD', 4037, 733561849, 431365897, '6', 'm', 0, 'Russian', 'p.awesome@gmail.com', NULL, NULL, 'yes', '0000-00-00', '0000-00-00', 'yes'),
(100077, 'John', 'Malcolm', 'Carmody', '1963-02-01', 'CarmodJ100077', '$5$HwfIp8Ygtrn3Pfx6$W7A52OnjFrHi3Y9gDcZ2bsvWzGr7xwKlZNXTQ5CYQR2', 'HwfIp8Ygtrn3Pfx6I2I6', '', '5 Testing St, McDowall, QLD', 4053, 738894556, 416789456, '3', 'f', 0, 'None', 'j.carmody@gmail.com', NULL, NULL, 'yes', '0000-00-00', '0000-00-00', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `triage_category`
--

CREATE TABLE IF NOT EXISTS `triage_category` (
  `triage_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `short_description` varchar(12) NOT NULL,
  `long_description` varchar(50) NOT NULL,
  PRIMARY KEY (`triage_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `triage_category`
--

INSERT INTO `triage_category` (`triage_category_id`, `short_description`, `long_description`) VALUES
(1, 'Category 1', 'Immediately life-threatening patients'),
(2, 'Category 2', 'Imminently life-threatening patients'),
(3, 'Category 3', 'Potentially life-threatening patients'),
(4, 'Category 4', 'Potentially serious patients'),
(5, 'Category 5', 'Less urgent patients');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE IF NOT EXISTS `wards` (
  `ward_id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'pk',
  `ward_description` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL COMMENT 'fk',
  `number_of_beds` int(4) NOT NULL,
  `ward_prefix` char(8) DEFAULT NULL,
  PRIMARY KEY (`ward_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`ward_id`, `ward_description`, `department_id`, `number_of_beds`, `ward_prefix`) VALUES
(11, 'ENT recovery ward', 209, 20, 'RECOV'),
(10, 'ENT surgery ward', 209, 20, 'SURG'),
(9, 'ENT pre-surgery ward', 209, 20, 'PRESURG'),
(8, 'Cardiology general ward', 204, 20, 'GENR'),
(7, 'Cardiology recovery ward', 204, 20, 'RECOV'),
(6, 'Cardiology surgery ward', 204, 20, 'SURG'),
(5, 'Cardiology pre-surgery ward', 204, 20, 'PRESURG'),
(12, 'ENT general ward', 209, 20, 'GENR'),
(13, 'General pre-surgery ward', 211, 20, 'PRESURG'),
(14, 'General  surgery ward', 211, 20, 'SURG'),
(15, 'General  recovery ward', 211, 20, 'RECOV'),
(16, 'General  general ward', 211, 20, 'GENR'),
(17, 'Neurology pre-surgery ward', 215, 20, 'PRESURG'),
(18, 'Neurology  surgery ward', 215, 20, 'SURG'),
(19, 'Neurology  recovery ward', 215, 20, 'RECOV'),
(20, 'Neurology general ward', 215, 20, 'GENR'),
(21, 'Oncology pre-surgery ward', 219, 20, 'PRESURG'),
(22, 'Oncology  surgery ward', 219, 20, 'SURG'),
(23, 'Oncology  recovery ward', 219, 20, 'RECOV'),
(24, 'Oncology general ward', 219, 20, 'GENR'),
(25, 'Orthopaedics pre-surgery ward', 220, 20, 'PRESURG'),
(26, 'Orthopaedics  surgery ward', 220, 20, 'SURG'),
(27, 'Orthopaedics recovery ward', 220, 20, 'RECOV'),
(28, 'Orthopaedics general ward', 220, 20, 'GENR'),
(29, 'Radiotherapy pre-surgery ward', 222, 20, 'PRESURG'),
(30, 'Radiotherapy  surgery ward', 222, 20, 'SURG'),
(31, 'Radiotherapy recovery ward', 222, 20, 'RECOV'),
(32, 'Radiotherapy general ward', 222, 20, 'GENR'),
(33, 'Urology pre-surgery ward', 226, 20, 'PRESURG'),
(34, 'Urology  surgery ward', 226, 20, 'SURG'),
(35, 'Urology recovery ward', 226, 20, 'RECOV'),
(36, 'Urology general ward', 226, 20, 'GENR');
