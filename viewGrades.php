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
	$query = $myPDO->prepare('SELECT DISTINCT(COURSE) FROM GRADES WHERE STUDENT = :uid');
	$query->execute(['uid' => $_SESSION['uid']]);
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
		
		if(!$("#menuG").next().is(":visible"))
		{
			$("#menuG").next().show();
		}
		$("#menuVG").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="viewGradesPanel" class="mainPanel">		
			<h2>View Grades</h2>
			<div>
				<div id="alignVGSelector">
					<p class="subheader">Select a course to view your grades</p>
					<br/>
					<form method="post">
					<select name="courseDropDown" id="courseDropDown" onchange="this.form.submit()">
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
				<div id="VGgrid">
					<?php
						if(isset($_POST['courseDropDown'])){
							$_SESSION['selectedCourse'] = $_POST['courseDropDown'];
							include('viewGradesGrid.php');
						}
					?>
				</div>
			</div>
		</div>
	</div>
	
	</body>
</html>