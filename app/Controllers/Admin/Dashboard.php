<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function buatRupiah($angka){
        $hasil = "Rp. " . number_format($angka,2,',','.');
        return $hasil;
    }
    public function index()
    {
        if (session()->get('role')=='1') {
            $role = 'Admin';
        }else{
            $role = 'Petugas';
        }
            $data['tabungan'] = $this->tabungan->getData();
            $data['total_penarikan'] = ($this->transaksi->getTarikan() ==null) ? 0 : $this->transaksi->getTarikan()['total_penarikan'];
            $data['total_setoran'] = ($this->transaksi->getSetoran() ==null) ? 0 :$this->transaksi->getSetoran()['total_setoran'];
            $data['total_saldo'] = $data['total_setoran']-$data['total_penarikan'];
            $data['total_siswa'] = $this->siswa->countAll();
        $data['title']='Dashboard '.$role;
        // dd($data);
        return view('admin/v_dashboard',$data);
    }
}