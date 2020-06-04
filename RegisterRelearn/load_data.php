
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

    while($row = mysqli_fetch_array($result)){
        $output .= '<div style = "border: 3px solid white; padding: 20px;">'.$row['subject_name'].'</div>';
    }
    echo $output;
}
?>
