@extends('admin/master',['title'=>'أضف مستخدم','active'=>'users'])
@section('content')

<div class="row mt">
        <div class="col-lg-12">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> أضف مستخدم </h4>
        <div class="controls controle_view float_left">                
            {!! Html::decode(link_to('admin/users/all','<i class="fa fa-list"></i> عرض الكل',    
            ['class' => 'btn btn-link'])) !!}
        </div>
          
          <hr/>          
        {!! Form::open(array('url'=>'admin/adduser','method'=>'POST', 'files'=>true , 'class'=>'form-horizontal style-form')) !!}  
          {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('first_name','الاسم الاول', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::input('text','first_name',null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('last_name','الاسم الأخير', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::input('text','last_name',null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('email','البريد الالكترونى', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::input('email','email',null, array('class'=>'form-control')) !!}
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
                {!! Form::input('text','mobile',null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('gender','النوع', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="radio" value="M" name="gender" checked="">Male
                <input type="radio" value="F" name="gender">Female
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('active','نشط؟', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="radio" value="1" name="active" checked="">نعم
                <input type="radio" value="0" name="active">لا
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('birth_date','تاريخ الميلاد', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::input('date','birth_date',null, array('class'=>'form-control date-picker')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('role','نوع المستخدم', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                   @if($roles)
                        @foreach($roles as $role)
                        <label> <input type="radio" name="role" value="{{ $role->id }}" @if($role->id == 3) checked @endif>
                            {{ $role->title_ar }} </label>                    
                        @endforeach
                    @endif
               </div>
            </div>
        </div>
       
          <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-10">
                  {!! Form::submit('أضف', array('class'=>'btn btn-theme')) !!}
      {!! Form::close() !!}
              </div>
          </div>
        
  </div>
            
    </div>
</div>

@stop
