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
		$("#menuMD").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="deleteUserPanel" class="mainPanel">		
			<h2>Delete User</h2>
			<div id="deleteSelect"> 
				<p class="subheader">Select a user to delete: </p>
				<br/>
				<form method="post">
					<select name="deleteDropDown" id="deleteDropDown">
							<option value="">Select a user</option>
						<?php
							while($row=$query->fetch()){
						?>
							<option value="<?php echo $row['rowid']; ?>"><?php echo $row['USER_FIRST_NAME'] . " " . $row['USER_LAST_NAME'] . " - " . $row['USER_ROLE']; ?></option>    
						<?php
							}
						?>
					</select>
					<button type="submit" id="deleteUserSubmit" class="btn">Delete User</button>
					
				<?php
						if(isset($_POST['deleteDropDown'])){
								$query = $myPDO->prepare('DELETE FROM USER_INFO WHERE ROWID = :uid');
								$query->execute(['uid' => $_POST['deleteDropDown']]);
								echo "<script>alert('User deleted');window.location = 'deleteUser.php'</script>";	
						}				
				?>
				</form>
			</div>
		</div>
	</div>
	
	</body>
</html>