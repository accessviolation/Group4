<!-- J. Honeycutt "If life doesn't break you today, don't worry. It'll try again tomorrow" -->
<?php
	try{
		$myPDO = new PDO('sqlite:gradschool.db');
		session_start();
	}
	catch(PDOException $e){
		// Do something useful with this??
		echo $e->getMessage();
	}
?>
<html>
	<head>
		<title>Whiteboard - ECU - Group 4</title>
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Caveat|Rock+Salt" rel="stylesheet">
		<script src="scripts/jquery-2.1.4.min.js" type="text/javascript"></script>
		<script src="scripts/script.js" type="text/javascript"></script>
		<link rel="stylesheet" href="style.css">	
	</head>
	
	<body>
		<div id="container">
			<form id="loginBox" method="post" class="loginPanel">
				<p id="loginLabel">Whiteboard</p>
				<p id="loginSubheader">Quiz Management System</p>
				<br/>
				<input id="username" name="username" class="loginInput" placeholder="Username" type="text"/>
				<br/>
				<br/>
				<input id="password" name="password" class="loginInput" placeholder="Password" type="password"/>
				<br/>				
				<br/>
				<br/>
				<button type="submit" id="loginSubmit" class="btn">Login</button>
				<?php
					if(isset($_POST['username']) && isset($_POST['password'])){
						$query = $myPDO->prepare('SELECT rowid,* FROM USER_INFO WHERE USER_LOGIN = :username AND USER_PASSWORD = :password AND USER_ACTIVE = \'Y\'');
						$query->execute(['username' => $_POST['username'], 'password' => $_POST['password']]);
						$result = $query->fetch(PDO::FETCH_ASSOC);
						if($result > 0){
							$_SESSION['firstname'] = $result['USER_FIRST_NAME'];
							$_SESSION['lastname'] = $result['USER_LAST_NAME'];
							$_SESSION['login'] = $result['USER_LOGIN'];
							$_SESSION['role'] = $result['USER_ROLE'];
							$_SESSION['uid'] = $result['rowid'];
							// Using PHP to write Javascript for navigation??
							echo "<script>window.location = 'home.php'</script>";							
						} else {
							echo '<script>alert("Incorrect username or password");</script>';
						}
					}
				?>
			</form>				
		</div>
	</body>
</html>