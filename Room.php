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
		
		function Deleteit(&$Rcode= ""){
			
					require 'dbcon.php';
			
					$sql = "Delete FROM rooms where R_code = '$Rcode';";
					if($conn->query($sql)){
						header("Location: Room.php");
					}else{
						echo 	"<script>
						alert('Sorry There are Classes At $Rcode, Delete them First From the Routine');
						</script>";
						//echo "Sorry There are Classes At '$Rcode'";
					}
					$conn->close();
		}

			if(array_key_exists('test',$_GET)){
			   Deleteit($_GET["Rcode"]);
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
	
	width: 400px;
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

<title>Room</title>
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
	    <br/>
		
		<?php
		function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}

		$Rcode = $Rtype = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  if (empty($_POST["Rcode"])) {
			  echo 	"<script>
						alert('Room Code is required');
						</script>";
			//echo "Room Code is required";
		  } else {
			$Rcode = test_input($_POST["Rcode"]);
			$Rtype = (int)$_POST["Rtype"];
			$sql = "INSERT INTO rooms (R_code,R_type) VALUES ('$Rcode', '$Rtype');";
			if($conn->query($sql))
			{
				header("Location: Room.php");
					
			}
			else{
				echo 	"<script>
						alert('Room Already Exists $Rcode');
						</script>";
				//echo "Room Already Exists $Rcode";
			}
		  }
		}
		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>	
		<tr>
		<th>Room ID: <input type="text" name="Rcode" value="<?php echo $Rcode;?>"></th>
		<th>Room Type: <select name = "Rtype">
			<option value=0>Theory</option>
			<option value=1>Lab</option>
		</select></th>
		<th><input type="submit" name="submit" value="Add"></th>
		
		</form>
		</tr>
  
		
		  <tr>
			<th>Room No</th>
			<th>Room Type</th>
		  </tr>
		  
		  
		<?php
		
		  while($roomrow = $rooms->fetch_assoc()) {
			  echo "
			<tr>
				<th>Room $roomrow[R_code]</th>";
				if ( $roomrow['R_type'] == 0 ) echo "<th> Theory </th>";
						else echo "<th> LAB </th>";
			?> <th><form method="get">
						<input type="hidden" name="Rcode" value="<?php echo $roomrow['R_code'];?>">
						<input type="submit" name="test" id="test" value="Delete" /><br/>
					</form></th>
					
				<?php
		  }
		 
		  $conn->close();
		?>
				
</body>