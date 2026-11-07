# Tugas Pemrograman Web - Halaman Registrasi

Repositori ini dibuat untuk memenuhi tugas pembuatan halaman registrasi yang terhubung ke database[cite: 1].

## Struktur File
1. **`register.php`** : Berisi antarmuka form HTML untuk input data pengguna serta logika PHP untuk memproses dan menyimpan data ke database MySQL menggunakan PDO.
2. **`database.sql`** : Berisi perintah SQL untuk membuat database `db_registrasi` beserta tabel `users`.
3. **`README.md`** : Dokumentasi penjelasan aplikasi.

## Cara Instalasi & Menjalankan
1. Pastikan Anda telah menginstal server lokal seperti **XAMPP** atau **Laragon**.
2. Buat database baru di phpMyAdmin dengan mengimpor file **`database.sql`** atau jalankan kodenya di terminal MySQL.
3. Letakkan file **`register.php`** di dalam folder htdocs (jika menggunakan XAMPP).
4. Nyalakan layanan Apache dan MySQL pada control panel XAMPP.
5. Akses melalui browser dengan URL: `http://localhost/nama_folder_anda/register.php`
