@extends('master', ['title'=>'اختر عنوان شحن','active'=>'home'])

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-8">
        <div class="cart-table-container">
             
<div class="box-content text-right">
    <div class="hidden"> {{ $total_sum = 0 }} {{ $total_sum_no_fees = 0 }} </div>
        @if($cartItms)         
        @foreach($cartItms as $item)
        <?php  $product = App\product::find($item['product_id']); ?>
         <div class="hidden"> 
            {{ $percentage = (5 / 100) * $product->price }}  
            @if($product->tax == 1)  
                {{ $priceWzPercentage = $percentage+$product->price }}
            @else {{ $priceWzPercentage = $product->price }}
            @endif             
        </div>
            <div class="hidden"> {{ $total_sum_no_fees += $product->price*$item['qty'] }}</div>
            <div class="hidden"> {{ $total_sum += $priceWzPercentage*$item['qty'] }}</div>
        @endforeach
        @endif
        
        <div class="heading mb-4"><h2 class="title">عناوينى </h2></div>
        
        <span>اختر عنوان شحن لتوصيل طلبك من العناوين التالية</span>
        <br/><br/> 
        
        {!! Form::open(array('url'=>'makeOrder','method'=>'POST', 'files'=>true , 'class'=>'')) !!}  
          {{ csrf_field() }}
        <table cellspacing="0" class="table" width="100%">
            <tbody>
                <tr><input type="radio" value="0" name="address" id="addAdd_btn"/> <label for="addAdd_btn">أضف  عنوان جديد</label> <br/><br/></tr>
        <tr> <span> او اختر من عناوين شحنك المضافة بالفعل </span> <br/></tr>
            @if($userAddress)
                @foreach($userAddress as $add)
                <tr class="cart-subtotal">                       
                    <th> <input type="radio" name="address" required="" id="myAdd{{$add->AddID}}" value="{{ $add->AddID }}"/>
                        <label for="myAdd{{$add->AddID}}"> {{ $add->title_ar }} - {{ $add->city_ar }} - {{ $add->postal }} - {{  $add->street }}</label>
                    </th>                                                    
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
       @if($total_sum > 0 )
        @if(Auth::user())
        <p>
            {!! Form::submit('انهاء الشراء', array('class'=>'btn btn-primary btn-block btn-sm')) !!}
        </p>
        @else <p>سجل دخولك واضف للسلة لاستكمال الشراء</p>
        @endif
        @endif
           {!! Form::close() !!}

        
           <div class="addAddress hidden col-lg-12">
            <?php  echo Form::open(['action' => ['CartController@addAddress', Auth::user()->id]
                                ,'files'=>TRUE,'class'=>'form']);  ?>     
          {{ csrf_field() }}                     
           
          <div class="col-xs-6 col-md-4 col-lg-4 form-group">
                 <label>البلد</label>
                 <select name="country" id="country" class = "form-control" required="">
                <option value="0"> -- اختر بلد -- </option>
                @if($countries)
                    @foreach($countries as $item)
                    <option value="{{ $item->id }}">{{ $item->title_ar }}</option>  
                    @endforeach
                @endif
            </select>
          </div>
          <div class="col-xs-6 col-md-4 col-lg-4 form-group">
                 <label>المنطقة</label>
                 <select name="region" id="region" class = "form-control" required="">
                    <option value="0"> -- اختر منطقة -- </option>                 
                </select>
          </div>
          <div class="col-xs-6 col-md-4 col-lg-4 form-group">
                 <label>المدينة</label>
                 <select name="city" id="city" class = "form-control" required="">
                <option value="0"> -- اختر مدينة -- </option>                 
            </select>
          </div>
          
          <div class="col-xs-6 col-md-6 form-group">
                 <label>الرمز البريدى</label>
                {!! Form::input('text','postal',null, array('class'=>'form-control','placeholder'=>'الرمز البريدى')) !!}                  
          </div>
           <div class="col-xs-6 col-md-6 form-group">
                 <label>اسم الشارع  </label>
                {!! Form::input('text','street',null, array('class'=>'form-control','placeholder'=>'اسم الشارع')) !!}                  
          </div>
          <div class="col-sm-12"> 
               {!! Form::submit('حفظ', array('class'=>'btn btn-lg btn-primary btn-block signup-btn')) !!}
               {!! Form::close() !!}  
      </div>
        </div>
           
    
</div>
            
            
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
                        <tr class="cart-subtotal">
                            <th> مجموع  المنتجات   </th>                                
                            <td><span class="amount"><span class="totalProds">{{ $total_sum_no_fees }}</span> ريال</span></td>                                
                        </tr>
                        <tr class="cart-subtotal">
                            <th> مجموع  المنتجات بالقيمة المضافة</th>                                
                            <td><span class="amount" id="prodCount">{{ $total_sum }} </span> ريال</td>                                
                        </tr>
                        <tr class="shipping">
                            <th>التوصيل</th>                                
                            <td><span id="delCost">00.0</span> ريال </td>                                
                        </tr>
                        
                </tbody>
                <tfoot>
                    <tr>
                        <td>اجمالى المجموع</td>
                         <td><span class="amount" id="allCost">{{ $total_sum }} </span> ريال</td>        
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

  


@endsection
