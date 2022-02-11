$(document).ready(function(){	
	$('#search').click(function(){
		$('#studentList').removeClass('hidden');		
		if ($.fn.DataTable.isDataTable("#studentList")) {
			$('#studentList').DataTable().clear().destroy();
		}
		var classid = $('#classid').val();		
		var attendanceDate = $('#attendanceDate').val();	
		var attendanceDate_b = $('#attendanceDate_b').val();	
		console.log(classid)	

		if(classid && attendanceDate) {			
			$('#studentList').DataTable({
				"lengthChange": false,
				"processing":true,
				"serverSide":true,
				"order":[],
				"ajax":{
					url:"attendance_action.php",
					type:"POST",				
					data:{classid:classid, attendanceDate:attendanceDate, attendanceDate_b:attendanceDate_b, action:'getStudentsAttendance'},
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
        $("#classid").html("<option>-- select  --</option>");
        var stateBody = "";
        for(var key in response)
          {
            stateBody += "<option value="+response[key]['id']+">"+ response[key]['name'] +"</option>";
            $("#classid").html(stateBody);
          }   
        }
    });
 });
