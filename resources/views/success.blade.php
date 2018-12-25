@extends('master', ['title'=>'تم الطلب بنجاح','active'=>'home'])

@section('content')
 <section class="page-con bg1 portfolio_078">

<div class="container">
<div class="row">
    
    <div class="col-lg-8 text-right">
        
        <h4 class="text-center">
        لقد تم ارسال طلبك بنجاح , يمكنك متابعة طلبك عن طريق الرابط التالى
        <a href="{{ url('track') }}/{{ $my_order->id }}">متابعة الطلب رقم  {{ $my_order->id }}</a>
    </h4>
    <br/><br/>
     <h4> تفاصيل الطلب </h4>
    
        <div class="cart-table-container">
            <table class="table table-cart shop_table cart_list">
                <thead>
                    <tr>
                        <th class="product-thumbnail"> المنتجات </th>                            
                        <th class="product-quantity"> العدد</th>                            
                        <th class="product-subtotal">الأجمالى</th>                                            
                    </tr>
                </thead>
                <tbody>             
        <div class="hidden"> {{ $total_sum = 0 }}</div>
        @if($orderItems)         
        @foreach($orderItems as $item)
                        <tr class="cart_table_item">
                <div class="hidden"> {{ $total_sum += $item->price*$item->qty }}</div>
            <td class="product-thumbnail" width="">
                <a href="{{ url('product') }}/{{ $item->PID }}">
                            <img alt="" src="{{ asset('uploads') }}/{{ $item->img }}">
</a>
<div class="pull-left">
    <!--<p><a href="">Cat</a></p>-->
    <h3><a href="{{ url('product') }}/{{ $item->PID }}">{{ $item->title }}</a></h3>
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
            
    </tr>
        @endforeach
        @endif
            </tbody>

                 
            </table>
        </div><!-- End .cart-table-container -->


    </div><!-- End .col-lg-8 -->
    
    
    
    <div class="col-lg-4">
        <div class="cart-summary">
            <h3>فاتورة الشراء  </h3>
 
            <table class="table table-totals">
                <tbody>
                <tr class="cart-subtotal">
                    <th> مجموع كل المنتجات</th>                                
                    <td><span class="amount">{{ $total_sum }} ريال</span></td>                                
                </tr>
                <tr class="shipping">
                    <th>التوصيل</th>                                
                    <td>00.00</td>                                
                </tr>                
        </tbody>
                <tfoot>
                    <tr>
                        <td>اجمالى المجموع</td>
                        <td><span class="amount">{{ $total_sum }} ريال</span></td>  
                    </tr>
                </tfoot>
            </table>
            <hr/>
            <p class="text-center"><q>
    تتم اضافة قيمة ضريبية قيمتها 5% على بعض المنتجات 
    </q></p>
    
    <p><a href="{{ url('') }}"  class="btn btn-grey btn-block btn-sm" data-loading-text="Loading...">تسوق المزيد</a></p>
        </div><!-- End .cart-summary -->
    </div><!-- End .col-lg-4 -->
    




</div>
</div>
</section>


@endsection
