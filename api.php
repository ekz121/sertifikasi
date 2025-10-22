<?php
header('Content-Type: application/json');
require_once 'config.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'create':
        createPakaian();
        break;
    case 'read':
        readPakaian();
        break;
    case 'update':
        updatePakaian();
        break;
    case 'delete':
        deletePakaian();
        break;
    case 'stats':
        getStats();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function createPakaian() {
    global $pdo;
    
    try {
        $nama_pakaian = $_POST['nama_pakaian'];
        $kategori = $_POST['kategori'];
        $ukuran = $_POST['ukuran'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        
        $gambar = null;
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $gambar = uploadImage($_FILES['gambar']);
        }
        
        $sql = "INSERT INTO tb_pakaian2 (nama_pakaian, kategori, ukuran, harga, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_pakaian, $kategori, $ukuran, $harga, $stok, $gambar]);
        
        echo json_encode(['success' => true, 'message' => 'Data berhasil ditambahkan!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function readPakaian() {
    global $pdo;
    
    try {
        if (isset($_GET['id'])) {
            $sql = "SELECT * FROM tb_pakaian2 WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_GET['id']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            $sql = "SELECT * FROM tb_pakaian2 ORDER BY created_at DESC";
            $stmt = $pdo->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function updatePakaian() {
    global $pdo;
    
    try {
        $id = $_POST['id'];
        $nama_pakaian = $_POST['nama_pakaian'];
        $kategori = $_POST['kategori'];
        $ukuran = $_POST['ukuran'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        
        // Get current image
        $sql = "SELECT gambar FROM tb_pakaian2 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);
        $gambar = $currentData['gambar'];
        
        // Upload new image if provided
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            // Delete old image
            if ($gambar && file_exists('uploads/' . $gambar)) {
                unlink('uploads/' . $gambar);
            }
            $gambar = uploadImage($_FILES['gambar']);
        }
        
        $sql = "UPDATE tb_pakaian2 SET nama_pakaian = ?, kategori = ?, ukuran = ?, harga = ?, stok = ?, gambar = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_pakaian, $kategori, $ukuran, $harga, $stok, $gambar, $id]);
        
        echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function deletePakaian() {
    global $pdo;
    
    try {
        $id = $_POST['id'];
        
        // Get image filename
        $sql = "SELECT gambar FROM tb_pakaian2 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Delete image file
        if ($data['gambar'] && file_exists('uploads/' . $data['gambar'])) {
            unlink('uploads/' . $data['gambar']);
        }
        
        // Delete record
        $sql = "DELETE FROM tb_pakaian2 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function getStats() {
    global $pdo;
    
    try {
        $sql = "SELECT COUNT(*) as total_jenis, SUM(stok) as total_stok FROM tb_pakaian2";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function uploadImage($file) {
    $targetDir = "uploads/";
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $newFileName = uniqid() . '.' . $imageFileType;
    $targetFile = $targetDir . $newFileName;
    
    // Check if image file is actual image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        throw new Exception("File bukan gambar yang valid.");
    }
    
    // Check file size (5MB max)
    if ($file["size"] > 5000000) {
        throw new Exception("Ukuran file terlalu besar. Maksimal 5MB.");
    }
    
    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        throw new Exception("Hanya file JPG, JPEG, PNG & GIF yang diizinkan.");
    }
    
    if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
        throw new Exception("Gagal mengupload file.");
    }
    
    return $newFileName;
}
?>