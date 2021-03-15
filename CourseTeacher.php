<?php

session_start();
ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}


		require 'dbcon.php'; 

		$sql = "SELECT * FROM course_teacher  ORDER BY cast(S_id as unsigned), S_id;";
		$CourseTeacher = $conn->query($sql);
		
		$sql = "SELECT * FROM courses;";
		$Course = $conn->query($sql);
		
		$sql = "SELECT * FROM teachers;";
		$Teacher = $conn->query($sql);
		
		$sql = "SELECT * FROM sections ORDER BY cast(S_id as unsigned), S_id;";
		$Section = $conn->query($sql);
		
		function Deleteit(&$Cid= "",&$Sid="",&$Tid=""){
			
					require 'dbcon.php'; 
					
					$sql = "SELECT COUNT(S_id) AS Count FROM timetable where C_id = '$Cid' && S_id = '$Sid' && T_id = '$Tid';";
					$Count = $conn->query($sql);
					$row = $Count->fetch_assoc();
					if ( $row['Count'] ==0 )
					{
						$sql = "Delete FROM course_teacher where C_id = '$Cid' && S_id = '$Sid';";
						if($conn->query($sql)){
							header("Location: CourseTeacher.php");
						}else{
							echo 	"<script>
							alert('Something Went Wrong');
							</script>";
							//echo "Sorry There are Classes For '$Cid' and '$Sid'";
						}
					}else
					{
						echo 	"<script>
								alert('Sorry There are Classes For $Cid and $Sid Delete them First From the Routine');
								</script>";
					}
					$conn->close();
		}

			if(array_key_exists('test',$_GET)){
			   Deleteit($_GET["Cid"],$_GET["Sid"],$_GET["Tid"]);
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

<title>CourseTeacher</title>
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
		$Cid = $Ctype = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  
			$C_id = test_input($_POST["C_id"]);
			$T_id = test_input($_POST["T_id"]);
			$S_id = test_input($_POST["S_id"]);
	
			$sql = "INSERT INTO course_teacher (C_id,T_id,S_id) VALUES ('$C_id', '$T_id' , '$S_id');";
			if($conn->query($sql))
			{
				header("Location: CourseTeacher.php");
	
			}
			else{
				echo 	"<script>
						alert('Already Exists');
						</script>";
				//echo "Already Exists";
			}
		  
		}
		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		<table>	
		<tr>
		<th>Sections: <select name = "S_id">
		<?php 
		while($Sectionrow = $Section->fetch_assoc()){
			echo "<option value='$Sectionrow[S_id]'>$Sectionrow[S_id]</option>";	
		}
		?>
		</select></th>
		<th>Courses: <select name = "C_id">
		<?php 
		while($Courserow = $Course->fetch_assoc()){
			echo "<option value='$Courserow[C_id]'>$Courserow[C_id]</option>";	
		}
		?>
		</select></th>
		<th>Teachers: <select name = "T_id">
		<?php 
		while($Teacherrow = $Teacher->fetch_assoc()){
			echo "<option value='$Teacherrow[T_id]'>$Teacherrow[T_id]</option>";
		}
		?>
		</select></th>
		<th><input type="submit" name="submit" value="Add"></th>
		</form>
		</tr>
	  
	  
		
		  <tr>
			<th>Section ID</th>
			<th>Course ID</th>
			<th>Teacher ID</th>
		  </tr>
		  
		<?php
		  while($CourseTeacherrow = $CourseTeacher->fetch_assoc()) {
			  echo "
			<tr>
				<th>$CourseTeacherrow[S_id]</th>
				<th>$CourseTeacherrow[C_id]</th>
				<th>$CourseTeacherrow[T_id]</th>";
				?> <th><form method="get">
						<input type="hidden" name="Cid" value="<?php echo $CourseTeacherrow['C_id'];?>">
						<input type="hidden" name="Sid" value="<?php echo $CourseTeacherrow['S_id'];?>">
						<input type="hidden" name="Tid" value="<?php echo $CourseTeacherrow['T_id'];?>">
						<input type="submit" name="test" id="test" value="Delete" /><br/>
					</form></th>
					
				<?php
				
		  }
		  $conn->close();
		?>
				
</body>