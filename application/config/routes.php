<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['departments'] = 'DepartmentController/index';
$route['designations'] = 'DepartmentController/designations';
$route['add-employee'] = 'EmployeeController/add_employee';
$route['view-employees'] = 'EmployeeController/view_employees';
$route['edit-employee/(:any)'] = 'EmployeeController/edit_employee/$1';
$route['all-leads'] = 'LeadsController/all_leads';
$route['unassigned-leads'] = 'LeadsController/unassigned_leads';
$route['new-leads'] = 'LeadsController/new_lead';
$route['on-hold'] = 'LeadsController/on_hold';
$route['follow-ups'] = 'LeadsController/follow_ups';
$route['closed'] = 'LeadsController/closed';
$route['rejected'] = 'LeadsController/rejected';
$route['settings'] = 'LeadsController/settings';
$route['delete-lead'] = 'LeadsController/delete_lead';
$route['login'] = 'LoginController';
$route['login-ajax'] = 'LoginController/login_ajax';
$route['logout'] = 'LoginController/logout';
$route['add-department'] = 'DepartmentController/add_department';
$route['update-dept'] = 'DepartmentController/update_department';
$route['delete-dept'] = 'DepartmentController/delete_dept';
$route['add-designation'] = 'DepartmentController/add_designation';
$route['fetch-designations'] = 'DepartmentController/fetch_designations';
$route['add-employee-ajax'] = 'EmployeeController/add_employee_ajax';
$route['edit-employee-ajax'] = 'EmployeeController/edit_employee_ajax';
$route['activate-employee'] = 'EmployeeController/activate_employee';
$route['fetch-emp-department'] = 'DepartmentController/fetch_employee_department';
$route['fetch-emp-department-all'] = 'DepartmentController/fetch_emp_department_all';
$route['add-emp-automate'] = 'LeadsController/add_emp_automate';
$route['update-automate'] = 'LeadsController/update_automate';
$route['swap-employee'] = 'LeadsController/swap_employee';
$route['update-quota'] = 'LeadsController/update_quota';
$route['create-lead-api'] = 'LeadsController/create_lead_api';
$route['fetch-lead'] = 'LeadsController/fetch_lead';
$route['update-lead'] = 'LeadsController/update_lead';
$route['assign-lead-manually'] = 'LeadsController/assign_lead_manually';
$route['create-lead-manual'] = 'LeadsController/create_lead_manual';

