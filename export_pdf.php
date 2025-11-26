<?php
// export_pdf.php

// Panggil semua yang diperlukan
require 'vendor/autoload.php';
require_once __DIR__ . "/db.php"; // Koneksi ORM
use App\Models\Mahasiswa;        // Model Mahasiswa
use Dompdf\Dompdf;
use Dompdf\Options;

// 1. Ambil Data menggunakan ORM
// Ambil data yang sama seperti di index.php
$mahasiswa_list = Mahasiswa::orderBy('id', 'DESC')->get();

// 2. Buat Template HTML untuk PDF (TERMASUK HEADER)
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10pt; }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
            padding-bottom: 10px;
            border-bottom: 2px solid #333; /* Garis bawah header */
        }
        .header h1 { margin: 0; font-size: 16pt; color: #007bff; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h1>E-ICEBLUE (HEADER TEXT)</h1>
        <p>Laporan Data Mahasiswa RPL2 ACT6</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>';

// Isi data ke dalam HTML
if ($mahasiswa_list->isNotEmpty()) {
    foreach ($mahasiswa_list as $mhs) {
        $html .= '
        <tr>
            <td>' . htmlspecialchars($mhs->id) . '</td>
            <td>' . htmlspecialchars($mhs->npm) . '</td>
            <td>' . htmlspecialchars($mhs->nama) . '</td>
            <td>' . htmlspecialchars($mhs->jurusan) . '</td>
            <td>' . htmlspecialchars($mhs->created_at) . '</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="5" style="text-align:center;">Tidak ada data mahasiswa.</td></tr>';
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

// 3. Konfigurasi dan Konversi ke PDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

// (Opsional) Atur ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render HTML ke PDF
$dompdf->render();

// Output PDF ke browser (force download)
$dompdf->stream("laporan_mahasiswa_" . time() . ".pdf", ["Attachment" => true]);
?>