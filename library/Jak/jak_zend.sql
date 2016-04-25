SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `jak_zend_db` ;
CREATE SCHEMA IF NOT EXISTS `jak_zend_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `jak_zend_db` ;

-- -----------------------------------------------------
-- Table `jak_zend_db`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jak_zend_db`.`tags` (
  `tags_id` VARCHAR(50) NOT NULL COMMENT 'Tagi, słowa kluczowe opisujące tematy .\n',
  `name` VARCHAR(50) NOT NULL,
  `description` TINYTEXT NULL,
  PRIMARY KEY (`tags_id`),
  UNIQUE INDEX `table1_id_UNIQUE` (`tags_id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jak_zend_db`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jak_zend_db`.`articles` (
  `articles_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(80) NOT NULL,
  `date_added` TIMESTAMP NOT NULL,
  `date_edited` TIMESTAMP NOT NULL,
  `autor` VARCHAR(45) NOT NULL,
  `tags_id` VARCHAR(50) NOT NULL,
  `text` LONGTEXT NOT NULL,
  PRIMARY KEY (`articles_id`, `tags_id`),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC),
  INDEX `fk_articles_1_idx` (`tags_id` ASC),
  CONSTRAINT `fk_articles_1`
    FOREIGN KEY (`tags_id`)
    REFERENCES `jak_zend_db`.`tags` (`tags_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'CREATE TABLE IF NOT EXISTS `jak_zend_db`.`articles` (\n  `articles_id` INT NOT NULL AUTO_INCREMENT,\n  `title` VARCHAR(80) NOT NULL,\n  `date_added` TIMESTAMP NOT NULL,\n  `date_edited` TIMESTAMP NOT NULL,\n  `autor` VARCHAR(45) NOT NULL,\n  `tags_id` VARCHAR(50) CHARACTER SET \'utf8\' COLLATE \'utf8_unicode_ci\' NOT NULL,\n  `text` LONGTEXT NOT NULL,\n  PRIMARY KEY (`articles_id`),\n  UNIQUE INDEX `title_UNIQUE` (`title` ASC),\n  CONSTRAINT `fk_articles_1`\n    FOREIGN KEY (``)\n    REFERENCES `jak_zend_db`.`tags` ()\n    ON DELETE NO ACTION\n    ON UPDATE NO ACTION)\nENGINE = InnoDB\nDEFAULT CHARACTER SET = utf8\nCOLLATE = utf8_unicode_ci';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

CREATE USER `zend_jak`@`localhost` IDENTIFIED BY 'dupa';
GRANT ALL ON `jak_zend_db`.*  `zend_jak`@`localhost`;
