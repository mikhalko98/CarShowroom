<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";


class Cars
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    function getIdComplectation($_post)
    {
        $data = array($_post['color'], $_post['fuel'], (0 + $_post['engine_capacity']), $_post['transmission'], $_post['auto_drive'], $_post['body_style']);
        $sql = "SELECT id FROM complectations WHERE color = ? AND fuel = ? AND engine_capacity = ? AND transmission = ? AND auto_drive = ? AND body_style = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute($data);
        $idComplectation = $sth->fetch(PDO::FETCH_ASSOC);
        return $idComplectation["id"];
    }

    function addComplectation($_post)
    {
        if ($idComplectation = $this->getIdComplectation($_post)) return $idComplectation;
        else {
            $sql = "INSERT INTO complectations(color,fuel,engine_capacity,transmission,auto_drive,body_style) VALUES(?,?,?,?,?,?)";
            $sth = $this->DB_CarShowroom->prepare($sql);
            $data = array($_post['color'], $_post['fuel'], $_post['engine_capacity'], $_post['transmission'], $_post['auto_drive'], $_post['body_style']);
            $sth->execute($data);
            $idComplectation = $this->DB_CarShowroom->lastInsertId($sql);
            return $idComplectation;
        }
    }

    function addCar($_post)
    {
        $idComplectation = $this->addComplectation($_post);
        $sql = "INSERT INTO cars(there_is,mark,model,yearOfIssue,price,mileage,num_Tech_pass,num_Push_sale_document,id_complectation)
                            VALUES(?,?,?,?,?,?,?,?,?)";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $data = array(true, $_post['mark'], $_post['model'], $_post['yearOfIssue'], (int)($_post['price'] * 1.25), $_post['mileage'], $_post['num_Tech_pass'], $_post['num_Push_sale_document'], $idComplectation);
        if ($sth->execute($data))
            return true;
        else return false;
    }

    function getCar($data)
    {
        $sql = "SELECT * FROM cars INNER JOIN complectations comp ON comp.id = cars.id_complectation WHERE there_is = 1 %s";
        array_pop($data);
        $line = '';
        if ($data['mark'] != '') $line = $line . " AND mark = " . "'{$data['mark']}'";
        if ($data['model'] != '') $line = $line . " AND model = " . "'{$data['model']}'";
        if ($data['yearOfIssueAfter'] != '') $line = $line . " AND yearOfIssue >= " . $data['yearOfIssueAfter'];
        if ($data['yearOfIssueBefore'] != '') $line = $line . " AND yearOfIssue <= " . $data['yearOfIssueBefore'];
        if ($data['mileageAfter'] != '') $line = $line . " AND mileage >= " . $data['mileageAfter'];
        if ($data['mileageBefore'] != '') $line = $line . " AND mileage <= " . $data['mileageBefore'];
        if ($data['color'] != '') $line = $line . " AND color = " . "'{$data['color']}'";
        if ($data['fuel'] != '') $line = $line . " AND fuel = " . "'{$data['fuel']}'";
        if ($data['transmission'] != '') $line = $line . " AND transmission = " . "'{$data['transmission']}'";
        if ($data['auto_drive'] != '') $line = $line . " AND auto_drive = " . "'{$data['auto_drive']}'";
        if ($data['body_style'] != '') $line = $line . " AND body_style = " . "'{$data['body_style']}'";
        if ($data['engine_capacityAfter'] != '') $line = $line . " AND engine_capacity > " . $data['engine_capacityAfter'];
        if ($data['engine_capacityBefore'] != '') $line = $line . " AND engine_capacity < " . $data['engine_capacityBefore'];
        if ($data['priceMin'] != '') $line = $line . " AND price >= " . $data['priceMin'];
        if ($data['priceMax'] != '') $line = $line . " AND price <= " . $data['priceMax'];
        if ($data['num_Tech_pass'] != '') $line = $line . " AND num_Tech_pass = " . "'{$data['num_Tech_pass']}'";
        if ($data['num_Push_sale_document'] != '') $line = $line . " AND num_Push_sale_document = " . $data['num_Push_sale_document'];
        $sql = sprintf($sql, $line);
        //echo $sql;
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

}