$(document).ready(function(){	
	$('#search').click(function(){
		$('#studentList').removeClass('hidden');
		$('#saveAttendance').removeClass('hidden');
		if ($.fn.DataTable.isDataTable("#studentList")) {
			$('#studentList').DataTable().clear().destroy();
		}
		var classid = $('#country').val();	

		var sId = $('#classid').val();	
		var assignmentNo = $('#assignmentNo').val();	
		var remark = $('#remark').val();		
		console.log(sId)
		if(classid) {
			$.ajax({
				url:"assignments_action.php",
				method:"POST",
				data:{classid:classid, sId:sId, assignmentNo:assignmentNo, remark:remark, action:"attendanceStatus"},
				success:function(data) {			
					$('#message').text(data).removeClass('hidden');	
				}
			})
			$('#studentList').DataTable({
				"lengthChange": false,
				"processing":true,
				"serverSide":true,
				"order":[],
				"ajax":{
					url:"assignments_action.php",
					type:"POST",				
					data:{classid:classid, sId:sId, action:'getStudents'},
					dataType:"json"
				},
				"columnDefs":[
					{
						"targets":[0],
						"orderable":false,
					},
				],
				"pageLength": 10
			});				
		}
	});	
	$("#classid").change(function() {		
        $('#att_classid').val($(this).val());		
    });	


	$("#assignmentNo").change(function() {		
        $('#att_assignmentNo').val($(this).val());		
    });	


	$("#remark").change(function() {		
        $('#att_remark').val($(this).val());		
    });	




	$("#sectionid").change(function() {
		$('#att_sectionid').val($(this).val());		
    });



	$("#attendanceForm").submit(function(e) {		
		var formData = $(this).serialize();
		console.log(formData)
		$.ajax({
			url:"assignments_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#message').text(data).removeClass('hidden');				
			}
		});
		return false;
	});	
});



 $(document).on("change","#country", function(e){
  e.preventDefault();
  var item = $("#country").val();  
    console.log(item)
  $.ajax({
        type: "POST",
        url: "includes/ajax5.php",
        dataType: "json",
        data: "i_id="+item,
        success: function(response)
        {
        	console.log(response)
        if (response.length>0) {
          $("#c2").html(""+response.length+"");  
        }else{
          $("#c2").html("No Data"); 
        }
        
        $("#c3").html('-'); 
        var stateBody = "";
          stateBody += "<option>-- select  --</option>";
        for(var key in response)
          {
            stateBody += "<option value="+response[key]['id']+">"+ response[key]['name'] +"</option>";
            $("#classid").html(stateBody);
          }   
        }
    });
 });
