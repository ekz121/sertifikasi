# 📦 Manajemen Stok Pakaian

Website manajemen stok pakaian dengan tema modern dan elegan menggunakan HTML, CSS, PHP, MySQL, JavaScript (AJAX), dan Bootstrap 5.

## 🚀 Fitur Utama

- ✅ **CRUD Lengkap** - Create, Read, Update, Delete data pakaian
- ✅ **Upload Gambar** - Upload dan kelola gambar pakaian
- ✅ **Export PDF** - Cetak laporan stok dalam format PDF
- ✅ **Real-time Updates** - Update stok otomatis tanpa refresh halaman (AJAX)
- ✅ **Dashboard Admin** - Tampilan berkelas dengan Bootstrap dan FontAwesome
- ✅ **Form Validasi** - Validasi input yang rapi dan responsif
- ✅ **Konfirmasi Hapus** - Modal pop-up untuk konfirmasi hapus data
- ✅ **Statistik** - Tampilan total stok dan total jenis pakaian
- ✅ **Notifikasi Toast** - Notifikasi real-time untuk setiap aksi

## 🎨 Desain

- Warna dominan: Putih, abu-abu lembut, dan biru tua elegan
- Header dengan judul "📦 Manajemen Stok Pakaian"
- Tabel bergaya profesional dengan Bootstrap table-striped table-hover
- Tombol CRUD dengan icon FontAwesome
- Responsive design untuk semua perangkat

## 📋 Instalasi

1. **Import Database**
   ```sql
   -- Buka phpMyAdmin
   -- Import file database.sql
   -- Database akan otomatis terbuat dengan nama 'db_pakaian2'
   ```

2. **Setup Files**
   ```
   - Copy semua file ke folder htdocs/baju 2/
   - Pastikan folder uploads/ ada dan writable
   ```

3. **Akses Website**
   ```
   http://localhost/baju 2/
   ```

## 📁 Struktur File

```
baju 2/
├── index.php          # Halaman utama dashboard
├── api.php           # API endpoint untuk CRUD
├── config.php        # Konfigurasi database
├── database.sql      # File SQL database
├── uploads/          # Folder untuk gambar
└── README.md         # Dokumentasi
```

## 🗄️ Database Schema

**Database:** `db_pakaian2`
**Table:** `tb_pakaian2`

| Field | Type | Description |
|-------|------|-------------|
| id | INT AUTO_INCREMENT | Primary Key |
| nama_pakaian | VARCHAR(100) | Nama pakaian |
| kategori | VARCHAR(50) | Kategori pakaian |
| ukuran | VARCHAR(20) | Ukuran pakaian |
| harga | DECIMAL(10,2) | Harga pakaian |
| stok | INT | Jumlah stok |
| gambar | VARCHAR(255) | Nama file gambar |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

## 🔧 Teknologi

- **Frontend:** HTML5, CSS3, JavaScript (ES6+), Bootstrap 5, FontAwesome
- **Backend:** PHP 7.4+, PDO MySQL
- **Database:** MySQL 5.7+
- **AJAX:** Fetch API untuk real-time updates
- **PDF Export:** jsPDF library

## 📱 Fitur Responsif

- Dashboard responsif untuk desktop, tablet, dan mobile
- Tabel responsive dengan scroll horizontal
- Modal yang menyesuaikan ukuran layar
- Form yang user-friendly di semua perangkat

## 🔒 Keamanan

- Prepared statements untuk mencegah SQL injection
- Validasi file upload (type, size)
- Sanitasi input data
- Error handling yang proper

## 📊 Statistik Dashboard

- Total Jenis Pakaian (real-time)
- Total Stok Keseluruhan (real-time)
- Badge warna untuk status stok (Hijau: >10, Kuning: 5-10, Merah: <5)

## 🎯 Cara Penggunaan

1. **Tambah Data:** Klik tombol "Tambah Data" → Isi form → Simpan
2. **Edit Data:** Klik icon edit (kuning) → Ubah data → Simpan
3. **Hapus Data:** Klik icon hapus (merah) → Konfirmasi → Hapus
4. **Export PDF:** Klik tombol "Export PDF" → File otomatis terunduh
5. **Upload Gambar:** Pilih file gambar saat tambah/edit data

## 🚨 Troubleshooting

**Error Database Connection:**
- Pastikan XAMPP MySQL running
- Cek konfigurasi di config.php
- Import database.sql ke phpMyAdmin

**Upload Gambar Gagal:**
- Pastikan folder uploads/ writable (chmod 755)
- Cek ukuran file (max 5MB)
- Format yang didukung: JPG, JPEG, PNG, GIF

**AJAX Tidak Berfungsi:**
- Pastikan JavaScript enabled di browser
- Cek console browser untuk error
- Pastikan api.php accessible

## 📞 Support

Jika ada pertanyaan atau masalah, silakan buat issue atau hubungi developer.

---
**Dibuat dengan ❤️ menggunakan PHP, MySQL, Bootstrap 5**