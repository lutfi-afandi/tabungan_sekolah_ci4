<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function buatRupiah($angka){
        $hasil = "Rp. " . number_format($angka,2,',','.');
        return $hasil;
    }
    public function index()
    {
        $siswa = $this->siswa->find(session()->get('id_siswa'));
        $id_siswa = session()->get('id_siswa');
            $data['tabungan'] = $this->tabungan->getData();
            $data['total_penarikan'] = ($this->transaksi->getTarikan($id_siswa) ==null) ? 0 : $this->transaksi->getTarikan($id_siswa)['total_penarikan'];
            $data['total_setoran'] = ($this->transaksi->getSetoran($id_siswa) ==null) ? 0 :$this->transaksi->getSetoran($id_siswa)['total_setoran'];
            $data['total_saldo'] = $data['total_setoran']-$data['total_penarikan'];
            $data['tabungan_siswa'] = $this->tabungan->getData($id_siswa);
        $data['title']='Dashboard '.$siswa['nama_siswa'];
        // dd($data);
        return view('siswa/v_dashboard',$data);
    }
}