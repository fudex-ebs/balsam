@extends('admin/master',['title'=>$item->price,'active'=>'settings'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تعديل سعر شحن المدينة </h4>
          <hr/>
           <?php  echo Form::open(['action' => ['AdminController@update_delivery', $item->id]
                                ,'class'=>'form-horizontal style-form']);  ?>
          
              {{ csrf_field() }}
         
        <div class="form-group">
            <label for="country" class="col-sm-2 col-sm-2 control-label">البلد  </label>
            <div class="col-sm-5">
                <select name="country" id="country" class="form-control">
                    <option value="0">-- اختر بلد   -- </option>
                    @if($countries)
                        @foreach($countries as $row)
                            <option value="{{ $row->id }}" @if($item->country == $row->id) selected @endif>{{ $row->title_ar }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="city" class="col-sm-2 col-sm-2 control-label">المنطقة  </label>
            <div class="col-sm-5">
                <select name="region" id="region" class = "form-control" required="">
                    <option value="0"> -- اختر منطقة -- </option>                 
                    @foreach($regis as $reg)
                    <option value="{{ $reg->id }}" @if($reg->id == $item->region) selected @endif>{{ $reg->title_ar }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="city" class="col-sm-2 col-sm-2 control-label">المدينة  </label>
            <div class="col-sm-5">
                <select name="city" id="city" class = "form-control" required="">
                <option value="0"> -- اختر مدينة -- </option>         
                @foreach($cits as $cit)
                    <option value="{{ $cit->id }}" @if($cit->id == $item->city) selected @endif>{{ $cit->title_ar }}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 col-sm-2 control-label">السعر</label>
            <div class="col-sm-10">
                <input type="text" name="price" id="price" value="{{ $item->price }}" class="form-control">
            </div>
        </div>       
        <div class="form-group">
            <label for="active" class="col-sm-2 col-sm-2 control-label">نشط؟</label>
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="active" id="yes" value="1" @if($item->active == 1) checked @endif > نعم </label>                    
                    <label> <input type="radio" name="active" id="no" value="0" @if($item->active == 0) checked @endif> لا </label>                    
               </div>
            </div>
        </div>
       
              <div class="form-group">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                      <button type="submit" class="btn btn-theme">تعديل</button>
                  </div>
              </div>
      
    </form>
  </div>
            
    </div>
</div>

@stop
