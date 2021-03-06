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
	$query = $myPDO->prepare('SELECT DISTINCT(COURSE) FROM GRADES');
	$query->execute();
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
			<form method="post">
				<div id="uploadGradeUpper">
				<p class="subheader">Select Course: </p>
				<select id="uploadGradeSelect" name ="uploadGradeSelect" onchange="this.form.submit()">
					<option value="">Select a course</option>
				<?php
							while($row=$query->fetch()){
				?>
					<option value="<?php echo $row['COURSE']; ?>"><?php echo $row['COURSE']; ?></option>
				<?php
					}
				?>
				</select>				
			</form>			
				</div>	
				<br/>
				<div>
					<?php
						if(isset($_POST['uploadGradeSelect'])){
							$_SESSION['uploadSelectedCourse'] = $_POST['uploadGradeSelect'];
							echo "<script>window.location = 'uploadGradesGrid.php'</script>";
						}
					?>
				</div>				
		</div>
	</div>
	
	</body>
</html>