-- Database: db_pakaian2
CREATE DATABASE IF NOT EXISTS db_pakaian2;
USE db_pakaian2;

-- Table: tb_pakaian2
CREATE TABLE tb_pakaian2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pakaian VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    ukuran VARCHAR(20) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    gambar VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO tb_pakaian2 (nama_pakaian, kategori, ukuran, harga, stok, gambar) VALUES
('Kemeja Formal Putih', 'Kemeja', 'M', 150000.00, 25, 'kemeja1.jpg'),
('Kaos Polo Navy', 'Kaos', 'L', 85000.00, 30, 'polo1.jpg'),
('Celana Jeans Slim', 'Celana', '32', 200000.00, 15, 'jeans1.jpg'),
('Dress Casual Pink', 'Dress', 'S', 175000.00, 20, 'dress1.jpg'),
('Jaket Denim Blue', 'Jaket', 'XL', 250000.00, 10, 'jaket1.jpg');