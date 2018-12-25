<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\User;
use Auth;

class UsersController extends Controller
{
   public function __construct(){    
        $this->middleware('auth');
    }
    public function profile() {
       if(Auth::user()->role == 1 | Auth::user()->role == 2){
           if(Auth::user()->role == 5) $condition = "supervisor";                        
            else if(Auth::user()->role == 2) $condition = "admin";                        
            else if(Auth::user()->role == 1) $condition = "master_admin";
            else $condition = "user";
            
           $items = DB::table('menus')->where('active','=','1')
                                  ->where($condition,'=',1)
                                  ->where('link','!=','')
                                  ->where('link','!=','#')->orderby('sort','asc')->get();
           return view('admin/dashboard', compact('items'));
       }
       else{
        $months = DB::table('months')->get();
        return view('profile',  compact('months'));
       }
    }
    public function update_user(Request $request,User $user) {
         $user->update($request->all());
         if($request->password != ""){
             $user->password = bcrypt($request->password);        
            $user->save(); 
         } else {
             $user->password = $user->password;
             $user->save();
         }
         
        return back()->with('success','لقد تم تحديث بياناتك بنجاح');
    }
//    public function resetPw(Request $request) {
//        $email = $request->textSearch;
//        $user = DB::table('users')->where('email','=',$email)->first();
//        $newPw = date('hsi');
//        
//         //---------- Send Email ----------
//        $subject = "لقد طلبت تغير كلمة ";        
//        $message = "<html><body>"
//                . "<center> <h3>لقد تم اشتراكك فى البلسم بنجاح</h3> </center>"
//                . "</body></html>";
//        $to = $request->email;
//        $this->send_mail($to,$subject,$message);
//    }
}
