<?php
    session_start();
    // $laysession=$_SESSION['txtusername'];echo $laysession;
    // $laysession2=$_SESSION['txtpw']; echo $laysession2;
    include('connect.php');
    $us = $_SESSION['txtusername'];
    if(empty($us)) {
        header('location:login.php');
    }
    else{
        $sql = "SELECT * FROM register WHERE username  = '$us'";
        $run = mysqli_query($conn, $sql);
        // mysqli_num_rows($run);// dem so ban ghi co trong database
        $row = mysqli_fetch_array($run); // dua du lieu tu database vao mang
        echo "Xin chào " .$row['fullname'] ." đang đăng nhập!";
        // echo $row['picture'];
        // echo .$row['pass']
    }
    ?>
    <img src="../images/<?php echo $row['picture'];?>" style="width: 50px; height: 50px; border-radius: 100%;">
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            width: 330px;
            height: 550px;
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
    <div class="tittle">CHANGE PASSWORD</div>
        Password Current:
        <input class="form-insert" type="password" name="txtcurrentpass" placeholder="Current password">
        New Password:
        <input class="form-insert" type="password" name="txtnewpass" placeholder="new password">
        Confirm Password:
        <input class="form-insert" type="password" name="txtconfirmpass" placeholder="Confirm Password">
        <input class="form-button" type="submit" name="ok" value=" Change Password">
    </div>
</form>   
<?php
if(isset($_POST['ok'])){
    $pass = $_POST['txtcurrentpass'];
    $passnew = $_POST['txtnewpass'];
    $confirmpass = $_POST['txtconfirmpass'];
    if($row['pass'] != $pass){
        echo "<script> alert ('Pass hien tai khong dung')</script>";
    }
    else{
        if($passnew != $confirmpass){
            // echo "<script> alert ('New password vaf Confirm password phai trung nhau')</script>";
        }
        else{
            $sqlpass = "UPDATE register SET pass = '$passnew' WHERE username = '$us'";
            $runpass = mysqli_query($conn, $sqlpass);
            if($runpass){
                echo "<script> alert ('Password da duoc cap nhat')</script>";
            }
            else{
                echo "<script> alert ('Password chua duoc cap nhat')</script>";
            }
        }
        
    }
    
}   
?>    
</body>
</html>