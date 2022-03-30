<?php
include ("includes/db.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM core_tuner";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    // echo "<p>Получено объектов: $rowsCount</p>";
    foreach($result as $row){
        echo'<div class="col">';
        echo '<div class="card m-2 shadow-sm" style="max-width: 18rem;" >';
        echo '<div class="card-body">';
            echo '
            <div class="row">
            <div class="col">
            <h6 class="card-title"><a class="link-dark" href="includes/adapters/update.php?id='. $row["id"] .'">' . $row["title"] . '</a></h6>
            </div>
            <div class="col" style="max-width: 2rem; float: right;">
            <form action="includes/adapters/del_ada.php" method="post">
                <input type="hidden" name="id" value='. $row["id"] .'/>
                <input style="max-width: 3px; max-height: 3px;" type="submit" class="btn-close" value="">
            </form>
            </div>
            </div>
            ';
            echo '<div class="progress">';
            if($row["snr"]>=75){
                echo '<div class="progress-bar bg-success" role="progressbar" style="width: ' . $row["snr"] . '%" aria-valuenow="' . $row["snr"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["snr"] . ' %</div>';
            } elseif($row["snr"]<=74 && $row["snr"]>=50){
                echo '<div class="progress-bar bg-info" role="progressbar" style="width: ' . $row["snr"] . '%" aria-valuenow="' . $row["snr"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["snr"] . ' %</div>';
            } elseif($row["snr"]<=50 && $row["snr"]>=25){
                echo '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $row["snr"] . '%" aria-valuenow="' . $row["snr"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["snr"] . ' %</div>';
            } elseif($row["snr"]<=24){
                echo '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $row["snr"] . '%" aria-valuenow="' . $row["snr"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["snr"] . ' %</div>';
            } else{
                echo '<div class="progress-bar bg-danger" role="progressbar" style="width:100%" aria-valuenow="' . $row["snr"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["snr"] . ' %</div>';
            }
            echo '</div>';
            echo '<div class="progress mt-2">';
            if($row["bitrate"]>=75){
                echo '<div class="progress-bar bg-success" role="progressbar" style="width: ' . $row["bitrate"] . '%" aria-valuenow="' . $row["bitrate"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["bitrate"] . ' %</div>';
            } elseif($row["bitrate"]<=74 && $row["bitrate"]>=50){
                echo '<div class="progress-bar bg-info" role="progressbar" style="width: ' . $row["bitrate"] . '%" aria-valuenow="' . $row["bitrate"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["bitrate"] . ' %</div>';
            } elseif($row["bitrate"]<=50 && $row["bitrate"]>=25){
                echo '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $row["bitrate"] . '%" aria-valuenow="' . $row["bitrate"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["bitrate"] . ' %</div>';
            } elseif($row["bitrate"]<=24){
                echo '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $row["bitrate"] . '%" aria-valuenow="' . $row["bitrate"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["bitrate"] . ' %</div>';
            } else{
                echo '<div class="progress-bar bg-danger" role="progressbar" style="width:100%" aria-valuenow="' . $row["bitrate"] . '" aria-valuemin="0" aria-valuemax="100">' . $row["bitrate"] . ' %</div>';
            }
            echo '</div>';
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
