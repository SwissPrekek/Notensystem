-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema notensystem
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema notensystem
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `notensystem` DEFAULT CHARACTER SET utf8 ;
USE `notensystem` ;

-- -----------------------------------------------------
-- Table `notensystem`.`faecher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notensystem`.`faecher` (
  `idFaecher` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFaecher`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `notensystem`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notensystem`.`users` (
  `idUsers` INT(11) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsers`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `notensystem`.`pruefung`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notensystem`.`pruefung` (
  `idPruefung` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `grade` DOUBLE NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `Users_idUsers` INT(11) NOT NULL,
  `Faecher_idFaecher` INT(11) NOT NULL,
  PRIMARY KEY (`idPruefung`),
  INDEX `Users_idUsers` (`Users_idUsers` ASC),
  INDEX `Faecher_idFaecher` (`Faecher_idFaecher` ASC),
  CONSTRAINT `pruefung_ibfk_1`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `notensystem`.`users` (`idUsers`),
  CONSTRAINT `pruefung_ibfk_2`
    FOREIGN KEY (`Faecher_idFaecher`)
    REFERENCES `notensystem`.`faecher` (`idFaecher`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
