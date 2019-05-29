<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";
require_once "../WorkWithDB/AccessToDB.php";
require_once "../lib/writeCSVfile.php";
class Reports
{
    private $DB_CarShowroom;
    private $AccessToDB;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
        $this->AccessToDB = new AccessToDB($this->DB_CarShowroom);
    }

    function firstReport($_post){
        array_pop($_post);
        $sql = "SELECT cars.id, cars.mark, cars.model, emp.first_name, emp.last_name, sul.date_supple as data, sup.price AS purPrice,
        cars.price AS selPrice, cars.price-sup.price AS earnings
        FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
    INNER JOIN employees emp ON emp.id = sul.id_employee
WHERE cars.there_is = 0 AND sul.date_supple >= ? AND  sul.date_supple <= ? ORDER BY emp.email";
        $sql2 = "SELECT emp.id, emp.first_name, emp.last_name, COUNT(cars.id) AS count_car,
       SUM(cars.price) AS sumPrCar,SUM(sup.price) AS sumPrSup ,SUM(cars.price-sup.price) AS sum
       FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
    INNER JOIN employees emp ON emp.id = sul.id_employee
WHERE cars.there_is = 0 AND sul.date_supple >= ? AND  sul.date_supple <= ?
GROUP BY emp.id
ORDER BY emp.email";
        $res = $this->AccessToDB->request($sql, array($_post['dateAfter'], $_post['dateBefore']));
        $res2 = $this->AccessToDB->request($sql2, array($_post['dateAfter'], $_post['dateBefore']));
        $writeCSVfile = new WriteCSVfile('/var/www/CarShowRoom/resReports/first.csv');
        $headFile = array("Id", "Mark", "Model","First name","Last name", "Data" ,"Purchase price", "Selling price","Earnings");
        try {
            $writeCSVfile->createFileWithHead($headFile);
            $i = 0;
            $sumPrSup = 0;
            $sumPrCar = 0;
            $sum = 0;
            foreach ($res as $key => $value) {
                if($value['first_name'] === $res2[$i]['first_name']) {
                    $writeCSVfile->writeToFile($value);
                }
                else {
                    $writeCSVfile->writeToFile(array("All",$res2[$i]['count_car'],"","","","All",$res2[$i]['sumPrSup'], $res2[$i]['sumPrCar'],$res2[$i]['sum']));
                    $writeCSVfile->writeToFile($value);
                    $i++;
                    $sumPrSup+=$res2[$i]['sumPrSup'];
                    $sumPrCar+=$res2[$i]['sumPrCar'];
                    $sum+=$res2[$i]['sum'];
                }
            }
            $writeCSVfile->writeToFile(array("All",$res2[$i]['count_car'],"","","","All",$res2[$i]['sumPrSup'], $res2[$i]['sumPrCar'],$res2[$i]['sum']));
            $writeCSVfile->writeToFile(array(""));
            $writeCSVfile->writeToFile(array("","","","","","All",$sumPrSup, $sumPrCar,$sum));
            echo "OK";
            return true;
        }catch (Exception $e){
            echo "Error {$e}";
            return false;
        }
    }
    function secondReport($_post){
        array_pop($_post);
        $sql = "SELECT cars.id, cars.mark, cars.model, COUNT(cars.model) AS count FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
WHERE cars.there_is = 0 AND sul.date_supple >= ? AND  sul.date_supple <= ?
GROUP BY cars.model";
        $res = $this->AccessToDB->request($sql, array($_post['dateAfter'], $_post['dateBefore']));
        $writeCSVfile = new WriteCSVfile('/var/www/CarShowRoom/resReports/second.csv');
        $headFile = array("Id", "Mark", "Model", "Count car");
        try {
            $writeCSVfile->createFileWithHead($headFile);
            foreach ($res as $key => $value) {
                $writeCSVfile->writeToFile($value);
            }
            echo "OK";
            return true;
        }catch (Exception $e){
            echo "Error {$e}";
            return false;
        }
    }
    function thirdReport($_post){
        array_pop($_post);
        $sql = "SELECT  YEAR(sul.date_supple) AS Year, MONTHNAME(sul.date_supple) AS Month,
        SUM(cars.price-sup.price) AS Earnings, COUNT(cars.id) AS Count_car
        FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
WHERE cars.there_is = 0 AND YEAR (sul.date_supple) = ?
GROUP BY Month";
        $res = $this->AccessToDB->request($sql, array($_post['year']));
        $writeCSVfile = new WriteCSVfile('/var/www/CarShowRoom/resReports/third.csv');
        $headFile = array("Year", "Month", "Earnings", "Count car");
        try {
            $writeCSVfile->createFileWithHead($headFile);
            foreach ($res as $key => $value) {
                $writeCSVfile->writeToFile($value);
            }
            echo "OK";
            return true;
        }catch (Exception $e){
            echo "Error {$e}";
            return false;
        }
    }
    function fourthReport($_post){
        array_pop($_post);
        $sql = "SELECT emp.id, emp.first_name, emp.last_name, COUNT(cars.id) AS count_car ,
       SUM(cars.price-sup.price) AS sum
       FROM cars
	INNER JOIN supplies sup ON sup.id_car = cars.id
    INNER JOIN sales sul ON sul.id_car = cars.id
    INNER JOIN employees emp ON emp.id = sul.id_employee
WHERE cars.there_is = 0 AND sul.date_supple >= ? AND  sul.date_supple <= ?
GROUP BY emp.id";
        $res = $this->AccessToDB->request($sql, array($_post['dateAfter'], $_post['dateBefore']));
        $writeCSVfile = new WriteCSVfile('/var/www/CarShowRoom/resReports/fourth.csv');
        $headFile = array("Id", "First name", "Last name", "Count car", "Total amount");
        try {
            $writeCSVfile->createFileWithHead($headFile);
            foreach ($res as $key => $value) {
                $writeCSVfile->writeToFile($value);
            }
            echo "OK";
            return true;
        }catch (Exception $e){
            echo "Error {$e}";
            return false;
        }
    }
    function fifthReport($_post){
        array_pop($_post);
        $sql = "SELECT cust.first_name, cust.last_name, cust.email, cust.telephone FROM sales sal
    INNER JOIN customers cust ON cust.id = sal.id_costumer
WHERE sal.date_supple >  DATE_SUB(CURDATE() ,INTERVAL ? YEAR)
GROUP BY cust.id
HAVING COUNT(sal.id_costumer) >= ?";
        $res = $this->AccessToDB->request($sql, array($_post['Nyear'], $_post['Ncar']));
        $writeCSVfile = new WriteCSVfile('/var/www/CarShowRoom/resReports/fifth.csv');
        $headFile = array("First name", "Last name", "Email", "Telephone");
        try {
            $writeCSVfile->createFileWithHead($headFile);
            foreach ($res as $key => $value) {
                $writeCSVfile->writeToFile($value);
            }
            echo "OK";
            return true;
        }catch (Exception $e){
            echo "Error {$e}";
            return false;
        }
    }
}