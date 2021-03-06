@extends('admin/master',['title'=>$article->title,'active'=>'articles'])
@section('content')
<div class="row mt">
        <div class="col-lg-7">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تعديل المقال </h4>
          <hr/>
        
         <?php  echo Form::open(['action' => ['AdminController@update_article', $article->id]
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
        
         {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('title','العنوان', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title', $article->title, array('class' => 'form-control')) !!}                
            </div>
        </div>
          
        <div class="form-group">
               {!! Form::label('img','صورة المقال', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::file('img', null) !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('body','المحتوى', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::textarea('body', $article->body, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('publish','منشور؟', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                   <label> {!! Form::radio('publish', 1,true ) !!} نعم </label>
                    <label> {!! Form::radio('publish', 0) !!} لا </label>                    
               </div>
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
    
    <div class="col-lg-5">
  <div class="form-panel">      
      <img src="{{ asset('uploads') }}/{{ $article->img }}" class="img-responsive"/>
<div class="clearfix"></div>

</div>
        
    </div>
    
    
    
</div>

@stop
