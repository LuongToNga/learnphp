<?php
include ('connect.php');
include ("../PHPMailer/src/Exception.php");
include ("../PHPMailer/src/OAuth.php");
include ("../PHPMailer/src/POP3.php");
include ("../PHPMailer/src/PHPMailer.php");
include ("../PHPMailer/src/SMTP.php");
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form method="POST">
   
      ID <input type="text" name="id"><br>
      Name <input type="text" name="name"><br>
      Class 
      <select type="text" name="class">
          <option>Chọn lớp</option>
          <?php
          $sql_select = "select * from class";
          $run_select = mysqli_query($conn, $sql_select);
          while ($row_select = mysqli_fetch_array($run_select)){
            $tenlop = $row_select['class']; 
          ?>
          <option value = "<?php echo $tenlop;?>">
            <?php echo $tenlop;?>
          </option>
        <?php}
        endwhile;
        ?>
          
      </select><br>
      <b>Subject</b><br>
      PHP <input type="checkbox" name="subject[]" value="PHP">
      Linux <input type="checkbox" name="subject[]" value="Linux">
      Photoshop <input type="checkbox" name="subject[]" value="Photoshop"><br>
      Android Studio <input type="checkbox" name="subject[]" value="Android Studio">
      ASP.net <input type="checkbox" name="subject[]" value="ASP.net">
      VB.net <input type="checkbox" name="subject[]" value="VB.net"><br>
      <input type="submit" name="save" value="Lưu">
  </form>
  <?php
  if (isset ($_POST['save'])) {
    $id = $_POST ['id'];
    $name = $_POST ['name'];
    $class = $_POST ['class'];
    $subjects = $_POST ['subject'];

    $countSubject = ' ';

    foreach ($subjects as $subject){
      $countSubject .= $subject . ' ' ;
    }
    echo $countSubject;

    $sql =  "insert into subject (id, name, class, subject) values ('$id', '$name', '$class', '$countSubject')";
    $run = mysqli_query($conn, $sql);
    if($run) {
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
          $mail->addAddress('vanyellow1211@gmail.com', 'Thu Van');    
          $mail->isHTML(true);    
          $mail->Subject = 'CHỌN MÔN HỌC';
          $mail->Body    = 'Các môn học được chọn là: '.$countSubject;
          $mail->AltBody = 'hoàn thành';
          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
      }
    }
    else {
      echo"<script>alert('Not successful')</script>";
    }
  } 
  ?>
</body>
</html>