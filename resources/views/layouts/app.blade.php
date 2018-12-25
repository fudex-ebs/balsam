<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta id="vpw" name="viewport" content="width=device-width, initial-scale=1">
	<title>    صيدليات البلسم الطبى</title>
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
       
        <style>
            header{
                background: #000;
            }
        </style>
            
</head>

<body cz-shortcut-listen="true">
<header >
			
<div class="blur"></div>
<div id="top" style="margin-top:-6px;">
    <div class="container">        
            <ul class="nav nav-pills nav-top navbar-right">
                <li class="exper-span"><span>بث تجريبى</span></li>
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
                                        <li class="active"><a href="{{ url('') }}" >الرئيسية</a>
                                        </li>
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">المنتجات</a>
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
        
        <li class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown">المقالات</a>
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
        <li class="dropdown"><a href="{{ url('offers') }}">العروض</a>
            

        </li>




            <li class="dropdown menu-shop visible-md visible-lg">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <span class="shopping-bag" id="cart">{{ count($cart) }}</span> سلة التسوق <i class="fa fa-shopping-cart"></i> </a>
<div class="dropdown-menu dropdown-menu-right">
        <ul class="list-unstyled list-thumbs-pro cart_list">
              <div class="hidden"> {{ $total_sum = 0 }}</div>
              <li class="product cartAppend"></li>
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
                                    <span class="price">العدد: {{ $item->qty }}</span> <span class="price">السعر: 
                                        <span class="singlePrice">{{ $item->price }}</span> ريال</span>
                                        <span>سعر الكمية : <span class="prdsPrice">{{ $item->price * $item->qty}}</span> ريال</span>
                                </div>
                        </div>
                </li>
                @endforeach
             @endif   

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
<!--<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                 Collapsed Hamburger 
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                 Branding Image 
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                 Left Side Of Navbar 
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                 Right Side Of Navbar 
                <ul class="nav navbar-nav navbar-right">
                     Authentication Links 
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>-->

    @yield('content')

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
    
    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
