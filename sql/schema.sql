CREATE TABLE positions
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);
CREATE TABLE employees
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    first_name  VARCHAR(50) NOT NULL,
    last_name   VARCHAR(50) NOT NULL,
    patronymic  VARCHAR(50) NOT NULL,
    email       VARCHAR(50),
    address     VARCHAR(100),
    telephone   VARCHAR(13),
    id_position INT NOT NULL ,
    FOREIGN KEY (id_position) REFERENCES positions (id),
    UNIQUE (telephone)
);
CREATE TABLE customers
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name  VARCHAR(50) NOT NULL,
    patronymic VARCHAR(50) NOT NULL,
    email      VARCHAR(50),
    address    VARCHAR(100) DEFAULT NULL,
    telephone  VARCHAR(13),
    UNIQUE (email, telephone)
);
CREATE TABLE colors(
  color VARCHAR(20) PRIMARY KEY
);
CREATE TABLE fuels(
  fuel VARCHAR(20) PRIMARY KEY
);
CREATE TABLE engine_capacities(
  engine_capacity INT PRIMARY KEY
);
CREATE TABLE transmissions(
  transmission VARCHAR(30) PRIMARY KEY
);
CREATE TABLE auto_drives(
  auto_drive VARCHAR(20) PRIMARY KEY
);
CREATE TABLE body_styles(
    body_style VARCHAR(30) PRIMARY KEY
);

CREATE TABLE complectations
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    color VARCHAR(20),
    fuel VARCHAR(20),
    engine_capacity INT,
    transmission VARCHAR(30),
    auto_drive VARCHAR(20),
    body_style VARCHAR(30),
    FOREIGN KEY (color) REFERENCES colors(color),
    FOREIGN KEY (fuel) REFERENCES fuels(fuel),
    FOREIGN KEY (engine_capacity) REFERENCES engine_capacities(engine_capacity),
    FOREIGN KEY (transmission) REFERENCES transmissions(transmission),
    FOREIGN KEY (auto_drive) REFERENCES auto_drives(auto_drive),
    FOREIGN KEY (body_style) REFERENCES body_styles(body_style)
);
CREATE TABLE cars
(
    id                     INT AUTO_INCREMENT PRIMARY KEY,
    there_is               BOOLEAN NOT NULL,
    mark                   VARCHAR(30) NOT NULL,
    model                  varchar(30) NOT NULL,
    yearOfIssue            INT(4)      NOT NULL,
    price                  INT         NOT NULL,
    mileage                INT         NOT NULL,
    num_Tech_pass          VARCHAR(10) NOT NULL,
    num_Push_sale_document INT         NOT NULL,
    id_complectation       INT,
    FOREIGN KEY (id_complectation) REFERENCES complectations (id)
);

CREATE TABLE images
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    id_car     INT NOT NULL,
    name_image VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_car) REFERENCES cars(id)
);

CREATE TABLE supplies
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    id_car         INT UNIQUE  NOT NULL,
    id_employee    INT         NOT NULL,
    id_costumer    INT         NOT NULL,
    date_supple    DATE,
    price          INT         NOT NULL,
    form_payment   varchar(30) NOT NULL,
    number_account varchar(50),
    FOREIGN KEY (id_car) REFERENCES cars (id),
    FOREIGN KEY (id_employee) REFERENCES employees (id),
    FOREIGN KEY (id_costumer) REFERENCES customers (id)
);
CREATE TABLE sales
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    id_car         INT UNIQUE  NOT NULL,
    id_employee    INT         NOT NULL,
    id_costumer    INT         NOT NULL,
    date_supple    DATE,
    price          INT         NOT NULL,
    form_payment   varchar(30) NOT NULL,
    number_account varchar(50),
    FOREIGN KEY (id_car) REFERENCES cars (id),
    FOREIGN KEY (id_employee) REFERENCES employees (id),
    FOREIGN KEY (id_costumer) REFERENCES customers (id)
);