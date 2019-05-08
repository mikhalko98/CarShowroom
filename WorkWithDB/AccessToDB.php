<?php
class AccessToDB{
    private $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    function getArrIdTableInDB($sql, $uniqueColumn)
    {
        $row = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $arrIdProducts = array();
        foreach ($row as $val)
            $arrIdProducts[$val[$uniqueColumn]] = $val['id'];
        return $arrIdProducts;
    }
}
?>