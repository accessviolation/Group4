<?php
	session_start();
	if(empty($_SESSION['role'])){
		include("logout.php");
	}
	try{
		$myPDO = new PDO('sqlite:gradschool.db');
	}
	catch(PDOException $e){
		// Do something useful with this??
		echo $e->getMessage();
	}
?>
<!DOCTYPE html>
	<head>
	<title>Whiteboard - ECU - Group 4</title>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css">	
	<script src="scripts/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="scripts/script.js" type="text/javascript"></script>
	<script>
	$(document).ready(function(){
		
		if(!$("#menuIG").next().is(":visible"))
		{
			$("#menuIG").next().show();
		}
		$("#menuIUA").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="uploadAttendPanel" class="mainPanel">		
			<h2>Upload Attendance</h2>
<br/><br/>
<h3><?php echo $_SESSION['selectedCourse'] . ' - Attendance for ' . date("m/d/y"); ?></h3>
<?php
	$query = $myPDO->prepare('SELECT B.USER_FIRST_NAME, B.USER_LAST_NAME, B.rowid FROM ROSTER A INNER JOIN USER_INFO B ON A.STUDENT = B.rowid WHERE COURSE = :course');
	$query ->bindParam(':course', $_SESSION['selectedCourse']);
	$query->execute();
	?>
	<br/>
	<form method="post">
	<table id="setAttendTable">
		<tr>
			<th>Student</th>
			<th>Absent today?</th>
		</tr>
	
	<?php
	$row = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach($row as $record){
	?>
		<tr>
			<td><?php echo $record['USER_FIRST_NAME'] . " " . $record['USER_LAST_NAME'];?></td>
			<td><input type="checkbox" name="studentAttend[]" value="<?php echo $record['rowid']; ?>"/></td>
		</tr>
	<?php
	}
	?>
	</table>
	
	<br/>
	<br/>
	<div id="setAttendButtonDiv">
		<button type="submit" id="attendanceSubmit" class="btn">Submit Attendance</button>
		<button type="button" id="attendanceSubmit" class="btn" onclick="javascript:history.go(-1)">Go Back</button>
	</div>
	<?php
		if(!empty($_POST)){
			$studentsAbsent = $_POST['studentAttend'];
			for($i = 0; $i < count($studentsAbsent); $i++){
				$query = $myPDO->prepare('UPDATE ATTENDANCE SET DAYSABSENT = DAYSABSENT + 1 WHERE STUDENT = :uid and COURSE = :course');
				$query ->bindParam(':course', $_SESSION['selectedCourse']);
				$query ->bindParam('uid', $studentsAbsent[$i]);
				$query -> execute();
			}
			echo '<script>alert("Attendance updated."); window.location.href = "uploadAttend.php";</script>';
		}
	?>
	</form>
	</div>	
	</div>	
	</body>
</html>
