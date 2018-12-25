@extends('admin/master', ['title'=>'تصنيفات المنتجات','active'=>'categories'])
@section('content')
<div class="row mt">
        <div class="col-lg-6">
  <div class="form-panel">      
          <h4 class="mb"><i class="fa fa-angle-right"></i> أضف قسم </h4>
          <hr/>
          <form class="form-horizontal style-form" method="post" action="add_category">
              {{ csrf_field() }}
        <div class="form-group">
            <label for="parent" class="col-sm-2 col-sm-2 control-label">قسم أساسى</label>
            <div class="col-sm-5">
                <select name="parent" id="parent" class="form-control">
                    <option value="0">-- اختر قسم   -- </option>
                    @if($parents)
                        @foreach($parents as $row)
                            <option value="{{ $row->id }}">{{ $row->title }}</option>
                        @endforeach
                    @endif
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
            <label for="title" class="col-sm-2 col-sm-2 control-label">العنوان</label>
            <div class="col-sm-10">
                <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>       
        <div class="form-group">
            <label for="active" class="col-sm-2 col-sm-2 control-label">نشط ؟</label>
            <div class="col-sm-10">
               <div class="radio">                    
                    <label> <input type="radio" name="active" id="yes" value="1" checked> نعم </label>                    
                    <label> <input type="radio" name="active" id="no" value="0"> لا </label>                    
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
                      <button type="submit" class="btn btn-theme">أضف</button>
                  </div>
              </div>
      
    </form>
  </div>
        </div>
    <div class="col-lg-6">
            
     <div class="form-panel">
         {!! Form::open(array('url'=>'admin/tbl_actions','method'=>'POST')) !!}  
          {{ csrf_field() }}         
             <input type="hidden" value="Category" name="tbl" />
         <table class="table table-striped table-advance table-hover" id="myTbl">
            <h4><i class="fa fa-angle-right"></i> عرض التصنيفات </h4>
            <hr> 
            <div class="controls myctls">     
                <button type="submit" class="btn btn-danger" title="حذف"><i class="fa fa-trash-o"></i></button>
                <!--<div class="clearfix"></div>-->
             </div>
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" name="all" id="all" /></th>
                <th class="text-center">العنوان </th>            
                <!--<th class="text-center">قسم فرعى</th>-->
                <th class="text-center">الترتيب </th>
                <th class="text-center">الحالة</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)                
                <tr>
                    <td class="text-center"><input type="checkbox" value="{{$row->id}}" name="select_rows[]"/></td>
                    <td><a href="{{ url('category') }}/{{ $row->id }}">{{ $row->title }}</a></td>                
<!--                <td>ss</td>-->
                <td>{{ $row->sort }} </td>
                <td>
                    @if($row->active == 1) <span class="label label-info label-mini"> نعم</span>
                    @else <span class="label label-warning label-mini"> لا </span> @endif
                </td>
                <td>
                <!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                <a href="{{ url('admin/category') }}/{{$row->id}}/edit" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                <a href="{{ url('admin/category/') }}/{{$row->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                </td>
            </tr>
            @endforeach
            

        </tbody>
        </table>
         </form>
         <div class="clearfix"></div>
     </div>
            
            
    </div>
</div>

@stop
