<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $namaFile = 'data.conf';
    $response = array();
    $file = fopen($namaFile, "r");

    while (!feof($file)) {
        $baris = fgets($file);
        $data[] = explode(",", $baris);
    }

    fclose($file);
    echo json_encode($data[0]);
}
