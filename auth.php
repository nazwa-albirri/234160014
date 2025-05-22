<?php

// Mendefinisikan namespace untuk controller ini
namespace App\Controllers;

// Mengimpor model UserModel dan kelas Controller dari CodeIgniter
use App\Models\UserModel;
use CodeIgniter\Controller;

// Mendefinisikan kelas Auth yang merupakan turunan dari Controller
class Auth extends Controller {
    
    // Fungsi untuk menangani proses login
    public function login() {
        // Memuat helper form untuk memudahkan pengolahan form
        helper(['form']);
        
        // Memeriksa apakah metode permintaan adalah POST
        if ($this->request->getMethod() === 'post') {
            // Membuat instance dari UserModel
            $model = new UserModel();
            // Mencari pengguna berdasarkan username yang diberikan
            $user = $model->where('username', $this->request->getPost('username'))->first();
            
            // Memeriksa apakah pengguna ditemukan dan password yang diberikan valid
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                // Menyimpan data pengguna ke dalam session
                session()->set(['user_id' => $user['id'], 'username' => $user['username']]);
                // Mengalihkan pengguna ke halaman tugas setelah login berhasil
                return redirect()->to('/tugas');
            }
            // Mengalihkan kembali dengan pesan error jika login gagal
            return redirect()->back()->with('error', 'Login gagal');
        }
        // Menampilkan view login jika metode bukan POST
        return view('auth/login');
    }

    // Fungsi untuk menangani proses registrasi pengguna baru
    public function register() {
        // Memuat helper form untuk memudahkan pengolahan form
        helper(['form']);
        
        // Memeriksa apakah metode permintaan adalah POST
        if ($this->request->getMethod() === 'post') {
            // Membuat instance dari UserModel
            $model = new UserModel();
            // Menyiapkan data pengguna baru untuk disimpan
            $data = [
                'username' => $this->request->getPost('username'),
                // Meng-hash password sebelum menyimpannya ke database
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            // Menyimpan data pengguna baru ke dalam database
            $model->insert($data);
            // Mengalihkan pengguna ke halaman login setelah registrasi berhasil
            return redirect()->to('/login');
        }
        // Menampilkan view registrasi jika metode bukan POST
        return view('auth/register');
    }

    // Fungsi untuk menangani proses logout
    public function logout() {
        // Menghancurkan session untuk logout pengguna
        session()->destroy();
        // Mengalihkan pengguna ke halaman login setelah logout
        return redirect()->to('/login');
    }
}
