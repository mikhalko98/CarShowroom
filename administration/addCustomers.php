<?php
require_once "../tableObjects/Customers.php";

$Customers = new Customers();
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
        if ($line = $Customers->addCustomer($_POST))
            echo "Added successfully";
        else echo "<p>", "Error add customers", "</p>";
}
?>
<html>
<head>
    <title>CarShowroom</title>
    <link rel="stylesheet" type="text/css" href="/administration/css/employees.css">
</head>
<body>
<h3>Add Customer</h3>
<div class="main">
    <div class="left">
        <div class="forms">
            <form action="/administration/addCustomers.php" method="post">
                <div class="form_first_name"><p>Name: <br/><input type="text" name="first_name"/><br/></p></div>
                <div class="form_last_name"><p>Last name: <br/><input type="text" name="last_name"/><br/></p></div>
                <div class="patronymic"><p>Patronymic: <br/><input type="text" name="patronymic"/><br/></p></div>
                <div class="email"><p>E-mail: <br/><input type="email" name="email"/><br/></p></div>
                <div class="address"><p>Address: <br/><input type="text" name="address"/><br/></p></div>
                <div class="telephone"><p>Telephone: <br/><input type="text" name="telephone"/><br/></p></div>
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
