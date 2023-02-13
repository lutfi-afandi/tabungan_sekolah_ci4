<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login | Aplikasi Tabungan',
            'validation'    => $this->validation,
        ];
        return view('v_login_siswa',$data);
    }
    

    public function cek_login()
    {
        
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                
            ]);
            if (!$valid) {
                set_notifikasi_swal('error', 'Gagal', 'Login gagal !');
                return redirect()->to(base_url('auth'))->withInput()->with('validation', $valid);
            } else {
                // jika validasi berhasil
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $cek_siswa = $this->siswa->where('username', $username)->first();
                $cek_petugas = $this->petugas->where('username', $username)->first();
                if ($cek_siswa) {
                    $pass = $cek_siswa['password'];
                    $verify_pass = password_verify($password, $pass);
                    if($verify_pass){
                        session()->set('id_siswa', $cek_siswa['id_siswa']);
                        session()->set('nama_siswa', $cek_siswa['nama_siswa']);
                        session()->set('username', $cek_siswa['username']);
                        session()->set('foto', $cek_siswa['foto_siswa']);
                        session()->set('nis', $cek_siswa['nis']);
                        session()->set('role', $cek_siswa['role']);
                        set_notifikasi_swal('success', 'Berhasil', 'Selamat datang '.$cek_siswa['nama_siswa']);
                        return redirect()->to(base_url('siswa/dashboard'));
                        
                    }else {
                        set_notifikasi_swal('error', 'Gagal', 'Siswa Tidak Terdaftar !');
                        return redirect()->to(base_url('auth'))->withInput()->with('validation', $valid);
                    }
                }
                else if ($cek_petugas) {
                    $pass = $cek_petugas['password'];
                    $verify_pass = password_verify($password, $pass);
                    if($verify_pass){
                        session()->set('id_petugas', $cek_petugas['id_petugas']);
                        session()->set('nama_petugas', $cek_petugas['nama_petugas']);
                        session()->set('username', $cek_petugas['username']);
                        session()->set('foto', $cek_petugas['foto_petugas']);
                        session()->set('nip', $cek_petugas['nip']);
                        session()->set('role', $cek_petugas['role']);
                        set_notifikasi_swal('success', 'Berhasil', 'Selamat datang '.$cek_petugas['nama_petugas']);
                        return redirect()->to(base_url('admin/dashboard'));
                        
                    }else {
                        set_notifikasi_swal('error', 'Gagal', 'Petugas Tidak Terdaftar !');
                        return redirect()->to(base_url('auth'))->withInput()->with('validation', $valid);
                    }
                }
                else{
                    set_notifikasi_swal('error', 'Gagal', 'User tidak terdaftar !');
                    return redirect()->to(base_url('auth'))->withInput()->with('validation', $valid);
                }
            }
    }

    /*public function cek_login_petugas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'password'  => $validation->getError('password'),
                        'username'  => $validation->getError('username'),
                    ]
                ];
            } else {
                // jika validasi berhasil
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $cek_petugas = $this->petugas->where('username', $username)->first();
                if ($cek_petugas) {
                    $pass = $cek_petugas['password'];
                    $verify_pass = password_verify($password, $pass);
                    if($verify_pass){
                        session()->set('id_petugas', $cek_petugas['id_petugas']);
                        session()->set('nama_petugas', $cek_petugas['nama_petugas']);
                        session()->set('username', $cek_petugas['username']);
                        session()->set('foto', $cek_petugas['foto_petugas']);
                        session()->set('nip', $cek_petugas['nip']);
                        session()->set('role', $cek_petugas['role']);
                        $msg = [
                            'sukses' => 'Login Sebagai petugas',
                            'status'    =>'petugas',
                        ];
                        
                    }else {
                        $msg = [
                            'galat' => 'Petugas tidak terdaftar'
                        ];
                    }
                }else{
                    $msg = [
                        'galat' => 'Petugas tidak terdaftar'
                    ];
                }
        }
        echo json_encode($msg);
                    
        }
    }
    */

    public function logout()
    {
        session_destroy();
        return redirect()->to(base_url('auth'));
    }



}