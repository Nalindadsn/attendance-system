<h1>Welcome <?php echo ucfirst($_SESSION["role"]); ?> </h1><h3><?php if($_SESSION["userid"]) { echo $_SESSION["name"]; } ?> | <a href="logout.php">Logout</a> </h3><br>
<ul class="nav nav-tabs">	
	<?php if($user->isAdmin()) { ?>		
		<li id="user"><a href="user.php">Users</a></li>
	<?php } ?> 
	<li id="student"><a href="student.php">Students</a></li>
	<li id="batch"><a href="batch.php">batch</a></li>
	<li id="attendance"><a href="attendance.php">Attendance</a></li>
	<li id="assignments"><a href="assignments.php">Assignments</a></li>
	<li id="payments"><a href="payments.php">payments</a></li>
	<li id="attendance_report"><a href="attendance_report.php">Attendance Report</a></li>		
	