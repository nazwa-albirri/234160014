<?php

// Mendefinisikan namespace untuk controller ini
namespace App\Controllers;

// Mengimpor model TugasModel dan kelas Controller dari CodeIgniter
use App\Models\TugasModel;
use CodeIgniter\Controller;

// Mendefinisikan kelas Tugas yang merupakan turunan dari Controller
class Tugas extends Controller {
    
    // Fungsi untuk menampilkan daftar tugas
    public function index() {
        // Membuat instance dari TugasModel
        $model = new TugasModel();
        // Mengambil semua tugas yang terkait dengan user_id yang ada di session
        $data['tugas'] = $model->where('user_id', session()->get('user_id'))->findAll();
        // Menampilkan view index tugas dengan data tugas yang diambil
        return view('tugas/index', $data);
    }

    // Fungsi untuk menambahkan tugas baru
    public function tambah() {
        // Memeriksa apakah metode permintaan adalah POST
        if ($this->request->getMethod() === 'post') {
            // Membuat instance dari TugasModel
            $model = new TugasModel();
            // Menyimpan data tugas baru yang diambil dari input form
            $model->save([
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'deadline' => $this->request->getPost('deadline'),
                'status' => $this->request->getPost('status'),
                // Mengaitkan tugas dengan user_id yang ada di session
                'user_id' => session()->get('user_id'),
            ]);
            // Mengalihkan pengguna ke halaman daftar tugas setelah berhasil menambahkan
            return redirect()->to('/tugas');
        }
        // Menampilkan view untuk menambahkan tugas jika metode bukan POST
        return view('tugas/tambah');
    }

    // Fungsi untuk mengedit tugas yang sudah ada
    public function edit($id) {
        // Membuat instance dari TugasModel
        $model = new TugasModel();
        
        // Memeriksa apakah metode permintaan adalah POST
        if ($this->request->getMethod() === 'post') {
            // Memperbarui data tugas berdasarkan ID yang diberikan
            $model->update($id, [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'deadline' => $this->request->getPost('deadline'),
                'status' => $this->request->getPost('status'),
            ]);
            // Mengalihkan pengguna ke halaman daftar tugas setelah berhasil mengedit
            return redirect()->to('/tugas');
        }
        // Mengambil data tugas berdasarkan ID yang diberikan untuk ditampilkan di form edit
        $data['tugas'] = $model->find($id);
        // Menampilkan view untuk mengedit tugas dengan data tugas yang diambil
        return view('tugas/edit', $data);
    }

    // Fungsi untuk menghapus tugas berdasarkan ID
    public function hapus($id) {
        // Membuat instance dari TugasModel
        $model = new TugasModel();
        // Menghapus tugas berdasarkan ID yang diberikan
        $model->delete($id);
        // Mengalihkan pengguna ke halaman daftar tugas setelah berhasil menghapus
        return redirect()->to('/tugas');
    }
}
