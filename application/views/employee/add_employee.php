<div class="pcoded-content">
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Employee</h5>
                    <p class="m-b-0">Add Employee</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Add Employee</a>
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
                        <h5>Add Employee</h5>
                    </div>
                    <div class="card-block">
                        <form id="add_employee">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Employee ID</label>
                                <div class="col-sm-4">
                                    <input type="text" name="employee_id" required class="form-control">
                                </div>

                                <label class="col-sm-2 col-form-label">Date Of Joining</label>
                                <div class="col-sm-4">
                                    <input type="date" required="" name="doj" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Employee Name</label>
                                <div class="col-sm-4">
                                    <input type="text" required="" name ="employee_name" class="form-control">
                                </div>

                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="gender" value="male" checked="" id="flexRadioDefault1">
                                          <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2">
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
                                        <option value="<?=$dept['dept_id']?>"><?=$dept['department_name']?></option>
                                        <?php
                                        $count++;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Select Designation</label>
                                <div class="col-sm-4">
                                    <select name="desig_id" required="" id="desig_select" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-4">
                                    <input type="email" required="" name="email" class="form-control">
                                </div>

                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-2">
                                    <input type="text" required="" id="passwordEmp" name="password" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <span id="genPass" class="btn waves-effect waves-light btn-grd-primary ">Generate</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mobile No.</label>
                                <div class="col-sm-4">
                                    <input type="tel" maxlength="13" pattern="((\+*)((0[ -]+)*|(91 )*)(\d{12}+|\d{10}+))|\d{5}([- ]*)\d{6}"  name="mobile" class="form-control">
                                </div>

                                <label class="col-sm-2 col-form-label">Upload Profile Pic</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_name[]" class="form-control">
                                </div>
                            </div>
                            <h4 class="sub-title">Permissions</h4>
                            <div class="form-group row">
                                  <input class="col-sm-2 col-form-label" checked type="checkbox" value="1" name="perm_1" id="defaultCheck1">
                                  <label class="form-check-label" for="defaultCheck1">
                                    Lead Management
                                  </label>

                                  <input class="col-sm-2 col-form-label" checked type="checkbox" value="1" name="perm_2" id="defaultCheck1">
                                  <label class="form-check-label" for="defaultCheck1">
                                    Profile
                                  </label>

                                  <input class="col-sm-2 col-form-label" type="checkbox" name="perm_3" value="1" id="defaultCheck1">
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