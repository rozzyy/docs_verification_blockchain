# docs_verification

Deskripsi singkat: aplikasi Laravel untuk verifikasi dokumen (skeleton). README ini berisi petunjuk dasar untuk instalasi, konfigurasi, menjalankan, dan kontribusi.

## Fitur utama
- Verifikasi dokumen pdf dengna blockchain

## Persyaratan
- PHP >= 8.0
- Composer
- Node.js & npm
- Git

## Notes
- Gunakan node versi 18 untuk install tool blockchain
- Gunakan node versi 22 untuk menjalankan projek laravel ini

## Instalasi (lokal)
1. Clone repository
    ```
    git clone <repo-url> .
    ```
2. Pasang dependensi PHP
    ```
    composer install
    ```
3. Salin file environment dan atur variabel
    ```
    cp .env.example .env
    ```
4. Buat application key
    ```
    php artisan key:generate
    ```
5. Atur koneksi database di .env lalu migrasi
    ```
    php artisan migrate
    ```

6. Pasang dependensi frontend (opsional)
    ```
    npm install
    npm run dev
    ```

## Menjalankan aplikasi
- Server built-in
  ```
  php artisan serve
  ```

## Install Truffle untuk blockchain
- Gunakan Node 18 untuk install tools ini
  ```
  npm install -g truffle
  ```

- Kemudian masuk ke folder hash_storage
  ```
  cd hash_storage
  ```

- Jalankan perintah
  ```
  truffle migrate --network development
  ```

## Note
- Jalankan Ganache terlebih dahulu sebelum menjalankan semua perintah di atas.
