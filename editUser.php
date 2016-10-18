<?php
	session_start();
	if(empty($_SESSION['role'])){
		include("logout.php");
	}
	try{
		$myPDO = new PDO('sqlite:gradschool.db');
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$query = $myPDO->prepare('SELECT rowid,* FROM USER_INFO WHERE USER_ROLE != "God"');
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
		
		if(!$("#menuM").next().is(":visible"))
		{
			$("#menuM").next().show();
		}
		$("#menuME").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="editUserPanel" class="mainPanel">		
			<h2>Edit User</h2>
			<div id="editSelect"> 
			<p class="subheader">Select a user to edit: </p>
				<br/>
				<form method="post">
						<select name="editDropDown" id="editDropDown">
								<option value="">Select a user</option>
							<?php
								while($row=$query->fetch()){
							?>
								<option value="<?php echo $row['rowid']; ?>"><?php echo $row['USER_FIRST_NAME'] . " " . $row['USER_LAST_NAME'] . " - " . $row['USER_ROLE']; ?></option>    
							<?php
								}
							?>
						</select>
						<br/>
						<button type="submit" id="editUserSubmit" class="btn">Select User</button>
				</form>	
			</div>	
			<div id="EUfields">
					<?php
						if(isset($_POST['editDropDown'])){
							$_SESSION['editUser'] = $_POST['editDropDown'];
							echo "<script>window.location = 'editUserFields.php'</script>";	
						}
					?>
			</div>			
		</div>
	</div>
	
	</body>
</html>