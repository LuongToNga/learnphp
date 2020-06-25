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
            height: 500px;
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
        a{
            color: white;
            /* text-decoration: none; */
        }

    </style>
</head>

<body>
    <form method="POST" >
        <div class="container">
        <div class="tittle">LOGIN</div>
            Student Code:
            <input class="form-insert" type="text" name="username" placeholder="username">
            Password:
            <input class="form-insert" type="password" name="pw" placeholder="Password">
            <input class="form-button" type="submit" name="ok" value=" Login">
            <?php
                $link_to_register = "http://localhost:8008/learnphp/RegisterRelearn/register-student.php";
            ?>
            <a href='<?php echo $link_to_register; ?>' target='_blank'>Register here?</a>
        </div>
    </form>   
    <?php 
    include('connect.php');
    if(isset($_POST['ok'])){
        $userName = $_POST ['username'];
        $passWord = $_POST ['pw'];
        if($userName == "" || $passWord == ""){
            echo"<script>alert('Bạn chưa nhập đủ thông tin')</script>";
        }
        $_SESSION['username'] = $userName;
        $_SESSION['pw'] = $passWord;
        $sql = "Select * from register2 where username ='$userName'";
        $run = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($run); // kiem tra pass
        if($num == 0){
            echo"<script>alert(' Không tồn tại người dùng')</script>";
        }
        else{
            $row= mysqli_fetch_array($run); // Kiem tra mat khau
            if($row['password'] == $passWord){
                header('location:register-relearn.php'); // chuyen trang
            }   
            else {
                echo"<script>alert('Sai mật khẩu')</script>";
            }
        }
    }
?>
</body>
</html>