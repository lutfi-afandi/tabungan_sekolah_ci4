<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profil extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Profil Petugas',
            'petugas' => $this->petugas->find(session()->get('id_petugas')),
            'validation' => $this->validation,
        ];
        return view('admin/profil/v_index', $data);
    }

    public function update_foto($id_petugas)
    {
        $petugas = $this->petugas->find(session()->get('id_petugas'));
        $valid = $this->validate([
            'foto_petugas'  => [
                // 'label' => 'Mahapetugasname',
                'rules'  =>  'uploaded[foto_petugas]|max_size[foto_petugas,50000]|mime_in[foto_petugas,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
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
            return redirect()->to(base_url('admin/profil'))->withInput()->with('validation', $valid);
        } else {
            $dir = './public/foto_petugas/';
            $foto = $this->request->getFile('foto_petugas');
            $newname = "Foto - " . $this->request->getVar('nama_petugas').date('dMYhis');
            $ext = $foto->getExtension();
            $foto->move($dir, $newname . '.' . $ext);
            $simpandata = [
                'foto_petugas'  => $newname . '.' . $ext,
            ];

            $this->petugas->update($id_petugas,$simpandata);
            unset($_SESSION['foto']);
            session()->set('foto', $simpandata['foto_petugas']);
            set_notifikasi_swal('success', 'Berhasil', 'Foto telah di update!');
            return redirect()->to(base_url('admin/profil'));
        }
    }

    public function update($id_petugas)
    {
        // $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nama_petugas' => [
                'label' => 'Nama Petugas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            
        ]);
        if (!$valid) {
            
        set_notifikasi_swal('error', 'Gagal', 'Data gagal di Ubah!');
            return redirect()->to(base_url('admin/profil/'))->withInput()->with('validation', $valid);
        } else {
          
            $simpandata = [
                'nama_petugas'  => $this->request->getVar('nama_petugas'),
                'alamat_petugas'  => $this->request->getVar('alamat_petugas'),
                'jk_petugas'  => $this->request->getVar('jk_petugas'),
                'kontak'  => $this->request->getVar('kontak'),
            ];

            $this->petugas->update($id_petugas,$simpandata);
            set_notifikasi_swal('success', 'Berhasil', 'Data telah di Ubah!');
            return redirect()->to(base_url('admin/profil'));
        }
    }
}