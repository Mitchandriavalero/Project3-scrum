DROP DATABASE IF EXISTS project3;

CREATE DATABASE Project3;

USE Project3;

CREATE TABLE `Employees` (
	  id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    employeeNumber VARCHAR(50) NOT NUll,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    extension VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    officecode VARCHAR(50) NOT NULL,
  	reportsTo VARCHAR(50) NOT NULL,
    jobtitle VARCHAR(50) NOT NULL
);

CREATE TABLE `Offices` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    officeCode VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    addressLine1 VARCHAR(50) NOT NULL,
    addressLine2 VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    postalCode VARCHAR(50) NOT NULL,
    territory VARCHAR(50) NOT NULL
)
