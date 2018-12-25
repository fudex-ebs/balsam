<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\product;
use App\product_image;
use App\User;
use App\users_role;
use Illuminate\Support\Facades\Hash;
use App\slideshow;
use DB;
use App\Order;
use App\Article;
use App\Privilge;
use App\User_privilge;
use App\About;
use Auth;
use App\Adsemails;
use App\Adssms;
use App\Notification;
use App\Delivery_setting;
use App\Region;
use App\City;

class AdminController extends Controller
{
    public function __construct(){    
        $this->middleware('auth');
    }
    
    public function dashboard() {
         if(Auth::user()->role == 5) $condition = "supervisor";                        
            else if(Auth::user()->role == 2) $condition = "admin";                        
            else if(Auth::user()->role == 1) $condition = "master_admin";
            else $condition = "user";
            
        $items = DB::table('menus')->where('active','=','1')
                                  ->where($condition,'=',1)
                                  ->where('link','!=','')
                                  ->where('link','!=','#')->orderby('sort','asc')->get();
        return view('admin.dashboard',  compact('items'));
    }
    public function about() {
        $about = DB::table('abouts')->where('id','=','1')->first();
        return view('admin.about',  compact('about'));
    }
    public function updateAbout(Request $request,About $about) {         
        $about->update($request->all());                
        if( $request->hasFile('img')){
                $img_name = date('ishdmY').'.'.$request->file('img')->getClientOriginalExtension();
                $request->file('img')->move(base_path().'/public/uploads/',$img_name);        
                $about->img = $img_name;
                $about->save();
           }
        return redirect('admin/about');
    }
    public function categories() {
        $data = DB::table('categories as p')->get();
        $parents = DB::table('categories as p')->where('parent','=',0)->get();
        return view('admin.categories',  compact('data','parents'));
    }
    public function addCategory(Request $request) {
        $this->validate($request, [
           'title' => 'required|unique:categories|max:255',           
        ]);
        
        $category = new Category();
    
        if($request->parent) $parent = $request->parent; else $parent = 0;
        if($request->sub_parent) $sub_parent = $request->sub_parent; else $sub_parent = 0;
        
        $category->parent = $parent;
        $category->sub_parent = $sub_parent;
        $category->title = $request->title;        
        $category->active = $request->active;
        $category->sort = $request->sort;
        
        $category->save();
        return back()->with('success','تمت الاضافة بنجاح');
    }
    public function edit_category(Category $category) {
        $data = DB::table('categories')->where('parent','=',0)->get();
        return view('admin.category_edit',  compact('category','data'));
    }
    public function update_category(Request $request,  Category $category) {
        $category->update($request->all());
        return redirect('admin/categories');
    }
    public function delete_category(Category $category) {
        $category->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function add_product() {
//        $data = DB::table('products')->get();
        $categories = DB::table('categories')->where('parent','=','0')->get();
        return view('admin.product_add',  compact('categories'));
    }
    public function getCategories(Request $request) {
         $category = $request->input('category');               
         $subCats = DB::table('categories')->where('parent','=',$category)
                                            ->where('sub_parent','=',0)->orderby('title')->get();
         if($subCats){
             echo "<option value='0'>اختر تصنيف</option>";
             foreach ($subCats as $value) {
                 echo "<option value='".$value->id."'>".$value->title."</option>";
         }}
    }
    public function getSubParent(Request $request) {
        $parent = $request->input('parent');               
        $sub_parent = DB::table('categories')->where('parent','=',$parent)
                                             ->where('sub_parent','=',0)->orderby('title')->get();
        if($sub_parent){
             echo "<option value='0'>اختر تصنيف</option>";
             foreach ($sub_parent as $value) {
                 echo "<option value='".$value->id."'>".$value->title."</option>";
         }}
    }
    public function getSubCategory(Request $request) {
         $sub_category = $request->input('sub_category');               
         $sub_category2 = DB::table('categories')->where('sub_parent','=',$sub_category)->orderby('title')->get();
         if($sub_category2){
             echo "<option value='0'>اختر تصنيف</option>";
             foreach ($sub_category2 as $value) {
                 echo "<option value='".$value->id."'>".$value->title."</option>";
         }}
    }
    function addProduct(Request $request) {
        $this->validate($request, [
           'title' => 'required|unique:categories|max:255',
           'img' => 'required|mimes:jpeg,bmp,png,jpg,gif'
        ]);        
        $product = new product();                   
         //-----Save Image----
        $img_name = date('ishdmY').'.'.$request->file('img')->getClientOriginalExtension();
        $request->file('img')->move(base_path().'/public/uploads/',$img_name);
        
        if($request->category) $category = $request->category;
        if($request->sub_category) $sub_category = $request->sub_category; else $sub_category = 0;
        if($request->sub_category2) $sub_category2 = $request->sub_category2; else $sub_category2 = 0;
                
        $product->title = $request->title;
        $product->category = $category;
        $product->sub_category = $sub_category;
        $product->sub_category2 = $sub_category2;
        $product->code = $request->code;
        $product->img = $img_name;
        $product->price = $request->price;
        $product->description  = $request->description;
        $product->offer  = $request->offer;
        $product->offer_end  = $request->offer_end;
        $product->how_to_use = $request->how_to_use;
        $product->cautions = $request->cautions;
        $product->special = $request->special;
        $product->tax = $request->tax;
        
        $product->active = $request->active;
        $product->sort = $request->sort;
        $product->qty = $request->qty;
                
        //------------- Send notification --------------------
//         $postData = [];
//        // $id = $product;
//         $device_tokens = DB::table("device_tokens")->get();
//         $token_ids = [];
//         foreach($device_tokens as $device_token){
//             $token_ids[] = $device_token->token;
//         }
//         $other_data = array('id' => $product->id,'page'=>'product');
//         $token_ids2 = array_values($token_ids);
//         $postData['title'] = "منتج  جديد البلسم الطبى";
//         $postData['message'] = $request->title;
//         $postData['token_ids'] = json_encode($token_ids2);
//         $postData['other_data'] = json_encode($other_data);
//
//         $url = url("resources/fcm/run.php");
//         $this->getCurlContent($url, $postData);
        //------------- End Send notification --------------------
         
        $product->save();

        //---------- Upload images ------------
         if($request->hasFile('imgs')){
            $files = $request->file('imgs');
            if($files){
                foreach ($files as $file) {
                    $product_image = new product_image();
                   
                    $img_name = date('ishdmY').'_'.$file->getClientOriginalName();
                    $file->move(base_path().'/public/uploads/',$img_name);
                    
                    $product_image->product_id = $product->id;
                    $product_image->img = $img_name;
                    $product_image->save();
        }}}
        
        return back()->with('success','تمت الاضافة بنجاح');
    }
    public function all_products() {
        $data = product::with('category')->orderby('id','desc')->get();
//        $category = Category::find(4);
        return view('admin.products_all',  compact('data'));
    }
    public function edit_product(product $product) {
        $data = DB::table('products')->get();
        $categories = DB::table('categories')->where('parent','=',0)->get();               
        $product_imgs = DB::table('product_images')->where('product_id',$product->id)->get();
        $sub_category = DB::table('categories')->where('id','=',$product->sub_category)->first();
        $sub_category2 = DB::table('categories')->where('id','=',$product->sub_category2)->first();
        
        return view('admin.product_edit',  compact('product','data','categories','product_imgs','sub_category','sub_category2'));
    }
    public function update_product(Request $request,Product $product) {         
        $product->update($request->all());  
        if($request->offer != 0){
            //------------- Send notification --------------------
             $postData = [];        
             $device_tokens = DB::table("device_tokens")->get();
             $token_ids = [];
             foreach($device_tokens as $device_token){
                 $token_ids[] = $device_token->token;
             }
             $other_data = array('id' => $product->id,'page'=>'offer');
             $token_ids2 = array_values($token_ids);
             $postData['title'] = "عرض جديد من البلسم الطبى";
             $postData['message'] = $product->title;
             $postData['token_ids'] = json_encode($token_ids2);
             $postData['other_data'] = json_encode($other_data);

             $url = url("resources/fcm/run.php");
             $this->getCurlContent($url, $postData);
            //------------- End Send notification --------------------
        }
        
        if( $request->hasFile('img')){
                $img_name = date('ishdmY').'.'.$request->file('img')->getClientOriginalExtension();
                $request->file('img')->move(base_path().'/public/uploads/',$img_name);        
                $product->img = $img_name;
                $product->save();
           }
//        return redirect('admin/all_products');
           return back()->with('success','تم التعديل  بنجاح');
    }
    public function delete_product(product $product) {
       unlink(public_path('uploads/'.$product->img));
       $product->delete();
       return back()->with('success','تم الحذف بنجاح');
   }
    public function upload_imgProduct(Request $request) {   
//        $this->validate($request, [                   
//           'img' => 'required|mimes:jpeg,bmp,png,jpg,gif'
//        ]);
        
        if($request->hasFile('img')){
            $files = $request->file('img');
            if($files){
                foreach ($files as $file) {
                    $product_image = new product_image();
                   
                    $img_name = date('ishdmY').'_'.$file->getClientOriginalName();
                    $file->move(base_path().'/public/uploads/',$img_name);
                    
                    $product_image->product_id = $request->product_id;
                    $product_image->img = $img_name;
                    $product_image->save();
        }}}
        
        return back()->with('success','تم الرفع بنجاح');
    }
    public function add_user() {
        $roles = DB::table('users_role')->get();
        return view('admin.user_add',  compact('roles'));
    }
    public function adduser(Request $request) {
        $this->validate($request, [
           'first_name' => 'required|max:255',
           'last_name' => 'required|max:255',
           'email' => 'required|email|unique:users|max:255',   
           'password' => 'required|confirmed|min:6|max:255',
            
        ]); 
        
       $user = new User();
       $user->first_name = $request->first_name;
       $user->last_name = $request->last_name;
       $user->password = bcrypt($request->password);
       $user->email = $request->email;
       $user->role = $request->role;
       $user->mobile = $request->mobile;
       $user->active = $request->active;
       $user->birth_date = $request->birth_date;
       $user->gender = $request->gender;
       
       $user->save();
       return back()->with('success','تم الاضافة بنجاح');
    }
    public function all_users() {
        $data = DB::table('users')->where('role','=',3)->orwhere('role','=',4)->get();
        $roles = DB::table('users_role')->where('active','1')->get();
        return view('admin.users_all',  compact('data','roles'));
    }
    public function supervisors() {
        $items = DB::table('users')->where('role','=',2)->orwhere('role','=',5)->get();
        $roles = DB::table('users_role')->where('active','1')->get();
        return view('admin/supervisors',  compact('items','roles'));
    }
    public function edit_user(User $myUser) {                 
        $roles = DB::table('users_role')->get();        
        return view('admin.user_edit',  compact('myUser','roles','user_prv'));
    }
    public function update_user(Request $request,User $myUser) {        
        $myUser->first_name = $request->first_name;
        $myUser->last_name = $request->last_name;
        $myUser->email = $request->email;
        $myUser->role = $request->role;
        $myUser->active = $request->active;
        $myUser->mobile = $request->mobile;
        $myUser->gender = $request->gender;
        $myUser->birth_date = $request->birth_date;
        
        
        if ( ! $request->password == '')        
            $myUser->password = bcrypt($request->password);        

        $myUser->save();                       
        return redirect('admin/users/all');
    }
    public function updateRole(User $myUser,Request $request) {
        $myUser->update($request->all());   
        return back()->with('success','تم التحديث بنجاح');
    }
    public function delete_user(User $myUser) {        
        $myUser->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
//    public function update_userPrv(User $myUser,Request $request) {        
////        $privilges = implode(",", $request->privilge_id);
//         $privilges = $request->privilge_id;
//         
//        $if_exists = DB::table('user_privilges')->where('user_id','=',$myUser->id)->first();
//        if(! $if_exists){
//            if($privilges){
//                foreach ($privilges as $value) {
//                    $user_privilge = new User_privilge();
//                    $user_privilge->user_id = $myUser->id;
//                    $user_privilge->privilge_id = $value;
//
//                    $user_privilge->save();
//            }} 
//        }else{
//            if($privilges){
//                foreach ($privilges as $value) {
//              DB::table('user_privilges')->where('user_id','=',$myUser->id)                     
//                     ->update(array('privilge_id' => $value));    
//            }}
//        }
//        return back()->with('success',"jjj");
//    }
    public function slideshow() {
        $data = DB::table('slideshows')->get();
        return view('admin.slideshow',  compact('data'));
    }
    public function add_slideshow(Request $request) {
         $this->validate($request, [                      
           'img' => 'required|mimes:jpeg,bmp,png,jpg,gif'
        ]);        
        $slideshow = new slideshow();            
       
         //-----Save Image----
        $img_name = date('ishdmY').'.'.$request->file('img')->getClientOriginalExtension();
        $request->file('img')->move(base_path().'/public/uploads/',$img_name);
        
        $slideshow->title1 = $request->title1;
        $slideshow->title2  = $request->title2;
        $slideshow->title3  = $request->title3;
        $slideshow->align  = $request->align;
        $slideshow->fade  = $request->fade;
        $slideshow->link  = $request->link;
        $slideshow->img = $img_name;        
        
        $slideshow->active = $request->active;
        $slideshow->sort = $request->sort;
        $slideshow->save();

        return back()->with('success','تمت الاضافة بنجاح');
    }
    
    public function delete_slideshow(slideshow $slideshow) {      
        unlink(public_path('uploads/'.$slideshow->img));
        $slideshow->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function edit_slideshow(slideshow $slideshow) {        
        return view('admin.slideshow_edit',  compact('slideshow'));
    }
    public function update_slideshow(Request $request, slideshow $slideshow) {        
       $slideshow->update($request->all());     
       
        if( $request->hasFile('img')){
            $this->validate($request, [                   
                'img' => 'required|mimes:jpeg,bmp,png,jpg,gif'
            ]);
                    
            $img_name = date('ishdmY').'.'.$request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(base_path().'/public/uploads/',$img_name);        
            $slideshow->img = $img_name;
            $slideshow->save();
        }                 
        return redirect('admin/slideshow');
    }
    public function orders() {
        $data = DB::table('order_status as s')                                        
                    ->join('orders as order','order.status','=','s.id')
                    ->join('users as user','user.id','=','order.user_id')                    
                    ->groupby('order.id')                
                    ->get(['order.*','s.*','user.*','order.id as OID']);
        return view('admin.orders',  compact('data'));
    }
    public function order(Order $order) {  
        $data = DB::table('products as product')
                    ->join('carts as cart','cart.product_id','=','product.id')                    
                    ->where('order_id','=',$order->id)
                    ->get();
        $order_status = DB::table('order_status')->where('active','=','1')->get();
        return view('admin.order',  compact('order','data','order_status'));
    }
    public function editOrderStatus(Order $order,Request $request) {
        $order->status = $request->status;
        $order->update($request->all());
        
        $status = DB::table('orders as order')
                    ->join('order_status as os','order.status','=','os.id')
                    ->where('order.id','=',$order->id)->first();
        
        $user = DB::table('users')                    
                    ->where('id','=',$order->user_id)->first();
        
        $to = $user->email;
        $subject = " تغير حالة الطلب رقم  " . $order->id ;
        $message = "<html><body><center><h3>تم تغير حالة الطلب رقم ".$order->id.""
                . " الى   ".$status->title_ar."</h3></center></body></html>";
        $this->send_mail2($to,$subject,$message);
        
        $msg = "تم تسليم طلبكم بنجاح شكراً لاستخدامكم موقع صيدلية البلسم الطبي نسعد بخدمتكم ";
        if($order->status == 5) $this->sms($msg, $user->mobile);
        return back()->with('success','تم التعديل   بنجاح');
    }
    public function delete_order(Order $order) {
        $order->delete();
//        return back()->with('success','تم الحذف بنجاح');
        return redirect('admin/orders');
    }
    public function new_article() {
        return view('admin.article_add');
    }
    public function all_articles() {
        $data = DB::table('articles')->orderby('id','desc')->get();
        return view('admin.article_all',  compact('data'));
    }
    public function edit_article(Article $article) {        
        return view('admin.article_edit',  compact('article'));
    }
    public function update_article(Article $article,Request $request) {        
         $article->update($request->all());     
       
        if( $request->hasFile('img')){
            $this->validate($request, [                   
                'img' => 'required|mimes:jpeg,bmp,png,jpg,gif'
            ]);
                    
            $img_name = date('ishdmY').'.'.$request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(base_path().'/public/uploads/',$img_name);        
            $article->img = $img_name;
            $article->save();
        }                 
        return redirect('admin/all_articles');
    }
    public function addArticle(Request $request) {
        $this->validate($request, [
           'title' => 'required|unique:categories|max:255',
           'img' => 'required|mimes:jpeg,bmp,png,jpg,gif',
           'body'=> 'required'
        ]);        
        $article = new Article();            
       
         //-----Save Image----
        $img_name = date('ishdmY').'.'.$request->file('img')->getClientOriginalExtension();
        $request->file('img')->move(base_path().'/public/uploads/',$img_name);
        
        $article->title = $request->title;
        $article->img = $img_name;
        $article->body = $request->body;        
        $article->publish = $request->publish;
        $article->save();

        //------------- Send notification --------------------
         $postData = [];
        // $id = $product;
         $device_tokens = DB::table("device_tokens")->get();
         $token_ids = [];
         foreach($device_tokens as $device_token){
             $token_ids[] = $device_token->token;
         }
         $other_data = array('id' => $article->id,'page'=>'article');
         $token_ids2 = array_values($token_ids);
         $postData['title'] = "مقال جديد البلسم الطبى";
         $postData['message'] = $request->title;
         $postData['token_ids'] = json_encode($token_ids2);
         $postData['other_data'] = json_encode($other_data);

         $url = url("resources/fcm/run.php");
         $this->getCurlContent($url, $postData);
        //------------- End Send notification --------------------
        
        return back()->with('success','تمت الاضافة بنجاح');
    }
     private function getCurlContent($url, $postdata = false){
       // check if cURL installed or not in your system?
        if (!function_exists('curl_init')){
            return 'Sorry cURL is not installed!';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        if ($postdata)
        {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 ;Windows NT 6.1; WOW64; AppleWebKit/537.36 ;KHTML, like Gecko; Chrome/39.0.2171.95 Safari/537.36");
        $contents = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);
        return array($contents, $headers);
         
    }
      public function delete_article(Article $item) {        
        $item->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function notifications() {
        $data = DB::table('notifications')->orderby('id','desc')->get();
        return view('admin/notifications',  compact('data'));
    }
    public function sendNotification(Request $request) {
         $this->validate($request, [
           'title' => 'required|max:255',           
           'body' => 'required'
        ]);
         
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->body = $request->body;
        $notification->save();
        
        //------------- Send notification --------------------
        $postData = [];        
        $device_tokens = DB::table("device_tokens")->get();
        $token_ids = [];
        foreach($device_tokens as $device_token){
            $token_ids[] = $device_token->token;
        }
        $other_data = array('id' => $notification->id,'page'=>'notify');
        $token_ids2 = array_values($token_ids);
        $postData['title'] = $request->title;
        $postData['message'] = $notification->body;
        $postData['token_ids'] = json_encode($token_ids2);
        $postData['other_data'] = json_encode($other_data);

        $url = url("resources/fcm/run.php");
        $this->getCurlContent($url, $postData);
       //------------- End Send notification --------------------
             
        return back()->with('success','لقد تم ارسال رسالة التنبيه بنجاح');
    }
    public function deleteNotification(Notification $id) {
        $id->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function adsbymail() {
        $newsletters = DB::table('newsletters')->get();
        $userEmails = DB::table('users')->get();
        $data = DB::table('adsemails')->get();
        return view('admin/adsbymail',  compact('data','newsletters','userEmails'));
    }
    public function adsbysms() {
        $userMobiles = DB::table('users')->get();
        $data = DB::table('adssms')->get();
        return view('admin/adsbysms',  compact('data','userMobiles'));
    }
    public function sendAdsMail(Request $request) {
         $this->validate($request, [
           'title' => 'required|max:255',           
           'body' => 'required'
        ]);
         
        $subject = $request->title;
        $message = $request->body;
        $emails = DB::table('newsletters')->where('email','!=',NULL)->get();
        if($emails){
            foreach ($emails as $value) {
                $to = $value->email;
                $this->send_mail($to,$subject,$message);
        }}
        
        $adsEmail = new Adsemails();
        $adsEmail->title = $subject;
        $adsEmail->body = $message;
        $adsEmail->created_by = Auth::user()->id;
        $adsEmail->save();
        return back()->with('success','لقد تم ارسال بريد الكترونى الى القائمة البريدية بنجاح!');
    }
     public function sendAdsSms(Request $request) {
         $this->validate($request, [           
           'body' => 'required',
        ]);
                
        $message = $request->body;
        $mobiles = DB::table('users')->where('mobile','!=','')->get();
        if($mobiles){
            foreach ($mobiles as $value) {
                $to = $value->mobile;
                $this->sms($message, $to);
        }}
        
        $adsSms = new Adssms();     
        $adsSms->body = $message;
        $adsSms->save();
        return back()->with('success','لقد تم ارسال رسائل الجوال الى المستخدمين بنجاح!');
    }
    public function delete_email(AdsEmail $id) {
        $id->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function delete_sms(Adssms $id) {
        $id->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function tbl_actions(Request $request) {
        $tbl = 'App\\'.$request->tbl;        
        $select_rows = $request->select_rows;
        if($select_rows){
            foreach ($select_rows as $value) {
                 $row = $tbl::find($value);
                 $row->delete();
            }
        }
        return back()->with('success',"لقد تم الحذف بنجاح");
    }
    
    /***********************************************************************/
    public function delivery_settings() {        
        $data = DB::table('delivery_settings as d')
                    ->join('cities as c','c.id','=','d.city')                                        
                    ->get(['d.*','c.*','d.id as itmID']);
        
        $countries = DB::table('countries')->where('active','=',1)->get();
        $regions = DB::table('regions')->get();
        $cities = DB::table('cities')->get();
        
        return view('admin.delivery_settings',  compact('data','countries','regions','cities'));
    }
    public function addDelivery(Request $request) {
        $this->validate($request, [
           'country' => 'required',           
           'city' => 'required',           
           'price' => 'required',            
        ]);
        
        $if_exists = Delivery_setting::where('city','=',$request->city)->get();
        if(count($if_exists) < 1){
            $delivery = new Delivery_setting();

            $delivery->country = $request->country;
            $delivery->region = $request->region;
            $delivery->city = $request->city;
            $delivery->price = $request->price;        
            $delivery->active = $request->active;        

            $delivery->save();
            return back()->with('success','تمت الاضافة بنجاح');
        }else
            return back()->with('failed','هذه البلد مضاف ليها سعر شحن بالفعل');
    }
    public function edit_delivery(Delivery_setting $item) {
        $countries = DB::table('countries')->where('active','=',1)->get();  
        $regis = DB::table('regions')->where('country_id','=',$item->country)->where('active','=',1)->get();  
        $cits = DB::table('cities')->where('region_id','=',$item->region)->where('active','=',1)->get();        
        return view('admin.delivery_edit',  compact('countries','item','regis','cits'));
    }
    public function update_delivery(Request $request, Delivery_setting $item) {
        $item->update($request->all());
        return redirect('admin/delivery_settings');
    }
    public function delete_delivery(Delivery_setting $item) {
        $item->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function getCities(Request $request) {
         $region = $request->input('region');               
         $cities = DB::table('cities')->where('region_id','=',$region)
                                            ->where('active','=',1)->orderby('title_ar')->get();
         if($cities){
             echo "<option value='0'>اختر مدينة</option>";
             foreach ($cities as $value) {
                 echo "<option value='".$value->id."'>".$value->title_ar."</option>";
         }}
    }
    public function addRegion(Request $request) {
        $this->validate($request, [
           'region' => 'required',                                
        ]);
        
        $if_exists = Region::where('title_ar','=',$request->region)->get();
        if(count($if_exists) < 1){
            $region = new Region();

            $region->country_id = $request->country_id;
            $region->title_ar = $request->region;              
            $region->active = $request->active;        

            $region->save();
            return back()->with('success','تمت الاضافة بنجاح');
        }else
            return back()->with('failed','هذه المنطقة مضافة بالفعل!');
    }
    
      public function addCity(Request $request) {
        $this->validate($request, [
           'title_ar' => 'required',                                
        ]);
        
        $if_exists = City::where('title_ar','=',$request->region)->get();
        if(count($if_exists) < 1){
            $city = new City();
            
            $city->region_id = $request->region_id;              
            $city->title_ar = $request->title_ar;              
            $city->active = $request->active;        

            $city->save();
            return back()->with('success','تمت الاضافة بنجاح');
        }else
            return back()->with('failed','هذه المدينة  مضافة بالفعل!');
    }
    public function delete_region(Region $item) {
        $item->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    public function delete_city(City $item) {
        $item->delete();
        return back()->with('success','تم الحذف بنجاح');
    }
    /************************************************************************/
    public function exportToPdf(Request $request) {
        $order_no = $request->id;
        $logo_src = asset('public/asset/img/logo.png');
        $style_pdf = url('public/asset/css/pdf.css');
        
        $order = DB::table('orders as order')
                ->where('order.id','=',$order_no)->first();
        $user = DB::table('users')->where('id','=',$order->user_id)->first();
        $data = DB::table('products as product')
                    ->join('carts as cart','cart.product_id','=','product.id')                    
                    ->where('order_id','=',$order->id)
                    ->get();
        
        $html = "<html><body><style>body{direction:rtl;}table td{padding:5px;} table{border-collapse: collapse;"
                . "width:100%;border:1px solid #DCDCDC;"
                . "padding:5px;}tr:nth-child(even){background-color: #f2f2f2}"
                . ".f-right{float:right;}.headTxt{text-align:center;font-weight:bold;font-size:17px;}.grn{color:#7cbc46;}"
                . "</style><head></head>";
        $html .= "<div class='headTxt grn'><u>موقع البلسم الطبى</u></div>"
                . "<div class='f-right'><h3 class='grn'><b>رقم الطلب : </b>".$order_no."</h3>"
                .date('Y-m-d h-s-i'). "<br/><br/></div>"
                . "<table><tr><td>الاسم الأول</td><td>".$user->first_name ."</td>"
                . "<td>الاسم الأخير</td><td>".$user->last_name."</td></tr>"
                . "<tr><td>البريد الالكترونى</td><td><a href='mailto:".$user->email."'>".$user->email."</a></td>"
                . "<td>الجوال</td><td>".$user->mobile."</td></tr>"
                . "</table><br/><br/> <h3 class='grn'><u>تفاصيل الطلب (المنتجات)</u></h3>"
                . "<table style='text-align:center;'><tr><th>كود المنتج</th><th>اسم المنتج</th><th>الكمية</th><th>سعر الوحدة</th>"
                . "<th>سعر الكمية</th></tr>";
              if($data){
                  foreach ($data as $value) {
                      $html .= "<tr><td>".$value->code."</td>"
                              . "<td>".$value->title."</td>"
                              . "<td>".$value->qty."</td>"
                              . "<td>".$value->price." ريال</td>"
                              . "<td>".$value->price*$value->qty." ريال</td></tr>";
                  }
              }  
        $html .= "<tr><th colspan='3'>الاجمالى</th><th colspan='2'>".$order->total." ريال</th></tr>";
        $html .= "</table>";
        $html .= "</body></html>";
        $this->toPdf($html);
    }
}
