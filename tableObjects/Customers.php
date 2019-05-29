<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";

class Customers
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    private function checkAvailability($_post)
    {
        $sql = "SELECT id FROM customers WHERE telephone = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute(array($_post["telephone"]));
        $customer = $sth->fetch(PDO::FETCH_ASSOC);
        return $customer["id"];
    }

    public function addCustomer($_post)
    {
        if (!$this->checkAvailability($_post)) {
            $sql = "INSERT INTO customers(first_name,last_name,patronymic,email,address,telephone)
                            VALUES(?,?,?,?,?,?)";
            $sth = $this->DB_CarShowroom->prepare($sql);
            array_pop($_post);
            $data = array();
            foreach ($_post as $key => $value) {
                $data[] = $value;
            }
            if ($sth->execute($data))
                return true;
            else return false;
        } else {
            echo "This is already there</br>";
            return true;
        }
    }
}