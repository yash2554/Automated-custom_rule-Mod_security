-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2015 at 06:18 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `custom_tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminuser`
--

CREATE TABLE IF NOT EXISTS `adminuser` (
  `id` int(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_question` varchar(100) NOT NULL,
  `user_answer` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminuser`
--

INSERT INTO `adminuser` (`id`, `user_name`, `user_email`, `user_question`, `user_answer`, `user_pass`) VALUES
(1, 'indus_admin', 'info@indusface.com', 'Who made this tool ?', 'Y''Ash', 'Ifc@1234');

-- --------------------------------------------------------

--
-- Table structure for table `rule_template`
--

CREATE TABLE IF NOT EXISTS `rule_template` (
  `vul_num` int(11) NOT NULL AUTO_INCREMENT,
  `vul_name` longtext NOT NULL,
  `vul_description` longtext NOT NULL,
  `vul_rule` longtext NOT NULL,
  `vul_para` longtext NOT NULL,
  `vul_parahint` longtext NOT NULL,
  PRIMARY KEY (`vul_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `rule_template`
--

INSERT INTO `rule_template` (`vul_num`, `vul_name`, `vul_description`, `vul_rule`, `vul_para`, `vul_parahint`) VALUES
(1, 'Threshold Based DOS/DDOS', 'If the user is visiting pages (not individual files like images, movies, downloading files) with ratio of 30 hits/sec then we will categorize this as a bot or crawler behavior and we will block that IP for 5 minutes.\r\n\r\nThis is a good rule to block slow rate HTTP DoS/DDoS attack (i.e. DoS with slowloris tool). In this kind of attack , attacking tool will keep high number of open connection in ''READ'' state, means it will only make high number of connections to the actual website but after getting connection , it is not hitting server with GET, POST or any other apache method. So it''s a waste of number of connection as well as CPU, Memory and bandwidth cycle.\r\nAbove rule defines number of maximum allowed connection in ''READ'' state (for safety , we allowed only 10 connection in READ state).\r\nIf any single user tries to make READ state connection with server more than five times 5 times then we are treating that user as a legitimate attacker and blocking\r\nhim/her.', 'SecRule REQUEST_BASENAME "!(\\.avi$|\\.bmp$|\\.css$|\\.doc$|\\.flv$|\\.gif$|\\.ico$|\\.jpg$|\\.js$|\\.mp3$|\\.mpeg$|\\.pdf$|\\.png$|\\.pps$|\\.ppt$|\\.swf$|\\.txt$|\\.wmv$|\\.xls$|\\.xml$|\\.zip$)" "phase:1,nolog,pass,initcol:ip=%{REMOTE_ADDR},setvar:ip.requests=+1,expirevar:ip.requests=REQUEST_TIME,id:12020"\r\nSecRule ip:requests "@ge MAX_COUNT" "phase:1,nolog,pass,initcol:ip=%{REMOTE_ADDR},setvar:ip.block=+1,expirevar:ip.block=BLOCK_TIME,id:12022"\r\nSecRule ip:block "@rx SCENARIOBASED_REGEX" "phase:1,pass,log,logdata:''Possible DoS/DDoS req/min: %{ip.requests}'',id:12026,initcol:ip=%{REMOTE_ADDR},setvar:ip.blocking=+1,expirevar:ip.blocking=BLOCK_TIME"\r\nSecRule ip:blocking "@ge 1" "phase:1,ACTION,nolog,id:12028"', '{"REQUEST_TIME"}{"MAX_COUNT"}{"SCENARIOBASED_REGEX"}{"BLOCK_TIME"}{"ACTION"}', '{"60,120(In Second)"}{"10,15(Threshold Count)"}{"+05  -> ^([15]|[1-9][05]|[1-9][0-9][05]|1000)$\r\n+05  - Logs every fifth request i.e. 5,10,15,20... upto 1000"}{"120,200(In Second)"}{"pass,deny,drop"}'),
(2, 'Email Ids Can Be Harvested For Spamming', 'The web site displays email addresses on publicly available pages in clear text.Automated programs called bots could be used to harvest these email addresses and then used as targets for spamming.e.g. example.demo@indusface.com\r\n\r\nRule Behaviour : Replace email-id'' string into Specific format like, " example[dot]demo[at]indusface[dot]com "\r\nBy obfuscating email addresses using Specific format like, " example[dot]demo[at]indusface[dot]com " we can be protected from bots.', 'SecRule REQUEST_BASENAME "!(\\.avi$|\\.bmp$|\\.css$|\\.doc$|\\.flv$|\\.gif$|\\.ico$|\\.jpg$|\\.js$|\\.mp3$|\\.mpeg$|\\.pdf$|\\.png$|\\.pps$|\\.ppt$|\\.swf$|\\.txt$|\\.wmv$|\\.xls$|\\.xml$|\\.zip$)" "id:20010,phase:4,log,ACTION,initcol:ip=%{REMOTE_ADDR},setvar:ip.VARIABLE=+1,expirevar:ip.VARIABLE=60,chain,msg:''Obfuscating Email Address: iol@indusind.com,Counts: %{MATCHED_VAR}''"\r\nSecRule RESPONSE_BODY "EMAIL_ID" "chain"\r\nSecRule STREAM_OUTPUT_BODY "@rsub s/EMAIL_ID/OBS_EMAILID/" "chain,log,capture"\r\nSecRule ip:VARIABLE "@rx ^(?:(1|10))$"', '{"VARIABLE"}{"EMAIL_ID"}{"OBS_EMAILID"}{"ACTION"}', '{"emailone,emailtwo,emailthree(EMAIL VARIABLE)"}{"info@indusface.com"}{"info@indusface.com/info[at]indusface[dot]com"}{"pass"}'),
(3, 'Error message reveal sensitive information Policy', 'The software generates an error message that includes sensitive information about its environment, users, or associated data.\r\n\r\nRevealing system data or debugging information helps an adversary learn about the system and form a plan of attack. An information leak occurs when system data or debugging information leaves the program through an output stream or logging function.', 'SecRule REQUEST_BASENAME "!(\\.avi$|\\.bmp$|\\.css$|\\.doc$|\\.flv$|\\.gif$|\\.ico$|\\.jpg$|\\.js$|\\.mp3$|\\.mpeg$|\\.pdf$|\\.png$|\\.pps$|\\.ppt$|\\.swf$|\\.txt$|\\.wmv$|\\.xls$|\\.xml$|\\.zip$)" "id:20011,phase:4,log,ACTION,initcol:ip=%{REMOTE_ADDR},setvar:ip.ERRORVARIABLE=+1,expirevar:ip.ERRORVARIABLE=REQUEST_TIME,chain,msg:''Hiding Sensitive Server Errors/Information, Counts: %{MATCHED_VAR}''"\r\nSecRule RESPONSE_BODY "Server Error in" "chain"\r\nSecRule STREAM_OUTPUT_BODY "@rsub s/Server Error in ''\\/'' Application/CUSTOM_ERROR_MESSAGE/" "chain,log,capture"\r\nSecRule ip:error1 "@rx ^(?:(1|10))$"', '{"ERRORVARIABLE"}{"REQUEST_TIME"}{"ACTION"}', '{"error1,error2,error3(VARIABLE)"}{"60,120(In Seconds)"}{"pass"}'),
(4, 'Geo Location Black Listing Policy', 'Geo_Location Description:\r\n \r\nModSecurity supports using geolocation data through the integration with the free MaxMind GeoLite Country or GeoLite City databases.\r\nWhen this rule is executed, the GEO variable collection data will be populated with the data extracted from the GeoIP DB.\r\n \r\nBlack-listing for Specific Country:\r\nIf clients only come from some specific geographic regions, Created rule would block all clients who are coming from <ISO_Country-Code> Specific Country.', 'SecRule REMOTE_ADDR "@geoLookup" "log,chain,id:10016,status:406,phase:1,deny,msg:''Black-Listed Country IP tried to access Website'',logdata:''%{geo.country_code}''"\r\nSecRule GEO:COUNTRY_CODE "!@pm GEO_CODE"', '{"GEO_CODE"}', '{"NO CH AU BE"}'),
(5, 'Geo Location White Listing Policy', 'Geo_Location Description:\r\n \r\nModSecurity supports using geolocation data through the integration with the free MaxMind GeoLite Country or GeoLite City databases.\r\nWhen this rule is executed, the GEO variable collection data will be populated with the data extracted from the GeoIP DB.\r\n \r\nWhite-listing for Specific Country:\r\nIf clients only come from some specific geographic regions, Created rule would block clients who are not coming from <ISO_Country-Code> Specific Country.', 'SecRule REMOTE_ADDR "@geoLookup" "log,chain,id:10016,status:406,phase:1,deny,msg:''White-Listed Country IP tried to access Website'',logdata:''%{geo.country_code}''"\r\nSecRule GEO:COUNTRY_CODE "@pm GEO_CODE"', '{"GEO_CODE"}', '{"NO CH AU BE"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_question` varchar(100) NOT NULL,
  `user_answer` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_question`, `user_answer`, `user_pass`) VALUES
(1, 'yash2554', 'yash2554@gmail.com', 'for whom ?', 'for mss', 'Yash2554'),
(2, 'priya2554', 'priyaparmar@gmail.com', 'who are you', 'my friend', 'Yash2554');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
