<?php

namespace App\Controllers\Siswa;
use Dompdf\Dompdf;

use App\Controllers\BaseController;
use Dompdf\Options;

class Cetak extends BaseController
{
    public function index()
    {
        $id_siswa = session()->get('id_siswa');
        $data['siswa'] = $this->siswa->find(session()->get('id_siswa'));
        $data['title'] = 'Laporan';
        $data['total_penarikan'] = ($this->transaksi->getTarikan($id_siswa) ==null) ? 0 : $this->transaksi->getTarikan($id_siswa)['total_penarikan'];
        $data['total_setoran'] = ($this->transaksi->getSetoran($id_siswa) ==null) ? 0 :$this->transaksi->getSetoran($id_siswa)['total_setoran'];
        $data['total_saldo'] = $data['total_setoran']-$data['total_penarikan'];
        $data['tabungan_siswa'] = $this->tabungan->getData($id_siswa);
        // dd($data);
        
        
        return view('siswa/v_print',$data);
        
    }

    public function download()
    { 
        $id_siswa = session()->get('id_siswa');
        $data['siswa'] = $this->siswa->find(session()->get('id_siswa'));
        $data['title'] = 'Laporan';
        $data['total_penarikan'] = ($this->transaksi->getTarikan($id_siswa) ==null) ? 0 : $this->transaksi->getTarikan($id_siswa)['total_penarikan'];
        $data['total_setoran'] = ($this->transaksi->getSetoran($id_siswa) ==null) ? 0 :$this->transaksi->getSetoran($id_siswa)['total_setoran'];
        $data['total_saldo'] = $data['total_setoran']-$data['total_penarikan'];
        $data['tabungan_siswa'] = $this->tabungan->getData($id_siswa);
        // dd($data);
        
        $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';
        // instantiate and use the dompdf class
        $options = new Options(); 
        $dompdf = new Dompdf();
        // $dompdf->getOptions()->getChroot();
        // load HTML content
        $dompdf->loadHtml(view('siswa/v_print',$data));
        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        // render html as PDF
        $dompdf->render();
        // output the generated pdf
        $dompdf->stream($filename);
    }
}