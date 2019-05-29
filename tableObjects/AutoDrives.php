<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";

class AutoDrives
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    public function getAutoDrives()
    {
        $sql = "SELECT auto_drive FROM auto_drives";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}