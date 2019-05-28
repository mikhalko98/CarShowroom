<?php
require_once "../tableObjects/Cars.php";
$Cars = new Cars();
$check = false;
if (isset($_POST['main_admin'])) header("Location: main.html");
$data = array();
if (isset($_POST['search'])) {
    foreach ($_POST as $key => $value) {
        $data[$key] = $value;
    }
    $check = true;
}
?>
<html>
<head>
    <title>CarShowroom</title>
    <link rel="stylesheet" type="text/css" href="/administration/css/searchCars.css">
</head>
<body>
<h3>Search Car</h3>
<div class="main">

    <div class="mainBody">
        <div class="forms">
            <table>
                <form action="/administration/SearchCars.php" method="post">
                    <tr>
                        <td>
                            <div class="form_mark"><p>Mark:<br/><input type="text" name="mark"/></p></div>
                        </td>
                        <td>
                            <div class="form_model"><p>Model: <br/><input type="text" name="model"/><br/></p></div>
                        </td>
                        <td>
                            <div class="form_yearOfIssue"><p>Year of issue: <br/><input placeholder="After"
                                                                                        type="number"
                                                                                        name="yearOfIssueAfter"
                                                                                        min="1960" max="2019"/>
                                    <input placeholder="Before" type="number" name="yearOfIssueBefore" min="1960"
                                           max="2019"/></p></div>
                        </td>
                        <td>
                            <div class="form_mileage"><p>Mileage: <br/><input placeholder="After" type="number"
                                                                              name="mileageAfter" step="50"/>
                                    <input placeholder="Before" type="number" name="mileageBefore" step="50"/><br/></p>
                            </div>
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

                        <td>
                            <div class="form_engine_capacity">
                                <p>Engine capacity: <br/><select name="engine_capacityAfter">
                                        <option selected value="">...</option>
                                        <?php
                                        require_once "../tableObjects/EngineCapacities.php";
                                        $EngineCapacities = new EngineCapacities();
                                        foreach ($EngineCapacities->getEngine_capacities() as $value) {
                                            echo "<option value=", $value['engine_capacity'], ">", $value['engine_capacity'], "</option >";
                                        }
                                        $EngineCapacities = null;
                                        ?>
                                    </select>
                                    <select name="engine_capacityBefore">
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
                            <div class="form_price"><p>Price: <br/><input placeholder="min" type="number"
                                                                          name="priceMin" min="100" step="10"/>
                                    <input placeholder="max" type="number" name="priceMax" min="1000" step="10"/></p>
                            </div>
                        </td>
                        <td></td>
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
                            <div class="form_bottom"><p><input type="submit" name="search" value="Search"/></p></div>
                            <div class="form_bottom"><p><input type="submit" name="main_admin" value="Main admin"/></p>
                            </div>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
        <div id="listCars" class="listCars">
            <?php
            $checkIs = false;
            if ($check) listCars($data);
            function listCars($data)
            {
                $Cars = new Cars();
                $inf = $Cars->getCar($data);
                foreach ($inf as $value) {
                    echo "<table>", "<tr>", "<td id = 'id_car'>", $value['id'], "</td>",
                    "<td>", "<img src='../photo/photoCar.png', alt='Photo car'>", "</td>",
                    "<td>", "<div class = 'dataCar'>",
                    "<div class = 'mark_model_year'>", "<h2>", $value['mark'], '  ', $value['model'], '  ', $value['yearOfIssue'], "</h2>", "</div>",
                    "<div class = 'price'>", "<p id = 'price'>", $value['price'], "$", "</p>", "</div>",
                    "<table>",
                    "<tr class='data1'>",
                    "<td>", "<div class = 'mileage'>", "<p>", "Mileage: ", $value['mileage'], "</p>", "</div>", "</td>",
                    "<td>", "<div class = 'body_style'>", "<p>", "Body style: ", $value['body_style'], "</p>", "</div>", "</td>",
                    "<td>", "<div class = 'engine_capacity'>", "<p>", "Engine capacity: ", $value['engine_capacity'], "</p>", "</div>", "</td>",
                    "<td>", "<a class = 'a_sellCar' href='addSales.php'>", "Sell a car", "</a>", "</td>",
                    "</tr>",
                    "<tr class='data2'>",
                    "<td>", "<div class = 'color'>", "<p>", "Color: ", $value['color'], "</p>", "</div>", "</td>",
                    "<td>", "<div class = 'fuel'>", "<p>", "Fuel: ", $value['fuel'], "</p>", "</div>", "</td>",
                    "<td>", "<div class = 'transmission'>", "<p>", "Transmission: ", $value['transmission'], "</p>", "</div>", "</td>",
                    "</tr>",
                    "<tr class='data3'>",
                    "<td>", "<div class = 'auto_drive'>", "<p>", "Auto drive: ", $value['auto_drive'], "</p>", "</div>", "</td>",
                    "</tr>",
                    "</table>",
                    "</div>", "</td>",
                    "</tr>", "</table>", "<hr>";
                    $GLOBALS['checkIs'] = true;
                }
            }

            if (!$checkIs) echo "<h2>", "No cars found", "</h2>";
            ?>
        </div>
    </div>

</div>
</body>
</html>

