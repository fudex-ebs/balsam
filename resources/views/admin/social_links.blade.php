@extends('admin/master', ['title'=>'مواقع التواصل الاجتماعى','active'=>'settings'])
@section('content')
<div class="row mt">
        <div class="col-lg-6">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> أضف موقع </h4>
          <hr/>
          <?php  echo Form::open(['action' => ['SiteSettings@add_social']
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
              {{ csrf_field() }}
         
        <div class="form-group">
            {!! Form::label('site','الموقع', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('site', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('value','الرابط', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('value', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('active','نشط؟', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="active" id="yes" value="1" checked> نعم </label>                    
                    <label> <input type="radio" name="active" id="no" value="0"> لا </label>                    
               </div>
            </div>
        </div>
      <div class="form-group">
            {!! Form::label('sort','الترتيب', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-2">
                <select name="sort" id="sort" class="form-control">
                    @for($i=0 ; $i<=10 ; $i++)
                    <option value="{{$i}}">{{ $i }}</option>
                    @endfor
                </select>
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
            <h4><i class="fa fa-angle-right"></i> عرض المواقع </h4>
            <hr>
        <thead>
            <tr>
                <th>الموقع</th>
                <th>الرابط</th>   
                <th>الترتيب</th>
                <th>نشط</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)                
                <tr>
                    <td>{{ $row->site }}</td>
                    <td class="hidden-phone">{{ $row->value }}</td>
                    <td>{{ $row->sort }}</td>
                    <td>
                        @if($row->active == 1) <span class="label label-info label-mini"> نعم</span>
                        @else <span class="label label-warning label-mini"> لا </span> @endif
                    </td>
                    <td>
                        <!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                        <a href="{{ url('admin/social') }}/{{$row->id}}/edit" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                        <a href="{{ url('admin/social') }}/{{$row->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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
