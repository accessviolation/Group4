<?php
	session_start();
	if(empty($_SESSION['role'])){
		include("logout.php");
	}
?>
<!DOCTYPE html>
	<head>
	<title>Super Generic Project Name</title>
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
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="homePanel" class="mainPanel">		
			<h2>Home</h2>			
			<br/>
			<br/>
			<div id="homelabel">
				<p>Welcome, <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?>!</p>
				<p>Your role is: <?php echo $_SESSION['role'] ?> </p>
			</div>
		</div>
	</div>
	
	</body>
</html>