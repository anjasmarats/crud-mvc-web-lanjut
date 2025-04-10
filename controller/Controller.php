<?php

include("./models/Proyek.php");

class Controller {
    public function create($nama_proyek,$jenis_proyek){
        try {
            if(!$nama_proyek||!$jenis_proyek){
                return "data tidak lengkap";
            }

            $proyek = new Proyek;
            $proyek->setNamaProyek($nama_proyek);
            $proyek->setJenisProyek($jenis_proyek);
            $database = $proyek->connect();
            return $database->query("insert into proyek_table(nama_proyek,jenis_proyek) values ('".mysqli_real_escape_string($database,$proyek->getNamaProyek())."','".$proyek->getJenisProyek()."')");
        } catch(\Exception $e) {
            return "error create = ".$e->getMessage();
        }
    }

    public function read(){
        try {
            $proyek = new Proyek;
            $database = $proyek->connect();
            return $database->query("select * from proyek_table");
        } catch(\Exception $e) {
            return "error read = ".$e->getMessage();
        }
    }

    public function findByNameOrType($data){
        try {
            $proyek = new Proyek;
            $database = $proyek->connect();
            return $data?$database->query("select * from proyek_table where nama_proyek like '%".
            mysqli_real_escape_string($database,strtolower($data)).
            "%' || '%".
            mysqli_real_escape_string($database,$data).
            "%' || jenis_proyek like '%".
            mysqli_real_escape_string($database,strtolower($data)).
            "%' ||'%".
            mysqli_real_escape_string($database,$data)."%'"):$database->query("select * from proyek_table");
        } catch(\Exception $e) {
            return "error findByNameOrType = ".$e->getMessage();
        }
    }

    public function update($id_proyek,$nama_proyek,$jenis_proyek){
        try {
            if(!$id_proyek||!$nama_proyek||!$jenis_proyek){
                return "data tidak lengkap";
            }
            $proyek = new Proyek;
            $database = $proyek->connect();
            $proyek->setNamaProyek($nama_proyek);
            $proyek->setJenisProyek($jenis_proyek);
            return $database->query("update proyek_table set nama_proyek = '".mysqli_real_escape_string($database,$proyek->getNamaProyek())."', jenis_proyek = '".mysqli_real_escape_string($database,$proyek->getJenisProyek())."' where id_proyek = ".mysqli_real_escape_string($database,$id_proyek));
        } catch(\Exception $e) {
            return "error update = ".$e->getMessage();
        }
    }

    public function delete($id_proyek){
        try {
            if(!$id_proyek){
                return "data tidak lengkap";
            }

            $proyek = new Proyek;
            $database = $proyek->connect();
            return $database->query("delete from proyek_table where id_proyek = ".mysqli_real_escape_string($database,$id_proyek));
        } catch(\Exception $e) {
            return "error delete = ".$e->getMessage();
        }
    }
}