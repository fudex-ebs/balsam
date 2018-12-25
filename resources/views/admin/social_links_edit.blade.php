@extends('admin/master',['title'=>$social->site,'active'=>'settings'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تعديل بيانات الموقع </h4>
          <hr/>
           <?php  echo Form::open(['action' => ['SiteSettings@update_social', $social->id]
                                ,'class'=>'form-horizontal style-form']);  ?>
          
              {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('site','الموقع', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('site', $social->site, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('value','القيمة', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('value', $social->value, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            <label for="active" class="col-sm-2 col-sm-2 control-label">نشط؟</label>
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="active" id="yes" value="1" @if($social->active == 1) checked @endif > نعم </label>                    
                    <label> <input type="radio" name="active" id="no" value="0" @if($social->active == 0) checked @endif> لا </label>                    
               </div>
            </div>
        </div>
      <div class="form-group">
            {!! Form::label('sort','الترتيب', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-2">
                <select name="sort" id="sort" class="form-control">
                    @for($i=0 ; $i<=10 ; $i++)
                    <option value="{{$i}}" @if($social->sort == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
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
