@extends('master', ['title'=>'تعديل بياناتى','active'=>'home'])

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-3">
        <div class="cart-summary">            
            @include('include/user_menu',['active_user'=>'addresses'])	
        </div>
    </div>
    <div class="col-lg-9">
        <div class="cart-table-container">
             
<div class="box-content text-right">
  <h2>بيانات المستخدم</h2><br>
         
      <?php  echo Form::open(['action' => ['UsersController@update_user', Auth::user()->id]
                                ,'files'=>TRUE,'class'=>'form']);  ?>     
          {{ csrf_field() }}          
          <div class="col-sm-12 form-group">
            <div class="row">
              <div class="col-xs-6 col-md-6">
                   {!! Form::input('text','first_name',Auth::user()->first_name, array('class'=>'form-control','placeholder'=>'الاسم الاول')) !!}                  
              </div>
              <div class="col-xs-6 col-md-6">
                   {!! Form::input('text','last_name',Auth::user()->last_name, array('class'=>'form-control','placeholder'=>'الاسم الاخير ')) !!}                          
              </div>
            
          <div class="col-sm-6">
               {!! Form::input('email','email',Auth::user()->email, array('class'=>'form-control','placeholder'=>'البريد الالكترونى')) !!}                  
          </div>
          <div class="col-sm-6">
               {!! Form::input('tel','mobile',Auth::user()->mobile, array('class'=>'form-control','placeholder'=>'رقم الجوال')) !!}              
          </div>
          <div class="col-sm-6">
               {!! Form::input('password','password',null, array('class'=>'form-control','placeholder'=>'كلمة المرور')) !!}             
          </div>
          <div class="col-sm-6">
               {!! Form::input('password','confirm_password',null, array('class'=>'form-control','placeholder'=>'اعادة كلمة المرور')) !!}                  
          </div>
          <div class="col-sm-12">
            <label>تاريخ الميلاد</label><br/>
          </div>
        <div class="clearfix"></div>
        
          <div class="col-sm-2 form-group">
            <select name="month" class = "form-control ">
                @if($months)
                    @foreach($months as $month)
                    <option value="{{ $month->id }}">{{ $month->title_ar }}</option>  
                    @endforeach
                @endif
            </select>
          </div>
          <div class="col-sm-2 form-group">
            <select name="day" class = "form-control ">
                @for($i=1;$i<=31;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
          </div>
          <div class="col-sm-2 form-group">
            <select name="year" class = "form-control ">
              @for($i=1935;$i<=2017;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor                               
            </select>
          </div>
          <div class="col-sm-6 form-group">
            <label>النوع : </label>
            <label class="radio-inline">
                <input type="radio" name="gender" value="M" @if(Auth::user()->gender == 'M') checked @endif />
              ذكر </label>
            <label class="radio-inline">
              <input type="radio" name="gender" value="F"  @if(Auth::user()->gender == 'F') checked @endif />
              أنثى </label>
          </div>
          <div class="col-sm-12 form-group">
            <label>العنوان : </label>
            <input id="pac-input" name="address" class="controls" type="text" value="<?php echo Auth::user()->address ?>" placeholder="ابحث">
            <div id="map"></div>
                 <!----------------- Google map ----------------------->
    <script src="{{asset('asset/js/searchPlaceGoogle.js')}}"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN8cys7mg64JtPG7lusnBZVivyyaWKwZ8&libraries=places&callback=initAutocomplete"
         async defer></script>
          </div>
          <div class="col-sm-12 form-group">
            <div class="row">
              <label class="radio-inline">
                <input type="checkbox" name="checkbox" />
                <b> االاشتراك فى القائمة البريدية</b> </label>
            </div>
          </div>
          <!--<div class="col-sm-12"> <span class="help-block">بيانات بخصوص عمل حساب جديد.</span>-->
               {!! Form::submit('حفظ التعديلات', array('class'=>'btn btn-lg btn-primary btn-block signup-btn')) !!}
               {!! Form::close() !!}  
      </div>
              </div>
          </div>
    
</div>
            
            
        </div><!-- End .cart-table-container -->


    </div><!-- End .col-lg-8 -->

     
</div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->
 

@endsection
