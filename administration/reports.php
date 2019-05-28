<?php
require_once "./Reports.php";
$Reports = new Reports();
function check()
{
    foreach ($_POST as $key => $value) {
        if (!$value) {
            echo "You have not entered $key";
            return false;
        }
        return true;
    }
}

if (isset($_POST['bottomfirstRep'])) {
    $check = check();
    if ($check) {
        $Reports->firstReport($_POST);
    }
}

if (isset($_POST['bottomsecondRep'])) {
    $check = check();
    if ($check) {
        $Reports->secondReport($_POST);
    }
}

if (isset($_POST['bottomthirdRep'])) {
    $check = check();
    if ($check) {
        $Reports->thirdReport($_POST);
    }
}
if (isset($_POST['bottomfourthRep'])) {
    $check = check();
    if ($check) {
        $Reports->fourthReport($_POST);
    }
}if (isset($_POST['bottomfifthRep'])) {
    $check = check();
    if ($check) {
        $Reports->fifthReport($_POST);
    }
}
?>
<html>
<head>
    <title>CarShowroom</title>
    <link rel="stylesheet" type="text/css" href="/administration/css/reports.css">
</head>
<body>

<h1>Reports</h1>
<a class = 'mainAdmin' href="main.html">Main admin</a>
<div class="reportsForms">
    <table>
        <form action="/administration/reports.php" method="post">
            <tr>
                <td>
                    <div class="firstRep">
                        <p class = 'nameR'>1. Costs and profits from each car purchased on a specified date<br/></p>
                        <p><label class="text">Dates(format: yyyy-mm-dd):</label><br/><input placeholder="After" type="text" name="dateAfter"/>
                            <input placeholder="Before" type="text" name="dateBefore"/></p>
                        <div class="bottomfirstRep"><p><input onclick="alert('Report in file: first.csv')" type="submit"
                                                              name="bottomfirstRep" value="Result"/></p></div>
                    </div>

                    <hr>
                </td>
            </tr>
        </form>
        <form action="/administration/reports.php" method="post">
            <tr>
                <td>
                    <div class="secondRep">
                        <p class = 'nameR'>2. The number of cars sold each model for the specified period<br/></p>
                        <p><label class="text">Dates(format: yyyy-mm-dd):</label><br/><input placeholder="After" type="text" name="dateAfter"/>
                            <input placeholder="Before" type="text" name="dateBefore"/></p>
                        <div class="bottomsecondRep"><p><input onclick="alert('Report in file: second.csv')"
                                                              type="submit" name="bottomsecondRep" value="Result"/></p>
                        </div>
                    </div>
                    <hr>
                </td>
            </tr>
        </form>

        <form action="/administration/reports.php" method="post">
            <tr>
                <td>
                    <div class="thirdRep">
                        <p class = 'nameR'>3. The number of cars sold for each month in the specified year<br/></p>
                        <p><label class="text">Year:</label><br/><input placeholder="Year" type="number" min = '2015' max = '2019' name="year"/></p>
                        <div class="bottomthirdRep"><p><input onclick="alert('Report in file: third.csv')"
                                                              type="submit" name="bottomthirdRep" value="Result"/></p>
                        </div>
                    </div>
                    <hr>
                </td>
            </tr>
        </form>

        <form action="/administration/reports.php" method="post">
            <tr>
                <td>
                    <div class="fourthRep">
                        <p class = 'nameR'>4. Employee performance during the specified period<br/></p>
                        <p><label class="text">Dates(format: yyyy-mm-dd):</label><br/><input placeholder="After" type="text" name="dateAfter"/>
                                         <input placeholder="Before" type="text" name="dateBefore"/></p>
                        <div class="bottomfourthRep"><p><input onclick="alert('Report in file: fourth.csv')"
                                                              type="submit" name="bottomfourthRep" value="Result"/></p>
                        </div>
                    </div>
                    <hr>
                </td>
            </tr>
        </form>

        <form action="/administration/reports.php" method="post">
            <tr>
                <td>
                    <div class="fifthhRep">
                        <p class = 'nameR'>5. Consumers who bought more n machines in the last n years<br/></p>
                        <p><label class="text">Count:</label><br/><input placeholder="Year" min = '0' max = '5'type="number" name="Nyear"/>
                                    <input placeholder="Car" min = '1' type="number" name="Ncar"/></p>
                        <div class="bottomfifthRep"><p><input onclick="alert('Report in file: fifth.csv')"
                                                               type="submit" name="bottomfifthRep" value="Result"/></p>
                        </div>
                    </div>
                    <hr>
                </td>
            </tr>
        </form>
    </table>
</div>
</header>
</body>
</html>