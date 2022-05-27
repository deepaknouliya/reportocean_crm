<style>
.crt_l{
    padding: 0px !important;
}
.btn_alert_btn{
    border-radius: 10px;
    border:1px solid black
    color:black;
}
#modalTable table{
    border:1px solid black;
}
#modalTable tbody{
    border:1px solid black;
}
#modalTable tr{
    border:1px solid black;
}
#modalTable td{
    border:1px solid black;
}
#modalTable th{
    border:1px solid black;
}
#follow_up_tr{
    display: none;
}
/* Important part */
.new-modal-dialog{
    overflow-y: initial !important
}
.new-modal-body{
    height: 80vh;
    overflow-y: auto;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<div class="pcoded-content">
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Lead Management</h5>
                    <p class="m-b-0"><?=$title?></p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="<?=base_url()?>"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!"><?=$title?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
          
            <!-- Page body start -->
            <div class="page-body">

                    <div class="row">
                    <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->

                <div class="card">
                    <div class="card-header">
                        <h5><?=$title?></h5>
                        <div class="card-header-right crt_l">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#createLeadModal">Create Lead</button>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table" id="main_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Source</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Sample Request Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($leads as $lead) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$count?></th>
                                        <td class="text-center"><?php
                                        if ($lead['source_id']=="1") {
                                            echo "Report Ocean";
                                        }
                                        elseif ($lead['source_id']=="2") {
                                            echo "Astute Analytica";
                                        }
                                        elseif ($lead['source_id']=="3") {
                                            echo "Panorama Data";
                                        }
                                        else{
                                            echo "Self";
                                        }
                                        ?></td>
                                        <td class="text-center"><?=$lead['title']?></td>
                                        <td class="text-center"><?=$lead['sample_date']?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($lead['lead_status']==0) {
                                            ?>
                                            <span class="btn btn-info btn-sm btn_alert_btn">Unassigned</span>
                                            <?php
                                            }
                                            elseif ($lead['lead_status']==1){
                                            ?>
                                            <span class="btn btn-secondary btn-sm btn_alert_btn">New</span>
                                            <?php
                                            }
                                            elseif ($lead['lead_status']==2) {
                                                ?>
                                            <span class="btn btn-warning btn-sm btn_alert_btn">On Hold</span>
                                                <?php
                                                }
                                                elseif ($lead['lead_status']==3) {
                                                    ?>
                                            <span class="btn btn-primary btn-sm btn_alert_btn">Follow Up</span>
                                            <?php
                                                }
                                                elseif ($lead['lead_status']==4) {
                                                ?>
                                                <span class="btn btn-success btn-sm btn_alert_btn">Closed</span>
                                                <?php
                                                }else{
                                                ?>
                                                <span class="btn btn-danger btn-sm btn_alert_btn">Rejected</span>
                                                <?php
                                                }
                                                ?>
                                        </td>
                                        <td class="text-center"><button class="btn waves-effect waves-light btn-grd-primary viewLead" lead_id="<?=base64_encode($lead['lead_id'])?>">View</button>
                                            <?php
                                            if ($_SESSION['user_data'][0]['perm_3']==1) {
                                            ?>
                                            <button class="btn waves-effect waves-light btn-grd-info assign_lead" lead_id="<?=base64_encode($lead['lead_id'])?>">Assign</button>
                                            <button class="btn waves-effect waves-light btn-grd-danger delete_lead" lead_id="<?=base64_encode($lead['lead_id'])?>">Delete</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalTable">
        <form id="update_lead">
        <table class="table table-responsive">
          <tbody>
            <tr>
              <th scope="row">Name</th>
              <td id="name_report"></td>
            </tr>
            <tr>
              <th scope="row">Email</th>
              <td id="email_report"></td>
            </tr>
            <tr>
              <th scope="row">Report Title</th>
              <td id="report_title"></td>
            </tr>
            <tr>
              <th scope="row">Phone</th>
              <td id="report_phone"></td>
            </tr>
            <tr>
              <th scope="row">Job Title</th>
              <td id="job_title"></td>
            </tr>
            <tr>
              <th scope="row">Link</th>
              <td><a href="" id="link_report"></a></td>
            </tr>
            <tr>
              <th scope="row">Company</th>
              <td id="company_title"></td>
            </tr>
            <tr>
              <th scope="row">Country</th>
              <td id="country"></td>
            </tr>
            <tr>
              <th scope="row">Date</th>
              <td id="sample_date"></td>
            </tr>
            <tr>
              <th scope="row">Message</th>
              <td id="report_message"></td>
            </tr>
            <tr>
              <th scope="row">Reason</th>
              <td id="report_reason"></td>
            </tr>
            <tr>
              <th scope="row">Lead Status</th>
              <td id="report_lead_status"></td>
            </tr>
            <tr id="follow_up_tr">
              <th scope="row">Follow Up Date</th>
              <td id="follow_up_td"></td>
            </tr>
            <tr>
              <th scope="row">Note</th>
              <td><textarea id="report_textarea" name="lead_note"></textarea>
                <input type="hidden" name="lead_id" id="lead_id_modal" value="">
              </td>
            </tr>
            <tr>
              <th scope="row">Assigned By</th>
              <td id="report_assigned_by"></td>
            </tr>
            <tr>
              <th scope="row">Assigned To</th>
              <td id="report_assigned_to"></td>
            </tr>
          </tbody>
        </table>
        <button type="submit" id="update_lead_btn" class="btn btn-primary">Update Lead</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="assign_lead_manually">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Select Department:</label>
            <input type="hidden" name="lead_id" value="" id="assign_lead_id">
            <select class="form-control" id="change_dept_lead">
                <option value="" selected="" disabled="">==Select Department==</option>
                <?php
                foreach ($departments as $dept) {
                ?>
                <option value="<?=$dept['dept_id']?>"><?=$dept['department_name']?></option>
                <?php
                }
                ?>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Select Employee:</label>
            <select class="form-control" name="emp_id" required="" id="assign_emp_main"></select>
            <br><br>
            <button class="btn btn-primary">Assign</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade new-modal" id="createLeadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog new-modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body new-modal-body">
        <form id="create_lead_manual">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" required="" class="form-control" name="name" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="email-name" class="col-form-label">Email:</label>
            <input type="email" required="" name="email" class="form-control" id="email-name">
          </div>
          <div class="form-group">
            <label for="report-name" class="col-form-label">Report Title:</label>
            <input type="text" class="form-control" name="title" id="report-name">
          </div>
          <div class="form-group">
            <label for="phone-name" class="col-form-label">Phone:</label>
            <input type="text" name="phone" class="form-control" id="phone-name">
          </div>
          <div class="form-group">
            <label for="job-title-name" class="col-form-label">Job Title:</label>
            <input type="text" name="job_title" class="form-control" id="job-title-name">
          </div>
          <div class="form-group">
            <label for="link-name" class="col-form-label">Link:</label>
            <input type="text" required="" name="link" placeholder="Always start with http:// or https://" class="form-control" id="link-name">
          </div>
          <div class="form-group">
            <label for="company-name" class="col-form-label">Company:</label>
            <input type="text" name="company" class="form-control" id="company-name">
          </div>
          <div class="form-group">
            <label for="country-name" class="col-form-label">Country:</label>
            <input type="text" class="form-control" name="country" id="country-name">
          </div>
          <div class="form-group">
            <label for="date-name" class="col-form-label">Date:</label>
            <input type="date" name="sample_date" required="" class="form-control" id="date-name">
          </div>
          <div class="form-group">
            <label for="reason-name" class="col-form-label">Reason:</label>
            <input type="text" name="reason" class="form-control" id="reason-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" name="message" id="message-text"></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Create Lead</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>