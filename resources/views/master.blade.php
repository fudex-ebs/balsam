<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>  {{$title}} | صيدليات البلسم الطبى</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/icons/favicon.ico')}}">
    
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('asset/css/style.min.css')}}">
    <link rel="stylesheet"  href="{{asset('asset/css/dev.css')}}"/>
</head>
<body>
    <div class="page-wrapper">
        <header class="header header-transparent">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <a href="{{ url('') }}" class="logo">
                            <img src="{{asset('asset/images/logo.png')}}" alt="البلسم الطبى">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="row header-row header-row-top">                             
                              @if(! Auth::guest())
                            <div class="header-dropdown dropdown-expanded">                               
                                <a href="#">لوحة التحكم</a>
                                <div class="header-menu">
                                    <ul>
                                        <li><a href="{{ url('profile') }}"> <i class="icon-user"></i> حسابى </a></li>
                                        <li><a href="{{ url('addresses') }}"><i class="icon-map-marker-alt"></i> عناوينى </a></li>
                                        <li><a href="{{ url('follow_order') }}"><i class="icon-eye-open"></i> متابعة طلباتى </a></li>
                                        <li><a href="{{ url('shipping') }}"><i class="icon-shopping-cart"></i> مشترياتى</a></li>
                                        <li><a href="{{ url('logout') }}"><i class="icon-signout"></i> خروج</a></li>
                                        <li><a href="{{ url('favourite') }}"><i class="icon-heart-1"></i> المفضلة </a></li>                                                                                    
                                    </ul>
                                </div><!-- End .header-menu -->                                                                 
                            </div><!-- End .header-dropown -->
                            @else
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="loginLnk"><i class="icon-user"></i>  دخول</a>
                            @endif
                            <div class="header-search">
                                <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                                <div class="header-search-wrapper">
                                    <form method="get" action="{{ url('search') }}">
                                        <input type="search" class="form-control" name="textSearch" id="textSearch" placeholder="بحث ..." required>
                                        <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                                    </form>
                                </div><!-- End .header-search-wrapper -->
                            </div><!-- End .header-search -->
                        </div><!-- End .header-row -->

                        <div class="row header-row header-row-bottom">
                            <nav class="main-nav">
                                <ul class="menu sf-arrows">
                                    <li class="active"><a href="{{url('')}}">الرئيسية</a></li>
                                    <li>
                                        <a href="#" class="sf-with-ul">المنتجات  </a>
                                         <ul >
                                                @if($cats)
                                   @foreach($cats as $cat)    
                                               <li>
                                                    <a href="{{ url('category') }}/{{ $cat->id }}">{{$cat->title}}  </a>
                                                    <ul>
                                                       @if($subCats)
                                               @foreach($subCats as $sub)
                                                    @if($cat->id == $sub->parent)  
                                                    <li>                                   
                                                        <a href="{{ url('subcategory') }}/{{ $sub->id }}"> {{ $sub->title }}</a>                                                                        
                                                        <ul>                                      
                                                            @foreach($subSubCats as $subSubCat)
                                                              @if( $sub->id == $subSubCat->sub_parent)
                                                            <li><a href="{{ url('subcategory') }}/{{ $subSubCat->id }}">{{ $subSubCat->title }}</a></li>
                                                              @endif
                                                            @endforeach
                                                        </ul>                                
                                                    </li>                                    
                                                    @endif
                                                @endforeach
                                            @endif
                                            <li style="border-top: 1px solid #C0C0C0">
                                                <a href="{{ url('category') }}/{{$cat->id}}">شاهد منتجات التصنيف</a></li>
                                                    </ul>
                                            </li>                                         
                                       @endforeach
                                          @endif
                                           </ul>
                                    </li>
                                    <li>
                                        <a href="#l" class="sf-with-ul">المقالات  </a>
                                        <div class="megamenu megamenu-fixed-width">                                            
                                            <div class="menu-title">
                                                <a href="#">جديد البلسم  <span class="tip tip-new">جديد!</span></a>
                                            </div>
                                            <ul>                                                                
                                            @if($latest_articles)
                                            @foreach($latest_articles as $article)
                                            <li><a href="{{ url('article') }}/{{ $article->id }}">
                                                 {{ str_limit($article->title, $limit = 30, $end = '...') }}     
                                                </a></li>                                        
                                            @endforeach
                                            @endif
                                                <hr/>
                                                <li><a href="{{ url('articles') }}">شاهد المزيد</a></li>
                                            </ul>    
                                        </div><!-- End .megamenu -->
                                    </li>
                                 
                                    
                                    <li><a href="{{ url('offers') }}">العروض</a></li>
                                    <li><a href="{{ url('about') }}">عن البلسم</a></li>
                                    <li><a href="{{ url('complaints') }}">  الشكاوى</a></li>
                                    <li><a href="{{ url('contact') }}">اتصل بنا</a></li>                                    
                                </ul>
                            </nav>
                           <button class="mobile-menu-toggler" type="button">
                                <i class="icon-menu"></i>
                            </button>

                             
                            <div class="dropdown cart-dropdown">
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <span class="dropdown-cart-icon">
                                    @if($cart)
                                        <span class="cart-count" id="cart">{{ count($cart) }}</span>
                                    @endif
                                    </span>
                                    <span class="dropdown-cart-text">المشتريات</span>
                                </a>

                                <div class="dropdown-menu" >
                                    <div class="dropdownmenu-wrapper">
                                        <div class="dropdown-cart-products cart_list">
                                              <div class="hidden"> {{ $total_sum = 0 }}</div>
              <div class="cartAppend"></div>
               <?php            
                     if($cart){
                    foreach ($cart as $index => $item ) {                        
                    $product = App\product::find($item['product_id']);                                        
                ?>    
                    <div class="product">
                        <div class="hidden"> {{ $total_sum += $product->price*$item['qty'] }}</div>
                        <figure class="product-image-container">
                            <a href="{{ url('product') }}/{{ $item['product_id'] }}" class="product-image">
                                <img src="{{ asset('uploads') }}/{{ $product->img }}" alt="{{ $product->title }}">
                            </a>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-title"><a href="{{ url('product') }}/{{ $item['product_id'] }}">{{ $product->title }}</a></h4>                            
                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{ $item['qty'] }}</span>
                                 <span class="singlePrice">{{ $product->price }}</span>  ريال
                                <span>سعر الكمية : <span class="prdsPrice">{{ $product->price * $item['qty']}}</span> ريال</span>
                            </span>
                        </div><!-- End .product-details -->
                        <a href="javascript:void(0);" class="btn-remove product-remove" title="Remove"><i class="icon-cancel"></i></a>
                        <input type="hidden" value="{{ $index }}" />
                    </div><!-- End .product -->
                <?php }}?>  
                                            
                                        </div><!-- End .cart-product -->

                                        <div class="dropdown-cart-total">
                                            <span>المجموع:</span>

                                            <span class="cart-total-price"><span class="totalPrice">{{ $total_sum }}</span> ريال</span>
                                        </div><!-- End .dropdown-cart-total -->

                                        <div class="dropdown-cart-action">
                                            <a href="{{ url('cart') }}" class="btn btn-primary">سلة المشتريات  </a>
                                            @if(Auth::user()) <a href="{{ url('chooseAddress') }}" class="btn btn-outline-primary">شراء</a>@endif
                                        </div><!-- End .dropdown-cart-total -->
                                    </div><!-- End .dropdownmenu-wrapper -->
                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .dropdown -->
                        </div><!-- End .header-row -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main">
             @if (Route::getCurrentRoute()->uri() != '/') 
            <nav aria-label="breadcrumb" class="breadcrumb-nav padd-newpage">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}}"><i class="icon-home"></i> الرئيسية </a></li>
                        @if (Route::getCurrentRoute()->uri() == 'subcategory/{subcategory}' ||
        Route::getCurrentRoute()->uri() == 'product/{item}')      
    <li class="breadcrumb-item"><a href="{{ url('category') }}/{{ $parent->id}}">{{ $parent->title}}</a></li>  
        
           @if(isset($subcategory1)) @if($subcategory1) <li class="breadcrumb-item"><a href="{{ url('subcategory') }}/{{ $subcategory1->id}}"> {{ $subcategory1->title}} </a></li> @endif @endif
            
            @if(isset($subcategory2))
            @if($subcategory2)
                @if($subcategory1->id != $subcategory2->id )
                <li class="breadcrumb-item"><a href="{{ url('subcategory') }}/{{ $subcategory2->id}}">{{ $subcategory2->title}} </a></li> 
            @endif @endif @endif
      
  @endif
                        <!--<li class="breadcrumb-item active" aria-current="page">{{$title}}  </li>-->
                    </ol>
                </div><!-- End .container -->
            </nav>
             @endif
         @yield('content')
             
        </main><!-- End .main -->



        <footer class="footer">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                            <div class="col-md-3">

                              <img  class="mt-5" src="{{asset('asset/images/Vision_2030.png')}}" />      
                            </div>
 
                                <div class="col-md-8">

                                    <div class="widget">
                                        <h4 class="widget-title">تصفح أقسامنا</h4>
                                        <ul class="links">
                                            @if($cats)
                                                @foreach($cats as $cat)
                                                <li><a href="{{url('category')}}/{{$cat->id}}">{{$cat->title}}</a></li>
                                                @endforeach
                                            @endif  
                                        </ul>
                                    </div><!-- End .widget -->
                                </div>
                                   
                                </div><!-- End .col-md-3 -->
                                </div>
                           



<div class="col-md-3">
        <div class="widget">
            <h4 class="widget-title">أتصل بنا</h4>
            <ul class="contact-info">
                <li>
                    <i class="icon-direction"></i>
                    <span class="contact-info-label">العنوان:</span> {{$address->value}}
                </li>
                <li>
                    <i class="icon-phone-1"></i>
                    <span class="contact-info-label">الهاتف:</span>  <a href="tel:{{$mobile->value}}">{{$mobile->value}}</a>
                </li>
                <li>
                    <i class="icon-envolope"></i>
                    <span class="contact-info-label">البريد:</span> <a href="mailto:{{$email->value}}">{{$email->value}}</a>
                </li>
                <li>
                    <i class="icon-clock-1"></i>
                    <span class="contact-info-label">ساعات العمل:</span>
                    Mon - Sun / 9:00AM - 8:00PM
                </li>
            </ul>
        </div><!-- End .widget -->
    </div><!-- End .col-lg-3 -->
            




                                <div class="col-md-3">
                                    <div class="widget widget-newsletter">
                                        <h4 class="widget-title">النشرة البريدية</h4>

                                        <p>تابع جديد البلسم بالاشتراك فى نشرتنا الاخبارية</p>

                                        <form method="post" action="{{url('newsletter')}}" >
                                             {{ csrf_field() }}
                                             <input type="email" name="emailNewsLetter" class="form-control" placeholder="البريد الالكترونى" 
                                                    required oninvalid="this.setCustomValidity('من فضلك أدخل بريدك الالكترونى')" oninput='setCustomValidity("")' >
                                            <input type="submit" class="btn" value=" أشترك">
                                        </form>
                                    </div><!-- End .widget -->
                                </div><!-- End .col-md-4 -->
                         
                    </div><!-- End .row -->
                </div><!-- End .container -->


                <section class="footer-bottom">
                <div class="container">
                        <div class="row">
                        <p class="footer-copyright">
                              &copy; جميع الحقوق محفوظة  {{ date('Y')}} - تطوير <a href="http://fudex.com.sa/" target="_blank">فيودكس</a><br>							
                        </p>                   
                        <div class="social-icons">
                            @if($socialLinks)
                                @foreach($socialLinks as $link)
                                <a class="social-icon" title="{{$link->site}}" href="{{$link->value}}" target="_blank"><i class="icon-{{$link->site}}"></i></a>
                                @endforeach
                            @endif                            
                        </div><!-- End .social-icons -->
                    </div>
                </div>
                </section><!-- End .footer-bottom -->

            </div><!-- End .footer-middle -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active"><a href="{{url('')}}">الرئيسية</a></li>
                    <li><a href="{{url('about')}}">عن البلسم</a> </li>
                    <li><a href="{{url('products')}}">المنتجات</a> </li>
                    <li><a href="{{url('offers')}}">العروض</a></li>   
                    <li><a href="{{url('articles')}}">المقالات</a></li>                                     
                    <li><a href="{{url('contact')}}">اتصل بنا</a></li>  
                    <li><a href="{{url('complaints')}}">  الشكاوى والاستفسارات</a></li>                      
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                @if($socialLinks)
                    @foreach($socialLinks as $link)
                    <a class="social-icon" title="{{$link->site}}" href="{{$link->value}}" target="_blank"><i class="icon-{{$link->site}}"></i></a>
                    @endforeach
                @endif                  
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

   


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-body">
                 

<div class="modal-wrapper">
        <div class="container text-right">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title mb-2">تسجيل دخول</h2>

                    <form action="{{ url('/login') }}" method="post" class="mb-1">
                         {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="login-email">البريد الالكترونى <span class="required">*</span></label>
                            <input type="email" class="form-input form-wide mb-2" id="email" name="email" required />
                             @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>                                    
                             @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="login-password">كلمة السر <span class="required">*</span></label>
                            <input type="password" class="form-input form-wide mb-2" id="password" name="password" required />
                            @if ($errors->has('password'))
                                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>                                    
                            @endif
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-md">دخول</button>

                            <div class="custom-control custom-checkbox form-footer-right">
                                <input type="checkbox" class="custom-control-input" id="lost-password">
                                <label class="custom-control-label form-footer-right" for="lost-password">تذكرنى</label>
                            </div>
                        </div><!-- End .form-footer -->
                        <a data-toggle="modal" href="login.html#myModal" class="forget-password"> فقدت كلمة السر؟</a>
                        <a href="{{ url('register') }}" class="forget-password float-left"> ليس لديك حساب؟</a>
                    </form>
                </div><!-- End .col-md-6 -->


            </div><!-- End .row -->
        </div><!-- End .container -->
                        
                           
                            
                        </div>
                  
                    </div>
              </div>
            </div>
          </div>



    
    
        <!-- Modal -->
         <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">                       
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">نسيت كلمة المرور</h4>
                      </div>
                    <div class="col-md-12">
                      <div class="modal-body form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <p>ادخل بريدك الالكترونى لاسترجاع كلمة المرور</p>
                          <input type="email" id="email" name="email" placeholder="البريد الالكترونى" autocomplete="off" 
                                 class="form-control placeholder-no-fix" value="{{ old('email') }}" required="">
                             @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                      </div>
                    </div>
                      <div class="modal-footer">
                          <button class="btn btn-default" type="submit">استرجاع</button>
                          <button data-dismiss="modal" class="btn btn-theme" type="button">الغاء</button>                          
                      </div>
                  </div>
              </div>
          </div>
         </form>
          <!-- modal -->
         
@if(count($errors) >0 || $message = Session::get('success'))
<div class="modal fade" id="myMsgPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
          @if(count($errors) >0)
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>	
              <ul>
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
          @endif
      </div>
       
    </div>
  </div>
</div>
@endif 



    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('asset/js/plugins.min.js')}}"></script>

    <script src="{{asset('asset/js/ekko.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('asset/js/main.min.js')}}"></script>

    <script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
    </script>
    
    <link rel="stylesheet"  href="{{asset('asset/growl/jquery.growl.css')}}"/>
    <script src="{{asset('asset/growl/jquery.growl.js')}}"></script>
    <script>
$(".prodLst").find(".addToCart").click(function(){     
//    localStorage.clear();
    var flag =0;
    var prod_id = $(this).next().val();      
    var quantity = 1;        
      console.log(prod_id);
      
    var user_id = 0;
      @if(Auth::guest()) user_id = 0; @else user_id = {{ Auth::user()->id }}; @endif                             
    var _token = "{{ csrf_token() }}";        
          
    $.ajax({        
        type: 'POST',
        url: "{{ url('add_tocart') }}",
        data: { prod_id: prod_id,  _token:_token ,user_id:user_id ,quantity:quantity  },
        success: function(response) {            
            if(response){               
//                var itemsCount = JSON.parse(response);
//                itemsCount = itemsCount.length;                
                $("#cart").html(response);
                $("#cart_resp").html(response);                                
                     
                $.growl.notice({ title: "نجاح", message: "لقد تمت الاضافة لسلة الشراء" });
                
                $.get("{{ url('append_cart_items') }}/"+prod_id, function(getRow){
                      $( ".cartAppend" ).append( getRow );
                });
            }else
                $.growl.warning({ title: "تنبيه", message: "لقد حدث خطأ أثناء الاضافة" });
        }
    });
    
});


$("#add_tocart").click(function (){
    var user_id = 0;
      @if(Auth::guest()) user_id = 0; @else user_id = {{ Auth::user()->id }}; @endif          
        
    var prod_id = $("#item_id").val();
    var _token = "{{ csrf_token() }}";        
    var quantity = $("#quantity").val();
     
    $.ajax({
        type: 'POST',
        url: "{{ url('add_tocart') }}",
        data: { prod_id: prod_id,  _token:_token ,user_id:user_id ,quantity:quantity  },
        success: function(response) {  
//            var itemsCount = JSON.parse(response);
//            itemsCount = itemsCount.length;
                
            if(response){
                $("#cart").html(response);
                $("#cart_resp").html(response);
                    
                $.growl.notice({ title: "نجاح", message: "لقد تمت الاضافة لسلة الشراء" });
                 $.get("{{ url('append_cart_items') }}/"+prod_id, function(getRow){
                      $( ".cartAppend" ).append( getRow );
                });
            }else
                $.growl.warning({ title: "تنبيه", message: "لقد حدث خطأ أثناء الاضافة" });
        }
    });

});
  
$(".cart_list").find(".product-remove").click(function(e){
      e.stopPropagation();
    var _token = "{{ csrf_token() }}";  
    var item = $(this).next().val();      
     
    
    var user_id = 0;
      @if(Auth::guest()) user_id = 0; @else user_id = {{ Auth::user()->id }}; @endif          
//     var price = $(this).closest("tr").find(".unit_price").text();
//     var q = $(this).closest("tr").find(".quantity").val();

//    var mince = price*q;
//    var total =  $('.total_price').html();                      
//    $(".total_price").html(total-mince);

    var totalPrice = $(".totalPrice").html();
    var singlePrice = $(this).closest("li").find(".prdsPrice").html();
    var newPrice = parseFloat(totalPrice) - parseFloat(singlePrice);
                
    //------- cart page -----
    var totalProds = $(".totalProds").html();
    var singlePrice = $(this).closest("tr").find(".qtyItmPrice").html();
    var prodsItemPrice = parseFloat(totalProds) - parseFloat(singlePrice);
        
     $.ajax({
             type: 'post',
             url: "{{ url('removeFromCart/"+item+"') }}",
             data: { id: item ,user_id:user_id, _token:_token },
             success: function(response) {                  
                 console.log(response);
//                 
//                var itemsCount = JSON.parse(response);
//                itemsCount = itemsCount.length;                 
//                $("#cart").html(itemsCount);

                $("#cart").html(response);
                $("#cart_resp").html(response);
                
                $(".totalPrice").html(newPrice);
                $(".totalProds").html(prodsItemPrice);
                $(".totTotalPrice").html(prodsItemPrice);
             }
         });
    $(this).closest('div').remove(); 
    $(this).closest('tr').remove(); 
 });
   
   

$(".prodLst").find(".addToFav").click(function(){     
    var user_id = 0;
      @if(Auth::guest()) user_id = 0; @else user_id = {{ Auth::user()->id }}; @endif          
                
    var prod_id = $(this).prev().val();      
    var _token = "{{ csrf_token() }}";            
    
    @if(Auth::user())
    $.ajax({
        type: 'POST',
        url: "{{ url('add_tofav') }}",
        data: { prod_id: prod_id,  _token:_token ,user_id:user_id },
        success: function(response) {            
            if(response > 0){
                $("#fav").html(response);
                $.growl.notice({ title: "نجاح", message: "لقد تمت الاضافة  لقائمة المفضلة" });
            }else
                $.growl.warning({ title: "تنبيه", message: "لقد حدث خطأ أثناء الاضافة" });
        }
    });
    @else  $.growl.warning({ title: "تنبيه", message: "من فضلك قم بتسجيل الدخول أولا!" });
    @endif
});
 
$(".cart_list").find(".fav-remove").click(function(){ 
    var _token = "{{ csrf_token() }}";  
    var item = $(this).next().val();      
     $.ajax({
             type: 'post',
             url: "{{ url('removeFromFav/"+item+"') }}",
             data: { id: item , _token:_token },
             success: function(response) {
//                 $('.red_cart').html(response);
//                 $(".total_price").html(total-mince);
//                 $(".prods_cost").html(total-mince);
             }
         });
//
     $(this).closest('li').remove(); 
      $(this).closest('tr').remove(); 
 });
 
 $("#add_tofav").click(function (){
    var user_id = 0;
      @if(Auth::guest()) user_id = 0; @else user_id = {{ Auth::user()->id }}; @endif          
        
    var prod_id = $("#item_id").val();
    var _token = "{{ csrf_token() }}";           
    
    @if(Auth::user())
    $.ajax({
        type: 'POST',
        url: "{{ url('add_tofav') }}",
        data: { prod_id: prod_id,  _token:_token ,user_id:user_id },
        success: function(response) {            
            if(response > 0){
                $("#fav").html(response);
                $.growl.notice({ title: "نجاح", message: "لقد تمت الاضافة لقائمة المفضلة" });
            }else
                $.growl.warning({ title: "تنبيه", message: "لقد حدث خطأ أثناء الاضافة" });
        }
    });

    @else  $.growl.warning({ title: "تنبيه", message: "من فضلك قم بتسجيل الدخول أولا!" });
    @endif
});


$("#country").change(function (){    
    var _token = "{{ csrf_token() }}"; 
    var country = $(this).val();    
    $.ajax({
        type: 'POST',
        url: "{{ url('getRegions') }}",
        data: {  _token:_token ,country:country },
        success: function(response) {                        
            $("#region").html(response);            
        }
    });    
});

$("#region").change(function (){
    var _token = "{{ csrf_token() }}"; 
    var region = $(this).val();    
    $.ajax({
        type: 'POST',
        url: "{{ url('getCities') }}",
        data: {  _token:_token ,region:region },
        success: function(response) {                    
            $("#city").html(response);            
        }
    });    
});

$("input:radio[name=address]").click(function (){   
    var add = $(this).val();
    if(add == 0)   $(".addAddress").removeClass('hidden'); 
    else  $(".addAddress").addClass('hidden'); 
    
     var _token = "{{ csrf_token() }}"; 
      $.ajax({
        type: 'POST',
        url: "{{ url('getDeliveryCost') }}",
        data: {  _token:_token ,address:add },
        success: function(response) {             
            $("#delCost").html(response);            
            var delCost = $("#delCost").html();
            var prodCount = $("#prodCount").html();
            var allCost = parseFloat(delCost) + parseFloat(prodCount);
            $("#allCost").html(allCost);
        }
    }); 
       
});

$('#myMsgPop').modal();
</script>

</body>
</html>