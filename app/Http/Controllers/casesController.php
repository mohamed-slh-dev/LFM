<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class casesController extends Controller
{
    
    //view dashboard with number of each files,main cases..etc
    public function dashboard(){

        $files = DB::table('t_files')->get();
        $main_cases = DB::table('t_cases_master')->get();
        $cases = DB::table('t_cases_details')->get();

        //16564 is code number for unregistered case stage
        $cases_not_registerd = DB::table('t_cases_details')
        ->where('N_CASE_STAGE',16561)
        ->get();

        $cases_startup = DB::table('t_cases_details')
        ->where('N_CASE_STAGE',16483)
        ->get();

        //these are the numbers of judgment type
        $decisions = DB::table('t_hearing')
        ->where('t_hearing.N_HEARINGTYPE','=','16428')
        ->orWhere('t_hearing.N_HEARINGTYPE','=','15629')
        ->orWhere('t_hearing.N_HEARINGTYPE','=','15630')
        ->orWhere('t_hearing.N_HEARINGTYPE','=','17166')
        ->orWhere('t_hearing.N_HEARINGTYPE','=','17160')
        ->orderBy('DT_HearingEnterDate', 'desc')
        ->get();

        

        return view('case-manage.dashboard',compact(['files','cases','main_cases',
        'cases_not_registerd','cases_startup','decisions']));
    }



    //view cases page
    public function cases(){

        $files = DB::table('t_files')
        ->orderBy('id', 'desc') 
        ->get();
        $main_cases = DB::table('t_cases_master')
        ->orderBy('N_CASE_ID', 'desc') 
        ->get();
        $cases_count = DB::table('t_cases_details')->get();
      
        $cases = DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS deltailStage', 'deltailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->select('deltailType.S_Desc_A AS typeName','deltailStage.S_Desc_A AS stageName',
        'deltailCourt.S_Desc_A AS courtName',
        't_cases_details.*')
        ->orderBy('N_CASE_DETAILS_ID', 'desc') 
        ->paginate(8);
        $experts = DB::table('t_experts')->get();
      

        $cases_count  =  count($cases_count);

        //get all cases type from details code
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();


        //get all cases status from details code
        $case_status = DB::table('t_detailedcodes')
        ->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //get all cases stages from details code
        $case_stage = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->get();

        //get all client types from details code
        $client_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 12)
        ->get();

        //get all courts from details code
        $court = DB::table('t_detailedcodes')
        ->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //get all departments from details code
        $depts = DB::table('t_detailedcodes')
        ->where('N_MasterCode', '=', 9)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        
        //get all excutes from details code (any code details with word 'تنفيذ')
        $excute_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->where('S_Desc_A', 'LIKE','%' . 'تنفيذ' . '%')
        ->get();

        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_case')
        ->first();

        //check if the user has permission to add new cases
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

    //get all excutes 
    $excutes = DB::table('excute_stages')
    ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
    ->select('deltailType.S_Desc_A AS typeName',
    'excute_stages.*')
    ->orderBy('excute_stage_id', 'desc') 
    ->paginate(4);

        return view('case-manage.cases',compact(['add_case','cases_count','experts','cases',
        'files','main_cases','case_type','case_status' ,'client_type',
        'case_stage','court','depts','users','excute_type','excutes']));
    }


    //view all excutes (page)
    public function excutes()
    {
           
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_case')
        ->first();

        //check if the user has permission to add new cases
       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_case = 'true';
        }else{
            $add_case = 'false';
        }
       }else{
        $add_case = 'false';
    }

        $files = DB::table('t_files')
        ->orderBy('id', 'desc') 
        ->get();

        $main_cases = DB::table('t_cases_master')
        ->orderBy('N_CASE_ID', 'desc') 
        ->get();

        $excutes_count = DB::table('excute_stages')->get();
        
        $excutes = DB::table('excute_stages')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('deltailType.S_Desc_A AS typeName',
        'excute_stages.*')
        ->orderBy('excute_stage_id', 'desc') 
        ->paginate(10);

           
        $excute_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->where('S_Desc_A', 'LIKE','%' . 'تنفيذ' . '%')
        ->get();



        return view('case-manage.excutes',compact(['add_case','excutes','excute_type',
        'excutes_count','files','main_cases']));
       }

       public function search_excutes(Request $request){

        $filters = array();

        //check if request has excute number
        if ($request->excute_num != null) {

            $filters["excute_uid"] = $request->excute_num;
        }

        if ($request->type != 'all') {

            $filters["excute_type"] = $request->type;
        }
          
           
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_case')
        ->first();

        //check if the user has permission to add new cases
       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_case = 'true';
        }else{
            $add_case = 'false';
        }
       }else{
        $add_case = 'false';
    }

        $files = DB::table('t_files')
        ->orderBy('id', 'desc') 
        ->get();
        $main_cases = DB::table('t_cases_master')
        ->orderBy('N_CASE_ID', 'desc') 
        ->get();

        $excutes_count = DB::table('excute_stages')->get();

        $excutes = DB::table('excute_stages')
        ->leftjoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('deltailType.S_Desc_A AS typeName',
        'excute_stages.*')
        ->where($filters)
        ->orderBy('excute_stage_id', 'desc') 
        ->paginate(100);

           
        $excute_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->where('S_Desc_A', 'LIKE','%' . 'تنفيذ' . '%')
        ->get();

        

        return view('case-manage.excutes',compact(['add_case','excutes','excute_type',
        'excutes_count','files','main_cases']));
       }


       //search cases index (page)
    public function search_cases_index(){

        //get all cases with all details
        $cases = DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS deltailStage', 'deltailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->leftJoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->select('deltailType.S_Desc_A AS typeName','deltailStage.S_Desc_A AS stageName',
        'deltailCourt.S_Desc_A AS courtName',
        't_cases_details.*')
        ->orderBy('N_CASE_DETAILS_ID', 'desc') 
        ->paginate(8);

        
        //get all cases types from details code
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();
      
        //get all cases stages from details code
        $case_stage = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->get();
       
        //get all courts from details code
       $court = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
       ->orderBy('S_Desc_A', 'asc')
       ->get();
        return view('search.cases-search',compact(['cases','case_type','case_stage','court']));

    }

    
    public function search_cases(Request $request){
       
          // filter here
          $filters = array();


          // check if request has case number
          if ($request->case_num != null) {
  
              $filters["S_CASE_UID"] = $request->case_num;
          }

          if ($request->type != "all") {

            $filters["N_CASE_TYPE"] = $request->type;
        }

        
        if ($request->stage != "all") {

            $filters["N_CASE_STAGE"] = $request->stage;
        }

        if ($request->court != "all") {

            $filters["N_COURT_ID"] = $request->court;
        }
     
       
      //get cases with serach results
        $cases =  DB::table('t_cases_details')
        ->leftjoin('t_detailedcodes AS deltailType', 'deltailType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftjoin('t_detailedcodes AS deltailStage', 'deltailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->leftjoin('t_detailedcodes AS deltailCourt', 'deltailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->select('deltailType.S_Desc_A AS typeName','deltailStage.S_Desc_A AS stageName',
        'deltailCourt.S_Desc_A AS courtName',
        't_cases_details.*')
        ->where($filters)
        ->orderBy('N_CASE_DETAILS_ID', 'asc') 
        ->get();
     
    
        //get all cases types from case details
       $case_type = DB::table('t_detailedcodes')
       ->orderBy('S_Desc_A', 'asc')
       ->where('N_MasterCode', '=', 5)
       ->get();
     
        //get all cases stages from case details
       $case_stage = DB::table('t_detailedcodes')
       ->orderBy('S_Desc_A', 'asc')
       ->where('N_MasterCode', '=', 7)
       ->get();
         
        //get all courts from case details
       $court = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
       ->orderBy('S_Desc_A', 'asc')
       ->get();

       return view('search.cases-search',compact(['cases','case_type','case_stage','court']));


    }

   
    //view single case details  
    public function case_details($case_id){

        //get case details with id $case_id
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
      

        //get all cases types from details codes
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();
      
        //get all cases stages from details codes
        $case_stage = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->get();

        //get all clients types from details codes
        $client_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 12)
        ->get();

        //get all courts from details code
        $court = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //get all departments from details codes
        $depts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 9)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //get all experts
        $experts = DB::table('t_experts')
        ->get();

        //get all users
        $users = DB::table('users')
        ->orderBy('name', 'asc')
        ->get();


        return view('case-manage.case-details',compact('case_details','case_type','case_stage',
        'client_type','court','depts','experts','users'));
    }

    //update case informations
    public function update_case_details(Request $request,$case_id){

        //delete the (,) from fee and make it int
        $fee = preg_replace('/[,]/', '', $request->fee);
        $fee = intval($fee);
        
        $data_register = array();

        $data_register['register_date']=$request->rigster_case_date;

        //update register date
        $update_register =  DB::table('t_cases_master')
        ->where('N_CASE_ID', $request->main_case_id)
        ->update($data_register);
       

        //get all case information from request and store it into array
        $data_case_details = array();
        $data_case_details['N_CAPACITY_ID']=$request->client_type;
        $data_case_details['N_CASE_STAGE']=$request->case_stage;
        $data_case_details['N_CASE_TYPE']=$request->case_type;
        $data_case_details['N_COURT_ID']=$request->court;
        $data_case_details['N_CASE_DIRECTORATE_ID']=$request->dept;
        $data_case_details['N_Expert_ID']=$request->expert;
        $data_case_details['lawyer_1']=$request->lawyer_1;
        $data_case_details['lawyer_2']=$request->lawyer_2;
        $data_case_details['lawyer_3']=$request->lawyer_3;
        $data_case_details['S_SUMMARY']=$request->subject;
        $data_case_details['S_CASE_UID']=$request->case_uid;
        $data_case_details['S_COURT_FEES']=$fee;
        $data_case_details['request_number']=$request->request_number;
        $data_case_details['request_date']=$request->request_date;

        
        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث دعوى';
        $activity['description']='تم تحديث الدعوى  ('.$request->case_uid.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$request->main_case_id";

        $insert_activity = DB::table('activities')->insert($activity);

        $update_case_details =  DB::table('t_cases_details')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->update($data_case_details);
      

        return redirect()->back()->with('success','تم تحديث بيانات الدعوى بنجاح')
        ->with('ring','play');

    }

    
    //create new case
    public function add_case_details(Request $request){

        //delete the (,) from fee and make it int
        $fee = preg_replace('/[,]/', '', $request->fee);
        $fee = intval($fee);

        $data = array(); 

        //get all new case information from request and store it into array
        $data['N_CASE_ID']=$request->main_case_id;
        $data['file_id']=$request->file_id;
        $data['N_CASE_STAGE']=$request->case_stage;
        $data['S_CASE_UID']=$request->case_uid;
        $data['S_SUMMARY']=$request->more_info;
        $data['N_Expert_ID']= $request->expert_office;
        $data['N_ExpertRef_ID']=$request->expert;
        $data['S_COURT_FEES']=$fee;
        $data['N_CASE_DIRECTORATE_ID']=$request->dept;
        $data['N_CASE_TYPE']=$request->case_type;
        $data['N_CAPACITY_ID']=$request->client_type;
        $data['N_COURT_ID']=$request->court;
        $data['lawyer_1']=$request->lawyer_1;
        $data['lawyer_2']=$request->lawyer_2;
        $data['lawyer_3']=$request->lawyer_3;
        $data['request_number']=$request->request_number;
        $data['request_date']=$request->request_date;

       //create new case
        $insert_case_details = DB::table('t_cases_details')->insert($data);
        
        
        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='اضافة دعوى';
        $activity['description']='تم اضافة دعوى جديدة ('.$request->case_uid.')';
        $activity['create_by']=Auth::id();
        $activity['assign_to'] =$request->lawyer_1;
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$request->main_case_id";


        $insert_activity = DB::table('activities')->insert($activity);

        if ($insert_case_details) {
            return redirect()->back()->with('success', 'تم اضافة دعوى جديدة بنجاح')
            ->with('ring','play');
        }

    }

    //create new excute stage
    public function add_excute_stage(Request $request){


        //delete the (,) from fee and make it int

        $cliam_amount = preg_replace('/[,]/', '', $request->cliam_amount);
        $cliam_amount = intval($cliam_amount);

        $collected_amount = preg_replace('/[,]/', '', $request->collected_amount);
        $collected_amount = intval($collected_amount);

        $case_cost = preg_replace('/[,]/', '', $request->case_cost);
        $case_cost = intval($case_cost);

        $office_cost = preg_replace('/[,]/', '', $request->office_cost);
        $office_cost = intval($office_cost);

        $excute_fee = preg_replace('/[,]/', '', $request->excute_fee);
        $excute_fee = intval($excute_fee);

        
       
        $data = array(); 

        //get all new excute information from request and store it into array
        $data['main_case_id']=$request->main_case_id;
        $data['file_id']=$request->file_id;
        $data['excute_uid']=$request->excute_uid;
        $data['excute_type']=$request->excute_type;
        $data['cliam_amount']=$cliam_amount;
        $data['excute_date']=$request->register_date;
        $data['excute_fee']=$excute_fee;
        $data['collected_amount']=$collected_amount;
        $data['case_fee']=$case_cost;
        $data['office_fee']=$office_cost;
        $data['subject']=$request->subject;

        if($file=$request->file('docs')){
            $file = $request->file('docs');
            $ext = $file->getClientOriginalExtension();
            $filename= 'excute-doc'.'_'.time().'.'.$ext;
             $file->move('assets/excute-docs/', $filename);
             $data['excute_docs'] = $filename;
          
        }

       
        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='اضافة تنفيذ';
        $activity['description']='تم اضافة تنفيذ جديد ('.$request->excute_uid.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$request->main_case_id";
        $activity['main_case'] =$request->main_case_id;

        $insert_activity = DB::table('activities')->insert($activity);

        //create new excute
        $insert_excute_stage = DB::table('excute_stages')->insert($data);
        
     
        //check if excute insert successfully
        if ($insert_excute_stage) {
            return redirect()->back()->with('success', 'تم اضافة تنفيذ جديد بنجاح')
            ->with('ring','play');

        }

    }

    //view excute information
    public function excute_details($excute_id){
       
        //view  excute information with excute id $excute_id
        $excute_details =  DB::table('excute_stages')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'excute_stages.excute_type')
        ->select('t_detailedcodes.S_Desc_A AS excuteType', 't_detailedcodes.N_DetailedCode AS excuteCode','excute_stages.*')
        ->where('excute_stage_id', $excute_id) 
        ->first();
        
        
        //get all excute type from details code
        $excutes_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->where('S_Desc_A', 'LIKE','%' . 'تنفيذ' . '%')
        ->get();

        return view('case-manage.excute-details',compact('excute_details','excutes_type'));

    }



    //update excute details information
    public function update_excute_details(Request $request,$excute_id){
      
        //delete the (,) from fee and make it int

        $cliam_amount = preg_replace('/[,]/', '', $request->cliam_amount);
        $cliam_amount = intval($cliam_amount);

        $collected_amount = preg_replace('/[,]/', '', $request->collected_amount);
        $collected_amount = intval($collected_amount);

        $case_cost = preg_replace('/[,]/', '', $request->case_cost);
        $case_cost = intval($case_cost);

        $office_cost = preg_replace('/[,]/', '', $request->office_cost);
        $office_cost = intval($office_cost);

        $excute_fee = preg_replace('/[,]/', '', $request->excute_fee);
        $excute_fee = intval($excute_fee);
       

        $excute_data = array();
            
        //get all new excute information from request and store it into array

        $excute_data['excute_uid']=$request->excute_uid;
        $excute_data['excute_type']=$request->excute_type;

        $excute_data['excute_date']=$request->excute_date;
        $excute_data['subject']=$request->subject;

        $data['cliam_amount']=$cliam_amount;
        $data['excute_fee']=$excute_fee;
        $data['collected_amount']=$collected_amount;
        $data['case_fee']=$case_cost;
        $data['office_fee']=$office_cost;

     
        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث تنفيذ';
        $activity['description']='تم تحديث التنقيذ  ('.$request->excute_uid.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
      
        $insert_activity = DB::table('activities')->insert($activity);

        //update excute details
        $update_excute_details =  DB::table('excute_stages')
        ->where('excute_stage_id', $excute_id)
        ->update($excute_data);
      

        return redirect()->back()->with('success','تم تحديث بيانات التنفيذ بنجاح')
        ->with('ring','play');

    }

    public function delete_excute($excute_id){

        //delete excute actions related to this excute
        $delete_actions =  DB::table('excute_actions')
        ->where('excute_stage_id', $excute_id)
        ->delete();

        //delete excute with id $excute_id
        $delete_excute =  DB::table('excute_stages')
        ->where('excute_stage_id', $excute_id)
        ->delete();

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='حذف تنفيذ';
        $activity['description']='تم حذف التنقيذ ';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');

      
        //check if excute delete successfully
        if ($delete_excute) {
            return redirect()->back()->with('success','تم حذف التنفيذ بنجاح')
            ->with('ring','play');
        }
    }

    public function excute_actions($excute_stage_id){
        
      //view excute actions to the excute id $excute_stage_id
        $excute_actions = DB::table('excute_actions')
        ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'excute_actions.excute_code')
        ->select('t_detailedcodes.S_Desc_A AS action_name','excute_actions.*')
        ->where('excute_stage_id', $excute_stage_id)
        ->get()
        ->groupBy('action_name');

        //get all excute actions information in modals (to edit each one of them)
        $excute_actions_models = DB::table('excute_actions')
        ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'excute_actions.excute_code')
        ->select('t_detailedcodes.S_Desc_A AS action_name','excute_actions.*')
        ->where('excute_stage_id', $excute_stage_id)
        ->get();

        $action_names = $excute_actions;
    
        //get all excute actions from details code
        $excute_actions_options = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 39)
        ->get();

        return view('case-manage.excute-actions',compact(['excute_actions_options','excute_stage_id',
        'excute_actions','action_names','excute_actions_models']));

    }

    public function add_excute_action(Request $request){
         
        //get main case id for the excute
        $main_case_id = DB::table('excute_stages')
        ->where('excute_stage_id', '=', $request->excute_stage_id)
        ->first();

        //get all excute actions from details code
        $data['excute_stage_id']=$request->excute_stage_id;
        $data['main_case_id']= $main_case_id->main_case_id;
        $data['excute_code']=$request->excute_code;
        $data['description']=$request->desc;
        $data['notes']=$request->notes;
        $data['collected_amount']=$request->collected_amount;
        $data['date']=$request->date;

        if($file=$request->file('docs')){
            $file = $request->file('docs');
            $ext = $file->getClientOriginalExtension();
            $filename= 'excute-action-doc'.'_'.time().'.'.$ext;
             $file->move('assets/excute-docs/actions-docs/', $filename);
             $data['docs'] = $filename;
          
        }

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='اضافة اجراء تنفيذي';
        $activity['description']='تم اضافة اجراء تنفيذي جديد في القضية('. $main_case_id->main_case_id.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$main_case_id->main_case_id";
        $activity['main_case'] =$main_case_id->main_case_id;
        


        $insert_activity = DB::table('activities')->insert($activity);
 
        $insert_excute_action = DB::table('excute_actions')->insert($data);

      //check if excute action added successfully
        if ($insert_excute_action) {
            return  redirect()->back()->with('success', 'تم اضافة اجراء تنفيذي بنجاح')
            ->with('ring','play');

        }

    }
    public function update_action(Request $request){


        $action_id = $request->action_id;

        //get all excute information from request and store it into array
        $data['description']=$request->desc;
        $data['notes']=$request->notes;
        $data['date']=$request->date;
        $data['collected_amount']=$request->collected_amount;
        
        if($file=$request->file('docs')){
            $file = $request->file('docs');
            $ext = $file->getClientOriginalExtension();
            $filename= 'excute-action-doc'.'_'.time().'.'.$ext;
             $file->move('assets/excute-docs/actions-docs/', $filename);
             $data['docs'] = $filename; 
        }

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث اجراء تنفيذي';
        $activity['description']='تم تحديث اجراء تنفيذي ';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
      
        $insert_activity = DB::table('activities')->insert($activity);

        $update_action =  DB::table('excute_actions')
        ->where('excute_action_id', $action_id)
        ->update($data);
      
        return redirect()->back()->with('success','تم تحديث  الاجراء بنجاح')
        ->with('ring','play');

    }

    public function delete_action($action_id){

        //delete excute action with id $action_id
        $delete_actions =  DB::table('excute_actions')
        ->where('excute_action_id', $action_id)
        ->delete();

        //check if excute action delete successfully
         if ($delete_actions) {
            return redirect()->back()->with('success','تم حذف التنفيذ بنجاح');
        }
    }
  

    public function case_stages($case_id){
        
        //get file id and main case id for case id $case_id
        $file_main_case_id =  DB::table('t_hearing')
        ->join('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
        ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->select('t_cases_master.N_CASE_ID AS main_case_id','t_cases_master.S_CASE_FILE_NUM AS file_id',
        't_cases_details.S_CASE_UID AS case_id','t_hearing.*')
        ->where('t_hearing.N_CASE_DETAILS_ID', $case_id)
        ->orderBy('N_HEARING_ID', 'desc')
        ->first();
       
        //get all hearings for case id $case_id
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

        $court = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();
        $stage_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 31)
        ->orderBy('S_Desc_A', 'asc')
        ->get();
        
        $users =  DB::table('users')
        ->get();
        return view('case-manage.case-stages',compact('case_stages','case_id','court','stage_type','users','file_main_case_id'));
    }

    public function add_case_stage(Request $request){
        $case_id = $request->case_id;

        //get case uid id for case id $case_id
        $case_uid =  DB::table('t_cases_details')
        ->where('N_CASE_DETAILS_ID', $case_id)
        ->first();

        $data = array(); 

        //get all new case stage from request and store it into array

        $data['N_CASE_DETAILS_ID']=$request->case_id;
        $data['N_COURT_ID']=$request->court;
        $data['S_HEARING_DESIGION']=$request->decision_ar;
        $data['decision_eng']=$request->decision_eng;
        $data['N_LAWYER_ID']=$request->lawyer;
        $data['DT_HearingEnterDate']= $request->stage_date; 
        $data['DT_HEARING_DATE']=$request->next_date;
        $data['N_UserId']=Auth::id();
        $data['S_Hall']=$request->hall;
        $data['N_HEARINGTYPE']=$request->type;
        $data['S_Notes']=$request->notes;
        $data['N_Consultant']=$request->consult;
        $data['sessiontype']=$request->session_type; 

        $main_case_id =  DB::table('t_cases_details')
        ->where('N_CASE_DETAILS_ID', $request->case_id)
        ->first();

        

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='اضافة جلسة';
        $activity['description']='تم اضافة جلسة جديدة للدعوى('.$case_uid->S_CASE_UID.')';
        $activity['create_by']=Auth::id();
        $activity['assign_to'] =$request->lawyer_1;
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['main_case'] =$main_case_id->N_CASE_ID;
        $activity['url']="main-case-cases/$main_case_id->N_CASE_ID";

        $insert_activity = DB::table('activities')->insert($activity);

        $insert_case_stage = DB::table('t_hearing')->insert($data);

       
        //check if stage added successfully
        if ($insert_case_stage) {
            return redirect()->back()->with('success', 'تم اضافة جلسة جديدة بنجاح')
            ->with('ring','play');
            
        }

    }

    public function edit_case_stage(Request $request){

        $stage_id=$request->stage_id;

        $case_id =  DB::table('t_hearing')
        ->where('N_HEARING_ID', $stage_id)
        ->first();

        //get main case id
        $main_case_id =  DB::table('t_cases_details')
        ->where('N_CASE_DETAILS_ID',  $case_id->N_CASE_DETAILS_ID)
        ->first();

        //get all stage information from request and store it into array
        $data['N_HEARINGTYPE']=$request->type;
        $data['N_COURT_ID']=$request->court;
        $data['N_LAWYER_ID']=$request->lawyer;
        $data['N_Consultant']=$request->consult;
        $data['sessiontype']=$request->session_type;

        $data['S_HEARING_DESIGION']=$request->decision_ar;
        $data['decision_eng']=$request->decision_eng;
        $data['S_Hall']=$request->hall;
        $data['DT_HearingEnterDate']= $request->enter_date;
        $data['DT_HEARING_DATE']=$request->next_date;
        $data['S_Notes']=$request->notes;

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تعديل جلسة';
        $activity['description']='تم تعديل جلسة ';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$main_case_id->N_CASE_ID";

        $insert_activity = DB::table('activities')->insert($activity);

        //update stage information
        $update_stage =  DB::table('t_hearing')
        ->where('N_HEARING_ID', $stage_id)
        ->update($data);

      
            return redirect()->back()->with('success','تم تحديث بيانات الجلسة بنجاح')
            ->with('ring','play');
      
    }

    public function delete_stage($stage_id){

        //delete stage id $stage_id
        $delete_stage =  DB::table('t_hearing')
        ->where('N_HEARING_ID', $stage_id)
        ->delete();

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='حذف جلسة';
        $activity['description']='تم حذف جلسة ';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');

        //check if stage delete successfully
        if ($delete_stage) {
            return redirect()->back()->with('success','تم حذف الجلسة بنجاح')
            ->with('ring','play');
        }
    }

    public function cases_team(){
        //view all main cases members
        $main_cases =  DB::table('t_cases_master')
        ->leftJoin('users AS assingTo', 'assingTo.id', '=', 't_cases_master.N_CASE_STAGE')
        ->leftJoin('users AS createBy', 'createBy.id', '=', 't_cases_master.N_DoingPerson')
        ->orderBy('N_CASE_ID', 'desc') 
        ->paginate(8);

    }
    public function case_memoir($case_id,$main_case_id){

        //get all users
        $users =  DB::table('users')->get();

        //get memoir for case id $case_id
        $memoir =  DB::table('memoir')
        ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'memoir.excute_need')
        ->leftJoin('users AS create_by', 'create_by.id', '=', 'memoir.created_by')
        ->leftJoin('users AS assign', 'assign.id', '=', 'memoir.consultant')
        ->select('create_by.name AS createBy', 'assign.name AS assignTo', 
        't_detailedcodes.S_Desc_A AS excute_Name' ,'memoir.*')
        ->where('case_id', $case_id)
        ->get();
   
        //get all memoir types from details code
        $type = DB::table('t_detailedcodes')
        ->where('N_MasterCode', '=', 41)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        return view('case-manage.case-memoir',compact('memoir','case_id','main_case_id','users','type'));
    }
    public function case_tasks($case_id,$main_case_id){

        //get all users
        $users =  DB::table('users')->get();

        //get all case tasks for the case_id $case_id
        $case_tasks =  DB::table('t_tasks')
        ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
        ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
        ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
        ->where('N_CASE_ID', $main_case_id)
        ->get();
       
        return view('case-manage.case-tasks',compact('case_tasks','case_id','main_case_id','users'));
    }


    public function excute_tasks($excute_id,$main_case_id){

       //get all users
       $users =  DB::table('users')->get();

       //get all case excute tasks for the case_id $case_id
       
        $excute_tasks =  DB::table('t_tasks')
        ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
        ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
        ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
        ->where('excute_id', $excute_id)
        ->get();
        // dd($case);
        return view('case-manage.excute-tasks',compact('excute_tasks','excute_id','main_case_id','users'));
    }

    public function tasks(){

        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        //check if the user role is admin(id = 17) to view all tasks
        if ($user_role->role_id != 17 ) {
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_tasks.N_CASE_DETAILS_ID')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo','t_cases_details.S_CASE_UID AS case_uid', 't_tasks.*')
            ->orderBy('N_TASK_ID', 'desc')
            ->where('N_EMPLOYEE_NO',auth()->user()->id)
            ->paginate(8);
    
        }
        //if not admin view user tasks
        else{
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_tasks.N_CASE_DETAILS_ID')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo','t_cases_details.S_CASE_UID AS case_uid', 't_tasks.*')
            ->orderBy('N_TASK_ID', 'desc')
            ->paginate(8);
    
        }

      
        $users =  DB::table('users')
        ->get();

        return view('case-manage.tasks',compact(['tasks','users']));
    }

    public function search_tasks(Request $request){

        $filters = array();

        //check the fillter if not null

        if ($request->end_date != null) {

            $filters["DT_WANTED"] = $request->end_date;
        }

        if ($request->create_by != "all") {

            $filters["created_by"] = $request->create_by;
        }

      

        if ($request->assignTo != "all") {

            $filters["N_EMPLOYEE_NO"] = $request->assignTo;
        }

        if ($request->task_status != "all") {

            $filters["N_Status"] = $request->task_status;
        }

     
        //get all tasks with search results
        $tasks = DB::table('t_tasks')
        ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
        ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
        ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_tasks.N_CASE_DETAILS_ID')
        ->select('create_by.name AS createBy', 'assign.name AS assignTo','t_cases_details.S_CASE_UID AS case_uid', 't_tasks.*')
       ->where($filters)
        ->orderBy('N_TASK_ID', 'desc')
        ->paginate(10000);

     

        $users =  DB::table('users')
        ->get();

        return view('case-manage.tasks',compact(['tasks','users']));
    }

    public function add_case_memoir(Request $request){

        $data = array(); 

        
        //get all new memoir information from request and store it into array
        $data['main_case_id']=$request->main_case_id;
        $data['case_id']=$request->case_id;
      
         $data['create_date']=\Carbon\Carbon::now();
      
        $data['excute_date']=$request->excute_date;

        $data['consultant']=$request->assignTo;
        $data['excute_need']= $request->excute_need;
       
      
        $data['status']=$request->status;
        $data['created_by']=Auth::id();
       
        
           
       //add notification(activity)
        $activity = array(); 
       $activity['short_name']=' اضافة مذكرة';
       $activity['description']=' تم اضافة مذكرة دعوى جديدة('.$request->notes.')';
       $activity['create_by']=Auth::id();
       $activity['assign_to'] =$request->assignTo;
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['url']="main-case-cases/$request->main_case_id";


       $insert_activity = DB::table('activities')->insert($activity);
        
        $insert_case_memoir = DB::table('memoir')->insert($data);

        //check if memoir added successfully
        if ($insert_case_memoir) {
            return redirect()->back()->with('success', 'تم اضافة مذكرة جديدة بنجاح')
            ->with('ring','play');
            
        }

    }

    public function update_memoir_status(Request $request){

        $memoir_id = $request->memoir_id;
        $status = $request->task_status;

        //get the memoir with id $memoir_id
        $memoir_name = DB::table('memoir')
        ->where('id', $memoir_id)
        ->first();
    
        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث حالة مذكرة';
        $activity['description']='تم تحديث حالة المذكرة('.$memoir_name->excute_need.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        if ($memoir_name->main_case_id) {
            $activity['url']="main-case-cases/$memoir_name->main_case_id";   
        }
      


        $insert_activity = DB::table('activities')->insert($activity);

        //update memoir status
        $update_task = DB::table('memoir')
              ->where('id', $memoir_id)
              ->update(['status' => $status]);

                return redirect()->back()->with('success', 'تم تحديث حالة المذكرة بنجاح')
                ->with('ring','play');
           
    }
    public function delete_memoir($memoir_id){
       
        //delete memoir with id $memoir_id
        $delete_memoir = DB::table('memoir')
        ->where('id', '=', $memoir_id)
        ->delete();

        //check if memoir delete successfully
        if ($delete_memoir) {
        return redirect()->back()->with('success', 'تم حذف المذكرة بنجاح');
         }
    }

    public function add_case_task(Request $request){

        $data = array(); 

        
        //get all new task information from request and store it into array
        $data['N_CASE_ID']=$request->main_case_id;
        $data['N_CASE_DETAILS_ID']=$request->case_id;
        $data['excute_id']=$request->excute_id;
        $data['S_SUBJECT']=$request->desc;
        

        $data['DT_DATE_STARTWORK']=\Carbon\Carbon::now();
        $data['DT_DOINGWORK']=$request->doing_date;
        $data['DT_WANTED']=$request->wanted_date;
        $data['excute_date']=$request->excute_date;

        $data['N_EMPLOYEE_NO']=$request->assignTo;
        $data['S_NOTES']= $request->notes;
        $data['S_Comment']=$request->comment;
        $data['N_TaskType']=1;
        $data['N_Status']=$request->status;
        $data['created_by']=Auth::id();
        $data['follower']=$request->follower;
       // dd($data);
        
           
       //add notification(activity)
        $activity = array(); 
       $activity['short_name']=' اضافة مهمة';
       $activity['description']=' تم اضافة مهمة دعوى جديدة('.$request->notes.')';
       $activity['create_by']=Auth::id();
       $activity['assign_to'] =$request->assignTo;
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['url']="main-case-cases/$request->main_case_id";


       $insert_activity = DB::table('activities')->insert($activity);
        
        $insert_case_task = DB::table('t_tasks')->insert($data);

        //check if task added successfully
        if ($insert_case_task) {
            return redirect()->back()->with('success', 'تم اضافة مهمة جديدة بنجاح')
            ->with('ring','play');
            
        }

    }

    
    public function case_documents($case_id,$main_case_id){

        //get all case documents for case_id $case_id
        $case_detail_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->get();

        //get all case documents for main_case_id $main_case_id
        $case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_Case_ID', $main_case_id)
        ->get();

        //get all case documents form clients (from client portal)
        $client_case_docs =  DB::table('t_documents')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_documents.N_CASE_ID')
        ->select('t_cases_master.S_CASE_FILE_NUM', 't_documents.*')
        ->where('t_documents.N_CASE_DETAILS_ID', $case_id)
        ->where('t_documents.N_UserID',-1)
        ->OrWhere('t_documents.N_UserID', null) 
        ->get();
        
        //dd($client_case_docs);


        return view('case-manage.case-documents',compact('case_docs', 'case_detail_docs','case_id','main_case_id','client_case_docs'));
    }


    public function excute_documents($excute_id,$main_case_id){

        //view excute documents for excute_id $excute_id
        $excute_docs =  DB::table('excute_documents')
        ->where('excute_documents.excute_stage_id', $excute_id)
        ->get();

        //view excute documents for main_case_id $main_case_id
        $all_excute_docs =  DB::table('excute_documents')
        ->where('excute_documents.main_case_id', $main_case_id)
        ->get();

      
        return view('case-manage.excute-documents',compact('all_excute_docs', 'excute_docs','excute_id','main_case_id'));
    }

    public function add_case_document(Request $request){

        $case_id = $request->main_case_id;
        $doc_name = $request->name;

        //get file number
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

         //get all document information from request and store it into array
        $data['N_CASE_ID']=$request->main_case_id;
        $data['N_CASE_DETAILS_ID']=$request->case_id;
        $data['S_SUBJECT']=$request->subject;
        $data['S_name']=$request->name;
        $data['name_eng']=$request->name_eng;
        $data['N_type']=$request->type;
        $data['N_version']=$request->v_num;
        $data['N_UserID']=Auth::id();
        $data['DT_Doc_Date']= \Carbon\Carbon::now(+'4');
       
        //get case_uid
        $case_uid = DB::table('t_cases_details')
        ->where('N_CASE_DETAILS_ID', '=', $request->case_id)
        ->first();


     

               
       //add notification(activity)
        $activity = array(); 
       $activity['short_name']=' اضافة مستند';
       $activity['description']=' تم اضافة مستند للدعوى('.  $case_uid->S_CASE_UID.')';
       $activity['create_by']=Auth::id();
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['url']="main-case-cases/$request->main_case_id";
       $activity['main_case'] =$request->main_case_id;
        
       $insert_activity = DB::table('activities')->insert($activity);

       
        $insert_case_doc = DB::table('t_documents')->insert($data);

        //check if document added successfully
        if ($insert_case_doc) {
            return redirect()->back()->with('success', 'تم اضافة المستند بنجاح')
            ->with('ring','play');
            
        }

    }


    public function add_excute_document(Request $request){

        //get document name
        $doc_name = $request->name;
        $data = array(); 

        //upload document
        $file = $request->file('doc');
        $ext = $file->getClientOriginalExtension();
        $filename=  $doc_name.'_'.time().'.'.$ext;
         $file->move('assets/excute-docs/'.$request->main_case_id.'/', $filename);

         $data['S_path'] = $filename;

         
        //get all new document information from request and store it into array
        $data['main_case_id']=$request->main_case_id;
        $data['excute_stage_id']=$request->excute_id;
        $data['S_SUBJECT']=$request->subject;
        $data['S_name']=$request->name;
        $data['name_eng']=$request->name_eng;
        $data['N_type']=$request->type;
        $data['N_version']=$request->v_num;
        $data['N_UserID']=Auth::id();
        $data['DT_Doc_Date']= \Carbon\Carbon::now(+'4');
       
               
       //add notification(activity)
        $activity = array(); 
       $activity['short_name']=' اضافة مستند';
       $activity['description']=' تم اضافة مستند تنفيذ جديد للقضية('.$request->main_case_id.')';
       $activity['create_by']=Auth::id();
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['url']="main-case-cases/$request->main_case_id";
        
       $insert_activity = DB::table('activities')->insert($activity);

       
        $insert_case_doc = DB::table('excute_documents')->insert($data);

        //check if document added successfully
        if ($insert_case_doc) {
            return redirect()->back()->with('success', 'تم اضافة المستند بنجاح')
            ->with('ring','play');
            
        }

    }

    public function update_decision(Request $request){

        //get stage_id and current status
        $stage_id = $request->stage_id;
        $status = $request->status;

        
        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث حالة جلسة';
        $activity['description']='تم تحديث حالة الجلسة';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');

        $insert_activity = DB::table('activities')->insert($activity);

        //update stage staus
        $update_stage = DB::table('t_hearing')
              ->where('N_HEARING_ID', $stage_id)
              ->update(['N_Reviewed' => $status]);

  
      return redirect()->back()->with('success', 'تم تحديث حالة الجلسة بنجاح')
                ->with('ring','play');
                
           
    }

    public function hide_stage($stage_id){

        //delete stage (hide)
        $update_stage = DB::table('t_hearing')
        ->where('N_HEARING_ID', $stage_id)
        ->update(['N_Reviewed' => '1']);

        return redirect()->back()->with('success', 'تم اخفاء  تنبيه الجلسة بنجاح')
        ->with('ring','play');

    }

   
}
