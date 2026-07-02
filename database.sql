CREATE DATABASE pelatihan_989;
USE pelatihan_989;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user'
);

INSERT INTO users(nama,username,password,role)
VALUES
(
'Fitalis Duha',
'fitalis',
MD5('12345'),
'admin'
);

CREATE TABLE pelatihan(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelatihan VARCHAR(100),
    instruktur VARCHAR(100),
    kategori VARCHAR(50),
    tanggal DATE,
    peserta INT,
    gambar VARCHAR(255)
);

INSERT INTO pelatihan
(nama_pelatihan,instruktur,kategori,tanggal,peserta,gambar)
VALUES
('PHP Dasar','Andi','Web','2026-06-01',25,''),
('Laravel','Budi','Framework','2026-06-05',18,''),
('Python','Citra','AI','2026-06-10',30,''),
('Flutter','Dian','Mobile','2026-06-15',20,''),
('Java','Eko','Desktop','2026-06-20',15,'');