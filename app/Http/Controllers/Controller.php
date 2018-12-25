<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use DB;
use Mail;
use PDF;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;  
    
      public function send_mail($to,$subject,$msg,$cc="") {
            $from = DB::table('site_settings')->where('keyword','=','email')->first();
            if($from) $from = $from->value; else $from = "info@fudex.com.sa";
                        
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "CC: $cc\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8";

//            $msg = urlencode($msg);
//            $msg  = iconv("UTF-8","Windows-1256"  , $msg);
            
            mail($to, $subject, $msg, $headers);
         }
    public function send_mail2($to,$subject,$msg){            
        $data = array(
            'to' => $to,
            'subject' => $subject,
            'msg' => $msg
            );
         Mail::send('mail.template', ['data'=>$data], function ($message)  use ($data){
             $subject = $data['subject'];
             $message->to($data['to'])->subject($subject)->setBody($data['msg'], 'text/html');
         });

          if( count(Mail::failures()) > 0 ) {
                 foreach(Mail::failures as $email_address) {
                    //echo "$email_address <br />";
                 }
            }
    }
     //------------------------------- SMS API ----------------------------------------//
     public function sms($message="",$numbers="966532201767") {                        
        $userSender = 'Balsam';        
        $userName="mohammed";
        $userPassword="123456mm";
        
        $msg  = iconv("UTF-8","Windows-1256"  , $message);
        $msg = urlencode($msg);
        $url = "http://sms.rasaelna.com//gw/?userName=$userName&userPassword=$userPassword&numbers=$numbers&userSender=$userSender&msg=$msg&By=API";
        
        file_get_contents($url);        
    }
       
    function toPdf($html) {       
	$pdf = PDF::loadHTML($html);
	return $pdf->stream('document.pdf');
}
}
