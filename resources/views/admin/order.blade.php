@extends('admin/master',['title'=>' طلب رقم '.$order->id,'active'=>'orders'])
@section('content')
    <div class="row mt">
        <div class="col-lg-12">
  <div class="form-panel">      
          <h4><i class="fa fa-angle-right "></i> تفاصيل الطلب   </h4>
            <hr>
          
            <div class="col-lg-12">
                <div class="col-lg-9">
                    <br/><br/>
                    <a href="{{ url('admin/delete_order') }}/{{ $order->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> &nbsp; حذف الطلب </a>
                    <a href="{{url('admin/printOrder')}}" class="btn btn-default" onclick="printThis()"><i class="fa fa-print"></i> طباعه </a>
                    <a href="{{url('admin/exportToPdf')}}/{{$order->id}}" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> PDF </a>

                </div>
                <div class="col-lg-3">
                <div class="form-group">
                    <?php  echo Form::open(['action' => ['AdminController@editOrderStatus', $order->id]]);  ?>        
                            {{ csrf_field() }}
                    <label>حالة الطلب</label>                    
                    <select name="status" class="form-control" onchange="this.form.submit();">
                        @if($order_status)
                            @foreach($order_status as $status)
                            <option value="{{ $status->id }}" 
                                    @if($order->status == $status->id) selected @endif
                                    >{{ $status->title_ar }}</option>
                            @endforeach
                        @endif
                    </select>
                     {!! Form::close() !!}
                    </div>
                </div>
                
            </div>
            <br/><br/> <hr/>
<table class="table table-striped table-advance table-hover text-center cart_list" id="myTbl">  
        <thead>
            <tr>          
                <th class="text-center">الكود</th>
                <th class="text-center">اسم المنتج</th>
                <th class="center">الكمية</th>
                <th class="text-center">سعر الوحدة</th>                          
                <th class="text-center">سعر الكمية</th>
                <th class="text-center">بتاريخ</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            @if($data)
            @foreach($data as $row)                
            <tr>   
                <td>{{ $row->code }}</td>
                <td>{{$row->title }}</td>
                <td>{{ $row->qty }}</td>
                <td>{{ $row->price }}ريال</td>
                <td>{{ $row->price * $row->qty }}ريال</td>
                <td>{{ $row->created_at }}</td>
                <td class="product-remove">
                        <a title="حذف" class="remove product-remove" href="javascript:void(0);">
                                <i class="fa fa-times-circle"></i>
                        </a>
                    <input type="hidden" value="{{ $row->id }}" />
                </td>
            </tr>
            @endforeach
            @endif
            
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">الاجمالى</th>
                <th colspan="4">{{ $order->total }}ريال</th>
            </tr>
        </tfoot>
          </table>
      <br/><br/>
  </div>
        </div>
    </div>

@stop
