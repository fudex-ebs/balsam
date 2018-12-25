@extends('admin/master',['title'=>'عرض المنتجات','active'=>'products'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
            
     <div class="form-panel">
         <div class="controls">                
    {!! Html::decode(link_to('admin/add_product','<i class="fa fa-plus-circle"></i> أضف',    
    ['class' => 'btn btn-round btn-theme'])) !!}
        </div>
         <table class="table table-striped table-advance table-hover" id="myTbl">
            <h4> عرض المنتجات </h4>
            <hr>
        <thead>
            <tr>
                <th class="text-center">صورة المنتج</th>
                <th class="text-center">اسم المنتج</th>
                <th class="text-center">السعر</th>
                <th class="text-center">سعر العرض</th>
                 <th class="text-center">ضريبة مضافة  </th>
                <th class="text-center">منتج مميز  </th>
                <!--<th>Category</th>-->                          
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)                
            <tr>
                    <td class="text-center">
                        @if($row->img != "")
                            <img src="{{ asset('uploads/') }}/{{ $row->img }}" class="img-circle tbl_img" />
                        @endif
                    </td>
                    <td><a href="{{ url('product') }}/{{ $row->id }}">{{ $row->title }}</a></td>                
                    <td>{{ $row->price }} ريال</td>     
                    <td>{{ $row->offer }} ريال</td>    
                     <td>@if($row->tax == 1) نعم @else لا @endif</td>
                    <td>@if($row->special == 1) نعم @else لا @endif</td>
                <td>
                <!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                <a href="{{ url('admin') }}/{{$row->id}}/edit_product" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                <a href="{{ url('admin/') }}/{{$row->id}}/delete_product" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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
