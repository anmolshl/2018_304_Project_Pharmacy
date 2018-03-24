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
  (drug_name CHAR(100) NOT NULL,
  drugType CHAR(2) NOT NULL;
  quantity INTEGER NOT NULL,
  manufacturer CHAR(100) NOT NULL,
  max_dosage INTEGER NOT NULL,
  illness_name CHAR(100) NOT NULL,
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

CREATE TABLE Prescription
  (refill INTEGER NOT NULL,
  expiration DATE NOT NULL,
  customer_number INTEGER NOT NULL,
  username CHAR(16) NOT NULL,
  prescription_number INTEGER NOT NULL,
  issued_date DATE NOT NULL,
  PRIMARY KEY(prescription_number),
  FOREIGN KEY(customer_number, username) REFERENCES Customer(customer_number, username));

CREATE TABLE pharmacist_writes_prescription
  (employee_id INTEGER NOT NULL,
  prescription_number INTEGER NOT NULL,
  PRIMARY KEY(employee_id, prescription_number),
  FOREIGN KEY(employee_id) REFERENCES Pharmacist(employee_id),
  FOREIGN KEY(prescription_number) REFERENCES Prescription(prescription_number)
  ON DELETE CASCADE);

CREATE TABLE drug_cures_illness
  (illness_name CHAR(20),
  drug_name CHAR(20),
  PRIMARY KEY(illness_name, drug_name),
  FOREIGN KEY(illness_name) REFERENCES Illness(illness_name),
  FOREIGN KEY(drug_name) REFERENCES Drugs(drug_name));

CREATE TABLE drug_has_warning
  (warning CHAR(30) NOT NULL,
  drug_name CHAR(100) NOT NULL,
  FOREIGN KEY(drug_name) REFERENCES Drugs(drug_name)
  ON DELETE CASCADE,
  FOREIGN KEY(warning) REFERENCES Warning(warning),
  PRIMARY KEY(warning, drug_name));

CREATE TABLE Illness_has_symptom
  (symptom CHAR(30) NOT NULL,
  illness_name CHAR(20) NOT NULL,
  PRIMARY KEY(symptom, illness_name),
  FOREIGN KEY(symptom) REFERENCES Symptom(symptom)
  ON DELETE CASCADE,
  FOREIGN KEY(illness_name) REFERENCES Illness(illness_name));

CREATE TABLE drugs_has_side_effects
  (effect CHAR(30) NOT NULL,
  drug_name CHAR(100) NOT NULL,
  PRIMARY KEY(effect, drug_name),
  FOREIGN KEY(effect) REFERENCES Side_effects(effect)
  ON DELETE CASCADE,
  FOREIGN KEY(drug_name) REFERENCES Drugs(drug_name));

CREATE TABLE stock_stores_drugs
  (quantity INTEGER NOT NULL,
  stock_ID INTEGER NOT NULL,
  drug_name CHAR(100) NOT NULL,
  FOREIGN KEY(stock_ID) REFERENCES Stock(stock_ID),
  FOREIGN KEY(drug_name) REFERENCES Drugs(drug_name),
  PRIMARY KEY(stock_ID));

CREATE TABLE stores_contains_stocks
  (stock_ID INTEGER NOT NULL,
  store_location CHAR(20) NOT NULL,
  store_address CHAR(30) NOT NULL,
  PRIMARY KEY(stock_ID, store_location, store_address),
  FOREIGN KEY(stock_ID) REFERENCES Stock(stock_ID),
  FOREIGN KEY(store_location, store_address) REFERENCES Store(store_location, store_address));

CREATE TABLE Prescription_orders
  (store_location CHAR(20) NOT NULL,
  username CHAR(16) NOT NULL,
  store_address CHAR(30) NOT NULL,
  drug_name CHAR(100) NOT NULL,
  refill INTEGER NOT NULL,
  expiration DATE NOT NULL,
  customer_number INTEGER NOT NULL,
  prescription_number INTEGER NOT NULL,
  issued_date DATE NOT NULL,
  dosage INTEGER NOT NULL,
  FOREIGN KEY(customer_number, username) REFERENCES Customer(customer_number, username)
  ON DELETE CASCADE,
  FOREIGN KEY(store_location, store_address) REFERENCES Store(store_location, store_address),
  FOREIGN KEY(drug_name) REFERENCES Drugs(drug_name),
  PRIMARY KEY(prescription_number));

CREATE TABLE customer_has_prescription
  (customer_number INTEGER NOT NULL,
  username CHAR(16) NOT NULL,
  prescription_number INTEGER NOT NULL,
  PRIMARY KEY(customer_number, prescription_number),
  FOREIGN KEY(customer_number, username) REFERENCES Customer(customer_number, username),
  FOREIGN KEY(prescription_number) REFERENCES Prescription(prescription_number));
