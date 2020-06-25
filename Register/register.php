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
            height: 600px;
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
            margin: 20px 0;
        }

    </style>
</head>

<body>
    <form method="POST" action="register.php" enctype="multipart/form-data">
        <div class="container">
        <div class="tittle">REGISTER</div>
            <input class="form-insert" type="text" name="txtusername" placeholder="Your Username">
            <input class="form-insert" type="password" name="txtpw" placeholder="Your Password">
            <input class="form-insert" type="password" name="txtre_pw" placeholder="Re-password">
            <input class="form-insert" type="text" name="txtfullname" placeholder="Your Fullname">
            Your avatar
            <input type="file" name="txtimage" >
            <input class="form-click" type="submit" name="ok" value="Register">
            <input class="form-click" type="reset" name="Cancel" value="Cancel">
        </div>
    </form>   
    <?php 
    include ('connect.php');
    if(isset($_POST['ok'])){
        $user = $_POST['txtusername'];
        $pw = $_POST['txtpw'];
        $re_pw = $_POST['txtre_pw'];
        $fullname = $_POST['txtfullname'];        
        $anhtam = $_FILES['txtimage'] ['tmp_name'];
        $image = $_FILES['txtimage'] ['name'];
        move_uploaded_file($anhtam, '../images/'. $image);
        // kiểm tra điều kiện bắt buộc đối với các file không được bỏ trống
        if($user == "" || $pw == "" || $re_pw == "" || $fullname ==""|| $anhtam == "" ||$image == ""    ){
            echo "<script> alert ('Bạn vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            // kiểm tra tài khoản đã tồn tại chưa
            $sql = "SELECT * FROM register WHERE username = '$user'";
            $check_user = mysqli_query($conn, $sql);
            if(mysqli_num_rows($check_user) > 0){
                echo "<script> alert ('Tài khoản đã tồn tại')</script>";
            }
            // kiểm tra email đã có người dùng chưa
            // $sql = "SELECT * FROM dangky WHERE email = '$email'";
            // $check_email = mysqli_query($conn, $sql);
            // if(mysqli_num_rows($check_email) > 0){
            //     echo "<script> alert ('Email này đã có người dùng. Vui lòng chọn Email khác.')</script>";
            // }
            else{
                // thực hiện lệnh lưu trưc dữ liệu vào db
                $sql = "INSERT INTO register (username, pass, fullname, picture)
                VALUES ('$user', '$pw', '$fullname', '$image')";
                $run = mysqli_query($conn, $sql);
                if($run){
                    echo "<script> alert ('Bạn đã đăng ký thành công')</script>";
                }    
                else{
                    echo "<script> alert ('Đăng ký chưa hoàn tất')</script>";
                }   
            }
        }
        
    }   
?>
</body>
</html>