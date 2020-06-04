<?php
include ("../PHPMailer/src/Exception.php");
include ("../PHPMailer/src/OAuth.php");
include ("../PHPMailer/src/POP3.php");
include ("../PHPMailer/src/PHPMailer.php");
include ("../PHPMailer/src/SMTP.php");
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$mail = new PHPMailer(true);             
try {
    $mail->SMTPDebug = 2;               
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;    
    $mail->Username = 'luongnga6980@gmail.com';    
    $mail->Password = 'Hagiahan17';    
    $mail->SMTPSecure = 'tls';    
    $mail->Port = 587;            
	$mail->CharSet='UTF-8';
    $mail->setFrom('luongnga6980@gmail.com');
    $mail->addAddress('ngaltt.281@gmail.com', 'Luong Nga');    
    $mail->isHTML(true);    
	$mail->Subject = 'Em nho pass roi nha';
    $mail->Body    = '0.0';
    $mail->AltBody = 'hihi';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
</body>
</html>