<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function login_admin($username, $password)
    {
        return $this->db->table('tb_user')->where([
            'username' => $username,
            'password'  => $password,
            'role'     => '1'
        ])->get()->getRowArray();
    }

    public function login_petugas($username, $password)
    {
        return $this->db->table('tb_petugas')->where([
            'username' => $username,
            'password'  => $password,
            'role'     => '2'
        ])->get()->getRowArray();
    }

    public function login_siswa($username, $password)
    {
        return $this->db->table('tb_siswa')->where([
            'username' => $username,
            'password'  => $password,
            'role'     => '3'
        ])->get()->getRowArray();
    }
    
}