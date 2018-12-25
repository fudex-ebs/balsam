@extends('admin/master', ['title'=>'واجهة الموقع','active'=>'slideshow'])
@section('content')
<div class="row mt">
        <div class="col-lg-6">
  <div class="form-panel">      
          <h4 class="mb"> أضف عنصر  </h4>
          <hr/>
          <?php  echo Form::open(['action' => ['AdminController@add_slideshow']
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
              {{ csrf_field() }}
        <div class="form-group">
            {!! Form::label('img','صورة الواجهة', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::file('img', null, array('class' => 'form-control')) !!}                
            </div>
        </div> 
        <div class="form-group">
            {!! Form::label('title1','العنوان الأول', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title1', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('title2','العنوان الثانى', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title2', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('title3','العنوان الثالث', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title3', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('link','الرابط', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('link', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('align','Align', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('align', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('fade','Fade', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('fade', null, array('class' => 'form-control')) !!}                
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('active','نشط ؟ ', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                   <label> {!! Form::radio('active', 1,true ) !!} نعم </label>
                    <label> {!! Form::radio('active', 0) !!} لا </label>                    
               </div>
            </div>
        </div>
      <div class="form-group">
            <label for="sort" class="col-sm-2 col-sm-2 control-label">الترتيب</label>
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
            <h4><i class="fa fa-angle-right"></i> عرض صور الواجهة </h4>
            <hr>
        <thead>
            <tr>
                <th>الصورة</th>
                <th>العنوان الاول</th>                
                <th>الترتيب </th>
                <th>الحالة</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                
                <tr>
                    <td><img src="{{ asset('uploads') }}/{{ $row->img }}" class="tbl_img"/></td>
                    <td>{{ $row->title1 }}</td>                    
                    <td>{{ $row->sort }} </td>
                    <td>
                        @if($row->active == 1) <span class="label label-info label-mini"> نعم</span>
                        @else <span class="label label-warning label-mini"> لا </span> @endif
                    </td>
                    <td>
                        <!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                        <a href="{{ url('admin/slideshow') }}/{{$row->id}}/edit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="{{ url('admin/slideshow') }}/{{$row->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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
