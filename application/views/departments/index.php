<div class="pcoded-content">
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Departments</h5>
                    <p class="m-b-0">Add/Edit Departments</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Departments</a>
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
                        <h5>Add Department</h5>
                    </div>
                    <div class="card-block">
                        <form action="<?=base_url()?>add-department" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Department Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="department_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                <button type="submit" class="btn waves-effect waves-light btn-grd-primary ">Submit</button>
                            </div>
                            </div>
                        </form>
                        <?php if ($this->session->flashdata('department_success')) { ?>
                            <div class="alert alert-success"> <?= $this->session->flashdata('department_success') ?> </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('department_error')) { ?>
                                <div class="alert alert-danger"> <?= $this->session->flashdata('department_error') ?> </div>
                            <?php } ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Departments List</h5>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($departments as $dept) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$count?></th>
                                        <td class="text-center"><?=$dept['department_name']?></td>
                                        <td class="text-center"><button class="btn waves-effect waves-light btn-grd-primary dept_editor" dept_name="<?=$dept['department_name']?>" dept_id="<?=base64_encode($dept['dept_id'])?>">Edit</button>&nbsp;&nbsp;&nbsp;<button class="btn waves-effect waves-light btn-grd-danger delete_dept" dept_id="<?=base64_encode($dept['dept_id'])?>">Delete</button></td>
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

<div class="modal fade" id="updateDeptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updateDept">
          <div class="form-group">
            <label for="dept_update_input">Department Name</label>
            <input type="text" class="form-control" name="department_name" id="dept_update_input">
            <input type="hidden" name="dept_id" id="dept_id_update">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>