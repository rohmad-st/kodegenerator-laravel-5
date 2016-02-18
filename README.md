# CRUD Generator Laravel 5 above
Generator Migration, Controller, Repository, Model, Form Request in single command for Laravel 5 above (RestFul API)

##Demo
> [Lihat demo video](https://goo.gl/vUj0RX)

##Install

Buka `composer.json`, lalu tambahkan kode seperti berikut:

```bash 
    "require": {
        ...
        "rohmadst/kodegenerator": "dev-master"
    },
```

Lalu jalankan `sudo composer update`

Atau anda bisa buka terminal, dan ketikkan:
```bash
     sudo composer require rohmadst/kodegenerator dev-master
```

Setelah composer update sudah selesai dan terinstall dengan baik.
Buka `config/app.php`, tambahkan baris kode berikut pada group array providers .

```bash
    Rohmadst\Kodegenerator\KodeGeneratorServiceProvider::class
```

Setelah itu jalankan perintah berikut, kode ini akan mengcopy file kodegenerator.php ke app/config, 
sehingga nanti anda bisa ubah lokasi masing-masing file:
```bash
    php artisan vendor:publish
```

##Cara Menggunakan

Cek apakah composer sudah terinstall:
```bash
    php artisan list
```

Tanda bahwa install berhasil, adalah akan ada baris perintah berikut:
```bash
    - kode:query {name} {prefix}        -> untuk menambahkan satu service
    - kode:resource {name} {prefix}     -> untuk menambahkan full resource (migrate, controller, repository, model, form request)
```

Sebagai test bahwa composer sudah terinstall dengan benar, silahkan coba:
```bash
    kode:resource Foo Foo
```

pada saat anda menjalankan perintah melalui terminal:
- `masukkan nama tabel`
- `masukkan field.`

Sebagai contoh, ketika diminta menambahkan fields, ketik:
```bash
    nama:string, pekerjaan:string, usia:integer, alamat:string:nullable()->default(null)     
```

Baiklah, semoga kontribusi sederhana saya ini bisa berguna buat para pengembang Laravel dimana pun berada.
Terima kasih.

****

```bash
NB. template yang saya gunakan secara default terintegrasi dengan cache redis, dan full RESTFul API.
akan tetapi template bisa diedit dan disesuaikan dengan kebutuhan developer.

```

Bila ada kritik/saran/pertanyaan silahkan menghubungi saya di:
```bash
    Email: rohmadsasmito@gmail.com
    Skype: rohmad.st
```