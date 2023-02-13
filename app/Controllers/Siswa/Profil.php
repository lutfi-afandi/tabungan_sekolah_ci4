<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;

class Profil extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Profil Siswa',
            'siswa' => $this->siswa->find(session()->get('id_siswa')),
            'validation' => $this->validation,
        ];
        return view('siswa/profil/v_index', $data);
    }

    public function update_foto($id_siswa)
    {
        $siswa = $this->siswa->find(session()->get('id_siswa'));
        $valid = $this->validate([
            'foto_siswa'  => [
                // 'label' => 'Mahasiswaname',
                'rules'  =>  'uploaded[foto_siswa]|max_size[foto_siswa,50000]|mime_in[foto_siswa,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'uploaded'  => 'Pilih Foto terlebih dulu',
                    'max_size'  => 'File tidak boleh lebih dari 2MB',
                    'mime_in'   => 'Pastikan format jpg/png'
                ]
            ],
        ]);
        if (!$valid) {
            // dd($validation);
        set_notifikasi_swal('error', 'Gagal', 'Foto gagal di Update!');
            return redirect()->to(base_url('siswa/profil'))->withInput()->with('validation', $valid);
        } else {
            $dir = './public/foto_siswa/';
            $foto = $this->request->getFile('foto_siswa');
            $newname = "Foto - " . $this->request->getVar('nama_siswa').date('dMYhis');
            $ext = $foto->getExtension();
            $foto->move($dir, $newname . '.' . $ext);
            $simpandata = [
                'foto_siswa'  => $newname . '.' . $ext,
            ];

            $this->siswa->update($id_siswa,$simpandata);
            unset($_SESSION['foto']);
            session()->set('foto', $simpandata['foto_siswa']);
            set_notifikasi_swal('success', 'Berhasil', 'Foto telah di update!');
            return redirect()->to(base_url('siswa/profil'));
        }
    }

    public function update($id_siswa)
    {
        // $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_siswa' => [
                'label' => 'Nama Siswa',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            
        ]);
        if (!$valid) {
            
        set_notifikasi_swal('error', 'Gagal', 'Data gagal di Ubah!');
            return redirect()->to(base_url('siswa/profil/'))->withInput()->with('validation', $valid);
        } else {
          
            $simpandata = [
                'nama_siswa'  => $this->request->getVar('nama_siswa'),
                'alamat_siswa'  => $this->request->getVar('alamat_siswa'),
                'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
                'kontak'  => $this->request->getVar('kontak'),
                'nama_ortu'  => $this->request->getVar('nama_ortu'),
            ];

            $this->siswa->update($id_siswa,$simpandata);
            set_notifikasi_swal('success', 'Berhasil', 'Data telah di Ubah!');
            return redirect()->to(base_url('siswa/profil'));
        }
    }
}