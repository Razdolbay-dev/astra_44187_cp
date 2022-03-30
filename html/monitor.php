<?php
include ("includes/db.php");

$link = new mysqli($servername, $username, $password, $dbname);
if ($link->connect_error) {
    //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    die("Ошибка: " . $link->connect_error);
}

//parsing json;
$data = json_decode(file_get_contents("php://input"), true);
$type = $data['type'];

if ($type == "stream"){
  $sql = 'UPDATE core_stream SET bitrate = "'.$data['bitrate'].'", cc_error = "'.$data['cc_error'].'" , pes_error = "'.$data['pes_error'].'" WHERE title = "'.$data['channel_id'].'";';
}
elseif ($type == "dvb"){
  $sql = 'UPDATE core_tuner SET snr = "'.$data['snr'].'", bitrate = "'.$data['signal'].'" , unc = "'.$data['unc'].'" , ber = "'.$data['ber'].'" WHERE adapter_id = "'.$data['adapter'].'" and dvb_id = "'.$data['name'].'" ;';
}

if ($link->query($sql) === TRUE) {
    echo "Insert your JSON record successfully";
  } 
?>

