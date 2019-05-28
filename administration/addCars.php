<?php
require_once "../tableObjects/Cars.php";
$Cars = new Cars();
$check = true;
if (isset($_POST['add'])) {
    foreach ($_POST as $key => $value) {
        if (!$value) {
            echo "You have not entered $key";
            $check = false;
            break;
        }
    }
    if ($check)
        if ($addCar = $Cars->addCar($_POST))
            header("Location: addSupplies.php");
        else echo "<p>", "Error add car", "</p>";
}
?>
<html lang="en">
<head>
    <title>CarShowroom</title>
    <link rel="stylesheet" type="text/css" href="/administration/css/addCars.css">
</head>
<body>
<h3>Add Car</h3>
<div class="main">
    <div class="left">
        <div class="forms">
            <table>
                <form action="/administration/addCars.php" method="post">
                    <tr>
                        <td>
                            <div class="form_mark"><p>Mark:<br/><input type="text" name="mark"/></p></div>
                        </td>
                        <td>
                            <div class="form_model"><p>Model: <br/><input type="text" name="model"/><br/></p></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form_yearOfIssue"><p>Year of issue: <br/><input type="number" name="yearOfIssue"
                                                                                        min="1960" max="2019"/></p>
                            </div>
                        </td>
                        <td>
                            <div class="form_mileage"><p>Mileage: <br/><input type="number" name="mileage"
                                                                              step="50"/><br/></p></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form_color">
                                <p>Color: <br/><select name="color">
                                        <option selected value="">...</option>
                                        <?php
                                        require_once "../tableObjects/Colors.php";
                                        $Colors = new Colors();
                                        foreach ($Colors->getColors() as $value) {
                                            echo "<option value=", $value['color'], ">", $value['color'], "</option >";
                                        }
                                        $Colors = null;
                                        ?>
                                    </select></p>
                            </div>
                        </td>
                        <td>
                            <div class="form_fuel">
                                <p>Fuel: <br/><select name="fuel">
                                        <option selected value="">...</option>
                                        <?php
                                        require_once "../tableObjects/Fuels.php";
                                        $Fuels = new Fuels();
                                        foreach ($Fuels->getFuels() as $value) {
                                            echo "<option value=", $value['fuel'], ">", $value['fuel'], "</option >";
                                        }
                                        $Fuels = null;
                                        ?>
                                    </select></p>
                            </div>
                        </td>
                        <td>
                            <div class="form_engine_capacity">
                                <p>Engine capacity: <br/><select name="engine_capacity">
                                        <option selected value="">...</option>
                                        <?php
                                        require_once "../tableObjects/EngineCapacities.php";
                                        $EngineCapacities = new EngineCapacities();
                                        foreach ($EngineCapacities->getEngine_capacities() as $value) {
                                            echo "<option value=", $value['engine_capacity'], ">", $value['engine_capacity'], "</option >";
                                        }
                                        $EngineCapacities = null;
                                        ?>
                                    </select></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form_transmission">
                                <p>Transmission: <br/><select name="transmission">
                                        <option selected value="">...</option>
                                        <?php
                                        require_once "../tableObjects/Transmissions.php";
                                        $Transmissions = new Transmissions();
                                        foreach ($Transmissions->getTransmissions() as $value) {
                                            echo "<option value=", $value['transmission'], ">", $value['transmission'], "</option >";
                                        }
                                        $Transmissions = null;
                                        ?>
                                    </select></p>
                            </div>
                        </td>
                        <td>
                            <div class="form_auto_drive">
                                <p>Auto drive: <br/><select name="auto_drive">
                                        <option selected value="">...</option>
                                        <?php
                                        require_once "../tableObjects/AutoDrives.php";
                                        $AutoDrives = new AutoDrives();
                                        foreach ($AutoDrives->getAutoDrives() as $value) {
                                            echo "<option value=", $value['auto_drive'], ">", $value['auto_drive'], "</option >";
                                        }
                                        $AutoDrives = null;
                                        ?>
                                    </select></p>
                            </div>
                        </td>
                        <td>
                            <div class="form_body_style">
                                <p>Body style: <br/><select name="body_style">
                                        <option selected value="">...</option>
                                        <?php
                                        require_once "../tableObjects/BodyStyles.php";
                                        $BodyStyles = new BodyStyles();
                                        foreach ($BodyStyles->getBodyStyles() as $value) {
                                            echo "<option value=", $value['body_style'], ">", $value['body_style'], "</option >";
                                        }
                                        $BodyStyles = null;
                                        ?>
                                    </select></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form_num_Tech_pass"><p>Number Technical passport: <br/><input type="text"
                                                                                                      name="num_Tech_pass"
                                                                                                      min="0"/></p>
                            </div>
                        </td>
                        <td>
                            <div class="form_num_Push_sale_document"><p>Number Purchase-Sale document: <br/><input
                                            type="number" name="num_Push_sale_document" min="0"/></p></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form_price"><p>Price: <br/><input type="number" name="price" min="100"
                                                                          step="10"/></p></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form_bottom"><p><input type="submit" name="add" value="Add"/></p></div>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    <div class="right">
        <div class="formPhoto"><img src="formPhoto.gif" alt="formPhoto"></div>
    </div>
</div>
</body>
</html>

