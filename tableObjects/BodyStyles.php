<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";

class BodyStyles
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    public function getBodyStyles()
    {
        $sql = "SELECT body_style FROM body_styles";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}