<?php

session_start();
ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}


	require 'dbcon.php';
	
	$sql = "SELECT * FROM timetable;";
	$timetable = $conn->query($sql);
	
	$sql = "SELECT * FROM courses;";
	$Courses = $conn->query($sql);
	
	$sql = "SELECT * FROM sections;";
	$sections = $conn->query($sql);
	
	
	
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
</style>

<title>Home</title>
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
      </header></br>
	  
	<table style="width:100%">
		
	  
	  
	  
	<?php
	
	$Sid = "";
	$Day = "";
		while( $sectionsrow = $sections->fetch_assoc())
		{
			$Sid = $sectionsrow['S_id'];
			for ($Dayslot = 0; $Dayslot < 6; $Dayslot++)
			{
					$sql = "SELECT COUNT(S_id) AS Count FROM timetable where Dayslot = '$Dayslot' and S_id = '$Sid' ;";
					$Count = $conn->query($sql);
					$row = $Count->fetch_assoc();
					if ( $row['Count'] > 1 )
					{
						switch ($Dayslot)
						{
							case 0 : $Day = "Saturday"; break;
							case 1 : $Day = "Sunday"; break;
							case 2 : $Day = "Monday"; break;
							case 3 : $Day = "Tuesday"; break;
							case 4 : $Day = "Wednesday"; break;
							case 5 : $Day = "Thrusday"; break;
						}
						echo "<tr><td>Section: ".$Sid." has ".$row['Count']." classes on ".$Day."</td></tr>";
					}
			}
			
			$classcount = 0;
		}
		$sections->data_seek(0);
		

	?>
	</table>
	  
	  
</body>