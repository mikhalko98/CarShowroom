<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";

class Supplies
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    private function getIdCar()
    {
        $sql = "SELECT MAX(id) as id FROM cars";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute();
        $id = $sth->fetch(PDO::FETCH_ASSOC);
        return $id["id"];
    }

    private function getPriceCar($idCar)
    {
        $sql = "SELECT price FROM cars WHERE id = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute(array($idCar));
        $id = $sth->fetch(PDO::FETCH_ASSOC);
        return $id["price"];
    }

    private function getIdCustomerOnPhone($phone)
    {
        $sql = "SELECT id FROM customers WHERE telephone = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute(array($phone));
        $id = $sth->fetch(PDO::FETCH_ASSOC);
        return $id["id"];
    }

    public function addSupplies($_post)
    {
        $idCar = $this->getIdCar();
        $priceCar = $this->getPriceCar($idCar);
        $idCustomer = $this->getIdCustomerOnPhone($_post['telephone']);
        if (!$idCustomer) {
            sleep(1);
            header("Location: addCustomers.php");
        }
        $date = date('Y-m-d');
        $sql = "INSERT INTO supplies(id_car,id_employee,id_costumer,date_supple,price,form_payment,number_account)
                            VALUES(?,?,?,?,?,?,?)";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $data = array($idCar, $_post['id_employee'], $idCustomer, $date, $priceCar, $_post['form_payment'], $_post['number_account']);

        if ($sth->execute($data))
            return true;
        else return false;
    }
}