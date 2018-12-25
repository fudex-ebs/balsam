@extends('master', ['title'=>'اتصل بنا' ,'active'=>'contact'])

@section('content')
<div class="container">
 <iframe src="{{$map->value}}"
                  height="450" frameborder="0" style="border:0;width: 100%;" allowfullscreen></iframe>

<div class="row">
    <div class="col-md-8">
        <h2 class="light-title">راسلنا</h2>

                             
{!! Form::open(array('url'=>'contact_us','method'=>'POST', 'files'=>true , 'class'=>'')) !!}  
          {{ csrf_field() }}
            <div class="form-group required-field">
                <label for="name">الاسم</label>
                <input name="name" type="text" id="name" class="form-control" value="" data-msg-required="من فضلك أدخل الاسم" 
                                           required="" aria-required="true"   oninvalid="this.setCustomValidity('من فضلك أدخل اسمك')" oninput='setCustomValidity("")'>
            </div><!-- End .form-group -->

            <div class="form-group required-field">
                <label for="email">البريدالالكترونى</label>
                <input name="email" type="email" id="customer_mail" class="form-control" value="" data-msg-required="من فضلك أدخل بريدك الالكترونى" 
                                           data-msg-email="من فضلك أدخل بريد الكترونى صحيح" required="" aria-required="true"  
                                           oninvalid="this.setCustomValidity('من فضلك أدخل بريدك الالكترونى')" oninput='setCustomValidity("")'>
            </div><!-- End .form-group -->

            <div class="form-group">
                <label for="mobile">رقم الجوال</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" value="" >
            </div><!-- End .form-group -->

            <div class="form-group required-field">
                <label for="message">محتوى الرسالة!</label>
                 <textarea name="message" id="message" class="form-control" rows="3" data-msg-required="من فضلك أدخل رسالتك" required aria-required="true"
                              oninvalid="this.setCustomValidity('من فضلك أدخل رسالتك')" oninput='setCustomValidity("")'></textarea>
            </div><!-- End .form-group -->

            <div class="form-footer">
                 {!! Form::submit(' أرسل', array('class'=>'btn btn-primary')) !!}                
            </div><!-- End .form-footer -->
        </form>
    </div><!-- End .col-md-8 -->

    <div class="col-md-4">
        <h2 class="light-title">بيانات التواصل</h2>

        <div class="contact-info">
<!--            <div>
                <i class="icon-phone"></i>
                <p><a href="tel:">0123 456 7890</a></p>
                <p><a href="tel:">0123 456 7890</a></p>
            </div>-->
            <div>
                <i class="icon-mobile"></i>                
                <p><a href="tel:{{$mobile->value}}">{{$mobile->value}}</a></p>
            </div>
            <div>
                <i class="icon-mail-alt"></i>                
                <p><a href="mailto:{{$email->value}}">{{$email->value}}</a></p>
            </div>
            <div>
                <i class="icon-map"></i>
                <p>{{$address->value}}</p>
            </div>
            
<!--            <div>
                <i class="icon-skype"></i>
                <p>skype</p>
                <p>skype</p>
            </div>-->
        </div><!-- End .contact-info -->
    </div><!-- End .col-md-4 -->
</div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-8"></div><!-- margin -->

            
            
            

 
@endsection
