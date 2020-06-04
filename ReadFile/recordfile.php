<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read File</title>
</head>
<body>
    <form method = "POST">
        File name: <input type = "text" name = "namefile">
        Enter content here: <input type = "text" name = "contentfile">
        <input type = "submit" name ="save" value="Save File"><br><br>
    </form>
    
    <?php
    if(isset($_POST['save'])){
        $file_name = $_POST['namefile'];
        $conten_file = " ".PHP_EOL.$_POST['contentfile'].PHP_EOL;
        $openFile = fopen($file_name.".txt", 'a');   
        $record = fwrite ($openFile, $conten_file );
        if ($record){
            echo "Successful";
        } 
        else{
            echo "Not recorded file";
        }
        $file = fopen($file_name. ".txt", 'r') or exit ('Not found file');
        while (!feof($file)){ // eof - end of file
            echo "<br>". "Content file is: " . "<br>" . fgets($file) ."<br>";
        }
    }
    ?>
</body>
</html>