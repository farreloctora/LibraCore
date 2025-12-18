## ✨ Fitur Utama

### 🌐 Frontend (User)
- Menampilkan halaman utama perpustakaan digital
- Menampilkan daftar buku beserta informasi detail (judul, penulis, kategori, deskripsi)
- Live Search buku berdasarkan judul atau penulis
- Filter buku berdasarkan kategori
- Tampilan responsif dan user-friendly
- Akses terbatas untuk pengguna yang sudah login

### 🛡️ Authentication & Authorization
- Registrasi pengguna baru
- Login pengguna
- Logout pengguna
- Pembatasan akses berdasarkan role (Admin & User)
- Proteksi halaman admin dari akses tidak sah

### 📊 Dashboard Admin (Backend)
- Menampilkan ringkasan data (jumlah buku, kategori, dan pengguna)
- Manajemen Buku:
  - Menambah data buku
  - Melihat daftar buku
  - Mengubah data buku
  - Menghapus data buku
  - Upload cover buku
  - Validasi tipe dan ukuran gambar
- Manajemen Kategori:
  - Tambah, ubah, dan hapus kategori
- Manajemen Pengguna:
  - Melihat data pengguna
  - Mengatur hak akses pengguna

### 🗃️ Manajemen Data & Database
- Implementasi relasi database lebih dari satu tabel
- Relasi One-to-Many dan/atau Many-to-Many
- Penerapan Model, Migration, dan Seeder
- Validasi data pada setiap proses input

### 🔎 Pencarian & Filter Data
- Live search pada data buku di dashboard admin
- Filter data berdasarkan kategori atau atribut tertentu
- Pagination untuk menampilkan data dalam jumlah besar

### 🖼️ Manajemen Gambar
- Upload gambar cover buku
- Validasi format gambar (JPG, PNG, JPEG)
- Penghapusan gambar saat data dihapus atau diperbarui

### 📄 Laporan & Export
- Generate laporan data buku dalam format PDF
- Laporan dapat difilter berdasarkan kategori atau periode tertentu

### 🔗 Integrasi Public API
- Terhubung dengan Public Open API
- Pengambilan data eksternal untuk melengkapi informasi buku
- Penggunaan API sesuai ketentuan praktikum (login & register API tidak termasuk)

### ☁️ Deployment
- Aplikasi di-deploy ke Web Hosting
- Konfigurasi environment production
