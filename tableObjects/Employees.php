<?php
require_once "../config.php";
require_once "../WorkWithDB/DbConnectManager.php";

class Employees
{
    private $DB_CarShowroom;

    function __construct()
    {
        $config = new Config();
        $this->DB_CarShowroom = new DbConnectManager($config->getDns(), $config->getUser(), $config->getPass());
        $this->DB_CarShowroom = $this->DB_CarShowroom->getdbh();
    }

    // получаю массив который содержит все имеющиеся посады в базе даннызх
    public function getPositions()
    {
        $sql = "SELECT name FROM positions";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute();
        return $positions = $sth->fetchAll();
    }

    //получаю название посады по id
    public function getNamePosition($id)
    {
        $sql = "SELECT name FROM positions WHERE id = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute(array($id));
        $position = $sth->fetch(PDO::FETCH_ASSOC);
        return $position["name"];
    }

    //проверяю наявность работника в базе по его email And telephone
    private function checkAvailability($_post)
    {
        $sql = "SELECT id FROM employees WHERE email = ? OR telephone = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute(array($_post["email"], $_post["telephone"]));
        $employee = $sth->fetch(PDO::FETCH_ASSOC);
        return $employee["id"];
    }

    //получаю id посады по её названию(name)
    private function getIdPosition($name)
    {
        $sql = "SELECT id FROM positions WHERE name = ?";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute(array($name));
        $positions = $sth->fetch(PDO::FETCH_ASSOC);
        return $positions['id'];
    }

    // формирую запрос и при отсутсвии работника в базе добавляю его
    public function addEmployee($_post)
    {
        if (!$this->checkAvailability($_post)) {
            $sql = "INSERT INTO employees(first_name,last_name,patronymic,email,address,telephone,id_position)
                            VALUES(?,?,?,?,?,?,?)";
            $sth = $this->DB_CarShowroom->prepare($sql);
            array_pop($_post);
            $id_position = $this->getIdPosition(array_pop($_post));
            $data = array();
            foreach ($_post as $key => $value) {
                $data[] = $value;
            }
            $data[] = $id_position;
            if ($sth->execute($data))
                return "Successfully added";
            else return "Error added";
        } else return "This is already there";
    }

    /** из масива _post формирую строкусостоящую из елементов массива у которых не пустой ключь
     * Результирующая строка имеет вид: some_column = some_value AND ....
     */
    private function get_line_for_RowDelete_inDB($_post)
    {
        array_pop($_post);
        array_pop($_post);
        $line = array();
        foreach ($_post as $key => $value) {
            if ($_post["$key"] != '') {
                $line[] = $key . " = " . "'" . $value . "'";
                $line[] = " AND ";
            }
        }
        array_pop($line);
        $line = implode($line);
        return $line;
    }

    public function deleteEmployee($_post)
    {
        if ($this->checkAvailability($_post)) {
            $line = $this->get_line_for_RowDelete_inDB($_post);
            $sql = "DELETE FROM employees WHERE $line";
            if ($this->DB_CarShowroom->exec($sql) > 0)
                return "Successfully delete";
            else return "Error delete";
        } else return "There is no such";
    }

    public function getListEmployees()
    {
        $sql = "SELECT * FROM employees";
        $sth = $this->DB_CarShowroom->prepare($sql);
        $sth->execute();
        return $positions = $sth->fetchAll();
    }
}