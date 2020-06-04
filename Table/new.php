<?php
include ('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHỌN MÔN HỌC</title>
</head>
<body>
    <form method = "POST">
        ID: <input type="text" name="id"><br> 
        Name: <input type="text" name="name"><br>
        Class
        <select type="text" name="class_name">
            <?php
                $query = "select * from class";
                $resuilt1 = mysqli_query($conn, $query);
                while ($row1 = mysqli_fetch_array($resuilt1)):;
            ?>
            <option value = "<?php echo $row1[1];?>">
                <?php echo $row1[1];?>
            </option>
            <?php endwhile;?>
                
        </select>
        <input type="submit" name="save" value="Lưu">

    </form>
    <?php
    if (isset ($_POST['save'])) {
        $id = $_POST ['id'];
        $name = $_POST ['name'];
        $class = $_POST ['class_name'];

        $sql = $conn -> prepare("insert into subject (id, name, nameClass) values ('$id', '$name', '$class')");
        
        $conn -> beginTransaction();
        $sql -> execute(array(':class_name' => $class));
        echo "<h2> Successful !</h2>";
        $conn -> commit();
    } 
    else{
        echo "<h2> Not successful !</h2>";
    }
    // $conn -> null
  ?>
</body>
</html>