@extends('master', ['title'=>'سلة المشتريات','active'=>'home'])

@section('content')

<div class="container">
<div class="row">
    <div class="col-lg-8">
        <div class="cart-table-container">
            <table class="table table-cart shop_table cart_list">
                <thead>
                    <tr>
                       <th class="product-thumbnail"> المنتجات </th>                            
                        <th class="product-quantity"> العدد</th>                            
                        <th class="product-subtotal">الأجمالى</th>                            
                        <th class="product-remove">حذف </th>
                    </tr>
                </thead>
                <tbody>
                                       
        <div class="hidden"> {{ $total_sum = 0 }} {{ $total_sum_no_fees = 0 }} </div>       
        @if($cartItms)         
        @foreach($cartItms as $index => $item)
        <?php  $product = App\product::find($item['product_id']); ?>
        <div class="hidden"> 
            {{ $percentage = (5 / 100) * $product->price }}  
            @if($product->tax == 1)  
                {{ $priceWzPercentage = $percentage+$product->price }}
                @else {{ $priceWzPercentage = $product->price }}
            @endif             
        </div>
                        <tr class="cart_table_item product-row">
                    <div class="hidden"> {{ $total_sum_no_fees += $product->price*$item['qty'] }}</div>
                <div class="hidden"> {{ $total_sum += $priceWzPercentage*$item['qty'] }}</div>
            <td class="product-thumbnail" width="">
                <a href="{{ url('product') }}/{{ $product->id }}">
                            <img alt="" src="{{ asset('uploads') }}/{{ $product->img }}">
</a>
<div class="pull-left product-title">
    
    <a href="{{ url('product') }}/{{ $product->id }}">{{ $product->title }}</a> <br/>
    @if($product->offer != 0)
        <span class="old-price">{{$product->price}}ريال</span>
        <span class="product-price">{{$product->offer}}ريال</span>
    @else                                    
        <span class="product-price">{{$product->price}}ريال</span>
    @endif
    
</div>
    </td>
    <td class="product-quantity">
        <div class="quantity">
                <!--<input type="button" class="minus" value="-">-->
            <input type="text" class="input-text qty text vertical-quantity form-control" title="Qty" 
                   value="{{ $item['qty'] }}" name="quantity" min="1" step="1">
                <!--<input type="button" class="plus" value="+">-->
        </div>

    </td>
    <td class="product-subtotal">
        <span class="amount"><big><b><span class="qtyItmPrice">{{ $product->price * $item['qty']}}</span></b></big><br>
    <small>ريال</small></span>
            </td>
            <td class="product-remove">
                    <a title="حذف" class="remove product-remove" href="javascript:void(0);">
                            <i class="icon-cancel"></i>
                    </a>
                <input type="hidden" value="{{ $index }}" />
            </td>
    </tr>
        @endforeach
        @endif
            </tbody>
                   

                <tfoot>
                    <tr>
                        <td colspan="4" class="clearfix">
                             <div class="float-left">
                            @if($total_sum > 0 )
                        @if(Auth::user())                       
                            <a href="{{ url('chooseAddress') }}" class="btn btn-outline-secondary">تابع الشراء</a>                                   
                        @else
                        <a href="" class="login text-center log_first">
                            سجل  دخولك   لاستكمال الشراء
                        </a>
                        @endif
                        @endif
                         </div><!-- End .float-left -->
                            

                            <div class="float-right">
                                <!--<a href="#" class="btn btn-outline-secondary btn-clear-cart">مسح الكل</a>-->
                                <a href="{{ url('') }}" class="btn btn-outline-secondary btn-update-cart">أضف منتجات</a>
                            </div><!-- End .float-right -->
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div><!-- End .cart-table-container -->


    </div><!-- End .col-lg-8 -->

    <div class="col-lg-4">
        <div class="cart-summary">
            <h3>كشف حساب</h3>

<!--            <h4>
                <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button" aria-expanded="false" aria-controls="total-estimate-section">حساب تكلفة التوصيل</a>
            </h4>-->

            <div class="collapse" id="total-estimate-section">
                <form action="#">
                    <div class="form-group form-group-sm">
                        <label>المدينة</label>
                        <div class="select-custom">
                            <select class="form-control form-control-sm">
                                <option value="USA">الاسم</option>
                                <option value="Turkey">الاسم</option>
                                <option value="China">الاسم</option>
                                <option value="Germany">الاسم</option>
                            </select>
                        </div><!-- End .select-custom -->
                    </div><!-- End .form-group -->

                    <div class="form-group form-group-sm">
                        <label>المنطقة</label>
                        <div class="select-custom">
                            <select class="form-control form-control-sm">
                                <option value="CA">الاسم</option>
                                <option value="TX">الاسم</option>
                            </select>
                        </div><!-- End .select-custom -->
                    </div><!-- End .form-group -->

                    <div class="form-group form-group-sm">
                        <label>Zip/Postal Code</label>
                        <input type="text" class="form-control form-control-sm">
                    </div><!-- End .form-group -->

                    <div class="form-group form-group-custom-control">
                        <label>Flat Way</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="flat-rate">
                            <label class="custom-control-label" for="flat-rate">Fixed $5.00</label>
                        </div><!-- End .custom-checkbox -->
                    </div><!-- End .form-group -->

                    <div class="form-group form-group-custom-control">
                        <label>Best Rate</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="best-rate">
                            <label class="custom-control-label" for="best-rate">Table Rate $15.00</label>
                        </div><!-- End .custom-checkbox -->
                    </div><!-- End .form-group -->
                </form>
            </div><!-- End #total-estimate-section -->

            <table class="table table-totals">
                <tbody>
                    <tr>
                        <td>المجموع</td>
                        <td><span class="amount"><span class="totalProds">{{ $total_sum_no_fees }}</span> ريال</span></td>
                    </tr>

                    <tr>
                        <td>بالقيمة المضافة</td>
                        <td><span class="amount"><span class="totalProds">{{ $total_sum }}</span> ريال</span></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>اجمالى المجموع</td>
                        <td><span class="amount"><span class="totTotalPrice">{{ $total_sum }}</span> ريال</span></td>
                    </tr>
                </tfoot>
            </table>
            <hr/>
            <p class="text-center"><q>
    تتم اضافة قيمة ضريبية قيمتها 5% على بعض المنتجات 
    </q></p>
        </div><!-- End .cart-summary -->
    </div><!-- End .col-lg-4 -->
</div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->

 



 {!! Form::close() !!}

@endsection
