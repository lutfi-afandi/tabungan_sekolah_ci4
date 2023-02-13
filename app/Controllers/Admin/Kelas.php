<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kelas extends BaseController
{
    public function index()
    {
        return view('admin/kelas/v_index');
    }

    public function get_data_kelas()
    {
        $kelas = $this->kelas->findAll();
        $data = [
            'kelass' => $kelas,
        ];
        $msg = [
            'data'  => view('admin/kelas/v_list', $data),
        ];

        echo json_encode($msg);
    }

    public function show($id_kelas)
    {
        $kelas = $this->kelas->find($id_kelas);
        $msg = [
            'data'  =>  $kelas,
        ];

        echo json_encode($msg);
    }

    public function edit_kelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                
                'nama_kelas' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[tb_kelas.nama_kelas]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas'  => $validation->getError('nama_kelas'),
                    ]
                ];
            } else {
                $id_kelas = $this->request->getVar('id_kelas');
                $simpandata = [
                    'nama_kelas'  => $this->request->getVar('nama_kelas'),
                ];

                $this->kelas->update($id_kelas,$simpandata);
                $msg = [
                    'sukses' => 'Data kelas berhasil diubah'
                ];
            }
            
            echo json_encode($msg);
        }
    }
    public function add_kelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                
                'nama_kelas' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[tb_kelas.nama_kelas]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas'  => $validation->getError('nama_kelas'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_kelas'  => $this->request->getVar('nama_kelas'),
                ];

                $this->kelas->insert($simpandata);
                $msg = [
                    'sukses' => 'Data kelas berhasil disimpan'
                ];
            }
            
            echo json_encode($msg);
        }
    }



    public function hapus($id_kelas)
    {
        $this->kelas->delete($id_kelas);
    
        $msg = [
            'pesan'  => 'Kelas telah di hapus',
        ];
        echo json_encode($msg);
    }
}