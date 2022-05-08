<div class="pcoded-content">
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Employees</h5>
                    <p class="m-b-0">Employee List</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">View Employees</a>
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
                        <h5>Employee List</h5>
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
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Designation</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($employee_data as $emp_data) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$count?></th>
                                        <td class="text-center"><?=$emp_data['employee_name']?></td>
                                        <td class="text-center"><?=$emp_data['department_name']?></td>
                                        <td class="text-center"><?=$emp_data['designation_name']?></td>
                                        <td class="text-center"><button class="btn waves-effect waves-light btn-grd-primary ">View/Edit</button>&nbsp;&nbsp;&nbsp;<button class="btn waves-effect waves-light btn-grd-danger ">Deactivate</button>&nbsp;&nbsp;&nbsp;<button class="btn waves-effect waves-light btn-grd-danger ">Delete</button></td>
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