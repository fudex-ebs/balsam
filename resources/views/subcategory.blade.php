@extends('master', ['title'=> $subcategory->title ,'active'=>'products'])

@section('content')
<div class="container">
        <nav class="toolbox">
            <div class="toolbox-left">
                <div class="toolbox-item toolbox-sort">
                    <label>رتب حسب:</label>

                    <div class="select-custom">
                        <select name="orderby" class="form-control">
                            <option value="menu_order" selected="selected">المضاف حديثا</option>
                            <option value="popularity">الأكثر شراء</option>
                            <option value="rating">الأعلى تقيما</option>
                            <option value="date">من الأقل سعرا الى الأكبر</option>
                            <option value="price">من الأكبر سعرا الى الأقل</option>
                        </select>
                    </div><!-- End .select-custom -->

                </div><!-- End .toolbox-item -->
            </div><!-- End .toolbox-left -->

            <div class="toolbox-item toolbox-show">
                <label>عرض:</label>

                <div class="select-custom">
                    <select name="count" class="form-control">
                        <option value="9">20 منتجات</option>
                        <option value="18">50 منتجات</option>
                        <option value="27">100 منتجات</option>
                    </select>
                </div><!-- End .select-custom -->
            </div><!-- End .toolbox-item -->
        </nav>

        <div class="row row-sm prodLst">
    @if($items)
    @foreach($items as $item)        
                <div class="col-md-3">
                <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ url('product') }}/{{ $item->id }}" class="product-image">
                                @if($item->img != '')
                                    <img src="{{asset('uploads')}}/{{$item->img}}" alt="{{$item->title}}">
                                    <img src="{{asset('uploads')}}/{{$item->img}}" class="hover-image" alt="product">
                                @else
                                    <img src="{{asset('images/logo.png')}}" alt="{{$item->title}}">
                                @endif
                            </a>
                        </figure>
                        <div class="product-details">
                            <h2 class="product-title">
                                <a href="{{ url('product') }}/{{ $item->id }}"> {{$item->title}}</a>
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
                    </div>
                </div>
 
        @endforeach
        @endif
        </div>
     
    

        <nav class="toolbox toolbox-pagination">           
            <ul class="pagination">
                 {{ $items->links() }}                 
            </ul>
        </nav>
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- margin -->

    
     

@endsection
