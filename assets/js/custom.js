$(document).on('click','.view_list',function(){
    var emp_name = $(this).attr('emp_name');
    var dept_name = $(this).attr('dept_name');
    var list_id = $(this).attr('list_id');
    var rpt = $(this).attr('rpt');
    var ast = $(this).attr('ast');
    var pan = $(this).attr('pan');
    $('#emp_name').val(emp_name);
    $('#dept_name').val(dept_name);
    $('#list_ids').val(list_id);
    $('#rpt_ocean').val(rpt);
    $('#astute_id').val(ast);
    $('#panorama_id').val(pan);
    $('#leadAdjustModal').modal('show');
})

$(document).on('submit','#update_quota',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'update-quota',
        processData:false,
        contentType:false,
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                swal('Success','Updated successfully','success');
                location.reload();
            }
            else{
                swal('Sorry','Something Went Wrong!','error');
            }
        }
    })
})

function adminSwapProductItem(own_id,swap_id){
    
    $.ajax({  
        type: "POST",  
        url:"swap-employee" ,
        data: {
            "own_id":own_id,
            "swap_id":swap_id
        },
        success:function(response){ 
            if (response=="success") {
                location.reload();
            }
            else{
                alert('Something Went Wrong');
            }
        }
    });

}

$('#settings').on('click',function(){
	var checked = $(this).is(':checked');
	if(checked == false){
        $.ajax({
            type:'POST',
            data:{
                automate:0
            },
            url:'update-automate',
            success:function(response){
                $('div.leader').block({ message: 'Not Available in Manual Mode' });
            }
        }) 
	}
	else{
        $.ajax({
            type:'POST',
            data:{
                automate:1
            },
            url:'update-automate',
            success:function(response){
                $('div.leader').unblock(); 
            }
        }) 
	}
})

$(document).on('click','.dept_editor',function(){
	var dept_id = $(this).attr('dept_id');
	var dept_name = $(this).attr('dept_name');
	$('#dept_update_input').val(dept_name);
	$('#dept_id_update').val(dept_id);
	$('#updateDeptModal').modal('show');
})

$(document).on('change','#dept_set_change',function(){
    var dept_id = $(this).val();
    $.ajax({
        type:'POST',
        data:{
            dept_id:dept_id
        },
        url:'fetch-emp-department',
        success:function(response){
             var response = JSON.parse(response);
             if (response.status==1) {
                var html='';
                for(var i=0;i<response.data.length;i++){
                    html+='<option value="'+response.data[i].emp_id+'">'+response.data[i].employee_name+' ('+response.data[i].employee_id+') </option>';
                }
                $('#exampleFormControlSelect2').empty();
                $('#exampleFormControlSelect2').append(html);
             }
             else{
                alert('Please select different department');
                $('#exampleFormControlSelect2').empty();
             }
        }
    })
})

$(document).on('submit','#add_employee',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'add-employee-ajax',
        processData:false,
        contentType:false,
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                swal('Success','Employee Added Succefully','success');
                $('#add_employee').trigger("reset");
            }
            else if(response.status==2){
                swal({
                  title: "Employee Exists & Disabled",
                  text: "Do you want to activate the employee ?",
                  icon: "warning",
                  type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, I am sure!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },function(isConfirm) {
                  if (isConfirm) {
                    var emp_id = response.emp_id;
                    $.ajax({
                        type:'POST',
                        data:{
                            emp_id:emp_id
                        },
                        url:'activate-employee',
                        success:function(response){
                            var response = JSON.parse(response);
                            if (response.status==1) {
                                swal('Success','Employee Activated Succefully','success');
                                $('#add_employee').trigger("reset");
                            }
                        }
                    })
                  }
                  else{
                    return false;
                  }
                })
            }
        }
    })
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
            var response = JSON.parse(response);
            if (response.status==1) {
                swal('Success','Designation updated successfully','success');
                location.reload();
            }
            else{
                swal('Sorry!',response.msg,'error');
            }
        }
    })
})

$(document).on('change','#emp_dept_change',function(){
    var dept_id = $(this).val();
    $.ajax({
        type:'POST',
        data:{
            dept_id:dept_id
        },
        url:'fetch-designations',
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                var html = '';
                html+='<option value="" selected disabled>==Select Designation==</option>';
                for(var i=0;i<response.data.length;i++){
                    html+='<option value="'+response.data[i].desig_id+'">'+response.data[i].designation_name+'</option>';
                }
                $('#desig_select').empty();
                $('#desig_select').append(html);
            }
            else{
                alert('Please choose another department');
                $('#desig_select').empty();
            }
        }
    })
})

$(document).on('submit','#add_emp_automate',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'add-emp-automate',
        processData:false,
        contentType:false,
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                swal('Success','Successfully added','success');
                location.reload();
            }
            else{
                swal('Sorry!',response.msg,'error');
            }
        }
    })
})

$(document).on('click','#genPass',function(){
    var randomstring = Math.random().toString(36).slice(-10);
    $('#passwordEmp').val(randomstring);
})