LIST

CREATE TABLE UserTab
  (username CHAR(16) NOT NULL,
  password CHAR(70) NOT NULL,
  PRIMARY KEY(username));

CREATE TABLE Customer(customer_number INTEGER NOT NULL,
  name CHAR(10) NOT NULL,
  address CHAR(30),
  dob DATE,
  username CHAR(16) NOT NULL,
  PRIMARY KEY(customer_number, username),
  FOREIGN KEY(username) REFERENCES UserTab(username));

CREATE TABLE UnregCustomer
  (customer_number INTEGER NOT NULL,
  username CHAR(16) NOT NULL,
  PRIMARY KEY(customer_number, username),
  FOREIGN KEY(customer_number, username) REFERENCES Customer(customer_number, username)
  ON DELETE CASCADE);

CREATE TABLE RegCustomer
  (customer_number INTEGER NOT NULL,
  username CHAR(16) NOT NULL,
  PRIMARY KEY(customer_number, username),
  FOREIGN KEY(customer_number, username) REFERENCES Customer(customer_number, username)
  ON DELETE CASCADE);

CREATE TABLE Drugs
  (drug_name CHAR(20) NOT NULL,
  quantity INTEGER NOT NULL,
  manufacturer CHAR(20) NOT NULL,
  max_dosage INTEGER NOT NULL,
  illness_name CHAR(20) NOT NULL,
  price INTEGER NOT NULL,
  PRIMARY KEY(drug_name));

CREATE TABLE Illness
  (illness_name CHAR(20) NOT NULL,
  pathogen CHAR(20) NOT NULL,
  duration INTEGER NOT NULL,
  PRIMARY KEY(illness_name));

CREATE TABLE Pharmtech
  (name CHAR(10) NOT NULL,
  employee_id INTEGER NOT NULL,
  username CHAR(16) NOT NULL,
  FOREIGN KEY(username) REFERENCES UserTab(username),
  PRIMARY KEY(username));

CREATE TABLE Store
  (store_location CHAR(20) NOT NULL,
  store_address CHAR(30) NOT NULL,
  PRIMARY KEY(store_location, store_address));

CREATE TABLE Stock
  (stock_ID INTEGER NOT NULL,
  PRIMARY KEY(stock_ID));

CREATE TABLE Side_effects
  (effect CHAR(30) NOT NULL,
  description CHAR(200) NOT NULL,
  PRIMARY KEY(effect));

CREATE TABLE Symptom
  (symptom CHAR(30) NOT NULL,
  description CHAR(200) NOT NULL,
  PRIMARY KEY(symptom));

CREATE TABLE Warning
  (warning CHAR(30) NOT NULL,
  description CHAR(200) NOT NULL,
  PRIMARY KEY(warning));

CREATE TABLE Pharmacist
  (username CHAR(16) NOT NULL,
  employee_id INTEGER NOT NULL,
  PRIMARY KEY(employee_id),
  FOREIGN KEY (username) REFERENCES UserTab(username));


