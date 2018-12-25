@extends('admin/outer_master',['title'=>'Login'])

@section('content')
<div id="login-page">
<div class="container">

    <form class="form-login" action="{{ url('/login') }}" method="post">
        {{ csrf_field() }}
        <h2 class="form-login-heading">تسجيل دخول الأدمن </h2>
        <div class="login-wrap">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="البريد الالكترونى" value="{{ old('email') }}" autofocus>
             @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            </div>
            <br>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
             @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> &nbsp; &nbsp; &nbsp; تذكرنى
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                     <a data-toggle="modal" href="login.html#myModal"> نسيت كلمة المرور؟</a>
                </div>
                    
            </div>
            <div class="clearfix"></div><br/>
            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> دخول</button>
            <hr>
             
<!--            <div class="registration">
                Don't have an account yet?<br/>
                <a class="" href="{{ url('register') }}">
                    Create an account
                </a>
            </div>-->

        </div>
    </form>
          <!-- Modal -->
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                       @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">نسيت كلمة المرور</h4>
                      </div>
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
                      <div class="modal-footer">
                          <button class="btn btn-default" type="submit">استرجاع</button>
                          <button data-dismiss="modal" class="btn btn-theme" type="button">الغاء</button>                          
                      </div>
                  </div>
              </div>
          </div>
         </form>
          <!-- modal -->

        	

</div>
</div>




<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
