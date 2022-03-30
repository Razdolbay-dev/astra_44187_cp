<?php
include ("includes/db.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM core_stream";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    // echo "<p>Получено объектов: $rowsCount</p>";
    foreach($result as $row){
        echo'<div class="col">';
        echo '<div class="card shadow-sm m-2" style="max-width: 20rem;">';
        echo '<div class="card-body">';
            echo '<div class="row">
            <div class="col">
            <h6 class="card-title"><a class="link-dark" href="includes/channels/update.php?id='. $row["id"] .'">' . $row["title"] . '</a></h6>
            </div>
            <div class="col" style="max-width: 2rem; float: right;">
            <form action="includes/channels/del_channel.php" method="post">
                <input type="hidden" name="id" value='. $row["id"] .'/>
                <input style="max-width: 3px; max-height: 3px;" type="submit" class="btn-close" value="">
            </form>
            </div>
            </div>
            ';
            if($row["bitrate"]>21){
                echo '<a href="#" class="card-link link-success">' . $row["bitrate"] . ' Kbit/s </a>';
            } else{
                echo '<a href="#" class="card-link link-danger">' . $row["bitrate"] . ' Kbit/s </a>';
            }
            echo "</div>";
        echo "</div>";
        echo"</div>";
    }
    $result->free();
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();
?>
