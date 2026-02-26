# PHP Framework (Codeigniter)
NAMA : ANDREAN PUTRA ARYA

NIM : 312410341

KELAS : TI.24.A.4

# Menjalankan Codeigniter terminal

Masukkan Perintah `php spark`

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/00e8a119f763f8ca66a9f6cde25690832c53fc74/image/Screenshot%20from%202026-02-26%2011-12-52.png)

# Struktur Direktori

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/cc8f4452fb1945e64df4c32833cc6d390c37f511/image/Screenshot%20from%202026-02-26%2011-18-21.png)

# Routing dan Controller

Router Terletak Pada File app/config/Routes.php

![gambar](https://github.com/andreanbadeh/Lab7Web2/blob/39b7ea72bec4a82f0e0be65023fcdb1cfbc934e5/image/Screenshot%20from%202026-02-26%2011-20-38.png)

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
```
