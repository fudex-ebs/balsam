<div class="col-md-3">
<div class="profile-sidebar text-right">

        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> <h2>أحدث المقالات </h2></div>															
        </div>

<div class="profile-usermenu text-right">
        <ul class="nav">
            @if($latest_articles)
                @foreach($latest_articles as $article)
                <li class="">
                    <a href="{{ url('article') }}/{{ $article->id }}">
                        <i class="glyphicon glyphicon glyphicon-th-list"></i>
                        {{ $article->title }} </a>
                </li>
                @endforeach
            @endif
        </ul>
</div>
        <!-- END MENU -->
</div>
</div>