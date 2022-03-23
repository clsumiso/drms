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


$route = array (

    'default_controller'                => 'homepageController',
    'email-us'                          => 'homepageController/email_us',
    'feedback'                          => 'homepageController/feedback',
    'maintenance'                       => 'homepageController/maintenance',

    'student/active'                    => 'studentController/active_student',
    'student/active_request'            => 'studentController/insert_active_request',

    'student/inactive'                  => 'studentController/inactive_student',
    'student/inactive_request'          => 'studentController/insert_inactive_request',

    'student/courses'                   => 'studentController/getCourse',

    
    'login'                             => 'loginController',
    'staff_login'                       => 'loginController/login',
    'staff_logout'                      => 'loginController/logout',
    'admin_login'                       => 'loginController/loginAdmin',
    'admin_signinAdmin'                 => 'loginController/signinAdmin',
    
    'staff'                             => 'staffController',
    'staff/getStaffName'                => 'staffController/getStaffDetails',
    'staff/getRemindPop'                => 'staffController/getReminderCountPopup',
    'staff/navCount'                    => 'staffController/getNavigationCount',
    'staff/getRequest'                  => 'staffController/getListDocument',
    'staff/getReminderRequest'          => 'staffController/getReminderRequest',
    'staff/getOutboxRequest'            => 'staffController/getOutboxRequest',
    'staff/review'                      => 'staffController/getRequestReview',
    'staff/notes'                       => 'staffController/notes',
    'staff/getSearch'                   => 'staffController/get_search_request',
    'staff/declineRequest'              => 'staffController/mailDeclineRequest',
    'staff/ondeliveryRequest'           => 'staffController/mailOnDelivery',
    'staff/deliveredRequest'            => 'staffController/mailDelivered',
    'staff/sendDocumentRequest'         => 'staffController/mailSendDocument',


    'admin'                             => 'adminController',
    'admin/accounts'                    => 'adminController/accountManagement',
    'admin/courses'                     => 'adminController/courseManagement',
    'admin/handlers'                    => 'adminController/handlersManagement',
    'admin/feedbacks'                   => 'adminController/feedbackManagement',
    'admin/reports'                     => 'adminController/reportManagement',
    'admin/maintenance'                 => 'adminController/maintenanceManagement',

    'admin/dashboard_employee_status'   => 'adminController/employeeStatus',
    'admin/dashboard_widgets'           => 'adminController/displayWidgets',

    'admin/display_account'             => 'adminController/display_staff_accounts',
    'admin/create_account'              => 'adminController/createStaffAccount',
    'admin/update_account'              => 'adminController/updateStaffAccount',
    'admin/delete_account'              => 'adminController/deleteStaffAccount',

    'admin/display_college'             => 'adminController/displayColleges',
    'admin/create_college'              => 'adminController/createColleges',
    'admin/update_college'              => 'adminController/updateColleges',
    'admin/delete_college'              => 'adminController/deleteColleges',

    'admin/get_colleges_opt'            => 'adminController/getCollegesOpt',
    'admin/display_course'              => 'adminController/displayCourse',
    'admin/create_course'               => 'adminController/createCourse',
    'admin/update_course'               => 'adminController/updateCourse',
    'admin/delete_course'               => 'adminController/deleteCourse',

    'admin/display_handler'             => 'adminController/displayHandlers',
    'admin/update_handler_ric'          => 'adminController/updateHandlerRIC',
    'admin/update_handler_frontline'    => 'adminController/updateHandlerFrontline',
    
    'admin/display_feedback_ratings'    => 'adminController/displayFeedbackRatings',
    'admin/display_suggestions'         => 'adminController/displaySuggestion'
);

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
