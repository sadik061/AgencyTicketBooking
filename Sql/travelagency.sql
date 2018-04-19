--
-- Database: `travel_agency_management`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_Name` varchar(255) NOT NULL,
  `user_PhoneNo` varchar(255) NOT NULL,
  `user_Email` varchar(255) NOT NULL,
  `user_Password` varchar(255) NOT NULL,
  `user_Role` varchar(255) NOT NULL,
  `user_Input_Time` datetime DEFAULT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `airlines` (
  `airlines_id` int(11) NOT NULL AUTO_INCREMENT,
  `airlines_Name` varchar(255) DEFAULT NULL,
  `airlines_Point` int(11) DEFAULT NULL,
  `airlines_Entry_By` int(11) NOT NULL,
  `airlines_Input_Time` datetime DEFAULT NULL,
  PRIMARY KEY (airlines_id),
  foreign key (airlines_Entry_By) references user(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `agent` (
  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_Name` varchar(255) DEFAULT NULL,
  `agent_PhoneNo` varchar(255) DEFAULT NULL,
  `agent_Entry_By` int(11) NOT NULL,
  `agent_Input_Time` datetime DEFAULT NULL,
  PRIMARY KEY (agent_id),
  foreign key (agent_Entry_By) references user(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `capping` (
  `capping_id` int(11) NOT NULL AUTO_INCREMENT,
  `capping_Amount` double DEFAULT NULL,
  `capping_Airlines` int(11) NOT NULL,
  `capping_Payment_By` varchar(255) DEFAULT NULL,
  `capping_MCD_No` varchar(255) DEFAULT NULL,
  `capping_Date` date DEFAULT NULL,
  `capping_Entry_By` int(11) NOT NULL,
  `capping_Input_Time` datetime DEFAULT NULL,
  PRIMARY KEY (capping_id),
  foreign key (capping_Entry_By) references user(user_id),
  foreign key (capping_Airlines) references airlines(airlines_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `maindata` (
  `maindata_id` int(11) NOT NULL AUTO_INCREMENT,
  `maindata_Name` varchar(255) DEFAULT NULL,
  `maindata_PhoneNo` varchar(255) DEFAULT NULL,
  `maindata_Fare` int(11) DEFAULT NULL,
  `maindata_Paid` int(11) DEFAULT NULL,
  `maindata_Due` int(11) DEFAULT NULL,
  `maindata_Commission` int(11) DEFAULT NULL,
  `maindata_Entry_By` int(11) NOT NULL,
  `maindata_Input_Time` datetime DEFAULT NULL,
  `maindata_Ticket_By` int(11) NOT NULL,
  `maindata_Comment` varchar(255) DEFAULT NULL,
  `maindata_Point` int(11) DEFAULT NULL,
  `maindata_Date` date DEFAULT NULL,
  `maindata_Flown_Date` datetime DEFAULT NULL,
  `maindata_Pnr` varchar(255) DEFAULT NULL,
  `maindata_Pax` int(11) DEFAULT NULL,
  `maindata_Route` varchar(255) DEFAULT NULL,
  `maindata_Airlines` int(11) NOT NULL,
  PRIMARY KEY (maindata_id),
  foreign key (maindata_Entry_By) references user(user_id),
  foreign key (maindata_Ticket_By) references agent(agent_id),
  foreign key (maindata_Airlines) references airlines(airlines_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


