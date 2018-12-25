@extends('master', ['title'=>'مشترياتى','active'=>'home'])

@section('content')
 
<div class="container">
<div class="row">
    <div class="col-lg-3">
        <div class="cart-summary">            
            @include('include/user_menu',['active_user'=>'shipping'])	
        </div>
    </div>
    <div class="col-lg-9">
        <div class="cart-table-container">
             
<div class="box-content text-right">
  
    <div class="text-center" style="margin-bottom:60px;"><h2 style="color:#7cbc46">تتبع طلبك
        مشترياتى
        </h2>        
    </div>
            
    
    <table dir="rtl" cellspacing="0" class="shop_table table table-hover" width="100%">
                <thead>
                       <tr>
                        <th class="product-thumbnail"> رقم الطلب </th>                            
                        <th class="product-quantity"> حالة الطلب</th>                            
                        <th class="product-subtotal">الأجمالى</th>                                            
                        <th class="">بتاريخ</th>
                        <th>أخر تحديث</th>
                        <th>متابعة الطلب</th>
                    </tr>
                </thead>
                <tbody>
       @if($ordersDelivered)
            @foreach($ordersDelivered as $item)
                        <tr class="cart_table_item">                
            <td class="product-thumbnail" width="">                        
                <h3><a href="{{ url('order') }}/{{ $item->OID }}">{{ $item->OID }}</a></h3>                     
            </td>
            <td>{{ $item->title_ar }}</td>  
            <td>{{ $item->total }}ريال </td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
            <td><a href="{{ url('track') }}/{{ $item->OID }}">متابعة</a></td>
    </tr>
                    @endforeach
                    @endif
        </tbody>
         
        </table>
      </div>
              </div>
          </div>
    
</div>
            
            
        </div><!-- End .cart-table-container -->
 
@endsection
