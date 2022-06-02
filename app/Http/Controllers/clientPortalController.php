<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;


use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class clientPortalController extends Controller
{
    //increase the maximun excution time
    public function __construct()
        {
        ini_set('max_execution_time', 2000);
        }

        //view login page
    public function client_login(){
        return view('client-portal.client-login');
    }

    //view home page
    public function client_home(){

        //check if session is valid
        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }
        
     
        //get all client files
        $files_q = DB::table('t_files')
        ->where('client_id',$client_id)
        ->get();

        //get client files id's
        foreach ($files_q as $file) {
           $files[] = $file->file_id;
        }

        //get all client main cases
        $main_cases_q = DB::table('t_cases_master')
        ->whereIn('S_CASE_FILE_NUM', $files)
        ->get();

        //get client main cases id's
        foreach ($main_cases_q as $main_case) {
            $main_cases[] = $main_case->N_CASE_ID;
         }

         //client main cases
         $cases_q = DB::table('t_cases_details')
         ->whereIn('N_CASE_ID', $main_cases)
         ->get();
 
         //get client cases id's
         foreach ($cases_q as $case) {
             $cases[] = $case->N_CASE_DETAILS_ID;
          }


       
           //activites related to client's main cases
        $activities =  DB::table('activities')
        ->whereIn('main_case', $main_cases)
        ->limit(20)
        ->get();

        //get all client stages 
         $stages_noti = DB::table('t_hearing')
            ->leftjoin('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
            ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
            ->select('t_sentence_config.S_Desc_A', 't_sentence_config.S_NEXT_Desc_A',  't_sentence_config.N_Period',
            't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
            ->where('t_hearing.DT_HEARING_DATE' ,'>',Carbon::now() )
            ->whereIn('t_hearing.N_CASE_DETAILS_ID' ,$cases )
            ->orderBy('DT_HearingEnterDate', 'desc')
            ->paginate(20);

            //get all client cases
         $stages =  DB::table('t_cases_details')
         ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
         ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
         ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
         ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
         ->select('courtName.S_Desc_A AS courtName',
         'caseType.S_Desc_A AS caseType',
         'caseStage.S_Desc_A AS caseStage',
         't_againsts.S_AGAINST_AR_NAME AS againstName',
         't_cases_master.register_date AS register_date',
         't_cases_master.N_PaymentValue AS cliam_amount',
         't_cases_details.*')  
         ->whereIn('t_cases_master.N_CASE_ID',$main_cases)
         ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
         ->paginate(20);
 
      
        
        return view('client-portal.client-home',compact(['stages','stages_noti','activities']));
    }

   

    //client login check
    public function client_login_check(Request $request){
        $email = $request->email;
        $pass = $request->password;

        $client =  DB::table('t_clients')
        ->where('S_Email2' , $email)
        ->first();

        //check if client login data is valid
        if ($client) {
            if (Hash::check($pass, $client->password)) {
                Session::put('client_id',  $client->N_CLIENT_ID);
                Session::put('client_name',  $client->S_CLIENT_AR_NAME);
                Session::put('client_name_eng',  $client->S_CLIENT_EG_NAME);
                Session::put('client_pic',  $client->client_logo);
                Session::put('lang', 'ar');
                return redirect(route('client-home'));
            }else{
    
                return redirect(route('client-login'))->with('error','هنالك خطا في بيانات الدخول');
            } 
        }else{
            return redirect(route('client-login'))->with('error','هنالك خطا في بيانات الدخول');
        }
        
       
      }

      //about firm page
      public function about(){
        $about = DB::table('about_info')
        ->first();

        $clients = DB::table('t_clients')
        ->get();

        $cases = DB::table('t_cases_details')
        ->get();
    
         return view('client-portal.about',compact(['about','clients','cases']));
    }

    //common qustions page
    public function common_question(){
        $questions = DB::table('questions')
        ->get();
         return view('client-portal.common_question',compact(['questions']));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////

    //client profile page
    public function client_profile(){

        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        //client details
        $client_details = DB::table('t_clients')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_clients.N_CLIENTTYPE')
        ->leftJoin('t_detailedcodes AS deltailBranch', 'deltailBranch.N_DetailedCode', '=', 't_clients.N_BRANCH')
        ->leftJoin('t_detailedcodes AS deltailNation', 'deltailNation.N_DetailedCode', '=', 't_clients.N_NATIONALITY')
        ->select('deltailType.N_DetailedCode AS typeCode',
        'deltailType.S_Desc_A AS typeName',

        'deltailBranch.N_DetailedCode AS branchCode',
        'deltailBranch.S_Desc_A AS branchName',

        'deltailNation.N_DetailedCode AS nationCode',
        'deltailNation.S_Desc_A AS nationName',
          't_clients.*')
        ->where('N_CLIENT_ID', '=',$client_id)
        ->first();

        //get all nationlaties and branches
        $nationality = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 3)->get();
        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();

        return view('client-portal.client-profile',compact(['client_details','branchs','nationality']));
    }

    //client's identities
    public function client_identity(){
        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        $identities = DB::table('clients_identity')
        ->where('client_id',$client_id )
        ->get();

        //check if client identities less than 3 then create them by defalut
        if ($identities->count() < 3) {
            $identity = array();

            $identity['client_id']=$client_id;
            $identity['identity_name']= ' اثبات رخصة العمل' ;
            $insert_identity = DB::table('clients_identity')->insert($identity);

            $identity['client_id']=$client_id;
            $identity['identity_name']= ' اثبات الهوية - 1' ;
            $insert_identity = DB::table('clients_identity')->insert($identity);

            $identity['client_id']=$client_id;
            $identity['identity_name']= ' اثبات الهوية - 2' ;
            $insert_identity = DB::table('clients_identity')->insert($identity);

            $identity['client_id']=$client_id;
            $identity['identity_name']= 'اثبات الهوية - 3' ;
            $insert_identity = DB::table('clients_identity')->insert($identity);

            $identities = DB::table('clients_identity')
            ->where('client_id',$client_id )
            ->get();

        }
    
         return view('client-portal.client-identity',compact(['identities']));
    }

    //create client identity
    public function add_identity(Request $request){

        //store data into an array
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;

        //upload if has imagae identity
        if ($file = $request->file('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename= 'client_ident_'.time().'.'.$ext;
             $file->move('assets/clients-identities/', $filename);
    
             $data['identity'] = $filename;
        }
            
        //create identity (update the defalut identity)
        $add_ident =  DB::table('clients_identity')
        ->where('id', $request->ident_id)
        ->update($data);

        return redirect()->back()->with('success','تم اضافة اثبات بنجاح');
    }

    //my dashboard page
    public function my_dashboard(){
        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        //get all client files
        $files_q = DB::table('t_files')
        ->where('client_id',$client_id)
        ->get();

        //get all files id's
        foreach ($files_q as $file) {
           $files[] = $file->file_id;
        }
        
        //get main cases
        $main_cases_q = DB::table('t_cases_master')
        ->whereIn('S_CASE_FILE_NUM', $files)
        ->get();

        //get all main cases id's
        foreach ($main_cases_q as $main_case) {
            $main_cases[] = $main_case->N_CASE_ID;
         }
       
         //get client cases
         $cases = DB::table('t_cases_details')
        ->whereIn('N_CASE_ID', $main_cases)
        ->get();

        //get all cases id's
        foreach ($cases as $case) {
            $client_cases[] = $case->N_CASE_DETAILS_ID;
         }
       
       
         //get all unregistred cases
        $cases_not_registerd = DB::table('t_cases_details')
        ->whereIn('N_CASE_ID', $main_cases)
        ->where('N_CASE_STAGE',16561)
        ->get();

         //get all started cases
        $cases_startup = DB::table('t_cases_details')
        ->whereIn('N_CASE_ID', $main_cases)
        ->where('N_CASE_STAGE',16483)
        ->get();

         //get all decisions cases
        $decisions = DB::table('t_hearing')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_hearing.N_HEARINGTYPE')
        ->whereIn('N_CASE_DETAILS_ID', $client_cases)
        ->where('t_detailedcodes.S_Desc_A', 'LIKE','%' . 'حكم' . '%')     
       ->orderBy('DT_HearingEnterDate', 'desc')
        ->get();


        //get all client stsges
        $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
         ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
         ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
         ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
         ->select('courtName.S_Desc_A AS courtName',
         'caseType.S_Desc_A AS caseType',
         'caseStage.S_Desc_A AS caseStage',
         't_againsts.S_AGAINST_AR_NAME AS againstName',
         't_cases_master.register_date AS register_date',
         't_cases_master.N_PaymentValue AS cliam_amount',
         't_cases_details.*')  
         ->whereIn('t_cases_master.N_CASE_ID',$main_cases)
         ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
         ->paginate(20);
       
        
        return view('client-portal.my-dashboard',compact(['cases',
        'cases_not_registerd','cases_startup','decisions','stages']));
    }

    //client cases documents
    public function case_documents($case_id,$main_case_id){

        $case_detail_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->get();

        $case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_Case_ID', $main_case_id)
        ->get();
        // dd($case);
        return view('client-portal.case-documents',compact('case_docs', 'case_detail_docs','case_id','main_case_id'));
    }

    //client all cases
    public function all_cases(){
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

        $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->select('courtName.S_Desc_A AS courtName',
        'caseType.S_Desc_A AS caseType',
        'caseStage.S_Desc_A AS caseStage',
        't_againsts.S_AGAINST_AR_NAME AS againstName',
        't_cases_master.register_date AS register_date',
        't_cases_master.N_PaymentValue AS cliam_amount',
        't_cases_details.*')  
        ->whereIn('t_cases_master.N_CASE_ID',$main_cases)
        ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
        ->paginate(20);
      
      
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();

        $case_stage = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->get();
      

        return view('client-portal.all-cases',compact(['stages','case_type','case_stage']));

    }  

    //client files
    public function all_files(){
        if ( Session::get('client_id')) {
            $client_id = Session::get('client_id');
        }else{
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
        ->whereIn('t_cases_master.N_CASE_ID', $main_cases)
        ->orderBy('N_CASE_ID', 'desc') 
        ->paginate(12);

        $close_cases = DB::table('t_cases_master')
        ->where('N_IsClosed', 1)
        ->get();

        $open_cases = DB::table('t_cases_master')
        ->where('N_IsClosed', 0)
        ->get();

        return view('client-portal.all-files',compact(['main_cases','open_cases','close_cases']));
    }


    //client main cases
    public function file_cases($main_case_id){

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

       
        $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
         ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
         ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
         ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
         ->select('courtName.S_Desc_A AS courtName',
         'caseType.S_Desc_A AS caseType',
         'caseStage.S_Desc_A AS caseStage',
         't_againsts.S_AGAINST_AR_NAME AS againstName',
         't_cases_master.register_date AS register_date',
         't_cases_master.N_PaymentValue AS cliam_amount',
         't_cases_details.*')  
         ->where('t_cases_master.N_CASE_ID',$main_case_id)
         ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
         ->paginate(20);
 
     

         
        return view('client-portal.file-cases',compact(['stages']));
    }

    //client cases
    public function main_case_cases($main_case_id){

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
        
        $last_case_id = $case_details->N_CASE_DETAILS_ID;
        $case_id = $last_case_id;

        $last_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->first();

        $first_case_details =  DB::table('t_cases_details')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_DETAILS_ID', 'asc') 
        ->first();
        

        $first_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'asc')
        ->first();

        $case_tasks =  DB::table('client_tasks')
        ->select( 'client_tasks.*')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->get();
      
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

            
       

        
        $case_detail_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->get();

        $case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_Case_ID', $main_case_id)
        ->get();
        

        $file_id_q =  DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_ID', 'desc') 
        ->first();

        $file_id =  $file_id_q->S_CASE_FILE_NUM;

        $client_name = DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->select('t_clients.S_CLIENT_AR_NAME', 't_files.*')
        ->where('file_id',  $file_id  )
        ->first();  
        $client_name = $client_name->S_CLIENT_AR_NAME;

        // dd($client_name);
        $againsts = DB::table('t_cases_againsts')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->where('t_cases_againsts.file_id',$file_id)
        ->select('t_againsts.*',)
        ->get();



        $files = DB::table('t_files')->get();
        
        $main_case = DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->first();

        $main_case_payment = $main_case->N_PaymentValue;
        $main_case_register_date = $main_case->register_date;
       
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

        $excutes = DB::table('excute_stages')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('deltailType.S_Desc_A AS typeName',
        'excute_stages.*')
        ->where('main_case_id', $main_case_id)
        ->orderBy('excute_stage_id', 'desc') 
        ->get();

    
   

    $main_case_show = 1;

   
        // dd($case);
        return view('client-portal.main-case-cases',compact('cases','files','main_case_id','case_id'
        ,'file_id','main_case','client_name','againsts','excutes','case_details'
        ,'main_case_payment','case_stages','last_case_stage',
        'first_case_stage','case_docs','first_case_details','case_detail_docs'
        ,'main_case_show','main_case_register_date','case_tasks'));
    }

    //client case_id detalis
    public function main_case_cases_withId($main_case_id,$case_id){

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
         ->orderBy('N_CASE_DETAILS_ID', 'asc') 
        ->first();
        
        $last_case_id = $case_details->N_CASE_DETAILS_ID;
        $case_id = $last_case_id;

        $last_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->first();

        $first_case_details =  DB::table('t_cases_details')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_DETAILS_ID', 'asc') 
        ->first();
        

        $first_case_stage =  DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $last_case_id)
        ->orderBy('N_HEARING_ID', 'asc')
        ->first();
      
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

        $case_tasks =  DB::table('client_tasks')
        ->select( 'client_tasks.*')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->get();

        
        $case_detail_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->get();

        $case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_Case_ID', $main_case_id)
        ->get();
        

        $file_id_q =  DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->orderBy('N_CASE_ID', 'desc') 
        ->first();

        $file_id =  $file_id_q->S_CASE_FILE_NUM;

        $client_name = DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->select('t_clients.S_CLIENT_AR_NAME', 't_files.*')
        ->where('file_id',  $file_id  )
        ->first();  
        $client_name = $client_name->S_CLIENT_AR_NAME;

      
        $againsts = DB::table('t_cases_againsts')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->where('t_cases_againsts.file_id',$file_id)
        ->select('t_againsts.*',)
        ->get();



        $files = DB::table('t_files')->get();
        
        $main_case = DB::table('t_cases_master')
        ->where('N_CASE_ID', $main_case_id)
        ->first();

        $main_case_payment = $main_case->N_PaymentValue;
        $main_case_register_date = $main_case->register_date;
       
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

        $excutes = DB::table('excute_stages')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('deltailType.S_Desc_A AS typeName',
        'excute_stages.*')
        ->where('main_case_id', $main_case_id)
        ->orderBy('excute_stage_id', 'desc') 
        ->get();

    
   

    $main_case_show = 1;

   
        // dd($case);
        return view('client-portal.main-case-cases',compact('cases','files','main_case_id','case_id'
        ,'file_id','main_case','client_name','againsts','excutes','case_details'
        ,'main_case_payment','case_stages','last_case_stage',
        'first_case_stage','case_docs','first_case_details','case_detail_docs'
        ,'main_case_show','main_case_register_date','case_tasks'));
    }

    //client case report
    public function case_report($main_case_id){

        //check if session is valid
        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        //get all client files
        $files_q = DB::table('t_files')
        ->where('client_id',$client_id)
        ->get();

        //get all files id's
        foreach ($files_q as $file) {
           $files[] = $file->file_id;
        }

       
        $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
         ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
         ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
         ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
         ->select('courtName.S_Desc_A AS courtName',
         'caseType.S_Desc_A AS caseType',
         'caseStage.S_Desc_A AS caseStage',
         't_againsts.S_AGAINST_AR_NAME AS againstName',
         't_cases_master.register_date AS register_date',
         't_cases_master.N_PaymentValue AS cliam_amount',
         't_cases_details.*')  
         ->where('t_cases_master.N_CASE_ID',$main_case_id)
         ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
         ->get();

         $cases_count =  $stages->count();
         $print_date =  \Carbon\Carbon::now(+'4');
 
         $case_array = array();
         $decission_array = array();
 
         foreach ($stages as $stage ) {
            $case_array[] =  $stage;
         }
         
      
         for ($i=0; $i < count($case_array); $i++) { 
            $case_id = $case_array[$i]->N_CASE_DETAILS_ID;
 
             $stages =  DB::table('t_hearing')
             ->where('N_CASE_DETAILS_ID', $case_id)
             ->orderBy('N_HEARING_ID', 'desc')
             ->first();
 
             if ($stages) {
                 $decission_array[$i] = $stages->S_HEARING_DESIGION;
             }else{
                 $decission_array[$i] = 'لا توجد جلسات بعد';
             }
         } 

        return view('client-portal.case-report',compact(['case_array','decission_array','cases_count','print_date']));
    }

    //cliant excutions
    public function all_excutes(){

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



         //get all excutions
        $excutes = DB::table('excute_stages')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('deltailType.S_Desc_A AS typeName',
        'excute_stages.*')
        ->whereIn('main_case_id', $main_cases)
        ->orderBy('excute_stage_id', 'desc') 
        ->paginate(10);

        return view('client-portal.all-excutes',compact(['excutes']));

    }

    //client all stages decisions
    public function decision_notifications(){

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
       
     
       //get all cliets's descsisons
        $decisions_noti = DB::table('t_hearing')
        ->join('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
        ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->select('t_sentence_config.S_Desc_A', 't_sentence_config.S_NEXT_Desc_A',  't_sentence_config.N_Period',
        't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
        ->where('t_sentence_config.S_Desc_A', 'LIKE','%' . 'حكم' . '%')
        ->where('t_hearing.N_Reviewed',null)
        ->whereIn('t_cases_master.N_CASE_ID',$main_cases)
        ->orderBy('DT_HearingEnterDate', 'desc')
        ->paginate(20);


        $today_date = \Carbon\Carbon::now();
        return view('client-portal.decision-notifications',compact(['decisions_noti','today_date']));
    }

    //client excutions actions
    public function excute_actions($excute_stage_id){
        
      
        $excute_actions = DB::table('excute_actions')
        ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'excute_actions.excute_code')
        ->select('t_detailedcodes.S_Desc_A AS action_name','excute_actions.*')
        ->where('excute_stage_id', $excute_stage_id)
        ->get()
        ->groupBy('action_name');

        $excute_actions_models = DB::table('excute_actions')
        ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'excute_actions.excute_code')
        ->select('t_detailedcodes.S_Desc_A AS action_name','excute_actions.*')
        ->where('excute_stage_id', $excute_stage_id)
        ->get();

        $action_names = $excute_actions;
      

        return view('client-portal.excute-actions',compact(['excute_stage_id',
        'excute_actions','action_names','excute_actions_models']));

    }
    //client contract's page
    public function client_contracts(){
        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        $contract_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 40)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //get all client contracts
        $contracts = DB::table('contracts')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'contracts.contract_type')
        ->select( 't_detailedcodes.S_Desc_A AS contractType','contracts.*')
        ->where('client_id',$client_id )
        ->get();

        return view('client-portal.contracts',compact(['contracts','contract_type']));

    }

    //add new contract
    public function add_contract(Request $request){
        //cheack the session if valid
        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        $data['client_id']=$client_id;

        
        //get all new contract information from request and store it into array
        $data['contract_name']=$request->name;
        $data['contract_type']=$request->type;
        $data['amount']=$request->amount;
        $data['start_date']=$request->start;
        $data['end_date']=$request->end;
        $data['subject']=$request->subject;
        $data['country']=$request->country;
        $data['city']=$request->city;
        $data['state']=$request->state;
        $data['address']=$request->address;
        $data['phone']=$request->phone;
        $data['notes']=$request->notes;

        if ($file = $request->file('doc')) {
            $file = $request->file('doc');
            $ext = $file->getClientOriginalExtension();
            $filename= 'client_contract_'.time().'.'.$ext;
             $file->move('assets/clients-contracts/', $filename);
    
             $data['document'] = $filename;
        }
         //insert contract      
        $add_contract = DB::table('contracts')->insert($data);

        //check if contract added successfully
        if ($add_contract) {
            return redirect()->back()->with('success','تم اضافة عقد بنجاح');
        }
    }
      
    public function delete_contract($cont_id){

        //delete contract with id $cont_id
        $delete =  DB::table('contracts')
        ->where('id', $cont_id)
        ->delete();
   
        if ($delete) {
           return redirect()->back()->with('success','تم حذف العقد بنجاح');
   
        }
    }

    //create new task by client
    public function client_assign_task(Request $request){

        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        $data = array(); 
     
        
        //get all new task information from request and store it into array
        $data['N_CASE_ID']=$request->main_case_id;
        $data['N_CASE_DETAILS_ID']=$request->case_id;

        $data['S_SUBJECT']=$request->desc;

        $data['DT_DATE_STARTWORK']=\Carbon\Carbon::now();
        $data['DT_DOINGWORK']=$request->doing_date;
        $data['DT_WANTED']=$request->wanted_date;

        $data['N_EMPLOYEE_NO']='20';
        $data['S_NOTES']= $request->notes;
        $data['S_Comment']=$request->comment;
        $data['N_TaskType']='1';
        $data['N_Status']=$request->status;
     
        $data['created_by']=$client_id;

        //uplaod document
        if($file=$request->file('doc')){
            $file = $request->file('doc');
            $ext = $file->getClientOriginalExtension();
            $filename= 'client-doc'.'_'.time().'.'.$ext;
             $file->move('assets/clients-documents/', $filename);
             $data['document'] = $filename;
          
        }

         //add notification(activity)
        $activity = array(); 
        $activity['short_name']=' اضافة مهمة من عميل';
        $activity['description']=' تم اضافة مهمة جديدة من عميل ('.$request->notes.')';
        $activity['create_by']='0';
        $activity['assign_to'] ='20';
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
 
        $insert_activity = DB::table('activities')->insert($activity);

        $insert_case_task = DB::table('client_tasks')->insert($data);

        //check language 
        if ($insert_case_task) {
            if ( Session::get('lang') == "ar") {
                return redirect()->back()->with('success', 'تم اضافة مهمة للدعوى بنجاح')
                ->with('ring','play');
            }else{
                return redirect()->back()->with('success', 'Task Added Successfully To Case')
                ->with('ring','play');
            }
          
            
        }
    }

    public function delete_task($task_id){
       
        //delete task with id $task_id
        $delete_task = DB::table('client_tasks')
        ->where('N_TASK_ID', '=', $task_id)
        ->delete();

        //check if task deleted successfully
              if ($delete_task) {
                if ( Session::get('lang') == "ar") {
                    return redirect()->back()->with('success', 'تم حذف المهمة بنجاح');
                }else{
                    return redirect()->back()->with('success', 'Task Successfully Deleted');
                }
              
                
            }
    }

    
    public function case_details($case_id){

        //case details with id $case_id
        $case_details =  DB::table('t_cases_details')
        ->join('t_cases_master','t_cases_master.N_CASE_ID', '=' , 't_cases_details.N_CASE_ID')
        ->leftJoin('t_files','t_files.file_id', '=' , 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_clients','t_clients.N_CLIENT_ID', '=' , 't_files.client_id')
        ->leftJoin('t_cases_againsts','t_cases_againsts.N_CASE_ID', '=' , 't_cases_details.N_CASE_ID')
        ->leftJoin('t_againsts','t_againsts.N_AGAINST_ID', '=' , 't_cases_againsts.N_AGAINST_ID')
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

        't_againsts.S_AGAINST_AR_NAME AS againstName',
         't_clients.S_CLIENT_AR_NAME AS clientName',

         't_files.file_id AS fileID',
         
         't_cases_master.register_date AS registerDate',

          't_cases_details.*')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->first();

        return view('client-portal.case-details',compact('case_details'));
    }

    public function case_stages($case_id){

        //case stages for case id $case_id
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
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->get();

        return view('client-portal.case-stages',compact('case_stages'));
    }

    public function case_tasks($case_id,$main_case_id){

        //case tasks for case id $case_id
        $case_tasks =  DB::table('client_tasks')
        ->select( 'client_tasks.*')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->get();

        // dd($case);
        return view('client-portal.case-tasks',compact('case_tasks','case_id','main_case_id'));
    }

    public function activities(){

        //check if session is valid
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
          
         //get all client's cases activities
        $activities =  DB::table('activities')
        ->whereIn('main_case', $main_cases)
        ->paginate(20);

        return view('client-portal.activities',compact('activities'));
    }

      //all open cases requests from client
    public function open_case(){

      
        $open_case =  DB::table('clients_open_case')
        ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 'clients_open_case.case_status')
        ->select('caseStatus.S_Desc_A AS caseStatus','clients_open_case.*')
        ->paginate(20);

        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        return view('client-portal.open-case',compact('open_case','case_status'));
    
    }

    //create new case from client
    public function add_open_case(Request $request){

        $client_id = Session::get('client_id');
        $data = array(); 

        //upload document
        if ( $file = $request->file('doc')) {
            $file = $request->file('doc');
            $ext = $file->getClientOriginalExtension();
            $filename=  'open_case_doc_'.time().'.'.$ext;
             $file->move('assets/open-case-documents/', $filename);
    
             $data['docs'] = $filename;
        }

          //delete the (,) from fee and make it int
        $cliam = preg_replace('/[,]/', '', $request->cliam);
        $cliam = intval($cliam);


        //get all new case information from request and store it into array
        $data['client_id']=$client_id;
        $data['subject']=$request->subject;
        $data['case_status']=$request->status;
        $data['against']=$request->against;
        $data['cliam_amount']=$cliam;
        $data['date']=\Carbon\Carbon::now();

        $insert_open_case = DB::table('clients_open_case')->insert($data);

        //check if case added successfully
        if ($insert_open_case) {
            if ( Session::get('lang') == "ar") {
                return redirect()->back()->with('success', 'تم اضافة فتح قضية بنجاح');
            }else{
                return redirect()->back()->with('success', 'Open Case Successfully Added');
            }
        }

    }

    //view client invoices page
    public function client_invoices(){
        return view('client-portal.invoices');
    }

    //search cases page
    public function search_cases(Request $request){
       
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

     
        $case_num = $request->case_num;
        $type = $request->type;
        $stage = $request->stage;
        $court = $request->court;
       // dd($case_num);

        $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->select('courtName.S_Desc_A AS courtName',
        'caseType.S_Desc_A AS caseType',
        'caseStage.S_Desc_A AS caseStage',
        't_againsts.S_AGAINST_AR_NAME AS againstName',
        't_cases_master.register_date AS register_date',
        't_cases_master.N_PaymentValue AS cliam_amount',
        't_cases_details.*')  
        ->whereIn('t_cases_master.N_CASE_ID',$main_cases)
        ->where('t_cases_details.S_CASE_UID', '=', $case_num )
        ->where('t_cases_details.S_CASE_UID', '!=', null )
        ->orWhere('t_cases_details.N_CASE_TYPE',  $type )
        ->orWhere('t_cases_details.N_CASE_STAGE',   $stage  )
        ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
        ->paginate(100000);
         
     
    
       $case_type = DB::table('t_detailedcodes')
       ->orderBy('S_Desc_A', 'asc')
       ->where('N_MasterCode', '=', 5)
       ->get();
     

       $case_stage = DB::table('t_detailedcodes')
       ->orderBy('S_Desc_A', 'asc')
       ->where('N_MasterCode', '=', 7)
       ->get();

       return view('client-portal.all-cases',compact(['stages','case_type','case_stage']));


    }

    //cases reports page
    public function cases_reports(){
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

       
        $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
         ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
         ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
         ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
         ->select('courtName.S_Desc_A AS courtName',
         'caseType.S_Desc_A AS caseType',
         'caseStage.S_Desc_A AS caseStage',
         't_againsts.S_AGAINST_AR_NAME AS againstName',
         't_cases_master.register_date AS register_date',
         't_cases_master.N_PaymentValue AS cliam_amount',
         't_cases_details.*')  
         ->whereIn('t_cases_master.N_CASE_ID',$main_cases)
         ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
         ->get();

         $case_type = DB::table('t_detailedcodes')
         ->orderBy('S_Desc_A', 'asc')
         ->where('N_MasterCode', '=', 5)
         ->get();
       
  
         $case_stage = DB::table('t_detailedcodes')
         ->orderBy('S_Desc_A', 'asc')
         ->where('N_MasterCode', '=', 7)
         ->get();
  
         $print_date =  \Carbon\Carbon::now(+'4');

         return view('client-portal.cases-reports',compact(['stages','case_type','case_stage','print_date']));


    }


    //result of search cases reports
    public function search_cases_reports(Request $request){
       
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

     
        $case_num = $request->case_num;
        $type = $request->type;
        $stage = $request->stage;
        $court = $request->court;
       // dd($case_num);

        $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->select('courtName.S_Desc_A AS courtName',
        'caseType.S_Desc_A AS caseType',
        'caseStage.S_Desc_A AS caseStage',
        't_againsts.S_AGAINST_AR_NAME AS againstName',
        't_cases_master.register_date AS register_date',
        't_cases_master.N_PaymentValue AS cliam_amount',
        't_cases_details.*')  
        ->whereIn('t_cases_master.N_CASE_ID',$main_cases)
        ->where('t_cases_details.S_CASE_UID', '=', $case_num )
        ->where('t_cases_details.S_CASE_UID', '!=', null )
        ->orWhere('t_cases_details.N_CASE_TYPE',  $type )
        ->orWhere('t_cases_details.N_CASE_STAGE',   $stage  )
        ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
        ->get();
         
        //dd($stages);
    
       $case_type = DB::table('t_detailedcodes')
       ->orderBy('S_Desc_A', 'asc')
       ->where('N_MasterCode', '=', 5)
       ->get();
     

       $case_stage = DB::table('t_detailedcodes')
       ->orderBy('S_Desc_A', 'asc')
       ->where('N_MasterCode', '=', 7)
       ->get();

       $print_date =  \Carbon\Carbon::now(+'4');

       return view('client-portal.cases-reports',compact(['stages','case_type','case_stage','print_date']));


    }

    //stages reports
    public function stages_reports(){
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

         $cases_q = DB::table('t_cases_details')
         ->whereIn('N_CASE_ID', $main_cases)
         ->get();
 
         foreach ($cases_q as $case) {
             $cases[] = $case->N_CASE_DETAILS_ID;
          }

          //all stages for cases $cases
         $stages_noti = DB::table('t_hearing')
            ->leftjoin('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
            ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
            ->select('t_sentence_config.S_Desc_A', 't_sentence_config.S_NEXT_Desc_A',  't_sentence_config.N_Period',
            't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
            ->where('t_hearing.DT_HEARING_DATE' ,'>',Carbon::now() )
            ->whereIn('t_hearing.N_CASE_DETAILS_ID' ,$cases )
            ->orderBy('DT_HearingEnterDate', 'desc')
            ->get();


            $print_date =  \Carbon\Carbon::now(+'4');
       
       return view('client-portal.stages-reports',compact(['stages_noti','print_date']));

    }

    //create new case document
    public function add_case_document(Request $request){
           
        if (Session::get('client_name')) {
            $client_name = Session::get('client_name');
        } else {
            return redirect(route('client-login'));
        }


        $case_id = $request->main_case_id;
        $doc_name = $request->name;
        $find_file_num = DB::table('t_cases_master')
        ->where('N_CASE_ID', '=', $case_id)
        ->first();
        $file_num = $find_file_num->S_CASE_FILE_NUM;

        $data = array(); 

        //upload document
        $file = $request->file('doc');
        $ext = $file->getClientOriginalExtension();
        $filename=  $doc_name.'_'.time().'.'.$ext;
         $file->move('assets/case-documents/'.$file_num.'/', $filename);

         $data['S_path'] = $filename;

        //get all new excute information from request and store it into array
        $data['N_CASE_ID']=$request->main_case_id;
        $data['N_CASE_DETAILS_ID']=$request->case_id;
        $data['S_SUBJECT']=$request->subject;
        $data['S_name']=$request->name;
        $data['name_eng']=$request->name_eng;
        $data['N_type']=$request->type;
        $data['N_version']=$request->v_num;
        $data['N_UserID']= -1;
        $data['DT_Doc_Date']= \Carbon\Carbon::now(+'4');
       
        $case_uid = DB::table('t_cases_details')
        ->where('N_CASE_DETAILS_ID', '=', $request->case_id)
        ->first();

            
        //add notification(activity)
       $activity = array(); 
       $activity['short_name']=' اضافة مستند';
       $activity['description']=' تم اضافة مستند للدعوى('.  $case_uid->S_CASE_UID.') , بواسطة العميل ('.  $client_name.')';
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['url']="main-case-cases/$request->main_case_id";
       $activity['main_case'] =$request->main_case_id;
       $activity['assign_to'] = 20;
        
       $insert_activity = DB::table('activities')->insert($activity);

       
        $insert_case_doc = DB::table('t_documents')->insert($data);

        //check if document added successfully
        if ($insert_case_doc) {
            return redirect()->back()->with('success', 'تم اضافة المستند بنجاح')
            ->with('ring','play');
            
        }

    }

    //client messages with firm
    public function client_chats(){

        if (Session::get('client_id')) {
            $client_id = Session::get('client_id');
        } else {
            return redirect(route('client-login'));
        }

        $chat =  DB::table('clients_chats')
        ->where('client_id' ,$client_id)
        ->first();

        //if there is no chat create by default else view messages
        if (!$chat) {
        $data['client_id'] = $client_id;

        $data['created_date']=\Carbon\Carbon::now(+'4');
        $add_client_chat = DB::table('clients_chats')->insertGetId($data);

        $chat_id = $add_client_chat;

        $messages =  DB::table('client_chats_messages')
        ->where('chat_id' ,$chat_id)
        ->get();
        }else{
            $chat_id = $chat->chat_id;
            $messages =  DB::table('client_chats_messages')
            ->where('chat_id' ,$chat_id)
            ->get();
        }

        return view('client-portal.chats',compact(['messages','chat_id']));

    }

    //create new message
    public function add_message(Request $request){

        //get all new message information from request and store it into array
        $data['chat_id']=$request->chat_id;
        $data['message']=$request->msg;
        $data['message_by']='Client';
        $data['date_time']= \Carbon\Carbon::now(+'4');


        $add_message = DB::table('client_chats_messages')->insert($data);

        if ($add_message) {
            return redirect()->back()->with('success', 'تم  ارسال الرسالة بنجاح')
            ->with('ring','play');
        }
      
    }

}
