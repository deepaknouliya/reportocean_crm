$('#settings').on('click',function(){
	var checked = $(this).is(':checked');
	if(checked == false){
		$('div.leader').block({ message: 'Not Available in Manual Mode' }); 
	}
	else{
		$('div.leader').unblock(); 
	}
})

$(document).on('click','.dept_editor',function(){
	var dept_id = $(this).attr('dept_id');
	var dept_name = $(this).attr('dept_name');
	$('#dept_update_input').val(dept_name);
	$('#dept_id_update').val(dept_id);
	$('#updateDeptModal').modal('show');
})

$(document).on('submit','#updateDept',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'update-dept',
        processData:false,
        contentType:false,
        success:function(response){
        	$('#updateDeptModal').modal('hide');
            var response = JSON.parse(response);
            if (response.status==1) {
                swal('Success','Department updated successfully','success');
                location.reload();
            }
            else{
                swal('Sorry!',response.msg,'error');
            }
        }
    })
})

$(document).on('click','.delete_dept',function(){
	var dept_id = $(this).attr('dept_id');
	if(confirm('Are you sure?')){
		$.ajax({
			type:'POST',
			data:{
				dept_id:dept_id
			},
			url:'delete-dept',
			success:function(response){
				var response = JSON.parse(response);
	            if (response.status==1) {
	                swal('Success','Department deleted successfully','success');
	                location.reload();
	            }
	            else{
	                swal('Sorry!',response.msg,'error');
	            }
			}
		})
	}
})

$(document).on('submit','#add_designation',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'add-designation',
        processData:false,
        contentType:false,
        success:function(response){
        	console.log(response);
        	// $('#updateDeptModal').modal('hide');
         //    var response = JSON.parse(response);
         //    if (response.status==1) {
         //        swal('Success','Department updated successfully','success');
         //        location.reload();
         //    }
         //    else{
         //        swal('Sorry!',response.msg,'error');
         //    }
        }
    })
})