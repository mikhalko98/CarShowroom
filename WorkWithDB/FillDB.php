<?php

class FillDB
{
    private $pdo;
    private $fileSQL;

    function __construct($fileSQL, PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->fileSQL = $fileSQL;
    }

    public function insertData()
    {
        $sql = file_get_contents($this->fileSQL);
        try {
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}

?>