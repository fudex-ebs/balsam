@extends('admin/master',['title'=>'ارسال تنبيهات عبر  الجوال','active'=>'ads'])
@section('content')

<div class="row mt">
    <div class="col-lg-6">
            
     <div class="form-panel">
          
         <table class="table table-striped table-advance table-hover" id="myTbl">
            <h4> عرض الرسايل السابقة </h4>
            <hr>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">العنوان  </th>                                         
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)                
            <tr>
                <td class="text-center">{{$row->id}}</td>
                <td class="text-center">{{$row->title}}</td>
                <td>
                
                <a href="{{ url('admin/') }}/{{$row->id}}/deleteNotification" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                </td>
            </tr>
            @endforeach
            

        </tbody>
        </table>
         <div class="clearfix"></div>
     </div>
            
            
    </div>
    
        <div class="col-lg-6">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> ارسل تنبيه لرواد برنامج البلسم</h4>
         
          <hr/>          
        {!! Form::open(array('url'=>'admin/sendNotification','method'=>'POST', 'files'=>true , 'class'=>'form-horizontal style-form')) !!}  
          {{ csrf_field() }}      
           
        <div class="form-group">
            {!! Form::label('title','العنوان', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('body','المحتوى', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                <textarea name="body" id="body" class="form-control"></textarea>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                {!! Form::submit('ارسل', array('class'=>'btn btn-theme')) !!}
      {!! Form::close() !!}
            </div>
        </div>
        
  </div>
            
    </div>
</div>

@stop
