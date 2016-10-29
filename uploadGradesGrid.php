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
		$("#menuIUG").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="uploadGradesPanel" class="mainPanel">		
			<h2>Upload Grades</h2>
				<br/>
<?php
	$course = $_SESSION['uploadSelectedCourse'];
?>
	<div id="uploadGradesGrid">
		<form method="post">
			<p class="subheader">Assignment Name: </p>
			<input type="text" name="assignment" value=""/>
			<br/><br/>
			<p class="subheader">Set Grades for <?php echo $course; ?></p>
			<br/>
				<table id="uploadTable">
					<tr>
						<th>Student Name</th>
						<th>Grade</th>
					</tr>
					<?php
					$query = $myPDO->prepare('SELECT B.USER_FIRST_NAME, B.USER_LAST_NAME, B.rowid FROM ROSTER A INNER JOIN USER_INFO B ON A.STUDENT = B.rowid WHERE COURSE = :course');
					$query ->bindParam(':course', $course);
					$query->execute();
					?>
					<?php
					$row = $query->fetchAll(PDO::FETCH_ASSOC);
					$i = 0;
					foreach($row as $record){
					?>
					<tr>
						<td><?php echo $record['USER_FIRST_NAME'] . " " . $record['USER_LAST_NAME'];?></td>
						<td><input type="text" name="students[]" value=""/></td>
					</tr>
					<?php
					$i++;
					}
					?>
			</table>
			<div id="uploadGradeBtn">
				<button class="btn" type="submit">Submit Grades</button>
			</div>
			<?php
				if(!empty($_POST)){
					$students = $_POST['students'];
					$assignment =  $_POST['assignment'];
					for($i = 0; $i < count($students ); $i++){
							$studentId = $row[$i]['rowid'];
							$grade = $students[$i];
							$date = date('Y/m/d H:i:s');
							$query2 = $myPDO->prepare('INSERT INTO GRADES VALUES(:uid, :course, :grade, :name, :date)');
							$query2 ->bindParam(':uid', $studentId);
							$query2 ->bindParam(':course', $course);
							$query2 ->bindParam(':grade', $grade);
							$query2 ->bindParam(':name', $assignment);
							$query2 ->bindParam(':date', $date);
							$query2->execute();
					}
					echo '<script>alert("Grades have been submitted"); window.location.href = "uploadGrades.php";</script>';
				}
			?>
		</form>
	</div>
</div>
	</div>	
	</body>
</html>