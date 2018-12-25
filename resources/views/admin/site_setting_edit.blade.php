@extends('admin/master',['title'=>$setting->keyword,'active'=>'settings'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تعديل العنصر </h4>
          <hr/>
           <?php  echo Form::open(['action' => ['SiteSettings@update_setting', $setting->id]
                                ,'class'=>'form-horizontal style-form']);  ?>
          
              {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('keyword','العنصر', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="text" name="keyword" id="keyword" class="form-control" 
                       value="{{$setting->keyword}}" readonly="" />                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('value','القيمة', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('value', $setting->value, array('class' => 'form-control')) !!}                
            </div>
        </div>
              <div class="form-group">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                      {!! Form::submit('تعديل', array('class'=>'btn btn-theme')) !!}
                      {!! Form::close() !!}
                  </div>
              </div>        
    </form>
  </div>
            
    </div>
     
</div>

@stop
