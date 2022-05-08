<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://malsup.github.io/jquery.blockUI.js"></script>
<script>
function new_func(){
    console.log("hello");
    setTimeout( function(){ 
    $('div.leader').block({ message: 'Not Available in Manual Mode' });
  }  , 1000 );
}
</script>
<style>
.leaders{
    width: 25%;
}
.sorting_zone{
    cursor: pointer;
}
.switch {
    position: relative;
    display: block;
    vertical-align: top;
    width: 100px;
    height: 30px;
    padding: 3px;
    margin: 0 10px 10px 0;
    background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
    background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
    border-radius: 18px;
    box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
    cursor: pointer;
    box-sizing:content-box;
}
.switch-input {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    box-sizing:content-box;
}
.switch-label {
    position: relative;
    display: block;
    height: inherit;
    font-size: 10px;
    text-transform: uppercase;
    background: #eceeef;
    border-radius: inherit;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
    box-sizing:content-box;
}
.switch-label:before, .switch-label:after {
    position: absolute;
    top: 50%;
    margin-top: -.5em;
    line-height: 1;
    -webkit-transition: inherit;
    -moz-transition: inherit;
    -o-transition: inherit;
    transition: inherit;
    box-sizing:content-box;
}
.switch-label:before {
    content: attr(data-off);
    right: 11px;
    color: #aaaaaa;
    text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
    content: attr(data-on);
    left: 11px;
    color: #FFFFFF;
    text-shadow: 0 1px rgba(0, 0, 0, 0.2);
    opacity: 0;
}
.switch-input:checked ~ .switch-label {
    background: #E1B42B;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
    opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
    opacity: 1;
}
.switch-handle {
    position: absolute;
    top: 4px;
    left: 4px;
    width: 28px;
    height: 28px;
    background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
    background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
    border-radius: 100%;
    box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -6px 0 0 -6px;
    width: 12px;
    height: 12px;
    background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
    background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
    border-radius: 6px;
    box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
    left: 74px;
    box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
    transition: All 0.3s ease;
    -webkit-transition: All 0.3s ease;
    -moz-transition: All 0.3s ease;
    -o-transition: All 0.3s ease;
}
@media only screen and (max-width: 575px){
.card .card-header .card-header-right {
     display: inline-block; 
}
</style>
<div class="pcoded-content">
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Settings</h5>
                    <p class="m-b-0">Manage Leads Flow</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Lead</a>
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
                    <div class="col-sm-6">
                    <!-- Basic Form Inputs card start -->

                <div class="card">
                    <div class="card-header">
                        <h5>Leads Manager</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <label class="switch">
                                <input class="switch-input" <?php
                                $lead_automate = $lead_automator[0]['automate'];
                                if ($lead_automate==1) {
                                    echo "checked";
                                }
                                ?> id="settings" type="checkbox" />
                                <span class="switch-label" data-on="Automatic" data-off="Manual"></span> 
                                <span class="switch-handle"></span> 
                            </label>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fa fa-bar-chart f-28"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($lead_automate!=1) {
            echo "<script>new_func();</script>";
        }
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card leader">
                    <div class="card-header">
                        <h5>Lead Automator</h5>
                        <div class="card-header-right">
                            <button class="btn waves-effect waves-light btn-grd-primary" data-toggle="modal" data-target="#leaderModal" style="margin-top:-10px;">Add Employee</button>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Report Ocean</th>
                                        <th class="text-center">Astute Analytica</th>
                                        <th class="text-center">Panorama Japan</th>
                                        <th class="text-center">Sorting</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    $i = 0;
                                    $id_product_first_item = $leads_employees[0]["list_id"];
                                    $id_product_last_item = $leads_employees[(sizeof($leads_employees)-1)]["list_id"];
                                    foreach ($leads_employees as $emps) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$count?></th>
                                        <td class="text-center"><?=$emps['employee_name']?></td>
                                        <td class="text-center"><?=$emps['department_name']?></td>
                                        <td class="text-center"><?=$emps['report_ocean']?></td>
                                        <td class="text-center"><?=$emps['astute']?></td>
                                        <td class="text-center"><?=$emps['panorama']?></td>
                                        <td class="text-center">
                                            <div class="sorting_zone">
                                            <?php 
                                        if($emps["list_id"]!=$id_product_last_item){ 
                                            $prod_next_id_item = $leads_employees[($i+1)]["list_id"];
                                        ?>
                                        <i class="fa fa-arrow-circle-down" onclick="return adminSwapProductItem(<?php echo $emps["list_id"]; ?>,<?php echo $prod_next_id_item; ?>);"></i>
                                        <?php 
                                        }

                                        if($emps["list_id"]!=$id_product_first_item){ 
                                            $prod_previous_id_item = $leads_employees[($i-1)]["list_id"];
                                        ?>
                                        <i class="fa fa-arrow-circle-up" onclick="return adminSwapProductItem(<?php echo $emps["list_id"]; ?>,<?php echo $prod_previous_id_item; ?>);"></i>
                                        <?php 
                                        }
                                        ?>
                                        </div>
                                        </td>
                                        <td class="text-center"><button emp_name="<?=$emps['employee_name']?>" dept_name="<?=$emps['department_name']?>" list_id="<?=$emps['list_id']?>" class="btn waves-effect waves-light btn-grd-primary view_list" rpt="<?=$emps['report_ocean']?>" ast="<?=$emps['astute']?>" pan="<?=$emps['panorama']?>">View/Edit</button>&nbsp;&nbsp;&nbsp;<button class="btn waves-effect waves-light btn-grd-danger ">Deactivate</button>&nbsp;&nbsp;&nbsp;<button class="btn waves-effect waves-light btn-grd-danger ">Remove</button></td>
                                    </tr>
                                    <?php
                                    $i++;
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

<div class="modal fade" id="leaderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee to automate leads</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_emp_automate">
        <div class="form-group">
        <label for="dept_set_change">Select Department</label>
        <select class="form-control" id="dept_set_change">
            <option value="" selected="" disabled="">--Select Department--</option>
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
        <label for="exampleFormControlSelect2">Select Employee</label>
        <select name="emp_id[]" multiple class="form-control" id="exampleFormControlSelect2">
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="leadAdjustModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Daily Leads Quota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_quota">
        <div class="form-group">
            <label for="emp_name">Employee Name</label>
            <input type="text" id="emp_name" readonly="" class="form-control">
        </div>
        <div class="form-group">
            <label for="dept_name">Department Name</label>
            <input type="text" id="dept_name" readonly="" class="form-control">
            <input type="hidden" name="list_id" id="list_ids">
        </div>
        <div class="form-group">
            <label for="rpt_ocean">Report Ocean</label>
            <input type="number" min="0" id="rpt_ocean" required="" name="report_ocean" class="form-control leaders">
        </div>
        <div class="form-group">
            <label for="astute_id">Astute</label>
            <input type="number" min="0" id="astute_id" required="" name="astute" class="form-control leaders">
        </div>
        <div class="form-group">
            <label for="panorama_id">Panorama</label>
            <input type="number" min="0" id="panorama_id" required="" name="panorama" class="form-control leaders">
        </div>
        <button type="submit" class="btn btn-primary">Update Quota</button>
        </form>
      </div>
    </div>
  </div>
</div>