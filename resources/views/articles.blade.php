@extends('master', ['title'=>'المقالات' ,'active'=>'articles'])

@section('content')
 <section class="page-con bg1 portfolio_078">

<div class="container">
    <div class="profile-usermenu">
        <ul class="nav">
            @if($articles)
                @foreach($articles as $article)
                <div class="col-md-4 col-sm-6 col-xs-12 animated fadeInUp" data-animation="animated fadeInUp">
            <div class=" art-item">
                <div class="col-md-4  col-sm-6"><img class="img-responsive"  src="{{asset('uploads')}}/{{ $article->img }}" /></div>
               <div class="col-md-8  col-sm-6"><h4>
                       <a href="{{ url('article') }}/{{ $article->id }}">
                           {{ str_limit($article->title, $limit = 50, $end = '...') }}                           
                        </a></h4></div>
            </div>
            </div>                                
                @endforeach
            @endif
        </ul>
</div>
</div>
</section>
 

@endsection
