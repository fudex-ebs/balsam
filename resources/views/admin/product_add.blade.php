@extends('admin/master',['title'=>'أضف منتج','active'=>'products'])
@section('content')

<div class="row mt">
     
        <div class="col-lg-7">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-left"></i> أضف منتج </h4>
        <div class="controls controle_view float_left">                
            {!! Html::decode(link_to('admin/all_products','<i class="fa fa-list"></i> عرض الكل',    
            ['class' => 'btn btn-link'])) !!}
        </div>
          
          <hr/>          
       
          
          {!! Form::open(array('url'=>'admin/addproduct','method'=>'POST', 'files'=>true , 'class'=>'form-horizontal style-form')) !!}  
          {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('title','العنوان', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>
 
        <div class="form-group">
            {!! Form::label('category','التصنيف', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-5">
                <select name="category" id="category" class="form-control">
                      <option value="0">اختر قسم </option>
                    @foreach($categories as $row)
                    <option value="{{ $row->id }}">{{ $row->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('sub_category','قسم فرعى', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-5">
                <select name="sub_category" id="sub_category" class="form-control">
                    <option value="0">اختر قسم </option>
                    
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('sub_category2','قسم فرعى2', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-5">
                <select name="sub_category2" id="sub_category2" class="form-control">
                    <option value="0">اختر قسم </option>
                    
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('code','الكود', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-3">
                <input type="text" name="code" id="code" class="form-control">
            </div>
        </div>
        <div class="form-group">
               {!! Form::label('img','صورة المنتج', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::file('img', null) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('price','السغر', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-3">
                <input type="text" name="price" id="price" class="form-control"> RS
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('description','الوصف', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('how_to_use','كيفية الاستخدام', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                <textarea name="how_to_use" id="how_to_use" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('cautions','التحذيرات والإحتياطات', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                <textarea name="cautions" id="cautions" class="form-control"></textarea>
            </div>
        </div>
<!--        <div class="form-group">
            {!! Form::label('description_en','Description English', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                <textarea name="description_en" id="description_en" class="form-control"></textarea>
            </div>
        </div>-->
        <div class="form-group">
            {!! Form::label('active','نشط؟', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="active" id="yes" value="1" checked> <span>نعم</span> </label>                    
                    <label> <input type="radio" name="active" id="no" value="0"> <span>لا</span> </label>                    
               </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('active','منتج مميز', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="special" id="yes" value="1" > <span>نعم</span> </label>                    
                    <label> <input type="radio" name="special" id="no" value="0" checked> <span>لا</span> </label>                    
               </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('tax','ضريبة مضافة', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                   <label> <input type="radio" name="tax" id="yes" value="1" checked=""> <span>نعم</span> </label>                    
                    <label> <input type="radio" name="tax" id="no" value="0"> <span>لا</span> </label>                    
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
            {!! Form::label('qty','الكمية المتاحة', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-3">
                <input type="number" name="qty" id="qty" class="form-control" value="1"> 
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('offer','سعر العرض', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-3">
                <input type="number" name="offer" id="offer" class="form-control"> ريال
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('offer_end','انتهاء العرض', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-3">
                <input type="date" name="offer_end" id="offer_end" placeholder="2017-06-28" class="form-control date-picker">  
            </div>
        </div>
        
        
  </div>
            

            
    </div>
    
    
     <div class="col-sm-5">
        <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-left"></i> أضف صور للمنتج</h4>
          <hr/>
        
        <div class="form-group">
               {!! Form::label('imgs','صور المنتج', array('class'=>'col-sm-4 control-label')) !!}                               
            <div class="col-sm-8">
                {!! Form::file('imgs[]',['multiple' => 'multiple'] ) !!}
            </div>
        </div>
          <div class="clearfix"></div><hr/>
          <div class="form-group">
                 {!! Form::label('','', array('class'=>'col-sm-4 control-label')) !!}              
            <div class="col-sm-8">
                {!! Form::submit('اضف', array('class'=>'btn btn-theme')) !!}
                {!! Form::close() !!}
                      </div>
        </div>
          <br/><br/>
     
       
      
</div>
    </div>
    
    
    
</div>

@stop
