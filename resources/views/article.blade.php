@extends('master', ['title'=>'المقالات','active'=>'articles'])

@section('content')
  
<section class="page-con bg1 portfolio_078">

<div class="container">
    <div class="row profile">
	@include('include/lateset_articles')	                
		<div class="col-md-9">
            <div class="profile-content">
 

            <div class="col-md-12">
                <h2 class="text-right">{{ $article->title }}</h2><br>
                <center><img src="{{ asset('uploads') }}/{{ $article->img }}" class="img-responsive"/> <br/></center>
            <div class="text-center"> {!! $article->body !!}</div>
    
       

            </div>
		</div>
	</div>
</div>
</div>
</section>

@endsection
