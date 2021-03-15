<?php

session_start();
ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}

		require 'dbcon.php'; 

		$sql = "SELECT * FROM sections ORDER BY cast(S_id as unsigned), S_id;";
		$section = $conn->query($sql);
		
		function Deleteit(&$Sid= ""){
			
					require 'dbcon.php'; 
			
					$sql = "Delete FROM sections where S_id = '$Sid';";
					if($conn->query($sql)){
						header("Location: Section.php");
					}else{
						echo 	"<script>
						alert('Sorry There are Course Teacher Assigned for $Sid, Delete them First From the Routine');
						</script>";
						//echo "Sorry There are Classes At '$Sid'";
					}
					$conn->close();
		}

			if(array_key_exists('test',$_GET)){
			   Deleteit($_GET["Sid"]);
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

<title>Sections</title>
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
		$Sid = $Labno = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  if (empty($_POST["Sid"])) {
			  
			 echo 	"<script>
						alert('Section Code is required');
						</script>";
			//echo "Section Code is required";
		  } else {
			$Sid = test_input($_POST["Sid"]);
			$Labno = (int)$_POST["Labno"];
			$sql = "INSERT INTO sections (S_id,Lab_no) VALUES ('$Sid', '$Labno');";
			if($conn->query($sql))
			{
				
				header("Location: Section.php");
					
			}
			else{
				echo 	"<script>
						alert('Section Already Exists $Sid');
						</script>";
				//echo "Section Already Exists $Sid";
			}
		  }
		}
		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		<table>	
		<tr>
		<th>Section ID: <input type="text" name="Sid" value="<?php echo $Sid;?>"></th>
		<th>Lab Group No: <select name = "Labno">
			<option value=1>1</option>
			<option value=2>2</option>
		</select></th>
		<th><input type="submit" name="submit" value="Add"></th>
		</form>
		</tr>
	  
	  
		  <tr>
			<th>Section ID</th>
			<th>Lab Group NO</th>
		  </tr>
		  
		<?php
		  while($sectionrow = $section->fetch_assoc()) {
			  echo "
			<tr>
				<th>$sectionrow[S_id]</th>
				<th>$sectionrow[Lab_no]</th>";
				?> <th><form method="get">
						<input type="hidden" name="Sid" value="<?php echo $sectionrow['S_id'];?>">
						<input type="submit" name="test" id="test" value="Delete" /><br/>
					</form></th>
					
				<?php
				
		  }
		  $conn->close();
		?>
				
</body>