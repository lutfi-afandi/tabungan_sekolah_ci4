<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('layout/main');
    }

    public function hasil()
    {
        $nilai ='';
        $angka = $this->request->getVar('nilai_angka');
        if ($angka > 90) {
            $nilai = 'Lulus';
        }else{
            $nilai = 'Belum Lulus';
        }
        $msg = [
            'nilai' => $nilai
        ];
        
        echo json_encode($msg);
    }
}