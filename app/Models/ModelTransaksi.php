<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
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

    public function getData(){
            $query = $this->db->table($this->table)
            ->join('tb_siswa','tb_transaksi.siswa_id=tb_siswa.id_siswa','LEFT')
            ->join('tb_petugas','tb_transaksi.petugas_id=tb_petugas.id_petugas','LEFT')
            ->join('tb_kelas','tb_siswa.kelas_id=tb_kelas.id_kelas','LEFT')
            ->orderBy('tanggal_transaksi','DESC')
            ->orderBy('id_transaksi','DESC')
            ->get()->getResultArray();
            return $query;
    } 
    public function getTransaksi($id_transaksi){
            $query = $this->db->table($this->table)
            ->join('tb_siswa','tb_transaksi.siswa_id=tb_siswa.id_siswa','LEFT')
            ->join('tb_petugas','tb_transaksi.petugas_id=tb_petugas.id_petugas','LEFT')
            ->join('tb_kelas','tb_siswa.kelas_id=tb_kelas.id_kelas','LEFT')
            ->where('id_transaksi',$id_transaksi)
            ->get()->getRowArray();
            return $query;
    } 

    public function getSetoran($siswa_id = false){
        if($siswa_id){
            $query = $this->db->table($this->table)->select('SUM(jumlah_transaksi) AS total_setoran')
            ->where('jenis_transaksi','setor')
            ->where('siswa_id',$siswa_id)
            ->get()->getRowArray();
            return $query;
        }else{
            $query = $this->db->table($this->table)->select('SUM(jumlah_transaksi) AS total_setoran')
            ->where('jenis_transaksi','setor')
            ->get()->getRowArray();
            return $query;
        }
    }
                                    
    public function getTarikan($siswa_id = false){
        if($siswa_id){
            $query = $this->db->table($this->table)->select('SUM(jumlah_transaksi) AS total_penarikan')
            ->where('jenis_transaksi','tarik')
            ->where('siswa_id',$siswa_id)
            ->get()->getRowArray();
            return $query;
        }else{
            $query = $this->db->table($this->table)->select('SUM(jumlah_transaksi) AS total_penarikan')
            ->where('jenis_transaksi','tarik')
            ->get()->getRowArray();
            return $query;
        }
    }
    
    

}