<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Siswa extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Data Siswa',
        ];
        return view('admin/siswa/v_index', $data);
    }

    public function get_data_siswa()
    {
        $siswa = $this->siswa->getData();
        $data = [
            'siswas' => $siswa,
        ];
        $msg = [
            'data'  => view('admin/siswa/v_list', $data),
        ];

        echo json_encode($msg);
    }
    

    public function add($id_siswa = false)
    {
        if ($id_siswa) {
            $siswa = $this->siswa->find($id_siswa);
            $data = [
                'title'=>'Edit Data Siswa',
                'siswa' => $siswa,
                'kelas' => $this->kelas->findAll(),
                'validation' => $this->validation,
            ]; 
            return view('admin/siswa/v_edit', $data);
        }else{
            $data = [
                'title'=>'Tambah Data Siswa',
                'kelas' => $this->kelas->findAll(),
                'validation' => $this->validation,
            ]; 
            return view('admin/siswa/v_form', $data);

        }
        // dd($data);
    }

    public function update($id_siswa)
    {
            // $validation = \Config\Services::validation();
            $valid = $this->validate([
                
                
                'nama_siswa' => [
                    'label' => 'Nama Petugas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kelas_id' => [
                    'label' => 'Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                
            ]);
            if (!$valid) {
                
            set_notifikasi_swal('error', 'Gagal', 'Data gagal di Ubah!');
                return redirect()->to(base_url('admin/siswa/add/'.$id_siswa))->withInput()->with('validation', $valid);
            } else {
              
                $simpandata = [
                    'nama_siswa'  => $this->request->getVar('nama_siswa'),
                    'kelas_id'  => $this->request->getVar('kelas_id'),
                    'alamat_siswa'  => $this->request->getVar('alamat_siswa'),
                    'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
                    'nama_ortu'  => $this->request->getVar('nama_ortu'),
                    'kontak'  => $this->request->getVar('kontak'),
                ];

                $this->siswa->update($id_siswa,$simpandata);
                set_notifikasi_swal('success', 'Berhasil', 'Data telah di Ubah!');
                return redirect()->to(base_url('admin/siswa'));
            }
            
    }
    public function save()
    {
        $dir = './public/foto_siswa/';
        $foto = $this->request->getFile('foto_siswa');
        $newname = "Foto - " . $this->request->getVar('nama_siswa').date('dMYhis');
        $simpandata = [
            'nis'  => $this->request->getVar('nis'),
            'nama_siswa'  => $this->request->getVar('nama_siswa'),
            'kelas_id'  => $this->request->getVar('kelas_id'),
            'alamat_siswa'  => $this->request->getVar('alamat_siswa'),
            'username'  => $this->request->getVar('username'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT) ,
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'nama_ortu'  => $this->request->getVar('nama_ortu'),
            'kontak'  => $this->request->getVar('kontak'),
            
        ];

        if (!empty($foto->getName())) {
            $ext = $foto->getExtension();
            $foto->move($dir, $newname . '.' . $ext);
            $simpandata['foto_siswa']  = $newname . '.' . $ext;
		} else {
			$data['foto_mhs'] = 'kosong';
		}

        $valid = $this->validate([
            
            'nis' => [
                'label' => 'NIS',
                'rules' => 'required|is_unique[tb_siswa.nis]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar',
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[tb_siswa.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar',
                ]
            ],
            'nama_siswa' => [
                'label' => 'Nama Petugas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'kelas_id' => [
                'label' => 'Kelas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|password_strength[8]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'password_strength' => 'Password minimal 8 karakter dan mengandung satu huruf besar,1 angka dan 1 special karakter'
                ]
            ],
            // 'foto_siswa'  => [
            //     // 'label' => 'Mahasiswaname',
            //     'rules'  =>  'uploaded[foto_siswa]|max_size[foto_siswa,50000]|mime_in[foto_siswa,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
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
            return redirect()->to(base_url('admin/siswa/add'))->withInput()->with('validation', $valid);
        } else {
            $this->siswa->insert($simpandata);
            set_notifikasi_swal('success', 'Berhasil', 'Data telah di input!');
            return redirect()->to(base_url('admin/siswa'));
        }
            
    }

    public function hapus($id_siswa)
    {
        $this->siswa->delete($id_siswa);
    
        $msg = [
            'pesan'  => 'Data Siswa telah di hapus',
        ];
        echo json_encode($msg);
    }
    public function reset_password($id_siswa)
    {
        $data['password'] = password_hash('12345', PASSWORD_BCRYPT);
        $this->siswa->update($id_siswa, $data);
    
        set_notifikasi_swal('success', 'Berhasil', 'Password telah di reset');
        return redirect()->to(base_url('admin/siswa'));
    }
}