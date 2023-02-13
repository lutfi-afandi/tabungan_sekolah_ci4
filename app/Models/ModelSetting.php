<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSetting extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_setting';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','nama_sekolah','tahun_pelajaran','semester','status','logo_sekolah'];
}