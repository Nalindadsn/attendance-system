$(document).ready(function() {        
	
	var userData = $('#userListing').DataTable({
		"searching": false,
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"user_action.php",
			type:"POST",
			data:{action:'listUser'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 7, 8],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	$(document).on('click', '.update', function(){
		var userId = $(this).attr("id");
		var action = 'getUserDetails';
		$.ajax({
			url:'user_action.php',
			method:"POST",
			data:{userId:userId, action:action},
			dataType:"json",
			success:function(data){
				$('#userModal').modal('show');
				$('#userId').val(data.id);
				$('#firstName').val(data.first_name);
				$('#lastName').val(data.last_name);
				$('#email').val(data.email);
				$('#mobile').val(data.mobile);
				$('#role').val(data.role);
				$('#status').val(data.status);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit User");
				$('#action').val('updateUser');
				$('#save').val('Save');
			}
		})
	});		
	
	$('#addUser').click(function(){
		$('#userModal').modal('show');
		$('#userForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add User");
		$('#action').val('addUser');
		$('#save').val('Save');
	});	
		
    $(document).on('submit', '#userForm', function(event){
      event.preventDefault();
      var i_name = $('#name').val();
   console.log("oop")
      if(i_name != '')
      {
        $.ajax({
          url:"includes/ajax6.php",
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
            // $('.loader').hide();
            // $('#erm').html(""+data+"");
				$('#userForm')[0].reset();
				$('#studentModal').modal('hide');				
				$('#save').attr('disabled', false);
				userData.ajax.reload();
          }
        });
      }
      else
      {
        // $('#erm').html("Both Fields are Required");
      }
    });
				
			
	$(document).on('click', '.delete', function(){
		var userId = $(this).attr("id");		
		var action = "deleteUser";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"user_action.php",
				method:"POST",
				data:{userId:userId, action:action},
				success:function(data) {					
					userData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
    
});

