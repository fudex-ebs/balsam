@extends('master', ['title'=>'قائمة المفضلة','active'=>'home'])

@section('content')
 <div class="container">
<div class="row">
    <div class="col-lg-3">
        <div class="cart-summary">            
            @include('include/user_menu',['active_user'=>''])	
        </div>
    </div>
    <div class="col-lg-9">
        <div class="cart-table-container">
             
<div class="box-content text-right">
  <h2>المفضلة    </h2><br>
   <table dir="rtl" cellspacing="0" class="shop_table cart_list table table-hover" width="100%">
    <thead>
            <tr>
                <th class="product-thumbnail"> المنتجات </th>                            
                <th class="product-quantity"> السعر</th>                                                               
                <th class="product-remove">حذف </th>
            </tr>
    </thead>
    <tbody>             
        <div class="hidden"> {{ $total_sum = 0 }}</div>
        @if($fav_items)         
        @foreach($fav_items as $item)
                        <tr class="cart_table_item">
                <div class="hidden"> {{ $total_sum += $item->price}}</div>
            <td class="product-thumbnail" width="">
                <a href="{{ url('product') }}/{{ $item->prod_id }}">
                            <img alt="" src="{{ asset('uploads') }}/{{ $item->img }}">
</a>
<div class="pull-left">    
    <a href="{{ url('product') }}/{{ $item->prod_id }}">{{ $item->title }}</a>
    <p class="product-price">
            <span class="amount">{{ $item->price }} ريال</span>
    </p>
            </div>
    </td>    
    <td class="product-subtotal">
            <span class="amount"><big><b>{{ $item->price }}</b></big><br>
    <small>ريال</small></span>
            </td>
            <td class="product-remove">
                    <a title="حذف" class="remove fav-remove" href="javascript:void(0);">
                            <i class="icon-cancel"></i>
                    </a>
                <input type="hidden" value="{{ $item->favID }}" />
            </td>
    </tr>
        @endforeach
        @endif
        </table>   
  
      </div>
              </div>
          </div>
    
</div>
            
            
        </div><!-- End .cart-table-container -->
 

@endsection
