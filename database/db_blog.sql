
CREATE DATABASE IF NOT EXISTS db_blog;
USE db_blog;

CREATE TABLE penulis (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nama_depan VARCHAR(255),
 nama_belakang VARCHAR(255),
 user_name VARCHAR(255) UNIQUE,
 password VARCHAR(255),
 foto VARCHAR(255)
);

CREATE TABLE kategori_artikel (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nama_kategori VARCHAR(100),
 keterangan TEXT
);

CREATE TABLE artikel (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 id_penulis BIGINT UNSIGNED,
 id_kategori BIGINT UNSIGNED,
 judul VARCHAR(255),
 isi LONGTEXT,
 gambar VARCHAR(255),
 hari_tanggal DATE,
 FOREIGN KEY (id_penulis) REFERENCES penulis(id),
 FOREIGN KEY (id_kategori) REFERENCES kategori_artikel(id)
);
