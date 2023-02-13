<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_user';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','nama_user','username','password','role'];

}