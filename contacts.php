<?php
//if (array_key_exists('messageFF', $_POST)) {
//   $to = 'nikolay@fizika-lirika.ru';
//   $subject = 'Заполнена контактная форма с '.$_SERVER['HTTP_REFERER'];
//   $subject = "=?utf-8?b?". base64_encode($subject) ."?=";
//   $message = "Имя: ".$_POST['nameFF']."\nEmail: ".$_POST['emailFF']."\nIP: ".$_SERVER['REMOTE_ADDR']."\nСообщение: ".$_POST['messageFF'];
//   $headers = 'Content-type: text/plain; charset="utf-8"';
//   $headers .= "MIME-Version: 1.0\r\n";
//   $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
//   mail($to, $subject, $message, $headers);
//   echo $_POST['nameFF'];
//}

$to = "nikolay@fizika-lirika.ru" ;
//$to  = "info@osteopathie.ru" ;

function send_mime_mail($name_from, // имя отправителя
                        $email_from, // email отправителя
                        $name_to, // имя получателя
                        $email_to, // email получателя
                        $data_charset, // кодировка переданных данных
                        $send_charset, // кодировка письма
                        $subject, // тема письма
                        $body, // текст письма
                        $html = FALSE, // письмо в виде html или обычного текста
                        $reply_to = FALSE
                        ) {
  $to = mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email_to . '>';
  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from\r\n";
  $type = ($html) ? 'html' : 'plain';
  $headers .= "Content-type: text/".$type."; charset=".$send_charset."\r\n";
  $headers .= "Bcc: iom@d1a.ru, nikolay@fizika-lirika.ru, polina@fizika-lirika.ru\r\n";
  $headers .= "Mime-Version: 1.0\r\n";
  $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
  
  if ($reply_to) {
      $headers .= "Reply-To: $reply_to";
  }

  return mail($to, $subject, $body, $headers);
}

function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {$str = iconv($data_charset, $send_charset, $str);}
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
  }
  
  

if (array_key_exists('email', $_POST)) { 
$to  = "zajavka@instost.ru" ;
$subject = "Обращение с сайта ".$_SERVER['HTTP_REFERER']." от ".$_POST['full-name'];
//$subject = "=?utf-8?b?". base64_encode($subject) ."?="; 
$message = ' 
<html> 
    <head> 
        <title>Обращение с сайта Дмитрий-Мохов.рф</title>         
            <style type=text/css> 
            .style1 { color: #FF4200; font-weight: bold; } 
            .style2 {color: #0000FF;font-size:12px;} 
            </style>        
    </head> 
    <body> 
      <p class="style1">Обращение с сайта Дмитрий-Мохов.рф</p>
      <div class="style2">
        <table border="1" CELLSPACING="5px" CELLPADDING ="5px">
          <tr><td>Фамилия, имя, отчество</td><td>';
$message .= $_POST['full-name'];    
$message .='</td></tr><tr><td>Адрес электронной почты (email)</td><td>';      
$message .= $_POST['email']; 
$message .='</td></tr><tr><td>Текст обращения</td><td>';      
$message .= $_POST['text'];
$message .= '
</td></tr></table>
</div>
    </body> 
</html>'; 


$fromname = $_POST['name'];
$fromemail = $_POST['email'];

send_mime_mail($fromname,
               $fromemail,
               'Дмитрию Евгеньевичу Мохову',
               $to,
               'UTF-8',  // кодировка, в которой находятся передаваемые строки
               'UTF-8', // кодировка, в которой будет отправлено письмо
               $subject,
               $message,
               true,
              false);

//var_dump($_POST);               
               
//mail($to, $subject, $message, $headers);
echo $_POST['full-name'].",";

}


?>


