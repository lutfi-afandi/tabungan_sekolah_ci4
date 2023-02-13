<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        $data['title'] = 'Laporan Tabungan Siswa';
        $data['siswa'] = $this->siswa->getData();
        
        return view('admin/laporan/v_index',$data);
    }

    public function cetak($tg_awal,$tg_akhir)
    {
        $data['title'] = 'Laporan';
        $data['laporan'] = $this->laporan->getAll($tg_awal,$tg_akhir);
        $data['tanggal_awal'] = $tg_awal;
        $data['tanggal_akhir'] = $tg_akhir;
        $data['total_setoran'] = $this->laporan->setoranPer($tg_awal,$tg_akhir)['total'];
        $data['total_penarikan'] = $this->laporan->penarikanPer($tg_awal,$tg_akhir)['total'];
        $data['saldo'] = $data['total_setoran'] - $data['total_penarikan'];
        // dd($data);
        return view('admin/laporan/v_print',$data);
    }
}