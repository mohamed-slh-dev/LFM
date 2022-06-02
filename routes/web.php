<?php

use Illuminate\Support\Facades\Route;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login custom controller
Route::post('/logged_in','loginController@authenticate')->name('login_');

Route::post('/logout_','loginController@logout')->name('logout_');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');





//using composer for passing data to layout
View::composer('layouts.client-layout', function( $view )
{
    //get the language from session
    $lang = Session::get('lang');

    //check if client session is valid
    if (Session::get('client_id')) {
        $client_id = Session::get('client_id');
    } else {
        return redirect(route('client-login'));
    }
    

    $files_q = DB::table('t_files')
    ->where('client_id',$client_id)
    ->get();

    foreach ($files_q as $file) {
       $files[] = $file->file_id;
    }

    $main_cases_q = DB::table('t_cases_master')
    ->whereIn('S_CASE_FILE_NUM', $files)
    ->get();

    foreach ($main_cases_q as $main_case) {
        $main_cases[] = $main_case->N_CASE_ID;
     }
         
    $activities =  DB::table('activities')
    ->whereIn('main_case', $main_cases)
    ->limit(20)
    ->get();

    $view->with( 'lang', $lang )
    ->with( 'activities', $activities );

});


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//using composer for passing data to layout
View::composer('layouts.main-layout', function( $view )
{
    //get the language from session
    $lang = Session::get('lang');

    $modules = array();

    //get user role
    $user_role =  DB::table('users_permissions')
    ->where('user_id' , auth()->user()->id)
    ->first();

    
    //check if the user is admin (role_id = 17) then show all activities else view user's activities
    if ($user_role->role_id != 17 ) {
        $others = "hide";
        $activities =  DB::table('activities')
    ->join('users', 'users.id', '=', 'activities.create_by')
    ->select('users.name AS user_create','activities.*')
    ->where('assign_to', auth()->user()->id)
    ->orWhere('assign_to', 0)
    ->orderBy('activities.id' , 'desc')
    ->get();
    }else{
        $others = "show";
        $activities =  DB::table('activities')
    ->join('users', 'users.id', '=', 'activities.create_by')
    ->select('users.name AS user_create','activities.*')
    ->orderBy('activities.id' , 'desc')
    ->limit(10)
    ->get();
    }


    //check if user has role else create role by default (0)
    if ($user_role) {
       
    $permissions =  DB::table('permissions')
    ->where('access' , 1)
    ->where('role_id' ,  $user_role->role_id)
    ->get();
    
    foreach ($permissions as $perm) {
        $modules[]  =  $perm->module_name;
    }
   
   
    }else{

        $data = array();
        $data['user_id'] =  auth()->user()->id;
        $data['role_id'] =0;
        $user_permission = DB::table('users_permissions')->insert($data);

        }

       //pass the data to the view
       $logo = DB::table('about_info')
       ->first('logo');

       $view->with( 'modules', $modules )
       ->with( 'others', $others )
       ->with('activities',$activities)
       ->with('logo',$logo)
       ->with( 'lang', $lang );

});

//login page languags roots
Route::get('/lang-ar', function () { 

    Session::put('lang', 'ar');
    return  redirect()->back();
})->name('lang-ar');

Route::get('/lang-eng', function () { 

    Session::put('lang', 'eng');
    return  redirect()->back();
})->name('lang-eng');

//languags roots from login
Route::get('/lang-ar-login', function () { 

    Session::put('lang', 'ar');
    return  redirect()->route('login-ar');
})->name('lang-ar-login');

Route::get('/lang-eng-login', function () { 

    Session::put('lang', 'eng');
    return  redirect()->route('login-en');
})->name('lang-eng-login');



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//direct links

Route::get('/', function () {return view('login');})->name('login-ar');

Route::get('/login-en', function () {return view('login-en');})->name('login-en');

Route::get('/register', function () {return view('auth.register');});

Route::get('/rules-and-regulations', function () {   return view('rules-and-regulations');})->name('rules-and-regulations')->middleware('auth');

Route::get('/library', function () {  return view('library');})->name('library')->middleware('auth');

Route::get('/cases-news', function () {  return view('cases-news');})->name('cases-news')->middleware('auth');

Route::get('/courts', function () {  return view('courts');})->name('courts')->middleware('auth');

Route::get('/depts-jurisdictions', function () {   return view('depts-jurisdictions');})->name('depts-jurisdictions')->middleware('auth');

Route::get('/case-calendar', function () {  return view('case-manage.calendar');})->name('case-calendar')->middleware('auth');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//home controller

Route::get('/index','HomeController@index')->name('index');

Route::get('/about','HomeController@about')->name('about')->middleware('auth');

Route::get('/search-dashboard','HomeController@search_dashboard')->name('search-dashboard')->middleware('auth');

Route::get('/common-question','HomeController@common_question')->name('common-question')->middleware('auth');

Route::get('/my-profile','HomeController@my_profile')->name('my-profile')->middleware('auth');

Route::post('/update-profile/{user_id}', 'HomeController@update_profile')->name('update-profile');

Route::post('/update-user-password/{client_id}', 'HomeController@update_user_password')->name('update-user-password');

Route::post('/assign-task','HomeController@assign_task')->name('assign-task');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//clients controller

Route::get('/clients','clientsController@index')->name('clients')->middleware('auth');

Route::post('/add-clients','clientsController@add_client')->name('add-client');

Route::get('/client-profile/{from}/{client_id}', 'clientsController@client_profile')->name('client-profile');

Route::post('/update-client-details/{client_id}', 'clientsController@update_client_details')->name('update-client-details');

Route::post('/update-client-password/{client_id}', 'clientsController@update_client_password')->name('update-client-password');

Route::post('/search-clients','clientsController@search_clients')->name('search-clients');

Route::get('/search-clients','clientsController@search_clients_index')->name('search-clients');


Route::get('/experts-offices','clientsController@experts_offices')->name('experts-offices')->middleware('auth');

Route::post('/add-expert','clientsController@add_expert')->name('add-expert');

Route::get('delete-expert/{expert_id}','clientsController@delete_expert')->name('delete-expert');

Route::get('/opponents','clientsController@opponents')->name('opponents')->middleware('auth');

Route::post('/add-opponents','clientsController@add_opponents')->name('add-opponents');

Route::post('/update-opponent-details/{opponent_id}', 'clientsController@update_opponent_details')->name('update-opponent-details');

Route::get('/opponent-profile/{from}/{opponent_id}', 'clientsController@opponent_profile')->name('opponent-profile');

Route::post('/search-againsts','clientsController@search_againsts')->name('search-againsts');

Route::get('/search-againsts','clientsController@search_againsts_index')->name('search-againsts');


Route::get('/clients-updates','clientsController@clients_updates')->name('clients-updates')->middleware('auth');

Route::post('/clients-updates','clientsController@get_clients_updates')->name('clients-updates')->middleware('auth');

Route::post('/add-contract-admin','clientsController@add_contract')->name('add-contract-admin');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//file controller

Route::get('/files','filesController@index')->name('files')->middleware('auth');

Route::post('/add-file','filesController@add_file')->name('add-file');

Route::post('/search-files','filesController@search_file')->name('search-files');

Route::get('/search-files','filesController@search_files_index')->name('search-files')->middleware('auth');

Route::post('/file-case', 'filesController@file_case')->name('file-case')->middleware('auth');

Route::get('/file-case/{main_case_id}', 'filesController@file_case_withID')->name('file-case-withID')->middleware('auth');

Route::post('/add-against','filesController@add_against')->name('add-against');

Route::get('/delete-against/{against_id}/{file_id}', 'filesController@delete_against')->name('delete-against');

Route::post('/update-file', 'filesController@update_file')->name('update-file');









////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//main cases controller

Route::get('/main-cases','mainCasesController@main_cases')->name('main-cases')->middleware('auth');

Route::post('/add-main-cases','mainCasesController@add_main_cases')->name('add-main-cases')->middleware('auth');

Route::get('/close-case/{main_case_id}','mainCasesController@close_case')->name('close-case');

Route::get('/open-case/{main_case_id}','mainCasesController@open_case')->name('open-case');

Route::post('/search-main-cases','mainCasesController@search_main_cases')->name('search-main-cases')->middleware('auth');

Route::get('/search-main-cases','mainCasesController@search_main_cases_index')->name('search-main-cases')->middleware('auth');

Route::get('/main-case-cases/{main_case_id}', 'mainCasesController@main_case_cases')->name('main-case-cases')->middleware('auth');

Route::get('/main-case-cases/{main_case_id}/{case_id}', 'mainCasesController@main_case_cases_withId')->name('main-case-cases')->middleware('auth');

Route::post('/update-main-case', 'mainCasesController@update_main_case')->name('update-main-case');

Route::post('/update-require', 'mainCasesController@update_require')->name('update-require');



Route::get('/file-case-list','mainCasesController@file_case_list')->name('file-case-list')->middleware('auth');

Route::get('/search-file-list','mainCasesController@file_case_list')->name('search-file-list')->middleware('auth');

Route::get('/search-case-list','mainCasesController@file_case_list')->name('search-case-list')->middleware('auth');

Route::post('/search-file-list','mainCasesController@search_file_list')->name('search-file-list')->middleware('auth');

Route::post('/search-case-list','mainCasesController@search_case_list')->name('search-case-list')->middleware('auth');






//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//cases controller

Route::get('/cases-dashboard','casesController@dashboard')->name('cases-dashboard')->middleware('auth');

Route::get('/cases','casesController@cases')->name('cases')->middleware('auth');

Route::post('/search-cases','casesController@search_cases')->name('search-cases')->middleware('auth');

Route::get('/search-cases','casesController@search_cases_index')->name('search-cases')->middleware('auth');

Route::get('/case-details/{case_id}', 'casesController@case_details')->name('case-details');

Route::post('/update-case-details/{case_id}', 'casesController@update_case_details')->name('update-case-details');

Route::post('/add-case-details', 'casesController@add_case_details')->name('add-case-details');

Route::get('/excutes','casesController@excutes')->name('excutes')->middleware('auth');

Route::post('/excutes','casesController@search_excutes')->name('search-excutes')->middleware('auth');

Route::get('/excute-documents/{excute_id}/{main_case_id}', 'casesController@excute_documents')->name('excute-documents');
Route::post('/add-excute-document', 'casesController@add_excute_document')->name('add-excute-document');

Route::post('/add-excute-stage', 'casesController@add_excute_stage')->name('add-excute-stage');

Route::get('/excute-details/{excute_id}', 'casesController@excute_details')->name('excute-details');

Route::post('/update-excute-details/{excute_id}', 'casesController@update_excute_details')->name('update-excute-details');

Route::get('delete-excute/{excute_id}','casesController@delete_excute')->name('delete-excute');

Route::get('/excute-actions/{excute_stage_id}', 'casesController@excute_actions')->name('excute-actions');

Route::post('/add-excute-action', 'casesController@add_excute_action')->name('add-excute-action');

Route::post('/update-action', 'casesController@update_action')->name('update-action');

Route::get('delete-action/{action_id}','casesController@delete_action')->name('delete-action');

Route::post('/update-decision', 'casesController@update_decision')->name('update-decision');

Route::get('/case-stages/{case_id}', 'casesController@case_stages')->name('case-stages');

Route::get('delete-stage/{stage_id}','casesController@delete_stage')->name('delete-stage');

Route::post('/add-case-stage', 'casesController@add_case_stage')->name('add-case-stage');

Route::post('/edit-case-stage', 'casesController@edit_case_stage')->name('edit-case-stage');

Route::post('/cases-team', 'casesController@cases_team')->name('cases-team');

Route::get('/cases-dashboard','casesController@dashboard')->name('cases-dashboard')->middleware('auth');

Route::get('/case-tasks/{case_id}/{main_case_id}', 'casesController@case_tasks')->name('case-tasks');

Route::post('/add-case-task', 'casesController@add_case_task')->name('add-case-task');

Route::post('/add-task', 'casesController@add_task')->name('add-task');

Route::get('/case-memoir/{case_id}/{main_case_id}', 'casesController@case_memoir')->name('case-memoir');

Route::post('/add-case-memoir', 'casesController@add_case_memoir')->name('add-case-memoir');

Route::post('/update-memoir-status', 'casesController@update_memoir_status')->name('update-memoir-status');

Route::get('/delete-memoir/{memoir_id}', 'casesController@delete_memoir')->name('delete-memoir');

Route::get('/excute-tasks/{excute_id}/{main_case_id}', 'casesController@excute_tasks')->name('excute-tasks');

Route::get('/case-documents/{case_id}/{main_case_id}', 'casesController@case_documents')->name('case-documents');

Route::post('/add-case-document', 'casesController@add_case_document')->name('add-case-document');

Route::get('/cases-tasks','casesController@tasks')->name('cases-tasks');

Route::post('/cases-tasks','casesController@search_tasks')->name('cases-tasks');

Route::post('/update-task-status', 'tasksController@update_task_status')->name('update-task-status');

Route::get('/delete-task/{task_id}', 'tasksController@delete_task')->name('delete-task');

Route::get('/hide-stage/{stage_id}','casesController@hide_stage')->name('hide-stage')->middleware('auth');






//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tasks controller

Route::get('/all-tasks','tasksController@all_tasks')->name('all-tasks')->middleware('auth');

Route::get('/adminstrative-tasks','tasksController@adminstrartive_tasks')->name('adminstrative-tasks')->middleware('auth');

Route::get('/public-tasks','tasksController@public_tasks')->name('public-tasks')->middleware('auth');

Route::post('/add-adminstrative-task', 'tasksController@add_adminstrative_task')->name('add-adminstrative-task');

Route::post('/add-public-task', 'tasksController@add_public_task')->name('add-public-task');

Route::get('/specific-tasks','tasksController@specific_tasks')->name('specific-tasks')->middleware('auth');

Route::post('/add-specific-task', 'tasksController@add_specific_task')->name('add-specific-task');

Route::get('/tasks-reports','tasksController@tasks_reports')->name('tasks-reports')->middleware('auth');

Route::post('/print-tasks-reports','tasksController@print_tasks_reports')->name('print-tasks-reports')->middleware('auth');







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//reports controller

Route::get('/file-reports','reportsController@file_reports')->name('file-reports')->middleware('auth');

Route::post('/report-by-file','reportsController@report_by_file')->name('report-by-file')->middleware('auth');

Route::get('/register-reports','reportsController@register_reports')->name('register-reports')->middleware('auth');

Route::post('/register-reports','reportsController@get_register_reports')->name('register-reports')->middleware('auth');

Route::get('/stages-schedule','reportsController@stages_schedule')->name('stages-schedule')->middleware('auth');

Route::post('/stages-schedule','reportsController@get_stages_schedule')->name('stages-schedule')->middleware('auth');

Route::get('/experts-stages','reportsController@experts_stages')->name('experts-stages')->middleware('auth');

Route::post('/experts-stages','reportsController@get_experts_stages')->name('experts-stages')->middleware('auth');

Route::get('/memoir-schedule','reportsController@memoir_schedule')->name('memoir-schedule')->middleware('auth');

Route::post('/memoir-schedule','reportsController@get_memoir_schedule')->name('memoir-schedule')->middleware('auth');




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//notifications controller

Route::get('/stages-notifications','notificationsController@stages_notifications')->name('stages-notifications')->middleware('auth');

Route::get('/decision-notifications','notificationsController@decision_notifications')->name('decision-notifications')->middleware('auth');

Route::get('/shortStages-notifications','notificationsController@shortStages_notifications')->name('shortStages-notifications')->middleware('auth');

Route::get('/public-notifications','notificationsController@public_notifications')->name('public-notifications')->middleware('auth');

Route::post('/add-public-notification','notificationsController@add_public_notification')->name('add-public-notification');

Route::get('/direct-notifications','notificationsController@direct_notifications')->name('direct-notifications')->middleware('auth');

Route::post('/add-direct-notification','notificationsController@add_direct_notification')->name('add-direct-notification');







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//hr controllors

Route::get('/all-employees','hrController@all_employees')->name('all-employees')->middleware('auth');

Route::get('delete-user/{user_id}','hrController@delete_user')->name('delete-user');

Route::get('active-user/{user_id}','hrController@active_user')->name('active-user');

Route::get('/departments','hrController@departments')->name('departments')->middleware('auth');

Route::post('/add-department','hrController@add_department')->name('add-department');

Route::get('delete-department/{dept_id}','hrController@delete_department')->name('delete-department');

Route::post('/add-user','hrController@add_user')->name('add-user');

Route::get('/roles','hrController@roles')->name('roles')->middleware('auth');

Route::post('/add-role','hrController@add_role')->name('add-role');

Route::get('delete-role/{role_id}','hrController@delete_role')->name('delete-role');

Route::post('/add-user-permission', 'hrController@add_user_permission')->name('add-user-permission');

Route::get('/hr-calendar', function () { return view('HR.hr-calendar');})->name('hr-calendar')->middleware('auth');

Route::get('/leave','hrController@leave')->name('leave')->middleware('auth');

Route::post('/add-leave','hrController@add_leave')->name('add-leave');

Route::get('/delete-leave/{leave_id}','hrController@delete_leave')->name('delete-leave');

Route::get('/activities','hrController@activities')->name('activities')->middleware('auth');

Route::get('/login-register','hrController@login_register')->name('login-register')->middleware('auth');







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//system settings

Route::get('/system-settings','systemSettingsController@system_settings')->name('system-settings')->middleware('auth');

Route::post('/add-task-type', 'systemSettingsController@add_task_type')->name('add-task-type');

Route::post('/add-option', 'systemSettingsController@add_option')->name('add-option');

Route::post('/add-sentence', 'systemSettingsController@add_sentence')->name('add-sentence');

Route::post('/edit-sentence', 'systemSettingsController@edit_sentence')->name('edit-sentence');

Route::get('/public-settings','systemSettingsController@public_settings')->name('public-settings')->middleware('auth');

Route::post('/update-about-info','systemSettingsController@update_info')->name('update-about-info')->middleware('auth');

Route::post('/update-logo','systemSettingsController@update_logo')->name('update-logo')->middleware('auth');

Route::post('/add-question', 'systemSettingsController@add_question')->name('add-question');

Route::get('/delete-question/{q_id}','systemSettingsController@delete_question')->name('delete-question');

Route::post('/update-question', 'systemSettingsController@update_question')->name('update-question');

Route::get('/accounts-settings','systemSettingsController@accounts_settings')->name('accounts-settings')->middleware('auth');

Route::post('/update-password', 'systemSettingsController@update_password')->name('update-password');

Route::get('/delete-sentence/{sent_id}','systemSettingsController@delete_sentence')->name('delete-sentence');

Route::get('/delete-option/{option_id}','systemSettingsController@delete_option')->name('delete-option');







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//client portal

Route::get('/client-login','clientPortalController@client_login')->name('client-login');

Route::get('/client-home','clientPortalController@client_home')->name('client-home');

Route::post('/client-login-check','clientPortalController@client_login_check')->name('client-login-check');

Route::get('/client-about','clientPortalController@about')->name('client-about');

Route::get('/client-common-question','clientPortalController@common_question')->name('client-common-question');

Route::get('/client-rules-and-regulations', function () { return view('client-portal.rules-and-regulations');})->name('client-rules-and-regulations');

Route::get('/client-library', function () {  return view('client-portal.library');})->name('client-library');

Route::get('/client-courts', function () {  return view('client-portal.courts');})->name('client-courts');

Route::get('/client-depts-jurisdictions', function () {   return view('client-portal.depts-jurisdictions');})->name('client-depts-jurisdictions');

Route::get('/client-my-dashboard','clientPortalController@my_dashboard')->name('my-dashboard');

Route::get('/client-all-files','clientPortalController@all_files')->name('all-files');

Route::get('/client-file-cases/{main_case_id}','clientPortalController@file_cases')->name('client-file-cases');

Route::get('/client-case-report/{main_case_id}','clientPortalController@case_report')->name('case-report');

Route::get('/client-all-cases','clientPortalController@all_cases')->name('all-cases');

Route::get('/client-all-excutes','clientPortalController@all_excutes')->name('all-excutes');

Route::get('/client-excute-actions/{excute_stage_id}', 'clientPortalController@excute_actions')->name('client-excute-actions');

Route::get('/client-main-case-cases/{main_case_id}', 'clientPortalController@main_case_cases')->name('client-main-case-cases');

Route::get('/client-main-case-cases/{main_case_id}/{case_id}', 'clientPortalController@main_case_cases_withId')->name('client-main-case-cases');

Route::get('/client-activities','clientPortalController@activities')->name('client-activities');

Route::get('/client-open-case','clientPortalController@open_case')->name('client-open-case');

Route::post('/add-open-case','clientPortalController@add_open_case')->name('add-open-case');

Route::post('/client-add-case-document', 'clientPortalController@add_case_document')->name('client-add-case-document');


Route::post('/client-search-cases','clientPortalController@search_cases')->name('client-search-cases');

Route::get('/client-search-cases','clientPortalController@all_cases')->name('client-search-cases');

Route::post('/client-search-cases-reports','clientPortalController@search_cases_reports')->name('client-search-cases-reports');
Route::get('/client-search-cases-reports','clientPortalController@cases_reports')->name('client-search-cases-reports');

Route::get('/client-cases-reports','clientPortalController@cases_reports')->name('client-cases-reports');

Route::get('/client-stages-reports','clientPortalController@stages_reports')->name('client-stages-reports');

Route::get('/client-case-details/{case_id}', 'clientPortalController@case_details')->name('client-case-details');

Route::get('/client-case-stages/{case_id}', 'clientPortalController@case_stages')->name('client-case-stages');

Route::get('/client-case-tasks/{case_id}/{main_case_id}', 'clientPortalController@case_tasks')->name('client-case-tasks');

Route::get('/client-decision-notifications','clientPortalController@decision_notifications')->name('client-decision-notifications');

Route::post('/client-assign-task','clientPortalController@client_assign_task')->name('client-assign-task');

Route::get('/client-delete-task/{task_id}', 'clientPortalController@delete_task')->name('client-delete-task');


Route::get('/client-invoices','clientPortalController@client_invoices')->name('client-invoices');


Route::get('/client-identity','clientPortalController@client_identity')->name('client-identity');

Route::get('/client-contracts','clientPortalController@client_contracts')->name('client-contracts');

Route::get('/client-profile','clientPortalController@client_profile')->name('client-profile');

Route::post('/add-identity','clientPortalController@add_identity')->name('add-identity');

Route::post('/add-contract','clientPortalController@add_contract')->name('add-contract');

Route::get('/delete-contract/{cont_id}','clientPortalController@delete_contract')->name('delete-contract');


Route::get('/client-case-documents/{case_id}/{main_case_id}', 'clientPortalController@case_documents')->name('client-case-documents');

Route::get('/client-chats','clientPortalController@client_chats')->name('client-chats');

Route::post('/add-client-message', 'clientPortalController@add_message')->name('add-client-message');









////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tickets controller
Route::get('/tickets','ticketController@tickets')->name('tickets')->middleware('auth');

Route::get('/processing-ticket/{ticket_id}','ticketController@processing_ticket')->name('processing-ticket');

Route::get('/complete-ticket/{ticket_id}','ticketController@complete_ticket')->name('complete-ticket');


Route::get('/client-tickets','ticketController@client_tickets')->name('client-tickets');

Route::post('/add-ticket', 'ticketController@add_ticket')->name('add-ticket');

Route::get('/cancel-ticket/{ticket_id}','ticketController@cancel_ticket')->name('cancel-ticket');

Route::get('/delete-tickect/{ticket_id}','ticketController@delete_ticket')->name('delete-tickect');








//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//chats controller

Route::get('/chats','chatController@chats')->name('chats')->middleware('auth');

Route::post('/add-chat', 'chatController@add_chat')->name('add-chat');

Route::get('/chat-messages/{chat_id}','chatController@chat_messages')->name('chat-messages')->middleware('auth');

Route::post('/add-member', 'chatController@add_member')->name('add-member');

Route::get('/delete-member/{cm_id}','chatController@delete_member')->name('delete-member');

Route::post('/add-message', 'chatController@add_message')->name('add-message');

Route::get('/delete-chat/{chat_id}','chatController@delete_chat')->name('delete-chat');

Route::get('/client-chat-messages/{chat_id}','chatController@client_chat_messages')->name('client-chat-messages')->middleware('auth');

Route::post('/add-admin-client-message', 'chatController@add_client_message')->name('add-admin-client-message');




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
