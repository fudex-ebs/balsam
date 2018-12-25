@extends('master', ['title'=>'الشكاوى والاستفسارات' ,'active'=>'home'])

@section('content')

<div class="page-header align-items-end" style="background-image: url(asset/images/Header_Pharmacy.jpg);margin-top: -24px;">
<h1>الشكاوى والاستفسارات</h1>
</div><!-- End .page-header -->
            
            
<section class="page-con bg1 portfolio_078" style="margin-top: 20px;">

<div class="container">
    <div class="contact-content text-right">
            <h4>أرسل شكواك / استفساراك </h4>
            <span>و سوف يتم الرد عليك فى أقرب وقت</span>
            <br/><br/>
    </div>
 {!! Form::open(array('url'=>'send_complaint','method'=>'POST', 'files'=>true , 'class'=>'')) !!}  
          {{ csrf_field() }}
            <div class="form-group col-sm-12">                                    
                        <input name="name" type="text" id="name" class="form-control" value="" data-msg-required="من فضلك أدخل الاسم" 
                               required="" aria-required="true" placeholder="الاسم" oninvalid="this.setCustomValidity('من فضلك أدخل اسمك')" oninput='setCustomValidity("")'>                
            </div>
          <div class="form-group col-sm-12">            
                <input name="email" type="email" id="email" class="form-control" value="" data-msg-required="من فضلك أدخل بريدك الالكترونى" 
                       data-msg-email="من فضلك أدخل بريدك الالكترونى" required="" aria-required="true" placeholder="البريد"
                       oninvalid="this.setCustomValidity('من فضلك أدخل بريدك الالكترونى')" oninput='setCustomValidity("")'>            
          </div>
            
            <div class="form-group col-sm-12">                                    
                <input name="subject" type="text" id="subject" class="form-control" value="" aria-required="true" placeholder="عنوان الرسالة">
            </div>
            <div class="form-group col-sm-12">                                    
                <input type="tel" class="form-control" id="mobile" name="mobile" value="" placeholder="رقم الهاتف">
            </div>
            <div class="form-group col-sm-12">                                    
                    <textarea name="comments" id="comments" class="form-control" rows="3" data-msg-required="من فضلك أدخل رسالتك" required aria-required="true"
                              oninvalid="this.setCustomValidity('من فضلك أدخل رسالتك')" oninput='setCustomValidity("")'></textarea>
            </div>
            <div class="form-group col-sm-12">                                    
                 {!! Form::submit(' أرسل', array('class'=>'btn btn-primary col-sm-5')) !!}
                   
            </div>
    {!! Form::close() !!}
    
    
</div>
 <br/><br/>
    
</section>

 
@endsection
