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
				<?php
				$target_dir = "uploads/MasterQuiz/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				if(isset($_POST["submit"])) {
					if (file_exists($target_file)) {
						echo "Sorry, file already exists.";
						$uploadOk = 0;
					} 
					if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf") {
						echo "Sorry, only DOC, DOCX, PDF files are allowed.";
						$uploadOk = 0;
					}
					
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
					} else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
						} else {
							echo " Sorry, there was an error uploading your file.";
						}
					}
				}
				?>
			</div>
		</div>	
	</body>
</html>
