<?php
	session_start();
	if(empty($_SESSION['role'])){
		include("logout.php");
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
		$("#menuSQ").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="submitQuizPanel" class="mainPanel">		
			<h2>Submit Quiz</h2>
			
			<form action="uploadQuiz.php" id="submitQuizForm" method="post" enctype="multipart/form-data">
				Select file to upload:  <br/><br/>
				<input type="file" name="fileToUpload" id="fileToUpload">
				<br/>
				<input id="submitQuizBtn" type="submit" class="btn" value="Upload File" name="submit">
			</form>
		</div>
	</div>
	
	</body>
</html>