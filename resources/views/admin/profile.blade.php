@extends('admin/master',['title'=> Auth::user()->first_name .' '.Auth::user()->last_name ,'active'=>'dashboard'])
@section('content')
<div class="row mt">
        <div class="col-lg-7">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> Update Profile </h4>
          <hr/>
        
         
          <?php  echo Form::open(['action' => ['AdminController@update_user', Auth::user()->id]
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
        
         {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('first_name','First Name', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('first_name', Auth::user()->first_name, array('class' => 'form-control')) !!}                
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('last_name','Last Name', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('last_name', Auth::user()->last_name, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('email','Email', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::email('email', Auth::user()->email, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password','Password', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::input('password','password',null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('confirm_password','Confirm Password', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::input('password','password_confirmation',null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('mobile','Mobile', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::input('text','mobile',Auth::user()->mobile, array('class'=>'form-control')) !!}
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('gender','Gender', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="radio" value="male" name="gender" @if(Auth::user()->gender == 'male') checked @endif>Male
                <input type="radio" value="female" name="gender" @if(Auth::user()->gender == 'female') checked @endif>Female
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('birth_date','Birth Date', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::input('date','birth_date',Auth::user()->birth_date, array('class'=>'form-control date-picker')) !!}
            </div>
        </div>
          
        {!! Form::submit('Submit', array('class'=>'btn btn-theme')) !!}
      {!! Form::close() !!}
      
  </div>
            
    </div>
    
     
    
    
    
</div>

@stop
