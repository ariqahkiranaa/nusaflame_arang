CREATE DATABASE IF NOT EXISTS nusaflame_arang
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE nusaflame_arang;

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    harga INT NOT NULL DEFAULT 0,
    deskripsi TEXT NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO produk (nama, kategori, harga, deskripsi, gambar) VALUES
('Arang Oversized T-Shirt', 'T-Shirt', 149000,
 'Oversized t-shirt dengan desain minimalis khas NUSAF LAME_ARANG.', 'brownies.jpg'),
('Nusaflame Hoodie', 'Hoodie', 279000,
 'Hoodie warna gelap dengan material nyaman untuk tampilan streetwear.', 'cheesecake.jpg'),
('Black Flame Jacket', 'Jacket', 349000,
 'Jacket bergaya industrial dengan detail grafis flame.', 'donat.jpg');
