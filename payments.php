<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Teacher.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$teacher = new Teacher($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
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
<script src="js/general.js"></script>
<script src="js/Payments.js"></script>	
<?php include('inc/container.php');?>
<div class="container-fluid">  	
	<div class="row home-sections">		
	<?php include('top_menus.php'); ?>	
	</div> 	
	<div> 	
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<?php if($user->isAdmin()) { ?>	
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="addStudent" class="btn btn-success btn-xs">Add New</button>
				</div>
				<?php } ?>
			</div>
		</div>
		<table id="studentListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>REG No </th>	
					<th>Student Name</th>	
					<th>invoice_No</th>					
					<th>reson</th>					
					<th>amount</th>					
					<th>crated at</th>				
				</tr>
			</thead>
		</table>
	</div>	
	
	
	<div id="studentModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="studentForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="Name" class="control-label">Invoice No</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>			
						</div>
								
						<div class="form-group">
							<label for="Name" class="control-label">Reg No*</label>
							<input type="number" class="form-control" id="student_id" name="student_id" placeholder="Name" required>			
						</div>
								
						<div class="form-group">
							<label for="Name" class="control-label">Reson*</label>
							<select class="form-control" id="reson" name="reson" required>
								<option>Semester Fee</option>
								<option>Library Fee</option>
								<option>Exam Fee</option>
								<option>Other</option>
							</select>	
						</div>
								
						<div class="form-group">
							<label for="Name" class="control-label">Amount*</label>
							<input type="number" class="form-control" id="amount" name="amount" placeholder="Name" required>			
						</div>
																	
						
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="studentId" id="studentId" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	
	<div id="studentDetails" class="modal fade">
    	<div class="modal-dialog">    		
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Student Details</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="control-label">Name:</label>
						<span id="name"></span>	
					</div>
					<div class="form-group">
						<label for="website" class="control-label">Email:</label>				
						<span id="email"></span>							
					</div>	   	
					<div class="form-group">
						<label for="industry" class="control-label">Mobile:</label>							
						<span id="mobile"></span>								
					</div>	
					<div class="form-group">
						<label for="description" class="control-label">Class:</label>							
						<span id="class"></span>								
					</div>	
					<div class="form-group">
						<label for="phone" class="control-label">Register No:</label>							
						<span id="roll_no"></span>					
					</div>
					<div class="form-group">
						<label for="address" class="control-label">Father Name:</label>							
						<span id="fname"></span>							
					</div>	
					<div class="form-group">
						<label for="address" class="control-label">Father Mobile:</label>							
						<span id="fmobile"></span>							
					</div>
					<div class="form-group">
						<label for="address" class="control-label">Mother Name:</label>							
						<span id="mname"></span>							
					</div>	
					<div class="form-group">
						<label for="address" class="control-label">Mother Mobile:</label>							
						<span id="mmobile"></span>							
					</div>	
					<div class="form-group">
						<label for="address" class="control-label">Address:</label>							
						<span id="address"></span>							
					</div>					
				</div>    				
			</div>    		
    	</div>
    </div>
	
</div>
 <?php include('inc/footer.php');?>
