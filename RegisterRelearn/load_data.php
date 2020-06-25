
<?php
include ('connect.php');
$output = '';
if(isset($_POST['semester_id'])){
    if ($_POST['semester_id'] != ''){
        $sql = "select * from subjects where semester_id = '".$_POST['semester_id']."'";
    }
    else{
        $sql = "select * from semesters";
    }
    $result = mysqli_query($conn, $sql);
    echo '<select name = "subject" id = "subject">';
    while($row = mysqli_fetch_array($result)){
        
        echo '<option value = "'.$row['subject_name'].'"">'.$row['subject_name'].'</option>';
       
    }
    echo '</select>'; 
}
?>
