<?php

$date = date('dMYHis');
$imageData = $_POST['cat'];

if (!empty($_POST['cat'])) {
    error_log("Received" . "\r\n", 3, "Log.log");
}

$filteredData = substr($imageData, strpos($imageData, ",") + 1);
$unencodedData = base64_decode($filteredData);

// Pastikan folder 'photo' ada
$folder = "photo/";
if (!is_dir($folder)) {
    mkdir($folder, 0777, true); // Buat folder jika belum ada
}

// Simpan file di dalam folder 'photo'
$filePath = $folder . 'cam' . $date . '.png';
$fp = fopen($filePath, 'wb');

if ($fp) {
    fwrite($fp, $unencodedData);
    fclose($fp);
    echo "File berhasil disimpan: " . $filePath;
} else {
    echo "Gagal menyimpan file!";
}

exit();
?>
