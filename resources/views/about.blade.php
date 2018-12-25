@extends('master', ['title'=>$about->title ,'active'=>'about'])

@section('content')

<div class="page-header align-items-end" style="background-image: url(asset/images/Header_Pharmacy.jpg);margin-top: -24px;">
<h1>{{$about->title}}</h1>
</div><!-- End .page-header -->
            
            
 <section class="page-con bg1 portfolio_078">

<div class="container">
    @if($about->img != '')<center><img src="{{url('public/uploads')}}/{{$about->img}}" class="img img-responsive"/></center>@endif
    <br/><br/>
 {!! $about->body !!}
</div>
 <br/><br/>
    
</section>
 
@endsection
