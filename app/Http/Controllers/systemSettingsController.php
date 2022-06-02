<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class systemSettingsController extends Controller
{
    //view system notification page
    public function system_settings(){

        //get all tasks exept main task types
        $task_types = DB::table('tasks_type')
        ->where('id', '!=', 1)
        ->where('id', '!=', 2)
        ->where('id', '!=', 3)
        ->where('id', '!=', 4)
        ->get();

        //get all sentence config
        $sentence = DB::table('t_sentence_config')
        ->paginate(8);

        //get all options code
        $options = DB::table('t_detailedcodes')
        ->join('t_mastercodes', 't_mastercodes.N_MasterCode', '=', 't_detailedcodes.N_MasterCode')
        ->select('t_mastercodes.S_Desc_A as codeName','t_detailedcodes.*')
        ->orderBy('N_MasterCode', 'asc')
        ->paginate(10);
       
        //get all common questions
        $questions = DB::table('questions')
        ->get();

       return view('system-settings.system-settings',compact(['task_types','sentence','options']));
    }

    //create new task type
    public function add_task_type(Request $request){
        $data = array(); 

        //name of the task type
        $data['task_type']=$request->task_type;

        $insert_task_type = DB::table('tasks_type')->insert($data);

        //check if task type added successfully
        if ($insert_task_type) {
            return redirect(route('system-settings'))->with('success','تم اضافة نوع مهمة جديدة ');
           }
    }

    
    //create new option code
    public function add_option(Request $request){
        $data = array(); 

        //check if the option for excutions 
        if ($request->type == 't') {
         $data['S_Desc_A']=$request->name_ar.' - تنفيذ';
        $data['S_Desc_E']=$request->name_eng.'(excute)';
        $data['N_MasterCode']=7;
        }
        else
        {
            $data['S_Desc_A']=$request->name_ar;
            $data['S_Desc_E']=$request->name_eng;
            $data['N_MasterCode']=$request->type;
        }
       
       
      

        $insert_option = DB::table('t_detailedcodes')->insert($data);

        //check if option code added successfully
        if ($insert_option) {
            return redirect(route('system-settings'))->with('success','تم اضافة خيار  جديد');
           }
    }

    public function add_sentence(Request $request){
        $data = array(); 

        //get all new sentence config information from request and store it into array
        $data['S_Desc_A']=$request->name_ar;
        $data['S_Desc_E']=$request->name_eng;
        $data['S_NEXT_Desc_A']=$request->next_ar;
        $data['S_NEXT_Desc_E']=$request->next_eng;
        $data['N_Period']=$request->period;

        $option['S_Desc_A']=$request->name_ar;
        $option['S_Desc_E']=$request->name_eng;
        $option['N_MasterCode']= 31 ;

        $insert_option = DB::table('t_detailedcodes')->insertGetId($option);

        $data['N_HEARING_TYPE']=$insert_option;

        $insert_sentence =  DB::table('t_sentence_config')->insert($data);

        //check if sentence added successfully
        if ($insert_sentence) {
            return redirect()->back()->with('success','تم اضافة بند بنجاح');
           }
    }

    //update sentence config
    public function edit_sentence(Request $request){
        $data = array(); 

        //get all new sentence information from request and store it into array
        $sentence_id =$request->sentence_id;
        $data['S_Desc_A']=$request->name_ar;
        $data['S_Desc_E']=$request->name_eng;
        $data['S_NEXT_Desc_A']=$request->next_ar;
        $data['S_NEXT_Desc_E']=$request->next_eng;
        $data['N_Period']=$request->period;

        //update sentecnce
        $update_sentence =  DB::table('t_sentence_config')
        ->where('N_SEN_CONFIG_ID', $sentence_id)
        ->update($data);

            return redirect()->back()->with('success','تم التحديث بنجاح');
       
    }

    //view public settings page
    public function public_settings(){


        //get firm informations
        $about = DB::table('about_info')
        ->first();

        //get common qustions
        $questions = DB::table('questions')
        ->get();

        return view('system-settings.public-settings',compact(['about','questions']));
    }


    //update firm informations
    public function update_info(Request $request){

        //get all new information from request and store it into array
        $data['company_name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['about']=$request->info;
        $data['establish']=$request->establish;


        //update information
        $update_about =  DB::table('about_info')
        ->where('id',1)
        ->update($data);
        
            return redirect()->back()->with('success','تم التحديث معلومات الشركة بنجاح');

    }


    //update firm logo
    public function update_logo(Request $request){
      
        //upload logo and check if request has logo or set default value
        if($file=$request->file('logo')){
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename= 'company-logo'.'_'.time().'.'.$ext;
             $file->move('assets/images/', $filename);
             $data['logo'] = $filename;
          
        }else{
            $data['logo'] = 'no_image.jpg';
        }

        $update_about =  DB::table('about_info')
        ->where('id',1)
        ->update($data);
        
     
            return redirect()->back()->with('success','تم التحديث لوقو الشركة بنجاح');
       
    }

    //create new common qustion
    public function add_question(Request $request){
        $data = array(); 

        //get question and answer from request
        $data['question']=$request->question;
        $data['answer']=$request->answer;
       

        $insert_question = DB::table('questions')->insert($data);

        //check if question added successfully
        if ($insert_question) {
            return  redirect()->back()->with('success','تم اضافة سؤال  جديد');
           }
    }

    public function delete_question($q_id){

        //delete qustion where id = $q_id
        $delete_question =  DB::table('questions')
        ->where('id', $q_id)
        ->delete();
   
      
           return redirect()->back()->with('success','تم حذف السؤال بنجاح');
       }

       //update question
       public function update_question(Request $request){
        $data = array(); 

        //get question and answer request 
        $data['question']=$request->question;
        $data['answer']=$request->answer;
       

        //update question
        $update_question = DB::table('questions')
        ->where('id',$request->id )
        ->update($data);
      
        
        return  redirect()->back()->with('success','تم اضافة سؤال  جديد');
         
    }

    public function accounts_settings(){

        //get all users
        $users = DB::table('users')->get();

        return view('system-settings.accounts-settings',compact(['users']));
       }

       //update user password
       public function update_password(Request $request){


        if ($request->new_pass != null) {
          
               //make the password hashed
      $data['password'] = Hash::make($request->new_pass);
       

      //update hashed password
        $update_password = DB::table('users')
        ->where('id',$request->user_id )
        ->update($data);

        return  redirect()->back()->with('success','تم تحديث كلمة المرور');


        }else{
            return  redirect()->back();
        }
     
      
    }


    //delete sentence config
    public function delete_sentence($sent_id){

        //get sentence where id $sent_id
        $detail_code = DB::table('t_sentence_config')
        ->where('N_SEN_CONFIG_ID', $sent_id)
        ->first();
        
        //delete from details code
        $delete_code =  DB::table('t_detailedcodes')
        ->where('N_DetailedCode', $detail_code->N_HEARING_TYPE)
        ->delete();

        //delete from sentence config
        $delete =  DB::table('t_sentence_config')
        ->where('N_SEN_CONFIG_ID', $sent_id)
        ->delete();
   
        if ($delete) {
           return redirect()->back()->with('success','تم حذف البند بنجاح');
   
        }

       }

     //delete option code  
    public function delete_option($option_id){
     
        //delete from sentntece where id $option_id
        $delete =  DB::table('t_sentence_config')
        ->where('N_HEARING_TYPE', $option_id)
        ->delete();
        
        //delete code where id = $option_id
        $delete_code =  DB::table('t_detailedcodes')
        ->where('N_DetailedCode', $option_id)
        ->delete();
        
        if ($delete_code) {
           return redirect()->back()->with('success','تم حذف الخيار بنجاح');
   
        }
       }
}
