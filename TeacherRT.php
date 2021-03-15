<?php

	session_start();
	ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #235293;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 16px 22px;
    text-decoration: none;
}

li a:hover {
    background-color: #000000;
}
table {
width: 100%;
}
table, th, td, tr {
    border: 1px solid black;
	background-color: #235293;
	padding: 5px;
}
th {
	
	width: 150px;
}
body {
    background-color: #9bc6ff;
	color: white;
}
h1 , h2 {
	color: black;
}
select {
		width: 200px;
		height: 30px;
		
}
input {
		width: 200px;
		height: 25px;
		border-radius: 8px;
}

</style>
<title>TeacherRT</title>
</head>
<body>
<center><img src="DIU-Logo.png" alt="DiuLogo" width="400" height="100"></center>
		<header>
			<ul>
			  <li><a href="index.php">Home</a></li>
			  <li><a href="Room.php">Rooms</a></li>
			  <li><a href="Teacher.php">Teacher</a></li>
			  <li><a href="Section.php">Sections</a></li>
			  <li><a href="Course.php">Course</a></li>
			  <li><a href="CourseTeacher.php">Course Teacher</a></li>
			  <li><a href="FullRT.php">Routine</a></li>
			  <li><a href="RoomRT.php">Room RT</a></li>
			  <li><a href="TeacherRT.php">Teacher RT</a></li>
			  <li><a href="SectionRT.php">Section RT</a></li>
			  <li><a href="Warnings.php">Warnings</a></li>
			  <li><a href="usermanage.php">Manage User</a></li>
			  <li style="float:right"><a class="active" href="logout.php">Log Out</a></li>
			</ul>
      </header>

<?php
	require 'dbcon.php'; 

	$sql = "SELECT * FROM teachers;";
	$teacher = $conn->query($sql);
	
	$Tid = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$Tid = $_POST["T_id"];
	}
	
	
?>

</br>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		Teachers: <select name = "T_id">
		<?php 
		while($teacherrow = $teacher->fetch_assoc()){
			echo "<option value='$teacherrow[T_id]'>$teacherrow[T_id]</option>";	
		}
		?>
		</select>
		<input type="submit" name="submit" value="Show">  
		</form>
<h1>Full Routine of <?php echo $Tid;?></h1>

<?php 
	
    echo "<table>
		  <tr>
			<th>Weekdays</th>
			<th>8:30-10:00</th>
			<th>10:00-11:30</th> 
			<th>11:30-01:00</th>
			<th>01:00-02:30</th>
			<th>02:30-04:00</th>
			<th>04:00-05:30</th>
		  </tr>";
		  $grpno = "";
		  for ($Dayslot = 0; $Dayslot < 6; $Dayslot++) {
			  
			  switch ($Dayslot){
		case 0 : echo "<tr><th>Saturday</th>"; break;
		case 1 : echo "<tr><th>Sunday</th>"; break;
		case 2 : echo "<tr><th>Monday</th>"; break;
		case 3 : echo "<tr><th>Tuesday</th>"; break;
		case 4 : echo "<tr><th>Wednesday</th>"; break;
		case 5 : echo "<tr><th>Thursday</th>"; break;
	}
			  
				for ($Timeslot = 0; $Timeslot < 6; $Timeslot++) {
					
					$sql = "SELECT * FROM timetable where T_id = '$Tid' and Dayslot = $Dayslot and Timeslot = $Timeslot;";
					$timetable = $conn->query($sql);
					
					
					$timetablerow = $timetable->fetch_assoc();
					switch ($timetablerow['Grp_no']){
							case 0 : $grpno = ""; break;
							case 1 : $grpno = "1"; break;
							case 2 : $grpno = "2"; break;
						}
					echo "<th>$timetablerow[S_id]$grpno  $timetablerow[C_id]  $timetablerow[R_code]</th>";
						
					}
			  echo "</tr>";}
			  
		echo "</table><br/>"; 
$conn->close();
?>

</body>
</html>