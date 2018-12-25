<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        view()->composer('master', function($view) {
//            $menu_cat =  DB::table('categories')->get();
//            $view->with('data', array('menu_cat' => $menu_cat));
//          });
        
         view()->composer('*',function($view) {
             $view->with('address',DB::table('site_settings')->where('keyword','=','address')->first());
            $view->with('mobile',DB::table('site_settings')->where('keyword','=','phone')->first());
            $view->with('fax',DB::table('site_settings')->where('keyword','=','fax')->first());
            $view->with('email',DB::table('site_settings')->where('keyword','=','email')->first());
            
            $view->with('socialLinks',DB::table('social_links')->where('active','=','1')->get());
                
//            $view->with('user', Auth::user());  
            
            if(Auth::user()){
            if(Auth::user()->role == 5) $condition = "supervisor";                        
            else if(Auth::user()->role == 2) $condition = "admin";                        
            else if(Auth::user()->role == 1) $condition = "master_admin";
            else $condition = "user";
            
            
            $view->with('adminMenu',DB::table('menus')->where('active','=','1')
                                  ->where($condition,'=',1)
                                  ->where('parent','=',0)->orderby('sort','asc')->get());
            
            $view->with('adminMenuSub',DB::table('menus')->where('active','=','1')
                                  ->where($condition,'=',1)
                                  ->where('parent','!=',0)->orderby('sort','asc')->get());
            }
            $view->with('cats',DB::table('categories')->where('active','=','1')
                                                      ->where('parent','=',0)->get());
            
            $view->with('subCats',DB::table('categories')->where('active','=','1')
                                                        ->where('parent','!=','0')  
                                                        ->orderby('sub_parent','asc')
                                                        ->get());
            
            $view->with('subSubCats',DB::table('categories')->where('active','=','1')
                                                        ->where('sub_parent','!=','0')  
                                                        ->orderby('sub_parent','asc')
                                                        ->get());
            
             
            if(Auth::user()) $user_id = Auth::user()->id; else $user_id =0;            
//            $view->with('cart',DB::table('carts')->where('user_id','=',$user_id)->where('bought','=','0')->get());
            $view->with('cart',Session::get('cart'));
            
            $view->with('favs',DB::table('favourites')->where('user_id','=',$user_id)->get());
            
            $view->with('cart_items',DB::table('products as product')
                    ->join('carts as cart','cart.product_id','=','product.id')                    
                    ->where('user_id','=',$user_id)->where('bought','=','0')
//                    ->limit(4)
                    ->get(['product.*','cart.*','product.id as prod_id']));
                    
             $view->with('fav_items',DB::table('products as product')
                    ->join('favourites as fav','fav.product_id','=','product.id')                    
                    ->where('user_id','=',$user_id)
                    ->get(['fav.*','product.*','product.id as prod_id','fav.id as favID']));
             
            $view->with('most_ordered',DB::table('carts as cart')
                    ->join('products as product','cart.product_id','=','product.id')                    
                    ->groupby('product.id')  
                    ->limit(20)
                    ->orderby('product.id','desc')
                    ->get());
            $view->with('last_prod', DB::table("products")->orderBy('id','desc')->first());
//            $view->with('active_user','profile');
            
            $view->with('myOrders',DB::table('order_status as s')                                        
                    ->join('orders as order','order.status','=','s.id')
                    ->join('users as user','user.id','=','order.user_id') 
                    ->where('order.user_id','=',$user_id)
                    ->groupby('order.id')                
                    ->get(['order.*','s.*','user.*','order.id as OID']));
            
             $view->with('ordersNotDelivered',DB::table('order_status as s')                                        
                    ->join('orders as order','order.status','=','s.id')
                    ->join('users as user','user.id','=','order.user_id') 
                    ->where('order.user_id','=',$user_id)
                    ->where('order.status','!=','5')
                    ->where('order.active','=','1')
                    ->groupby('order.id') 
                    ->orderby('order.id','desc')
                    ->get(['order.*','s.*','user.*','order.id as OID','order.created_at as createdTime'
                        ,'order.updated_at as updatedTime']));
             
              $view->with('ordersDelivered',DB::table('order_status as s')                                        
                    ->join('orders as order','order.status','=','s.id')
                    ->join('users as user','user.id','=','order.user_id') 
                    ->where('order.user_id','=',$user_id)
                    ->where('order.status','=','5')
                    ->where('order.active','=','1')
                    ->groupby('order.id')      
                    ->orderby('order.id','desc')
                    ->get(['order.*','s.*','user.*','order.id as OID']));
             
            $view->with('pending_orders',DB::table('order_status as s')                                        
                    ->join('orders as order','order.status','=','s.id')
                    ->where('order.status','=','1')
                    ->where('order.active','=','1')
                    ->join('users as user','user.id','=','order.user_id')                    
                    ->groupby('order.id')
                     ->orderby('order.id','desc')
                    ->get(['order.*','s.*','user.*','order.id as OID']));
            $view->with('latest_articles',DB::table('articles')
                        ->where('publish','=','1')
                        ->orderby('id','desc')
                        ->limit(5)
                        ->get()
                    );
         });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
