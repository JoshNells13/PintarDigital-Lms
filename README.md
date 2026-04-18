# 🎓 PintarDigital — Learning Management System (LMS) Modern

PintarDigital adalah platform sistem manajemen pembelajaran (LMS) berbasis peran yang profesional, dirancang untuk memberikan pengalaman pendidikan yang fokus dan berkinerja tinggi.

## 🚀 Fitur Utama

-   **Role-Based Access Control (RBAC)**: Dashboard dan perizinan yang berbeda untuk **Admin**, **Instruktur**, dan **Siswa**.
-   **Mesin Kuis Canggih**: Pembuat kuis yang berfungsi penuh dengan pertanyaan pilihan ganda, penilaian otomatis, dan pembaruan kemajuan instan.
-   **Pelacakan Kemajuan Siswa**: Bilah kemajuan dinamis dan pelacakan penyelesaian pelajaran yang dihitung secara real-time.
-   **Moderasi Kursus**: Alur kerja tingkat admin untuk menyetujui atau menolak kursus yang diajukan instruktur.
-   **Pengaturan Global & Notifikasi**: Manajemen profil yang aman dan sistem notifikasi real-time untuk pendaftaran dan pembaruan status kursus.

## 📸 Cuplikan Layar

<p align="center">
  <strong>Halaman Utama (Landing Page)</strong><br>
  <img src="documentation/landingpage.png" width="900" alt="Halaman Utama">
</p>
 
<p align="center">
  <strong>Dashboard Instruktur</strong><br>
  <img src="documentation/dashboardinstructor.png" width="900" alt="Dashboard Instruktur">
</p>
 
<p align="center">
  <strong>Dashboard Siswa</strong><br>
  <img src="documentation/dashboardstudent.png" width="900" alt="Dashboard Siswa">
</p>
 
<p align="center">
  <strong>Detail Kursus & Halaman Belajar Siswa</strong><br>
  <img src="documentation/coursedetail.png" width="900" alt="Detail Kursus">
</p>

## 🏗️ Arsitektur Teknis

Aplikasi ini menggunakan pola **Service and Repository Pattern** profesional untuk memastikan pemisahan tanggung jawab yang bersih:

-   **Repositories**: Logika akses data terpusat, memisahkan database dari aturan bisnis.
-   **Services**: Logika bisnis yang terenkapsulasi (penilaian, pendaftaran, perhitungan kemajuan) untuk pemeliharaan dan pengujian yang tinggi.
-   **Thin Controllers**: Pengontrol hanya fokus pada penanganan permintaan HTTP dan mengembalikan respons.

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 12
-   **Database**: MySQL
-   **Frontend**: Tailwind CSS (Estetika Terinspirasi M3/Material Design), Template Blade
-   **Ikon**: Google Material Symbols

## ⚙️ Instalasi & Pengaturan

1.  **Clone repositori dan instal dependensi**:
    ```bash
    composer install
    npm install
    ```
2.  **Pengaturan Lingkungan (Environment Setup)**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
3.  **Migrasi & Seeding Database**:
    ```bash
    php artisan migrate:fresh --seed
    ```
4.  **Jalankan aplikasi**:
    ```bash
    php artisan serve
    ```

## 🔐 Kredensial Pengujian (Data Seeded)

| Peran      | Email                      | Kata Sandi |
|------------|----------------------------|------------|
| **Admin**  | `admin@pintardigital.com`  | `password` |
| **Owner**  | `instructor@pintardigital.com` | `password` |
| **Siswa**  | `student@pintardigital.com` | `password` |


