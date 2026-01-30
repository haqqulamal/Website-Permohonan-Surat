# Sistem Pelayanan Surat Desa (CodeIgniter 4)

Sistem Informasi Pelayanan Surat Desa berbasis web menggunakan framework **CodeIgniter 4** dengan database MySQL. Aplikasi ini memungkinkan penduduk untuk mengajukan surat secara online, yang kemudian diverifikasi oleh Staff Desa dan disahkan oleh Lurah sebelum dapat diunduh dalam format PDF.

## Fitur Utama

- **Authentication & RBAC**: Sistem login aman dengan pembagian hak akses (Penduduk, Staff, Lurah, Admin).
- **Pengajuan Surat**: Penduduk dapat mengajukan surat keterangan secara online melalui dashboard mereka.
- **Workflow Persetujuan**:
  - **Staff**: Verifikasi awal permohonan dan pembuatan draft SK.
  - **Lurah**: Pengesahan akhir surat (Tanda Tangan Elektronik/Persetujuan).
- **Generate PDF**: Surat yang disahkan otomatis di-generate menggunakan library **mPDF** dan siap diunduh oleh pemohon.
- **Master Data Management**: Manajemen data User dan Penduduk secara terintegrasi (Admin Only).

## Persyaratan Sistem

- PHP >= 8.1
- MySQL/MariaDB
- Composer (untuk management dependensi & mPDF)
- Web Server (Apache/Nginx) atau menggunakan PHP Development Server (`spark`)

## Cara Instalasi

### 1. Clone/Extract Project

Extract source code ke folder lokal Anda.

### 2. Install Dependensi

Buka terminal di folder project, lalu jalankan:

```powershell
composer install
```

### 3. Konfigurasi Environment

- Salin file `env` menjadi `.env`:
  ```powershell
  cp env .env
  ```
- Buka file `.env` dan sesuaikan konfigurasi database:
  ```env
  database.default.hostname = localhost
  database.default.database = surat_perizinan
  database.default.username = root
  database.default.password =
  database.default.DBDriver = MySQLi
  ```
- Set `CI_ENVIRONMENT` ke `development` untuk mempermudah debugging jika diperlukan.

### 4. Setup Database

- Buat database baru di MySQL bernama `surat_perizinan`.
- Import file database terbaru (misalnya `full_database.sql` jika tersedia di root) ke database tersebut.

### 5. Jalankan Aplikasi

Gunakan perintah bawaan CodeIgniter untuk menjalankan server:

```powershell
php spark serve
```

Akses aplikasi melalui browser di `http://localhost:8080`.

**Login Default:**

- Username: `admin`
- Password: `123`

## Struktur Folder Utama (CI4)

```
/app
  /Controllers  - Logika aplikasi (Auth, Permohonan, Letter, dll)
  /Models       - Interaksi Database (PermohonanModel, PendudukModel, dll)
  /Views        - Template antar muka (Layout, Dashboard, Forms)
/public         - Entry point (index.php) dan aset statis (CSS, JS, Images)
/writable       - Folder untuk log, cache, dan uploads
/vendor         - Library pihak ketiga (termasuk mPDF)
```

## Alur Penggunaan

1. **Penduduk** login → Menu **Pelayanan** → Klik **Buat Permohonan**.
2. **Staff** login → Menu **Persetujuan** → Klik **Aksi/Review** → Setujui/Tolak (Sistem akan membuat nomor SK otomatis).
3. **Lurah** login → Menu **Pengesahan** → Klik **Sahkan** pada surat yang sudah disetujui staff.
4. **Download** → Pemohon atau admin dapat mengunduh surat yang telah disahkan melalui menu **Arsip** dalam format PDF.

## Database Schema (8 Tabel)

Sistem menggunakan 8 tabel utama:

1. `user` - Profil pengguna (Admin, Staff, Lurah)
2. `login` - Kredensial login
3. `penduduk` - Data kependudukan
4. `permohonan_sk` - Master data permohonan
5. `persetujuan_permohonan` - Log persetujuan staff
6. `sk_disetujui` - Data draft SK
7. `pengesahan_sk` - Log pengesahan lurah
8. `sk_disahkan` - Data SK final yang siap download

---

**Developer:** Haqqul Amal  
**Framework:** CodeIgniter 4.x  
**PDF Engine:** mPDF 8.x
