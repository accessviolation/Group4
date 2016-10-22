<br/><br/>
<h3><?php echo $_SESSION['selectedCourse']; ?></h3>
<?php
	$query = $myPDO->prepare('SELECT DAYSABSENT FROM ATTENDANCE WHERE STUDENT = :uid AND COURSE = :course');
	$query ->bindParam(':uid', $_SESSION['uid']);
	$query ->bindParam(':course', $_SESSION['selectedCourse']);
	$query->execute();
	?>
	<table id="viewStatsTable">
		<tr>
			<th>Days Absent</th>
			<th>Mean Grade</th>
		</tr>
	
	
		<tr>		
			<td><?php echo $query->fetchColumn();?></td>
			<?php
			$query = $myPDO->prepare('SELECT AVG(GRADE) FROM GRADES WHERE STUDENT = :uid AND COURSE = :course');
			$query ->bindParam(':uid', $_SESSION['uid']);
			$query ->bindParam(':course', $_SESSION['selectedCourse']);
			$query->execute();
			?>
			<td><?php echo round($query->fetchColumn(), 2); ?> </td>
		</tr>
	</table>