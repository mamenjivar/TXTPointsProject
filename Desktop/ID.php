<html>
	<head>
		<title>TXT Coach Leaderboard</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<header id="top">Leaderboard</header>

		<div id="form">
			<form method="post" action="ID.php">
				<input type="text" name="name" id="name" value="">
				<input type="number" name="score" id="score" value="" min="1" max="10">

				<input type="submit" id="submitButton" value="submit" name="submit">
			</form>
		</div>
            
		<div id="listTitle">
			<h1 id="top">Top 5 Highest Ranked</h1>
		
		</div>
        
        
<?php

$con = mysql_connect("giodudecom.ipagemysql.com", "giodude", "Caterpie074-");
if (!$con) {
    die("Can not connect:" . mysql_error());
}

mysql_select_db("pointsproject", $con);

if (isset($_POST['update'])){
	$var_num = $_POST['delete'];
    $UpdateQuery = "UPDATE coach_tbl SET coach_score = coach_score + $var_num WHERE coach_id = '$_POST[hidden]'";
    mysql_query($UpdateQuery, $con);
    /*$UpdateQuery = "UPDATE coach_tbl SET coach_name='$_POST[coachname]', coach_score='$_POST[coachscore]' WHERE coach_name ='$_POST[hidden]'";*/
    /*mysql_query($UpdateQuery, $con);*/
};


if (isset($_POST['submit'])){
    $AddQuery = "INSERT INTO coach_tbl (coach_name, coach_score) VALUES('$_POST[name]', '$_POST[score]')";
    mysql_query($AddQuery, $con);   
    
};

$sql = "SELECT * FROM coach_tbl ORDER BY coach_score DESC";

echo "<table border=1>
<tr>
<th>NAME</th>
<th>Score</th>
</tr>";

$myData = mysql_query($sql, $con);
while($record = mysql_fetch_array($myData)) {
    echo "<form action=ID.php method=post>";
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



mysql_close($con);

?>
        
        
	</body>
</html>
