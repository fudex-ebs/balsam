@extends('master', ['title'=>'عناوينى','active'=>'home'])

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
   <h2>عنواين الشحن  </h2><br>
         
         <ul class="list-unstyled">
             <li><input type="radio" value="0" name="address" id="addNew"/> <label for="addNew">اضافة عنوان جديد</label></li>
             @if($my_address)
                @foreach($my_address as $add)
                <li><input type="radio" value="0" name="address" value="{{ $add->AddID }}" id="addNo{{ $add->AddID }}"/> 
                    <label for="addNo{{ $add->AddID }}">{{ $add->title_ar }} - {{ $add->city_ar }} - {{ $add->postal }} - {{  $add->street }} </label></li>                
                @endforeach
             @endif
         </ul>
         
         <hr/>
        <?php  echo Form::open(['action' => ['CartController@addAddress', Auth::user()->id]
                                ,'files'=>TRUE,'class'=>'form']);  ?>     
          {{ csrf_field() }}                     
           
          <div class="col-xs-6 col-md-6 form-group">
                 <label>البلد</label>
                 <select name="country" id="country" class = "form-control" required="">
                <option value="0"> -- اختر بلد -- </option>
                @if($countries)
                    @foreach($countries as $item)
                    <option value="{{ $item->id }}">{{ $item->title_ar }}</option>  
                    @endforeach
                @endif
            </select>
          </div>
         <div class="col-xs-6 col-md-6 col-lg-6 form-group">
                 <label>المنطقة</label>
                 <select name="region" id="region" class = "form-control" required="">
                    <option value="0"> -- اختر منطقة -- </option>                 
                </select>
          </div>
          <div class="col-xs-6 col-md-6 col-lg-6 form-group">
                 <label>المدينة</label>
                 <select name="city" id="city" class = "form-control" required="">
                <option value="0"> -- اختر مدينة -- </option>                 
            </select>
          </div>
          
          <div class="col-xs-6 col-md-6 form-group">
                 <label>الرمز البريدى</label>
                {!! Form::input('text','postal',null, array('class'=>'form-control','placeholder'=>'الرمز البريدى')) !!}                  
          </div>
           <div class="col-xs-6 col-md-6 form-group">
                 <label>اسم الشارع  </label>
                {!! Form::input('text','street',null, array('class'=>'form-control','placeholder'=>'اسم الشارع')) !!}                  
          </div>
          <div class="col-sm-12"> 
               {!! Form::submit('حفظ', array('class'=>'btn btn-lg btn-primary btn-block signup-btn')) !!}
               {!! Form::close() !!}  
      </div>

    
</div>
            
            
        </div><!-- End .cart-table-container -->


    </div><!-- End .col-lg-8 -->

     
</div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->

 
@endsection
