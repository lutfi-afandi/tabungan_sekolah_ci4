<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPetugas extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_petugas';
    protected $primaryKey       = 'id_petugas';
    protected $allowedFields    = ['id','nip','nama_petugas','jk_petugas','alamat_petugas','kontak','username','password','foto_petugas','status','role'];
}