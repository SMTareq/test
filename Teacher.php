<?php

session_start();
ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}

		require 'dbcon.php'; 

		$sql = "SELECT * FROM teachers;";
		$teachers = $conn->query($sql);
		
		function Deleteit(&$Tid= ""){
			
					require 'dbcon.php';
			
					$sql = "Delete FROM teachers where T_id = '$Tid';";
					if($conn->query($sql)){
						header("Location: Teacher.php");
					}else{
						echo 	"<script>
						alert('Sorry There are Courses Assigned to $Tid, Delete them First From the Routine');
						</script>";
						//echo "Sorry There are Classes Taken By '$Tid'";
					}
					$conn->close();
		}

			if(array_key_exists('test',$_GET)){
			   Deleteit($_GET["Tid"]);
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
}input {
		width: 200px;
		height: 25px;
		border-radius: 8px;
}
</style>

<title>Teachers</title>
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
		$Tid = $Holiday = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  if (empty($_POST["Tid"])) {
			  echo 	"<script>
						alert('Teacher name is required');
						</script>";
			//echo "Teacher name is required";
		  } else {
			$Tid = test_input($_POST["Tid"]);
			$Holiday = (int)$_POST["Holiday"];
			$sql = "INSERT INTO teachers (T_id,T_holiday) VALUES ('$Tid', '$Holiday');";
			if($conn->query($sql))
			{
				
				header("Location: Teacher.php");
					
			}
			else{
				echo 	"<script>
						alert('Teacher Already Exists $Tid');
						</script>";
				//echo "Teacher Already Exists $Tid";
			}
		  }
		}
		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		<table>	
		<tr>
		<th>Teacher Name: <input type="text" name="Tid" value="<?php echo $Tid;?>"></th>
		<th>Teacher Holiday: <select name = "Holiday">
			<option value=0>Saturday</option>
			<option value=1>Sunday</option>
			<option value=2>Monday</option>
			<option value=3>Tuesday</option>
			<option value=4>Wednesday</option>
			<option value=5>Thursday</option>
		</select></th>
		<th><input type="submit" name="submit" value="Add"></th>  
		</form>
		</tr>
	  
	  
		
		  <tr>
			<th>Teacher ID</th>
			<th>Holiday</th>
		  </tr>
		  
		<?php
		  while($teacherrow = $teachers->fetch_assoc()) {
			  echo "
			<tr>
				<th>$teacherrow[T_id]</th>";
				switch ($teacherrow['T_holiday']){
					case 0 : echo "<th>Saturday</th>"; break;
					case 1 : echo "<th>Sunday"; break;
					case 2 : echo "<th>Monday"; break;
					case 3 : echo "<th>Tuesday"; break;
					case 4 : echo "<th>Wednesday"; break;
					case 5 : echo "<th>Thursday"; break;
				}
				?> <th><form method="get">
						<input type="hidden" name="Tid" value="<?php echo $teacherrow['T_id'];?>">
						<input type="submit" name="test" id="test" value="Delete" /><br/>
					</form></th>
					
				<?php
				
		  }
		  $conn->close();
		?>
				
</body>