<?php

require 'vendor/autoload.php';

// Memuat Koneksi ORM yang sudah dikonfigurasi
require_once __DIR__ . "/db.php";       
// Menggunakan Model dari Namespace
use App\Models\Mahasiswa; 

// 1. Ambil data dari form POST dan Sanitasi
$npm = htmlspecialchars(trim($_POST["npm"] ?? ""));
$nama = htmlspecialchars(trim($_POST["nama"] ?? ""));
$jur = htmlspecialchars(trim($_POST["jurusan"] ?? ""));

// 2. Logika Simpan (INSERT) menggunakan ORM
if ($npm && $nama && $jur) {
    
    // Operasi INSERT ORM
    Mahasiswa::create([
        'npm'     => $npm, 
        'nama'    => $nama, 
        'jurusan' => $jur
    ]); 
    
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// 3. Logika Tampil (SELECT) menggunakan ORM
$mahasiswa_list = Mahasiswa::orderBy('id', 'DESC')->get();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPL2 ACT4 - Data Mahasiswa (ORM)</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        /* CSS Sederhana */
        body { font-family: sans-serif; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        .card { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .row { margin-bottom: 10px; }
        label { display: inline-block; width: 100px; }
        input[type="text"] { padding: 8px; width: 200px; border: 1px solid #ddd; border-radius: 3px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 3px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .pdf-button { 
            display: inline-block; 
            padding: 10px 15px; 
            background-color: #dc3545; /* Merah untuk PDF */
            color: white; 
            text-decoration: none; 
            border-radius: 3px; 
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>RPL2 ACT4 - Data Mahasiswa (ORM)</h2>

    <form method="post" class="card">
        <h3>Tambah Data</h3>
        <div class="row">
            <label for="npm">NPM:</label>
            <input type="text" name="npm" id="npm" required maxlength="15">
        </div>
        <div class="row">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>
        </div>
        <div class="row">
            <label for="jurusan">Jurusan:</label>
            <input type="text" name="jurusan" id="jurusan" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
    
    <div style="text-align: right; margin-bottom: 15px;">
        <a href="export_pdf.php" target="_blank" class="pdf-button">
            Cetak Data ke PDF
        </a>
    </div>

    <div class="card">
        <h3>Data Tersimpan</h3>
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
            <tbody>
                <?php if ($mahasiswa_list->isNotEmpty()): ?> 
                
                    <?php foreach ($mahasiswa_list as $mhs): ?>
                    <tr>
                        <td><?= htmlspecialchars($mhs->id); ?></td>
                        <td><?= htmlspecialchars($mhs->npm); ?></td>
                        <td><?= htmlspecialchars($mhs->nama); ?></td>
                        <td><?= htmlspecialchars($mhs->jurusan); ?></td>
                        <td><?= htmlspecialchars($mhs->created_at); ?></td>
                    </tr>
                    <?php endforeach; ?>
                
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Belum ada data!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>