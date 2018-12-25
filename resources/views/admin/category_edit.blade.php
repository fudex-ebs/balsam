@extends('admin/master',['title'=>$row->title,'active'=>'categories'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> تعديل التصنيف </h4>
          <hr/>
          <form class="form-horizontal style-form" method="post" action="update">
              {{ csrf_field() }}
        <div class="form-group">
            <label for="parent" class="col-sm-2 col-sm-2 control-label">متفرع من  </label>
            <div class="col-sm-5">
                <select name="parent" id="parent" class="form-control">
                    <option value="0"> -- اختر --</option>
                    @foreach($data as $row)
                    <option value="{{ $row->id }}" @if($category->parent == $row->id) selected @endif>{{ $row->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="sub_parent" class="col-sm-2 col-sm-2 control-label">قسم فرعى</label>
            <div class="col-sm-5">
                <select name="sub_parent" id="sub_parent" class="form-control">
                    <option value="0">-- اختر قسم   -- </option>                    
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-2 col-sm-2 control-label">العنوان </label>
            <div class="col-sm-10">
                <input type="text" name="title" id="title_ar" class="form-control" value="{{ $category->title}}">
            </div>
        </div>
        
        <div class="form-group">
            <label for="active" class="col-sm-2 col-sm-2 control-label">نشط؟</label>
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="active" id="yes" value="1" @if($category->active == 1) checked @endif > نعم </label>                    
                    <label> <input type="radio" name="active" id="no" value="0" @if($category->active == 0) checked @endif> لا </label>                    
               </div>
            </div>
        </div>
      <div class="form-group">
            <label for="sort" class="col-sm-2 col-sm-2 control-label">الترتيب</label>
            <div class="col-sm-2">
                <select name="sort" id="sort" class="form-control">
                    @for($i=0 ; $i<=10 ; $i++)
                    <option value="{{$i}}" @if ($category->sort == $i) selected @endif >{{ $i }}</option>
                    @endfor
                </select>
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
