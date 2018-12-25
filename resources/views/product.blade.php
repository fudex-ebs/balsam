@extends('master', ['title'=>$item->title,'active'=>'products'])

@section('content')
<input type="hidden" value="{{ $item->id }}" id="item_id" />
 <div class="container">
        @include('include/flash-message')
</div>
<div class="container">
                <div class="product-single-container product-single-default">
                    <div class="row">
                        <div class="col-lg-7 product-single-gallery">
                            <div class="sticky-slider">
                                <div class="product-slider-container product-item">
                                    <div class="product-single-carousel owl-carousel owl-theme">
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{ asset('uploads') }}/{{ $item->img }}" data-zoom-image="{{ asset('uploads') }}/{{ $item->img }}"/>
                                        </div>
                                        @if($images)
                                        @foreach($images as $image)  
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{asset('uploads')}}/{{$image->img}}" data-zoom-image="{{asset('uploads')}}/{{$image->img}}"/>
                                        </div>
                                         @endforeach
                                         @endif
                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <span class="prod-full-screen">
                                        <i class="icon-plus"></i>
                                    </span>
                                </div>

                                <div class="prod-thumbnail row owl-dots transparent-dots" id='carousel-custom-dots'>
                                    @if($images)
                                        @foreach($images as $image)  
                                    <div class="owl-dot">
                                        <img src="{{asset('uploads')}}/{{$image->img}}"/>
                                    </div>
                                     @endforeach @endif
                                </div>
                            </div>
                        </div><!-- End .col-md-6 -->

                        <div class="col-lg-5 text-right">
                            <div class="product-single-details">
                                <h1 class="product-title">{{ $item->title }}  </h1>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->

                                    <a href="#" class="rating-link">( 6 تقيمات )</a>
                                </div><!-- End .product-container -->

                                <div class="price-box">
                                @if($item->offer != 0)
                                    <span class="old-price">{{$item->price}} ريال</span>
                                    <span class="product-price">{{$item->offer}}ريال</span>
                                @else                                    
                                    <span class="product-price">{{$item->price}} ريال</span>
                                @endif
                                </div><!-- End .price-box -->

                                <div class="product-desc">
                                    <p>{!! $item->description !!}</p>
                                </div><!-- End .product-desc -->

                               

                                <div class="product-action">
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" type="text" name="quantity">
                                    </div><!-- End .product-single-qty -->

                <a href="javascript:void(0);" class="paction add-cart" title="Add to Cart" id="add_tocart"><span>أضف للعربة</span></a>                                        
                <a href="javascript:void(0);" class="paction add-wishlist" title="Add to Wishlist" id="add_tofav"><span>أضف للمفضلة</span></a>
                                         
                                   
                                </div><!-- End .product-action -->

                                <div class="product-single-share  mb-4">
                                         <label style="width:100%">شارك المنتج:</label>
                                   
                                    <div class="btn-group">
                                        <!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_google_plus"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->


<!--                                            <a class="btn btn-social-login btn-md btn-gplus mb-1"><i class="icon-gplus"></i><span>Google</span></a>
                                            <a class="btn btn-social-login btn-md btn-facebook mb-1"><i class="icon-facebook"></i><span>Facebook</span></a>
                                            <a class="btn btn-social-login btn-md btn-twitter mb-1"><i class="icon-twitter"></i><span>Twitter</span></a>-->
                                    </div>
                                   

                                </div><!-- End .product single-share -->
                            </div><!-- End .product-single-details -->

<div class="product-single-tabs">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">كيفية الاستخدام  </a>            
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cautions-tab-desc" data-toggle="tab" href="#cautions-desc-content" role="tab" aria-controls="cautions-desc-content" aria-selected="true">التحذيرات    </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
            <div class="product-desc-content">
            <p> {!! strlen($item->how_to_use) < 5 ? 'غير متوفره' : $item->how_to_use !!} </p>                                    
            </div><!-- End .product-desc-content -->
        </div><!-- End .tab-pane -->

        <div class="tab-pane fade show" id="cautions-desc-content" role="tabpanel" aria-labelledby="cautions-tab-desc">
            <div class="cautions-desc-content">
                <p> {!! strlen($item->cautions) < 5 ? 'لا يوجد' : $item->cautions !!} </p>                                                
            </div><!-- End .product-desc-content -->
        </div><!-- End .tab-pane -->

    </div><!-- End .tab-content -->
</div><!-- End .product-single-tabs -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-single-container -->
            </div><!-- End .container -->

            

            <div class="featured-section">
                <div class="container">
                    <h2 class="carousel-title text-right">منتجات متعلقة</h2>

                    <div class="featured-products owl-carousel owl-theme owl-dots-top prodLst">
                      @if($similar)
        @foreach($similar as $myitm)
<div class="product">
        <figure class="product-image-container">
            <a href="{{url('product')}}/{{$myitm->id}}" class="product-image">
            @if($myitm->img != '')
                <img src="{{asset('uploads')}}/{{$myitm->img}}" alt="{{$myitm->title}}">
                <img src="{{asset('uploads')}}/{{$myitm->img}}" class="hover-image" alt="{{$myitm->title}}">
            @else
                <img src="{{asset('images/logo.png')}}" alt="{{$myitm->title}}">
            @endif
            </a>
        </figure>
        <div class="product-details">
            <h2 class="product-title">
                <a href="{{url('product')}}/{{$myitm->id}}">{{$myitm->title}}</a>
            </h2>
            <div class="price-box">
            @if($myitm->offer != '')
                <span class="old-price">{{$myitm->price}}</span>
                <span class="product-price">{{$myitm->offer}}</span>
            @else
                <span class="product-price">{{$myitm->price}}</span>
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


                                  



                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-section -->
 
@endsection
 
