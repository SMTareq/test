<?php

session_start();
ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		header("location: FullRT.php");
	} else {
    
	
}

	require 'dbcon.php'; 
 	
if(isset($_POST["submit"]))
{  
  
	if(!empty($_POST['email']) && !empty($_POST['password'])) 
	{  
		$email=$_POST['email'];  
		$password=$_POST['password'];  
		
		 $email= stripcslashes($email);
		 $password= md5(stripcslashes($password));
		// $email = mysql_real_escape_string($email);
		 //$password =mysql_real_escape_string($password);
	  
		
		//$query = mysql_query("SELECT * FROM User WHERE email = '".$_POST['email']."'  and password = '"($_POST['password'])."'");
	   // $query=mysql_query("SELECT * FROM User WHERE email='".$email."' AND password='".$password."'");  
		$sql = "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'";
		if($user = $conn->query($sql))
		{
			if ($user->num_rows > 0)
			{
						$row = $user->fetch_assoc();
									
						if ( $row['email'] == $email && $row['password']== $password)
						{
							 
						 $_SESSION['user']=$email; 
						 $_SESSION['loggedin']=true;
						 header("Location: FullRT.php"); 				 
						}
						 else {  
						
						 echo "<script>
								alert('Invalid email or password!');
								</script>";  
							 }  
					
			 
		  
			}else 
			{  
				echo 	"<script>
						alert('Invalid email or password!');
						</script>";
			} 
		}else 
		{  
			echo 	"<script>
				alert('Invalid email or password!');
				</script>";
		} 
	} 
	else 
		{  
		echo 	"<script>
				alert('Invalid email or password!');
				</script>";
		}  
		
	
 
}

  ?>
   
   
<html>
<head>

<style>
body {
    background-color: #9bc6ff;
	color: white;
	
}
.box {
  background: #ffffff;
  width: 400px;
  margin: 150px auto;
  border-radius: 8px;
  padding: 40px 30px;
}

.box h1 {
  font-size: 28px;
  font-weight: 700;
  text-align: center;
}

.box .form {
  padding: 30px 0;
}

.box label {
  display: block;
  font-size: 14px;
  font-weight: 600;
  margin: 0;
  padding: 0 5px;
}

.box input[type=text],
.box input[type=password] {
  width: 100%;
  border: 0;
  padding: 10px 16px ;
  font-size: 14px;
  font-weight: 500;
  box-shadow: inset 0 -1px  #b3b3b3;
  margin-bottom: 20px;
  outline-color: transparent;
  transition: all .3s ease;
}

.box input[type=text]:hover,
.box input[type=password]:hover {
  box-shadow: inset 0 -1px  #888888;
}

.box input[type=text]:focus,
.box input[type=password]:focus {
  box-shadow: inset 0 -2px  #888888;
}

.box a {
  display: block;
  width: 100%;
  text-align: right;
  font-size: 12px;
  margin-bottom: 20px;
}

.button {
     display: block;
  width: 100%;

  background-color: #00ffbb
  padding: 10px 20px;
  border: 0;
  border-radius: 100px;
  font-weight: 500;
  color: #ffffff;
  transition: all .3s ease;
  outline-color: transparent;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
}
.button:hover {
  background-color: #e09bff;
  box-shadow: 0 10px 50px -10px #b200ff;
  transform: translateY(-1px);
  text-shadow: 0 0 1px rgba(0, 0, 0, 0.5);

}

.button:active {
  background-color: #3e005b;
  box-shadow: 0 3px 10px -2px #b200ff;
  transform: translateY(1px) scale(.99);
}

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
	
	width: 400px;
}
body {
    background-color: #9bc6ff;
	color: white;
}
h1 , h2 {
	color: black;
}
button {
	background-color: black;
	color: white;
}
  

</style>

</head>
<body>
<center><img src="DIU-Logo.png" alt="DiuLogo" width="400" height="100"></center>
		<header>
			<ul>
			  <li><a href="index.php">Home</a></li>
			</ul>
      </header>

<div class="box">
  <h1>DIU ROUTINE MAKER</h1>
  <div class="form">
  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Email</label>
    <input type="text" name="email" placeholder="Enter email">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter  password">
	
   
    <input type="submit" class="button"  name="submit" value="Sign in">
	
	</form>
  </div>
 
</div>






</body>

</html>