var base_url = document.currentScript.getAttribute('main_url');

$(document).on('click','.assign_lead',function(){
    var lead_id = $(this).attr('lead_id');
    $('#assign_lead_id').val(lead_id);
    $('#assignModal').modal('show');
})

$(document).on('click','.delete_lead',function(){
    var lead_id = $(this).attr('lead_id');
    swal({
          title: "Please Confirm",
          text: "Do you really want to delete this lead ?",
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
            $.ajax({
                type:'POST',
                data:{
                    lead_id:lead_id
                },
                url:'delete-lead',
                success:function(response){
                    var response = JSON.parse(response);
                    if (response.status==1) {
                        swal('Success','Lead Deleted Succefully','success');
                        location.reload();
                    }
                }
            })
          }
          else{
            return false;
          }
        })
})

$(document).on('click','.emp_status',function(){
    var act_status = $(this).attr('act_stat');
    var user_id = $(this).attr('user_id');
    if (act_status==0) {
        swal({
          title: "Please Confirm",
          text: "Do you want to deactive this employee ?",
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
            var emp_id = user_id;
            $.ajax({
                type:'POST',
                data:{
                    emp_id:emp_id,
                    act_status:act_status
                },
                url:'activate-employee',
                success:function(response){
                    var response = JSON.parse(response);
                    if (response.status==1) {
                        swal('Success','Employee Deactived Succefully','success');
                        location.reload();
                    }
                }
            })
          }
          else{
            return false;
          }
        })
    }
    else{
        swal({
          title: "Please Confirm",
          text: "Do you want to Active this employee ?",
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
            var emp_id = user_id;
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
                        location.reload();
                    }
                }
            })
          }
          else{
            return false;
          }
        })
    }
})

$(document).on('change','#change_dept_lead',function(){
    var dept_id = $(this).val();
    $.ajax({
        type:'POST',
        data:{
            dept_id:dept_id
        },
        url:'fetch-emp-department-all',
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                var html='';
                for(var i=0;i<response.data.length;i++){
                    html+='<option value="'+response.data[i].emp_id+'">'+response.data[i].employee_name+' ('+response.data[i].employee_id+')</option>';
                }
                $('#assign_emp_main').empty();
                $('#assign_emp_main').append(html);
            }
            else{
                alert('Sorry No employees found in this department');
                $('#assign_emp_main').empty();
            }
        }
    })
})

$(document).ready(function() {
    $('#main_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );

$(document).on('submit','#assign_lead_manually',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'assign-lead-manually',
        processData:false,
        contentType:false,
        success:function(response){
            if (response==1) {
                $('#assignModal').modal('hide');
                swal('Success','Assigned successfully','success');
                location.reload();
            }
            else{
                $('#assignModal').modal('hide');
                swal('Sorry','Something Went Wrong!','error');
            }
        }
    })
})

$(document).on('submit','#create_lead_manual',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'create-lead-manual',
        processData:false,
        contentType:false,
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                $('#createLeadModal').modal('hide');
                swal('Success','Assigned successfully','success');
                var url = base_url+"new-leads";
                window.location.href = url;
            }
            else{
                $('#createLeadModal').modal('hide');
                swal('Sorry','Something Went Wrong!','error');
            }
        }
    })
})

$(document).on('submit','#update_lead',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:'update-lead',
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

$(document).on('change','#lead_status_change',function(){
    var value = $(this).val();
    if (value==3) {
        var html='';
        var date = new Date().toISOString().slice(0,10);
        html+='<input type="date" min="'+date+'" name="follow_up_date" required>';
        $('#follow_up_td').empty();
        $('#follow_up_td').append(html);
        $('#follow_up_tr').show();
    }
    else{
        $('#follow_up_td').empty();
        $('#follow_up_tr').hide();
    }
})

$(document).on('click','.viewLead',function(){
    var lead_id = $(this).attr('lead_id');
    $.ajax({
        type:'POST',
        data:{
            lead_id:lead_id
        },
        url:'fetch-lead',
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                $('#lead_id_modal').val(lead_id)
                $('#name_report').html(response.data[0].name);
                $('#email_report').html(response.data[0].email);
                $('#report_title').html(response.data[0].title);
                $('#report_phone').html(response.data[0].phone);
                $('#job_title').html(response.data[0].job_title);
                $('#link_report').html(response.data[0].link);
                $('#link_report').attr("href", response.data[0].link);
                $('#company_title').html(response.data[0].company);
                $('#country').html(response.data[0].country);
                $('#sample_date').html(response.data[0].sample_date);
                $('#report_message').html(response.data[0].message);
                $('#report_reason').html(response.data[0].reason);
                $('#report_textarea').val(response.data[0].lead_note);
                $('#report_assigned_by').html(response.data[0].assigned_by_name);
                $('#report_assigned_to').html(response.data[0].assigned_user_name);
                if (response.data[0].lead_status==0) {
                    $('#report_lead_status').html('<span class="btn btn-info btn-sm btn_alert_btn">Unassigned</span>');
                }
                else{
                    var chk1 = "";
                    var chk2 = "";
                    var chk3 = "";
                    var chk4 = "";
                    var chk5 = "";
                    if (response.data[0].lead_status==1) {
                        var chk1 = "selected";
                    }
                    if (response.data[0].lead_status==2) {
                        var chk2 = "selected";
                    }
                    if (response.data[0].lead_status==3) {
                        var chk3 = "selected";
                    }
                    if (response.data[0].lead_status==4) {
                        var chk4 = "selected";
                    }
                    if (response.data[0].lead_status==5) {
                        var chk5 = "selected";
                    }
                    var html='';
                    html+='<select id="lead_status_change" name="lead_status" required>';
                    html+='<option value="1" '+chk1+'>New Lead</option>';
                    html+='<option value="2" '+chk2+'>On Hold</option>';
                    html+='<option value="3" '+chk3+'>Follow Up</option>';
                    html+='<option value="4" '+chk4+'>Closed</option>';
                    html+='<option value="5" '+chk5+'>Rejected</option>';
                    html+='</select>';
                    if (response.data[0].follow_up_date!="") {
                        var html1='';
                        var date = new Date().toISOString().slice(0,10);
                        html1+='<input type="date" min="'+date+'" value="'+response.data[0].follow_up_date+'" name="follow_up_date" required>';
                        $('#follow_up_td').empty();
                        $('#follow_up_td').append(html1);
                        $('#follow_up_tr').show();
                    }
                    $('#report_lead_status').empty();
                    $('#report_lead_status').append(html);
                }
                $('#viewModal').modal('show');
            }
            else{
                alert('Something Went Wrong');
            }
        }
    })
})

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

$(document).on('submit','#edit_employee',function(e){
    e.preventDefault();
    var form = $(this);
    var formdata = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formdata,
        url:base_url+'edit-employee-ajax',
        processData:false,
        contentType:false,
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                swal('Success','Employee Updated Succefully','success');
                location.reload();
            }
            else{
                swal('Error','Something Went Wrong','error');
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
        url:base_url+'fetch-designations',
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