<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;
use App\Article;
use App\Complaints;
use App\Newsletter;
require (__DIR__.'/../../Libraries/mobiledetectphp/Mobile_Detect.php');
use Mobile_Detect; 

use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {                    
         $detect = new Mobile_Detect();
         if ( $detect->isMobile() ) {
                return redirect(url('mobile/www/'));   
         }
         
        $last_item = DB::table("slideshows")->orderBy('sort','asc')->first();
        $items = DB::table("slideshows")->where('id' , '!=' ,$last_item->id)->orderBy('sort','asc')->get();
        
        $products = DB::table("products")->orderby('id','desc')->limit(10)->offset(0)->get();
        $offers = DB::table("products")->where('offer','!=' ,'0')->orderby('id','desc')->limit(20)->offset(0)->get();       
        $special_products = DB::table("products")->where('special','=' ,'1')->orderby('id','desc')->limit(20)->offset(0)->get();
        
        $most_ordered = DB::table('carts as cart')
                    ->join('products as product','cart.product_id','=','product.id')                    
                    ->groupby('product.id')   
                    ->limit(20)
                    ->get();
        
        $articles = DB::table('articles')->where('publish','=','1')->orderby('id','desc')->limit(6)->get();
        return view('home',  compact('last_item','items','products','offers','most_ordered','articles','special_products'));
    }
    public function search(Request $request) {        
        $textSearch = $request->textSearch;
        $data = DB::table('products')
                 ->where('active','=',1)
                ->where('title','LIKE','%'.$textSearch.'%')
                                     ->orwhere('code','=',$textSearch)
               
                ->get();
        return view('search',  compact('data'));
    }
    public function articles() {
        $articles = DB::table('articles')->where('publish','=','1')->orderby('id','desc')->get();
        return view('articles',  compact('articles'));
    }
    public function article(Article $article) {
        return view('article',  compact('article'));
    }
    public function register() {
        $months = DB::table('months')->get();
        return view('register',  compact('months'));
    }
    public function signup(Request $request) {         
         $this->validate($request, [
           'first_name' => 'required|max:255',
           'last_name' => 'required|max:255',
           'email' => 'required|unique:users|max:255',
           'password' => 'required|min:3|max:255',
           'confirm_password' => 'required|min:3|max:255',           
        ]);        
        $user = new User();            
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->birth_date = $request->year."-".$request->month."-".$request->day;
        $user->gender = $request->gender;
        $user->role = 3;
        $user->address = $request->address;
        $user->save();
       
        //---------- Send Email ----------
        $subject = "لقد تسجيل اشتراكك فى البلسم بنجاح";        
        $message = "<html><body>"
                . "<center> <h3>لقد تم اشتراكك فى البلسم بنجاح</h3> </center>"
                . "</body></html>";
        $to = $request->email;
        $this->send_mail($to,$subject,$message);
        
//        $curnt_user = DB::table("users")->orderBy('id','desc')->first();       
        Auth::loginUsingId($user->id);
        return redirect('profile')->with('success','لقد تم تسجيل اشتراك بنجاح');
    }
    function profile() {
        $months = DB::table('months')->get();
        return view('profile',  compact('months'));
    }
    function complaints() {
        return view('complaints');
    } 
    function send_complaint(Request $request) {
        $complaint = new Complaints();
        
        $complaint->name = $request->name;
        $complaint->email = $request->email;
        $complaint->subject = $request->subject;
        $complaint->mobile = $request->mobile;
        $complaint->message = $request->message;
        $complaint->save();
        return back()->with('success','لقد تم ارسال رسالتك بنجاح');   
    }
    public function newsletter(Request $request) {        
        $newsletter = new Newsletter();
        $newsletter->email = $request->emailNewsLetter;
        $newsletter->save();
        
        return back()->with('success','لقد تم اشتراكك فى القائمة البريدية بنجاح');
    }
}
