@extends('admin/master',['title'=>$product->title,'active'=>'products'])
@section('content')
<div class="row mt">
        <div class="col-lg-7">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تعديل المنتج </h4>
          <hr/>
        
         <?php  echo Form::open(['action' => ['AdminController@update_product', $product->id]
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
        
         {{ csrf_field() }}
        
        <div class="form-group">
            {!! Form::label('title','العنوان', array('class'=>'col-sm-2 control-label')) !!}                                           
            <div class="col-sm-10">
                {!! Form::text('title', $product->title, array('class' => 'form-control')) !!}                
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('category','التصنيف', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-5">
                <select name="category" id="category" class="form-control">
                    <option value="0">-- اختر -- </option>
                    @foreach($categories as $row)
                    <option value="{{ $row->id }}"
                            @if($row->id == $product->category) selected @endif
                            >{{ $row->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('sub_category','قسم فرعى', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-5">
                <select name="sub_category" id="sub_category" class="form-control">
                    @if($sub_category)
                        <option value="{{$sub_category->id}}">{{$sub_category->title}} </option>                        
                    @endif
                    <option value="0">اختر قسم</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('sub_category2','قسم فرعى2', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-5">
                <select name="sub_category2" id="sub_category2" class="form-control">
                    @if($sub_category2)
                        <option value="{{$sub_category2->id}}">{{$sub_category2->title}} </option>
                    @endif
                    <option value="0">اختر قسم</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('code','الكود', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-3">
                {!! Form::text('code', $product->code, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
               {!! Form::label('img','صورة المنتج', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::file('img', null) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('price','السعر', array('class'=>'col-sm-2  control-label')) !!}                               
            <div class="col-sm-3">
                {!! Form::text('price', $product->price, array('class' => 'form-control')) !!} RS               
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('description','الوصف', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::textarea('description', $product->description, array('class' => 'form-control')) !!}                
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('how_to_use','كيفية الاستخدام', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::textarea('how_to_use', $product->how_to_use, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('cautions','التحذيرات والإحتياطات', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
                {!! Form::textarea('cautions', $product->cautions, array('class' => 'form-control')) !!}                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('active','نشط؟', array('class'=>'col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                   <label> <input type="radio" name="active" id="yes" value="1"  @if($product->active == 1) checked @endif > <span>نعم</span>  </label>                    
                    <label> <input type="radio" name="active" id="no" value="0"  @if($product->active == 0) checked @endif > <span>لا</span></label>                                      
               </div>
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('active','منتج مميز', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="special" id="yes" value="1"  @if($product->special == 1) checked @endif > <span>نعم</span>  </label>                    
                    <label> <input type="radio" name="special" id="no" value="0"  @if($product->special == 0) checked @endif > <span>لا</span></label>                    
               </div>
            </div>
        </div>
         <div class="form-group">
            {!! Form::label('tax','ضريبة مضافة', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                               
            <div class="col-sm-10">
               <div class="radio">                    
                   <label> <input type="radio" name="tax" id="yes" value="1"  @if($product->tax == 1) checked @endif > <span>نعم</span> </label>                    
                   <label> <input type="radio" name="tax" id="no" value="0"  @if($product->tax == 0) checked @endif > <span>لا</span> </label>                    
               </div>
            </div>
        </div>
      <div class="form-group">
            {!! Form::label('sort','الترتيب', array('class'=>'col-sm-2 control-label')) !!}                               
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
            <div class="col-sm-4">
               {!! Form::input('number', 'qty',$product->qty ? $product->qty : 1, ['class' => 'form-control']) !!}
            </div>
        </div>
      <div class="form-group">
            {!! Form::label('offer','سعر العرض', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
            <div class="col-sm-4">
                 {!! Form::text('offer', $product->offer, array('class' => 'form-control')) !!} RS   
            </div>
        </div>
    <div class="form-group">
        {!! Form::label('offer_end','انتهاء العرض', array('class'=>'col-sm-2 col-sm-2 control-label')) !!}                                           
        <div class="col-sm-4">
            {!! Form::text('offer_end', $product->offer_end, array('class' => 'form-control')) !!} RS   
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
          <h4 class="mb"><i class="fa fa-angle-right"></i> صور المنتج </h4>
          <hr/>
        
         <?php  echo Form::open(['action' => ['AdminController@upload_imgProduct', $product->id]
                                ,'files'=>TRUE,'class'=>'form-horizontal style-form']);  ?>
        
         {{ csrf_field() }}     
         {!! Form::hidden('product_id',$product->id) !!}
        <div class="form-group">
               {!! Form::label('img','صور المنتج', array('class'=>'col-sm-4 control-label')) !!}                               
            <div class="col-sm-8">
                {!! Form::file('img[]',['multiple' => 'multiple'] ) !!}
            </div>
        </div>
        
          <div class="form-group">
         <div class="col-sm-2"></div>
         <div class="col-sm-10">
             {!! Form::submit('رفع', array('class'=>'btn btn-theme')) !!}
             {!! Form::close() !!}
         </div>          
          </div>
      <hr/>
      
      @if($product_imgs)
      @foreach($product_imgs as $row)
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
            <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                        <div class="photo">
                            <a class="fancybox" href="{{ asset('uploads') }}/{{ $row->img }}">
                                <img class="img-responsive" src="{{ asset('uploads') }}/{{ $row->img }}" alt=""></a>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </div>
                </div>
            </div><!-- col-lg-4 -->
        @endforeach
    @endif 
<div class="clearfix"></div>

</div>
        
    </div>
    
    
    
</div>

@stop
