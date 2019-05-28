<?php

class WriteCSVfile
{

    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function createFileWithHead($head)
    {
        try {
            $fc = fopen($this->name, 'w+');
            fputcsv($fc, $head);
            fclose($fc);
            return true;
        } catch (Exception $e) {
            echo "Error {$e}";
        }
    }
    public function writeToFile($data)
    {
        $fw = fopen($this->name, 'a+');
        fputcsv($fw, ($data));

    }
}

?>