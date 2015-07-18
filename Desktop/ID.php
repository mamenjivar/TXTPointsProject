<html>
	<head>
		<title>TXT Coach Leaderboard</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<header id="top">Leaderboard</header>
<!-- create a form to add new names to table (database) -->
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
global $con; //makes $con universally acceptible throughout code

$con = mysql_connect("localhost", "root", ""); //connecting to server
if (mysqli_connect_errno()) {
    echo "Failed to Connect to MySQL: " . mysqli_error();//if connection fails
}

mysqli_select_db($con , "pointsproject");//connects to database

if (isset($_POST['update'])){//if update button has been pressed
	$var_num = $_POST['delete'];//takes the delete button data
    $UpdateQuery = "UPDATE coach_tbl SET coach_score = coach_score + $var_num WHERE coach_id = '$_POST[hidden]'";//adds the value to new points
    mysqli_query($UpdateQuery, $con);
    /*$UpdateQuery = "UPDATE coach_tbl SET coach_name='$_POST[coachname]', coach_score='$_POST[coachscore]' WHERE coach_name ='$_POST[hidden]'";*/
    /*mysql_query($UpdateQuery, $con);*/
};


if (isset($_POST['submit'])){//if submit button has been pressed
    $AddQuery = "INSERT INTO coach_tbl (coach_name, coach_score) VALUES('$_POST[name]', '$_POST[score]')"; //adds new names to table
    mysqli_query($con, $AddQuery);   
    
};

$sql = "SELECT * FROM coach_tbl ORDER BY coach_score DESC"; //arranges table by ascending order by points

echo "<table border=1>
<tr>
<th>NAME</th>
<th>Score</th>
</tr>";
//creates a table to display data
$myData = mysqli_query($con, $sql); //declares mydata variable
while($record = mysqli_fetch_array($myData)) { //loops until all data is displayed onto table
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



mysqli_close($con); //closes server

?>
        
        
	</body>
</html>
