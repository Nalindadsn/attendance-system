$(document).ready(function(){	

	var studentRecords = $('#studentListing').DataTable({

		"lengthChange": false,
		"processing":true,
		"serverSide":true,		
		"bFilter": false,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"assignments_action.php",
			type:"POST",
			data:{action:'listStudents'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	
	$("#studentListing").on('click', '.view', function(){
		var id = $(this).attr("id");
		var action = 'getStudent';
		$.ajax({
			url:'payments_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){				
				$("#studentDetails").on("shown.bs.modal", function () { 					
					$('#name').html(data.name);
					$('#email').html(data.email);
					$('#mobile').html(data.mobile);
					$('#class').html(data.class_name);				
					$('#roll_no').html(data.roll_no);
					$('#fname').html(data.father_name);	
					$('#fmobile').html(data.father_mobile);	
					$('#mname').html(data.mother_name);	
					$('#mmobile').html(data.mother_mobile);	
					$('#address').html(data.current_address);							
				}).modal();			
			}
		});
	});
	
	$('#addStudent').click(function(){
		$('#studentModal').modal('show');
		$('#studentForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Student");
		$('#action').val('addStudent');
		$('#save').val('Save');
	});	
	
	$(document).on('click', '.update', function(){
		var studentId = $(this).attr("id");
		var action = 'getStudentDetails';
		$.ajax({
			url:'payments_action.php',
			method:"POST",
			data:{studentId:studentId, action:action},
			dataType:"json",
			success:function(data){
				$('#studentModal').modal('show');
				$('#studentId').val(data.id);
				$('#name').val(data.name);
				$('#email').val(data.email);
				$('#mobile').val(data.mobile);
				$('#dob').val(data.dob);				
				$('#gender').val(data.gender);	
				$('#currentAddress').val(data.current_address);
				$('#permanentAddress').val(data.permanent_address);
				$('#fatherName').val(data.father_name);
				$('#motherName').val(data.mother_name);
				$('#acamedicYear').val(data.academic_year);
				$('#classid').val(data.class);
				$('#rollNo').val(data.roll_no);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Student");
				$('#action').val('updateStudent');
				$('#save').val('Save');
			}
		})
	});	

    

    $(document).on('submit', '#studentForm', function(event){
      event.preventDefault();
      var i_name = $('#name').val();
   
      if(i_name != '')
      {
        $.ajax({
          url:"includes/ajax2.php",
          method:'POST',
          data:new FormData(this),
          contentType:false,
          processData:false,
          beforeSend:function(){
            // $('.loader').show();
          },
          success:function(data)
          {
          	console.log(data)
          	console.log('oop')
            // $('.loader').hide();
            // $('#erm').html(""+data+"");
				$('#studentForm')[0].reset();
				$('#studentModal').modal('hide');				
				$('#save').attr('disabled', false);
				studentRecords.ajax.reload();
          }
        });
      }
      else
      {
        // $('#erm').html("Both Fields are Required");
      }
    });
		
	$(document).on('click', '.delete', function(){
		var studentId = $(this).attr("id");		
		var action = "deleteStudent";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"payments_action.php",
				method:"POST",
				data:{studentId:studentId, action:action},
				success:function(data) {					
					studentRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
	
});