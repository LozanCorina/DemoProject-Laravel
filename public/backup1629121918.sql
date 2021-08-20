

CREATE TABLE `demo_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignee` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `milestone_id` int(11) DEFAULT NULL,
  `is_complete_yn` varchar(1) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `demo_tasks_uk` (`project_id`,`name`),
  KEY `demo_tasks_team_member_idx` (`assignee`),
  KEY `demo_tasks_project_idx` (`project_id`),
  KEY `demo_tasks_milestone_idx` (`milestone_id`),
  CONSTRAINT `demo_tasks_milestone_fk` FOREIGN KEY (`milestone_id`) REFERENCES `demo_milestones` (`id`) ON DELETE SET NULL,
  CONSTRAINT `demo_tasks_project_fk` FOREIGN KEY (`project_id`) REFERENCES `demo_projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `demo_tasks_team_member_fk` FOREIGN KEY (`assignee`) REFERENCES `demo_team_members` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO demo_tasks VALUES("2","5","Identify Server Requirements","Determine which Oracle Databases will be used to install Oracle Application Express for Development, QA, and Production. 
          Also specify which Web Listeners will be used for the three environments.","1","","Y","2021-07-23 18:08:55","2021-07-14 18:08:55","0000-00-00 00:00:00","","0000-00-00 00:00:00","");
INSERT INTO demo_tasks VALUES("3","12","Configure Web Listeners","Configure the three Web Listeners for Application Express to support the Dev, QA, and Prod environments.","1","","N","2014-12-01 00:00:00","2014-12-15 00:00:00","","","","");
INSERT INTO demo_tasks VALUES("4","5","Install Application Express","Install the latest version of Application Express from OTN (http://www.oracle.com/technetwork/developer-tools/apex/downloads/index.html) into the Oracle Databases for Development, QA, and Production.
        Note: FOr QA and Production Application Express should be configured as \"run time\" only.","1","","Y","2014-12-01 00:00:00","2014-12-15 00:00:00","","","","");
INSERT INTO demo_tasks VALUES("5","5","Define Workspaces","Define workspaces needed for different application development teams.
        It is important that access be granted to the necessary schemas and/or new schemas created as appropriate.
        Then export these workspaces and import them into QA and Prod environments.","1","","Y","2014-12-01 00:00:00","2014-12-09 00:00:00","","","","");
INSERT INTO demo_tasks VALUES("6","5","Assign Workspace Administrators","In development assign a minimum of two Workspace administators to each workspace.
      These administrators will then be responsible for maintaining developer access within their own workspaces.","1","","N","2014-12-01 00:00:00","2014-12-19 00:00:00","","","","");
INSERT INTO demo_tasks VALUES("8","6","Prepare Course Outline","Creation of the training syllabus","2","1","Y","2014-12-01 00:00:00","2014-12-11 00:00:00","","","","");
INSERT INTO demo_tasks VALUES("9","6","Write Training Guide","Produce the powerpoint deck (with notes) for the training instructor.","2","1","N","2014-12-21 00:00:00","2014-12-29 00:00:00","","","","");
INSERT INTO demo_tasks VALUES("10","6","Develop Training Exercises","Create scripts for sample data and problem statements with solutions.","2","1","Y","2014-12-01 00:00:00","2014-12-21 00:00:00","","","","");
INSERT INTO demo_tasks VALUES("11","6","Conduct Train-the-Trainer session","Give the training material to the selected developers.","2","1","Y","2021-12-11 00:00:00","2014-12-21 00:00:00","","","2021-07-27 08:26:57","");
INSERT INTO demo_tasks VALUES("13","3","test1","test","2","1","Y","2021-07-27 00:00:00","2021-08-03 00:00:00","2021-07-27 08:28:57","","2021-07-27 08:28:57","");



