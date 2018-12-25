<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta id="vpw" name="viewport" content="width=device-width, initial-scale=1">
	<title>  {{$title}} | صيدليات البلسم الطبى</title>
        <link rel="shortcut icon" href="{{asset('asset/img/favicon.png')}}"> 
	<!-- css -->
	<link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('asset/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('asset/css/mainSlider.min.css')}}" rel="stylesheet">
        <link href="{{asset('asset/css/animate.min.css')}}" rel="stylesheet">
        <link rel="stylesheet"  href="{{asset('asset/css/lightslider.css')}}"/>

        <link href="{{asset('asset/css/Balsam-style.css')}}" rel="stylesheet">
        <link rel="stylesheet"  href="{{asset('asset/css/dev.css')}}"/>
        
        <link rel="stylesheet"  href="{{asset('asset/css/xzoom.css')}}" media="all"/>
       
</head>

<body cz-shortcut-listen="true">
<header >
			
<div class="blur"></div>
<div id="top" style="margin-top:-6px;">
    <div class="container">        
            <ul class="nav nav-pills nav-top navbar-right">
                <li class="exper-span"><span>اطلاق تجريبي  </span></li>
 <li>
                            <a href="{{ url('about') }}">عن البلسم</a>
                            </li>
 <li>
                            <a href="{{ url('contact') }}">اتصل  بنا</a>
                            </li>

                    <!--<li class="langs"><a href="#"><img src="{{asset('asset/img/en.gif')}}" alt="English"></a></li>-->                                                        
        @if(! Auth::guest())
        <li class="dropdown my-account">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">حسابى <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('profile') }}">لوحة التحكم</a></li>
                        <li><a href="{{ url('addresses') }}">عناوينى</a></li>
                        <li><a href="{{ url('follow_order') }}">متابعة الطلبات</a></li>
                        <li><a href="{{ url('shipping') }}">مشترياتى</a></li>
                        <li><a href="{{ url('logout') }}">تسجيل خروج</a></li>
                </ul>
        </li>
        @endif
         @if(Auth::guest())
            <li class="login"><a href="javascript:void(0);"><i class="fa fa-user"></i></a></li>
        @endif
        <!-- <li class="search">
           <a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-search"></i></a> 
            <input type="text" placeholder="بحث" class="form-control"/>
            </li>-->
<li>
    <form class="form-inline form-search" role="search" method="get" action="{{ url('search') }}">
					<div class="form-group">
						<label class="sr-only" for="textsearch">أدخل كلمة البحث</label>
                                                <input style="background: rgba(255, 255, 255, 0.63);" type="search" class="form-control" id="textSearch" required=""
                                                       name="textSearch" placeholder="أدخل كلمة البحث">
					</div>
					<button type="submit" class="btn btn-white" style="    height: 34px"><i class="fa fa-search"></i></button>
				</form>
    
</li>


        <li class="dropdown menu-shop visible-sm visible-xs">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <span class="shopping-bag" id="cart_resp">{{ count($cart) }}</span> سلة التسوق <i class="fa fa-shopping-cart"></i> </a>
                                        <div class="dropdown-menu dropdown-menu-right">                                            
                                                <ul class="list-unstyled list-thumbs-pro cart_list">
                                                    <div class="hidden"> {{ $total_sum=0 }}</div>                                                    
            @if($cart_items)          
                @foreach($cart_items as $item) 
               
                <li class="product">
                     <div class="hidden"> {{ $total_sum += $item->price*$item->qty }}</div>
                        <div class="product-thumb-info">
                                <a href="javascript:void(0);" class="product-remove"><i class="fa fa-trash-o"></i></a>
                                <input type="hidden" value="{{ $item->id }}" />
                                <div class="product-thumb-info-image">
                                        <a href="{{ url('product') }}/{{ $item->prod_id }}">
                                            <img alt="" width="60" src="{{ asset('uploads') }}/{{ $item->img }}"></a>
                                </div>
                                <div class="product-thumb-info-content"> 
                                    <h4><a href="{{ url('product') }}/{{ $item->prod_id }}">{{ $item->title }}</a></h4>
                                        <span class="price">العدد: {{ $item->qty }}</span> <span class="price">السعر: {{ $item->price }} ريال</span>
                                </div>
                        </div>
                </li>
                 
                @endforeach
             @endif 
             
                    </ul> 
                        <ul class="list-inline cart-subtotals text-center">
                                <li class="cart-subtotal"><strong>المجموع</strong></li>
                                <li class="price"><strong><span class="amount">{{ $total_sum }} ريال</span></strong></li>
                        </ul>
                        <div class="cart-buttons">
                                <button class="btn btn-success btn-block" onclick="location.href='{{ url('cart') }}'">سلة المشتريات</button>
                            @if(Auth::user())    <button class="btn btn-primary btn-block" onclick="location.href='{{ url('chooseAddress') }}'">انهاء الشراء</button>@endif
                        </div>
                </div>
        </li>


       <li>

       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span> 
          <span class="icon-bar"></span> 
          <span class="icon-bar"></span> 
          </button>

       </li> 

                        </ul>
                </div>
        </div>
        <nav class="navbar navbar-default navbar-main navbar-main-slide" role="navigation">
                <div class="container">
                        <div class="navbar-header">

                                <a class="logo" href="{{ url('') }}">
                                    <img src="{{asset('asset/img/logo.png')}}" alt="صيدليات البلسم الطبى" title="صيدليات البلسم الطبى  "></a> </div>

                        <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav pull-right">
                                        <li class="@if($active == 'home') active @endif"><a href="{{ url('') }}" >الرئيسية</a>
                                        </li>
         <li class="dropdown @if($active == 'products') active @endif"><a href="#" class="dropdown-toggle" data-toggle="dropdown">المنتجات</a>
                <ul class="dropdown-menu">
                     @if($cats)
        @foreach($cats as $cat)    
                    <li class="dropdown-submenu">
                                <a href="{{ url('category') }}/{{ $cat->id }}">{{$cat->title}}  </a>
                                <ul class="dropdown-menu">
                                   @if($subCats)
                           @foreach($subCats as $sub)
                                @if($cat->id == $sub->parent)  
                                
                                <li class="dropdown-submenu">                                   
                                    <a href="{{ url('subcategory') }}/{{ $sub->id }}"> {{ $sub->title }}</a>                                                                        
                                    <ul class="dropdown-menu">                                      
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
        
        <li class="dropdown @if($active == 'articles') active @endif"><a href="#" class="dropdown-toggle" data-toggle="dropdown">المقالات</a>
                <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                                <a href="#">أحدث المقالات</a>
                                <ul class="dropdown-menu">
                                    @if($latest_articles)
                @foreach($latest_articles as $article)
                <li><a href="{{ url('article') }}/{{ $article->id }}">
                     {{ str_limit($article->title, $limit = 30, $end = '...') }}     
                    </a></li>                                        
                @endforeach
                @endif
                                </ul>
                        </li>                        
                        <li><a href="{{ url('articles') }}">شاهد المزيد</a></li>
                </ul>
        </li>
        <li class="dropdown @if($active == 'offers') active @endif"><a href="{{ url('offers') }}">العروض</a>
            

        </li>




            <li class="dropdown menu-shop visible-md visible-lg">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <span class="shopping-bag" id="cart">{{ count($cart) }}</span> سلة التسوق <i class="fa fa-shopping-cart"></i> </a>
<div class="dropdown-menu dropdown-menu-right">
        <ul class="list-unstyled list-thumbs-pro cart_list">
              <div class="hidden"> {{ $total_sum = 0 }}</div>
              <li class="product cartAppend"></li>
               <?php            
                     if($cart){
                    foreach ($cart as $index => $item ) {                        
                    $product = App\product::find($item['product_id']);                                        
                ?>                
                <li class="product">
                     <div class="hidden"> {{ $total_sum += $product->price*$item['qty'] }}</div>
                        <div class="product-thumb-info">
                                <a href="javascript:void(0);" class="product-remove"><i class="fa fa-trash-o"></i></a>
                                <input type="hidden" value="{{ $index }}" />
                                <div class="product-thumb-info-image">
                                        <a href="{{ url('product') }}/{{ $item['product_id'] }}">
                                            <img alt="" width="60" src="{{ asset('uploads') }}/{{ $product->img }}"></a>
                                </div>

                                <div class="product-thumb-info-content">
                                    <h4><a href="{{ url('product') }}/{{ $item['product_id'] }}">{{ $product->title }}</a></h4>
                                    <span class="price">العدد: {{ $item['qty'] }}</span> <span class="price">السعر: 
                                        <span class="singlePrice">{{ $product->price }}</span> ريال</span>
                                        <span>سعر الكمية : <span class="prdsPrice">{{ $product->price * $item['qty']}}</span> ريال</span>
                                </div>
                        </div>
                </li>
                    <?php }}?> 

        </ul>
        <ul class="list-inline cart-subtotals text-center">
                <li class="cart-subtotal"><strong>المجموع</strong></li>
                <li class="price"><strong><span class="amount total"><span class="totalPrice">{{ $total_sum }}</span> ريال</span></strong></li>
        </ul>
        <div class="cart-buttons">
            <button class="btn btn-success btn-block" onclick="location.href='{{ url('cart') }}'">سلة المشتريات</button>
               @if(Auth::user())  <button class="btn btn-primary btn-block" onclick="location.href='{{ url('chooseAddress') }}'"> انهاء الشراء</button>@endif
        </div>
</div>
</li>
<li><a href="{{ url('favourite') }}"><span class="shopping-bag" id="fav">{{ count($favs) }}</span>
        المفضلة  <i class="fa fa-heart"></i></a></li>



                                </ul>
                        </div><!--/.nav-collapse --> 
                </div><!--/.container-fluid --> 
        </nav>

 
           	<!-- Begin Login -->
		<div class="login-wrapper">
        <span class="login">
        <a href="javascript:void(0);" class="pull-right"><span class="fa fa-close"></span></a>
        </span>
			
    <form id="form-login" role="form" action="{{ url('/login') }}" method="post">
        {{ csrf_field() }}
        <h4>تسجيل دخول</h4>
        <p>يمكن انشاء حساب جديد مجانا!</p>
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">  البريد </label>
                <input type="email" name="email" class="form-control input-lg" id="email" placeholder="البريد الالكترونى">
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">كلمة المرور</label>
                <input type="password" name="password" class="form-control input-lg" id="password" placeholder="كلمة المرور">
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
        </div>
        <ul class="list-inline">
                <li><a href="{{ url('register') }}">انشاء  حساب جديد</a></li>
                <li><a data-toggle="modal" href="login.html#myModal">تذكر كلمة المرور</a></li>
        </ul>
        <button type="submit" class="btn btn-default">تسجيل دخول</button>
    </form>
		</div>
		<!-- End Login -->
             
		</header>
    @if (Route::getCurrentRoute()->uri() != '/') 
    <section class="main-slider">


<div class="mainpageh">    
    <div class="pagetitle">    
   		 <div class="container">
    		<div class="row">
                    
   <div class="col-md-12">
<ol class="breadcrumb pull-left">
  <li class="breadcrumb-item"><a href="{{ url('') }}">الرئيسية</a></li>  
  
  @if (Route::getCurrentRoute()->uri() == 'subcategory/{subcategory}' ||
        Route::getCurrentRoute()->uri() == 'product/{item}')      
    <li class="breadcrumb-item"><a href="{{ url('category') }}/{{ $parent->id}}">{{ $parent->title}}</a></li>  
        
            @if($subcategory1) <li class="breadcrumb-item"><a href="{{ url('subcategory') }}/{{ $subcategory1->id}}"> {{ $subcategory1->title}} </a></li> @endif
            
            @if($subcategory2)
                @if($subcategory1->id != $subcategory2->id )
                <li class="breadcrumb-item"><a href="{{ url('subcategory') }}/{{ $subcategory2->id}}">{{ $subcategory2->title}} </a></li> 
            @endif @endif
      
  @endif
  
   
  <!--<li class="breadcrumb-item active"></li>-->
</ol>
    <h1>{{ $title }}</h1>
    <p> منتجات صيدليات البلسم الطبى   - تصفح وتابع للشراء </p>
           		 </div>
                 </div>
   		 </div>
    </div>
    </div>
</section>
    @endif
   
<!----- Content ---------------->
 
@yield('content')

        	<!-- Begin Search -->
	<div class="modal fade bs-example-modal-lg search-wrapper" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<p class="clearfix"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button></p>
                                <form class="form-inline form-search" role="search" method="get" action="{{ url('search') }}">
					<div class="form-group">
						<label class="sr-only" for="textsearch">أدخل كلمة البحث</label>
                                                <input type="search" class="form-control input-lg" id="textSearch" required=""
                                                       name="textSearch" placeholder="أدخل كلمة البحث">
					</div>
					<button type="submit" class="btn btn-white">ابحث</button>
				</form>
			</div>
		</div>
	</div>
	<!-- End Search -->
 

<!-- Begin footer -->


<footer class="footer">
<div class="container-fluid">
        <div class="upper-foot">
                <div class="row">

<div class="col-xs-6 col-sm-2">
     <img class="img-responsive" src="{{asset('asset/img/2030.png')}}" alt="" title="" >
    
     </div>

                        <div class="col-xs-6 col-sm-2">
                                <h2>تصفح أقسامنا  </h2>
                                <ul class="list-unstyled">
                                    @if($cats)
                                        @foreach($cats as $cat)
                                        <li><a href="{{url('category')}}/{{$cat->id}}">{{$cat->title}}</a></li>
                                        @endforeach
                                    @endif                                                                                
                                </ul>
                        </div>
                        <div class="col-xs-6 col-sm-2">
                                <h2>روابط تهمك</h2>
                                <ul class="list-unstyled">                                      
                                        <li><a href="{{url('')}}">الرئيسية</a></li>
                                        <li><a href="{{url('about')}}">عن البلسم </a></li>
                                        <li><a href="{{url('offers')}}">العروض</a></li>
                                        <li><a href="{{url('products')}}">المنتجات</a></li>
                                        <li><a href="{{url('contact')}}">اتصل بنا </a></li> 
                                        <li><a href="{{url('complaints')}}">الشكاوى  والاستفسارات</a></li>
                                </ul>
                        </div>

<div class="col-xs-6 col-sm-3">
                                <h2>أتصل بنا</h2>
                                <address>
                                        <i class="fa fa-map-marker"></i> العنوان: {{$address->value}}<br>
                                        <i class="fa fa-phone"></i>  التليفون: {{$mobile->value}}<br>
                                        <i class="fa fa-envelope"></i>البريد:  <a href="mailto:{{$email->value}}">{{$email->value}}</a>
                                </address>
                            
<ul class="list-inline social-list">
    @if($socialLinks)
        @foreach($socialLinks as $link)
        <li><a data-toggle="tooltip" data-placement="top" title="{{$link->site}}" href="{{$link->value}}"
               data-original-title="{{$link->site}}" target="_blank"><i class="fa fa-{{$link->site}}"></i></a></li>
        @endforeach
    @endif
    </ul>
    </div>

                    <div class="col-xs-6 col-sm-3">
                            <h2>النشرة البريدية</h2>
                            <form method="post" action="{{url('newsletter')}}" class="frmNewsLetter">
                                 {{ csrf_field() }}
                                 <input type="email" name="emailNewsLetter" id="emailNewsLetter" required="" 
                                        oninvalid="this.setCustomValidity('من فضلك أدخل بريدك الالكترونى')" oninput='setCustomValidity("")' />
                                <input type="submit" value="اشترك" class="btn btn-success" />
                            </form>
                            <br/><br/>


<ul class="list-inline">
    <li><a  title="" href="#"><img src="{{asset('asset/img/ios.png')}}"/></a></li>
    <li><a  title="" href="https://play.google.com/store/apps/details?id=com.balsam.balsam" target="_blank">
            <img  src="{{asset('asset/img/gplay.png')}}"/></a></li>
</ul>
                    </div>
            </div>
    </div>
				<div class="below-foot">
					<div class="row">
						<div class="col-xs-12 copyrights text-center">
                                                    <p> &copy; جميع الحقوق محفوظة  {{ date('Y')}} - تطوير <a href="http://fudex.com.sa/" target="_blank">فيودكس</a><br>
							</p>
						</div>
					
					</div>
				</div>
			</div>
		</footer>
        
        <!-- End footer -->


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
          
          
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{asset('asset/js/vendor/jquery.min.js')}}"></script> 
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('asset/js/scrollTop.plugins.js')}}"></script>
        <script src="{{asset('asset/js/mainSlider.min.js')}}"></script>
        <script src="{{asset('asset/js/jquery.touchSwipe.min.js')}}"></script>
        <script src="{{asset('asset/js/lightslider.js')}}"></script> 
        <script src="{{asset('asset/js/cart.js')}}"></script> 
    <script>                
    $('.login > a').click(function() {
                                    var wrapper = $('.login-wrapper');

                                    if (wrapper.hasClass('open')) {
                                      wrapper.removeClass('open');
                                    }
                                    else {
                                      wrapper.addClass('open');
                                    }
                            });

                    window.onload = function() {
        if (screen.width < 450) {
            var mvp = document.getElementById('vpw');
            mvp.setAttribute('content','width=450');
        }
    }
    $.scrollToTop();


    $(document).ready(function() {
                            $(".content-slider").lightSlider({
                    loop:true,
                    keyPress:true,
                                    item:5,
                                            rtl:true,
            loop:false,
            slideMove:2,
            easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
            speed:600,
            responsive : [
                {
                    breakpoint:990,
                    settings: {
                        item:3,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:600,
                    settings: {
                        item:1,
                        slideMove:1
                      }
                }
            ]
                });

	$('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
		 rtl:true,
        thumbItem:9,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'right',
         
    }); 
    
                    });
                    
    
    </script>
    
    <script type="text/javascript" src="{{asset('asset/js/xzoom.min.js')}}"></script>
<script src="{{asset('asset/js/setup.js')}}"></script>
<script>
$(".xzoom").xzoom({position: right});
</script>


    <link rel="stylesheet"  href="{{asset('asset/growl/jquery.growl.css')}}"/>
    <script src="{{asset('asset/growl/jquery.growl.js')}}"></script>
<script>
$(".prodLst").find(".addToCart").click(function(){     
//    localStorage.clear();
    var flag =0;
    var prod_id = $(this).next().val();      
    var quantity = 1;        
      
      
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
    $(this).closest('li').remove(); 
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
