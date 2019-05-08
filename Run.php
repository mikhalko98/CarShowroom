<?php
require_once "config.php";
require_once "WorkWithDB/DbConnectManager.php";
require_once "WorkWithDB/CreateTables.php";

class Run{
    function __construct()
    {
    }
    public function run(){
        $config = new Config();

        $DB_CarShowroom = new DbConnectManager($config->getDns(),$config->getUser(), $config->getPass());
        $DB_CarShowroom = $DB_CarShowroom->getdbh();
        //echo $DB_CarShowroom->getAttribute(PDO::ATTR_DRIVER_NAME);
        $CreateTables = new CreateTables('/media/sf_shared/CourseWork/Code/CarShowRoom/sql/schema.sql', $DB_CarShowroom);
        $CreateTables->createTables();
    }
}
?>