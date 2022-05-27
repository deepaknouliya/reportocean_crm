<div class="pcoded-content">
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Employee</h5>
                    <p class="m-b-0">Edit Employee</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Edit Employee</a>
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
                        <h5>Edit Employee</h5>
                    </div>
                    <div class="card-block">
                        <form id="edit_employee">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Employee ID</label>
                                <div class="col-sm-4">
                                    <input type="text" value="<?=$emp_data[0]['employee_id']?>" name="employee_id" required class="form-control">
                                    <input type="hidden" name="emp_id" value="<?=base64_encode($emp_data[0]['emp_id'])?>">
                                </div>

                                <label class="col-sm-2 col-form-label">Date Of Joining</label>
                                <div class="col-sm-4">
                                    <input type="date" required="" value="<?=$emp_data[0]['doj']?>" name="doj" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Employee Name</label>
                                <div class="col-sm-4">
                                    <input type="text" required="" value="<?=$emp_data[0]['employee_name']?>" name ="employee_name" class="form-control">
                                </div>

                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="gender" value="male" <?php
                                          if ($emp_data[0]['gender']=="male") {
                                              echo "checked";
                                          }
                                          ?> id="flexRadioDefault1">
                                          <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" <?php
                                          if ($emp_data[0]['gender']=="female") {
                                              echo "checked";
                                          }
                                          ?> name="gender" value="female" id="flexRadioDefault2">
                                          <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                          </label>
                                        </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select Department</label>
                                <div class="col-sm-4">
                                    <select name="dept_id" required="" id="emp_dept_change" class="form-control">
                                        <option value="" selected="" disabled="">Select Department</option>
                                        <?php
                                        foreach ($departments as $dept) {
                                        ?>
                                        <option <?php
                                        if ($dept['dept_id']==$emp_data[0]['dept_id']) {
                                            echo "selected";
                                        }
                                        ?> value="<?=$dept['dept_id']?>"><?=$dept['department_name']?></option>
                                        <?php
                                        $count++;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Select Designation</label>
                                <div class="col-sm-4">
                                    <select name="desig_id" required="" id="desig_select" class="form-control">
                                        <option selected value="<?=$emp_data[0]['desig_id']?>"><?=$emp_data[0]['designation_name']?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-4">
                                    <input type="email" required="" value="<?=$emp_data[0]['email']?>" readonly class="form-control">
                                </div>

                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-2">
                                    <input type="text" required="" value="<?=$emp_data[0]['password']?>" id="passwordEmp" name="password" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <span id="genPass" class="btn waves-effect waves-light btn-grd-primary ">Generate</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mobile No.</label>
                                <div class="col-sm-4">
                                    <input type="tel" value="<?=$emp_data[0]['mobile']?>" maxlength="13" pattern="((\+*)((0[ -]+)*|(91 )*)(\d{12}+|\d{10}+))|\d{5}([- ]*)\d{6}"  name="mobile" class="form-control">
                                </div>

                                <label class="col-sm-2 col-form-label">New Profile Pic</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_name[]" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                </div>

                                <label class="col-sm-2 col-form-label">Existing Profile Pic</label>
                                <div class="col-sm-4">
                                    <img style="height: 100px;" src="<?=base_url()?>upload/images/<?=$emp_data[0]['image_name']?>">
                                </div>
                            </div>

                            <h4 class="sub-title">Permissions</h4>
                            <div class="form-group row">
                                  <input class="col-sm-2 col-form-label" type="checkbox" value="1" <?php
                                  if ($emp_data[0]['perm_1']==1) {
                                      echo "checked";
                                  }
                                  ?> name="perm_1" id="defaultCheck1">
                                  <label class="form-check-label" for="defaultCheck1">
                                    Lead Management
                                  </label>

                                  <input class="col-sm-2 col-form-label" type="checkbox" value="1" name="perm_2" id="defaultCheck1" <?php
                                  if ($emp_data[0]['perm_2']==1) {
                                      echo "checked";
                                  }
                                  ?>>
                                  <label class="form-check-label" for="defaultCheck1">
                                    Profile
                                  </label>

                                  <input class="col-sm-2 col-form-label" type="checkbox" <?php
                                  if ($emp_data[0]['perm_3']==1) {
                                      echo "checked";
                                  }
                                  ?> name="perm_3" value="1" id="defaultCheck1">
                                  <label class="form-check-label" for="defaultCheck1">
                                    Admin Access
                                  </label>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                <button type="submit" class="btn waves-effect waves-light btn-grd-primary ">Submit</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>