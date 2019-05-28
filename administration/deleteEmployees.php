<?php
require_once "../tableObjects/Employees.php";

$Employees = new Employees();
$check = true;
if (isset($_POST['main_admin'])) header("Location: main.html");
if (isset($_POST['delete'])) {
    if ($_POST['email'] != '' && $_POST['telephone'] != '') {
        if ($line = $Employees->deleteEmployee($_POST)) {
            echo "<p>", $line, "</p>";
        }
    } else echo "<p>", "You must entered email and telephone", "</p>";
}
?>
<html>
<head>
    <title>CarShowroom</title>
    <link rel="stylesheet" type="text/css" href="/administration/css/employees.css">
</head>
<body>
<h3>Delete Employees</h3>
<div class="main">
    <div class="left">
        <div class="forms">
            <form action="/administration/deleteEmployees.php" method="post">
                <div class="form_first_name"><p>Name: <br/><input type="text" name="first_name"/><br/></p></div>
                <div class="form_last_name"><p>Last name: <br/><input type="text" name="last_name"/><br/></p></div>
                <div class="patronymic"><p>Patronymic: <br/><input type="text" name="patronymic"/><br/></p></div>
                <div class="email"><p>*E-mail: <br/><input type="email" name="email"/><br/></p></div>
                <div class="address"><p>Address: <br/><input type="text" name="address"/><br/></p></div>
                <div class="telephone"><p>*Telephone: <br/><input type="text" name="telephone"/><br/></p></div>
                <div class="position"><p>Position: <br/><select name="position">
                            <?php
                            foreach ($Employees->getPositions() as $value) {
                                echo $value['name'], "\n";
                                echo "<option value=", $value['name'], ">", $value['name'], "</option >";
                            }
                            $Employees = null;
                            ?></select></p></div>
                <p><input type="submit" name="delete" value="Delete"/></p>
                <p><input type="submit" name="main_admin" value="Main admin"/></p>
            </form>
        </div>
    </div>
    <div class="right">
    </div>
</div>
</body>
</html>

