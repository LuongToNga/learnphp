<?php
    session_start();
?>
<?php
include ('connect.php');
function fill_semester($conn){
    $output = '';
    $sql = "select * from semesters";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)){
        $output .= '<option value = "'.$row['semester_id'].'">'.$row['semester_name'].'</option>';
    }
    return $output;
};
function fill_subject($conn){
    $sql = " select * from subjects";
    $result = mysqli_query($conn, $sql);
    echo '<select name = "subject" id = "subject">';
    while ($row = mysqli_fetch_array($result)){
        echo '<option value = "'.$row['subject_name'].'"">'.$row['subject_name'].'</option>';
    }
    echo '</select>';
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
        <input class="form-insert" type="text" name="username" placeholder="Student Code">
        <input class="form-insert" type="text" name="fullname" placeholder="Fullname">
        
        Select Semester: 
        <select name="semester" id="semester">
            <?php echo fill_semester($conn);?>
        </select><br><br>

        
        Select Subject:
        <div class="row" name="subject" id="subject">
            <?php echo fill_subject($conn);?>
        </div>
   
        <input class="form-click" type="submit" name="ok" value="Print the invoice">
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
        if($userName == "" || $fullname == "" || $semester == "" || $subject == ""){
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
                    // echo "<script> alert ('Successful')</script>";
                    $invoiceName = fopen("Your-invoice.txt", "w") or die("Unable to open file!");
                    $contenFile = " ".PHP_EOL."Student Code: ".$_POST['username']."<br>" ."Fullname: ".$_POST['fullname']."<br>" ."Semester: ".$_POST['semester']."<br>" ."Subject: ".$_POST['subject'].PHP_EOL;
                    $openFile = fopen("Your-invoice.txt", 'a');
                    $record = fwrite ($openFile, $contenFile );
                    if ($record){
                        $query = "SELECT credit FROM subjects WHERE subject_name = '$subject'";
                        $run_sql = mysqli_query($conn, $query);
                        $row = mysqli_fetch_array($run_sql);
                        if (mysqli_num_rows($run_sql) == 0){
                            echo "<script> alert ('Môn học không hợp lệ')</script>";
                        }
                        else {
                            echo "<script> alert ('Hoàn thành')</script>";
                            $file = fopen("Your-invoice.txt", 'r') or exit ('Not found file');
                            echo "<h1>Hóa đơn</h1>"; 
                            while (!feof($file)){ // eof - end of file    
                                echo fgets($file)."<br>";
                            }
                            echo "Credit: " .$row['credit']."<br>"; 

                            echo "Tổng phí học lại là: " .$total = $row['credit'] * 200000;

                            $invoiceName2 = fopen("Your-invoice.txt", "w") or die("Unable to open file!");
                            $contenFile2 = " ".PHP_EOL."Student Code: ".$row['credit']."<br>" ."Fullname: ".$total."<br>".PHP_EOL;
                            $record2 = fwrite ($openFile2, $contenFile2 );
                        } 
                    } 
                    else{
                        echo "<script> alert ('Đăng ký chưa hoàn tất')</script>";
                    }  
                    
                }    
                 
            }
        }
        
    }   
?>
    
    