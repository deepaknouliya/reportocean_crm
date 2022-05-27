      <div class="pcoded-main-container">
              <div class="pcoded-wrapper">
                  <nav class="pcoded-navbar">
                      <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                      <div class="pcoded-inner-navbar main-menu">
                          <div class="">
                              <div class="main-menu-header">
                                  <img class="img-80 img-radius" src="<?=base_url()?>upload/images/<?=$_SESSION['user_data'][0]['image_name']?>" alt="User-Profile-Image">
                                  <div class="user-details">
                                      <span id="more-details"><?=$_SESSION['user_data'][0]['employee_name']?><i class="fa fa-caret-down"></i></span>
                                  </div>
                              </div>
        
                              <div class="main-menu-content">
                                  <ul>
                                      <li class="more-details">
                                          <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                                          <?php
                                          if ($_SESSION['user_data'][0]['perm_3']==1) {
                                          ?>
                                          <a href="<?=base_url('settings')?>"><i class="ti-settings"></i>Settings</a>
                                          <?php
                                          }
                                          ?>
                                          <a href="<?=base_url('logout')?>"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                          <!-- <div class="p-15 p-b-0">
                              <form class="form-material">
                                  <div class="form-group form-primary">
                                      <input type="text" name="footer-email" class="form-control" required="">
                                      <span class="form-bar"></span>
                                      <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>
                                  </div>
                              </form>
                          </div> -->
                          <div class="pcoded-navigation-label" data-i18n="nav.category.navigation"></div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="<?php if($this->uri->segment(1)=="dashboard" || $this->uri->segment(1)=="")echo "active";?>">
                                  <a href="<?=base_url()?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
                          <?php
                            if ($_SESSION['user_data'][0]['perm_1']==1) {
                            ?>
                          <ul class="pcoded-item pcoded-left-item">
                            
                            <li class="pcoded-hasmenu <?php
                            if($this->uri->segment(1)=="unassigned-leads" || $this->uri->segment(1)=="new-leads" || $this->uri->segment(1)=="on-hold" || $this->uri->segment(1)=="follow-ups" || $this->uri->segment(1)=="closed" || $this->uri->segment(1)=="rejected" || $this->uri->segment(1)=="all-leads"){
                              echo "pcoded-trigger active";
                            } 
                            ?>">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Lead Management</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                                  <ul class="pcoded-submenu">
                                    <?php
                                    if ($_SESSION['user_data'][0]['perm_3']==1) {
                                    ?>
                                    <li class="<?php if($this->uri->segment(1)=="all-leads")echo "active";?>">
                                          <a href="<?=base_url('all-leads')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">All Leads</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                    <li class="<?php if($this->uri->segment(1)=="unassigned-leads")echo "active";?>">
                                          <a href="<?=base_url('unassigned-leads')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Unassigned Leads</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <?php
                                      }
                                      ?>
                                      <li class="<?php if($this->uri->segment(1)=="new-leads")echo "active";?>">
                                          <a href="<?=base_url('new-leads')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">New Leads</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class="<?php if($this->uri->segment(1)=="on-hold")echo "active";?>">
                                          <a href="<?=base_url('on-hold')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">On Hold</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class="<?php if($this->uri->segment(1)=="follow-ups")echo "active";?>">
                                          <a href="<?=base_url('follow-ups')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Follow Ups</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class="<?php if($this->uri->segment(1)=="closed")echo "active";?>">
                                          <a href="<?=base_url('closed')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Closed</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class="<?php if($this->uri->segment(1)=="rejected")echo "active";?>">
                                          <a href="<?=base_url('rejected')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Rejected</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                  </ul>
                              </li>

                          </ul>
                          <?php
                              }
                              ?>

                         <?php
                            if ($_SESSION['user_data'][0]['perm_3']==1) {
                            ?>

                          <ul class="pcoded-item pcoded-left-item">
                              <li class="<?php if($this->uri->segment(1)=="departments")echo "active";?>">
                                  <a href="<?=base_url('departments')?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Departments</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>       
                          </ul>

                          <ul class="pcoded-item pcoded-left-item">
                              <li class="<?php if($this->uri->segment(1)=="designations")echo "active";?>">
                                  <a href="<?=base_url('designations')?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Designations</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>       
                          </ul>
        
                          <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu <?php if($this->uri->segment(1)=="add-employee" || $this->uri->segment(1)=="view-employees"){
                              echo "pcoded-trigger active";
                            }?>">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Manage Employees</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                                  <ul class="pcoded-submenu">
                                      <li class="<?php if($this->uri->segment(1)=="add-employee")echo "active";?>">
                                          <a href="<?=base_url('add-employee')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Add Employee</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class="<?php if($this->uri->segment(1)=="view-employees")echo "active";?>">
                                          <a href="<?=base_url('view-employees')?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">View Employees</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                          </ul>

                          <!-- <ul class="pcoded-item pcoded-left-item">
                              <li>
                                  <a href="chart.html" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Announcements</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>     
                          </ul> -->
                          
                          <?php
                          }
                          ?>
                      </div>
                  </nav>