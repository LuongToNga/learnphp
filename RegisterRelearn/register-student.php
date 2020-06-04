<?php
include ('connect.php');
?>
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
            height: 700px;
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
        <div class="tittle">REGISTER STUDENT</div>
            <input class="form-insert" type="text" name="username" placeholder="Your Username">
            <input class="form-insert" type="password" name="pw" placeholder="Your Password">
            <input class="form-insert" type="password" name="re_pw" placeholder="Re-password">
            <input class="form-insert" type="text" name="email" placeholder="Your Email">
            <input class="form-insert" type="text" name="fullname" placeholder="Your Fullname">
            Select Class Name: 
            <select type="text" name="classname">
            <?php
                $query = "select * from class";
                $resuilt1 = mysqli_query($conn, $query);
                while ($row1 = mysqli_fetch_array($resuilt1)):;
            ?>
            <option value = "<?php echo $row1[1];?>">               
                <?php echo $row1[1];?>
            </option>
            <?php endwhile;?>     
        </select><br>
            Hình ảnh
            <input type="file" name="image" >
            <input class="form-click" type="submit" name="ok" value="Register">
            <input class="form-click" type="reset" name="cancel" value="Cancel">
        </div>
    </form>   
    <?php 
    
    if(isset($_POST['ok'])){
        $userName = $_POST['username'];
        $passWord = $_POST['pw'];
        $rePassWord = $_POST['re_pw'];
        $email = $_POST['email'];
        $fullName = $_POST['fullname']; 
        $className = $_POST['classname'];    

        $anhtam = $_FILES['image'] ['tmp_name'];
        $image = $_FILES['image'] ['name'];
        move_uploaded_file($anhtam, '../images/'. $image);
        // kiểm tra điều kiện bắt buộc đối với các file không được bỏ trống
        if($userName == "" || $passWord == "" || $rePassWord == "" || $email =="" || $fullName =="" || $anhtam == ""){
            echo "<script> alert ('Bạn vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            // kiểm tra tài khoản đã tồn tại chưa
            $sql = "SELECT * FROM register2 WHERE username = '$userName'";
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
                $sql = "INSERT INTO register2 (username, password, email, fullname, classname, picture)
                VALUES ('$userName', '$passWord', '$email', '$fullName', '$className', '$image')";
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