<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📦 Manajemen Stok Pakaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #f8fafc;
            --accent-color: #64748b;
        }
        body { background-color: var(--secondary-color); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background: linear-gradient(135deg, var(--primary-color), #3b82f6); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card { border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 12px; }
        .btn-primary { background: var(--primary-color); border: none; }
        .btn-primary:hover { background: #1e40af; }
        .table th { background-color: #f1f5f9; color: var(--primary-color); font-weight: 600; }
        .stats-card { background: linear-gradient(135deg, #ffffff, #f8fafc); }
        .modal-header { background: var(--primary-color); color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">📦 Manajemen Stok Pakaian</span>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="fas fa-tshirt fa-2x text-primary mb-2"></i>
                        <h4 id="totalJenis" class="text-primary">0</h4>
                        <p class="text-muted mb-0">Total Jenis Pakaian</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="fas fa-boxes fa-2x text-success mb-2"></i>
                        <h4 id="totalStok" class="text-success">0</h4>
                        <p class="text-muted mb-0">Total Stok</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Data Pakaian</h5>
                <div>
                    <button class="btn btn-success me-2" onclick="exportPDF()">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fas fa-plus me-1"></i>Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablePakaian">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Pakaian</th>
                                <th>Kategori</th>
                                <th>Ukuran</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dataTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Pakaian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formPakaian" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label class="form-label">Nama Pakaian</label>
                            <input type="text" class="form-control" id="namaPakaian" name="nama_pakaian" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Kemeja">Kemeja</option>
                                <option value="Kaos">Kaos</option>
                                <option value="Celana">Celana</option>
                                <option value="Dress">Dress</option>
                                <option value="Jaket">Jaket</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ukuran</label>
                            <select class="form-select" id="ukuran" name="ukuran" required>
                                <option value="">Pilih Ukuran</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                            <div id="currentImage" class="mt-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    <p class="text-muted" id="namaHapus"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="btnKonfirmasiHapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <script>
        let editingId = null;

        // Load data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
            loadStats();
        });

        // Load data pakaian
        function loadData() {
            fetch('api.php?action=read')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('dataTable');
                    tbody.innerHTML = '';
                    
                    data.forEach((item, index) => {
                        const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                    ${item.gambar ? 
                                        `<img src="uploads/${item.gambar}" alt="${item.nama_pakaian}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">` : 
                                        '<span class="text-muted">No Image</span>'
                                    }
                                </td>
                                <td>${item.nama_pakaian}</td>
                                <td><span class="badge bg-secondary">${item.kategori}</span></td>
                                <td><span class="badge bg-info">${item.ukuran}</span></td>
                                <td>Rp ${parseInt(item.harga).toLocaleString('id-ID')}</td>
                                <td>
                                    <span class="badge ${item.stok > 10 ? 'bg-success' : item.stok > 5 ? 'bg-warning' : 'bg-danger'}">
                                        ${item.stok}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-1" onclick="editData(${item.id})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(${item.id}, '${item.nama_pakaian}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                });
        }

        // Load statistik
        function loadStats() {
            fetch('api.php?action=stats')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalJenis').textContent = data.total_jenis;
                    document.getElementById('totalStok').textContent = data.total_stok;
                });
        }

        // Submit form
        document.getElementById('formPakaian').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const action = editingId ? 'update' : 'create';
            formData.append('action', action);
            
            fetch('api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    bootstrap.Modal.getInstance(document.getElementById('modalTambah')).hide();
                    loadData();
                    loadStats();
                    resetForm();
                } else {
                    showToast(data.message, 'error');
                }
            });
        });

        // Edit data
        function editData(id) {
            editingId = id;
            fetch(`api.php?action=read&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalTitle').textContent = 'Edit Data Pakaian';
                    document.getElementById('editId').value = data.id;
                    document.getElementById('namaPakaian').value = data.nama_pakaian;
                    document.getElementById('kategori').value = data.kategori;
                    document.getElementById('ukuran').value = data.ukuran;
                    document.getElementById('harga').value = data.harga;
                    document.getElementById('stok').value = data.stok;
                    
                    if (data.gambar) {
                        document.getElementById('currentImage').innerHTML = 
                            `<img src="uploads/${data.gambar}" alt="Current" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">`;
                    }
                    
                    new bootstrap.Modal(document.getElementById('modalTambah')).show();
                });
        }

        // Konfirmasi hapus
        function confirmDelete(id, nama) {
            document.getElementById('namaHapus').textContent = nama;
            document.getElementById('btnKonfirmasiHapus').onclick = () => deleteData(id);
            new bootstrap.Modal(document.getElementById('modalHapus')).show();
        }

        // Hapus data
        function deleteData(id) {
            fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=delete&id=${id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    bootstrap.Modal.getInstance(document.getElementById('modalHapus')).hide();
                    loadData();
                    loadStats();
                } else {
                    showToast(data.message, 'error');
                }
            });
        }

        // Reset form
        function resetForm() {
            document.getElementById('formPakaian').reset();
            document.getElementById('modalTitle').textContent = 'Tambah Data Pakaian';
            document.getElementById('currentImage').innerHTML = '';
            editingId = null;
        }

        // Show toast notification
        function showToast(message, type) {
            const toastContainer = document.getElementById('toastContainer') || createToastContainer();
            const toastId = 'toast-' + Date.now();
            const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
            
            const toastHTML = `
                <div id="${toastId}" class="toast ${bgClass} text-white" role="alert">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                        ${message}
                    </div>
                </div>
            `;
            
            toastContainer.innerHTML += toastHTML;
            const toast = new bootstrap.Toast(document.getElementById(toastId));
            toast.show();
            
            setTimeout(() => {
                document.getElementById(toastId)?.remove();
            }, 5000);
        }

        function createToastContainer() {
            const container = document.createElement('div');
            container.id = 'toastContainer';
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = '9999';
            document.body.appendChild(container);
            return container;
        }

        // Export PDF
        function exportPDF() {
            fetch('api.php?action=read')
                .then(response => response.json())
                .then(data => {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();
                    
                    // Header
                    doc.setFontSize(18);
                    doc.text('LAPORAN STOK PAKAIAN', 20, 20);
                    doc.setFontSize(12);
                    doc.text(`Tanggal: ${new Date().toLocaleDateString('id-ID')}`, 20, 30);
                    
                    // Table
                    const tableData = data.map((item, index) => [
                        index + 1,
                        item.nama_pakaian,
                        item.kategori,
                        item.ukuran,
                        `Rp ${parseInt(item.harga).toLocaleString('id-ID')}`,
                        item.stok
                    ]);
                    
                    doc.autoTable({
                        head: [['No', 'Nama Pakaian', 'Kategori', 'Ukuran', 'Harga', 'Stok']],
                        body: tableData,
                        startY: 40,
                        styles: { fontSize: 10 },
                        headStyles: { fillColor: [30, 58, 138] }
                    });
                    
                    doc.save('laporan-stok-pakaian.pdf');
                    showToast('PDF berhasil diunduh!', 'success');
                });
        }

        // Reset form saat modal ditutup
        document.getElementById('modalTambah').addEventListener('hidden.bs.modal', resetForm);
    </script>
</body>
</html>