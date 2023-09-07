# Reimbursement

## Clone and Setup Environment

-   Klon dan siapkan repositori ini di lingkungan lokal Anda menggunakan git dan perintah ini

```
git clone https://github.com/kahfi001/reimbursement.git
cd reimbursement
composer install
npm install
```

-   Salin Berkas .env.example dan Ubah Nama Menjadi .env:

```
cp .env.example .env
```

-   Setup Kunci di Berkas .env:

```
php artisan key:generate
```

## Migrate and seed database

-   Pastikan bahwa database Anda berjalan untuk melakukan migrasi dan mengisi basis data menggunakan perintah berikut:

```
php artisan migrate --seed
```

-   Jalankan proyek dengan perintah ini jika Anda tidak menggunakan Laragon dengan nama host virtual:

```
php artisan serve
```

-   Jalankan mode pengembangan npm dengan perintah ini:

```
npm run dev
```

-   Buka peramban web Anda dan buka proyek di salah satu URL berikut, tergantung pada pengaturan Anda: <a>http:://localhost:8000</a> or <a>http://reimbursement.test</a> jika Anda menggunakan Laragon dengan nama host virtual)
-   Gunakan NIP and password untuk login dengan beberapa role/jabatan

```
Role Direktur :
NIP : 1234
password : 123456

or

Role Finance :
email : 1235
password : 123456

or

Role Staff :
email : 1236
password : 123456

```
