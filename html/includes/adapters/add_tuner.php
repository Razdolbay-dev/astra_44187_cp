<?php include ("../db.php");?>
<?php include ("../header.php");?>
      <div class="modal-body">
      <form method="get">
      <div class="mb-3">
        <label for="title" class="form-label">Имя</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Любое">
      </div>
      <div class="mb-3">
        <label for="dvbid" class="form-label">DVB ID</label>
        <input type="text" class="form-control" id="dvbid" name="dvbid" placeholder="Только на латинице">
      </div>
      <div class="mb-3">
        <label for="adapterid" class="form-label">Номер адаптера</label>
        <input type="text" class="form-control" id="adapterid" name="adapterid" placeholder="Посмотреть на сервере">
      </div>
      <div class="mb-3">      
        <label for="sigtype" class="form-label">Тип сигнала</label>
        <input type="text" class="form-control" id="sigtype" name="sigtype" placeholder="Signal Type...">
      </div>
      <div class="mb-3">
        <label for="freq" class="form-label">Frequency</label>
        <input type="text" class="form-control" id="freq" name="freq" placeholder="Frequency">
      </div>
      <div class="mb-3">
        <label for="pola" class="form-label">Polarization</label>
        <input type="text" class="form-control" id="pola" name="pola" placeholder="Polarization">
      </div>
      <div class="mb-3">
        <label for="symb" class="form-label">Symbolrate</label>
        <input type="text" class="form-control" id="symb" name="symb" placeholder="Symbolrate">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">LNB</span>
        <input type="text" aria-label="lof1" id="lof1" name="lof1" value="0" class="form-control">
        <input type="text" aria-label="lof2" id="lof2" name="lof2" value="0" class="form-control">
        <input type="text" aria-label="slof" id="slof" name="slof" value="0" class="form-control">
      </div>
      <div class="modal-footer">
        <a href="/" class="btn btn-secondary">Закрыть</a>
        <button type="submit" name="AddTunerSubmit" class="btn btn-primary" value="Submit">Добавить</button>
      </div>
    </form>
      <?php
      
      if(isset($_GET['AddTunerSubmit'])) {
      $titleform=$_GET['title'];
      $dvbidform=$_GET['dvbid'];
      $adapteridform=$_GET['adapterid'];
      $sigtypeform=$_GET['sigtype'];
      $freqform=$_GET['freq'];
      $polaform=$_GET['pola'];
      $symbform=$_GET['symb'];
      $lof1form=$_GET['lof1'];
      $lof2form=$_GET['lof2'];
      $slofform=$_GET['slof'];
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_errno) {
          echo "Извините, возникла проблема на сайте";
          echo "Ошибка: Не удалась создать соединение с базой MySQL и вот почему: ";
          echo "Номер ошибки: " . $conn->connect_errno . " ";
          echo "Ошибка: " . $conn->connect_error . " ";
          exit;
      }
      $title = '"'.$conn->real_escape_string($titleform).'"';
      $dvbid = '"'.$conn->real_escape_string($dvbidform).'"';
      $url = '"'.$conn->real_escape_string($dvbidform).'"';
      $adapterid = '"'.$conn->real_escape_string($adapteridform).'"';
      $sigtype = '"'.$conn->real_escape_string($sigtypeform).'"';
      $freq = '"'.$conn->real_escape_string($freqform).'"';
      $pola = '"'.$conn->real_escape_string($polaform).'"';
      $symb = '"'.$conn->real_escape_string($symbform).'"';
      $lof1 = '"'.$conn->real_escape_string($lof1form).'"';
      $lof2 = '"'.$conn->real_escape_string($lof2form).'"';
      $slof = '"'.$conn->real_escape_string($slofform).'"';
      if(lof1 === 0 && lof2 === 0 && slof === 0){
        $query = "INSERT INTO core_tuner (title,dvb_id,url,adapter_id,signal_type,frequency,polarization,symbolrate) VALUES ($title,$dvbid,$url,$adapterid,$sigtype,$freq,$pola,$symb)"; //готовим запрос. будем выбирать все из //таблицы workers
      }
      else{
        $query = "INSERT INTO core_tuner (title,dvb_id,url,adapter_id,signal_type,frequency,polarization,symbolrate,lof1,lof2,slof) VALUES ($title,$dvbid,$url,$adapterid,$sigtype,$freq,$pola,$symb,$lof1,$lof2,$slof)";
      }
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
<!-- end newstream -->
