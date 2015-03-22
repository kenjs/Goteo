ALTER TABLE user_login ADD provider_id varchar(100);
ALTER TABLE user_login DROP PRIMARY KEY;
ALTER TABLE user_login ADD PRIMARY KEY (user,provider);


ALTER TABLE template_lang ADD name tinytext;
ALTER TABLE template_lang ADD porpose tinytext;

ALTER TABLE user_personal MODIFY phone varchar(20);

CREATE TABLE `project_skill` (
  `project` varchar(50) NOT NULL,
  `skill` int(12) NOT NULL,
  UNIQUE KEY `project_category` (`project`,`skill`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `skill` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `description` text,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `parent_skill_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

CREATE TABLE `skill_lang` (
  `id` bigint(20) unsigned NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` tinytext,
  `description` text,
  UNIQUE KEY `id_lang` (`id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_skill` (
  `user` varchar(50) NOT NULL,
  `skill` int(12) NOT NULL,
  UNIQUE KEY `user_interest` (`user`,`skill`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


alter table project add evaluation TEXT;
alter table project_lang add evaluation TEXT;
