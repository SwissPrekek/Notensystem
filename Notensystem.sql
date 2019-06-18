-- MySQL Script generated by MySQL Workbench
-- Tue Jun 18 19:40:04 2019
-- Model: New Model    Version: 1.0
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
-- Table `notensystem`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notensystem`.`Users` (
  `idUsers` INT NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notensystem`.`Facher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notensystem`.`Facher` (
  `idFacher` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFacher`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notensystem`.`Semester`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notensystem`.`Semester` (
  `idSemester` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSemester`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notensystem`.`Prufung`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notensystem`.`Prufung` (
  `idPrufung` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Note` FLOAT NOT NULL,
  `Beschrieb` VARCHAR(100) NOT NULL,
  `Facher_idFacher` INT NOT NULL,
  `Users_idUsers` INT NOT NULL,
  `Semester_idSemester` INT NOT NULL,
  PRIMARY KEY (`idPrufung`),
  INDEX `fk_Prufung_Facher1_idx` (`Facher_idFacher` ASC) VISIBLE,
  INDEX `fk_Prufung_Users1_idx` (`Users_idUsers` ASC) VISIBLE,
  INDEX `fk_Prufung_Semester1_idx` (`Semester_idSemester` ASC) VISIBLE,
  CONSTRAINT `fk_Prufung_Facher1`
    FOREIGN KEY (`Facher_idFacher`)
    REFERENCES `notensystem`.`Facher` (`idFacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prufung_Users1`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `notensystem`.`Users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prufung_Semester1`
    FOREIGN KEY (`Semester_idSemester`)
    REFERENCES `notensystem`.`Semester` (`idSemester`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
