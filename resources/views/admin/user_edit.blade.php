@extends('admin/master',['title'=>$myUser->first_name.' '.$myUser->last_name,'active'=>'users'])
@section('content')
<div class="row mt">
        <div class="col-lg-8">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تحديث بيانات المستخدم </h4>
          <hr/>
        
         <?php  echo Form::open(['action' => ['AdminController@update_user', $myUser->id]
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
        
         {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('first_name','الاسم الأول', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('first_name', $myUser->first_name, array('class' => 'form-control')) !!}                
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('last_name','الاسم الأخير', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('last_name', $myUser->last_name, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('email','البريد الالكترونى', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::email('email', $myUser->email, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password','كلمة المرور', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::input('password','password',null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('confirm_password','تأكيد كلمة المرور', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::input('password','password_confirmation',null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('mobile','الجوال', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::input('text','mobile',$myUser->mobile, array('class'=>'form-control')) !!}
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('gender','النوع', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="radio" value="M" name="gender" @if($myUser->gender == 'M') checked @endif>Male
                <input type="radio" value="F" name="gender" @if($myUser->gender == 'F') checked @endif>Female
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('birth_date','تاريخ الميلاد', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::input('date','birth_date',$myUser->birth_date, array('class'=>'form-control date-picker')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('role','نوع المستخدم', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-5">
                <select name="role" id="role" class="form-control">
                    <option value="0">-- اختر من فضلك --</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if($myUser->role == $role->id) selected @endif>{{ $role->title_ar }}</option>
                    @endforeach
                </select>
            </div>
        </div>
             
        <div class="form-group">
            {!! Form::label('active','نشط؟', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                   <label> {!! Form::radio('active', 1,true ) !!} نعم </label>
                    <label> {!! Form::radio('active', 0) !!} لا </label>                    
               </div>
            </div>
        </div>
         <div class="form-group">
             <div class="col-sm-2"></div>
             <div class="col-sm-10">
                 {!! Form::submit('تحديث', array('class'=>'btn btn-theme')) !!}
      {!! Form::close() !!}
             </div>
         </div>
        
  </div>
            
    </div>
    
   
     
    
</div>

@stop
