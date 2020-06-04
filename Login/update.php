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
        $id=$row['id'];
    }
?>
<img src="../images/<?php echo $row['picture'];?>" style="width: 50px; height: 50px; border-radius: 100%;">
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE</title>
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
<form method="POST" action="update.php" enctype="multipart/form-data">
    <div class="container">
    <div class="tittle">UPDATE</div>
        <input class="form-insert" type="text" name="txtusername" placeholder="username">
        <input class="form-insert" type="password" name="txtpw" placeholder="password">
        <input class="form-insert" type="password" name="txtre_pw" placeholder="re-password">
        <input class="form-insert" type="text" name="txtfullname" placeholder="fullname">
        Hình ảnh
        <input type="file" name="txtimage" >
        <input class="form-click" type="submit" name="ok" value="UPDATE">
        <input class="form-click" type="refresh" name="Cancel" value="CANCEL">
    </div>
</form>     
</body>
</html>

<?php 
    include('connect.php');
    if (isset($_POST['ok'])){
        $image = $_FILES['txtimage'] ['name'];
        if ($_POST['txtusername'] == "" || $_POST['txtpw'] == "" || $_POST['txtfullname'] == "" || $_FILES['txtimage'] ['tmp_name'] = "" || $_FILES['txtimage'] ['name'] = "") {
            echo '<script type="text/javascript"> alert (" vui long dien day du thong tin vao cac muc")</script>';
        }
        else {
            $user = $_POST['txtusername'];
            $pw = $_POST['txtpw'];
            $re_pw = $_POST['txtre_pw'];
            $fullname = $_POST['txtfullname'];        
            $anhtam = $_FILES['txtimage'] ['tmp_name'];
            $image = $_FILES['txtimage'] ['name'];
            move_uploaded_file($anhtam, '../images/'. $image);
        }
        $sql_update = "UPDATE register SET username = '$user', pass = '$pw', fullname = '$fullname', picture = '$image'
         WHERE id = '$id'"; 
        $sql_run = mysqli_query($conn, $sql_update);
        if ($sql_run) {
            echo '<script type="text/javascript"> alert (" update thanh cong")</script>';
        }
        else {
            echo '<script type="text/javascript"> alert (" update that bai")</script>';
        }
    }
?>