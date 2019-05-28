/*3.	Звіт, який містить витрати та прибутки на авто за вказаний в запиті період часу.*/
SELECT cars.id, cars.mark, cars.model, sup.price AS purPrice,
        cars.price AS selPrice, cars.price-sup.price AS earnings
        FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
WHERE cars.there_is = 0 AND sul.date_supple >= '2019-01-01' AND  sul.date_supple <= '2019-03-25'

/*4.	Звіт проданих авто за вказаний період часу, структурований по моделям.*/
SELECT cars.id, cars.mark, cars.model, COUNT(cars.model) AS count FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
WHERE cars.there_is = 0 AND sul.date_supple >= '2019-01-01' AND  sul.date_supple <= '2019-03-25'
GROUP BY cars.model

/*5.Річний звіт продажу за кожен місяць в указаний рік*/

SELECT  YEAR(sul.date_supple) AS Year, MONTHNAME(sul.date_supple) AS Month,
        SUM(cars.price-sup.price) AS Earnings, COUNT(cars.id) AS Count_car
        FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
WHERE cars.there_is = 0 AND YEAR (sul.date_supple) = 2019
GROUP BY Month

/*Кількість проданих авто співробітником та отриманих коштів з цих авто */

SELECT emp.id, emp.first_name, emp.last_name, COUNT(cars.id) AS count_car ,
       SUM(cars.price-sup.price) AS sum
       FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
    INNER JOIN employees emp ON emp.id = sul.id_employee
WHERE cars.there_is = 0 AND sul.date_supple >= '2019-01-01' AND  sul.date_supple <= '2019-03-25'
GROUP BY emp.id

/*вивести споживачів які купили більше 1 авто за останній рік*/

SELECT cust.first_name, cust.last_name, cust.email, cust.telephone FROM sales sal
    INNER JOIN customers cust ON cust.id = sal.id_costumer
WHERE sal.date_supple >  DATE_SUB(CURDATE() ,INTERVAL 1 YEAR)
GROUP BY cust.id
HAVING COUNT(sal.id_costumer) >= 1