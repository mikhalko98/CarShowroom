<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";

class Sales
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    private function getIdCustomerOnPhone($phone)
    {
        $sql = "SELECT id FROM customers WHERE telephone = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute(array($phone));
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

    public function addSales($_post)
    {
        $priceCar = $this->getPriceCar($_post['id_car']);
        if (!$priceCar) {
            echo "incorrect id car";
            return false;
        }
        $idCustomer = $this->getIdCustomerOnPhone($_post['telephone']);
        if (!$idCustomer) {
            sleep(1);
            header("Location: addCustomers.php");
        }
        $date = date('Y-m-d');
        $sql = "INSERT INTO sales(id_car,id_employee,id_costumer,date_supple,price,form_payment,number_account)
                            VALUES(?,?,?,?,?,?,?)";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $data = array($_post['id_car'], $_post['id_employee'], $idCustomer, $date, $priceCar, $_post['form_payment'], $_post['number_account']);
        $sqlUPDATE = "UPDATE cars SET there_is = 0 WHERE id = ?";
        $sthUPDATE = $this->DB_CarShowroom->prepare($sqlUPDATE);
        try {
            $this->DB_CarShowroom->beginTransaction();
            $sth->execute($data);
            $sthUPDATE->execute(array($_post['id_car']));
            $this->DB_CarShowroom->commit();
        } catch (Exception $e) {
            $this->DB_CarShowroom->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
        return true;
    }
}