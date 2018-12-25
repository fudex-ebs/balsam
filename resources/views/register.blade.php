@extends('master', ['title'=>'تسجيل جديد','active'=>'home'])

@section('content')
<div class="container">
                <div class="row">
                    <div class="col-lg-12 order-lg-last dashboard-content">
                        <h2>اشتراك جديد  </h2>
                        
                        
{!! Form::open(array('url'=>'signup','method'=>'POST', 'files'=>true , 'class'=>'form')) !!}  
  {{ csrf_field() }}
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group required-field">
                    <label for="first_name">الاسم الأول</label>
                     {!! Form::input('text','first_name',null, array('class'=>'form-control','placeholder'=>'الاسم الاول')) !!} 
                </div><!-- End .form-group -->
            </div><!-- End .col-md-4 -->

            <div class="col-md-4">
                <div class="form-group">
                    <label for="last_name">الاسم الأخير</label>
                    {!! Form::input('text','last_name',null, array('class'=>'form-control','placeholder'=>'الاسم الاخير ')) !!}                          
                </div><!-- End .form-group -->
            </div><!-- End .col-md-4 -->

            <div class="col-md-4">
                <div class="form-group required-field">
                    <label for="email">البريد الالكترونى</label>
                    {!! Form::input('email','email',null, array('class'=>'form-control','placeholder'=>'البريد الالكترونى')) !!}                  
                </div><!-- End .form-group -->
            </div><!-- End .col-md-4 -->
            
             <div class="col-md-4">
                <div class="form-group required-field">
                    <label for="mobile">الجوال  </label>
                    {!! Form::input('tel','mobile',null, array('class'=>'form-control','placeholder'=>'رقم الجوال')) !!}              
                </div><!-- End .form-group -->
            </div><!-- End .col-md-4 -->
            
             <div class="col-md-4">
                <div class="form-group required-field">
                    <label for="password">كلمة المرور  </label>
                    {!! Form::input('password','password',null, array('class'=>'form-control','placeholder'=>'كلمة المرور')) !!}             
                </div><!-- End .form-group -->
            </div><!-- End .col-md-4 -->
            <div class="col-md-4">
                <div class="form-group required-field">
                    <label for="confirm_password">تأكيد كلمة المرور  </label>
                    {!! Form::input('password','confirm_password',null, array('class'=>'form-control','placeholder'=>'اعادة كلمة المرور')) !!}                  
                </div><!-- End .form-group -->
            </div><!-- End .col-md-4 -->
            
            <div class="col-md-12">
                <div class="form-group">                    
                <label>تاريخ الميلاد</label> 
                </div>
            </div>
          <div class="col-md-1">
            <select name="month" class="form-control">
                @if($months)
                    @foreach($months as $month)
                    <option value="{{ $month->id }}">{{ $month->title_ar }}</option>  
                    @endforeach
                @endif
            </select>
          </div>
        <div class="col-md-1">
            <select name="day" class="form-control">
                @for($i=1;$i<=31;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-2">
            <select name="year" class="form-control">
              @for($i=1935;$i<=2017;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor                               
            </select>
        </div>
           
            <div class="col-md-6">        
                <div class="form-group">
                    <label for="confirm_password">النوع </label>               
                <label class="radio-inline">
                <input type="radio" name="gender" value="M" checked=""/>
              ذكر </label>
            <label class="radio-inline">
              <input type="radio" name="gender" value="F"  />
              أنثى </label>
            </div><!-- End .custom-checkbox -->
            </div>
            
            <div class="col-sm-12">
                 <div class="form-group">
            <label>العنوان   </label>
            <input id="pac-input" name="address" class="controls" type="text" placeholder="ابحث">
            <div id="map"></div>
                 <!----------------- Google map ----------------------->
    <script src="{{asset('asset/js/searchPlaceGoogle.js')}}"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN8cys7mg64JtPG7lusnBZVivyyaWKwZ8&libraries=places&callback=initAutocomplete"
         async defer></script>
                 </div>
          </div>
            
            <div class="col-md-12">
                {!! Form::submit('انشاء حساب جديد', array('class'=>'btn btn-lg btn-primary btn-block signup-btn')) !!}
               {!! Form::close() !!}  
            </div>
            
            </div><!-- End .col-md-4 -->
        </div><!-- End .row -->
    </div><!-- End .col-sm-11 -->
</div><!-- End .row -->
                
 
 
 
</div><!-- End .col-lg-9 -->


        </div><!-- End .row -->
    
 
@endsection
