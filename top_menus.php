<div class="bg-primary " style="padding:10px; z-index: 1;">
	
<h1 style="margin:0;">Welcome <?php echo ucfirst($_SESSION["role"]); ?> </h1><h3><?php if($_SESSION["userid"]) { echo $_SESSION["name"]; } ?>  <a class="btn btn-danger" href="logout.php">Logout</a> </h3><br>

</div>
<ul class="nav nav-tabs" style="margin-top:-3px; z-index:2">	
	<?php if($user->isAdmin()) { ?>		
		<li id="user"><a href="user.php">Users</a></li>
	<?php } ?> 
	<li id="student"><a href="student.php">Students</a></li>
	<li id="batch"><a href="batch.php">batch</a></li>
	<li id="subjects"><a href="subjects.php">subjects</a></li>
	<li id="attendance"><a href="attendance.php">Attendance</a></li>
	<li id="assignments"><a href="assignments.php">Assignments</a></li>
	<li id="payments"><a href="payments.php">payments</a></li>
	<li id="attendance_report"><a href="attendance_report.php">Attendance Report</a></li>	


</ul>	
	