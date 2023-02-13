<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_siswa';
    protected $primaryKey       = 'id_siswa';
    protected $allowedFields    = [
        'id_siswa',
        'kelas_id',
        'nis',
        'nama_siswa',
        'jenis_kelamin',
        'alamat_siswa',
        'nama_ortu',
        'kontak',
        'username',
        'password',
        'foto_siswa',
        'status',
        'role'
    ];

    public function getData()
    {
        $query = $this->db->table($this->table)
                ->join('tb_kelas','tb_siswa.kelas_id=tb_kelas.id_kelas')
                ->get()->getResultArray();
                return $query;
    }
}