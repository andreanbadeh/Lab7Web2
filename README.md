# Praktikum 1-4 PHP Framework (Codeigniter)
NAMA : ANDREAN PUTRA ARYA

NIM : 312410341

KELAS : I241E

# Menjalankan Codeigniter terminal

Masukkan Perintah `php spark`

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/00e8a119f763f8ca66a9f6cde25690832c53fc74/image/Screenshot%20from%202026-02-26%2011-12-52.png)

# Struktur Direktori

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/cc8f4452fb1945e64df4c32833cc6d390c37f511/image/Screenshot%20from%202026-02-26%2011-18-21.png)

# Routing dan Controller

Router Terletak Pada File app/config/Routes.php

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/a1288c0b3f6cb4ec38b9a7a1b45070134a91404a/image/Screenshot%20from%202026-04-03%2018-40-20.png)

# Membuat Route Baru.

Tambahkan kode berikut di dalam Routes.php
```
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

$routes->get('/artikel', 'Artikel::index');

$routes->get('/artikel/add', 'Artikel::add');
$routes->post('/artikel/add', 'Artikel::add');

$routes->get('/artikel/edit/(:num)', 'Artikel::edit/$1');
$routes->post('/artikel/edit/(:num)', 'Artikel::edit/$1');

$routes->get('/artikel/delete/(:num)', 'Artikel::delete/$1');

$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');
```

Untuk route yang ditambahkan sudah benar, buka CLI dan jalankan perintah
berikut.

`php spark routes`

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/28a7514f69b3d78aaa7cb1a1d2c4d2e812f5760e/image/Screenshot%20from%202026-02-26%2011-26-05.png)

# Pertanyaan dan Tugas 1-4

Lengkapi kode program untuk menu lainnya yang ada pada Controller Page, sehingga semua
link pada navigasi header dapat menampilkan tampilan dengan layout yang sama.

Dan Untuk Menjalankan Program nya Ketik

`php spark serve`

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/73a0d1377e67554490b1199f8cf1894cd2e88b78/image/Screenshot%20from%202026-02-26%2011-24-25.png)

Dan Ini Untuk Hasil Login

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/2a88f65fe625cb9c49d55bdac716ffe724b1e802/image/Screenshot%20from%202026-04-03%2019-01-33.png)

# Menu Artikel

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/c0813c99662edd5c67c9366af0b0555ca5fdc059/image/Screenshot%20from%202026-04-03%2018-58-54.png)

# Menu About

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/963b0b1d733bbf5219950cb456fe87700fec0f3f/image/Screenshot%20from%202026-04-03%2019-02-31.png)

# Menu Kontak

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/ad50ca30bdfdbe42c06da1cbdd4725018a4afa2d/image/Screenshot%20from%202026-04-03%2019-02-59.png)
