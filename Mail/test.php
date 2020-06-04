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
    <form method="POST" action="test.php" >
        <div class="container">
        <div class="tittle">REGISTER</div>
            <input class="form-insert" type="text" name="txthoten" placeholder="Hoten">
            <input class="form-click" type="submit" name="ok" value="Register">
            
        </div>
    </form>   
    <?php 
    include ('connect.php');
    if(isset($_POST['ok'])){
        $hoten = $_POST['txthoten'];
        // kiểm tra điều kiện bắt buộc đối với các file không được bỏ trống
        if($hoten == ""){
            echo "<script> alert ('Bạn vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            // kiểm tra tài khoản đã tồn tại chưa
            $sql = "SELECT * FROM test WHERE hoten = '$hoten'";
            $check_user = mysqli_query($conn, $sql);
            if (mysqli_num_rows($check_user) > 0){
                echo "<script> alert ('Tài khoản đã tồn tại')</script>";
            }
            // // kiểm tra email đã có người dùng chưa
            // $sql = "SELECT * FROM studentregister WHERE email = '$email'";
            // $check_email = mysqli_query($conn, $sql);
            // if (mysqli_num_rows($check_email) > 0){
            //     echo "<script> alert ('Email này đã có người dùng. Vui lòng chọn Email khác.')</script>";
            // }
            else{
                // thực hiện lệnh lưu  dữ liệu vào db
                $sql = "INSERT INTO test (hoten)
                VALUES ('$hoten')";
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