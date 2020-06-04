<?php
    session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://fonts.googleapis.com/css?family=Chakra+Petch&display=swap" rel="stylesheet">
    <style>
        .container{
            width: 330px;
            height: 450px;
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
        .form-button{
            width: 220px;
            height: 50px; 
            margin: 10px 0 10px;
            background-color: black;
            color: white;
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
    <form method="POST" >
        <div class="container">
        <div class="tittle">LOGIN</div>
            Username:
            <input class="form-insert" type="text" name="txtusername" placeholder="username">
            Password:
            <input class="form-insert" type="password" name="txtpw" placeholder="Password">
            <input class="form-button" type="submit" name="ok" value=" Login">
        </div>
    </form>   
    <?php 
    include('connect.php');
    if(isset($_POST['ok'])){
        $user = $_POST ['txtusername'];
        $pass = $_POST ['txtpw'];
        if($user == "" || $pass == ""){
            echo"<script>alert('Ban chua nhap du thong tin')</script>";
        }
        $_SESSION['txtusername'] = $user;
        $_SESSION['txtpw'] = $pass;
        $sql = "Select * from register where username='$user'";
        $run = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($run); // kiem tra pass
        if($num == 0){
            echo"<script>alert(' Không tồn tại người dùng')</script>";
        }
        else{
            $row= mysqli_fetch_array($run); // Kiem tra mat khau
            if($row['pass'] == $pass){
                header('location:session.php'); // chuyen trang
            }
            else {
                echo"<script>alert('Sai mật khẩu')</script>";
            }
        }
    }
?>
</body>
</html>