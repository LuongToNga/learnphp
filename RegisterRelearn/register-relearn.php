<?php
include ('connect.php');
function fill_semester($conn){
    $output = '';
    $sql = "select * from semesters";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)){
        $ouput .= '<option value = "'.$row['semester_id'].'">'.$row['semester_name'].'</option>';
    }
    return $ouput;
};
function fill_subject($conn){
    $output = '';
    $sql = " select * from subjects";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)){
        $output .= '<div style = "border: 3px solid white; padding: 20px;">'.$row['subject_name'].'';
        $output .= '</div>';

    }
    return $output;
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link href="https://fonts.googleapis.com/css?family=Chakra+Petch&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .container{
            width: 330px;
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
    <form method="POST" action="register-relearn.php" >
        <div class="container">
        <div class="tittle">REGISTER RELEARN</div>
        <input class="form-insert" type="text" name="username" placeholder="Your Username">
        <input class="form-insert" type="text" name="fullname" placeholder="Your Fullname">
        
        Select Semester: 
        <select name="semester" id="semester">
            <option value = "">Show All Semester</option>
            <?php echo fill_semester($conn);?>
        </select><br><br>

        
        Select Subject:
        <div class="row" id="subject">
            <?php echo fill_subject($conn);?>
        </div>
   
        <input class="form-click" type="submit" name="ok" value="Register">
        <input class="form-click" type="reset" name="cancel" value="Cancel">
        </div>
    </form>
    </body>
</html>  
<script>
$(document).ready(function(){
    $('#semester').change(function(){
        var semester_id = $(this).val();
        $.ajax({
            url: "load_data.php",
            method: "POST",
            data: {semester_id:semester_id},
            success: function(data){
                $('#subject').html(data);
            }
        });
    });
});

</script>
<?php 
    
    if(isset($_POST['ok'])){
        $userName = $_POST['username'];
        $fullname = $_POST['fullname'];
        $semester = $_POST['semester']; 
        $subject = $_POST['subject'];    
        // kiểm tra điều kiện bắt buộc đối với các file không được bỏ trống
        if($userName == "" || $passWord == "" || $semester == "" || $subject == ""){
            echo "<script> alert ('Bạn vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            // kiểm tra tài khoản đã tồn tại chưa
            $sql = "SELECT * FROM register2 WHERE username = '$userName'";
            $check_user = mysqli_query($conn, $sql);
            if(mysqli_num_rows($check_user) == 0){
                echo "<script> alert ('Sinh viên không tồn tại')</script>";
            }
            else{
                // thực hiện lệnh lưu trưc dữ liệu vào db
                $sql = "INSERT INTO relearn (username, fullname, semester, subject)
                VALUES ('$userName', '$fullname', '$semester', '$subject')";
                $run = mysqli_query($conn, $sql);
                if($run){
                    echo "<script> alert ('Bạn đã đăng ký môn học thành công')</script>";
                }    
                else{
                    echo "<script> alert ('Đăng ký chưa hoàn tất')</script>";
                }   
            }
        }
        
    }   
?>
    
    