<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class hrController extends Controller
{

    //all employees page
   public function all_employees(){
    
    //get all users
    $users = DB::table('users')
    ->leftJoin('departments', 'departments.id', '=', 'users.dept_id')
    ->select('departments.dept_name','users.*')
    ->orderBy('id', 'desc')
    ->get();

    //get all roles
    $roles = DB::table('roles')->get();

    //get all departments
    $departments = DB::table('departments')->get();
  
    return view('HR.all-employees',compact(['users','roles','departments']));
   }

   public function add_user(Request $request){

       $data = array();

       //get all new user information from request and store it into array
       $data['name']=$request->name;
       $data['phone']=$request->phone;
       $data['email']=$request->email;
       $data['dept_id']=$request->dept_id;
       $data['password']=Hash::make($request->password);

       $add_user = DB::table('users')->insertGetId($data);

      
       $user_role = array();

       //assing role to new user
       $user_role['user_id']=$add_user;
       $user_role['role_id']=$request->role_id;

       $user_role = DB::table('users_permissions')->insert($user_role);

       //check if user added successfully
        if ($add_user) {
            return redirect()->back()->with('success','تم اضافة موظف بنجاح');
           }  
   }

   public function delete_user($user_id){
       
    //delete user with id $user_id (make disabled = 1)
    $delete_user =  DB::table('users')
    ->where('id', $user_id)
    ->update(['disabled' => 1]);
    
        return redirect()->back()->with('success','تم تعطيل الحساب بنجاح');

   }

   public function active_user($user_id){
       
    //active user (make disabled = 0)
    $delete_user =  DB::table('users')
    ->where('id', $user_id)
    ->update(['disabled' => 0]);
    
        return redirect()->back()->with('success','تم تفعيل الحساب بنجاح');

   }


   //departments page
   public function departments(){

    //get all departments
    $departments = DB::table('departments')->get();
  
    return view('HR.departments',compact(['departments']));
   }

   public function add_department(Request $request){

    //create new department
    $dept_name = array(); 
    $dept_name['dept_name']=$request->dept_name;
    $insert_dept = DB::table('departments')->insert($dept_name);

    

    //check if department added successfully
    if ($insert_dept) {
        return redirect()->back()->with('success','تم اضافة قسم جديد بنجاح');
         }

   }

   public function delete_department($dept_id){
       
    //delete department with id $dept_id
    $delete_users_dept =  DB::table('users')
    ->where('dept_id', $dept_id)
    ->update(['dept_id' => 0]);

    $delete_dept =  DB::table('departments')
     ->where('id', $dept_id)
     ->delete();

    
        return redirect()->back()->with('success','تم حذف القسم بنجاح');

   }

   //roles and permission page
  public function roles(){

    //get all users
    $users =DB::table('users')
    ->get();

    //get all users with each user permission
    $users_permissions = DB::table('users_permissions')
    ->join('users', 'users.id', '=', 'users_permissions.user_id')
    ->join('roles', 'roles.id', '=', 'users_permissions.role_id')
    ->select('users.name', 'users_permissions.*','roles.role_name')
    ->get();
    
    //get all roles
    $roles = DB::table('roles')->get();

     return view('HR.roles',compact(['roles','users','users_permissions']));
  }

  public function add_role(Request $request){
        
    //add new role
    $role_name = array(); 
    $role_name['role_name']=$request->role_name;
    $insert_role = DB::table('roles')->insertGetId($role_name);

    $role_id = $insert_role;

    $modules_access = array();

    //all modules
    $modules = (['home','clients','search','case_manage','tasks','reports','notis','mails','HR','setting','add_client','add_file','add_main_case','add_case']);


    //insert module access from request
    for ($i=1; $i < 15 ; $i++) { 
        $modules_access[] = $request->$i;
    }
  
   $permission_insert = array();

   //add permission from $modules_access
   for ($i=0; $i < 14 ; $i++) { 
    $permission_insert['role_id']= $role_id;
    $permission_insert['module_name']=  $modules[$i];
    $permission_insert['access']=  $modules_access[$i];
    $insert_role = DB::table('permissions')->insert($permission_insert);
   }
  
  
   return redirect()->back()->with('success','تم اضافة صلاحية بنجاح');

   }

   public function delete_role($role_id){

    //delete all users with this role
    $delete_users_role =  DB::table('users_permissions')
    ->where('role_id', $role_id)
    ->update(['role_id' => 0]);
  

    //delete role
    $delete_role =  DB::table('roles')
     ->where('id', $role_id)
     ->delete();

     //delete role permission
     $delete_permission =  DB::table('permissions')
     ->where('role_id', $role_id)
     ->delete();

   //check if role delete successfully
     if ($delete_permission && $delete_role && $delete_users_role) {
        return redirect()->back()->with('success','تم حذف الصلاحية بنجاح');
    }
   

    }

    //assign role to user
    public function add_user_permission(Request $req){

        $data = array();

        //get the user_id and role_id
        $data['user_id'] = $req->user_id;
        $data['role_id'] = $req->role_id;

        //delete if user_id has other role
        DB::table('users_permissions')
     ->where('user_id',$req->user_id)
     ->delete();
        
     //add new role to user
        $user_permission = DB::table('users_permissions')
        ->insert($data);


        return redirect()->back()->with('success','تم اضافة صلاحية للموظف بنجاح');
    }

    //leaves page
    public function leave(){

        //get all leaves
        $leaves = DB::table('leave')
        ->join('users', 'users.id', '=', 'leave.user_id')
        ->select('users.name', 'leave.*')
        ->get();

        //get all users
        $users = DB::table('users')->get();

        return view('HR.leave',compact(['leaves','users']));
    }
    
    //add new leave
    public function add_leave(Request $req){

        $data = array();

        //get all new leave information from request and store it into array
        $data['user_id'] = $req->user_id;
        $data['leave_status'] = $req->status;
        $data['leave_type'] = $req->type;
        $data['date_from'] = $req->from;
        $data['date_to'] = $req->to;
        $data['leave_subject'] = $req->subject;
        
        //insert leave info
        $insert_leave = DB::table('leave')
        ->insert($data);

        return redirect()->back()->with('success','تم اضافة اجازة بنجاح');
    }

    public function delete_leave($leave_id){

     //delete leave with id $leave_id
     $delete_leave =  DB::table('leave')
     ->where('leave_id', $leave_id)
     ->delete();

     //check if leave delete successfully
     if ($delete_leave) {
        return redirect()->back()->with('success','تم حذف اجازة بنجاح');

     }
    }

    //all activies
    public function activities(){

        //check the user role
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        //if user role admin (17) view all activites else view user's activiteis
        if ($user_role->role_id != 17 ) {
           
            $activities =  DB::table('activities')
        ->join('users', 'users.id', '=', 'activities.create_by')
        ->select('users.name AS user_create','activities.*')
        ->where('assign_to', auth()->user()->id)
        ->orWhere('assign_to', 0)
        ->orderBy('activities.id' , 'desc')
        ->paginate(150);
        }else{
          
            $activities =  DB::table('activities')
        ->Join('users', 'users.id', '=', 'activities.create_by')
        ->select('users.name AS user_create','activities.*')
        ->orderBy('activities.id' , 'desc')
        ->paginate(150);
        }
     
     
      
        return view('HR.activities',compact(['activities']));
       }

       //login and logout register
       public function login_register(){
          
        //get all users login registers
     
         $registers =  DB::table('login_register')
        ->join('users', 'users.id', '=', 'login_register.user_id')
        ->select('users.name AS user_name','login_register.*')
        ->orderBy('login_register.id' , 'desc')
        ->paginate(20);
     
        return view('HR.login-register',compact(['registers']));
       }
      
     
}
