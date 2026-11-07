-- Membuat database
CREATE DATABASE IF NOT EXISTS db_registrasi;
USE db_registrasi;

-- Membuat tabel users untuk menyimpan data registrasi
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    tanggal_dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);