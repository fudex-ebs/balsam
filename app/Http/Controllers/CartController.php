<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cart;
use DB;
use App\User;
use App\Order;
use Auth;
use App\Favourite;
use App\Addresse;
use App\product;
use App\Delivery_setting;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cart() {  
        $cartItms = Session::get('cart');       
        return view('cart', compact('cartItms'));
    }
    public function add_tocart(Request $request) {
        $prod_id = $request->input('prod_id');               
        $user_id = $request->input('user_id');  
        $quantity = $request->input('quantity');
        $user_ip = $request->ip();
//        $session_id = Session::getId();
         
        $newItm = ['product_id'=> $prod_id,'user_id' => $user_id ,'qty'=>$quantity , 'user_ip'=>$user_ip];
        Session::push('cart',$newItm);
        $val = count(Session::get('cart'));
        echo json_encode($val, JSON_UNESCAPED_UNICODE  | JSON_PRETTY_PRINT);
        
//        $if_exists = DB::table("carts")->where('product_id','=',$prod_id)
//                    ->where('bought','=',0)
//                    ->where('user_ip','=',$user_ip)->first(); 
//        
//        if( $if_exists ){
//             DB::table('carts')->where('bought','=','0')
//                     ->where('product_id','=',$prod_id)
//                     ->where('user_ip','=',$user_ip)
//                     ->update(array('qty' => $if_exists->qty+1)); 
//        }else{
//            $cart = new Cart();
//
//            $cart->user_id = $user_id;
//            $cart->user_ip = $user_ip;
//            $cart->product_id = $prod_id;
//            $cart->qty = $quantity;
//            $cart->bought = 0;
//            $cart->order_id = 0;
//            $cart->save();
//        }
//        $items = DB::table('carts')->where('bought','=','0')->where('user_id','=',$user_id)->get();
////        $items = count($items);
////        if($items>0 ) echo $items; else echo 0;  
//        
//        echo json_encode($items, JSON_UNESCAPED_UNICODE  | JSON_PRETTY_PRINT);
    }
    public function append_cart_items(Product $prod_id) {
        $last_item_cart = DB::table('carts')->orderBy('id','desc')->first();
        
        $item = DB::table('products as product')
//                    ->join('carts as cart','cart.product_id','=','product.id')                    
//                    ->where('cart.id','=',$last_item_cart->id)
                    ->where('product.id','=',$prod_id->id)
                    ->first();        
        $cart = Session::get('cart');
        $last_id = count($cart)-1; 
                
        $itm_url = url('product/'.$prod_id->id);   
        echo '<div class="product"><div class="hidden">  </div>
                        <figure class="product-image-container">
                            <a href="'.$itm_url.'" class="product-image">
                                <img src="'.asset('uploads').'/'.$item->img.'" alt="'.$item->title.'">
                            </a>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-title"><a href="'.$itm_url.'">'.$item->title.'</a></h4>                            
                            <span class="cart-product-info">
                                <span class="cart-product-qty">1</span>
                                 <span class="singlePrice">'.$item->price.'</span>  ريال
                                <span>سعر الكمية : <span class="prdsPrice">'.$item->price.'</span> ريال</span>
                            </span>
                        </div><!-- End .product-details -->
                        <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                        <input type="hidden" value="'.$last_id.'" />
        </div>';
         
    }
    public function removeFromCart($id,Request $request) { 
         $items =Session::get('cart');
         $cart_id = $request->input('id');  
         unset($items[$cart_id]);            
         $items =Session::set('cart',$items);
         $items = count(Session::get('cart'));
//            $user_id = $request->input('user_id');  
//            $cart = Cart::findOrFail( $cart_id );
//            $cart->delete( $request->all() );   
//            
//            $items = DB::table('carts')->where('bought','=','0')->where('user_id','=',$user_id)->get();
            echo json_encode($items, JSON_UNESCAPED_UNICODE  | JSON_PRETTY_PRINT);
    }
    public function cartTotalPrice() {
            $user_id = $request->input('user_id');             
            $items = DB::table('carts')->where('bought','=','0')->where('user_id','=',$user_id)->get();
           
            echo json_encode($items, JSON_UNESCAPED_UNICODE  | JSON_PRETTY_PRINT);
    }
    public function chooseAddress() {
        $cartItms = Session::get('cart');       
        $countries = DB::table('countries')->where('active','=',1)->get();
        $userAddress = DB::table('addresses as add')->where('user_id','=',Auth::user()->id)
                    ->join('countries as cntry','add.country','=','cntry.id')
                    ->join('cities as cty','add.city','=','cty.id')
                    ->get(['add.*','cntry.*','add.id as AddID','cty.title_ar as city_ar','cty.id as cityID']);
        return view('chooseAddress',  compact('userAddress','countries','cartItms'));
    }
    public function getDeliveryCost(Request $request) {
         $address = $request->input('address');   
         $getCity = Addresse::where('id','=',$address)->first();
         $delCost = Delivery_setting::where('city','=',$getCity->city)->first();
         if($delCost) $cost = $delCost->price; else $cost = 0;
         echo $cost;
    }
    public function makeOrder(Request $request) {    
        $cart_session = Session::get('cart');
        if($cart_session){
            foreach ($cart_session as $value) {
                $cartI = new Cart();
                $cartI->user_id = Auth::user()->id;
                $cartI->user_ip = $value['user_ip'];
                $cartI->product_id = $value['product_id'];
                $cartI->qty = $value['qty'];
                $cartI->bought = 0;
                $cartI->order_id = 0;
                $cartI->save();
            }
        }
        $total = 0;
        $my_items = DB::table('products as product')
                    ->join('carts as cart','cart.product_id','=','product.id')                    
                    ->where('user_id','=',Auth::user()->id)->where('bought','=','0')                    
                    ->get();
        if($my_items){
            foreach ($my_items as $value) {
                $percentage = (5 / 100) * $value->price ;
                $priceWzPercentage = $percentage+$value->price;
                $total += $priceWzPercentage * $value->qty;
            }
        }      
        $address = Addresse::where('id','=',$request->address)->first();        
        $cityID = $address->city;
        $cityDelivery = Delivery_setting::where('city','=',$cityID)->first();
        if($cityDelivery)
            $total = $total + $cityDelivery->price;        
        
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total = $total;
        $order->status = 1;                
        $order->address = $request->address;
        $order->save();
        
        $my_order = DB::table("orders")->orderBy('id','desc')->first();       
        //-- Update Cart by order id --
        DB::table('carts')->where('bought', '=', 0)->where('user_id','=',Auth::user()->id)
                ->update(array('order_id' => $my_order->id,'bought'=>1));  
        
        $orderItems = DB::table('orders as order')->where('order.id','=',$my_order->id)
                        ->join('carts as cart','cart.order_id','=','order.id')
                        ->join('products as prod','prod.id','=','cart.product_id')
                        ->get(['order.*','cart.*','prod.*','order.id as OID','prod.id as PID']);
        $trackLnk = url('/track/'.$my_order->id);
        
         Session::forget('cart');
        //---------- Send Email ----------
        $from = DB::table('site_settings')->where('keyword','=','email')->first();
        if($from) $from = $from->value; else $from = "info@fudex.com.sa";
        
        $subject = "طلبية جديدة رقم ". $my_order->id;        
        $message = "<html><body>"
                . "<center> <h3>لقد قمت بطلب طلبية جديدة برقم  ".$my_order->id."</h3> </center>"
                . "<br/> <table> <tr><td colspan='2'>معلومات الطلب </td></tr>"
                . "<tr> <td>المبلغ اجمالى  </td><td>".$my_order->total." ريال </td></tr>"
                . "<tr>حالة الطلب<td>تم ارسال الطلب</td></tr></table> <br/> <table>"
                . "<tr><td> صورة المنتج </td>"
                . "<td> اسم المنتج </td>"
                . "<td> سعر المنتج</td>"
                . "<td>الكمية</td></tr>";
                if($orderItems){
                    foreach ($orderItems as $value) {                        
                        $message .= "<tr><td><img src='{{url('uploads')}}/".$value->img."' /></td>"
                                . "<td>".$value->title."</td>"
                                . "<td>".$value->price."</td>"
                                . "<td>".$value->qty."</td></tr>";      
                }}
                $message .= "</table><hr/>"
                        . "<h3> يمكنك متابعة الطلب عبر الرابط التالى   <a href='".$trackLnk."'>".$trackLnk."</a> </h3>"
                        . "</body></html>";
        $to = Auth::user()->email;      
        $this->send_mail2($to,$subject,$message);
        //------------- Send SMS -----------------
        $toMobile = "966532201767,".Auth::user()->mobile;        
        $sms = "طلب جديد من موقع البلسم برقم ".$my_order->id ." - تكلفة الطلب الاجمالى ".$my_order->total. " ريال ".
                " يمكنك متابعة الطلب عبر <a href='".$trackLnk."'> الرابط </a> ";
        $this->sms($sms,$toMobile);
        return view('success',  compact('my_order','orderItems'));
    }
    
    public function track(Order $order) {
         $my_items = DB::table('products as product')
                    ->join('carts as cart','cart.product_id','=','product.id')                    
                    ->where('order_id','=',$order->id)                    
                    ->get();
         $all_status = DB::table('order_status')->get();
        return view('track',  compact('order','my_items','all_status'));
    }
    public function shipping() {
        return view('shipping');
    }
    public function order(Order $order) {
        $this->middleware('auth');
        $data = DB::table('products as product')
                    ->join('carts as cart','cart.product_id','=','product.id')                    
                    ->where('order_id','=',$order->id)
                    ->get();
        $order_status = DB::table('order_status')->where('active','=','1')->get();
        return view('order',  compact('order','data','order_status'));
    }
    
     public function add_tofav(Request $request) {
        $prod_id = $request->input('prod_id');                               
        $user_id = $request->input('user_id');                  
        $favourite = new Favourite();
        $favourite->user_id = $user_id;
        $favourite->user_ip = $request->ip();
        $favourite->product_id = $prod_id;        

        $items = DB::table('favourites')->where('user_id','=',$user_id)->get();
        $items = count($items);
        if( $favourite->save()) echo $items; else echo 0;         
    }
    public function favourite() {
        return view('favourite');
    }
     public function removeFromFav($id,Request $request) {
            $fav_id = $request->input('id');               
            $fav = Favourite::findOrFail( $fav_id );
            $fav->delete( $request->all() );      
    }
    public function follow_order() {
        return view('follow_order');
    }
    public function addresses() {
        $countries = DB::table('countries')->where('active',1)->get();
        $my_address = DB::table('addresses as add')->where('user_id','=',Auth::user()->id)
                ->join('countries as cntry','add.country','=','cntry.id')
                ->join('cities as cty','add.city','=','cty.id')
                ->get(['add.*','cntry.*','add.id as AddID','cty.title_ar as city_ar']);
        
        return view('addresses',  compact('countries','my_address'));
    }
    public function getRegions(Request $request) {
         $country = $request->input('country');          
         $regions = DB::table('regions')->where('country_id','=',$country)
                                            ->where('active','=',1)->orderby('title_ar')->get();
         if($regions){
             echo "<option value='0'>اختر منطقة</option>";
             foreach ($regions as $value) {
                 echo "<option value='".$value->id."'>".$value->title_ar."</option>";
         }}
    }   
    public function addAddress(Request $request) {
        $this->validate($request, [
           'country' => 'required',
           'city' => 'required',
           'postal' => 'required', 
           'street' => 'required',
        ]); 
        
        $address = new Addresse();
        $address->user_id = Auth::user()->id;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->postal = $request->postal;
        $address->street = $request->street;
        
        $address->save();
        return back()->with('success','لقد تم اضافة عنوان شحن بنجاح');
    }
    public function cancelOrder(Order $item) {        
        if($item->status <= 2){
            $item->active = 0;
            $item->save();
            return back()->with('success','لقد تم الغاء الطلب بنجاح');
        }else return back()->with('success','مسموح بالغاء الطلب فى المرحلتين الاولى والثانية فقط!');
    }
}
