<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class reportsController extends Controller
{

    //files report page index
    public function file_reports(){
        $against =  DB::table('t_againsts')->get();
        $clients =  DB::table('t_clients')->get();
        $files_id =  DB::table('t_files')->get();
        $courts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $report=null;
        return view('reports.files-reports',compact(['courts','clients','against','report','files_id']));
    }

    //get file report from filter
    public function report_by_file(Request $request){

        //file number
        $file_num = $request->file_number;

        //get the file information
        $report =  DB::table('t_cases_master')
        ->join('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_master.N_CASE_ID')
        ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS caseCourt', 'caseCourt.N_DetailedCode', '=', 't_cases_master.N_COURT_ID')
        ->select('caseCourt.S_Desc_A AS caseCourt','t_againsts.S_AGAINST_AR_NAME AS againstName_ar',
        't_againsts.S_AGAINST_EG_NAME AS againstName_eng',
        't_clients.S_CLIENT_AR_NAME AS clientName_ar', 't_clients.S_CLIENT_EG_NAME AS clientName_eng',
        't_cases_master.*')  
        ->where('t_cases_master.S_CASE_FILE_NUM',$file_num )
        ->orderBy('t_cases_master.N_CASE_ID','desc')
        ->first();
      

        if ($report) {

            $stages =  DB::table('t_cases_details')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
         ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
         ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
         ->leftJoin('t_detailedcodes AS caseStage', 'caseStage.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
         ->select('courtName.S_Desc_A AS courtName',
         'caseType.S_Desc_A AS caseType',
         'caseStage.S_Desc_A AS caseStage',
         't_cases_master.register_date AS register_date',
         't_cases_master.N_PaymentValue AS cliam_amount',
         't_cases_details.*')  
         ->where('t_cases_master.N_CASE_ID',$report->N_CASE_ID)
         ->orderBy('t_cases_details.N_CASE_DETAILS_ID','desc')
         ->get();

         $case_array = array();
         $decission_array = array();
 
         foreach ($stages as $stage ) {
            $case_array[] =  $stage;
         }
         
      
         //check if each file has cases stages 
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


         //get the linked cases with file
            $linked_cases =  DB::table('t_cases_details')
        ->where('N_CASE_ID',  $report->N_CASE_ID)
        ->get();
        if ( $linked_cases) {
            $linked_cases_number = count($linked_cases);
        }else{
            $linked_cases_number = "";
        }

        //get all main cases
        $main_case =  DB::table('t_cases_details')
        ->where('N_CASE_ID',  $report->N_CASE_ID)
        ->orderBy('N_CASE_DETAILS_ID','asc')
        ->first();

        //check the file main cases for last stage decision
        if ($main_case) {
            $main_case_uid = $main_case->S_CASE_UID; 

            $main_case_decision =  DB::table('t_hearing')
            ->where('N_CASE_DETAILS_ID',  $main_case->N_CASE_DETAILS_ID)
            ->orderBy('N_HEARING_ID','desc')
            ->first();
            if ($main_case_decision) {
                $last_main_case_decision =  $main_case_decision->S_HEARING_DESIGION;
            }else{
                $last_main_case_decision = "";
            }
    

        }
        //if not add empty string to last decision
        else{
            $main_case_uid = "";
            $last_main_case_decision ='';
        }

        $last_case =  DB::table('t_cases_details')
        ->where('N_CASE_ID',  $report->N_CASE_ID)
        ->orderBy('N_CASE_DETAILS_ID','desc')
        ->first();

        if ($last_case) {

            $last_case_decision =  DB::table('t_hearing')
            ->where('N_CASE_DETAILS_ID',  $last_case->N_CASE_DETAILS_ID)
            ->orderBy('N_HEARING_ID','desc')
            ->first();
            
            if ($last_case_decision) {
                $last_last_case_decision =  $last_case_decision->S_HEARING_DESIGION;
            }else{
                $last_last_case_decision = "";
            }

        }else{
           
            $last_last_case_decision ='';
        }
     }else{

        $against =  DB::table('t_againsts')->get();
        $clients =  DB::table('t_clients')->get();
        $files_id =  DB::table('t_files')->get();
        $courts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $report=null;
        $case_array = array();
        $decission_array = array();
        return view('reports.files-reports',compact(['courts','clients','against','report',
        'files_id','case_array','decission_array']));
        
     }

      
       

     //get all clients, against and court
        $against =  DB::table('t_againsts')->get();
        $clients =  DB::table('t_clients')->get();
        $courts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $print_date =  \Carbon\Carbon::now(+'4');

        //get all files
        $files_id =  DB::table('t_files')->get();

        return view('reports.files-reports',compact(['report','linked_cases_number','main_case_uid',
        'last_main_case_decision','last_last_case_decision','courts',
        'clients','against','print_date','files_id','case_array','decission_array']));


    }

    //register reports
    public function register_reports(){
        
        //get all cases
        $registers =  DB::table('t_cases_details')
        ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->leftJoin('t_detailedcodes AS caseCourt', 'caseCourt.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->select('caseType.S_Desc_A AS caseType','caseCourt.S_Desc_A AS caseCourt','t_againsts.S_AGAINST_AR_NAME AS againstName_ar',
        't_againsts.S_AGAINST_EG_NAME AS againstName_eng',
        't_clients.S_CLIENT_AR_NAME AS clientName_ar', 't_clients.S_CLIENT_EG_NAME AS clientName_eng','t_cases_master.N_CASE_ID AS main_case_id',
        't_cases_master.DT_CASE_DATE AS case_date','t_cases_master.S_CASE_FILE_NUM AS file_num',
        't_cases_details.*')  
        ->orderBy('t_cases_master.N_CASE_ID','desc')
        ->paginate(20);

        //get all files
        $files = DB::table('t_files')
        ->orderBy('file_id', 'desc')
        ->get();

        return view('reports.register-reports',compact(['registers','files']));
    }


    //get register report by filter
    public function get_register_reports(Request $request){
        

        //get register by filter 
        $registers =  DB::table('t_cases_details')
        ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->join('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->select('caseType.S_Desc_A AS caseType','t_againsts.S_AGAINST_AR_NAME AS againstName_ar',
        't_againsts.S_AGAINST_EG_NAME AS againstName_eng',
        't_clients.S_CLIENT_AR_NAME AS clientName_ar', 't_clients.S_CLIENT_EG_NAME AS clientName_eng','t_cases_master.N_CASE_ID AS main_case_id',
        't_cases_master.DT_CASE_DATE AS case_date','t_cases_master.S_CASE_FILE_NUM AS file_num',
        't_cases_details.*') 
        ->where('t_cases_master.S_CASE_FILE_NUM',  $request->file_id) 
        ->orderBy('t_cases_master.N_CASE_ID','desc')
        ->paginate(100);

        $files = DB::table('t_files')
        ->orderBy('file_id', 'desc')
        ->get();
        return view('reports.register-reports',compact(['registers','files']));
    }

    //stage schedule reports page
    public function stages_schedule(){
        $users =  DB::table('users')->get();
        $courts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $stages=null;
        return view('reports.stages-schedule',compact(['courts','users','stages']));
    }


    //get stage schedule report by filter
    public function get_stages_schedule(Request $request){

        //get all filter data
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $court = $request->court;
        $lawyer = $request->lawyer;
      
     
            $stages_counts =  DB::table('t_hearing')
            ->whereBetween('DT_HEARING_DATE', [$from_date, $to_date])
            ->where('t_hearing.N_COURT_ID', 'LIKE','%' . $court . '%')
            ->where('N_LAWYER_ID', 'LIKE','%' . $lawyer . '%')
            ->get();
            $stages =  DB::table('t_hearing')
            ->join('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
            ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
            ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
            ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
            ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
            ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
            ->leftJoin('t_detailedcodes AS clientType', 'clientType.N_DetailedCode', '=', 't_cases_details.N_CAPACITY_ID')
            ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
            ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
            ->select('clientType.S_Desc_A AS clientType','courtName.S_Desc_A AS courtName',
            'caseType.S_Desc_A AS caseType',
            't_againsts.S_AGAINST_AR_NAME AS againstName',
            't_clients.S_CLIENT_AR_NAME AS clientName',
            't_cases_master.N_CASE_ID AS main_case_id',
            't_cases_master.S_CASE_FILE_NUM AS file_num',
            't_cases_details.S_CASE_UID AS case_id',
            't_hearing.*')  
            ->whereBetween('DT_HEARING_DATE', [$from_date, $to_date])
            ->where('t_hearing.N_COURT_ID', 'LIKE','%' . $court . '%')
            ->where('N_LAWYER_ID', 'LIKE','%' . $lawyer . '%')
            ->get()
            ->groupBy('courtName');
      
        $courts_names = $stages;
       
       
        $print_date =  \Carbon\Carbon::now(+'4');

        //get the to day date in arabic
        $date_carbon = Carbon::parse($to_date);

        $day_name_to = $date_carbon->format('l');

        //check the day
        if ($day_name_to == 'Wednesday') {
            $day_name_to = 'الاربعاء';
        }elseif ($day_name_to == 'Sunday') {
            $day_name_to = 'الاحد';
        }
        elseif ($day_name_to == 'Monday') {
            $day_name_to = 'الاثنين';
        }
        elseif ($day_name_to == 'Thursday') {
            $day_name_to = 'الخميس';
        }
        elseif ($day_name_to == 'Tuesday') {
            $day_name_to = 'الثلاثاء';
        }
        elseif ($day_name_to == 'Wednesday') {
            $day_name = 'الاربعاء';
        }
        elseif ($day_name_to == 'Friday') {
            $day_name_to = 'الجمعة';
        }


         //get the to day date in arabic
        $date_carbon = Carbon::parse($from_date);
        
        $day_name = $date_carbon->format('l');

        //check the day
        if ($day_name == 'Wednesday') {
            $day_name = 'الاربعاء';
        }elseif ($day_name == 'Sunday') {
            $day_name = 'الاحد';
        }
        elseif ($day_name == 'Monday') {
            $day_name = 'الاثنين';
        }
        elseif ($day_name == 'Thursday') {
            $day_name = 'الخميس';
        }
        elseif ($day_name == 'Tuesday') {
            $day_name = 'الثلاثاء';
        }
        elseif ($day_name == 'Wednesday') {
            $day_name = 'الاربعاء';
        }
        elseif ($day_name == 'Friday') {
            $day_name = 'الجمعة';
        }

        //get all users and courts 
        $users =  DB::table('users')->get();
        $courts = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //count the number of stages
        $stages_count = count($stages_counts);
        

      
        return view('reports.stages-schedule',compact(['courts','users','stages','from_date','to_date',
        'courts_names','print_date','day_name', 'day_name_to','stages_count']));
    }


    //expert stages report page
    public function experts_stages(){

        //get all expert stages
        $stages =  DB::table('t_hearing')
        ->join('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
        ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS clientType', 'clientType.N_DetailedCode', '=', 't_cases_details.N_CAPACITY_ID')
        ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->select('clientType.S_Desc_A AS clientType','courtName.S_Desc_A AS courtName',
        'caseType.S_Desc_A AS caseType',
        't_againsts.S_AGAINST_AR_NAME AS againstName',
        't_clients.S_CLIENT_AR_NAME AS clientName',
        't_cases_master.N_CASE_ID AS main_case_id',
        't_cases_master.S_CASE_FILE_NUM AS file_num',
        't_cases_details.S_CASE_UID AS case_id',
        't_hearing.*')  
        ->where('t_hearing.N_HEARINGTYPE', 6030)
        ->orderBy('DT_HearingEnterDate','desc')
        ->get();

        $from_date = null;
        $to_date = null;
      
        $print_date =  \Carbon\Carbon::now(+'4');

        return view('reports.experts-stages',compact(['stages','from_date','to_date','print_date']));
    }


    //get expert stages by filter
    public function get_experts_stages(Request $request){

        //get the date from/to
        $from_date = $request->from_date;
        $to_date = $request->to_date;
          
        //get the expert stages where filter and option code 6030 for expert stages type
        $stages =  DB::table('t_hearing')
        ->join('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
        ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->leftJoin('t_detailedcodes AS clientType', 'clientType.N_DetailedCode', '=', 't_cases_details.N_CAPACITY_ID')
        ->leftJoin('t_detailedcodes AS courtName', 'courtName.N_DetailedCode', '=', 't_cases_details.N_COURT_ID')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->select('clientType.S_Desc_A AS clientType','courtName.S_Desc_A AS courtName',
        'caseType.S_Desc_A AS caseType',
        't_againsts.S_AGAINST_AR_NAME AS againstName',
        't_clients.S_CLIENT_AR_NAME AS clientName',
        't_cases_master.N_CASE_ID AS main_case_id',
        't_cases_master.S_CASE_FILE_NUM AS file_num',
        't_cases_details.S_CASE_UID AS case_id',
        't_hearing.*') 
        ->whereBetween('DT_HearingEnterDate', [$from_date, $to_date]) 
        ->where('t_hearing.N_HEARINGTYPE', 6030)
        ->orderBy('DT_HearingEnterDate','asc')
        ->get();       
       
        $print_date =  \Carbon\Carbon::now(+'4');        

        return view('reports.experts-stages',compact(['stages','from_date','to_date','print_date']));

    }


    //memoir schedule
    public function memoir_schedule(){

        //get all users
        $users =  DB::table('users')->get();

        //get all memoir
        $memoir =  DB::table('memoir')
        ->join('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 'memoir.case_id')
        ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 'memoir.main_case_id')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 'memoir.main_case_id')
        ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->join('t_detailedcodes AS memoir_type', 'memoir_type.N_DetailedCode', '=', 'memoir.excute_need')
        ->leftJoin('t_detailedcodes AS client_type', 'client_type.N_DetailedCode', '=', 't_cases_details.N_CAPACITY_ID')
        ->join('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->join('users AS assign', 'assign.id', '=', 'memoir.consultant')
        ->select('assign.name AS assignTo', 'caseType.S_Desc_A AS case_type',
        'client_type.S_Desc_A AS clientType','t_cases_details.S_CASE_UID AS case_uid','t_cases_master.S_CASE_FILE_NUM AS file_num',
        't_againsts.S_AGAINST_AR_NAME AS againstName','t_clients.S_CLIENT_AR_NAME AS clientName',
        'memoir_type.S_Desc_A AS excute_Name' ,'memoir.*')
        ->orderBy('memoir.excute_date','desc')
        ->get();

   

        //get all cases types from deatils code
        $type = DB::table('t_detailedcodes')
        ->where('N_MasterCode', '=', 41)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        $print_date =  \Carbon\Carbon::now(+'4');
        return view('reports.memoir-schedule',compact(['type','users','memoir','print_date']));
    }

    //get memoir schedule from filter
    public function get_memoir_schedule(Request $request){

        //get all filter data
        $case_uid = $request->case_uid;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $type = $request->type;

        $users =  DB::table('users')->get();

        //get memoir schedule where filter data
        $memoir =  DB::table('memoir')
        ->join('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 'memoir.case_id')
        ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 'memoir.main_case_id')
        ->leftJoin('t_cases_againsts', 't_cases_againsts.N_CASE_ID', '=', 'memoir.main_case_id')
        ->join('t_files', 't_files.file_id', '=', 't_cases_master.S_CASE_FILE_NUM')
        ->leftJoin('t_detailedcodes AS caseType', 'caseType.N_DetailedCode', '=', 't_cases_details.N_CASE_TYPE')
        ->join('t_detailedcodes AS memoir_type', 'memoir_type.N_DetailedCode', '=', 'memoir.excute_need')
        ->leftJoin('t_detailedcodes AS client_type', 'client_type.N_DetailedCode', '=', 't_cases_details.N_CAPACITY_ID')
        ->join('t_clients', 't_clients.N_CLIENT_ID', '=', 't_files.client_id')
        ->leftJoin('t_againsts', 't_againsts.N_AGAINST_ID', '=', 't_cases_againsts.N_AGAINST_ID')
        ->join('users AS assign', 'assign.id', '=', 'memoir.consultant')
        ->select('assign.name AS assignTo', 'caseType.S_Desc_A AS case_type',
        'client_type.S_Desc_A AS clientType','t_cases_details.S_CASE_UID AS case_uid','t_cases_master.S_CASE_FILE_NUM AS file_num',
        't_againsts.S_AGAINST_AR_NAME AS againstName','t_clients.S_CLIENT_AR_NAME AS clientName',
        'memoir_type.S_Desc_A AS excute_Name' ,'memoir.*')
        ->where('t_cases_details.S_CASE_UID', $case_uid)
        ->where('t_cases_details.S_CASE_UID', '!=', null)
        ->orWhereBetween('memoir.excute_date', [$date_from, $date_to])
        ->where('memoir.excute_need', 'LIKE','%' . $type . '%')
        ->orderBy('memoir.excute_date','asc')
        ->get();
        
    

        //get all cases types from details code
        $type = DB::table('t_detailedcodes')
        ->where('N_MasterCode', '=', 41)
        ->orderBy('S_Desc_A', 'asc')
        ->get();

        //get today date
        $print_date =  \Carbon\Carbon::now(+'4');

        return view('reports.memoir-schedule',compact(['type','users','memoir','print_date']));
    }
}
