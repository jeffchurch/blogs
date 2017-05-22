CREATE TABLE `jchurch_db`.`bloggers` ( `blogger_id` INT(35) NOT NULL AUTO_INCREMENT , `username` VARCHAR(35) NOT NULL , `password` VARCHAR(35) NOT NULL , `picture` VARCHAR(35) NOT NULL , UNIQUE (`blogger_id`) ) ENGINE = MyISAM

//creates bloggers table

CREATE TABLE `jchurch_db`.`blogs` ( `blog_id` INT(25) NOT NULL AUTO_INCREMENT , `blog_title` VARCHAR(80) NOT NULL , `blog_text` VARCHAR(1000) NOT NULL , `blogger_id` INT(25) NOT NULL , PRIMARY KEY (`blog_id`) ) ENGINE = MyISAM;

//creates blogs table

ALTER TABLE `bloggers` ADD `bio` VARCHAR(1000) NOT NULL ;
//had to edit bloggers


ALTER TABLE `blogs` ADD `blog_date` DATE NOT NULL ;
//had to add blog dates