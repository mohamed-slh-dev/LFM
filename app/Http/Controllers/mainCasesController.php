<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
class mainCasesController extends Controller
{
    //main cases page
    public function main_cases(){

        //get the number of opened cases
        $close_cases = DB::table('t_cases_master')
        ->where('N_IsClosed', 1)
        ->get();

        //get the number of closed cases
        $open_cases = DB::table('t_cases_master')
        ->where('N_IsClosed', 0)
        ->get();

        //get all main cases
        $main_cases =  DB::table('t_cases_master')
        ->join('t_files','t_files.file_id', '=' , 't_cases_master.S_CASE_FILE_NUM')
        ->join('t_clients','t_clients.N_CLIENT_ID', '=' , 't_files.client_id')
        ->leftJoin('t_cases_againsts','t_cases_againsts.N_CASE_ID', '=' , 't_cases_master.N_CASE_ID')
        ->leftJoin('t_againsts','t_againsts.N_AGAINST_ID', '=' , 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('users AS assingUser', 'assingUser.id', '=', 't_cases_master.N_AdminPerson')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_cases_master.N_Consultant')
        ->leftJoin('t_detailedcodes AS branch', 'branch.N_DetailedCode', '=', 't_cases_master.N_BRANCH')
        ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 't_cases_master.N_CASE_STATUS')
        ->select('assingUser.name AS assignName','assingUser.id AS assignId', 'userConsult.name AS consultName','userConsult.id AS consultId',
         'branch.S_Desc_A AS branchName','branch.N_DetailedCode AS branchCode', 
          'caseStatus.S_Desc_A AS caseStatusName','caseStatus.N_DetailedCode AS caseStatusCode',
          't_againsts.S_AGAINST_AR_NAME AS againstName','t_clients.S_CLIENT_AR_NAME AS clientName',
         't_cases_master.*')
        ->where('N_IsClosed', 0)
        ->orderBy('N_CASE_ID', 'desc') 
        ->paginate(9);

        //get all clients 
        $clients = DB::table('t_clients')->get();

        //get all files
        $files = DB::table('t_files')->get();

       
      
        //get all cases status from details code
        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //get all branches from details code
        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();

        //gel all users
        $users =  DB::table('users')->get();



        //check the user permission to add main case
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_main_case')
        ->first();

       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_main_case = 'true';
        }else{
            $add_main_case = 'false';
        }
       }else{
        $add_main_case = 'false';
    }


        return view('case-manage.main-cases',compact('add_main_case','open_cases','close_cases','users',
         'main_cases','clients','files','branchs','case_status'));
    }

    //view signle main case
    public function main_case_cases($main_case_id){

        //get the case requiers if not create by default
        $check_case_requires =  DB::table('case_require')
        ->where('main_case_id', $main_case_id)
        ->get();

        if ($check_case_requires->count() < 1 ) {
           
          
            $case_require_data = array();

            $case_require_data['main_case_id']=$main_case_id;
            $case_require_data['require_name']= 'رخصة العمل' ;
            $insert_case_require = DB::table('case_require')->insert($case_require_data);

            $case_require_data['main_case_id']=$main_case_id;
            $case_require_data['require_name']= 'الهوية' ;
            $insert_case_require = DB::table('case_require')->insert($case_require_data);

            $case_require_data['main_case_id']=$main_case_id;
            $case_require_data['require_name']= 'ملف القضية' ;
            $insert_case_require = DB::table('case_require')->insert($case_require_data);

            $case_require_data['main_case_id']=$main_case_id;
            $case_require_data['require_name']= 'الرسوم' ;
            $insert_case_require = DB::table('case_require')->insert($case_require_data);

            $case_require_data['main_case_id']=$main_case_id;
            $case_require_data['require_name']= 'ترجمة عربية' ;
            $insert_case_require = DB::table('case_require')->insert($case_require_data);

            $case_require_data['main_case_id']=$main_case_id;
            $case_require_data['require_name']= 'ترجمة انجليزية' ;
            $insert_case_require = DB::table('case_require')->insert($case_require_data);

            $case_require_data['main_case_id']=$main_case_id;
            $case_require_data['require_name']= 'لائحة القضية' ;
            $insert_case_require = DB::table('case_require')->insert($case_require_data);

            $case_requires =  DB::table('case_require')
            ->leftJoin('users','users.id', '=' , 'case_require.assign_to')
            ->select('users.name AS assignName','users.id AS assignID','case_require.*' )
            ->where('main_case_id', $main_case_id)
            ->get();
            
        }else{
            $case_requires =  DB::table('case_require')
            ->leftJoin('users','users.id', '=' , 'case_require.assign_to')
            ->select('users.name AS assignName','users.id AS assignID','case_require.*' )
            ->where('main_case_id', $main_case_id)
            ->get();
        }

        $check_case_details =  DB::table('t_cases_details')
        ->where('N_CASE_ID', $main_case_id)
        ->get();
       
        if ($check_case_details->count()< 1 ) {
            $get_file_id =  DB::table('t_cases_master')
            ->where('N_CASE_ID', $main_case_id)
            ->first();
            $file_id =  $get_file_id->S_CASE_FILE_NUM;
            $data_case_details = array();

            $data_case_details['N_CASE_ID']=$main_case_id;
            $data_case_details['file_id']=$file_id;
            $insert_case_details = DB::table('t_cases_details')->insert($data_case_details);
        }

        //get the case details where main case id $main_case_id
        $case_details =  DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS clientType', 'clientType.N_DetailedCode', '=', 't_cases_details.N_CAPACITY_ID')
        ->leftJoin('t_detailedcodes AS deltailStage', 'deltailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->leftJoin('t_detailedcodes AS deltailDept', 'deltailDept.N_DetailedCode', '=', 't_cases_details.N_CASE_DIRECTORATE_ID')
        ->leftJoin('t_experts', 't_experts.N_Expert_ID', '=', 't_cases_details.N_Expert_ID')
        ->leftJoin('users AS user1', 'user1.id', '=', 't_cases_details.lawyer_1')
        ->leftJoin('users AS user2', 'user2.id', '=', 't_cases_details.lawyer_2')
        ->leftJoin('users AS user3', 'user3.id', '=', 't_cases_details.lawyer_3')
        ->select('deltailType.N_DetailedCode AS typeCode',
        'deltailType.S_Desc_A AS typeName',

        'deltailStage.N_DetailedCode AS stageCode',
        'deltailStage.S_Desc_A AS stageName',

        'clientType.N_DetailedCode AS clientTypeCode',
        'clientType.S_Desc_A AS clientTypeName',

        'deltailCourt.N_DetailedCode AS courtCode',
        'deltailCourt.S_Desc_A AS courtName',

        'deltailDept.N_DetailedCode AS deptCode',
        'deltailDept.S_Desc_A AS deptName',

        't_experts.N_Expert_ID AS expertId',
        't_experts.S_Expert_AR_NAME AS expertName',

        'user1.id AS id_1',
        'user1.name AS name_1',

        'user2.id AS id_2',
        'user2.name AS name_2',

        'user3.id AS id_3',
        'user3.name AS name_3',

          't_cases_details.*')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_DETAILS_ID', 'asc') 
        ->first();
        
        //get the last case number
        $last_case_id = $case_details->N_CASE_DETAILS_ID;

        $case_id = $last_case_id;

        ///get the last stage
        $last_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->first();

        //get the first case number (initial case)
        $first_case_details =  DB::table('t_cases_details')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_DETAILS_ID', 'asc') 
        ->first();
        

        //get the first case stage
        $first_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'asc')
        ->first();
      
        //get all the case stages
        $case_stages =  DB::table('t_hearing')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_hearing.N_Consultant')
        ->leftJoin('users AS userLawyer', 'userLawyer.id', '=', 't_hearing.N_LAWYER_ID')

        ->leftJoin('t_detailedcodes AS detail', 'detail.N_DetailedCode', '=', 't_hearing.N_HEARINGTYPE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_hearing.N_COURT_ID')
        ->select('detail.S_Desc_A AS typeName', 'detail.N_DetailedCode AS typeCode', 'userConsult.name AS consultName',
        'userConsult.id AS consultId','userLawyer.name AS lawyerName','userLawyer.id AS lawyerId',
        'deltailCourt.S_Desc_A AS courtName',
        'deltailCourt.N_DetailedCode AS courtId',
        't_hearing.*')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->get();

        //get all case tasks
        $case_tasks =  DB::table('t_tasks')
        ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
        ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
        ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->get();

         //get all case documents
        $case_detail_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->get();

         //get all main case tasks
        $case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_Case_ID', $main_case_id)
        ->get();

         //get all case client documents
        $client_case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->where('t_documents.N_UserID',-1)
        ->OrWhere('t_documents.N_UserID', null) 
        ->get();
        
        

        //get the file number of the main case
        $file_id_q =  DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_ID', 'desc') 
        ->first();

        //get the file id
        $file_id =  $file_id_q->S_CASE_FILE_NUM;

        //get the file client information
        $client_name = DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->select('t_clients.S_CLIENT_AR_NAME', 't_files.*')
        ->where('file_id',  $file_id  )
        ->first();
        
        //get the client name
        $client_name = $client_name->S_CLIENT_AR_NAME;

        //get the file against information
        $againsts = DB::table('t_cases_againsts')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->where('t_cases_againsts.file_id',$file_id)
        ->select('t_againsts.*',)
        ->get();



        $files = DB::table('t_files')->get();
        
        $main_case = DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->first();

        //get the cliam amount of the main case
        $main_case_payment = $main_case->N_PaymentValue;

        //get the register date of the main case
        $main_case_register_date = $main_case->register_date;
       
        //get all the cases of main case id = $main_case_id
        $cases = DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS deltailStage', 'deltailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->select('deltailType.S_Desc_A AS typeName','deltailStage.S_Desc_A AS stageName',
        'deltailCourt.S_Desc_A AS courtName',
        't_cases_details.*')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_DETAILS_ID', 'desc') 
        ->get();

        //get all the excutes of main case id = $main_case_id
        $excutes = DB::table('excute_stages')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('deltailType.S_Desc_A AS typeName',
        'excute_stages.*')
        ->where('main_case_id', $main_case_id)
        ->orderBy('excute_stage_id', 'desc') 
        ->get();

        //get all cases types from details code
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();


        //get all cases status from details code
        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();


        //get all cases stages from details code
        $case_stage = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->get();

        //get all excute types from details code
        $excute_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->where('S_Desc_A', 'LIKE','%' . 'تنفيذ' . '%')
        ->get();
        

        //get all courts from details code
        $court = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();


        //get all departments from details code
        $depts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 9)
        ->orderBy('S_Desc_A', 'asc')
        ->get();



       //check the user permission to add main case
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_case')
        ->first();

       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_case = 'true';
        }else{
            $add_case = 'false';
        }
       }else{
        $add_case = 'false';
    }

    $users = DB::table('users')
    ->orderBy('name', 'asc')
    ->get();
    
    $client_type = DB::table('t_detailedcodes')
    ->orderBy('S_Desc_A', 'asc')
    ->where('N_MasterCode', '=', 12)
    ->get();

    $experts = DB::table('t_experts')
    ->get();

    $stage_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 31)
    ->orderBy('S_Desc_A', 'asc')
    ->get();

    $main_case_show = 1;


    //get all case memoir
    $memoir =  DB::table('memoir')
    ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'memoir.excute_need')
    ->leftJoin('users AS create_by', 'create_by.id', '=', 'memoir.created_by')
    ->leftJoin('users AS assign', 'assign.id', '=', 'memoir.consultant')
    ->select('create_by.name AS createBy', 'assign.name AS assignTo', 
    't_detailedcodes.S_Desc_A AS excute_Name' ,'memoir.*')
    ->where('case_id', $last_case_id)
    ->get();


   
    $memoir_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 41)
    ->orderBy('S_Desc_A', 'asc')
    ->get();
   
      
        return view('case-manage.main-case-cases',compact('add_case','cases','files','main_case_id','case_id','file_id',
        'case_type','case_status','case_stage','court','depts','main_case',
        'users','client_name','againsts','excute_type','excutes','case_details',
        'client_type','experts','main_case_payment','case_stages','last_case_stage',
        'first_case_stage','case_tasks','case_docs','first_case_details','stage_type','case_detail_docs'
        ,'main_case_show','case_requires','main_case_register_date','memoir','memoir_type','client_case_docs'));
    }


    //view single main case cases
    public function main_case_cases_withId($main_case_id,$case_id){

        //check the case requiers if not create by default
        $case_requires =  DB::table('case_require')
        ->leftJoin('users','users.id', '=' , 'case_require.assign_to')
        ->select('users.name AS assignName','users.id AS assignID','case_require.*' )
        ->where('main_case_id', $main_case_id)
        ->get();

        //get the case details where case id = $case_id
        $case_details =  DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS clientType', 'clientType.N_DetailedCode', '=', 't_cases_details.N_CAPACITY_ID')
        ->leftJoin('t_detailedcodes AS deltailStage', 'deltailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->leftJoin('t_detailedcodes AS deltailDept', 'deltailDept.N_DetailedCode', '=', 't_cases_details.N_CASE_DIRECTORATE_ID')
        ->leftJoin('t_experts', 't_experts.N_Expert_ID', '=', 't_cases_details.N_Expert_ID')
        ->leftJoin('users AS user1', 'user1.id', '=', 't_cases_details.lawyer_1')
        ->leftJoin('users AS user2', 'user2.id', '=', 't_cases_details.lawyer_2')
        ->leftJoin('users AS user3', 'user3.id', '=', 't_cases_details.lawyer_3')
        ->select('deltailType.N_DetailedCode AS typeCode',
        'deltailType.S_Desc_A AS typeName',

        'deltailStage.N_DetailedCode AS stageCode',
        'deltailStage.S_Desc_A AS stageName',

        'clientType.N_DetailedCode AS clientTypeCode',
        'clientType.S_Desc_A AS clientTypeName',

        'deltailCourt.N_DetailedCode AS courtCode',
        'deltailCourt.S_Desc_A AS courtName',

        'deltailDept.N_DetailedCode AS deptCode',
        'deltailDept.S_Desc_A AS deptName',

        't_experts.N_Expert_ID AS expertId',
        't_experts.S_Expert_AR_NAME AS expertName',

        'user1.id AS id_1',
        'user1.name AS name_1',

        'user2.id AS id_2',
        'user2.name AS name_2',

        'user3.id AS id_3',
        'user3.name AS name_3',

          't_cases_details.*')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->first();

        //first case detiails
        $first_case_details =  DB::table('t_cases_details')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_DETAILS_ID', 'asc') 
        ->first();

        //get the last case id
        $last_case_id = $case_id;

        //get the last stage
        $last_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->first();
        

        //get the first stage (initial)
        $first_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'asc')
        ->first();
      
        //get all case stages
        $case_stages =  DB::table('t_hearing')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_hearing.N_Consultant')
        ->leftJoin('users AS userLawyer', 'userLawyer.id', '=', 't_hearing.N_LAWYER_ID')

        ->leftJoin('t_detailedcodes AS detail', 'detail.N_DetailedCode', '=', 't_hearing.N_HEARINGTYPE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_hearing.N_COURT_ID')
        ->select('detail.S_Desc_A AS typeName', 'detail.N_DetailedCode AS typeCode', 'userConsult.name AS consultName',
        'userConsult.id AS consultId','userLawyer.name AS lawyerName','userLawyer.id AS lawyerId',
        'deltailCourt.S_Desc_A AS courtName',
        'deltailCourt.N_DetailedCode AS courtId',
        't_hearing.*')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->get();

          
         //get all case tasks
        $case_tasks =  DB::table('t_tasks')
        ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
        ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
        ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->get();

         //get all case documents
        $case_detail_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->get();

         //get all main case tasks
        $case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_Case_ID', $main_case_id)
        ->get();
        
         //get all client documents
        $client_case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->where('t_documents.N_UserID',-1)
        ->OrWhere('t_documents.N_UserID', null) 
        ->get();

        //get the file id for the main case = $main_case_id
        $file_id_q =  DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_ID', 'desc') 
        ->first();

        //file id
        $file_id =  $file_id_q->S_CASE_FILE_NUM;

        //get the client information of the file
        $client_name = DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->select('t_clients.S_CLIENT_AR_NAME', 't_files.*')
        ->where('file_id',  $file_id  )  
        ->first(); 
        
        //get the client name
        $client_name = $client_name->S_CLIENT_AR_NAME;

        //get the against information of the file
        $againsts = DB::table('t_cases_againsts')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->where('t_cases_againsts.file_id',$file_id)
        ->select('t_againsts.*',)
        ->get();

        //get all files
        $files = DB::table('t_files')->get();
        
        $main_case = DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->first();

        //get the claim amount of the main case
        $main_case_payment = $main_case->N_PaymentValue;

        //get the register date
        $main_case_register_date = $main_case->register_date;
       
        //get all main case cases
        $cases = DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS deltailStage', 'deltailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->select('deltailType.S_Desc_A AS typeName','deltailStage.S_Desc_A AS stageName',
        'deltailCourt.S_Desc_A AS courtName',
        't_cases_details.*')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_DETAILS_ID', 'desc') 
        ->get();

        //get all excutes of the main case
        $excutes = DB::table('excute_stages')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('deltailType.S_Desc_A AS typeName',
        'excute_stages.*')
        ->where('main_case_id', $main_case_id)
        ->orderBy('excute_stage_id', 'desc') 
        ->get();

         //get all cases types from details code
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();

         //get all cases status from details code
        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

         //get all cases stages from details code
        $case_stage = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->get();

         //get all excute types from details code
        $excute_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->where('S_Desc_A', 'LIKE','%' . 'تنفيذ' . '%')
        ->get();
        
         //get all courts from details code
        $court = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

         //get all departments from details code
        $depts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 9)
        ->orderBy('S_Desc_A', 'asc')
        ->get();


        //check the user permission to add main case
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_case')
        ->first();

       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_case = 'true';
        }else{
            $add_case = 'false';
        }
       }else{
        $add_case = 'false';
    }

    //get all users
    $users = DB::table('users')
    ->orderBy('name', 'asc')
    ->get();
    
    //get all clients types from details code
    $client_type = DB::table('t_detailedcodes')
    ->orderBy('S_Desc_A', 'asc')
    ->where('N_MasterCode', '=', 12)
    ->get();

    //get all expert offices
    $experts = DB::table('t_experts')
    ->get();

    //get all cases stages from details code
    $stage_type = DB::table('t_detailedcodes')
    ->where('N_MasterCode', '=', 31)
    ->orderBy('S_Desc_A', 'asc')
    ->get();
   
    $main_case_show = 0;

    //get all case memoir
    $memoir =  DB::table('memoir')
    ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'memoir.excute_need')
    ->leftJoin('users AS create_by', 'create_by.id', '=', 'memoir.created_by')
    ->leftJoin('users AS assign', 'assign.id', '=', 'memoir.consultant')
    ->select('create_by.name AS createBy', 'assign.name AS assignTo', 
    't_detailedcodes.S_Desc_A AS excute_Name' ,'memoir.*')
    ->where('case_id', $case_id)
    ->get();
   
    //get memoir types from details code
    $memoir_type = DB::table('t_detailedcodes')
    ->where('N_MasterCode', '=', 41)
    ->orderBy('S_Desc_A', 'asc')
    ->get();

     
        return view('case-manage.main-case-cases',compact('add_case','cases','files','main_case_id','case_id','file_id',
        'case_type','case_status','case_stage','court','depts','main_case',
        'users','client_name','againsts','excute_type','excutes','case_details',
        'client_type','experts','main_case_payment','case_stages','last_case_stage',
        'first_case_stage','case_tasks','case_docs','first_case_details','stage_type','case_detail_docs',
        'main_case_show','case_requires','main_case_register_date','memoir','memoir_type','client_case_docs'));
    }

    //close case function (change the status of the case)
    public function close_case($main_case_id){

        //update the case status for the main case id = $main_case_id
        $close_case = DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->update(['N_IsClosed' => 1]);

        //check if status updated successfully
        if ($close_case) {
            return redirect()->route('main-cases')->with('success', 'تم اغلاق القضية بنجاح')
            ->with('ring','play');
            
        }
    }

    //open case function (change the status of the case)
    public function open_case($main_case_id){

        //update the case status for the main case id = $main_case_id
        $open_case = DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->update(['N_IsClosed' => 0]);

        //check if status updated successfully
        if ($open_case) {
            return  redirect()->back()->with('success', 'تم فتح القضية بنجاح')
            ->with('ring','play');
            
        }
    }


    //search for main case
    public function search_main_cases(Request $request){
      

          // filter here
          $filters = array();

          // id
          if ($request->main_case_num != null) {
  
              $filters["t_cases_master.N_CASE_ID"] = $request->main_case_num;
          }

          //status
          if ($request->status != 'all') {
  
            $filters["t_cases_master.N_CASE_STATUS"] = $request->status;
        }

        //branch
        if ($request->branch != 'all') {
  
            $filters["t_cases_master.N_BRANCH"] = $request->branch;
        }

       
        //get the main cases results with filter data
        $main_cases =  DB::table('t_cases_master')
        ->leftJoin('t_files','t_files.file_id', '=' , 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_clients','t_clients.N_CLIENT_ID', '=' , 't_files.client_id')
        ->leftJoin('t_cases_againsts','t_cases_againsts.N_CASE_ID', '=' , 't_cases_master.N_CASE_ID')
        ->leftJoin('t_againsts','t_againsts.N_AGAINST_ID', '=' , 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('users AS assingUser', 'assingUser.id', '=', 't_cases_master.N_AdminPerson')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_cases_master.N_Consultant')
        ->leftJoin('t_detailedcodes AS branch', 'branch.N_DetailedCode', '=', 't_cases_master.N_BRANCH')
        ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 't_cases_master.N_CASE_STATUS')
        ->select('assingUser.name AS assignName','assingUser.id AS assignId', 'userConsult.name AS consultName','userConsult.id AS consultId',
         'branch.S_Desc_A AS branchName','branch.N_DetailedCode AS branchCode',
         'caseStatus.S_Desc_A AS caseStatusName','caseStatus.N_DetailedCode AS caseStatusCode',
           't_againsts.S_AGAINST_AR_NAME AS againstName','t_clients.S_CLIENT_AR_NAME AS clientName',
         't_cases_master.*')
        ->where($filters)
        ->get();

      

         //get all cases status from details code
       $case_status = DB::table('t_detailedcodes')
       ->where('N_MasterCode', '=', 19)
       ->orderBy('S_Desc_A', 'asc')
       ->get();

        //get all branches from details code
       $branchs = DB::table('t_detailedcodes')
       ->where('N_MasterCode', '=', 1)->get();
         

        //get all cases types from details code
       $case_type = DB::table('t_detailedcodes')
       ->orderBy('S_Desc_A', 'asc')
       ->where('N_MasterCode', '=', 5)
       ->get();

       //get all users
       $users =  DB::table('users')->get();


        return view('search.main-cases-search',compact(['branchs','main_cases','case_status','case_type','users']));


    }

    
    //search main cases index page
    public function search_main_cases_index(){


        //get all main cases
        $main_cases = DB::table('t_cases_master')
        ->join('t_files','t_files.file_id', '=' , 't_cases_master.S_CASE_FILE_NUM')
        ->join('t_clients','t_clients.N_CLIENT_ID', '=' , 't_files.client_id')
        ->join('t_cases_againsts','t_cases_againsts.N_CASE_ID', '=' , 't_cases_master.N_CASE_ID')
        ->join('t_againsts','t_againsts.N_AGAINST_ID', '=' , 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('users AS assingUser', 'assingUser.id', '=', 't_cases_master.N_AdminPerson')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_cases_master.N_Consultant')
        ->leftJoin('t_detailedcodes AS branch', 'branch.N_DetailedCode', '=', 't_cases_master.N_BRANCH')
        ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 't_cases_master.N_CASE_STATUS')
        ->select('assingUser.name AS assignName','assingUser.id AS assignId', 'userConsult.name AS consultName','userConsult.id AS consultId',
         'branch.S_Desc_A AS branchName','branch.N_DetailedCode AS branchCode',
         'caseStatus.S_Desc_A AS caseStatusName','caseStatus.N_DetailedCode AS caseStatusCode',
           't_againsts.S_AGAINST_AR_NAME AS againstName',
         't_clients.S_CLIENT_AR_NAME AS clientName',
         't_cases_master.*')
        ->where('N_IsClosed', 0)
        ->orderBy('N_CASE_ID', 'desc') 
        ->paginate(9);

         //get all cases status from details code
        $case_status = DB::table('t_detailedcodes')
        ->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

         //get all branches from details code
        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();


        //get all cases types from details code
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();
       

        //get all users
        $users =  DB::table('users')->get();


        return view('search.main-cases-search',compact(['branchs','main_cases','case_status','case_type','users']));


    }

    

    //create new main cases
    public function add_main_cases(Request $request){

        //delete the (,) from fee and make it int
        $payment_value = preg_replace('/[,]/', '', $request->payment);
        $payment_value = intval($payment_value);

        $data = array(); 

        //get all new main case information from request and store it into array
        $data['S_CASE_FILE_NUM']=$request->file_id;
       
        $data['N_BRANCH']=$request->branch;
        $data['N_DoingPerson']=Auth::id();
        $data['S_CASE_SUBJECT']=$request->subject;
        $data['DT_CASE_DATE']= \Carbon\Carbon::now();
        $data['N_Consultant']=$request->consult;
        $data['N_AdminPerson']=$request->assignto;
        $data['N_CASE_STATUS']=$request->status;
        $data['N_PaymentValue']=$payment_value;
        
        

        //insert the main case
        $insert_main_case = DB::table('t_cases_master')->insertGetId($data);

        //get the new main case id
        $case_id =  $insert_main_case;

        $data_case_details = array();

        //create new case by default (initial case)
        $data_case_details['N_CASE_ID']=$case_id;
        $data_case_details['file_id']=$request->file_id;

        //insert new case
        $insert_case_details = DB::table('t_cases_details')->insert($data_case_details);

        
         //add notification(activity)
        $activity = array(); 
        $activity['short_name']='اضافة قضية';
        $activity['description']='تم اضافة قضية جديدة ('.$case_id.')';
        $activity['create_by']=Auth::id();
        $activity['assign_to'] = $request->assignto;
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$case_id";

        $insert_activity = DB::table('activities')->insert($activity);

        //check if main case added successfully
        if ($insert_main_case) {

            return redirect('file-case/'.$case_id)->with('success','تم اضافة قضية بنجاح')
            ->with('ring','play');

           }
    }


    //update main case information
    public function update_main_case(Request $request){

        //get the main case id, route
        $main_case_id = $request->main_case_id;
        $from_file = $request->from_file_case;
        
        //delete the (,) from fee and make it int
        $payment_value = preg_replace('/[,]/', '', $request->payment);
        $payment_value = intval($payment_value);

        $data = array(); 

        //get all new main case information from request and store it into array
        $data['N_BRANCH']=$request->branch;
        $data['N_CASE_STATUS']=$request->case_status;
        $data['N_AdminPerson']=$request->assignTo;
        $data['N_Consultant']=$request->consult;
        $data['S_CASE_SUBJECT']=$request->subject;
        $data['N_PaymentValue']= $payment_value;

    
        //update main case
        $update_main_case =  DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->update($data);

         //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث قضية';
        $activity['description']='تم تحديث القضية  ('.$main_case_id.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$main_case_id";

        $insert_activity = DB::table('activities')->insert($activity);
      
        //redirect to the route it came from
            if ($from_file == 1) {
                return redirect('file-case/'.$main_case_id)->with('success','تم تحديث القضية بنجاح');

            }else{
                return redirect()->back()->with('success','تم تحديث القضية بنجاح')
                ->with('ring','play');
            }

       

    }

    

    //update case requiers
    public function update_require(Request $request){
        
         //add notification(activity)
        $activity = array(); 
        $activity['short_name']='اعداد قضية';
        $activity['description']='تمت اضافة('.$request->name.')  في بيانات اعداد القضية('.$request->main_case_id.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$request->main_case_id";

 
        $insert_activity = DB::table('activities')->insert($activity);


        //get all new case require information from request and store it into array
        $data['require_name']=$request->name;
        $data['wanted_date']=$request->date;
        $data['description']=$request->desc;
        $data['assign_to']=$request->assign;

        //upload file
        if ($file = $request->file('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $filename= $request->name.'_'.time().'.'.$ext;
             $file->move('assets/case-requires/'.$request->main_case_id.'/', $filename);
    
             $data['file'] = $filename;
        }
              
        //update case require
        $update_rquire =  DB::table('case_require')
        ->where('require_id', $request->require_id)
        ->update($data);

        return redirect()->back()->with('success','تم تحديث  اعداد القضية بنجاح')
        ->with('ring','play');

     

    }

    
    //view all files cases list (deleted page)
    public function file_case_list(){
        $cases = DB::table('t_cases_master')
        ->orderBy('N_CASE_ID','desc')
        ->get();

        return view('case-manage.file-case-list',compact(['cases']));
    }


    //search in file list by file number page (deleted)
    public function search_file_list(Request $request){

        //get the file number
        $file_id = $request->file_id;

        $cases = DB::table('t_cases_master')
        ->where('S_CASE_FILE_NUM',  'LIKE','%' . $file_id . '%')
        ->orderBy('N_CASE_ID','desc')
        ->get();

        return view('case-manage.file-case-list',compact(['cases']));
    }



   //search in file list page by main case number (deleted)
    public function search_case_list(Request $request){
        //get the main case number
        $main_case_id = $request->main_case_id;

        $cases = DB::table('t_cases_master')
        ->where('N_CASE_ID',  $main_case_id)
        ->orderBy('N_CASE_ID','desc')
        ->get();

        return view('case-manage.file-case-list',compact(['cases']));
    }
   
}
