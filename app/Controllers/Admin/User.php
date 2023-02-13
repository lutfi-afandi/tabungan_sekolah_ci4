<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'User',
        ];
        return view('admin/user/v_index',$data);
    }

    public function get_data_user()
    {
        $user = $this->user->findAll();
        $data = [
            'title' => 'User',
            'users' => $user,
        ];
        $msg = [
            'data'  => view('admin/user/v_list', $data),
        ];

        echo json_encode($msg);
    }

    public function add_user()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_user' => [
                    'label' => 'Nama Admin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|alpha_numeric|is_unique[tb_user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar',
                        'alpha_numeric' => '{field} tidak boleh selain huruf',
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
                        'nama_user'  => $validation->getError('nama_user'),
                        'password'  => $validation->getError('password'),
                        'username'  => $validation->getError('username'),
                    ]
                ];
            } else {
                $simpandata = [
                    'username'  => $this->request->getVar('username'),
                    'nama_user'  => $this->request->getVar('nama_user'),
                    'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                ];

                $this->user->insert($simpandata);
                $msg = [
                    'sukses' => 'Data user berhasil disimpan'
                ];
            }
            
            echo json_encode($msg);
        }
    }

    public function reset($id_user)
    {$data =[
        'password' =>password_hash('123456',PASSWORD_BCRYPT),
    ];
        $this->user->update($id_user, $data);
    
        $msg = [
            'pesan'  => 'Password telah di reset',
        ];
        echo json_encode($msg);
    }

    public function hapus($id_user)
    {
        if($id_user == session()->get('id')){
            $msg = [
                        'pesan'  => 'Tidak dapat menghapus User Aktif!',
            ];
        }else{
            $this->user->delete($id_user);
            $msg = [
                'pesan'  => 'User telah di hapus!',
            ];
        }
            
        echo json_encode($msg);
    }
}