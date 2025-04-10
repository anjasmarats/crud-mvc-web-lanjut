<?php

include("DBConnection.php");

class Proyek extends DBConnection {
    private $nama_proyek,$jenis_proyek;

    public function connect(): mysqli{
        return $this->db_connection();
    }

    public function setNamaProyek($namaproyek){
        $this->nama_proyek = $namaproyek;
    }

    public function setJenisProyek($jenisproyek){
        $this->jenis_proyek = $jenisproyek;
    }

    public function getNamaProyek(): string{
        return $this->nama_proyek;
    }

    public function getJenisProyek(): string{
        return $this->jenis_proyek;
    }
}