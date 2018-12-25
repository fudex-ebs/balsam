@extends('master', ['title'=>'الرئيسية','active'=>'home'])

@section('content')
   <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme owl-theme-light">
                    
                     @if($items)
         @foreach($items as $item)
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy" data-src="{{asset('uploads')}}/{{ $item->img }}" style="background-position:64% center;"></div><!-- End .slide-bg -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 offset-md-1">
                                        <div class="home-slide-content slide-content-big">
                                            <h1>{{ $item->title1 }}</h1>
                                                <h3>                                                    
                                                    <span>{{ $item->title2 }}</span>
                                                    <span>{{ $item->title3 }}</span>
                                                </h3>
                                                @if($item->link != null)<a href="{{ $item->link }}" class="btn btn-primary">تسوق الان</a> @endif
                                            </div><!-- End .home-slide-content -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .home-slide -->               
                @endforeach
                 @endif
                    
                    
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            
            <div class="container bt-6 mb-2 mb-lg-4 mb-xl-5">
                    <h2 class="title text-right mb-3">منتجات مميزة</h2>
                    <div class="owl-carousel owl-theme new-products prodLst">
                          @if($special_products)
                            @foreach($special_products as $product)
                        <div class="product">
                            <figure class="product-image-container">
                                <a href="{{url('product')}}/{{$product->id}}" class="product-image">
                                    @if($product->img != '')
                                        <img src="{{asset('uploads')}}/{{ $product->img }}" alt="product">
                                        <img src="{{asset('uploads')}}/{{ $product->img }}" class="hover-image" alt="product">
                                        @else 
                                        <img src="{{asset('images/logo.png')}}" alt="product">
                                    @endif
                                </a>
                                @if($product->offer != 0)<span class="product-label label-hot">عرض</span> @endif
    
                            </figure>
                            <div class="product-details">
                                <h2 class="product-title">
                                    <a href="{{url('product')}}/{{$product->id}}">{{ $product->title }}</a>
                                </h2>
                                <div class="price-box">
                                    @if($product->offer != 0)
                                        <span class="old-price">{{$product->price}} ريال</span>
                                        <span class="product-price">{{$product->offer}} ريال</span>
                                        @else
                                        <span class="product-price">{{$product->price}} ريال</span>
                                    @endif
                                </div><!-- End .price-box -->
                                <div class="product-details-inner">
                                    <div class="product-action">                                         
                                        <a href="javascript:void(0);" class="paction add-cart addToCart" title="Add to Cart"><span>أضف للعربة</span></a>                                        
                                        <input type="hidden" value="{{ $product->id }}" />
                                        <a href="javascript:void(0);" class="paction add-wishlist addToFav" title="أضف للمفضلة"><span>أضف للمفضلة</span></a>                                                                                    
                                    </div><!-- End .product-action -->
                                </div><!-- End .product-details-inner -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                        @endforeach
                        @endif
                         
                    </div><!-- End .featured-products -->
                </div><!-- End .container -->
    


                <div class="banners-container">
                        <div class="container">
                            <div class="row">
                           
                                <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                              <a href="#">
                                               <img src="{{asset('asset/images/Section2.png')}}" class="img-fluid" />
                                              </a>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                    <a href="#">
                                                            <img src="{{asset('asset/images/Section3.png')}}" class="img-fluid" />
                                                           </a>  
                                            </div>
                                        </div>

                                </div>
                                <div class="col-md-6 mb-3">                                        
                                        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" data-toggle="lightbox">
                                            <img src="{{asset('asset/images/Section1.png')}}" class="img-fluid" /></a>
                                </div>

                            </div><!-- End .row -->
                            <div class="row offrs">
                           @if($offers)
                          @foreach($offers as $offer)
                                <div class="col-md-4 mb-3">
                                    <span class="product-label label-hot">عرض</span>
                                    <a href="{{ url('product')}}/{{$offer->id}}">
                                        <img src="{{ asset('uploads') }}/{{ $offer->img }}" class="img-fluid" />
                                    </a>
                                </div>
                            @endforeach
                            @endif
                                 
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .banners-container -->
        


            <div class="container bt-6 mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-right mb-3"><a href="{{url('most_ordered')}}">المنتجات الاكثر مبيعا</a></h2>
                <div class="owl-carousel owl-theme new-products prodLst">

                    @if($most_ordered)
            @foreach($most_ordered as $item)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ url('product') }}/{{ $item->id }}" class="product-image">
                                @if($item->img != '')
                                    <img src="{{asset('uploads')}}/{{$item->img}}" alt="{{$item->title}}">
                                    <img src="{{asset('uploads')}}/{{$item->img}}" class="hover-image" alt="{{$item->title}}">
                                @else
                                    <img src="{{asset('images/logo.png')}}" alt="{{$item->title}}">
                                    <img src="{{asset('images/logo.png')}}" class="hover-image" alt="{{$item->title}}">
                                @endif
                            </a>
                            @if($item->offer != 0)<span class="product-label label-hot">عرض</span> @endif

                        </figure>
                        <div class="product-details">
                            <h2 class="product-title">
                                <a href="{{ url('product') }}/{{ $item->id }}">{{$item->title}}</a>
                            </h2>
                            <div class="price-box">
                                @if($item->offer != 0)
                                    <span class="old-price">{{$item->price}}ريال</span>
                                    <span class="product-price">{{$item->offer}}ريال</span>
                                @else                                    
                                    <span class="product-price">{{$item->price}}ريال</span>
                                @endif
                            </div><!-- End .price-box -->
                            <div class="product-details-inner">
                                <div class="product-action">
                                    <a href="javascript:void(0);" class="paction add-cart addToCart" title="Add to Cart"><span>أضف للعربة</span></a>                                        
                                    <input type="hidden" value="{{ $item->id }}" />
                                    <a href="javascript:void(0);" class="paction add-wishlist addToFav" title="أضف للمفضلة"><span>أضف للمفضلة</span></a>                                                                                    
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                    @endif

                </div><!-- End .featured-products -->
            </div><!-- End .container -->

        



            <div class="blog-section">
                    <div class="container">
                        <h2 class="h3 title text-right">قسم الصحة</h2>
    
                        <div class="blog-carousel owl-carousel owl-theme owl-loaded owl-drag">
                        <div class="owl-stage-outer owl-height"><div class="owl-stage">
                          

                     @if($articles)
                      @foreach($articles as $article)
                        <div class="owl-item">
                                <article class="entry">
                                    <div class="entry-media">
                                        <a href="{{url('article')}}/{{$article->id}}">
                                            @if($article->img != '')<img src="{{asset('uploads')}}/{{$article->img}}" alt="{{$article->title}}" style="height: 166px;">                                            
                                            @else
                                            <img src="{{asset('images/logo.png')}}" alt="{{$article->title}}" style="height: 163px;">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="entry-body">
                                        <h3 class="entry-title">
                                            <a href="{{url('article')}}/{{$article->id}}">{{$article->title}}</a>
                                        </h3>
                                        <div class="entry-content">
                                            <p>{{ str_limit($article->title, $limit = 150, $end = '...') }}</p>
                                            <a href="{{url('article')}}/{{$article->id}}" class="btn btn-dark">أقراء المزيد</a>
                                        </div><!-- End .entry-content -->
                                    </div><!-- End .entry-body -->
                                </article>
                            </div>
                            @endforeach
                            @endif

                       </div>
                    </div>
                    <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button></div><div class="owl-dots disabled"></div></div><!-- End .blog-carousel -->
                    </div><!-- End .container -->
                </div>
 
@endsection
