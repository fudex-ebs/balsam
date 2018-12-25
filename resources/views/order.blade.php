@extends('master', ['title'=>'طلب رقم '.$order->id,'active'=>'home'])

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
  <h2>طلب رقم {{$order->id}}    </h2><br>
    <table dir="rtl" cellspacing="0" class="shop_table cart_list table table-hover" width="100%">
    <thead>
            <tr>
                <th class="product-thumbnail"> المنتجات </th>                            
                <th class="product-quantity"> العدد</th>                            
                <th class="product-subtotal">الأجمالى</th>                            
                <th class="product-remove">&nbsp; </th>
            </tr>
    </thead>
    <tbody>             
        <div class="hidden"> {{ $total_sum = 0 }}</div>
        @if($data)         
        @foreach($data as $item)
                        <tr class="cart_table_item">
                <div class="hidden"> {{ $total_sum += $item->price*$item->qty }}</div>
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
                <!--<input type="button" class="minus" value="-">-->
                <input type="number" class="input-text qty text" title="Qty" value="{{ $item->qty }}" 
                       name="quantity" min="1" step="1" readonly="">
                <!--<input type="button" class="plus" value="+">-->
        </div>

    </td>
    <td class="product-subtotal">
            <span class="amount"><big><b>{{ $item->price * $item->qty}}</b></big><br>
    <small>ريال</small></span>
            </td>
            <td class="product-remove">
                    <a title="حذف" class="remove product-remove" href="javascript:void(0);">
                            <i class="fa fa-times-circle"></i>
                    </a>
                <input type="hidden" value="{{ $item->id }}" />
            </td>
    </tr>
        @endforeach
        @endif
        
        <thead>
            <tr>                                           
                <th colspan="2" class="product-subtotal">الأجمالى</th>                            
                <th colspan="2" class="product-remove">{{ $total_sum }}ريال</th>
            </tr>
    </thead>
        </table>
  
      </div>
              </div>
          </div>
    
</div>
            
            
        </div><!-- End .cart-table-container -->

 


@endsection
