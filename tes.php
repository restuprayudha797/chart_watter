<?php


function ubahAngka($input)
{
    // Array untuk memetakan angka ke angka lainnya
    $mapping = [
        30 => 1,
        29 => 2,
        28 => 3,
        // Tambahkan angka-angka lainnya di sini sesuai dengan aturan yang Anda inginkan
    ];

    // Jika input ada dalam array mapping, kembalikan nilainya, jika tidak, kembalikan input
    return isset($mapping[$input]) ? $mapping[$input] : $input;
}

$data = ubahAngka(30);
var_dump($data);
