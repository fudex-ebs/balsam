@extends('admin/master',['title'=>$about->title,'active'=>'about'])
@section('content')
<div class="row mt">
        <div class="col-lg-8">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> {{$about->title}} </h4>
          <hr/>
        
         <?php  echo Form::open(['action' => ['AdminController@updateAbout', $about->id]
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
        
         {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('title','العنوان', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title', $about->title, array('class' => 'form-control')) !!}                
            </div>
        </div>
          
        <div class="form-group">
               {!! Form::label('img','الصورة التوضيحية', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::file('img', null) !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('body','المحتوى', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::textarea('body', $about->body, array('class' => 'form-control')) !!}                
            </div>
        </div>
         
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
                 {!! Form::submit('تعديل', array('class'=>'btn btn-theme')) !!}
      {!! Form::close() !!}
        </div>
    </div>
   
  </div>
            
    </div>
    
    <div class="col-lg-4">
  <div class="form-panel">      
      <img src="{{ asset('uploads') }}/{{ $about->img }}" class="img-responsive"/>
<div class="clearfix"></div>

</div>
        
    </div>
    
    
    
</div>

@stop
