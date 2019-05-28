INSERT INTO positions(name) VALUES('Director'),('Manager'),('Oldest salesman'),('Seller');
INSERT INTO employees(first_name,last_name,patronymic,email,address,telephone,id_position)
VALUES('Nickolay','Mikhalko','Ivanovich','mikhalko98@gmail.com','Nikolaev, lagina 33, 47','+380977131426','1'),
      ('Maksim','Karatay','Vitalievich','karatay99@gmail.com','Kherson Olega-Olgicha 35, 47','+380931256842',2),
      ('Artur','Boris','Vitalievich','boris98@gmail.com','Nikolaev, prospecr Centr 854, 85','+380972698524',3),
      ('Yana','Babenko','Sergeivna','babonko@gmail.com','Odessa Olega-Olgicha 85, 26','+380977826324',4),
      ('Danyl','Antonyk','Borisovich','antonyk@gmail.com','Kherson, lagina 33, 47','+380977123688',4);
INSERT INTO customers(first_name,last_name,patronymic,email,address,telephone)
VALUES('Nazar','Gubenko','Pavlovich','gubenko45@gmail.com','Kherson Olega-Olgicha 35, 47','+380977125852'),
      ('Radion','Kapelichuk','Anreevich','kapelichuk@gmail.com','Nikolaev  8march 85, 85', '+380963212587'),
      ('Maksim','Volkov','Alekandrovich','volkov45@gmail.com','Odessa Olega-Olgicha 85, 26','+380978725852'),
      ('Ksenia','Mikhalko','Ivanovna','mikhalko.k@gmail.com','Nikolaev Olega-Olgicha 85, 26','+380978725851'),
      ('Aziz','Ogunsakin','Oleksandrivich','aziz@gmail.com','Nikolaev Sovetskay 10, 21','+380978725800'),
      ('Sergey','Forov','Oleksandrivich','forov@gmail.com','Stepovoe Sovetskay 10, 8','+380978005800'),
      ('Marina','Mikhalko','Ivanovna','mikhalko.m@gmail.com','Stepovoe Sovetskay 10, 8','+380978088800');
INSERT INTO colors(color) VALUES ('red'),('black'),('white'),('bordeaux'),('bronze'),('yellow'),('pearl'),('green'),
                                 ('goldenrod'),('gold'),('coral'),('brown'),('lemon'),('raspberry'),('copper'),('pink'),
                                 ('grey'),('blue'),('purple'),('amber');
INSERT INTO fuels(fuel) VALUES('diesel'),('benzine'),('gaz'),('benzine/gaz');
INSERT INTO engine_capacities(engine_capacity) VALUES (500),(600),(700),(800),(900),(1000),(1100),(1200),(1300),
                                                      (1400),(1500),(1600),(1700),(1800),(1900),(2000),(2100),(2200),(2300),(2400),
                                                      (2500),(2600),(2700),(2800),(2900),(3000),(3100),(3200),(3300),(3400),(3500),(3600),
                                                      (3700),(3800),(3900),(4000),(4100),(4200),(4300),(4400),(4500),(4600),(4700),(4800),(4900),
                                                      (5000),(5100),(5200),(5300),(5400),(5500),(5600),(5700),(5800),(5900),(6000),(6100),
                                                      (6200),(6300),(6400),(6500),(6600),(6700),(6800),(6900),(7000);
INSERT INTO transmissions(transmission) VALUES ('robotic'),('automatic'),('manual'),('variable');
INSERT INTO auto_drives(auto_drive) VALUES ('full'),('front'),('rear');
INSERT INTO body_styles(body_style) VALUES ('minivan'),('crossover'),('hatchback'),('sedan')
                                         ,('MPV'),('SUV'),('coupe'),('convertible');
INSERT INTO complectations(color,fuel,engine_capacity,transmission,auto_drive,body_style)
VALUES ('red','diesel',1900,'robotic','full','minivan'),
       ('black','benzine',2000,'automatic','front','crossover'),
       ('blue','diesel',2200,'automatic','front','sedan'),
       ('bronze','gaz',2500,'manual','front','hatchback'),
       ('yellow','benzine',5000,'automatic','full','sedan');
INSERT INTO cars(there_is,mark,model,yearOfIssue,price,mileage,num_Tech_pass,num_Push_sale_document,id_complectation)
VALUES (true,'Dacia','Dokker',2016,25000,91000,'DFV221254','25605',1),
       (false,'Audi','Q7',2017,37500,50500,'GFR236985',23541,2),
       (false,'Opel','Insignia',2016,15000,200000,'GFR236910',23593,3),
       (false,'Audi','Q7',2016,35000,150500,'GFR236999',10593,4),
       (true,'Maclaren','P1',2016,625000,10000,'GFR006999',10993,5);
INSERT INTO images(id_car,name_image) VALUES (1,'/var/www/CarShowRoom/photo/1.1.jpg'),
                                             (1,'/var/www/CarShowRoom/photo/1.2.jpg'),
                                             (2,'/var/www/CarShowRoom/photo/2.1.jpg'),
                                             (3,'/var/www/CarShowRoom/photo/3.1.jpg'),
                                             (4,'/var/www/CarShowRoom/photo/4.1.jpg'),
                                             (5,'/var/www/CarShowRoom/photo/5.1.jpg');
INSERT INTO supplies(id_car,id_employee,id_costumer,date_supple,price,form_payment,number_account)
VALUES (1,5,1,'2018-05-09',20000,'cash',NULL),
       (2,4,2,'2019-01-25',30000,'cashless','1236201258963214'),
       (3,3,4,'2019-01-25',12000,'cashless','1236201830963214'),
       (4,3,1,'2019-01-07',28000,'cashless','1236207130963214'),
       (5,3,7,'2018-10-25',500000,'cashless','1236207130963214');
INSERT INTO sales(id_car,id_employee,id_costumer,date_supple,price,form_payment,number_account)
VALUES (2,4,3,'2019-02-25',37500,'cash',NULL),
       (3,4,5,'2019-03-20',15000,'cash',NULL),
       (4,3,6,'2019-01-17',35000,'cash',NULL);

