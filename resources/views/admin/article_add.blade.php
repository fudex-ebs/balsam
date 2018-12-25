@extends('admin/master',['title'=>'أضف مقال','active'=>'articles'])
@section('content')

<div class="row mt">
        <div class="col-lg-12">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> أضف مقال </h4>
        <div class="controls controle_view float_left">                
            {!! Html::decode(link_to('admin/all_articles','<i class="fa fa-list"></i> عرض الكل',    
            ['class' => 'btn btn-link'])) !!}
        </div>
          
          <hr/>          
        {!! Form::open(array('url'=>'admin/addArticle','method'=>'POST', 'files'=>true , 'class'=>'form-horizontal style-form')) !!}  
          {{ csrf_field() }}
         <div class="form-group">
            {!! Form::label('title','صورة المقال', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="file" name="img" id="title" >
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('title','العنوان', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('description','المحتوى', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                <textarea name="body" id="body" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('active','نشر؟', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="publish" id="yes" value="1" checked> 
                        <span>نعم</span>
                    </label>                    
                    <label> <input type="radio" name="publish" id="no" value="0"> <span>لا</span></label>                    
               </div>
            </div>
        </div>
      
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                {!! Form::submit('اضف', array('class'=>'btn btn-theme')) !!}
      {!! Form::close() !!}
            </div>
        </div>
        
  </div>
            
    </div>
</div>

@stop
