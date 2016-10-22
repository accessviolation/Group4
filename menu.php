<div id="accordianMenu">
			<ul>
				<li id="menuListLogo">
					<div id="menuLogo">
						<p>Whiteboard</p>
					</div>
				</li>
				<?php if($_SESSION['role'] == 'Student' || $_SESSION['role'] == 'God'){ ?>
				<li>
					<h3 id="menuQ">Quizzes</h3>
					<ul>
						<li id="menuDQ"><a href="downloadQuiz.php">Download Quiz</a></li>
						<li id="menuSQ"><a href="submitQuiz.php">Submit Quiz</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if($_SESSION['role'] == 'Instructor' || $_SESSION['role'] == 'TA' || $_SESSION['role'] == 'God'){ ?>
				<li>
					<h3 id="menuIQ">Quizzes</h3>
					<ul>
						<?php if($_SESSION['role'] == 'Instructor'  || $_SESSION['role'] == 'God'){ ?>
						<li id="menuIUQ"><a href="instructorUpload.php">Upload Quiz</a></li>
						<?php } ?>
						<li id="menuIDQ"><a href="downloadAnswers.php">Download Answers</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if($_SESSION['role'] == 'Student' || $_SESSION['role'] == 'God'){ ?>
				<li>
					<h3 id="menuG">Grades</h3>
					<ul>
						<li id="menuVG"><a href="viewGrades.php">View Grades</a></li>
						<li id="menuVS"><a href="viewStudentStatistics.php">View Statistics</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if($_SESSION['role'] == 'Instructor' || $_SESSION['role'] == 'TA' || $_SESSION['role'] == 'God'){ ?>
				<li>
					<h3 id="menuIG">Grades</h3>
					<ul><?php if($_SESSION['role'] == 'Instructor'  || $_SESSION['role'] == 'God'){ ?>
						<li id="menuIUG"><a href="uploadGrades.php">Upload Grades</a></li>
						<?php } ?>
						<li id="menuIVG"><a href="instructorViewGrades.php">View Grades</a></li>
						<li id="menuIVS"><a href="instructorStats.php">View Attendance</a></li>
						<li id="menuIUA"><a href="uploadAttend.php">Upload Attendance</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'God'){ ?>
				<li>				
					<h3 id="menuM">Manage Users</h3>
					<ul>
						<li id="menuMA"><a href="addUser.php">Add User</a></li>
						<li id="menuME"><a href="editUser.php">Edit User</a></li>
						<li id="menuMD"><a href="deleteUser.php">Delete User</a></li>
					</ul>
				</li>
				<?php } ?>
				<li id="logout">
					<h3>Logout</h3>		
				</li>
			</ul>
</div>