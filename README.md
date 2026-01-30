# Sistem Pelayanan Surat Desa (Native PHP)

Sistem Informasi Pelayanan Surat Desa berbasis web menggunakan **Native PHP** dengan database MySQL. Aplikasi ini memungkinkan penduduk untuk mengajukan surat secara online, yang kemudian diverifikasi oleh Staff Desa dan disahkan oleh Lurah sebelum dapat diunduh dalam format PDF.

## Fitur Utama

- **Authentication & RBAC**: Sistem login aman dengan pembagian hak akses (Penduduk, Staff, Lurah, Admin).
- **Pengajuan Surat**: Penduduk dapat mengajukan surat keterangan secara online.
- **Workflow Persetujuan**:
  - **Staff**: Verifikasi awal permohonan.
  - **Lurah**: Pengesahan akhir (Tanda Tangan Elektronik).
- **Dashboard**: Statistik permohonan untuk memantau kinerja pelayanan.
- **Generate PDF**: Surat yang disahkan otomatis ter-generate menggunakan **mPDF** dan dapat diunduh.
- **Master Data Management**: CRUD untuk data User dan Penduduk (Admin Only).

## Persyaratan Sistem

- PHP >= 8.1
- MySQL/MariaDB
- Apache/Nginx Web Server
- Composer (untuk mPDF)

## Cara Instalasi

### 1. Clone/Extract Project

Extract source code ke folder web server Anda (contoh: `c:\xampp\htdocs\perijinan_sk`).

### 2. Install Library (Composer)

Buka terminal di folder project, lalu jalankan:

```powershell
composer install
```

_Perintah ini akan mengunduh mPDF library._

### 3. Konfigurasi Database

- Buat database baru di MySQL bernama `surat_perizinan`.
- Import file `full_database.sql` (ada di root folder project) ke database.
- Edit file `config/database.php` jika perlu menyesuaikan username/password MySQL:
  ```php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'surat_perizinan');
  ```

### 4. Jalankan Aplikasi

Akses aplikasi melalui browser:

```
http://localhost/perijinan_sk/
```

**Login Default:**

- Username: `admin`
- Password: `123`

## Struktur Folder

```
/config
  - database.php (Koneksi Database)
  - functions.php (Helper Functions)
/views
  - layout_header.php (Header & Sidebar)
  - layout_footer.php (Footer)
/auth
  - login.php (Halaman Login)
  - login_process.php (Proses Login)
  - logout.php (Logout)
/admin
  - user_index.php (Manajemen User)
  - user_save.php, user_delete.php
  - penduduk_index.php (Manajemen Penduduk)
  - penduduk_save.php, penduduk_delete.php
/pelayanan (Penduduk)
  - permohonan_baru.php (Form Permohonan)
  - simpan_permohonan.php (Simpan Permohonan)
  - riwayat.php (Riwayat Permohonan)
/persetujuan (Staff)
  - index.php (Daftar Permohonan)
  - proses.php (Proses Persetujuan)
/pengesahan (Lurah)
  - index.php (Daftar Pengesahan)
  - proses.php (Proses Pengesahan)
/arsip
  - index.php (Arsip Surat)
  - download.php (Generate PDF)
index.php (Dashboard)
```

## Alur Penggunaan

### 1. Login

Masuk menggunakan username dan password yang terdaftar.

### 2. Alur Pengajuan Surat

1. **Penduduk** login → Menu **Pelayanan** → **Buat Permohonan Baru**.
2. **Staff** login → Menu **Persetujuan** → Klik **Review** → Setujui/Tolak.
3. **Lurah** login → Menu **Pengesahan** → Klik **Sahkan**.
4. **Siapa saja** → Menu **Arsip Surat** → Download PDF Surat yang sudah jadi.

## Database Schema (8 Tabel)

Aplikasi ini menggunakan 8 tabel sesuai ERD yang telah disepakati:

1. `user` - Data profil user (Admin, Staff, Lurah)
2. `login` - Kredensial login
3. `penduduk` - Data penduduk
4. `permohonan_sk` - Permohonan surat
5. `persetujuan_permohonan` - Tracking persetujuan staff
6. `sk_disetujui` - Draft SK yang disetujui
7. `pengesahan_sk` - Tracking pengesahan lurah
8. `sk_disahkan` - SK final yang disahkan

## Troubleshooting

- **Error: Class "Mpdf\Mpdf" not found**:
  Jalankan `composer install` di terminal.

- **Error Database Connection**:
  Cek file `config/database.php`, pastikan username dan password sesuai.

- **Halaman Blank/Error 404**:
  Pastikan Anda mengakses via `http://localhost/perijinan_sk/` (sesuaikan dengan nama folder).

---

**Developer:** Haqqul Amal  
**Framework:** Native PHP  
**PDF Engine:** mPDF 8.x
