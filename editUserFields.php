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
				$("#menuME").addClass('highlighted');
			});
		</script>
	</head>
	<body>
	<div id="container">
		<div id="header">
		</div>
		<?php include("menu.php"); ?>
		<div id="editUser2Panel" class="mainPanel">		
			<h2>Edit User</h2>
			<?php 
				$query = $myPDO->prepare('SELECT * FROM USER_INFO WHERE rowid = :uid');
				$query ->bindParam(':uid', $_SESSION['editUser']);
				$query->execute();  	
				$result = $query->fetch(PDO::FETCH_ASSOC);
			?>
			<br/>
			<p id="editUserlabel" class="subheader"> Edit User: <?php echo $result['USER_FIRST_NAME'] . " " . $result['USER_LAST_NAME']; ?> </p>
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
					<br/>
					<p class="subheader">Active user:</p>
			</div>
				
			<form id="editUserForm" method="post">						
				<div id="addUserInputs">
						<input id="fname" name="fname" type="text" value="<?php echo $result['USER_FIRST_NAME']; ?>"/>
						<br/>
						<input id="lname" name="lname" type="text" value="<?php echo $result['USER_LAST_NAME']; ?>"/>
						<br/>					
						<input id="email" name="email" type="text" value="<?php echo $result['USER_EMAIL']; ?>"/>
						<br/>
						<input id="login" name="login" type="text" value="<?php echo $result['USER_LOGIN']; ?>"/>
						<br/>
						<input id="password" name="password" type="text" value="<?php echo $result['USER_PASSWORD']; ?>"/>
						<br/>
						<select id="role" name="role">
						<?php if($result['USER_ROLE'] == 'Student'){ ?>
							<option value="Student" selected="selected">Student</option>
						<?php } else {  ?>
							<option value="Student">Student</option>
						<?php } ?>
						<?php if($result['USER_ROLE'] == 'Instructor'){ ?>
							<option value="Instructor" selected="selected">Instructor</option>
						<?php } else {  ?>	
							<option value="Instructor">Instructor</option>
						<?php } ?>
						<?php if($result['USER_ROLE'] == 'TA'){ ?>
							<option value="TA" selected="selected">TA</option>
						<?php } else {  ?>		
							<option value="TA">TA</option>
						<?php } ?>
						<?php if($result['USER_ROLE'] == 'Admin'){ ?>
							<option value="Admin" selected="selected">Administrator</option>
						<?php } else {  ?>	
							<option value="Admin">Administrator</option>
						<?php } ?>
						<?php if($result['USER_ROLE'] == 'DeptHead'){ ?>
							<option value="DeptHead" selected="selected">Department Head</option>
						<?php } else {  ?>	
							<option value="DeptHead">Department Head</option>
						<?php } ?>
						</select>
						<br/>
						<br/>
						<select id="activeUser" name="activeUser">
						<?php if($result['USER_ACTIVE'] == 'Y'){ ?>
							<option value="Y" selected="selected">Y</option>
						<?php } else {  ?>
							<option value="Y">Y</option>
						<?php } ?>
						<?php if($result['USER_ACTIVE'] == 'N'){ ?>
							<option value="N" selected="selected">N</option>
						<?php } else {  ?>
							<option value="N">N</option>
						<?php } ?>
						</select>							
				</div>		
				<div id="editUserButtonDiv">
					<button type="submit" id="editUserSubmit" class="btn">Edit User</button>
				</div>
				<?php
						if(!empty($_POST)){
								$query = $myPDO->prepare('UPDATE USER_INFO SET USER_FIRST_NAME = :fname, USER_LAST_NAME = :lname, USER_LOGIN = :login, USER_PASSWORD = :password, USER_EMAIL = :email, USER_ACTIVE = :active, USER_ROLE = :role WHERE rowid = :uid');
								$query ->bindParam(':fname', $_POST['fname']);
								$query ->bindParam(':lname', $_POST['lname']);
								$query ->bindParam(':login', $_POST['login']);								
								$query ->bindParam(':password', $_POST['password']);
								$query ->bindParam(':email', $_POST['email']);								
								$query ->bindParam(':active', $_POST['activeUser']);
								$query ->bindParam(':role', $_POST['role']);
								$query ->bindParam(':uid', $_SESSION['editUser']);
								$query->execute();
								echo "<script>alert('User edited'); window.location = 'editUser.php'</script>";	
						}				
				?>
				</form>
			</div>
		</div>	
	</body>
</html>