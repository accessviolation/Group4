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
		$("#menuMA").addClass('highlighted');
	});
	</script>
	</head>
	<body>
	<div id="container">
	<div id="header">
	</div>
		<?php include("menu.php"); ?>
		<div id="addUserPanel" class="mainPanel">		
			<h2>Add User</h2>
			<form method="post">	
			<div id="addUserLabels">
				<p class="subheader">First Name:</p>
				<br/>
				<p class="subheader">Last Name:</p>
				<br/>
				<p class="subheader">Email:</p>
				<br/>
				<p class="subheader">Login ID:</p>
				<br/>
				<p class="subheader">Password:</p>
				<br/>
				<p class="subheader">Role:</p>
			</div>
						
				<div id="addUserInputs">
					<input id="add_fname" name="add_fname" placeholder="First Name" type="text"/>
					<br/>
					<input id="add_lname" name="add_lname" placeholder="Last Name" type="text"/>
					<br/>
					<input id="add_email" name="add_email" placeholder="Email" type="text"/>
					<br/>
					<input id="add_login" name="add_login" placeholder="Login ID" type="text"/>
					<br/>
					<input id="add_password" name="add_password" placeholder="Password" type="password"/>
					<br/>
					<select id="add_role" name="add_role">
						<option value="Student">Student</option>
						<option value="Instructor">Instructor</option>
						<option value="TA">TA</option>
						<option value="Admin">Administrator</option>
						<option value="DeptHead">Department Head</option>
					</select>
				</div>
				<br/>
				<br/>
				<div id="addUserButtonDiv">
					<button type="submit" id="addUserSubmit" class="btn">Add User</button>
				</div>
				<?php
						if(!empty($_POST['add_fname']) && !empty($_POST['add_lname']) && !empty($_POST['add_email']) 
						&& !empty($_POST['add_login']) && !empty($_POST['add_password']) && !empty($_POST['add_role'])){
								$query = $myPDO->prepare('INSERT INTO USER_INFO VALUES(:fname, :lname, :login, :password,:email,"Y",:role)');
								$query ->bindParam(':fname', $_POST['add_fname']);
								$query ->bindParam(':lname', $_POST['add_lname']);
								$query ->bindParam(':login', $_POST['add_login']);
								$query ->bindParam(':email', $_POST['add_email']);
								$query ->bindParam(':password', $_POST['add_password']);
								$query ->bindParam(':role', $_POST['add_role']);
								$query->execute();
								echo "<script>alert('User added');</script>";	
						}				
				?>
			</form>
			
		</div>
	</div>
	
	</body>
</html>