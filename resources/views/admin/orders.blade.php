@extends('admin/master',['title'=>'الطلبات','active'=>'orders'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
            
     <div class="form-panel">
         <div class="controls">                

        </div>
                  
         <table class="table table-striped table-advance table-hover text-center" id="myTbl">
            <h4><i class="fa fa-angle-right "></i> عرض الطلبات </h4>
            <hr>
        <thead>
            <tr>                
                <th class="text-center">اسم المستخدم  </th>
                <th class="text-center">اجمالى المبلغ</th>
                <th class="text-center">حالة الطلب</th>                          
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)                
            <tr>                     
                <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                <td>{{ $row->total }} ريال</td>
                <td>{{ $row->title_ar }}</td>
                <td>
                    <!--<a href="{{ url('admin') }}/{{$row->id}}/order" class="btn btn-success btn-xs" title="تفاصيل"><i class="fa fa-check"></i></a>-->
                <a href="{{ url('admin') }}/{{$row->OID}}/order" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                <a href="{{ url('admin/delete_order') }}/{{ $row->OID }}" class="btn btn-danger btn-xs" title="حذف"><i class="fa fa-trash-o "></i></a>
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
