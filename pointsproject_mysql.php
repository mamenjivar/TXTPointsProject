<html>
	<head>
		<title>TXT Coach Leaderboard</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<header id="top">Leaderboard</header>
<!--form that adds new users to the page-->
		<div id="form">
			<form method="post" action="pointsproject_mysql.php">
				<input type="text" name="name" id="name" value="">
				<input type="number" name="score" id="score" value="" min="1" max="10">

				<input type="submit" id="submitButton" value="submit" name="submit">
			</form>
		</div>
            
		<div id="listTitle">
			<h1 id="top">Highest Ranked</h1>
		
		</div>
        
<!--using php to call server-->        
<?php

$con = mysql_connect("localhost", "root", "root"); //connecting to server
if (!$con) {
    die("Can not connect:" . mysql_error()); //error message if can't connect to server
}

mysql_select_db("pointsproject", $con); //selecting database

if (isset($_POST['update'])){ //if the update button is pressed
	$var_num = $_POST['delete'];
    $UpdateQuery = "UPDATE coach_tbl SET coach_score = coach_score + $var_num WHERE coach_id = '$_POST[hidden]'";
    mysql_query($UpdateQuery, $con);
//adds value to orginal value already in table
};


if (isset($_POST['submit'])){ //when submit button is pressed
    $AddQuery = "INSERT INTO coach_tbl (coach_name, coach_score) VALUES('$_POST[name]', '$_POST[score]')";
    mysql_query($AddQuery, $con);   
    
};

$sql = "SELECT * FROM coach_tbl ORDER BY coach_score DESC"; //organizes table by score

echo "<table border=1>
<tr>
<th>ID</th>
<th>Name</th>
<th>Score</th>
</tr>";

$myData = mysql_query($sql, $con);
while($record = mysql_fetch_array($myData)) { //loops until all data is presented onto table
    echo "<form action=pointsproject_mysql.php method=post>";
    echo "<tr>";
    echo "<td><input type=text name=coachid value='" . $record['coach_id'] . "'> </td>";
    echo "<td><input type=text name=coachname value='" . $record['coach_name'] . "'> </td>";
    echo "<td><input type=text name=coachscore value='" . $record['coach_score'] . "'> </td>";
    echo "<td><input type=hidden name=hidden value='" . $record['coach_id'] . "'> </td>";
    echo "<td><input type=submit name=update value=update'" . "'> </td>";
    echo "<td><input type=number min=1 max=10 name=delete value=delete'" . "'> </td>";
    echo "</tr>";
    echo "</form>";
    
    }
echo "</table>";



mysql_close($con); //closes the database

?>
        
        
	</body>
</html>
