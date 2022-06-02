<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class filesController extends Controller
{
    //all files page
    public function index(){

        //get all files
        $files = DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_files.branch')
        ->select('t_clients.S_CLIENT_AR_NAME','t_clients.N_CLIENT_ID', 't_clients.S_CLIENT_EG_NAME','t_clients.client_logo', 't_detailedcodes.S_Desc_A AS branchName',
         't_detailedcodes.N_DetailedCode AS branchCode','t_files.*')
        ->orderBy('id', 'desc') 
        ->paginate(9);

        $files_count = DB::table('t_files')->get();

        $files_branchs = DB::table('t_files')
        ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_files.branch')
        ->select('t_detailedcodes.S_Desc_A AS branch_name','t_files.*')
        ->get()
        ->groupBy('branch_name');
        $branch_name = $files_branchs;
        $files_branches_array = array();

        $i = 0;

        //for chart info
        foreach ($branch_name as $branchName => $files_branchs) {    
            $files_branches_array[$i] = 
                [
                    "y"=> $branch_name[$branchName]->count(),
                    "label"=>  $branchName
                ];
            $i++;
        }
       

        $clients = DB::table('t_clients')
        ->orderBy('S_CLIENT_AR_NAME', 'asc')
        ->get();
      

        $files_num = DB::table('t_files')
        ->orderBy('id', 'desc')
        ->first();

        if ($files_num) {
            $next_file_id = (int)$files_num->file_id;
        }else{
            $next_file_id = 0;
        }
       

       $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
       $users =  DB::table('users')->get();

       $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_file')
        ->first();

        //check if user can add file (permission)
       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_file = 'true';
        }else{
            $add_file = 'false';
        }
       }else{
        $add_file = 'false';
    }
     
        return view('case-manage.files',compact(['files_count','add_file','users',
        'files','clients','branchs','next_file_id','files_branches_array']));
        
    }

    //create new file
    public function add_file(Request $request){
        
          //delete the (,) from fee and make it int
        $fee = preg_replace('/[,]/', '', $request->fee);
        $fee = intval($fee);

        $data = array(); 
        
        
        //get all new file information from request and store it into array
        $data['file_id']=$request->next_id;
        $data['client_id']=$request->client;
        $data['branch']=$request->branch;
        $data['create_by']=Auth::id();
        $data['office_fee']=$fee;
        $data['create_date']= \Carbon\Carbon::now()->format('Y-m-d');
        $data['more_info']=$request->more_info;

       
        

         //add notification(activity)
        $activity = array(); 
        $activity['short_name']='اضافة ملف';
        $activity['description']='تم اضافة ملف جديد ('.$request->next_id.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
      
        $insert_activity = DB::table('activities')->insert($activity);

        $insert_file = DB::table('t_files')->insert($data);

        //check if file added successfully
        if ($insert_file) {

            return redirect()->back()
            ->with('success','تم اضافة الملف بنجاح')
            ->with('ring','play');
           
           }
    }

    //update file information
    public function update_file(Request $request){

            
        //delete the (,) from fee and make it int
        $fee = preg_replace('/[,]/', '', $request->fee);
        $fee = intval($fee);

        $file_id = $request->file_id;
      
        $data = array(); 

     //get all new file information from request and store it into array
        $data['client_id']=$request->client_id;
        $data['branch']=$request->branch;
        $data['office_fee']=$fee;
        $data['more_info']=$request->more_info;

        //update file
        $update_file =  DB::table('t_files')
        ->where('id', $file_id)
        ->update($data);

         //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث ملف';
        $activity['description']='تم تحديث الملف  ('.$request->file_idd.')';
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
      
        $insert_activity = DB::table('activities')->insert($activity);
       
            return redirect()->back()->with('success','تم تحديث الملف بنجاح')
            ->with('ring','play');

    }

    //search file page (result)
    public function search_file(Request $request){

        //get the file number
        $file_num = $request->file_num;
        $client = $request->client;
    
       
    
        $files =  DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_files.branch')
        ->select('t_clients.S_CLIENT_AR_NAME','t_clients.N_CLIENT_ID','t_clients.S_CLIENT_EG_NAME', 't_clients.client_logo', 't_detailedcodes.S_Desc_A AS branchName',
         't_detailedcodes.N_DetailedCode AS branchCode','t_files.*')
        ->where('file_id', 'LIKE','%' . $file_num . '%')
        ->where('client_id', 'LIKE','%' . $client . '%')
        ->get();


        
       $clients = DB::table('t_clients')
       ->orderBy('S_CLIENT_AR_NAME', 'asc')
       ->get();
       $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();

       $users =  DB::table('users')->get();

        return view('search.files-search',compact(['users','files','clients','branchs']));


    }

    //search file page
    public function search_files_index(){

        $files = DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_files.branch')
        ->select('t_clients.S_CLIENT_AR_NAME','t_clients.N_CLIENT_ID','t_clients.S_CLIENT_EG_NAME','t_clients.client_logo', 't_detailedcodes.S_Desc_A AS branchName',
         't_detailedcodes.N_DetailedCode AS branchCode','t_files.*')
        ->paginate(8);

        $clients = DB::table('t_clients')->get();
        $opponents = DB::table('t_againsts')->get();
        $users =  DB::table('users')->get();
        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();


        return view('search.files-search',compact(['users','files','clients','opponents','branchs']));


    }

    //main case for file
    public function file_case(Request $request){

        //get file number
        $file_id = $request->file_id;

        //get the main case for the file
        $case =  DB::table('t_cases_master')
        ->join('t_files','t_files.file_id', '=' , 't_cases_master.S_CASE_FILE_NUM')
        ->join('t_clients','t_clients.N_CLIENT_ID', '=' , 't_files.client_id')
        ->leftJoin('t_cases_againsts','t_cases_againsts.N_CASE_ID', '=' , 't_cases_master.N_CASE_ID')
        ->leftJoin('t_againsts','t_againsts.N_AGAINST_ID', '=' , 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('users AS assingUser', 'assingUser.id', '=', 't_cases_master.N_AdminPerson')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_cases_master.N_Consultant')
        ->leftJoin('t_detailedcodes AS branch', 'branch.N_DetailedCode', '=', 't_cases_master.N_BRANCH')
        ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 't_cases_master.N_CASE_STATUS')
        ->select('assingUser.name AS assignName','assingUser.id AS assignId', 
        'userConsult.name AS consultName','userConsult.id AS consultId',
         'branch.S_Desc_A AS branchName','branch.N_DetailedCode AS branchCode',
        'caseStatus.S_Desc_A AS caseStatusName', 'caseStatus.N_DetailedCode AS caseStatusCode',
        't_againsts.S_AGAINST_AR_NAME AS againstName',
        't_clients.S_CLIENT_AR_NAME AS clientName',
         't_cases_master.*')
        ->where('S_CASE_FILE_NUM', $file_id)
        ->first();
   

        //check if file has main case
      if ($case) {

        $case_id =  DB::table('t_cases_details')
        ->where('N_CASE_ID', $case->N_CASE_ID)
        ->first();
        if ($case_id) {
            $cases_number = DB::table('t_hearing')
            ->where('N_CASE_DETAILS_ID', $case_id->N_CASE_DETAILS_ID)
            ->get();
            $cases_count = count($cases_number);
        }else{
            $cases_count = 0;
          }

      }else{
        $cases_count = 0;
      }
    
        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();

        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $users =  DB::table('users')->get();
        $againsts = DB::table('t_againsts')->get();


        $against_list = DB::table('t_cases_againsts')
        ->join('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->where('t_cases_againsts.file_id',$file_id)
        ->select('t_againsts.*',)
        ->get();


        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_file')
        ->first();

        //check the permission for adding file
       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_file = 'true';
        }else{
            $add_file = 'false';
        }
       }else{
        $add_file = 'false';
    }


    
        return view('case-manage.file-case',compact('cases_count','add_file','case' ,'file_id','users',
        'case_status','case_type','branchs','againsts','against_list'));
   
    }

    //main case for the file
    public function file_case_withID($main_case_id){
        //find the main case number

        $find_file_id =  DB::table('t_cases_master')
        
        ->where('N_CASE_ID', $main_case_id)
        ->first();

        //get the file id
        $file_id = $find_file_id->S_CASE_FILE_NUM;
        
        //get the main case
        $case =  DB::table('t_cases_master')
        ->join('t_files','t_files.file_id', '=' , 't_cases_master.S_CASE_FILE_NUM')
        ->join('t_clients','t_clients.N_CLIENT_ID', '=' , 't_files.client_id')
        ->leftJoin('t_cases_againsts','t_cases_againsts.N_CASE_ID', '=' , 't_cases_master.N_CASE_ID')
        ->leftJoin('t_againsts','t_againsts.N_AGAINST_ID', '=' , 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('users AS assingUser', 'assingUser.id', '=', 't_cases_master.N_AdminPerson')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_cases_master.N_Consultant')
        ->leftJoin('t_detailedcodes AS branch', 'branch.N_DetailedCode', '=', 't_cases_master.N_BRANCH')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_master.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 't_cases_master.N_CASE_STATUS')
        ->select('assingUser.name AS assignName','assingUser.id AS assignId', 
        'userConsult.name AS consultName','userConsult.id AS consultId',
         'branch.S_Desc_A AS branchName','branch.N_DetailedCode AS branchCode',
        'caseStatus.S_Desc_A AS caseStatusName', 'caseStatus.N_DetailedCode AS caseStatusCode',
        't_againsts.S_AGAINST_AR_NAME AS againstName',
        't_clients.S_CLIENT_AR_NAME AS clientName',
         't_cases_master.*')
        ->where('S_CASE_FILE_NUM', $file_id)
        ->first();
      

        //check if file has main case then get the first case for the main case
      if ($case) {
        $case_id =  DB::table('t_cases_details')
        ->where('N_CASE_ID', $case->N_CASE_ID)
        ->first();

        $cases_number = DB::table('t_hearing')
        ->where('N_CASE_DETAILS_ID', $case_id->N_CASE_DETAILS_ID)
        ->get();
        $cases_count = count($cases_number);
      }else{
        $cases_count = 0;
      }
    
        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();
        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $users =  DB::table('users')->get();
        $againsts = DB::table('t_againsts')->get();


        $against_list = DB::table('t_cases_againsts')
        ->join('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->where('t_cases_againsts.file_id',$file_id)
        ->select('t_againsts.*',)
        ->paginate(8);


        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_file')
        ->first();

        //check permission for adding file
       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_file = 'true';
        }else{
            $add_file = 'false';
        }
       }else{
        $add_file = 'false';
    }

        return view('case-manage.file-case',compact('cases_count','add_file','case' ,'file_id','users','case_status','case_type','branchs','againsts','against_list'));
   
    }

    //add against for the file
    public function add_against(Request $request){

        $data = array(); 

        
        //get all new against information from request and store it into array
        $data['file_id']=$request->file_id;
        $data['N_CASE_ID']=$request->main_case_id;
        $data['N_AGAINST_ID']=$request->against_id;

        $add_against = DB::table('t_cases_againsts')->insert($data);
        if ($add_against) {
            return redirect('file-case/'.$request->main_case_id)->with('success', 'تم اضافة خصم بنجاح')
            ->with('ring','play');
            
        }

    }

    //delete against from file
    public function delete_against($aginst_id,$file_id){

        //delete aginst with id $aginst_id and file_id $file_id
        $delete_against =  DB::table('t_cases_againsts')
        ->where('file_id', $file_id)
        ->where('N_AGAINST_ID', $aginst_id)
        ->delete();

        $main_case_id =  DB::table('t_cases_master')
        ->where('S_CASE_FILE_NUM', $file_id)
        ->first();

        //check if against delete successfully
        if ($delete_against) {
            return redirect('file-case/'.$main_case_id->N_CASE_ID)->with('success', 'تم حذف الخصم بنجاح')
            ->with('ring','play');

        }
    }


    //view all tasks page
    public function tasks(){
        $cases_uid = DB::table('t_cases_details')->get();
        $main_cases = DB::table('t_cases_master')->get();
        $task_type = DB::table('tasks_type')->get();
        $tasks = DB::table('t_tasks')
        ->join('users', 'users.id', '=', 't_tasks.created_by')
        ->select('users.name', 't_tasks.*')
        ->get();

        return view('case-manage.tasks',compact(['tasks','cases_uid', 'main_cases','task_type']));

    }


}
