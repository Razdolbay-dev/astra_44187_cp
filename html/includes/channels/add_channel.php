<!-- newstream -->
<?php include ("../db.php");?>
<?php include ("../header.php");?>
<div class="container-fluid">
      <form method="get">
      <div class='form-check mb-3'>
      <input class='form-check-input' type='checkbox' name="stat" value='1' id='flexCheckChecked' checked>
					<label class='form-check-label' for='flexCheckChecked'>
						Enable
					</label>
					</div>
      <div class="mb-3">
        <label for="title" class="form-label">Имя</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Любое">
      </div>
      <div class="mb-3">
        <label for="strid" class="form-label">ID</label>
        <input type="text" class="form-control" id="strid" name="strid" placeholder="Только на латинице">
      </div>
      <div class="mb-3">      
        <label for="inpt" class="form-label">Input</label>
        <input type="text" class="form-control" id="inpt" name="inpt" placeholder="dvb://...">
      </div>
      <div class="mb-3">
        <label for="outpt" class="form-label">Output</label>
        <input type="text" class="form-control" id="outpt" name="outpt" placeholder="udp://...">
      </div>
      <div class="modal-footer">
      <a href="/" class="btn btn-secondary">Закрыть</a>
        <button type="submit" name="AddStreamSubmit" class="btn btn-primary" value="Submit">Добавить</button>
      </div>
    </form>
<?php
if(isset($_GET['AddStreamSubmit'])) {
$titleform=$_GET['title'];
$stridform=$_GET['strid'];
$inptform=$_GET['inpt'];
$outptform=$_GET['outpt'];
$statform=$_GET['stat'];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "Номер ошибки: " . $conn->connect_errno . " ";
    echo "Ошибка: " . $conn->connect_error . " ";
    exit;
}
$title = '"'.$conn->real_escape_string($titleform).'"';
$strid = '"'.$conn->real_escape_string($stridform).'"';
$inpt = '"'.$conn->real_escape_string($inptform).'"';
$outpt = '"'.$conn->real_escape_string($outptform).'"';
$stat = '"'.$conn->real_escape_string($statform).'"';
$query = "INSERT INTO core_stream (title,stream_id,url,input_u,output_u,enable) VALUES ($title,$strid,$strid,$inpt,$outpt,$stat)"; //готовим запрос. будем выбирать все из //таблицы workers
$result = $conn->query($query); // выполняем запрос query.
//объект результата сохраняем в $result
if($result){
  header("Location: /");
}else{
die('Error : ('. $conn->errno .') '. $conn->error);
}
$conn->close();
}
?>
</div>
<?php include ("../footer.php");?>