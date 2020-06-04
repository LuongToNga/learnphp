<?php
session_start();
$huy = session_destroy();
if($huy){
    echo"Khong con session";
}
else{
    header('location: login.php');
}
?>