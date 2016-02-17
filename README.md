# kodegenerator-laravel-5
Generator Migration, Controller, Repository, Model, Form Request in single command for Laravel 5 above

##Install

Buka terminal, lalu ketikkan:

```bash 
    sudo composer require rohmadst/kodegenerator
```

Setelah composer sudah selesai terinstall dengan baik.
Sekarang buka `config/app.php`, tambahkan baris kode berikut di group array providers .

```bash
    Rohmadst\Kodegenerator\KodeGeneratorServiceProvider::class
```

Setelah itu jalankan perintah berikut untuk copy file kodegenerator.php ke app/config:
```bash
    php artisan vendor:publish
```

Cek apakah sudah berhasil dengan cara:
```bash
    php artisan list
```

Tanda bahwa install berhasil, adalah akan ada baris perintah berikut:
```bash
    kode:resource
```

Baiklah, semoga kontribusi sederhana saya ini bisa berguna buat para pengembang Laravel dimana pun berada.
Terima kasih.