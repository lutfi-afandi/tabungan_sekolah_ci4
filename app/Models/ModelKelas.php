<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelas extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_kelas';
    protected $primaryKey       = 'id_kelas';
    protected $allowedFields    = ['id_kelas','nama_kelas'];
}