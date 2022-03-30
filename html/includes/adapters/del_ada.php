<?php
include ("../../includes/db.php");
if(isset($_POST["id"]))
{
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $urlid = $conn->real_escape_string($_POST["id"]);
    $sql = "DELETE FROM core_tuner WHERE id = '$urlid'";
    
    if($conn->query($sql)){
        header("Location: /");
    }
    else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();  
}
?>