<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Tabungan extends BaseController
{
    public function index()
    {
        $data['title'] = 'Tabungan';
        $data['siswa'] = $this->siswa->getData();
        
        return view('admin/tabungan/v_index',$data);
    }

    public function search($id_siswa)
    {
        $siswa = $this->siswa->find($id_siswa);
        $data['title'] = 'Tabungan '.$siswa['nama_siswa'];
        $data['id_siswa'] = $id_siswa;
        $data['tabungan_siswa'] = $this->tabungan->getData($id_siswa);
        $data['total_penarikan'] = ($this->transaksi->getTarikan($id_siswa) ==null) ? 0 : $this->transaksi->getTarikan($id_siswa)['total_penarikan'];
        $data['total_setoran'] = ($this->transaksi->getSetoran($id_siswa) ==null) ? 0 :$this->transaksi->getSetoran($id_siswa)['total_setoran'];
        $data['total_saldo'] = $data['total_setoran']-$data['total_penarikan'];
        // dd($data);
        return view('admin/tabungan/v_hasil',$data);
    }
    function buatRupiah($angka){
        $hasil = "Rp. " . number_format($angka,2,',','.');
        return $hasil;
    }

    public function print($id_siswa)
    {
        $data['title'] = 'Cetak Tabungan';
        $data['id_siswa'] = $id_siswa;
        $data['siswa'] = $this->siswa->find($id_siswa);
        $data['tabungan_siswa'] = $this->tabungan->getData($id_siswa);
        $data['total_penarikan'] = ($this->transaksi->getTarikan($id_siswa) ==null) ? 0 : $this->transaksi->getTarikan($id_siswa)['total_penarikan'];
        $data['total_setoran'] = ($this->transaksi->getSetoran($id_siswa) ==null) ? 0 :$this->transaksi->getSetoran($id_siswa)['total_setoran'];
        $data['total_saldo'] = $data['total_setoran']-$data['total_penarikan'];
        // dd($data);
        return view('admin/tabungan/v_print',$data);
    }

    // function print($id_siswa){
    //     $dompdf = new \Dompdf\Dompdf();
    //     $data = $this->tabungan->getData($id_siswa);
 
    //     $dompdf->loadHtml(view('admin/tabungan/v_print', ["tabungan_siswa" => $data]));
    //     $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
    //     $dompdf->render();
    //     $dompdf->stream("laporan-tabungan"); //nama file pdf
 
    //     return redirect()->to(base_url('admin/tabungan/search/'.$id_siswa)); //arahkan ke list-iklan setelah laporan di unduh
    // }
}