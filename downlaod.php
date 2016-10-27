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
				$path    = __DIR__ .'\uploads\MasterQuiz';
				$name = $_SESSION['quizToDownload'];
				$fullpath = $path . "\\" . $name;
				$type = filetype($fullpath);
				header("Content-type: application/msword");
				header("Content-Disposition: attachment;filename=\"$name\"");
				header("Content-Transfer-Encoding: binary"); 
				header('Pragma: no-cache'); 
				header('Expires: 0');
				set_time_limit(0); 
				readfile($fullpath);
			?>