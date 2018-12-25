<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\product;
use App\Category;
use App\Contact;
use Illuminate\Support\Facades\Session;

class MyController extends Controller
{
    //
    public function login() {
        return view('auth.login');
    }
    public function products() {
        $items = DB::table('products')->paginate(20);
        return view('products',  compact('items'));
    }
    public function offers() {
        $items = DB::table('products')->where('offer','!=','0')->paginate(20);
        return view('offers',  compact('items'));
    }
    public function most_ordered() {
        $items =  DB::table('carts as cart')
                    ->join('products as product','cart.product_id','=','product.id')                    
                    ->groupby('product.id')                       
                    ->paginate(20);
        return view('most_ordered',  compact('items'));
    }
    public function product(product $item) {  
        $images = DB::table('product_images')->where('product_id',$item->id)->get();
        $similar = DB::table('products')->where('category',$item->category)->orderby('id','desc')->limit(20)->offset(0)->get();
        $parent = DB::table('categories')->where('id','=',$item->category)->first();
        $sub_ctegory = DB::table('categories')->where('id','=',$item->sub_category)->first();
        
        return view('product',  compact('item','images','similar','parent','sub_ctegory'));
    }
    public function category(Category $category) {               
        $items = DB::table('products')->where('category',$category->id)->orderby('id','desc')->paginate(20);
        return view('category',  compact('items','category'));
    }
    public function subcategory(Category $subcategory) {        
        $items = DB::table('products')->where('sub_category',$subcategory->id)               
                ->orwhere('sub_category2',$subcategory->id)  
                ->where('active','=',1)
                ->orderby('id','desc')->paginate(20);
        $parent = DB::table('categories')->where('id','=',$subcategory->parent)->first();
        
        $subcategory1 = DB::table('categories')->where('parent','=',$parent->id)->where('sub_parent','=',0)->first();
        $subcategory2 = DB::table('categories')->where('id','=',$subcategory->id)->first();
        
        return view('subcategory',  compact('subcategory','items','parent','subcategory1','subcategory2'));
    }
    public function contact() {
        $map = DB::table('site_settings')->where('keyword','=','map')->first();
        $contact_text = DB::table('site_settings')->where('keyword','=','contact_text')->first();
        
        return view('contact',  compact('map','contact_text'));
    }
     public function about() {
         $about = DB::table('abouts')->where('id','=','1')->first();
        return view('about',  compact('about'));
    }
    public function contact_us(Request $request) {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->mobile = $request->mobile;
        $contact->message = $request->message;
        $contact->save();
        return back()->with('success','لقد تم ارسال رسالتك بنجاح');
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
}
