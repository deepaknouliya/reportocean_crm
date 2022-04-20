<div class="pcoded-content">
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Designations</h5>
                    <p class="m-b-0">Add/Edit Designations</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Designations</a>
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
                        <h5>Add Designation</h5>
                    </div>
                    <div class="card-block">
                        <form id="add_designation">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select Department</label>
                                <div class="col-sm-10">
                                    <select name="dept_id" class="form-control">
                                        <option value="" selected="" disabled="" required="">Select Department</option>  
                                        <?php
                                        foreach ($departments as $dept) {
                                        ?>
                                        <option value="<?=base64_encode($dept['dept_id'])?>"><?=$dept['department_name']?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Designation Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="designation_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                <button type="submit" class="btn waves-effect waves-light btn-grd-primary">Submit</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Designations List</h5>
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
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Designation</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td class="text-center">Otto</td>
                                        <td class="text-center">Otto</td>
                                        <td class="text-center"><button class="btn waves-effect waves-light btn-grd-primary ">Edit</button>&nbsp;&nbsp;&nbsp;<button class="btn waves-effect waves-light btn-grd-danger ">Delete</button></td>
                                    </tr>
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