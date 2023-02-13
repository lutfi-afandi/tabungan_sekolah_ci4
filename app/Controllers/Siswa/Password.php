<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;

class Password extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Password Siswa',
            'siswa' => $this->siswa->find(session()->get('id_siswa')),
            'validation' => $this->validation,
        ];
        return view('siswa/v_password', $data);
    }

    public function ganti()
    {
        $id_siswa = session()->get('id_siswa');
        $valid = $this->validate([
               
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ]);
        if (!$valid) {
            // dd($validation);
        set_notifikasi_swal('error', 'Gagal', 'Password gagal diinput!');
        return redirect()->to(base_url('siswa/password'))->withInput()->with('validation', $valid);
        } else {
            
            $simpandata = [
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT) ,
            ];

            $this->siswa->update($id_siswa, $simpandata);
            set_notifikasi_swal('success', 'Berhasil', 'Password telah di Ubah!');
            return redirect()->to(base_url('siswa/password'));
        }
    }

    public function gantis()
    {
        $id_siswa = session()->get('id_siswa');
        $valid = $this->validate([
               
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ]);
        if (!$valid) {
            // dd($validation);
        set_notifikasi_swal('error', 'Gagal', 'Password gagal diinput!');
        return redirect()->to(base_url('siswa/profil'))->withInput()->with('validation', $valid);
        } else {
            
            $simpandata = [
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT) ,
            ];

            $this->siswa->update($id_siswa, $simpandata);
            set_notifikasi_swal('success', 'Berhasil', 'Password telah di Ubah!');
            return redirect()->to(base_url('siswa/profil'));
        }
    }
}