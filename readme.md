LINK GITHUB : https://github.com/B4jinan/gandi

Fitur 
- Menambah data mahasiswa 
- Menampilkan daftar data 
- Mengedit data
- Menghapus data 

Teknologi yang Digunakan
- PHP
- MySQL 
- Git & GitHub

Struktur Folder
- `app/` – berisi model
- `vendor/` – Dependency Composer
- `db.php` – File konfigurasi koneksi database
- `create_table.sql` – Script SQL pembuatan tabel database
- `export_pdf.php` – Script pembuatan pdf
- `index.php` – Halaman utama yang menampilkan data mahasiswa
- `style.css` – File CSS untuk tampilan aplikasi

Cara Menjalankan Proyek
1. Pindahkan folder proyek ke direktori: `xampp/htdocs/rpl2_act4_php`
2. Jalankan XAMPP, aktifkan **Apache** dan **MySQL**
3. Buka **phpMyAdmin** dan buat database dengan nama: `rpl2_act4`
4. Import file `create_table.sql` ke dalam database tersebut
5. Buka browser dan akses: http://localhost/rpl2_act4_php/
