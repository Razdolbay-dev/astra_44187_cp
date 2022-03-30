<?php include ("../db.php");?>
<?php include ("../header.php");?>
<?php
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Ошибка 1: " . $conn->connect_error);
}
// если запрос GET
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]))
{
    $id = $conn->real_escape_string($_GET["id"]);
    $sql = "select * from core_tuner WHERE id = '$id'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            foreach($result as $row){
                $title = $row["title"];
				$dvb_id = $row["dvb_id"];
				$adapter_id = $row["adapter_id"];
				$signal_type = $row["signal_type"];
				$frequency = $row["frequency"];
				$polarization = $row["polarization"];
				$symbolrate = $row["symbolrate"];
            }
            echo "
			<div class='container'>
			
                <form method='post'>
                    <input type='hidden' name='id' value='$id' />
					<div class='mb-3'>
						<label for='title' class='form-label'>Имя</label>
						<input type='text' class='form-control' id='title' name='title' value='$title' placeholder='Любое'>
					</div>
					<div class='mb-3'>
						<label for='stream_id' class='form-label'>ID</label>
						<input type='text' class='form-control' id='dvb_id' name='dvb_id' value='$dvb_id'  placeholder='Только на латинице'>
					</div>
					<div class='mb-3'>      
						<label for='signal_type' class='form-label'>Тип сигнала:</label>
						<input type='text' class='form-control' id='signal_type' name='signal_type' value='$signal_type' placeholder='dvb://...'>
					</div>
					<div class='mb-3'>
						<label for='frequency' class='form-label'>Frequency</label>
						<input type='text' class='form-control' id='frequency' name='frequency' value='$frequency' placeholder='udp://...'>
					</div>
					<div class='mb-3'>
						<label for='polarization' class='form-label'>Polarization</label>
						<input type='text' class='form-control' id='polarization' name='polarization' value='$polarization' placeholder='udp://...'>
					</div>
					<div class='mb-3'>
						<label for='symbolrate' class='form-label'>Symbolrate</label>
						<input type='text' class='form-control' id='symbolrate' name='symbolrate' value='$symbolrate' placeholder='udp://...'>
					</div>
					<a href='/' class='btn btn-secondary'>Назад</a>
                    <input type='submit' class='btn btn-primary' value='Сохранить'>
            </form></div>";
        }
        else{
            echo "<div>Not Found</div>";
        }
        $result->free();
		header("Location: /");
    } else{
        echo "Ошибка 2: " . $conn->error;
    }
}
elseif (isset($_POST["id"])) {
      
    $id = $conn->real_escape_string($_POST["id"]);
    $title = $conn->real_escape_string($_POST["title"]);
    $dvb_id = $conn->real_escape_string($_POST["dvb_id"]);
	$signal_type = $conn->real_escape_string($_POST["signal_type"]);
    $frequency = $conn->real_escape_string($_POST["frequency"]);
	$polarization = $conn->real_escape_string($_POST["polarization"]);
    $symbolrate = $conn->real_escape_string($_POST["symbolrate"]);
	
    $sql = "update core_tuner set title = '$title', dvb_id = '$dvb_id', signal_type = '$signal_type', frequency = '$frequency', polarization = '$polarization', symbolrate = '$symbolrate' WHERE id = '$id'";
    if($result = $conn->query($sql)){
        header("Location: /");
		echo "<div class='container mt-5'><div class='alert alert-success' role='alert'>
		Запись обновлена! <a href='/'>Вернуться ?</a>
	  </div></div>";
    } else{
        echo "Ошибка 3: " . $conn->error;
    }
}
else{
    echo "Некорректные данные";
}
$conn->close();
?>
<?php include ("../footer.php");?>
<!-- end newstream -->