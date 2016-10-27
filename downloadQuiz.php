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
		
		if(!$("#menuQ").next().is(":visible"))
		{
			$("#menuQ").next().show();
		}
		$("#menuDQ").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="downloadQuizPanel" class="mainPanel">		
			<h2>Download Quiz</h2>
			<div id="courseQuizList">
			<br/>
			<form method="post">
				<table id="studentDownloadQuiz">
					<tr>
						<th></th>
						<th>Quiz Name</th>
					<tr>
				<?php
				$query = $myPDO->prepare('SELECT DISTINCT(COURSE) FROM ROSTER WHERE STUDENT = :uid');
						$query ->bindParam(':uid', $_SESSION['uid']);
						$query->execute();
						
						$path    = __DIR__ .'\uploads\MasterQuiz';
						$files = array_diff(scandir($path), array('.', '..'));
						while($row=$query->fetch()){
							foreach ($files as $name) {
								$formattedCourse = str_replace(" ","_",$row['COURSE']);
								if (strpos($name, $formattedCourse) !== false) {
									echo '<tr><th><input type="radio" name="downloadQuiz" value="'.$name.'"/></th><th>'.$name.'</th></tr>';
								}
							}
						}
				?>
				<table>
				<div id="stDownloadButtonDiv">
					<button class="btn" onclick="window.location.href='downlaod.php';">Download Quiz</button>
				</div>
				<?php
					if(!empty($_POST)){
						$_SESSION['quizToDownload'] = $_POST['downloadQuiz'];
						echo '<script>window.location.href="downlaod.php";</script>';
						}
				?>
			</form>
			</div>
		</div>
	</div>
	
	</body>
</html>