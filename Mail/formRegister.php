<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link href="https://fonts.googleapis.com/css?family=Chakra+Petch&display=swap" rel="stylesheet">
    <style>
        .container{
            width: 330px;
            height: 680px;
            background-color: darkslategray;
            color: whitesmoke;
            box-sizing: border-box;
            padding: 50px;
            font-size: 20px;
            margin: 100px auto;
            font-family: 'Chakra Petch', sans-serif;
        }
        .form-insert{
            width: 220px;
            height: 50px; 
            margin: 10px 0 10px;
            background-color: lightgoldenrodyellow;
            box-sizing: border-box;
            padding: 20px;
        }
        .tittle{
            font-size: 25px;
            color: lightsalmon;
            margin-bottom: 20px;
        }
        .form-click{
            width: 108px;
            height: 56px;
            background-color: rgb(66, 209, 235);
            margin: 20px 50px;
        }

    </style>
</head>

<body>
    <form method="POST" action="formRegister.php" >
        <div class="container">
        <div class="tittle">REGISTER</div>
            <input class="form-insert" type="text" name="txtusername" placeholder="Username">
            <input class="form-insert" type="password" name="txtpw" placeholder="Password">
            <input class="form-insert" type="password" name="txtre_pw" placeholder="Re-password">
            <input class="form-insert" type="text" name="txtstudent_id" placeholder="Student Identification Number">
            <input class="form-insert" type="text" name="txtfullname" placeholder="Your Fullname">
            <input class="form-insert" type="text" name="txtemail" placeholder="Your Email Address">
            <input class="form-click" type="submit" name="ok" value="Register">
            
        </div>
    </form>   
    <?php
    include ("../PHPMailer/src/Exception.php");
    include ("../PHPMailer/src/OAuth.php");
    include ("../PHPMailer/src/POP3.php");
    include ("../PHPMailer/src/PHPMailer.php");
    include ("../PHPMailer/src/SMTP.php");
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    ?>
    <?php 
    include ('connect.php');
    if (isset($_POST['ok'])) {
        $user = $_POST['txtusername'];
         $pw = $_POST['txtpw'];
         $re_pw = $_POST['txtre_pw'];
         $studentid = $_POST['txtstudent_id'];  
         $fullname = $_POST['txtfullname'];  
         $email = $_POST['txtemail'];   

        if($user == "" || $pw == "" || $re_pw == "" || $studentid == "" || $fullname == "" ||$email == ""){
            echo "<script> alert ('Bạn vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            // thực hiện lệnh lưu  dữ liệu vào db
            $sql = "INSERT INTO student_info_record (username, pass, studenid, fullname, email)
            VALUES ('$user', '$pw', '$studentid', '$fullname', '$email')";
            $run = mysqli_query($conn, $sql);
            if($run){
                echo "<script> alert ('Bạn đã đăng ký thành công')</script>";
            }    
            else{
                echo "<script> alert ('Đăng ký chưa hoàn tất')</script>";
            }   
        }

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
            $mail->addAddress($email);    
            $mail->isHTML(true);    
            $mail->Subject = 'Form Submission';
            $mail->Body    = 'From QTM with love ^^';
            $mail->AltBody = 'Welcome';
            $mail->send();
            echo 'Successfully! Thanks you';
        } 
        catch (Exception $e) {
            echo 'Something went wrong!', $mail->ErrorInfo;
        }
        
    }
    // include ('connect.php');
    // if(isset($_POST['ok'])){
    //     $user = $_POST['txtusername'];
    //     $pw = $_POST['txtpw'];
    //     $re_pw = $_POST['txtre_pw'];
    //     $studentID = $_POST['txtstudent_id'];  
    //     $fullname = $_POST['txtfullname'];  
    //     $email = $_POST['txtemail'];        
    //     // kiểm tra điều kiện bắt buộc đối với các file không được bỏ trống
    //     if($user == "" || $pw == "" || $re_pw == "" || $studentID =="" || $fullname == "" ||$email == ""){
    //         echo "<script> alert ('Bạn vui lòng điền đầy đủ thông tin')</script>";
    //     }
    //     else{
    //         // kiểm tra tài khoản đã tồn tại chưa
    //         $sql = "SELECT * FROM student_info_record WHERE username = '$user'";
    //         $check_user = mysqli_query($conn, $sql);
    //         if (mysqli_num_rows($check_user) > 0){
    //             echo "<script> alert ('Tài khoản đã tồn tại')</script>";
    //         }
    //         // kiểm tra email đã có người dùng chưa
    //         $sql = "SELECT * FROM student_info_record WHERE email = '$email'";
    //         $check_email = mysqli_query($conn, $sql);
    //         if (mysqli_num_rows($check_email) > 0){
    //             echo "<script> alert ('Email này đã có người dùng. Vui lòng chọn Email khác.')</script>";
    //         }
    //         else{
    //             // thực hiện lệnh lưu  dữ liệu vào db
    //             $sql = "INSERT INTO student_info_record (username, pass, studenid, fullname, email)
    //             VALUES ('$user', '$pw', '$studentID', '$fullname', '$email')";
    //             $run = mysqli_query($conn, $sql);
    //             if($run){
    //                 echo "<script> alert ('Bạn đã đăng ký thành công')</script>";
    //             }    
    //             else{
    //                 echo "<script> alert ('Đăng ký chưa hoàn tất')</script>";
    //             }   
    //         }
    //     }
        
    // }   
?>
</body>
</html>