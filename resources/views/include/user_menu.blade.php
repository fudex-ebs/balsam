@if(! Auth::guest())
<div class="profile-sidebar">

        <div class="profile-usertitle">
            <center>
<img src="{{asset('asset/img/logo.png') }}" class="img-circle img-responsive"/>
                <div class="profile-usertitle-name"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </div>															
            </center>
        </div>
<br/>
<div class="profile-usermenu">
        <nav class="main-nav">
            <ul class="nav">
                <li class="@if($active_user == 'profile') activeLnk @endif">
                        <a href="{{ url('profile') }}">
                        <i class="glyphicon glyphicon-user"></i>
                        صفحة المستخدم</a>
                </li>
                <li class="@if($active_user == 'addresses') activeLnk @endif">
                        <a href="{{ url('addresses') }}">
                        <i class="glyphicon glyphicon-pushpin"></i>
                        عناوينى</a>
                </li>
                <li class="@if($active_user == 'follow_order') activeLnk @endif">
                        <a href="{{ url('follow_order') }}">
                        <i class="glyphicon glyphicon-flag"></i>
                        متابعة الطلبات</a>
                </li>
                <li class="@if($active_user == 'shipping' ) activeLnk @endif">
                        <a href="{{ url('shipping') }}">
                        <i class="glyphicon glyphicon glyphicon-th-list"></i>
                        مشترياتى </a>
                </li>
            </ul>
        </nav>
</div>
        <!-- END MENU -->
</div>
@endif