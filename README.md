Nama: Theo Septian Nur M.S.
NIM: 240605110092

Deskripsi Aplikasi

Sistem Manajemen Blog (CMS) merupakan aplikasi berbasis Laravel yang digunakan untuk mengelola konten blog. Aplikasi ini menyediakan fitur pengelolaan artikel, penulis, dan kategori artikel melalui halaman administrator yang hanya dapat diakses oleh pengguna yang telah login.

Selain fitur CMS, aplikasi juga menyediakan halaman pengunjung yang dapat diakses tanpa login. Pengunjung dapat melihat artikel terbaru, menyaring artikel berdasarkan kategori, membaca detail artikel, serta melihat artikel terkait berdasarkan kategori yang sama.

Fitur utama aplikasi:

Login dan Logout Administrator
Dashboard Administrator
CRUD Penulis
CRUD Kategori Artikel
CRUD Artikel
Upload Foto Penulis
Upload Gambar Artikel
Halaman Publik/Pengunjung
Filter Artikel Berdasarkan Kategori
Detail Artikel
Artikel Terkait
Langkah Menjalankan Aplikasi Secara Lokal
1. Clone Repository
git clone https://github.com/USERNAME/aplikasi-blog-240605110092.git
2. Masuk ke Folder Project
cd aplikasi-blog-[NIM]
3. Install Dependency
composer install
4. Salin File Environment
cp .env.example .env
5. Konfigurasi Database

Buat database dengan nama:

db_blog

Kemudian sesuaikan konfigurasi database pada file .env.

6. Generate Application Key
php artisan key:generate
7. Jalankan Migrasi Database
php artisan migrate
8. Buat Symbolic Link Storage
php artisan storage:link
9. Jalankan Aplikasi
php artisan serve

Aplikasi dapat diakses melalui:

http://127.0.0.1:8000
