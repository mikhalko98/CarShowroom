<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";

class EngineCapacities
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    public function getEngine_capacities()
    {
        $sql = "SELECT engine_capacity FROM engine_capacities";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}