<head>
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Chakra Petch', sans-serif;
        text-align: center;
    }
    td{
        padding: 5px 10px;
        box-sizing: border-box;
        
        /* background-color: lightpink; */
    }
    .btn-out{
        background-color: black;
        color: white;
        text-decoration: none;
        border: 1px solid white;
        margin: 0 15px;
        padding: 10px;
        box-sizing: border-box;
    }
    table{
        display: inline-block;
        border: 2px solid black;
    }
    .title-db{
        background-color: darkslategray;
        color: lightsalmon;
    }
    .option_image:hover{
        box-shadow: 0 0 7px grey;
    }
</style>

<?php
    session_start();
    // $laysession=$_SESSION['txtusername'];echo $laysession;
    // $laysession2=$_SESSION['txtpw']; echo $laysession2;
    include('connect.php');
    $us = $_SESSION['txtusername'];
    if(empty($us))
        header('location:login.php');

    else{
        $sql = "SELECT * FROM register WHERE username  = '$us'";
        $run = mysqli_query($conn, $sql);
        // mysqli_num_rows($run);// dem so ban ghi co trong database
        $row = mysqli_fetch_array($run); // dua du lieu tu database vao mang
        echo "Xin chào " .$row['fullname'] ." đang đăng nhập!";
        // echo $row['picture'];

?>
<img src="../images/<?php echo $row['picture'];?>" style="width: 100px; height: 100px; border-radius: 100%; padding: 0;">
<a class="btn-out" href = 'logout.php'> Thoát Khỏi hệ thống </a>
<a class="btn-out" href = 'changePass.php'> Đổi mật khẩu </a>
<br>
<br>
<br>
<table>
    <tr>
        <td class="title-db">ID</td>
        <td  class="title-db">Username</td>
        <td  class="title-db">Fullname</td>
        <td  class="title-db">Picture</td>
        <td  class="title-db" colspan="2">Tùy chọn</td>

    </tr>

    <?php
        $sqlselect = "select * from register";
        $runselect = mysqli_query($conn, $sqlselect);
        while($rowSelect = mysqli_fetch_array($runselect))
        {
    
    ?>
    <tr>
        <td><?php echo $rowSelect ['id'] ?></td>
        <td><?php echo $rowSelect ['username'] ?></td>
        <td><?php echo $rowSelect ['fullname'] ?></td>
        <td><img src= "../images/<?php echo $rowSelect ['picture'] ?>" width="70px" height="70px"/></td>      
        <td title="update">
            <a href="update.php">
                <img src="../images/update.svg" width= "50px" height = "50px" class="option_image">
            </a>
        </td>
        <td title="delete">
            <a href="delete.php">
                <img src="../images/delete.svg" width= "50px" height = "50px" class="option_image">
            </a>
        </td>
    </tr>
    <?php } ?>

</table>
<?php } ?>