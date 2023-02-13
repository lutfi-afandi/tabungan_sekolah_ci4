<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['siswa'] = $this->siswa->getData();
        return view('admin/transaksi/v_index',$data);
    }

    public function get_data_transaksi()
    {
        $transaksi = $this->transaksi->getData();
        $data['title'] = 'Transaksi';
        $data = [
            'transaksis' => $transaksi,
        ];
        $msg = [
            'data'  => view('admin/transaksi/v_list', $data),
        ];

        echo json_encode($msg);
    }

    public function show_saldo($siswa_id)
    {
        $up = (int)$this->transaksi->getSetoran($siswa_id)['total_setoran'];
        $down = (int)($this->transaksi->getTarikan($siswa_id) ==null) ? 0 : $this->transaksi->getTarikan($siswa_id)['total_penarikan'] ;
        $saldo_siswa = $up-$down;
        // dd($saldo);
        $msg = [
            'saldo_siswa'  =>  $saldo_siswa,
        ];

        echo json_encode($msg);
    }

    public function add_transaksi()
    {
        
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
            
            'siswa_id' => [
                'label' => 'Siswa',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi!',
                ]
            ],
            'jumlah_transaksi' => [
                'label' => 'Jumlah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum di isi!!',
                ]
            ],
            'tanggal_transaksi' => [
                'label' => 'Tanggal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum di isi!!',
                    ]
                ],
                
            ]);

            $id_siswa = $this->request->getVar('siswa_id');
            $jnt =  $this->request->getVar('jenis_transaksi');
            $up = (int)$this->transaksi->getSetoran($id_siswa)['total_setoran'];
            $down = (int)($this->transaksi->getTarikan($id_siswa) ==null) ? 0 : $this->transaksi->getTarikan($id_siswa)['total_penarikan'] ;
            $saldo_siswa = $up-$down;
            $jt = preg_replace("/[^0-9]/", "",$this->request->getVar('jumlah_transaksi'));
            $saldokurang = $jt > $saldo_siswa && $jnt =='tarik';
            
            if (!$valid || $saldokurang) {
                if($saldokurang){
                    $msg = [                    
                        'error' => [
                            'ss'=>$saldokurang,
                            'siswa_id'  => $validation->getError('siswa_id'),
                            'tanggal_transaksi'  => $validation->getError('tanggal_transaksi'),
                            'jumlah_transaksi'  => 'Saldo tidak cukup!',
                        ]
                    ];
                }else{
                    $msg = [                    
                        'error' => [
                            'ss'=>$saldokurang,
                            'siswa_id'  => $validation->getError('siswa_id'),
                            'tanggal_transaksi'  => $validation->getError('tanggal_transaksi'),
                            'jumlah_transaksi'  => $validation->getError('jumlah_transaksi'),
                        ]
                    ];

                }
                
            } else {
                
                $simpandata = [
                    'siswa_id'  => $this->request->getVar('siswa_id'),
                    'jumlah_transaksi'  => preg_replace("/[^0-9]/", "",$this->request->getVar('jumlah_transaksi')),
                    'jenis_transaksi'  => $this->request->getVar('jenis_transaksi'),
                    'tanggal_transaksi'  => $this->request->getVar('tanggal_transaksi'),
                    'keterangan'  => $this->request->getVar('keterangan'),
                    'petugas_id'  => session()->get('id_petugas'),
                ];
// dd($simpandata['jumlah_transaksi']);
                $this->transaksi->insert($simpandata);
                $msg = [
                    'sukses' => 'Data transaksi berhasil disimpan'
                ];
            }
            
            echo json_encode($msg);
        }
    }

    public function show($id_transaksi)
    {
        $data['transaksi'] = $this->transaksi->getTransaksi($id_transaksi);
        $id_siswa = $data['transaksi']['siswa_id'];$data['tabungan_siswa'] = $this->tabungan->getData($id_siswa);
        $data['total_penarikan'] = ($this->transaksi->getTarikan($id_siswa) ==null) ? 0 : $this->transaksi->getTarikan($id_siswa)['total_penarikan'];
        $data['total_setoran'] = ($this->transaksi->getSetoran($id_siswa) ==null) ? 0 :$this->transaksi->getSetoran($id_siswa)['total_setoran'];
        $data['saldo'] = $data['total_setoran']-$data['total_penarikan'];
        $data['siswa'] = $this->siswa->getData();
        $data['title'] = 'Edit Transaksi';
        
        return view('admin/transaksi/v_edit',$data);
    }

    /*public function update($id_transaksi)
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            
            'siswa_id' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi!',
                ]
            ],
            'jumlah_transaksi' => [
                'label' => 'Jumlah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum di isi!!',
                ]
            ],
            'tanggal_transaksi' => [
                'label' => 'Tanggal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum di isi!!',
                ]
            ],
            
        ]);
        if (!$valid) {
            set_notifikasi_swal('error', 'Gagal', 'Data gagal diubah!');
            return redirect()->to(base_url('admin/tansaksi/show/'.$id_transaksi))->withInput()->with('validation', $valid);
        } else {
            $simpandata = [
                'siswa_id'  => $this->request->getVar('siswa_id'),
                'jumlah_transaksi'  => $this->request->getVar('jumlah_transaksi'),
                'tanggal_transaksi'  => $this->request->getVar('tanggal_transaksi'),
                'keterangan'  => $this->request->getVar('keterangan'),
                'petugas_id'  => session()->get('id_petugas'),
            ];

            $this->transaksi->update($id_transaksi,$simpandata);
            set_notifikasi_swal('success', 'Berhasil', 'Data telah di ubah!');
            return redirect()->to(base_url('admin/transaksi'));
        }
    }
    */

    public function hapus($id_transaksi)
    {
        $this->transaksi->delete($id_transaksi);
    
        $msg = [
            'pesan'  => 'Transaksi telah di hapus',
        ];
        echo json_encode($msg);
    }
}