<?php
require_once "../tableObjects/Supplies.php";

$Supplies = new Supplies();
$check = true;
if (isset($_POST['main_admin'])) header("Location: main.html");
if (isset($_POST['add'])) {
    foreach ($_POST as $key => $value) {
        if (!$value) {
            echo "You have not entered $key";
            $check = false;
            break;
        }
    }
    if ($check)
        if ($line = $Supplies->addSupplies($_POST))
            echo "Added successfully";
        else echo "<p>", "Error add supplies", $line, "</p>";
}
?>
<html>
<head>
    <title>CarShowroom</title>
    <link rel="stylesheet" type="text/css" href="/administration/css/employees.css">
</head>
<body>
<h3>Add Supplies</h3>
<div class="main">
    <div class="left">
        <div class="forms">
            <form action="/administration/addSupplies.php" method="post">
                <div class="form_employee"><p>ID Employee: <br/><input min="1" type="number" name="id_employee"/><br/>
                    </p></div>
                <div class="telephone"><p>Telephone: <br/><input type="text" name="telephone"/><br/></p></div>
                <div class="form_payment">
                    <p>Form payment: <br/><select name="form_payment">
                            <option selected value="cash">cash</option>
                            <option selected value="cashless">cashless</option>
                        </select><br/></p>
                </div>
                <div class="number_account"><p>Number account: <br/><input type="text" name="number_account"/><br/></p>
                </div>
                <p><input type="submit" name="add" value="Add"/></p>
                <p><input type="submit" name="main_admin" value="Main admin"/></p>
            </form>
        </div>
    </div>
    <div class="right">
    </div>
</div>
</body>
</html>
