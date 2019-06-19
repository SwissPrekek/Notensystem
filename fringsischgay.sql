-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema notensystem
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `notensystem` ;

-- -----------------------------------------------------
-- Schema notensystem
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `notensystem` DEFAULT CHARACTER SET utf8 ;
USE `notensystem` ;

-- -----------------------------------------------------
-- Table `notensystem`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `notensystem`.`Users` ;

CREATE TABLE IF NOT EXISTS `notensystem`.`Users` (
  `idUsers` INT NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `emaill` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notensystem`.`Semester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `notensystem`.`Semester` ;

CREATE TABLE IF NOT EXISTS `notensystem`.`Semester` (
  `idSemester` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSemester`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notensystem`.`Faecher`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `notensystem`.`Faecher` ;

CREATE TABLE IF NOT EXISTS `notensystem`.`Faecher` (
  `idFaecher` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFaecher`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notensystem`.`Pruefung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `notensystem`.`Pruefung` ;

CREATE TABLE IF NOT EXISTS `notensystem`.`Pruefung` (
  `idPruefung` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `grade` DOUBLE NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `Users_idUsers` INT NOT NULL,
  `Faecher_idFaecher` INT NOT NULL,
  `Semester_idSemester` INT NOT NULL,
  PRIMARY KEY (`idPruefung`),
  INDEX `fk_Pruefung_Users_idx` (`Users_idUsers` ASC),
  INDEX `fk_Pruefung_Faecher1_idx` (`Faecher_idFaecher` ASC),
  INDEX `fk_Pruefung_Semester1_idx` (`Semester_idSemester` ASC),
  CONSTRAINT `fk_Pruefung_Users`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `notensystem`.`Users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pruefung_Faecher1`
    FOREIGN KEY (`Faecher_idFaecher`)
    REFERENCES `notensystem`.`Faecher` (`idFaecher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pruefung_Semester1`
    FOREIGN KEY (`Semester_idSemester`)
    REFERENCES `notensystem`.`Semester` (`idSemester`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
