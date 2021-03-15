<?php
	session_start();
	ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	} else {
    
	header("location: index.php");
}

	if (empty($_POST['R_code'])) {
		header("Location: FullRT.php");
	}	
  
	$Rcode = $_POST['R_code'];
	$Timeslot = $_POST['Timeslot'];
	$Dayslot = $_POST['Dayslot'];
	
	
	require 'dbcon.php';

	
	
	$sql = "SELECT DISTINCT(C_id) FROM course_teacher ORDER BY C_id;";
	$CourseTeacherC = $conn->query($sql);
	
	
	$sql = "SELECT DISTINCT(S_id) FROM course_teacher ORDER BY cast(S_id as unsigned), S_id;";
	$CourseTeacherS = $conn->query($sql);
	
		
	
	
	function Addit(&$Cid= "",&$Sid="",&$Grp_no="",&$Timeslot="",&$Dayslot="",&$Rcode="")
	{
		
				//$Grp_no = (int)$Grp_no;
				//$Timeslot = (int)$Timeslot;
				//$Dayslot = (int)$Dayslot;
				
				
				
					require 'dbcon.php';
					

					$sql = "SELECT * FROM course_teacher WHERE C_id = '$Cid' AND S_id = '$Sid';";
					
					$Tidobj = $conn->query($sql);
					if ($Tidobj->num_rows > 0)
					{
						$Tid1 = $Tidobj->fetch_assoc();
						$Tid = $Tid1['T_id'];
						
						//echo $Cid,$Tid,$Sid,$Grp_no,$Rcode,$Timeslot,$Dayslot;
						
						$sql = "SELECT * FROM timetable;";
						$timetable = $conn->query($sql);
						
						$sql = "SELECT * FROM teachers;";
						$teachers = $conn->query($sql);
						
						$sql = "SELECT * FROM rooms ORDER BY R_type;";
						$rooms = $conn->query($sql);
						
						$sql = "SELECT * FROM courses;";
						$Courses = $conn->query($sql);
						
						if (labroomcheck($Rcode,$Courses,$rooms,$Cid))
						{
							if (holidaycheck($Tid,$Dayslot,$teachers))
							{
								if(samedaycheck($Dayslot,$timetable,$Cid,$Sid,$Grp_no))
								{
									if(coursetypecheck($Cid,$Grp_no,$Courses))
									{
										if(classcountcheck($timetable,$Cid,$Sid,$Grp_no,$Courses))
										{
											$sql = "INSERT INTO timetable(C_id,T_id,S_id,Grp_no,R_code,Timeslot,Dayslot)
											VALUES ('$Cid','$Tid','$Sid','$Grp_no','$Rcode','$Timeslot','$Dayslot');";
											if($conn->query($sql)){
												header("Location: FullRT.php");
												
											}else
											{
												echo 	"<script>
														alert('Sorry There is a Class of Same Section or Teacher at the Same time');
														</script>";
												//echo "<span style='color:red;text-align:center;'>Sorry There is a Class of Same Section or Teacher at the Same time</br>";	
											}	
										}
										else
										{
											echo 	"<script>
													alert('Sorry Maximum Number of Classes has been added for this course in this section');
													</script>";
											//echo "<span style='color:red;text-align:center;'>Sorry Maximum Number of Classes has been added for this course in this section</br>";
										}
									}
									else
									{
										echo 	"<script>
												alert('Sorry Theory Class is only for Group 0 and Lab classes for Group 1 and 2');
												</script>";
										//echo "<span style='color:red;text-align:center;'>Sorry Theory Class is only for Group 0 and Lab classes for Group 1 and 2</br>";
									}	
								}else
								{
									echo 	"<script>
											alert('Sorry There is a same Class in this Same Day');
											</script>";
									//echo "<span style='color:red;text-align:center;'>Sorry There is a same Class in this Same Day</br>";
								}
							}else
							{
								echo 	"<script>
										alert('Sorry Today is Teachers Holiday');
										</script>";
							}
						}else
						{
							echo 	"<script>
									alert('Sorry Lab Classes can only be held in Lab Rooms');
									</script>";
							//echo "<span style='color:red;text-align:center;'>Sorry Lab Classes can only be held in Lab Rooms</br>";
						}
					}else
					{
						echo 	"<script>
								alert('Sorry There are no teacher assigned to this Course and Section');
								</script>";						
						//echo "<span style='color:red;text-align:center;'>Sorry There are no teacher assigned to this Course and Section</br>";	
					}
					$conn->close();
		}
		//add button click event
			if(array_key_exists('Add',$_POST)){
			   Addit($_POST["C_id"],$_POST["S_id"],$_POST["Grp_no"],$_POST["Timeslot"],$_POST["Dayslot"],$_POST["R_code"]);
			}
			
		// Constrains Functions
		function samedaycheck(&$Dayslot,&$timetable,&$Cid,&$Sid,&$Grp_no)
		{
			$deter = true;
			while($timetablerow = $timetable->fetch_assoc())
			{
				if ( $timetablerow['S_id'] == $Sid && $timetablerow['C_id'] == $Cid && $timetablerow['Grp_no'] == $Grp_no && $timetablerow['Dayslot'] == $Dayslot)
				{	$deter = false; }
			}
			$timetable->data_seek(0);
				return $deter;
		}
		function coursetypecheck(&$Cid,&$Grp_no,&$Courses)
		{									
					while($Coursesrow = $Courses->fetch_assoc())
					{
						if ( $Coursesrow['C_id'] == $Cid)
						{	$Ctype = $Coursesrow['C_type']; }
					}
					$Courses->data_seek(0);
					
					if ( ($Ctype == 0 && $Grp_no == 0 ) or  ($Ctype == 1 && $Grp_no == 1 ) or ($Ctype == 1 && $Grp_no == 2 )
							or ($Ctype == 2 && $Grp_no == 1 ) or ($Ctype == 2 && $Grp_no == 2 ) )
						return true;
					else
						return false;										
		}
		function classcountcheck(&$timetable,&$Cid,&$Sid,&$Grp_no,&$Courses)
		{
			$count = 0;
			$Ctype = null;
			while($timetablerow = $timetable->fetch_assoc())
			{
				if ( $timetablerow['S_id'] == $Sid && $timetablerow['C_id'] == $Cid && $timetablerow['Grp_no'] == $Grp_no )
				{	$count++; }
			}
			$timetable->data_seek(0);
			while($Coursesrow = $Courses->fetch_assoc())
			{
				if ( $Coursesrow['C_id'] == $Cid)
				{	$Ctype = $Coursesrow['C_type']; }
			}
			$Courses->data_seek(0);
			if( ($Ctype == 0 && $count < 2 ) or ($Ctype == 2 && $count < 2 ) or ($Ctype == 1 && $count < 1 ) )
				return true;
			else
				return false;
		}
		function labroomcheck(&$Rcode,&$Courses,&$rooms,&$Cid)
		{
			$Ctype = null;
			$Rtype = null;
			while($Coursesrow = $Courses->fetch_assoc())
			{
				if ( $Coursesrow['C_id'] == $Cid)
				{	$Ctype = $Coursesrow['C_type']; }
			}
			$Courses->data_seek(0);
			while($roomsrow = $rooms->fetch_assoc())
			{
				if ( $roomsrow['R_code'] == $Rcode)
				{	$Rtype = $roomsrow['R_type']; }
			}
			$Courses->data_seek(0);
			if( ($Ctype == 0 && $Rtype == 0 ) or ($Ctype == 0 && $Rtype ==1 )
				or ($Ctype == 1 && $Rtype == 1 ) or ($Ctype == 2 && $Rtype == 1 ) )
				return true;
			else
				return false;
			
			
		}
		function holidaycheck(&$Tid,&$Dayslot,&$teachers)
		{
			$Tholiday = null;
			while($teachersrow = $teachers->fetch_assoc())
			{
				if ( $teachersrow['T_id'] == $Tid)
				{	$Tholiday = $teachersrow['T_holiday']; }
			}
			$teachers->data_seek(0);
			if ( $Dayslot == $Tholiday )
				return false;
			else
				return true;
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
}input {
		width: 150px;
		height: 25px;
		border-radius: 8px;
}




</style>

<title>Add Class</title>
</head>
<body>
<center><img src="DIU-Logo.png" alt="DiuLogo" width="400" height="100"></center>
<center>
<form method="POST">
	<h1>Add Class</h1>

      <h2>Section</h2>
      <select name = "S_id" >
		<?php 
		
		while($CourseTeacherrow = $CourseTeacherS->fetch_assoc()){
			echo "<option value='$CourseTeacherrow[S_id]'>$CourseTeacherrow[S_id]</option>";	
		}
		?>
		</select>
		<h2>Group no</h2>
		<select name = "Grp_no">
			<option value=0>0</option>
			<option value=1>1</option>
			<option value=2>2</option>
		</select>
		<h2>Course</h2>
	  
		<select name = "C_id">
		<?php 
		
		while($CourseTeacherrow = $CourseTeacherC->fetch_assoc()){
			echo "<option value='$CourseTeacherrow[C_id]'>$CourseTeacherrow[C_id]</option>";	
		}
		?>
		</select>
	  
		</br></br></br>
		
		<input type="hidden" name="Timeslot" value="<?php echo $Timeslot;?>">
		<input type="hidden" name="Dayslot" value="<?php echo $Dayslot;?>">
		<input type="hidden" name="R_code" value="<?php echo $Rcode;?>">

        
      <input type="submit" name="Add" id="Add" value="Add"></input>
	  
	  
	 </form></br>
	 <form action="FullRT.php">
	 <input type="submit" name="Cancel" id="Cancel" value="Cancel"></input>
	 </form>
	 </center>
	  
	  
	 
	
	 
	  
	  
</body>