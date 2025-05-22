<?php
// Mendefinisikan rute untuk aplikasi dalam file Routes.php

// Rute untuk halaman login
$routes->get('/login', 'Auth::login'); // Menangani permintaan GET untuk halaman login
$routes->post('/login', 'Auth::login'); // Menangani permintaan POST untuk proses login

// Rute untuk halaman registrasi
$routes->get('/register', 'Auth::register'); // Menangani permintaan GET untuk halaman registrasi
$routes->post('/register', 'Auth::register'); // Menangani permintaan POST untuk proses registrasi

// Rute untuk logout
$routes->get('/logout', 'Auth::logout'); // Menangani permintaan GET untuk proses logout

// Rute untuk halaman tugas
$routes->get('/tugas', 'Tugas::index'); // Menangani permintaan GET untuk menampilkan daftar tugas

// Rute untuk menambahkan tugas
$routes->get('/tugas/tambah', 'Tugas::tambah'); // Menangani permintaan GET untuk halaman tambah tugas
$routes->post('/tugas/tambah', 'Tugas::tambah'); // Menangani permintaan POST untuk proses menambahkan tugas

// Rute untuk mengedit tugas
$routes->get('/tugas/edit/(:num)', 'Tugas::edit/$1'); // Menangani permintaan GET untuk halaman edit tugas berdasarkan ID
$routes->post('/tugas/edit/(:num)', 'Tugas::edit/$1'); // Menangani permintaan POST untuk proses mengedit tugas berdasarkan ID

// Rute untuk menghapus tugas
$routes->get('/tugas/hapus/(:num)', 'Tugas::hapus/$1'); // Menangani permintaan GET untuk proses menghapus tugas berdasarkan ID
