<br/><br/>
<h3><?php echo $_SESSION['selectedCourse'] . ' - Attendance Record'; ?></h3>
<?php
	$query = $myPDO->prepare('SELECT B.USER_FIRST_NAME, B.USER_LAST_NAME, A.DAYSABSENT FROM ATTENDANCE A INNER JOIN USER_INFO B ON A.STUDENT = B.rowid WHERE COURSE = :course');
	$query ->bindParam(':course', $_SESSION['selectedCourse']);
	$query->execute();
	?>
	<br/>
	<table id="viewAttendTable">
		<tr>
			<th>Student</th>
			<th>Days Absent</th>
		</tr>
	
	<?php
	$row = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach($row as $record){
	?>
		<tr>
			<td><?php echo $record['USER_FIRST_NAME'] . " " . $record['USER_LAST_NAME'];?></td>
			<td><?php echo $record['DAYSABSENT'];?></td>
		</tr>
	<?php
	}
	?>
	</table>
	