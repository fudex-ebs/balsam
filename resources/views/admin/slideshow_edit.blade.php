@extends('admin/master',['title'=>$slideshow->title1,'active'=>'slideshow'])
@section('content')
<div class="row mt">
        <div class="col-lg-8">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تعديل صورة الواجهة </h4>
          <hr/>
           <?php  echo Form::open(['action' => ['AdminController@update_slideshow', $slideshow->id]
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
          
              {{ csrf_field() }}
         <div class="form-group">
            {!! Form::label('img','الصورة', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::file('img',null, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('title1','العنوان الاول', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title1', $slideshow->title1, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('title2','العنوان الثانى', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title2', $slideshow->title2, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('title3','العنوان الثالث', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title3', $slideshow->title3, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('link','الرابط', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('link', $slideshow->title3, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('align','Align', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('align', $slideshow->align, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('fade','Fade', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('fade', $slideshow->fade, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            <label for="active" class="col-sm-2 col-sm-2 control-label">نشط؟</label>
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="active" id="yes" value="1" @if($slideshow->active == 1) checked @endif > نعم </label>                    
                    <label> <input type="radio" name="active" id="no" value="0" @if($slideshow->active == 0) checked @endif> لا </label>                    
               </div>
            </div>
        </div>
      <div class="form-group">
            {!! Form::label('sort','الترتيب', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-2">
                <select name="sort" id="sort" class="form-control">
                    @for($i=0 ; $i<=10 ; $i++)
                    <option value="{{$i}}" @if($slideshow->sort == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-10"> {!! Form::submit('تعديل', array('class'=>'btn btn-theme')) !!}</div>
        </div>
      {!! Form::close() !!}
    </form>
  </div>
            
    </div>
    
    <div class="col-lg-4">
        <div class="form-panel"> 
            @if($slideshow->img != "")
                <img src="{{ url('uploads/') }}/{{ $slideshow->img }}" class="img-responsive" />
            @endif
        </div>
            
    </div>
    
</div>

@stop
