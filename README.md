# 👁️ Sistem Pakar Diagnosa Penyakit Mata

Sistem Pakar Diagnosa Penyakit Mata merupakan aplikasi berbasis web yang dirancang untuk membantu pengguna melakukan diagnosis awal terhadap penyakit mata berdasarkan gejala yang dialami. Sistem ini menggunakan metode **Forward Chaining** untuk melakukan proses inferensi dan menghasilkan kemungkinan penyakit yang sesuai.

---

## 📖 Deskripsi

Mata merupakan salah satu organ penting dalam kehidupan manusia. Kurangnya pengetahuan masyarakat mengenai kesehatan mata serta keterbatasan akses terhadap dokter spesialis mata sering menyebabkan keterlambatan dalam penanganan penyakit mata.

Aplikasi ini dikembangkan sebagai sistem pakar yang mampu membantu pengguna memperoleh diagnosis awal secara cepat dan memberikan informasi mengenai penyakit mata berdasarkan gejala yang dipilih.

---

## ✨ Fitur Utama

### User
- Registrasi akun
- Login pengguna
- Input gejala penyakit mata
- Proses diagnosis otomatis
- Menampilkan hasil diagnosis
- Menampilkan persentase kecocokan penyakit
- Melihat riwayat diagnosis

### Admin
- Login admin
- CRUD Data Penyakit
- CRUD Data Gejala
- CRUD Rule Base
- Melihat riwayat diagnosis
- Dashboard statistik sistem

---

## 🧠 Metode Forward Chaining

Forward Chaining merupakan metode inferensi yang dimulai dari fakta atau gejala yang diberikan pengguna, kemudian sistem mencocokkannya dengan aturan (rule) yang tersedia hingga diperoleh suatu kesimpulan berupa diagnosis penyakit.

### Alur Sistem

1. Pengguna memilih gejala yang dialami.
2. Sistem membaca gejala sebagai fakta.
3. Sistem mencocokkan fakta dengan rule yang tersedia.
4. Rule yang memenuhi kondisi akan dijalankan.
5. Sistem menghasilkan diagnosis penyakit.
6. Hasil diagnosis dan persentase kecocokan ditampilkan kepada pengguna.

---

## 🩺 Penyakit yang Didukung

| Kode | Penyakit |
|-------|-----------|
| P01 | Katarak |
| P02 | Konjungtivitis |
| P03 | Retinopati Diabetik |
| P04 | Sindrom Mata Kering |
| P05 | Kelelahan Mata |
| P06 | Glaukoma |
| P07 | Kelainan Refraksi |
| P08 | Ablasio Retina |
| P09 | Iritis |
| P10 | Rabun Senja |
| P11 | Dacryoadenitis |
| P12 | Optic Neuritis |

---

## 📋 Daftar Gejala

| Kode | Gejala |
|-------|---------|
| G01 | Penglihatan kabur/berawan |
| G02 | Sensitivitas terhadap cahaya |
| G03 | Penglihatan buruk di malam hari |
| G04 | Penglihatan ganda |
| G05 | Nyeri mata |
| G06 | Mata merah |
| G07 | Kehilangan penglihatan |
| G08 | Mata kering |
| G09 | Mata terasa lelah |
| G10 | Mata terasa berat |
| G11 | Penglihatan buram |
| G12 | Sakit kepala |
| G13 | Iritasi pada mata |
| G14 | Rasa tidak nyaman seperti ada benda asing di mata |
| G15 | Mata terasa gatal |
| G16 | Mata terasa terbakar |
| G17 | Terlihat kilatan cahaya |
| G18 | Mata berair |
| G19 | Kesulitan membuka mata di pagi hari |
| G20 | Sensasi seperti pasir |
| G21 | Sakit dengan gerakan mata |

---

## 🛠️ Teknologi yang Digunakan

- HTML
- CSS
- Bootstrap
- JavaScript
- PHP
- MySQL
- XAMPP

---

## 📂 Struktur Project

```text
sistem-pakar-penyakit-mata/
│
├── admin/
├── user/
├── assets/
├── config/
├── database/
│
├── index.php
├── login.php
├── register.php
├── diagnosa.php
├── riwayat.php
│
└── README.md
```

---

## 📸 Screenshot

### Halaman Login

Tambahkan screenshot halaman login di sini.

```md
![Login](screenshots/login.png)
```

### Halaman Diagnosa

```md
![Diagnosa](screenshots/diagnosa.png)
```

### Hasil Diagnosa

```md
![Hasil Diagnosa](screenshots/hasil-diagnosa.png)
```

### Dashboard Admin

```md
![Dashboard](screenshots/dashboard-admin.png)
```

---

## 🚀 Cara Menjalankan Project

### 1. Clone Repository

```bash
git clone https://github.com/username/sistem-pakar-penyakit-mata.git
```

### 2. Masukkan Project ke Folder XAMPP

```text
C:/xampp/htdocs/
```

### 3. Import Database

Import file database `.sql` ke MySQL melalui phpMyAdmin.

### 4. Konfigurasi Database

Edit file konfigurasi database:

```php
config/koneksi.php
```

Sesuaikan:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "db_penyakit_mata";
```

### 5. Jalankan Apache dan MySQL

Aktifkan melalui XAMPP Control Panel.

### 6. Buka Browser

```text
http://localhost/sistem-pakar-penyakit-mata
```

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik dan penelitian.
