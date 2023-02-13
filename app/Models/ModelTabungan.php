<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTabungan extends Model
{
   
    protected $DBGroup          = 'default';
    protected $table            = 'tb_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $allowedFields    = ['id_transaksi',
                'tanggal_transaksi',
                'siswa_id',
                'petugas_id',
                'jenis_transaksi','jumlah_transaksi',
                'keterangan'
                ];
    public function getData($id_siswa =false){
        if($id_siswa){
$query = $this->db->table($this->table)
        ->join('tb_siswa','tb_transaksi.siswa_id=tb_siswa.id_siswa','LEFT')
        ->join('tb_petugas','tb_transaksi.petugas_id=tb_petugas.id_petugas','LEFT')
        ->join('tb_kelas','tb_siswa.kelas_id=tb_kelas.id_kelas','LEFT')
        ->where('siswa_id',$id_siswa)
        ->orderBy('tanggal_transaksi','DESC')
        ->orderBy('id_transaksi','DESC')
        ->get()->getResultArray();
        }else{
            $query = $this->db->table($this->table)
            ->join('tb_siswa','tb_transaksi.siswa_id=tb_siswa.id_siswa','LEFT')
            ->join('tb_petugas','tb_transaksi.petugas_id=tb_petugas.id_petugas','LEFT')
            ->join('tb_kelas','tb_siswa.kelas_id=tb_kelas.id_kelas','LEFT')
            ->orderBy('tanggal_transaksi','DESC')
            ->orderBy('id_transaksi','DESC')
            ->get()->getResultArray();
        }
        
        return $query;
    }

}