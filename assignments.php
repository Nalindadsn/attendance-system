<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Teacher.php';
include_once 'class/Batch.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


if(!$user->loggedIn()) {
	header("Location: index.php");
}

$teacher = new Teacher($db);
$bg = new Batch($db);
if(!$user->isAdmin()) {
	$teacher->teacher_id = $_SESSION["userid"];
}

include('inc/header.php');
?>
<title>Student Attendance System with PHP & MySQL</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/assignments.js"></script>	
<script src="js/general.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" >  
<style>
.dataTables_filter {
display: none; 
}
</style>
<?php include('inc/container.php');?>
<div class="container-fluid">  
	<div class="row home-sections">		
	<?php include('top_menus.php'); ?>	
	</div> 	
	<div class="content">
		<div class="container-fluid">			
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-search"></i> Select lecture For Assignment</h3>
						</div>
						<form id="form1" action="" method="post" accept-charset="utf-8">
							<div class="box-body">						
								<div class="row">
									<div class="col-md-4">



										
										<div class="form-group">
											<label for="exampleInputEmail1">Batch</label><small class="req"> *</small>
		                
                 <select id="country" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option>-- select  --</option>
                    	<?php echo $bg->batchList(); ?>		
                  </select>
                     
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">Subject</label><small class="req"> <span id="c2"></span></small>
											<select id="classid" name="classid" class="form-control" required>
												<option value="">Select</option>
												<?php echo $teacher->classList(); ?>												
											</select>
											<span class="text-danger"></span>
										</div>



										<div class="form-group">
											<label for="exampleInputEmail1">Assignment No</label>
											
											<select name="assignmentNo" id="assignmentNo" class="form-control" required>
												<option value="1">Assignment 01</option>
												<option value="2">Assignment 02</option>
												<option value="3">Assignment 03</option>
												<option value="4">Assignment 04</option>
												<option value="5">Assignment 05</option>
												<option value="6">Assignment 06</option>
												<option value="7">Assignment 07</option>
												<option value="8">Assignment 08</option>
												<option value="9">Assignment 09</option>
												<option value="10">Assignment 10</option>
											</select>
											<span class="text-danger"></span>
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">Remark</label>
											
											<input name="remark" id="remark" class="form-control" required>
											<span class="text-danger"></span>
										</div>

									</div>																	
								</div>
							</div>
							<div class="box-footer">
								<button type="button" id="search" name="search" value="search" style="margin-bottom:10px;" class="btn btn-primary btn-sm  checkbox-toggle"><i class="fa fa-search"></i> Search</button> <br>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">					
				<form id="attendanceForm" method="post">					
					<div style="color:red;margin-top:20px;" class="hidden" id="message"></div>
					<button type="submit" id="saveAttendance" name="saveAttendance" value="Save Attendance" style="margin-bottom:10px;" class="btn btn-primary btn-sm  pull-right checkbox-toggle hidden"><i class="fa fa-save"></i> Save Attendance</button> <table id="studentList" class="table table-bordered table-striped hidden">
						<thead>
							<tr>
								<th>#</th>								
								<th>Register No</th>	
								<th>Name</th>
								<th>Attendance</th>
								<th>status</th>													
							</tr>
						</thead>
					</table>
					<input type="hidden" name="action" id="action" value="updateAttendance" />
					<input type="hidden" name="att_classid" id="att_classid" value="" />
					<input type="hidden" name="att_sectionid" id="att_sectionid" value="" />

					<input type="hidden" name="att_assignmentNo" id="att_assignmentNo" value="" />
					<input type="hidden" name="att_remark" id="att_remark" value="" />
				</form>
			</div>					
	</div>	
	
</div>
 <?php include('inc/footer.php');?>
