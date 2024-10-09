<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_m extends CI_Model {

    function get_ListKecamatan() {
        $Sql = $this->db->query("select id_kecamatan, nama_kecamatan from m_kecamatan");
        return $Sql;
    }

    function get_ListKekerasan() {
        $Sql = $this->db->query("select id_kekerasan, nama_kekerasan from m_kekerasan");
        return $Sql;
    }

    function get_ListRiwayat($id_user = "") {
        $Sql = $this->db->query("select a.*, b.nama_penduduk, b.alamat as alamat_user, c.nama_kecamatan as nama_kecamatan_user, d.nama_kelurahan as nama_kelurahan_user, e.nama_kecamatan as nama_kecamatan_laporan, f.nama_kelurahan as nama_kelurahan_laporan, h.nama_kekerasan, g.nama_jenis_user from t_kejadian a 
                                left join m_penduduk b on a.id_penduduk=b.id_penduduk
                                left join m_kecamatan c on b.id_kecamatan=c.id_kecamatan
                                left join m_kelurahan d on b.id_kelurahan=d.id_kelurahan
                                left join m_kecamatan e on a.id_kecamatan=e.id_kecamatan
                                left join m_kelurahan f on a.id_kelurahan=f.id_kelurahan
                                left join m_jenis_user g on a.id_jenis_user=g.id_jenis_user
                                left join m_kekerasan h on a.id_kekerasan=h.id_kekerasan
                                where a.id_penduduk=" . $id_user . " order by id_kejadian desc");
        return $Sql;
    }

    function get_ListKejadian() {
        $Sql = $this->db->query("select a.*, b.nama_penduduk, b.alamat as alamat_user, c.nama_kecamatan as nama_kecamatan_user, d.nama_kelurahan as nama_kelurahan_user, e.nama_kecamatan as nama_kecamatan_laporan, f.nama_kelurahan as nama_kelurahan_laporan, h.nama_kekerasan, g.nama_jenis_user from t_kejadian a 
                                left join m_penduduk b on a.id_penduduk=b.id_penduduk
                                left join m_kecamatan c on b.id_kecamatan=c.id_kecamatan
                                left join m_kelurahan d on b.id_kelurahan=d.id_kelurahan
                                left join m_kecamatan e on a.id_kecamatan=e.id_kecamatan
                                left join m_kelurahan f on a.id_kelurahan=f.id_kelurahan
                                left join m_jenis_user g on a.id_jenis_user=g.id_jenis_user
                                left join m_kekerasan h on a.id_kekerasan=h.id_kekerasan
                                where a.cb_privasi=false order by id_kejadian desc");
        return $Sql;
    }

    function get_ListLaporan($id_penanganan = "", $nama_jabatan = "") {
        $Query = "select a.*, b.nama_penduduk, b.alamat as alamat_user, c.nama_kecamatan as nama_kecamatan_user, d.nama_kelurahan as nama_kelurahan_user, e.nama_kecamatan as nama_kecamatan_laporan, f.nama_kelurahan as nama_kelurahan_laporan, h.nama_kekerasan, g.nama_jenis_user from t_kejadian a 
                left join m_penduduk b on a.id_penduduk=b.id_penduduk
                left join m_kecamatan c on b.id_kecamatan=c.id_kecamatan
                left join m_kelurahan d on b.id_kelurahan=d.id_kelurahan
                left join m_kecamatan e on a.id_kecamatan=e.id_kecamatan
                left join m_kelurahan f on a.id_kelurahan=f.id_kelurahan
                left join m_jenis_user g on a.id_jenis_user=g.id_jenis_user
                left join m_kekerasan h on a.id_kekerasan=h.id_kekerasan
                where ";
        if($nama_jabatan == "Petugas") {
            $Query .= " a.id_petugas is null";
        } else {
            $Query .= " a.st_kejadian=true and a.st_penyelesaian_ext=false and a.id_penanganan=" . $id_penanganan;
        }
        $Query .= " order by id_kejadian desc";
        $Sql = $this->db->query($Query);
        return $Sql;
    }

    function get_ListKejadianFalse() {
        $Sql = $this->db->query("select a.tgl_kejadian, a.narasi, a.penyelesaian, b.nik, b.nama_penduduk, c.nama_petugas, d.nama_jenis_user, e.nama_kekerasan
                                from t_kejadian a
                                left join m_penduduk b on a.id_penduduk=b.id_penduduk
                                left join m_petugas c on a.id_petugas=c.id_petugas
                                left join m_jenis_user d on a.id_jenis_user=d.id_jenis_user
                                left join m_kekerasan e on a.id_kekerasan=e.id_kekerasan
                                where a.st_kejadian=false");
        return $Sql;
    }

    function get_ListJenisUser() {
        $Sql = $this->db->query("select id_jenis_user, nama_jenis_user from m_jenis_user");
        return $Sql;
    }

    function get_ListJenisPenanganan() {
        $Sql = $this->db->query("select id_penanganan, nama_penanganan from m_penanganan");
        return $Sql;
    }

    function get_ListKelurahan($id_kecamatan = "") {
        $Sql = $this->db->query("select id_kelurahan, nama_kelurahan from m_kelurahan where id_kecamatan=" . $id_kecamatan);
        return $Sql;
    }

    function ChekData($nik = "") {
        $this->db->where("nik", $nik);
        $query = $this->db->get("m_penduduk");
        return $query->num_rows();
    }

    function insertPenduduk($nik = "", $nama_penduduk = "", $tempat_lahir = "", $tgl_lahir = "", $alamat = "", $id_kecamatan = "", $id_kelurahan = "", $nohp = "", $passwd = "") {
        $data = array(
            "nik" => $nik,
            "nama_penduduk" => $nama_penduduk,
            "tempat_lahir" => $tempat_lahir,
            "tgl_lahir" => date_format(date_create($tgl_lahir), 'Y-m-d'),
            "alamat" => $alamat,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan,
            "nohp" => $nohp,
            "passwd" => md5($passwd)
        );
        $this->db->insert("m_penduduk", $data);
    }

    function insertButtonPanic($id_penduduk = "", $lng = "", $lat = "") {
        $data = array(
            "id_penduduk" => $id_penduduk,
            "lng" => $lng,
            "lat" => $lat
        );
        $this->db->insert("t_kejadian", $data);
    }

    function insertLaporanKekerasan($id_penduduk = "", $id_jenis_user = "", $id_kekerasan = "", $id_kecamatan = "", $id_kelurahan = "", $narasi = "", $alamat = "", $cb_privasi = "", $tgl_kejadian = "") {
        $data = array(
            "id_penduduk" => $id_penduduk,
            "id_jenis_user" => $id_jenis_user,
            "id_kekerasan" => $id_kekerasan,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan,
            "narasi" => $narasi,
            "alamat" =>$alamat,
            "tgl_kejadian" => date_format(date_create($tgl_kejadian), 'Y-m-d')
        );

        if ($cb_privasi == "true") {
            $data["cb_privasi"] = true;
        }

        $this->db->insert("t_kejadian", $data);
    }

    function updateLaporanKekerasanKordinat($id_kejadian = "", $id_jenis_user = "", $id_kekerasan = "", $id_kecamatan = "", $id_kelurahan = "", $narasi = "", $alamat = "", $penyelesaian = "", $tgl_kejadian = "", $id_penanganan = "") {
        $data = array(
            "penyelesaian" => $penyelesaian,
            "id_jenis_user" => $id_jenis_user,
            "id_kekerasan" => $id_kekerasan,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan,
            "narasi" => $narasi,
            "alamat" =>$alamat,
            "tgl_kejadian" => date_format(date_create($tgl_kejadian), 'Y-m-d'),
            "st_kejadian" => true,
            "id_penanganan" => $id_penanganan
        );

        $this->db->where("id_kejadian", $id_kejadian);
        $this->db->update("t_kejadian", $data);
    }

    function updateLaporanKekerasanNoKordinat($id_kejadian = "", $penyelesaian = "", $id_penanganan = "") {
        $data = array(
            "penyelesaian" => $penyelesaian,
            "st_kejadian" => true,
            "id_penanganan" => $id_penanganan
        );

        $this->db->where("id_kejadian", $id_kejadian);
        $this->db->update("t_kejadian", $data);
    }

    function update_LaporanPenyelesaianExternal($id_kejadian = "", $penyelesaian = "") {
        $data = array(
            "penyelesaian_ext" => $penyelesaian,
            "st_penyelesaian_ext" => true
        );

        $this->db->where("id_kejadian", $id_kejadian);
        $this->db->update("t_kejadian", $data);
    }

    function updateTanggapan($id_kejadian = "", $id_petugas = "") {
        $data = array(
            "id_petugas" => $id_petugas
        );
        $this->db->where("id_kejadian", $id_kejadian);
        $this->db->update("t_kejadian", $data);
    }

    function updateHasilKejadian($id_kejadian = "", $penyelesaian = "") {
        $data = array(
            "penyelesaian" => $penyelesaian,
            "st_kejadian" => TRUE
        );
        $this->db->where("id_kejadian", $id_kejadian);
        $this->db->update("t_kejadian", $data);
    }

    function CekPenduduk($username = "") {
        $Sql = $this->db->query("select * from m_penduduk where nik='" . $username . "'");
        return $Sql->num_rows();
    }

    function getDataPenduduk($username = "", $passwd = "") {
        $Sql = $this->db->query("select a.*, b.nama_kecamatan, c.nama_kelurahan from m_penduduk a 
                                left join m_kecamatan b on a.id_kecamatan=b.id_kecamatan
                                left join m_kelurahan c on a.id_kelurahan=c.id_kelurahan
                                where nik='" . $username . "' and passwd='" . md5($passwd) . "'");
        return $Sql;
    }

    function CekPetugas($username = "") {
        $Sql = $this->db->query("select * from m_petugas where username='" . $username . "'");
        return $Sql->num_rows();
    }

    function getNamaJabatan($id_jabatan = "") {
        $Sql = $this->db->query("select * from m_jabatan where id_jabatan=" . $id_jabatan);
        return $Sql->row();
    }

    function getDataPetugas($username = "", $passwd = "") {
        $Sql = $this->db->query("select * from m_petugas
                                where username='" . $username . "' and passwd='" . md5($passwd) . "'");
        return $Sql;
    }

    function get_Booking($id_kejadian = "", $id_user = "") {
        $data = array(
            "id_petugas" => $id_user
        );
        $this->db->where("id_kejadian", $id_kejadian);
        $this->db->update("t_kejadian", $data);
    }

    function get_Listpenyelesaian($id_user = "") {
        $Sql = $this->db->query("select a.*, b.nama_penduduk, b.alamat as alamat_user, c.nama_kecamatan as nama_kecamatan_user, d.nama_kelurahan as nama_kelurahan_user, e.nama_kecamatan as nama_kecamatan_laporan, f.nama_kelurahan as nama_kelurahan_laporan, h.nama_kekerasan, g.nama_jenis_user from t_kejadian a 
                                left join m_penduduk b on a.id_penduduk=b.id_penduduk
                                left join m_kecamatan c on b.id_kecamatan=c.id_kecamatan
                                left join m_kelurahan d on b.id_kelurahan=d.id_kelurahan
                                left join m_kecamatan e on a.id_kecamatan=e.id_kecamatan
                                left join m_kelurahan f on a.id_kelurahan=f.id_kelurahan
                                left join m_jenis_user g on a.id_jenis_user=g.id_jenis_user
                                left join m_kekerasan h on a.id_kekerasan=h.id_kekerasan
                                where a.id_petugas=" . $id_user . " and st_kejadian=false order by id_kejadian desc");
        return $Sql;
    }

    function get_ListRiwayatPetugas($id_user = "", $id_penanganan = "", $nama_jabatan = "") {
        $query = "select a.*, b.nama_penduduk, b.alamat as alamat_user, c.nama_kecamatan as nama_kecamatan_user, d.nama_kelurahan as nama_kelurahan_user, e.nama_kecamatan as nama_kecamatan_laporan, f.nama_kelurahan as nama_kelurahan_laporan, h.nama_kekerasan, g.nama_jenis_user from t_kejadian a 
            left join m_penduduk b on a.id_penduduk=b.id_penduduk
            left join m_kecamatan c on b.id_kecamatan=c.id_kecamatan
            left join m_kelurahan d on b.id_kelurahan=d.id_kelurahan
            left join m_kecamatan e on a.id_kecamatan=e.id_kecamatan
            left join m_kelurahan f on a.id_kelurahan=f.id_kelurahan
            left join m_jenis_user g on a.id_jenis_user=g.id_jenis_user
            left join m_kekerasan h on a.id_kekerasan=h.id_kekerasan";
        if($id_penanganan != "") {
            $query .= " where a.id_penanganan=" . $id_penanganan;
        } else {
            $query .= " where a.id_petugas=" . $id_user;
        }

        if($nama_jabatan != "Petugas") {
            $query .= " and a.st_penyelesaian_ext=true";
        }
        $query .= " and st_kejadian=true order by id_kejadian desc";
        $Sql = $this->db->query($query);
        return $Sql;
    }

}
