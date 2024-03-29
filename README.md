# Pemesanan Menu dengan Role (Admin, Waiter, Cashier, Chef)

## Deskripsi Proyek

Proyek ini adalah aplikasi pemesanan menu yang memungkinkan pengguna dengan peran yang berbeda, seperti Admin, Waiter, Cashier, dan Chef, untuk melakukan tugas-tugas tertentu sesuai dengan peran masing-masing. Berikut adalah ringkasan dari fungsi masing-masing peran:

-   **Admin**: Bertanggung jawab atas manajemen data master, termasuk Karyawan, Menu, Anggota, dan Laporan.
-   **Waiter**: Memilihkan meja untuk pengunjung dan mengambil pesanan menu.
-   **Chef**: Memperbarui status makanan dari pesanan (default: Pending, kemudian Cooking, kemudian Deliver).
-   **Cashier**: Memproses pembayaran setelah semua pesanan telah dikirim.

## Cara Menjalankan Proyek

1. **Clone Repository**:

    ```
    git clone <URL_REPOSITORY>
    ```

2. **Persiapkan Lingkungan**:

    - Salin file `.env.example` ke `.env`.
    - Install dependensi PHP menggunakan Composer:
        ```
        composer install
        ```
    - Generate kunci aplikasi Laravel:
        ```
        php artisan key:generate
        ```
    - Jalankan migrasi untuk membuat skema database:
        ```
        php artisan migrate
        ```
    - Isi database dengan data dummy menggunakan seed:
        ```
        php artisan db:seed
        ```

3. **Jalankan Server**:
    ```
    php artisan serve
    ```

## Penggunaan

-   **Admin**: Masuk ke panel admin untuk mengelola data master seperti Employee, Menu, Member, dan Report.
-   **Waiter**: Akses area Waiter untuk menugaskan meja kepada pengunjung dan mengambil pesanan menu.
-   **Chef**: Login ke panel Chef untuk memperbarui status pesanan makanan.
-   **Cashier**: Gunakan tampilan Kasir untuk memproses pembayaran setelah semua pesanan telah dikirim.

## Teknologi yang Digunakan

-   **Laravel**: Framework PHP untuk pengembangan web.
-   **MySQL**: Sistem manajemen basis data relasional untuk penyimpanan data.
-   **HTML/CSS**: Untuk desain antarmuka pengguna.
-   **JavaScript**: Digunakan untuk interaktivitas pada sisi klien.
-   **Bootstrap**: Framework CSS untuk desain responsif.

<!-- ## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Untuk informasi lebih lanjut, lihat file `LICENSE` dalam repositori. -->

## Kontribusi

Silakan untuk berkontribusi di [CONTRIBUTING.md](CONTRIBUTING.md).

## Dukungan

Jika Anda menemui masalah atau memiliki pertanyaan, jangan ragu untuk membuat isu baru di repositori ini atau hubungi tim pengembang melalui email di saepudinasep2001@gmail.com.

---

_Selamat menggunakan!_
