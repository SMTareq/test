<?php
session_start();
ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}
		require 'dbcon.php';
		
		$email = "";
		$password = "";
		$cpassword = ""; 

		$sql = "SELECT * FROM user ORDER BY cast( email as unsigned), email;";
		$section = $conn->query($sql);
		
		function Deleteit(&$email= ""){
			
					require 'dbcon.php';
			
					$sql = "Delete FROM user where email = '$email';";
					if($conn->query($sql)){
						header("Location: UserManage.php");
					}else{
						echo 	"<script>
						alert('Sorry NO user found $email');
						</script>";
						//echo "Sorry There are Classes At '$Sid'";
					}
					$conn->close();
		}

			if(array_key_exists('test',$_GET)){
			   Deleteit($_GET["email"]);
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

<title>Manage User</title>
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

if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['con_password'];
		
	if (empty($_POST["email"])) {
	  echo 	"<script>
						alert('Email is required');
						</script>";
  } else if (filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)===false){
    // check if e-mail address is well-formed
    
				echo 	"<script>
						alert('Invalid email format');
						</script>";

    
  }
  else if (empty($_POST["password"])) {
	  echo 	"<script>
						alert('password is required');
						</script>";
    } 
	
	else if (empty($_POST["con_password"])) {
		echo 	"<script>
						alert('Confirm password is required');
						</script>";
    }
    else if($_POST['password'] != $_POST['con_password']){
		echo "<script>
			alert('Passwords does not match');
			</script>  ";
    }
    else{
		
		$password = md5 ($password);
         
		  $sql = "INSERT INTO user (email,password) VALUES ('$email', '$password');";
			if($conn->query($sql))
			{
				
				header("Location: usermanage.php");
					
			}
			else{
				echo 	"<script>
						alert('Failed');
						</script>";
				
			}
          
    }
   }
  ?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		<table>	
		<tr>
		<th>Email: <input type="text" name="email" value="<?php echo $email;?>"></th>
		<th>Password:<input type="password" name="password" value="<?php echo $password;?>"></th>
		<th>Confirm Password:<input type="password" name="con_password" value="<?php echo $cpassword;?>"></th>
		<th><input type="submit" name="submit" value="Add"></th>
		</form>
		</tr>
	  
	  
		  <tr>
			<th>Email</th>
			<th>password</th>
			
		  </tr>
		  
		<?php
		while($sectionrow = $section->fetch_assoc()) {
			  echo "
			<tr>
				<th>$sectionrow[email]</th>";
				
				?> <th><form method="get">
						<input type="hidden" name="email" value="<?php echo $sectionrow['email'];?>">
						<input type="submit" name="test" id="test" value="Delete" /><br/>
					</form></th>
					
				<?php
				
		  }
		  $conn->close();
		?>
				
</body>