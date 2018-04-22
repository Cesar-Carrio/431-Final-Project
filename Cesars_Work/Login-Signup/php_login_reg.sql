-- Schema php_login_reg
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema php_login_reg
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `php_login_reg` DEFAULT CHARACTER SET utf8 ;
USE `php_login_reg` ;

-- -----------------------------------------------------
-- Table `php_login_reg`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_login_reg`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NULL,
  `last_name` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `salt` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
