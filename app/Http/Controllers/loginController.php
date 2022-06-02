<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

class loginController extends Controller
{

    //check user credentials
    public function authenticate(Request $request){
        // Retrive Input
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            $disabled = DB::table('users')->where('id',auth()->user()->id)->first();
            
            //check if the user is disabled (deleted)
            if ($disabled->disabled == 1) {
                 return redirect('/')->with('error','الحساب معطل الرجاء التواصل مع الادمن');
            }
          
            $user_log = DB::table('login_register')->insert([
                'user_id' => auth()->user()->id,
                'login' =>\Carbon\Carbon::now('+4:00') 
            ]);
                
            //check the language
            if (empty(session()->get('lang'))) {
                Session::put('lang', 'ar');
                return redirect('/home');
            }else{
                return redirect('/home');
            }
               
           

           
        }
        // if failed login
        return redirect('login')->with('error','البريد الالكتروني او كلمة المرور غير صحيحة!');
    }

    //logout function
    public function logout(Request $request) {

        //add logout register date time
        $current_id = DB::table('login_register')
        ->orderByRaw('id DESC')
        ->where ('user_id', auth()->user()->id)
        ->first();

        if ($current_id) {
            DB::table('login_register')
            ->where('id',$current_id->id)
            ->update(['logout' =>\Carbon\Carbon::now('+4:00') ]);

            Auth::logout();

          

            // check language and destroy all sessions
            if (session()->get('lang') == 'ar') {
                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
                return redirect('/');
            }else{
                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
                return redirect('/login-en');
            }
     
        }else{
            $user_log = DB::table('login_register')->insert([
                'user_id' => auth()->user()->id,
                'login' =>\Carbon\Carbon::now('+4:00'), 
                'logout' =>\Carbon\Carbon::now('+4:00')
                ]);
                
            Auth::logout();

            if (session()->get('lang') == 'ar') {
                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
                return redirect('/');
            }else{
                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
                return redirect('/login-en');
            }
          
        }
     
  }
}
