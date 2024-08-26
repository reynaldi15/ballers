# freelance-ballers

Ballers adalah platform marketplace yang memudahkan Anda menemukan dan menyewa lapangan basket sesuai kebutuhan Anda. Dengan berbagai pilihan lapangan di lokasi strategis, kami menyediakan fasilitas yang nyaman dan berkualitas untuk memastikan pengalaman bermain basket Anda menjadi lebih menyenangkan.


Berikut adalah langkah-langkah untuk menjalankan aplikasi Laravel di lingkungan lokal:

1. Persiapan Lingkungan
Pastikan kamu telah menginstal semua prasyarat berikut:
PHP (versi 8.0 atau lebih tinggi)
Composer (Dependency Manager untuk PHP)
Database Server (MySQL, PostgreSQL, dll.)
Node.js dan npm (untuk pengelolaan frontend)
2. Clone atau Download Project Laravel
Jika proyek Laravel berada di repositori Git, clone repositorinya:
bash
Copy code
git clone <url-repository.git>
Jika kamu memiliki file ZIP, unzip ke direktori pilihanmu.
3. Masuk ke Direktori Project
Buka terminal dan navigasi ke direktori project:
bash
Copy code
cd nama-folder-proyek
4. Instal Dependencies Composer
Jalankan perintah ini untuk menginstal semua dependencies PHP yang diperlukan oleh Laravel:
bash
Copy code
composer install
5. Instal Dependencies NPM
Jalankan perintah ini untuk menginstal semua dependencies frontend (JavaScript, CSS) yang diperlukan:
bash
Copy code
npm install
Setelah itu, jika diperlukan, kamu bisa meng-compile asset frontend:
bash
Copy code
npm run dev
Untuk kompilasi produk siap pakai:
bash
Copy code
npm run production
6. Konfigurasi File .env
Salin file .env.example menjadi .env:
bash
Copy code
cp .env.example .env
Buka file .env dan sesuaikan pengaturan database serta pengaturan lainnya seperti APP_NAME, APP_URL, DB_DATABASE, DB_USERNAME, dan DB_PASSWORD.
7. Generate Application Key
Laravel membutuhkan application key untuk enkripsi. Generate key ini dengan perintah:
bash
Copy code
php artisan key:generate
8. Migrasi Database
Jalankan migrasi untuk membuat tabel-tabel di database:
bash
Copy code
php artisan migrate
9. Jalankan Server Laravel
Untuk menjalankan server pengembangan Laravel, gunakan perintah:
bash
Copy code
php artisan serve
Aplikasi Laravel sekarang bisa diakses melalui http://localhost:3000 di browser.
10. (Opsional) Seed Database
Jika ada seeder untuk mengisi database dengan data contoh, kamu bisa menjalankannya dengan:
bash
Copy code
php artisan db:seed
11. (Opsional) Pengelolaan Cache dan Konfigurasi
Bersihkan dan optimalkan cache konfigurasi jika perlu:
bash
Copy code
php artisan config:cache
php artisan route:cache
php artisan view:cache
Dengan langkah-langkah ini, kamu bisa menjalankan codingan Laravel di lingkungan lokal. Jika ada langkah spesifik yang perlu dijelaskan lebih lanjut, beri tahu saya!
