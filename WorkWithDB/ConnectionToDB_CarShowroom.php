<?php
require_once "config.php";
require_once "WorkWithDB/DbConnectManager.php";

class ConnectionToDB_CarShowroom
{
    private $config;
    private $DB_CarShowroom;

    function __construct()
    {
        $this->config = new Config();
        $DbConnectManager = new DbConnectManager($this->config->getDns(), $this->config->getUser(), $this->config->getPass());
        $this->DB_CarShowroom = $DbConnectManager->getdbh();
    }

    public function getDBCarShowroom()
    {
        return $this->DB_CarShowroom;
    }

}