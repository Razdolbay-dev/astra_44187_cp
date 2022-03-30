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
    $sql = "select * from core_stream WHERE id = '$id'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            foreach($result as $row){
                $title = $row["title"];
				$stream_id = $row["stream_id"];
				$input_u = $row["input_u"];
				$output_u = $row["output_u"];
				$enable = $row["enable"];
            }
			if($enable === 1){
				$status_check = 'flexCheckChecked';
				$check_val = 1;
			}else{
				$status_check = 'flexCheckDefault';
				$check_val = 0;
			}
            echo "
			<div class='container'>
			
                <form method='post'>
                    <input type='hidden' name='id' value='$id' />

					<div class='form-check mb-3'>
					<input class='form-check-input' type='checkbox' name='enable' value='1' id='flexCheckChecked' checked>
					<label class='form-check-label' for='flexCheckChecked'>
						Enable
					</label>
					</div>
					<div class='mb-3'>
						<label for='title' class='form-label'>Имя</label>
						<input type='text' class='form-control' id='title' name='title' value='$title' placeholder='Любое'>
					</div>
					<div class='mb-3'>
						<label for='stream_id' class='form-label'>ID</label>
						<input type='text' class='form-control' id='stream_id' name='stream_id' value='$stream_id'  placeholder='Только на латинице'>
					</div>
					<div class='mb-3'>      
						<label for='input_u' class='form-label'>Input</label>
						<input type='text' class='form-control' id='input_u' name='input_u' value='$input_u' placeholder='dvb://...'>
					</div>
					<div class='mb-3'>
						<label for='output_u' class='form-label'>Output</label>
						<input type='text' class='form-control' id='output_u' name='output_u' value='$output_u' placeholder='udp://...'>
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
elseif (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["stream_id"])) {
      
    $id = $conn->real_escape_string($_POST["id"]);
	$enable = $conn->real_escape_string($_POST["enable"]);
    $title = $conn->real_escape_string($_POST["title"]);
    $stream_id = $conn->real_escape_string($_POST["stream_id"]);
	$input_u = $conn->real_escape_string($_POST["input_u"]);
    $output_u = $conn->real_escape_string($_POST["output_u"]);	

    $sql = "update core_stream set enable = '$enable', title = '$title', stream_id = '$stream_id', input_u = '$input_u', output_u = '$output_u' WHERE id= '$id'";
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