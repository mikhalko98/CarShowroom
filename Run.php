<?php
require_once "config.php";
require_once "WorkWithDB/DbConnectManager.php";
require_once "WorkWithDB/CreateTables.php";
require_once "WorkWithDB/FillDB.php";

class Run{
    function __construct()
    {
    }
    public function createAndInitTablesDB(){
        $config = new Config();

        $DB_CarShowroom = new DbConnectManager($config->getDns(),$config->getUser(), $config->getPass());
        $DB_CarShowroom = $DB_CarShowroom->getdbh();

        $CreateTablesDB_CarShowroom = new CreateTables('./sql/schema.sql', $DB_CarShowroom);
        $CreateTablesDB_CarShowroom->createTables();

        $FillDB_CarShowroom = new FillDB('./sql/insert.sql', $DB_CarShowroom);
        $FillDB_CarShowroom->insertData();
        $DB_CarShowroom = null;
    }
}
?>