<?php
include ("db.php");
$conn = new mysqli($servername, $username, $password, $dbname);
$filename_out="../config.ini";
$f_out=fopen($filename_out,"w+t") or die("Ошибка при создании файла");
//Генерация тюнера

$sql = "SELECT * FROM core_tuner";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; 
    foreach($result as $row){
        fwrite($f_out,$row["dvb_id"].' = dvb_tune({type = "'.$row["signal_type"].'", adapter = '.$row["adapter_id"].', tp = "'.$row["frequency"].':'.$row["polarization"].':'.$row["symbolrate"].'", lnb = "'.$row["lof1"].':'.$row["lof2"].':'.$row["slof"].'",');
        fwrite($f_out,"\n"."callback = function(data)");
        fwrite($f_out,"\n"."content = json.encode({");
        fwrite($f_out,"\n".'    type = "dvb",');
        fwrite($f_out,"\n".'    adapter = "'.$row["adapter_id"].'",');
        fwrite($f_out,"\n".'    name = "'.$row["dvb_id"].'",');
        fwrite($f_out,"\n".'    signal = math.floor((data.signal*100)/65536),');
        fwrite($f_out,"\n".'    status = data.status,');
        fwrite($f_out,"\n"."    snr = math.floor(((data.snr*100)/65536)),");
        fwrite($f_out,"\n"."    ber = data.ber,");
        fwrite($f_out,"\n"."    unc = data.unc,");
        fwrite($f_out,"\n"."})");
        fwrite($f_out,"\n"."send_monitor(content)");
        fwrite($f_out,"\n"."end");
        fwrite($f_out,"\n"."})");
        fwrite($f_out,"\n");
    }
    $result->free();
} else{
    echo "Ошибка: " . $conn->error;
}
fwrite($f_out,"\n");
//Генерация списка каналов
fwrite($f_out,"channels = {");
$sql = "SELECT * FROM core_stream";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; 
    foreach($result as $row){
        fwrite($f_out,"\n".'    {name = "'. $row["title"] .'", input = {"'. $row["input_u"] .'"}, output = {"'. $row["output_u"] .'"}, enable = true},');
    }
    $result->free();
} else{
    echo "Ошибка: " . $conn->error;
}
fwrite($f_out,"\n"."}");

fclose($f_out);
$conn->close();
echo "Сохранено!";
echo exec('sudo /etc/init.d/astra4 restart')
?>