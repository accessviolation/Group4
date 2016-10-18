<br/><br/>
<h3><?php echo $_SESSION['selectedCourse']; ?></h3>
<?php
	$query = $myPDO->prepare('SELECT * FROM GRADES WHERE STUDENT = :uid AND COURSE = :course');
	$query ->bindParam(':uid', $_SESSION['uid']);
	$query ->bindParam(':course', $_SESSION['selectedCourse']);
	$query->execute();
	?>
	<table id="viewGradesTable">
		<tr>
			<th></th>
			<th>Assignment</th>
			<th>Grade</th>
		</tr>
	
	<?php
	$id = 1;
	while($row=$query->fetch()){
	?>
		<tr>
			<td><?php echo $id++;?></td>
			<td><?php echo $row['DESCRIPTION']; ?> </td>
			<td><?php echo $row['GRADE']; ?> </td>
		</tr>
	<?php
	}
	?>
	</table>