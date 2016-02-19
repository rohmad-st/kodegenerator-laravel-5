# CRUD Generator Laravel 5 above
Generator Migration, Controller, Repository, Model, Form Request in single command for Laravel 5 above (RestFul API)

##Demo
> [Lihat demo video](https://goo.gl/vUj0RX)

##Fitur
Beberapa command yang tersedia adalah:
```bash
    - kode:query {name} {prefix}        -> untuk menambahkan satu service
    - kode:resource {name} {prefix}     -> untuk menambahkan full resource (migrate, controller, repository, model, form request)
```

##Install

Buka terminal, lalu ketikkan:
```bash
     sudo composer require rohmadst/kodegenerator
```

atau jika melalui `composer.json`, tambahkan kode seperti berikut:

```bash 
    "require": {
        ...
        "rohmadst/kodegenerator": "^2.2"
    },
```

dan jalankan `sudo composer update`


Setelah composer update sudah selesai dan terinstall dengan baik.
Buka `config/app.php`, tambahkan baris kode berikut pada group array providers .

```bash
    Rohmadst\Kodegenerator\KodeGeneratorServiceProvider::class
```

Setelah itu jalankan perintah berikut, kode ini akan mengcopy file `kodegenerator.php` ke app/config, 
sehingga nanti anda bisa ubah lokasi masing-masing file:
```bash
    php artisan vendor:publish
```

##Cara Menggunakan

Cek apakah composer sudah terinstall:
```bash
    php artisan list
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

##Info Tambahan
```bash
    Untuk perintah kode:query pastikan anda sudah menambahkan kode {{kodegenerator}} di file Repository & Controller yang akan ditambahkan service baru.
    
    NB. templates di kodegenerator ini secara default sudah saya integrasi dengan:
    - Cache Redis 
    - Jwt Auth 
    - JSON Web Token Authentication
    - RESTFul API.
    
    Kodegenerator Laravel 5 ini akan sangat membantu sekali bagi developer yang khusus menangani Backend Developer (RESTFul API).   
    Akan tetapi template yang saya sediakan, bisa juga diedit dan disesuaikan dengan kebutuhan masing-masing developer.
    
    Letak path folder templates sendiri ada di: vendor/rohmadst/kodegenerator/src/Console/Commands/Stubs

```


Baiklah, semoga kontribusi sederhana saya ini bisa berguna buat para pengembang Laravel dimana pun berada.
Terima kasih.

****

Bila ada kritik/saran/pertanyaan silahkan menghubungi saya di:
```bash
    Email: rohmadsasmito@gmail.com
    Skype: rohmad.st
```