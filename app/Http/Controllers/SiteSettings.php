<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\site_setting;
use App\Social_links;
use DB;


class SiteSettings extends Controller
{
     public function __construct(){    
        $this->middleware('auth');
    }
    public function site_settings() {
        $data = DB::table('site_settings')->get();
        return view('admin.site_settings',  compact('data'));
    }
    public function add_setting(Request $request) {
        $this->validate($request, [
           'keyword' => 'required|unique:site_settings|max:255',
           'value' => 'required|unique:site_settings|max:255',           
        ]);
        
        $setting = new site_setting();    
        $setting->keyword = $request->keyword;
        $setting->value = $request->value;
        
        $setting->save();
        return back()->with('success','Item created successfully!');
    }
    public function delete_setting(site_setting $setting) {           
        $setting->delete();
        return back()->with('success','Item Deleted successfully!');
    }
    public function edit_setting(Request $request,site_setting $setting) {
         return view('admin.site_setting_edit',  compact('setting'));
    }
    public function update_setting(Request $request,  site_setting $setting) {
        $setting->update($request->all());                                    
        return redirect('admin/site_settings');
    }
    public function social_links() {
        $data = DB::table('social_links')->get();
        return view('admin.social_links',  compact('data'));
    }
    public function add_social(Request $request) {
        $this->validate($request, [
           'site' => 'required|unique:social_links|max:255',
           'value' => 'required|unique:social_links|max:255',           
        ]);
        
        $social = new Social_links();
        $social->site = $request->site;
        $social->value = $request->value;
        $social->active = $request->active;
        $social->sort = $request->sort;
        
        $social->save();
        return back()->with('success','Item created successfully!');
    }
    public function delete_social(Social_links $social) {           
        $social->delete();
        return back()->with('success','Item Deleted successfully!');
    }
    public function edit_social(Request $request,  Social_links $social) {
         return view('admin.social_links_edit',  compact('social'));
    }
    public function update_social(Request $request,  Social_links $social) {
        $social->update($request->all());                                    
        return redirect('admin/social_links');
    }
}
