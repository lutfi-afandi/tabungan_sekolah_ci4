<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    public function getAll($tg_awal, $tg_akhir){
        $query = $this->db->query("SELECT	id_transaksi,
        tanggal_transaksi,
            nis, nama_siswa,
            nama_kelas,
            jenis_transaksi,
            jumlah_transaksi,
            nama_petugas,
            keterangan
        FROM 
        tb_siswa AS sis
        LEFT JOIN tb_kelas AS kel ON sis.kelas_id = kel.id_kelas
        LEFT JOIN tb_transaksi AS tran ON sis.id_siswa=tran.siswa_id
        LEFT JOIN tb_petugas AS ptg ON tran.petugas_id=ptg.id_petugas
        WHERE tanggal_transaksi BETWEEN '$tg_awal' AND '$tg_akhir'
        ORDER BY tanggal_transaksi ASC , id_transaksi ASC")->getResultArray();
        return $query;
    }

    public function setoranPer($tg_awal, $tg_akhir){
        $query = $this->db->query("SELECT SUM(jumlah_transaksi) AS total
        FROM 
        tb_siswa AS sis
        LEFT JOIN tb_kelas AS kel ON sis.kelas_id = kel.id_kelas
        LEFT JOIN tb_transaksi AS tran ON sis.id_siswa=tran.siswa_id
        LEFT JOIN tb_petugas AS ptg ON tran.petugas_id=ptg.id_petugas
        WHERE tanggal_transaksi BETWEEN '$tg_awal' AND '$tg_akhir'
        AND jenis_transaksi = 'setor'")->getRowArray();
        return $query;
    }
    public function penarikanPer($tg_awal, $tg_akhir){
        $query = $this->db->query("SELECT SUM(jumlah_transaksi) AS total
        FROM 
        tb_siswa AS sis
        LEFT JOIN tb_kelas AS kel ON sis.kelas_id = kel.id_kelas
        LEFT JOIN tb_transaksi AS tran ON sis.id_siswa=tran.siswa_id
        LEFT JOIN tb_petugas AS ptg ON tran.petugas_id=ptg.id_petugas
        WHERE tanggal_transaksi BETWEEN '$tg_awal' AND '$tg_akhir'
        AND jenis_transaksi = 'tarik'")->getRowArray();
        return $query;
    }
}