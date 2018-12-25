@extends('master', ['title'=>'متابعة الطلب رقم ' . $order->id,'active'=>'home'])

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-3">
        <div class="cart-summary">            
            @include('include/user_menu',['active_user'=>'follow_order'])	
        </div>
    </div>
    <div class="col-lg-9">
        <div class="cart-table-container">
             
<div class="box-content text-right">
  
    <div class="text-center" style="margin-bottom:60px;"><h2 style="color:#7cbc46">تتبع طلبك
        رقم  {{ $order->id }}
        </h2>
        <p> من خلال هذه الصفحة يمكنك تتبع طلبك بمراحله المختلفة , شكرا لاشتراكك فى البلسم الطبى. </p>
    </div>
           

            <div class="order-status">
                @foreach($all_status as $all_statu)
                <li class="col-sm-5 @if($all_statu->id == $order->status) activeStatus @endif">{{$all_statu->title_ar}}</li>
                @endforeach                 
            </div>
    
    <table dir="rtl" cellspacing="0" class="shop_table table table-hover" width="100%">
                <thead>
                       <tr>
                        <th class="product-thumbnail"> المنتجات </th>                            
                        <th class="product-quantity"> العدد</th>                            
                        <th class="product-subtotal">الأجمالى</th>                                            
                    </tr>
                </thead>
                <tbody>
        @if($my_items)
            @foreach($my_items as $item)
                        <tr class="cart_table_item">                
            <td class="product-thumbnail" width="">
                <a href="{{ url('product') }}/{{ $item->id }}">
                            <img alt="" src="{{ asset('uploads') }}/{{ $item->img }}">
</a>
<div class="pull-left">    
   <a href="">{{ $item->title }}</a>
    <p class="product-price">
            <span class="amount">{{ $item->price }} ريال</span>
    </p>
            </div>
    </td>
    <td class="product-quantity">
        <div class="quantity">                
                <input type="number" class="input-text qty text" title="Qty" value="{{ $item->qty }}" 
                       name="quantity" min="1" step="1" readonly="">                
        </div>

    </td>
    <td class="product-subtotal">
            <span class="amount"><big><b>{{ $item->price * $item->qty}}</b></big><br>
    <small>ريال</small></span>
            </td>             
    </tr>
                    @endforeach
                    @endif
        </tbody>
        <tfoot>             
            <tr>
                <td colspan="2">الاجمالى</td>
                <td>{{ $order->total }} ريال</td>
            </tr>
            
        </tfoot>
        </table>
  
    <div class="col-sm-12" style="margin-top:30px">
    @if($order->active == 1)
        <a href="{{url('cancelOrder')}}/{{$order->id}}" class="btn btn-primary">الغاء الطلب</a> <span>* يمكنك الغاء الطلب فى المرحلة الاولى والثانية فقط</span>
        @else <span class="req"><center>طلب ملغى</center></span>
    @endif
</div>
    
      </div>
              </div>
          </div>
    
</div>
            
            
        </div><!-- End .cart-table-container -->

 

@endsection
