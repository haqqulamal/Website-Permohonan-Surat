# Sistem Pelayanan Surat Desa (CodeIgniter 4)

Sistem Informasi Pelayanan Surat Desa berbasis web yang dibangun menggunakan Framework CodeIgniter 4. Aplikasi ini memungkinkan penduduk untuk mengajukan surat secara online, yang kemudian akan diverifikasi oleh Staff Desa dan disahkan oleh Lurah sebelum dapat diunduh dalam format PDF.

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

Pastikan server Anda memenuhi persyaratan berikut:

- PHP >= 8.1
- Composer
- Extension PHP yang wajib aktif di `php.ini`:
  - `intl`
  - `gd`
  - `mbstring`
  - `mysqli`
  - `xml`
  - `curl`

## Cara Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di komputer lokal (e.g., XAMPP):

1. **Extract Project**
   Extract source code ke folder web server Anda (contoh: `c:\xampp\htdocs\perijinan_sk`).

2. **Install Library (Composer)**
   Buka terminal di folder project, lalu jalankan:

   ```powershell
   composer install
   ```

   _Perintah ini akan mengunduh semua library yang dibutuhkan termasuk CodeIgniter 4 dan mPDF._

3. **Konfigurasi Database**
   - Buat database baru di MySQL bernama `surat_perizinan`.
   - Import file database (jika ada backup SQL) atau pastikan tabel-tabel berikut ada:
     - `user`
     - `penduduk`
     - `permohonan_sk`
     - `roles` (jika menggunakan tabel role terpisah)
   - File konfigurasi database ada di `.env`. Default setting untuk XAMPP:
     ```ini
     database.default.hostname = localhost
     database.default.database = surat_perizinan
     database.default.username = root
     database.default.password =
     ```
     _(Password dikosongkan untuk default XAMPP)_

4. **Jalankan Aplikasi**
   Gunakan built-in server CodeIgniter untuk menjalankan aplikasi:
   ```powershell
   php spark serve
   ```
   Akses aplikasi di browser: `http://localhost:8080`

## Panduan Penggunaan

### 1. Login

Masuk menggunakan username dan password yang terdaftar.

- **Admin**: Akses penuh ke menu Master Data (User & Penduduk).
- **Penduduk**: Mengakses menu `Pelayanan` untuk mengajukan surat.
- **Staff (Jagabaya/Ulu-ulu)**: Mengakses menu `Persetujuan` untuk memverifikasi permohonan.
- **Lurah**: Mengakses menu `Pengesahan` untuk menyetujui surat.

### 2. Alur Pengajuan Surat

1. **Penduduk** login -> Menu **Pelayanan** -> **Buat Permohonan Baru**.
2. **Staff** login -> Dashboard akan muncul notifikasi "Menunggu Staff" -> Menu **Persetujuan** -> Klik **Review** -> Setujui/Tolak.
3. **Lurah** login -> Dashboard muncul "Disetujui Staff" -> Menu **Pengesahan** -> Klik **Sahkan**.
4. **Penduduk** (atau Staff/Admin/Lurah) -> Menu **Arsip Surat** -> Download PDF Surat yang sudah jadi.

## Troubleshooting

- **Error: Class "Mpdf\Mpdf" not found**:
  Jalankan perintah ini di terminal:

  ```powershell
  composer dump-autoload
  ```

- **Error Database (Access Denied)**:
  Cek file `.env`, pastikan username dan password database sesuai dengan setting MySQL Anda.

- **Layout Berantakan / 404 Not Found**:
  Pastikan Anda menjalankan aplikasi via `php spark serve`. Jika menggunakan XAMPP (localhost/perijinan_sk/public), pastikan setting `app.baseURL` di `.env` disesuaikan.

---

**Developers:**

- Dikembangkan oleh: [ConsCode]
- Framework: CodeIgniter 4.6
- PDF Engine: mPDF 8.x
