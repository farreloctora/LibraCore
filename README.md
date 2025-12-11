# 📚 LibraCore  
**A Modern Digital Library Management System**

LibraCore adalah aplikasi manajemen perpustakaan digital yang dirancang untuk mempermudah proses pengelolaan buku, kategori, peminjaman, pengguna, serta menyediakan dashboard admin lengkap. Dibangun menggunakan **Laravel 12** dan mengikuti standar modern web development.

---

## 🚀 Features

### **🔹 Front-End**
- Halaman landing page (informasi umum, buku terbaru, kategori, dan pencarian)
- Tampilan detail buku
- User registration & login
- Sistem peminjaman buku oleh user

### **🔹 Admin Dashboard**
- CRUD Buku  
- CRUD Kategori  
- CRUD Penulis  
- CRUD Data Peminjaman  
- Manajemen User  
- Validasi gambar cover (size & extension)  
- Live Search + Filtering data  
- PDF Reporting (buku, peminjaman, dan lainnya)

### **🔹 Backend & System**
- Laravel 12 + Blade/Livewire (sesuai spesifikasi tugas)
- Relasi database lebih dari 1 (Books, Authors, Categories, Borrowings, Users)
- Authentication & Authorization (role: admin & user)
- Terhubung minimal 1 Public API  
  - *Contoh:* Google Books API (untuk mengambil metadata buku)
- Deployment-ready

---

## 🏛️ Core Concept

LibraCore dibuat untuk menjadi **“sistem inti”** dalam pengelolaan perpustakaan digital.  
Nama *LibraCore* berasal dari:

- **Libra** → singkatan dari *Library*  
- **Core** → pusat/inti manajemen  

Artinya, aplikasi ini menjadi pusat pengendali seluruh aktivitas perpustakaan.

---

## 🗂️ Tech Stack

| Layer | Technology |
|------|------------|
| Framework | Laravel 12 |
| Front-End | Blade / Livewire |
| Database | MySQL / MariaDB |
| Deployment | Any Shared Hosting / Laravel Forge / etc. |
| API Integration | Google Books API (optional) |

---

## 🏗️ Installation

### 1. Clone Repository
```bash
git clone https://github.com/your-org/LibraCore.git
cd LibraCore
```

### 2. Install Dependencies
```bash
composer install
npm install
npm run build
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan konfigurasi database di file `.env`.

### 4. Migrate & Seed
```bash
php artisan migrate --seed
```

### 5. Run Server
```bash
php artisan serve
```

---

## 🧩 Fitur API Publik (Contoh)
LibraCore dapat terhubung dengan Google Books API untuk menambahkan buku otomatis dengan ISBN.

```http
GET https://www.googleapis.com/books/v1/volumes?q=isbn:{ISBN}
```

Data yang dapat diambil:
- Judul
- Penulis
- Penerbit
- Tahun terbit
- Cover book
- Deskripsi

---

## 📄 PDF Reporting
Admin dapat mengunduh:
- Laporan Buku  
- Laporan Peminjaman  
- Laporan Pengguna  

Format PDF dibuat otomatis melalui Laravel DomPDF atau Snappy.

---

## 👥 Team Structure (contoh)
- **Project Manager**
- **Backend Developer**
- **Frontend Developer**
- **UI/UX Designer** (opsional)
- **QA Tester** (opsional)

---

## 📌 Roadmap (Optional)
- [ ] Dark mode
- [ ] Import/export data Excel  
- [ ] Integration dengan QR Code untuk peminjaman  
- [ ] Payment Gateway untuk denda keterlambatan  
- [ ] Mobile-friendly redesign  

---

## 📝 License
Project dibuat untuk keperluan praktikum dan edukasi.

---

## 🤝 Contributors
Silakan tambahkan username anggota tim pada bagian ini.

---

## ⭐ Acknowledgements
Thanks to:  
- Laravel Documentation  
- OpenAPI Providers  
- Tim Praktikum Web 2025/2026

---

> **LibraCore — Your Central Hub for Digital Library Management.**
