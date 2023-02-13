<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Petugas extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Data Petugas',
            'petugas' => $this->petugas->findAll(),
        ];
        return view('admin/petugas/v_index', $data);
    }

    public function get_data_petugas()
    {
        $petugas = $this->petugas->findAll();
        $data = [
            'petugass' => $petugas,
        ];
        $msg = [
            'data'  => view('admin/petugas/v_list', $data),
        ];

        echo json_encode($msg);
    }
    

    public function add($id_petugas = false)
    {
        if ($id_petugas) {
            $petugas = $this->petugas->find($id_petugas);
            $data = [
                'title'=>'Edit Data Petugas',
                'petugas' => $petugas,
                'kelas' => $this->kelas->findAll(),
                'validation' => $this->validation,
            ]; 
            return view('admin/petugas/v_edit', $data);
        }else{
            $data = [
                'title'=>'Tambah Data Petugas',
                'kelas' => $this->kelas->findAll(),
                'validation' => $this->validation,
            ]; 
            return view('admin/petugas/v_form', $data);

        }
        // dd($data);
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
                return redirect()->to(base_url('admin/petugas/add/'.$id_petugas))->withInput()->with('validation', $valid);
            } else {
              
                $simpandata = [
                    'nama_petugas'  => $this->request->getVar('nama_petugas'),
                    'alamat_petugas'  => $this->request->getVar('alamat_petugas'),
                    'jk_petugas'  => $this->request->getVar('jk_petugas'),
                    'kontak'  => $this->request->getVar('kontak'),
                ];

                $this->petugas->update($id_petugas,$simpandata);
                set_notifikasi_swal('success', 'Berhasil', 'Data telah di Ubah!');
                return redirect()->to(base_url('admin/petugas'));
            }
            
    }
    public function save()
    {
        $dir = './public/foto_petugas/';
        $foto = $this->request->getFile('foto_petugas');
        $newname = "Foto - " . $this->request->getVar('nama_petugas').date('dMYhis');
        $simpandata = [
            'nip'  => $this->request->getVar('nip'),
            'nama_petugas'  => $this->request->getVar('nama_petugas'),
            'alamat_petugas'  => $this->request->getVar('alamat_petugas'),
            'username'  => $this->request->getVar('username'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT) ,
            'jk_petugas'  => $this->request->getVar('jk_petugas'),
            'kontak'  => $this->request->getVar('kontak'),
            'role'  => $this->request->getVar('role'),
        ];
        if (!empty($foto->getName())) {
            $ext = $foto->getExtension();
            $foto->move($dir, $newname . '.' . $ext);
            $simpandata['foto_petugas']  = $newname . '.' . $ext;
		} else {
			$data['foto_petugas'] = 'kosong';
		}
            // $validation = \Config\Services::validation();
        $valid = $this->validate([
        
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[tb_petugas.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar',
                ]
            ],
            'nama_petugas' => [
                'label' => 'Nama Petugas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|password_strength[8]',
                'errors' => [
                    'required' => '{field} tidakboleh kosong',
                    'password_strength' => 'Password minimal 8 karakter dan mengandung satu huruf besar,1 angka dan 1 special karakter'
                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            // 'foto_petugas'  => [
            //     // 'label' => 'Mahapetugasname',
            //     'rules'  =>  'uploaded[foto_petugas]|max_size[foto_petugas,50000]|mime_in[foto_petugas,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
            //     'errors' => [
            //         'uploaded'  => 'Pilih Foto terlebih dulu',
            //         'max_size'  => 'File tidak boleh lebih dari 2MB',
            //         'mime_in'   => 'Pastikan format jpg/png'
            //     ]
            // ],
        ]);
        if (!$valid) {
            // dd($validation);
        set_notifikasi_swal('error', 'Gagal', 'Data gagal diinput!');
            return redirect()->to(base_url('admin/petugas/add'))->withInput()->with('validation', $valid);
        } else {
            $this->petugas->insert($simpandata);
            set_notifikasi_swal('success', 'Berhasil', 'Data telah di input!');
            return redirect()->to(base_url('admin/petugas'));
        }
            
    }

    public function hapus($id_petugas)
    {
        $this->petugas->delete($id_petugas);
    
        $msg = [
            'pesan'  => 'Data Petugas telah di hapus',
        ];
        echo json_encode($msg);
    }
    public function reset_password($id_petugas)
    {
        $data['password'] = password_hash('12345', PASSWORD_BCRYPT);
        $this->petugas->update($id_petugas, $data);
    
        set_notifikasi_swal('success', 'Berhasil', 'Password telah di reset');
        return redirect()->to(base_url('admin/petugas'));
    }
}