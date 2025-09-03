# Jawaban Soal B

## 📋 Deskripsi

Aplikasi ini dibuat sebagai jawaban untuk **Soal B** dalam rangkaian technical test.

## 🚀 Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Bootstrap Icons
- **JavaScript**: Vanilla JS, SweetAlert2
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Breeze

### 🚀 Quick Start (Instalasi Cepat)

Untuk instalasi cepat, jalankan perintah berikut secara berurutan:

```bash
# 1. Clone dan masuk ke direktori
git clone <repository-url> && cd soal_b

# 2. Install dependencies
composer install && npm install

# 3. Setup environment
cp .env.example .env && php artisan key:generate

# 4. Setup database (pastikan database sudah dibuat)
php artisan migrate:fresh --seed

# 5. Build assets
npm run build

# 6. Start server
php artisan serve
```

## 👤 Test User Account

Setelah menjalankan seeder, Anda dapat login menggunakan akun test berikut:

```
Username: testuser
Password: 1234567890
```

## 🗂️ Struktur Database

### Hospitals Table
- `id` - Primary Key
- `name` - Nama Rumah Sakit
- `address` - Alamat
- `email` - Email (Unique)
- `phone_number` - Nomor Telepon
- `created_at`, `updated_at` - Timestamps

### Patients Table
- `id` - Primary Key
- `name` - Nama Pasien
- `address` - Alamat
- `phone_number` - Nomor Telepon
- `hospital_id` - Foreign Key ke Hospitals
- `created_at`, `updated_at` - Timestamps

### Users Table
- `id` - Primary Key
- `name` - Nama User
- `email` - Email (Unique)
- `password` - Password (Hashed)
- `email_verified_at` - Email Verification
- `created_at`, `updated_at` - Timestamps

## 📝 API Endpoints

### Hospitals
- `GET /hospitals/index` - List semua rumah sakit
- `GET /hospitals/create` - Form tambah rumah sakit
- `POST /hospitals` - Simpan rumah sakit baru
- `GET /hospitals/{id}` - Detail rumah sakit
- `GET /hospitals/{id}/edit` - Form edit rumah sakit
- `PUT /hospitals/{id}` - Update rumah sakit
- `DELETE /hospitals/{id}` - Hapus rumah sakit

### Patients
- `GET /patients/index` - List semua pasien
- `GET /patients/create` - Form tambah pasien
- `POST /patients` - Simpan pasien baru
- `GET /patients/{id}` - Detail pasien
- `GET /patients/{id}/edit` - Form edit pasien
- `PUT /patients/{id}` - Update pasien
- `DELETE /patients/{id}` - Hapus pasien
