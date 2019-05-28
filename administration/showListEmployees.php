<?php
require_once "../tableObjects/Employees.php";
$Employees = new Employees();
?>
<html>
<head>
    <title>CarShowroom</title>
    <link rel="stylesheet" type="text/css" href="/administration/css/listEmployees.css">
</head>
<body>
<h3>List Employees</h3>
<div class="main">
    <div class="list_employees">
        <table>
            <?php
            $data = $Employees->getListEmployees();
            echo "<tr>", "<th><p>id</p></th>", "<th><p>Full name</p></th>",
            "<th><p>Email</p></th>", "<th><p>Address</p></th>", "<th><p>Telephone</p></th>",
            "<th><p>Position</p></th>", "<tr/>";
            foreach ($data as $value)
                echo "<tr>", "<th><p>", $value["id"], "</p></th>",
                "<td><p>", $value["first_name"], "  ", $value["last_name"], "  ", $value["patronymic"], "</p></td>",
                "<td><p>", $value["email"], "</p></td>",
                "<td><p>", $value["address"], "</p></td>",
                "<td><p>", $value["telephone"], "</p></td>",
                "<td><p>", $Employees->getNamePosition($value["id_position"]), "</p></td>", "<tr>";
            ?>
        </table>
    </div>
</div>
</body>
</html>
