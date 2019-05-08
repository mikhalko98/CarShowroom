CREATE TABLE CarShowrooms
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(50) NOT NULL,
    address VARCHAR(10) NOT NULL
);
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
    id_position INT,
    FOREIGN KEY (id_position) REFERENCES positions (id)
);
CREATE TABLE customers
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name  VARCHAR(50) NOT NULL,
    patronymic VARCHAR(50) NOT NULL,
    email      VARCHAR(50),
    address    VARCHAR(100),
    telephone  VARCHAR(13)
);
CREATE TABLE images
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    contenttype INT,
    imagedate BLOB NOT NULL
);
CREATE TABLE complectations
(
    id INT AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE car
(
    id                     INT AUTO_INCREMENT PRIMARY KEY,
    mark                   VARCHAR(30) NOT NULL,
    model                  varchar(30) NOT NULL,
    yearOfIssue            INT(4)      NOT NULL,
    price                  INT         NOT NULL,
    mileage                INT         NOT NULL,
    id_photo                  INT,
    num_Tech_pass          INT         NOT NULL,
    num_Push_sale_document INT         NOT NULL,
    id_complectation       INT,
    FOREIGN KEY (id_photo) REFERENCES images (id),
    FOREIGN KEY (id_complectation) REFERENCES complectations (id)
);
CREATE TABLE supplies
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    id_car         INT         NOT NULL,
    id_employee    INT         NOT NULL,
    id_costumer    INT         NOT NULL,
    date_supple    DATE,
    price          INT         NOT NULL,
    form_payment   varchar(30) NOT NULL,
    number_account varchar(50) NOT NULL,
    FOREIGN KEY (id_car) REFERENCES car (id),
    FOREIGN KEY (id_employee) REFERENCES employees (id),
    FOREIGN KEY (id_costumer) REFERENCES customers (id)
);
CREATE TABLE sales
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    id_car         INT         NOT NULL,
    id_employee    INT         NOT NULL,
    id_costumer    INT         NOT NULL,
    date_supple    DATE,
    price          INT         NOT NULL,
    form_payment   varchar(30) NOT NULL,
    number_account varchar(50) NOT NULL,
    FOREIGN KEY (id_car) REFERENCES car (id),
    FOREIGN KEY (id_employee) REFERENCES employees (id),
    FOREIGN KEY (id_costumer) REFERENCES customers (id)
);