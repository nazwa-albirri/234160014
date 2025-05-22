<?php

// Mendefinisikan namespace untuk model ini
namespace App\Models;

// Mengimpor kelas Model dari CodeIgniter
use CodeIgniter\Model;

// Mendefinisikan kelas UserModel yang merupakan turunan dari Model
class UserModel extends Model {
    // Menentukan nama tabel yang akan digunakan dalam database
    protected $table = 'users';
    
    // Menentukan kolom-kolom yang diizinkan untuk diisi (insert/update) dalam tabel
    protected $allowedFields = ['username', 'password'];
    
    // Menentukan apakah model ini menggunakan timestamp untuk created_at dan updated_at
    protected $useTimestamps = false; // Di sini diatur false, artinya tidak menggunakan timestamp
}
