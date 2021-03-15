<?php

session_start();
ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}
	require 'dbcon.php'; 

	$sql = "SELECT * FROM rooms ORDER BY R_type,R_code;";
	$rooms = $conn->query($sql);
	
	
	$Rcode = "";
	
	
	function Deleteit(&$Timeslot= "",&$Dayslot="",&$Rcode=""){
			
					require 'dbcon.php'; 
			
					$sql = "Delete FROM timetable where Timeslot = '$Timeslot' && Dayslot = '$Dayslot' && R_code = '$Rcode';";
					if($conn->query($sql)){
						header("Location: FullRT.php");
					}else{
						echo 	"<script>
								alert('Something wrong $Timeslot $Dayslot $Rcode');
								</script>";
						//echo "Something wrong '$Timeslot' '$Dayslot' '$Rcode'";
					}
					$conn->close();
		}

			if(array_key_exists('test',$_GET)){
			   Deleteit($_GET["Timeslot"],$_GET["Dayslot"],$_GET["R_code"]);
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
input {
		width: 70px;
		height: 20px;
		border-radius: 8px;
}
</style>
<title>Full Routine</title>
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

<h1>Full Routine</h1>

					

<?php 

	$grpno = "";
for ($Dayslot = 0; $Dayslot < 6; $Dayslot++) {
	switch ($Dayslot){
		case 0 : echo "<h2>Saturday</h2>"; break;
		case 1 : echo "<h2>Sunday</h2>"; break;
		case 2 : echo "<h2>Monday</h2>"; break;
		case 3 : echo "<h2>Tuesday</h2>"; break;
		case 4 : echo "<h2>Wednesday</h2>"; break;
		case 5 : echo "<h2>Thursday</h2>"; break;
	}
    echo "<table>
		  <tr>
			<th>Room No</th>
			<th>8:30-10:00</th>
			<th>10:00-11:30</th> 
			<th>11:30-01:00</th>
			<th>01:00-02:30</th>
			<th>02:30-04:00</th>
			<th>04:00-05:30</th>
		  </tr>";
		  
		  while($roomrow = $rooms->fetch_assoc()) {
			  
			  echo "
			<tr>
				<th>Room $roomrow[R_code]</th>";
				for ($Timeslot = 0; $Timeslot < 6; $Timeslot++) {
					
					$sql = "SELECT * FROM timetable where R_code = '$roomrow[R_code]' and Dayslot = $Dayslot and Timeslot = $Timeslot;";
					$timetable = $conn->query($sql);
					
					$timetablerow = $timetable->fetch_assoc();
					switch ($timetablerow['Grp_no']){
							case 0 : $grpno = ""; break;
							case 1 : $grpno = 1; break;
							case 2 : $grpno = 2; break;
						}					
					echo "<th>$timetablerow[S_id]$grpno  $timetablerow[C_id]<br/>  $timetablerow[T_id]  <br/>";
					
					if ($timetable->num_rows === 0){
					?>
					<form method="POST" action="AddClass.php">
						<input type="hidden" name="Timeslot" value="<?php echo $Timeslot;?>">
						<input type="hidden" name="Dayslot" value="<?php echo $Dayslot;?>">
						<input type="hidden" name="R_code" value="<?php echo $roomrow['R_code'];?>">
						<input type="submit" value="Add"></input>
					</form>
					<?php
					}else{
					?>
					<form method="get">
						<input type="hidden" name="Timeslot" value="<?php echo $Timeslot;?>">
						<input type="hidden" name="Dayslot" value="<?php echo $Dayslot;?>">
						<input type="hidden" name="R_code" value="<?php echo $roomrow['R_code'];?>">
						<input type="submit" name="test" id="test" value="Delete"></input>
					</form>
					<?php
					}
					
				}
			  echo "</th></tr>";}
			  $rooms->data_seek(0);
		echo "</table><br/>";
		  
} 
$conn->close();
?>






</body>
</html>