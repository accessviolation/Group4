<br/><br/>
<h3><?php echo $_SESSION['selectedCourse'] . ' - Attendance for ' . date("m/d/y"); ?></h3>
<?php
	$query = $myPDO->prepare('SELECT B.USER_FIRST_NAME, B.USER_LAST_NAME, B.rowid FROM ROSTER A INNER JOIN USER_INFO B ON A.STUDENT = B.rowid WHERE COURSE = :course');
	$query ->bindParam(':course', $_SESSION['selectedCourse']);
	$query->execute();
	?>
	<br/>
	<table id="setAttendTable">
		<tr>
			<th>Student</th>
			<th>Absent today?</th>
		</tr>
	
	<?php
	$row = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach($row as $record){
	?>
		<tr>
			<td><?php echo $record['USER_FIRST_NAME'] . " " . $record['USER_LAST_NAME'];?></td>
			<td><input type="checkbox" value="<?php echo $record['rowid']; ?>"/></td>
		</tr>
	<?php
	}
	?>
	</table>
	
	<br/>
	<br/>
	<div id="setAttendButtonDiv">
		<button type="submit" id="attendanceSubmit" class="btn">Submit Attendance</button>
	</div>