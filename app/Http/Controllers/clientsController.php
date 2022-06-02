<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class clientsController extends Controller
{

    //view all clients (clients page)
    public function index(){
        $lang = Session::get('lang');
        $clients = DB::table('t_clients')
        ->where('N_ISDELETED', '=', 0)
        ->orderBy('N_CLIENT_ID', 'desc')
        ->paginate(8);
        $branch = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
        $nationality = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 3)->get();
        $client_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 22)->get();

        $clients_search = DB::table('t_clients')
        ->orderBy('S_CLIENT_AR_NAME', 'asc')
        ->get();

        $clients_num = count($clients_search);
        

        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_client')
        ->first();

       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_client = 'true';
        }else{
            $add_client = 'false';
        }
       }else{
        $add_client = 'false';
    }
        
      
        return view('clients.clients',compact(['clients_search','add_client','clients','clients_num',
        'branch','nationality','client_type','lang']));
        
    }

    //add new client
    public function add_client(Request $request){
        $data = array(); 
       
    //get all new cllient information from request and store it into array
    $data['S_CLIENT_AR_NAME']=$request->name_ar;
    $data['S_CLIENT_EG_NAME']=$request->name_eng;
    $data['N_CLIENTTYPE']=$request->type;
    $data['N_BRANCH']=$request->branch;
    $data['N_NATIONALITY']=$request->nation;
    $data['ssn']=$request->ssn;
    $data['S_FAX']=$request->fax;
    $data['S_MB']=$request->mb;
    $data['S_Email']=$request->email1;
    $data['S_ADDRESS']=$request->address;
    $data['S_Email2']=$request->email2;
    $data['password']= Hash::make($request->password) ;
    $data['phone']=$request->phone;
    $data['client_info']=$request->more_info;


    //upload logo
    if($file=$request->file('logo')){
        $file = $request->file('logo');
        $ext = $file->getClientOriginalExtension();
        $filename= 'client-logo'.'_'.time().'.'.$ext;
         $file->move('assets/images/clients-imgs/', $filename);
         $data['client_logo'] = $filename;
      
    }else{
        $data['client_logo'] = 'no_image.png';
    }

     //add notification(activity)
    $activity = array(); 
    $activity['short_name']='اضافة عميل';
    $activity['description']='تم اضافة عميل جديد ('.$request->name_ar.')';
    $activity['create_by']=Auth::id();
    $activity['date_time']=  \Carbon\Carbon::now(+'4');
  
    $insert_activity = DB::table('activities')->insert($activity);

    $insert_client = DB::table('t_clients')->insert($data);
    if ($insert_client && $insert_activity) {
        return redirect(route('clients'))->with('success','تمت اضافة العميل بنجاح')
        ->with('ring','play');
       }
        
    }

    //search clients page
    public function search_clients(Request $request){
    
        //search request by name
        $client = $request->client_name;
        $show = $request->show;

        $clients =  DB::table('t_clients')
        ->where('S_CLIENT_AR_NAME', 'LIKE','%' . $client . '%')
        ->get();


        $branch = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
        $nationality = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 3)->get();
        $client_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 22)->get();

        $clients_search = DB::table('t_clients')
        ->orderBy('S_CLIENT_AR_NAME', 'asc')
        ->get();
        $clients_num = count($clients_search);
        

        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        $user_perm =  DB::table('permissions')
        ->where('role_id' , $user_role->role_id)
        ->where('module_name' , 'add_client')
        ->first();

        //check if user can add client
       if ($user_perm != null) {
        if ($user_perm->access == 1) {
            $add_client = 'true';
        }else{
            $add_client = 'false';
        }
       }else{
        $add_client = 'false';
    }
        
      
        return view('search.search-clients',compact(['clients_search','add_client','clients','clients_num','branch','nationality','client_type']));
        

    }

    //search client page
    public function search_clients_index(){
        $clients = DB::table('t_clients')
        ->where('N_ISDELETED', '=', 0)
        ->orderBy('N_CLIENT_ID', 'desc')
        ->limit(12)
        ->get();

        $clients_search = DB::table('t_clients')
        ->orderBy('S_CLIENT_AR_NAME', 'asc')
        ->get();
        $clients_num = count($clients_search);

        return view('search.search-clients',compact(['clients','clients_num']));

    }

    //client profile
    public function client_profile($from,$client_id){

        //get all client's data for client_id $client_id
        $contracts = DB::table('contracts')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 'contracts.contract_type')
        ->select( 't_detailedcodes.S_Desc_A AS contractType','contracts.*')
        ->where('client_id',$client_id )
        ->get();
        $contract_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 40)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $identities = DB::table('clients_identity')
        ->where('client_id',$client_id )
        ->get();

        //if there is no client identity create by defalut
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

        if ($from == 1 ) {
           $open = 'files';
        }else{
            $open = 'details';
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

        //client files
        $client_files = DB::table('t_files')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_files.branch')
        ->select('t_clients.S_CLIENT_AR_NAME','t_clients.client_logo', 't_detailedcodes.S_Desc_A AS branchName',
         't_detailedcodes.N_DetailedCode AS branchCode','t_files.*')
         
        ->where('client_id', '=',$client_id)
        ->orderBy('file_id', 'desc') 
        ->paginate(8);

        $client_files_id = DB::table('t_files')
        ->where('client_id', '=',$client_id)
        ->get();

        $files_count = count($client_files_id);
      

        //client files id's
        $files_id = array();
        foreach ($client_files_id as $file) {
            $files_id[] = $file->file_id;
        }
        
     
        //client's file cases
        $client_cases = DB::table('t_cases_master')
        ->leftJoin('users AS assingUser', 'assingUser.id', '=', 't_cases_master.N_AdminPerson')
        ->leftJoin('users AS userConsult', 'userConsult.id', '=', 't_cases_master.N_Consultant')
        ->leftJoin('t_detailedcodes AS branch', 'branch.N_DetailedCode', '=', 't_cases_master.N_BRANCH')
        ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 't_cases_master.N_CASE_STATUS')
        ->select('assingUser.name AS assignName','assingUser.id AS assignId', 'userConsult.name AS consultName','userConsult.id AS consultId',
         'branch.S_Desc_A AS branchName','branch.N_DetailedCode AS branchCode', 
         'caseStatus.S_Desc_A AS caseStatusName','caseStatus.N_DetailedCode AS caseStatusCode',
         't_cases_master.*')
        ->whereIn('S_CASE_FILE_NUM', $files_id )
        ->paginate(8);

        $client_cases_count = DB::table('t_cases_master')
        ->whereIn('S_CASE_FILE_NUM', $files_id )
        ->get();

        $main_cases_count =$client_cases_count->count();


        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
        $nationality = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 3)->get();
        $client_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 22)->get();

        $clients = DB::table('t_clients')->get();
        $opponents = DB::table('t_againsts')->get();


        $files_num = DB::table('t_files')
        ->orderBy('id', 'desc')
        ->first();

        //set file number by defalut
        if ($files_num) {
            $next_file_id = (int)$files_num->file_id;
        }else{
            $next_file_id = 0;
        }
       
        $users =  DB::table('users')->get();

        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        return view('clients.client-profile',compact(['main_cases_count','files_count','client_details',
        'client_files','clients','opponents','client_cases','branchs','nationality','client_type',
        'next_file_id','case_status','users','open','identities','contracts','client_id','contract_type']));

         

    }

    //update client's information
    public function update_client_details(Request $request,$client_id){
        $data = array();
       
        
        //get all new client information from request and store it into array
        $data['S_CLIENT_AR_NAME']=$request->name_ar;
        $data['S_CLIENT_EG_NAME']=$request->name_eng;
        $data['N_BRANCH']=$request->branch;
        $data['S_MB']=$request->mb_number;
        $data['N_NATIONALITY']=$request->nation;
        $data['S_ADDRESS']=$request->address;
        $data['shipping_address']=$request->sh_address;
        $data['ssn']=$request->ssn;
        $data['phone']=$request->phone;
        $data['S_Email']=$request->email;
        $data['S_Email2']=$request->email2;
        $data['S_FAX']=$request->fax;


        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['linkedin']=$request->linkedin;
        $data['telegram']=$request->telegram; 
        $data['microsoft_team']=$request->microsoft;
        $data['zoom_meetings']=$request->zoom;
        $data['skype']=$request->skype;

        if($file=$request->file('logo')){
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename= 'client-logo'.'_'.time().'.'.$ext;
             $file->move('assets/images/clients-imgs/', $filename);
             $data['client_logo'] = $filename;
          
        }

        //update client
        $update_client =  DB::table('t_clients')
        ->where('N_CLIENT_ID', $client_id)
        ->update($data);
      
      
            return redirect()->back()->with('success','تم تحديث بيانات العميل بنجاح')
            ->with('ring','play');


    }

    //reset client password
    public function update_client_password(Request $request,$client_id){
        $data['password'] = Hash::make($request->password);

        $update_password = DB::table('t_clients')
        ->where('N_CLIENT_ID',$client_id )
        ->update($data);

      
            return  redirect()->back()->with('success','تم تحديث كلمة المرور للعميل')
            ->with('ring','play');
    }

    //aginsts page
    public function opponents(){
        $lang = Session::get('lang');
        $opponents = DB::table('t_againsts')
        ->where('N_ISDELETED', '=', 0)
        ->orderBy('N_AGAINST_ID', 'desc')
        ->paginate(8);
        //get all againsts
        $opponents_count = DB::table('t_againsts')->get();
        $branch = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
        $nationality = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 3)->get();
        $opp_num = count($opponents_count);
        return view('clients.opponents',compact(['opponents','opp_num','branch','nationality','lang']));
    }

    //create new against
    public function add_opponents(Request $request){
        $data = array(); 

        
    //get all new against information from request and store it into array
    $data['S_AGAINST_AR_NAME']=$request->name_ar;
    $data['S_AGAINST_EG_NAME']=$request->name_eng;
    
    $data['N_BRANCH']=$request->branch;
    $data['N_CLIENTTYPE']=$request->type;
    $data['N_NATIONALITY']=$request->nation;
    $data['N_PASSPORT_ID']=$request->passport_num;
    $data['S_ACOUNT_NO']=$request->account_num;
    $data['S_FAX']=$request->fax;
    $data['S_Email']=$request->email;
    $data['S_ADDRESS']=$request->address;
    $data['phone']=$request->phone;
    $data['more_info']=$request->more_info;


    //upload against logo
    if($file=$request->file('logo')){
        $file = $request->file('logo');
        $ext = $file->getClientOriginalExtension();
        $filename= 'client-logo'.'_'.time().'.'.$ext;
         $file->move('assets/images/opponents-imgs/', $filename);
         $data['against_logo'] = $filename;
      
    }else{
        $data['against_logo'] = 'no_image.jpg';
    }

     //add notification(activity)
    $activity = array(); 
    $activity['short_name']='اضافة خصم';
    $activity['description']='تم اضافة خصم جديد ('.$request->name_ar.')';
    $activity['create_by']=Auth::id();
    $activity['date_time']=  \Carbon\Carbon::now(+'4');
   
  
    $insert_activity = DB::table('activities')->insert($activity);

    $insert_opp = DB::table('t_againsts')->insert($data);
    //check if against added successfully
    if ($insert_opp) {
        return redirect(route('opponents'))->with('success','تمت اضافة الخصم بنجاح')
        ->with('ring','play');
       }
        
    }


    //search for against
    public function search_againsts(Request $request){
    
        //get search data (name)
        $against = $request->against_name;
        $show = $request->show;

        $opponents =  DB::table('t_againsts')
        ->where('S_AGAINST_AR_NAME', 'LIKE','%' . $against . '%')
        ->get();

        $opponents_count = DB::table('t_againsts')->get();
        $opp_num = count($opponents_count);
        return view('search.search-opponents',compact(['opponents','opp_num']));

    }

       //search for against (repeat for refreshing page)
    public function search_againsts_index(Request $request){
    
        $against = $request->against_name;
        $show = $request->show;

        $opponents =  DB::table('t_againsts')
        ->where('S_AGAINST_AR_NAME', 'LIKE','%' . $against . '%')
        ->limit(10)
        ->get();

        $opponents_count = DB::table('t_againsts')->get();
        $opp_num = count($opponents_count);
        return view('search.search-opponents',compact(['opponents','opp_num']));

    }

    //against profile
    public function opponent_profile($from,$oponent_id){

        //from for open the tap
        if ($from == 1 ) {
            $open = 'files';
         }else{
             $open = 'details';
         }

         //against details
        $opponent_details = DB::table('t_againsts')
        ->leftJoin('t_detailedcodes AS deltailBranch', 'deltailBranch.N_DetailedCode', '=', 't_againsts.N_BRANCH')
        ->leftJoin('t_detailedcodes AS deltailNation', 'deltailNation.N_DetailedCode', '=', 't_againsts.N_NATIONALITY')
        ->select(
        'deltailBranch.N_DetailedCode AS branchCode',
        'deltailBranch.S_Desc_A AS branchName',

        'deltailNation.N_DetailedCode AS nationCode',
        'deltailNation.S_Desc_A AS nationName',
          't_againsts.*')
        ->where('N_AGAINST_ID', '=',$oponent_id)
        ->first();

        //against files
        $opponent_files = DB::table('t_cases_againsts')
        ->where('N_AGAINST_ID', '=',$oponent_id)
        ->get();
       
        $files_count = count($opponent_files);
        
        $files_id = array();
        foreach ($opponent_files as $file) {
            $files_id[] = $file->file_id;
        }

       //against cases
        $opponent_cases = DB::table('t_cases_master')
        ->whereIn('S_CASE_FILE_NUM', $files_id )
         ->get();
         $main_cases_count =$opponent_cases->count();

        //  dd($opponent_cases);

        $clients = DB::table('t_clients')->get();
        $opponents = DB::table('t_againsts')->get();


        $branch = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
        $nationality = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 3)->get();
        $client_type = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 22)->get();

        return view('clients.opponent-profile',compact(['main_cases_count','files_count','opponent_details',
        'opponent_files','clients','opponents','opponent_cases','branch','nationality','client_type','open']));
    }

    //update against informations
    public function update_opponent_details(Request $request,$opponent_id){
        $data = array();
       
        //get all new against information from request and store it into array
        $data['S_AGAINST_AR_NAME']=$request->name_ar;
        $data['S_AGAINST_EG_NAME']=$request->name_eng;
        $data['N_BRANCH']=$request->branch;
        $data['S_MB']=$request->mb_number;
        $data['N_NATIONALITY']=$request->nation;
        $data['S_ADDRESS']=$request->address;
        $data['N_PASSPORT_ID']=$request->passport;
        $data['phone']=$request->phone;
        $data['S_Email']=$request->email;
        $data['S_FAX']=$request->fax;
      

        //update against information
        $update_opponent =  DB::table('t_againsts')
        ->where('N_AGAINST_ID', $opponent_id)
        ->update($data);
      
      
            return redirect()->back()->with('success','تم تحديث بيانات الخصم بنجاح')
            ->with('ring','play');

    }

    //expert offices page
    public function experts_offices(){
        $lang = Session::get('lang');

        $experts = DB::table('t_experts')->get();

        return view('clients.experts-offices',compact(['experts','lang']));
    }

    //add new office
    public function add_expert(Request $request){
        $data = array(); 
        
//get all new office information from request and store it into array
    $data['S_Expert_AR_NAME']=$request->name_ar;
    $data['S_Expert_EG_NAME']=$request->name_eng;
    $data['S_OFFICE']=$request->phone;
    $data['S_REFRANCE']=$request->contact_person;
    $data['mobile_number']=$request->mobile;
    $data['S_ADDRESS']=$request->address;

    $insert_expert = DB::table('t_experts')->insert($data);

   //check if office added successfully
    if ($insert_expert) {
        return redirect()->back()->with('success','تم اضافة مكتب خبراء بنجاح')
        ->with('ring','play');
         }

    } 
    
    public function delete_expert($expert_id){

        //delete office with id $expert_id
        $delete_expert =  DB::table('t_experts')
        ->where('N_Expert_ID', $expert_id)
        ->delete();

        //check if office deleted successfully
        if ($delete_expert) {
            return redirect()->back()->with('success','تم حذف مكتب الخبراء بنجاح')
            ->with('ring','play');
        }
    }

    //client's updates page
    public function clients_updates(){
        $lang = Session::get('lang');

        $files = DB::table('t_files')
        ->orderBy('file_id', 'desc')
        ->get();
        $stages_updates=null;
        return view('clients.clients-updates',compact(['files','stages_updates','lang']));
    }

    //get cleint's update for a file
    public function get_clients_updates(Request $request){
        $lang = Session::get('lang');

        //get file number
        $file_id  =  $request->file_id;


        //get all data for client's file

        $get_clients_name = DB::table('t_files')
        ->join('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->where('t_files.file_id', $file_id)
        ->first();
        $client_name =  $get_clients_name->S_CLIENT_AR_NAME;

        $againsts_name = DB::table('t_cases_againsts')
        ->join('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->where('t_cases_againsts.file_id', $file_id)
        ->get('S_AGAINST_AR_NAME');

        $main_case = DB::table('t_cases_master')
        ->where('S_CASE_FILE_NUM', $file_id)
        ->first();

        
        $cases = DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS detailStage', 'detailStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
        ->select('detailStage.S_Desc_A AS case_stage_ar','detailStage.S_Desc_E AS case_stage_eng' ,
        't_cases_details.*' )
        ->where('N_CASE_ID', $main_case->N_CASE_ID)
        ->get();

        $lase_case = DB::table('t_cases_details')
        ->leftJoin('t_detailedcodes AS detailCourt', 'detailCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
       ->select('detailCourt.S_Desc_A AS court_ar','detailCourt.S_Desc_E AS court_eng','t_cases_details.*')
        ->orderBy('N_CASE_DETAILS_ID', 'desc')
        ->where('N_CASE_ID', $main_case->N_CASE_ID)
        ->first();
        if ($lase_case) {
           
        }else{
            return redirect(route('clients-updates'))->with('warning','هنالك نقض في بيانات الملف');
        }

        $lase_stage = DB::table('t_hearing')
        ->orderBy('N_HEARING_ID','desc')
        ->where('N_CASE_DETAILS_ID', $lase_case->N_CASE_DETAILS_ID)
        ->first();


        $files = DB::table('t_files')
        ->orderBy('file_id', 'desc')
        ->get();

        $stages_updates=1;
        if ($client_name && $againsts_name && $main_case && $cases && $lase_stage && $lase_case) {
            return view('clients.clients-updates',compact(['files','client_name','againsts_name','main_case',
            'cases','lase_stage','stages_updates','lase_case','lang']));
        }else{
            return redirect(route('clients-updates'))->with('warning','هنالك نقض في بيانات الملف');
        }
      
    }

    //create new contract
    public function add_contract(Request $request){
      

        $data['client_id']=$request->client_id;

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

        //upload file
        if ($file = $request->file('doc')) {
            $file = $request->file('doc');
            $ext = $file->getClientOriginalExtension();
            $filename= 'client_contract_'.time().'.'.$ext;
             $file->move('assets/clients-contracts/', $filename);
    
             $data['document'] = $filename;
        }
               
        $add_contract = DB::table('contracts')->insert($data);

        if ($add_contract) {
            return redirect()->back()->with('success','تم اضافة عقد بنجاح');
        }
    }
}
