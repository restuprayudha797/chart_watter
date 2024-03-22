<?php

function bacaFile($namaFile)
{
    $data = array();
    $file = fopen($namaFile, "r");

    while (!feof($file)) {
        $baris = fgets($file);
        $data[] = explode(",", $baris);
    }

    fclose($file);
    return $data;
}

function ubahData($data, $indeks, $nilaiBaru)
{
    foreach ($data as $key => $value) {
        if (isset($data[$key][$indeks])) {
            $data[$key][$indeks] = $nilaiBaru;
        }
    }
    return $data;
}

function tulisFile($namaFile, $data)
{
    $file = fopen($namaFile, "w");

    foreach ($data as $baris) {
        fwrite($file, implode(",", $baris));
    }

    fclose($file);
}


if (!$_GET['water_height']) {

    echo "akses ditolak, silahkan masukkan parameter yang sudah ditentukan!";
    
} else {

    if (!$_GET['clock']) {

        echo "akses ditolak, silahkan masukkan parameter yang sudah ditentukan!";
    } else {

        $namaFile = "data.conf";
        $data_index_0 = bacaFile($namaFile);
        $data_index_0 = ubahData($data_index_0, 0, $_GET['water_height']);
        tulisFile($namaFile, $data_index_0);

        $data_index_1 = bacaFile($namaFile);
        $data_index_1 = ubahData($data_index_1, 1, $_GET['clock']);
        tulisFile($namaFile, $data_index_1);
    }
}


    



// var_dump(bacaFile($namaFile)[0][1]);
