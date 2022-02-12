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
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css" />

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />

<script src="js/assignment_report.js"></script>
<script src="js/general.js"></script>
<style>
.dataTables_filter {
display: none; 
}
</style>
<?php include('inc/container.php');?>
<div class="container-fluid">	
	<div class="row home-sections">		
	<?php include('top_menus.php'); ?>

<nav class="navbar navbar-default">
  <div class="container-fluid">

    <ul class="nav navbar-nav">
	<li class="active" ><a href="attendance_report.php">Attendance Report</a></li>	
	<li id="assignment_report"><a href="assignment_report.php">Assignment Report</a></li>	
	
    </ul>
  </div>
</nav>		
	</div> 		
	<div class="content">
		<div class="container-fluid">			
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-search"></i> Search Class Assignment Report By Date</h3>
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
											<label for="classid">Subject</label><small class="req"> *</small>
											<select id="classid" name="classid" class="form-control" required>
												<option value="">Select</option>
												<?php echo $teacher->classList(); ?>											
											</select>
											<span class="text-danger"></span>
										</div>
									</div>									
									<div class="col-md-4 hidden">
										<div class="form-group">
											<label for="attendanceDate">Start Date</label><small class="req"> *</small>
											<input type="text" name="attendanceDate" id="attendanceDate" class="form-control" placeholder="yyyy/mm/dd"  value="000/00/00" />											
										</div>
									</div> 								
									<div class="col-md-4 hidden">
										<div class="form-group">
											<label for="attendanceDate_b"> End Date</label><small class="req"> *</small>
											<input type="text" name="attendanceDate_b" id="attendanceDate_b" class="form-control" placeholder="yyyy/mm/dd" value="000/00/00" />											
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
					<table id="studentList" class="table table-bordered table-striped hidden">
						<thead>
							<tr>
								<th>#</th>								
								<th>Register No</th>	
								<th>Name</th>
								<th>Assignment 1</th>	
								<th>Assignment 2</th>	
								<th>Assignment 3</th>	
								<th>Assignment 4</th>	
								<th>Assignment 5</th>													
							</tr>
						</thead>
					</table>					
				</form>
			</div>					
	</div>	                                
</div>	
<script>
$(document).ready(function(){
	$('#attendanceDate').datepicker({
		format:'yyyy/mm/dd',
		autoclose:true		
	});
	$('#attendanceDate_b').datepicker({
		format:'yyyy/mm/dd',
		autoclose:true		
	});
});


 $(document).on("change","#attendanceDate", function(e){
 	var a=  $("#attendanceDate").val();  
 $('#attendanceDate_b').val(a)

 });

</script>
<?php include('inc/footer.php');?>
