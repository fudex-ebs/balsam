@extends('admin/master', ['title'=>'اعدادات الموقع','active'=>'settings'])
@section('content')
<div class="row mt">
        <div class="col-lg-6">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> أضف عنصر </h4>
          <hr/>
          <?php  echo Form::open(['action' => ['SiteSettings@add_setting']
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
              {{ csrf_field() }}
         
        <div class="form-group">
            {!! Form::label('keyword','العنصر', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('keyword', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('value','القيمة', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('value', null, array('class' => 'form-control')) !!}                
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
            
     <div class="col-lg-6">
     <div class="form-panel">
         <table class="table table-striped table-advance table-hover" id="myTbl">
            <h4><i class="fa fa-angle-right"></i> جميع الاعدادات </h4>
            <hr>
        <thead>
            <tr>
                <th>العنصر</th>
                <th>القيمة</th>                
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)                
                <tr>
                    <td>{{ $row->keyword }}</td>
                    <td class="hidden-phone">
                         {{ str_limit($row->value, $limit = 30, $end = '...') }} 
                    </td>
                    <td>
                        <!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                        <a href="{{ url('admin/setting') }}/{{$row->id}}/edit" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                        <!--<a href="{{ url('admin/setting') }}/{{$row->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>-->
                    </td>
            </tr>
            @endforeach            
        </tbody>
        </table>
         <div class="clearfix"></div>
     </div>
            
            
    </div>
</div>

@stop
