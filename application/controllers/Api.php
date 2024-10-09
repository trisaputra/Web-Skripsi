<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Api_m');
    }

    function get_ListKecamatan() {
        $Fields = $this->Api_m->get_ListKecamatan();

        $return["success"] = "TRUE";
        $return["pesan"] = "Get List Kecamatan Berhasil.";
        $return["data"] = $Fields->result();

        echo json_encode($return);
    }

    function get_ListKekerasan() {
        $Fields = $this->Api_m->get_ListKekerasan();

        $return["success"] = TRUE;
        $return["pesan"] = "Get List Kekerasan Berhasil.";
        $return["data"] = $Fields->result();

        echo json_encode($return);
    }

    function get_ListKejadian() {
        $Sql = $this->Api_m->get_ListKejadian();

        if($Sql->num_rows() > 0) {
        	foreach ($Sql->result() as $Fields) {

        		if($Fields->lng != "") {
        			$alamat = $Fields->alamat_user;
        			$nama_kecamatan = $Fields->nama_kecamatan_laporan;
        			$nama_kelurahan = $Fields->nama_kelurahan_laporan;
        		} else {
        			$alamat = $Fields->alamat;
        			$nama_kecamatan = $Fields->nama_kecamatan_user;
        			$nama_kelurahan = $Fields->nama_kelurahan_user;
        		}

        		$hasil[] = array(
        			"id_kejadian" => $Fields->id_kejadian,
        			"tgl_kejadian" => date_format(date_create($Fields->tgl_kejadian), "d-m-Y"),
        			"nama_penduduk" => $Fields->nama_penduduk,
        			"alamat" => $alamat,
        			"nama_kecamatan" => $nama_kecamatan,
        			"nama_kelurahan" => $nama_kelurahan,
        			"nama_jenis_user" => $Fields->nama_jenis_user,
        			"nama_kekerasan" => $Fields->nama_kekerasan,
        			"narasi" => $Fields->narasi
        		);
        	}

	        $return["success"] = "TRUE";
	        $return["pesan"] = "Data ditemukan.";
	        $return["data"] = $hasil;
        } else {
			$return["success"] = "FALSE";
	        $return["pesan"] = "Tidak ada data.";
        }


        echo json_encode($return);
    }

    function get_ListRiwayat() {
        $id_user = ($this->input->post("id_user") != "") ? $this->input->post("id_user") : "";
        $Sql = $this->Api_m->get_ListRiwayat($id_user);

        if($Sql->num_rows() > 0) {
        	foreach ($Sql->result() as $Fields) {

        		if($Fields->lng != "") {
        			$alamat = $Fields->alamat_user;
        			$nama_kecamatan = $Fields->nama_kecamatan_laporan;
        			$nama_kelurahan = $Fields->nama_kelurahan_laporan;
        		} else {
        			$alamat = $Fields->alamat;
        			$nama_kecamatan = $Fields->nama_kecamatan_user;
        			$nama_kelurahan = $Fields->nama_kelurahan_user;
        		}

        		$hasil[] = array(
        			"id_kejadian" => $Fields->id_kejadian,
        			"tgl_kejadian" => date_format(date_create($Fields->tgl_kejadian), "d-m-Y"),
        			"nama_penduduk" => $Fields->nama_penduduk,
        			"alamat" => $alamat,
        			"nama_kecamatan" => $nama_kecamatan,
        			"nama_kelurahan" => $nama_kelurahan,
        			"nama_jenis_user" => $Fields->nama_jenis_user,
        			"nama_kekerasan" => $Fields->nama_kekerasan,
        			"narasi" => $Fields->narasi
        		);
        	}

	        $return["success"] = "TRUE";
	        $return["pesan"] = "Data ditemukan.";
	        $return["data"] = $hasil;
        } else {
			$return["success"] = "FALSE";
	        $return["pesan"] = "Tidak ada data.";
        }


        echo json_encode($return);
    }

    function get_ListLaporan() {
        $id_penanganan = ($this->input->post("id_penanganan") != "") ? $this->input->post("id_penanganan") : "";
        $nama_jabatan = ($this->input->post("nama_jabatan") != "") ? $this->input->post("nama_jabatan") : "";
        $Sql = $this->Api_m->get_ListLaporan($id_penanganan, $nama_jabatan);

        if($Sql->num_rows() > 0) {
        	foreach ($Sql->result() as $Fields) {

        		if($Fields->lng != "") {
        			$alamat = $Fields->alamat_user;
        			$nama_kecamatan = $Fields->nama_kecamatan_laporan;
        			$nama_kelurahan = $Fields->nama_kelurahan_laporan;
        		} else {
        			$alamat = $Fields->alamat;
        			$nama_kecamatan = $Fields->nama_kecamatan_user;
        			$nama_kelurahan = $Fields->nama_kelurahan_user;
        		}

        		$hasil[] = array(
        			"id_kejadian" => $Fields->id_kejadian,
        			"tgl_kejadian" => date_format(date_create($Fields->tgl_kejadian), "d-m-Y"),
        			"nama_penduduk" => $Fields->nama_penduduk,
        			"alamat" => $alamat,
        			"nama_kecamatan" => $nama_kecamatan,
        			"nama_kelurahan" => $nama_kelurahan,
        			"nama_jenis_user" => $Fields->nama_jenis_user,
        			"nama_kekerasan" => $Fields->nama_kekerasan,
        			"narasi" => $Fields->narasi,
        			"id_jenis_user" => $Fields->id_jenis_user,
        			"id_kekerasan" => $Fields->id_kekerasan,
        			"id_kecamatan" => $Fields->id_kecamatan,
        			"id_kelurahan" => $Fields->id_kelurahan,
        			"cb_privasi" => $Fields->cb_privasi,
        			"penyelesaian" => $Fields->penyelesaian,
        			"lat" => $Fields->lat,
        			"lng" => $Fields->lng
        		);
        	}

	        $return["success"] = "TRUE";
	        $return["msgServer"] = "Data ditemukan.";
	        $return["data"] = $hasil;
        } else {
			$return["success"] = "FALSE";
	        $return["msgServer"] = "Tidak ada data.";
        }


        echo json_encode($return);
    }

    function get_ListJenisUser() {
        $Fields = $this->Api_m->get_ListJenisUser();

        $return["success"] = TRUE;
        $return["pesan"] = "Get List Jenis User Berhasil.";
        $return["data"] = $Fields->result();

        echo json_encode($return);
    }

    function get_ListJenisPenanganan() {
        $Fields = $this->Api_m->get_ListJenisPenanganan();

        $return["success"] = TRUE;
        $return["pesan"] = "Get List Jenis Penanganan Berhasil.";
        $return["data"] = $Fields->result();

        echo json_encode($return);
    }

    function get_ListKelurahan() {
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $Fields = $this->Api_m->get_ListKelurahan($id_kecamatan);

        $return["success"] = "TRUE";
        $return["pesan"] = "Get List Kelurahan Berhasil.";
        $return["data"] = $Fields->result();

        echo json_encode($return);
    }

    function getBooking() {
        $id_kejadian = ($this->input->post("id_kejadian") != "") ? $this->input->post("id_kejadian") : "";
        $id_user = ($this->input->post("id_user") != "") ? $this->input->post("id_user") : "";
        $Fields = $this->Api_m->get_Booking($id_kejadian, $id_user);

        $return["success"] = "TRUE";
        $return["pesan"] = "Simpan tanggapi kejadian berhasil.";

        echo json_encode($return);
    }

    function create_penduduk() {
        $nik = ($this->input->post("nik") != "") ? $this->input->post("nik") : "";
        $nama_penduduk = ($this->input->post("nama_penduduk") != "") ? $this->input->post("nama_penduduk") : "";
        $tempat_lahir = ($this->input->post("tempat_lahir") != "") ? $this->input->post("tempat_lahir") : "";
        $tgl_lahir = ($this->input->post("tgl_lahir") != "") ? $this->input->post("tgl_lahir") : "";
        $alamat = ($this->input->post("alamat") != "") ? $this->input->post("alamat") : "";
        $passwd = ($this->input->post("passwd") != "") ? $this->input->post("passwd") : "";
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : "";
        $nohp = ($this->input->post("nohp") != "") ? $this->input->post("nohp") : "";

        if ($this->Api_m->ChekData($nik) == 0) {
            $this->Api_m->insertPenduduk($nik, $nama_penduduk, $tempat_lahir, $tgl_lahir, $alamat, $id_kecamatan, $id_kelurahan, $nohp, $passwd);
            $return["success"] = "TRUE";
            $return["pesan"] = "Daftar Penduduk Berhasil.";
        } else {
            $return["success"] = "FALSE";
            $return["pesan"] = "NIK Sudah Terdaftar..!!!";
        }

        echo json_encode($return);
    }

    function create_ButtonPanic() {
        $id_penduduk = ($this->input->post("id_penduduk") != "") ? $this->input->post("id_penduduk") : "";
        $lng = ($this->input->post("lng") != "") ? $this->input->post("lng") : 0.0;
        $lat = ($this->input->post("lat") != "") ? $this->input->post("lat") : 0.0;

        $this->Api_m->insertButtonPanic($id_penduduk, $lng, $lat);
        $return["success"] = TRUE;
        $return["pesan"] = "Simpan Panic Button Berhasil.";

        echo json_encode($return);
    }

    function create_LaporanKekerasan() {
        $id_penduduk = ($this->input->post("id_penduduk") != "") ? $this->input->post("id_penduduk") : "";
        $id_jenis_user = ($this->input->post("id_jenis_user") != "") ? $this->input->post("id_jenis_user") : 0;
        $id_kekerasan = ($this->input->post("id_kekerasan") != "") ? $this->input->post("id_kekerasan") : 0;
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : 0;
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : 0;
        $narasi = ($this->input->post("narasi") != "") ? $this->input->post("narasi") : "";
        $alamat = ($this->input->post("alamat") != "") ? $this->input->post("alamat") : "";
        $cb_privasi = ($this->input->post("cb_privasi") != "") ? $this->input->post("cb_privasi") : "";
        $tgl_kejadian = ($this->input->post("tgl_kejadian") != "") ? $this->input->post("tgl_kejadian") : "";

        $this->Api_m->insertLaporanKekerasan($id_penduduk, $id_jenis_user, $id_kekerasan, $id_kecamatan, $id_kelurahan, $narasi, $alamat, $cb_privasi, $tgl_kejadian);
        $return["success"] = "TRUE";
        $return["pesan"] = "Simpan Laporan Kekerasan Berhasil.";

        echo json_encode($return);
    }

    function update_LaporanPenyelesaianKordinat() {
        $id_kejadian = ($this->input->post("id_kejadian") != "") ? $this->input->post("id_kejadian") : "";
        $id_jenis_user = ($this->input->post("id_jenis_user") != "") ? $this->input->post("id_jenis_user") : 0;
        $id_kekerasan = ($this->input->post("id_kekerasan") != "") ? $this->input->post("id_kekerasan") : 0;
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : 0;
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : 0;
        $narasi = ($this->input->post("narasi") != "") ? $this->input->post("narasi") : "";
        $alamat = ($this->input->post("alamat") != "") ? $this->input->post("alamat") : "";
        $penyelesaian = ($this->input->post("penyelesaian") != "") ? $this->input->post("penyelesaian") : "";
        $tgl_kejadian = ($this->input->post("tgl_kejadian") != "") ? $this->input->post("tgl_kejadian") : "";
        $id_penanganan = ($this->input->post("id_penanganan") != "") ? $this->input->post("id_penanganan") : null;

        $this->Api_m->updateLaporanKekerasanKordinat($id_kejadian, $id_jenis_user, $id_kekerasan, $id_kecamatan, $id_kelurahan, $narasi, $alamat, $penyelesaian, $tgl_kejadian, $id_penanganan);
        $return["success"] = "TRUE";
        $return["pesan"] = "Simpan Penyelesaian Kekerasan Berhasil.";

        echo json_encode($return);
    }

    function update_LaporanPenyelesaianNoKordinat() {
        $id_kejadian = ($this->input->post("id_kejadian") != "") ? $this->input->post("id_kejadian") : "";
        $penyelesaian = ($this->input->post("penyelesaian") != "") ? $this->input->post("penyelesaian") : "";
        $id_penanganan = ($this->input->post("id_penanganan") != "") ? $this->input->post("id_penanganan") : null;

        $this->Api_m->updateLaporanKekerasanNoKordinat($id_kejadian, $penyelesaian, $id_penanganan);
        $return["success"] = "TRUE";
        $return["pesan"] = "Simpan Penyelesaian Kekerasan Berhasil.";

        echo json_encode($return);
    }

    function update_LaporanPenyelesaianExternal() {
        $id_kejadian = ($this->input->post("id_kejadian") != "") ? $this->input->post("id_kejadian") : "";
        $penyelesaian = ($this->input->post("penyelesaian") != "") ? $this->input->post("penyelesaian") : "";

        $this->Api_m->update_LaporanPenyelesaianExternal($id_kejadian, $penyelesaian);
        $return["success"] = "TRUE";
        $return["pesan"] = "Simpan Penyelesaian Kekerasan Instansi External Berhasil.";

        echo json_encode($return);
    }

    function update_Tanggapan() {
        $id_kejadian = ($this->input->post("id_kejadian") != "") ? $this->input->post("id_kejadian") : 0;
        $id_petugas = ($this->input->post("id_petugas") != "") ? $this->input->post("id_petugas") : 0;

        $this->Api_m->updateTanggapan($id_kejadian, $id_petugas);
        $return["success"] = TRUE;
        $return["pesan"] = "Simpan Tanggapan Berhasil.";

        echo json_encode($return);
    }

    function update_HasilKejadian() {
        $id_kejadian = ($this->input->post("id_kejadian") != "") ? $this->input->post("id_kejadian") : 0;
        $penyelesaian = ($this->input->post("penyelesaian") != "") ? $this->input->post("penyelesaian") : "";

        $this->Api_m->updateHasilKejadian($id_kejadian, $penyelesaian);
        $return["success"] = TRUE;
        $return["pesan"] = "Simpan Penyelesaian Berhasil.";

        echo json_encode($return);
    }

    function get_Login() {
        $username = ($this->input->post("username") != "") ? $this->input->post("username") : "";
        $passwd = ($this->input->post("passwd") != "") ? $this->input->post("passwd") : "";

        if ($this->Api_m->CekPenduduk($username) > 0) {
            $Fields = $this->Api_m->getDataPenduduk($username, $passwd);
            if ($Fields->num_rows() > 0) {
                $Hasil = $Fields->row();
                $data = array(
                    "id_user" => $Hasil->id_penduduk,
                    "nik" => $Hasil->nik,
                    "nama_user" => $Hasil->nama_penduduk,
                    "tenpat_lahir" => $Hasil->tempat_lahir,
                    "tgl_lahir" => date_format(date_create($Hasil->tgl_lahir), 'd-m-Y'),
                    "alamat" => $Hasil->alamat,
                    "nohp" => $Hasil->nohp,
                    "id_kecamatan" => $Hasil->id_kecamatan,
                    "nama_kecamatan" => $Hasil->nama_kecamatan,
                    "id_kelurahan" => $Hasil->id_kelurahan,
                    "nama_kelurahan" => $Hasil->nama_kelurahan,
                    "username" => "",
                    "jabatan" => "Penduduk"
                );
                $return["data"] = $data;
                $return["success"] = TRUE;
                $return["pesan"] = "Login Penduduk Berhasil";
            } else {
                $return["success"] = FALSE;
                $return["pesan"] = "Login Penduduk Gagal..!!!";
            }
        } elseif ($this->Api_m->CekPetugas($username) > 0) {
            $Fields = $this->Api_m->getDataPetugas($username, $passwd);
            if ($Fields->num_rows() > 0) {
                $Hasil = $Fields->row();
                $data = array(
                    "id_user" => $Hasil->id_petugas,
                    "nik" => "",
                    "nama_user" => $Hasil->nama_petugas,
                    "tenpat_lahir" => "",
                    "tgl_lahir" => "",
                    "alamat" => $Hasil->alamat,
                    "nohp" => $Hasil->nohp,
                    "id_kecamatan" => "",
                    "nama_kecamatan" => "",
                    "id_kelurahan" => "",
                    "nama_kelurahan" => "",
                    "username" => $Hasil->username,
                    "jabatan" => $this->Api_m->getNamaJabatan($Hasil->id_jabatan)->nama_jabatan
                );
                $return["data"] = $data;
                $return["success"] = TRUE;
                $return["pesan"] = "Login Petugas Berhasil";
            } else {
                $return["success"] = FALSE;
                $return["pesan"] = "Login Petugas Gagal..!!!";
            }
        } else {
            $return["success"] = FALSE;
            $return["pesan"] = "Login Gagal, Silahkan Cek Ulang..!!!";
        }

        echo json_encode($return);
    }

    function get_Listpenyelesaian() {
        $id_user = ($this->input->post("id_user") != "") ? $this->input->post("id_user") : "";
        $Sql = $this->Api_m->get_Listpenyelesaian($id_user);

        if($Sql->num_rows() > 0) {
        	foreach ($Sql->result() as $Fields) {

        		if($Fields->lng != "") {
        			$alamat = $Fields->alamat_user;
        			$nama_kecamatan = $Fields->nama_kecamatan_laporan;
        			$nama_kelurahan = $Fields->nama_kelurahan_laporan;
        		} else {
        			$alamat = $Fields->alamat;
        			$nama_kecamatan = $Fields->nama_kecamatan_user;
        			$nama_kelurahan = $Fields->nama_kelurahan_user;
        		}

        		$hasil[] = array(
        			"id_kejadian" => $Fields->id_kejadian,
        			"tgl_kejadian" => date_format(date_create($Fields->tgl_kejadian), "d-m-Y"),
        			"nama_penduduk" => $Fields->nama_penduduk,
        			"alamat" => $alamat,
        			"nama_kecamatan" => $nama_kecamatan,
        			"nama_kelurahan" => $nama_kelurahan,
        			"nama_jenis_user" => $Fields->nama_jenis_user,
        			"nama_kekerasan" => $Fields->nama_kekerasan,
        			"narasi" => $Fields->narasi,
        			"id_jenis_user" => $Fields->id_jenis_user,
        			"id_kekerasan" => $Fields->id_kekerasan,
        			"id_kecamatan" => $Fields->id_kecamatan,
        			"id_kelurahan" => $Fields->id_kelurahan,
        			"cb_privasi" => $Fields->cb_privasi,
        			"lat" => $Fields->lat,
        			"lng" => $Fields->lng
        		);
        	}

	        $return["success"] = "TRUE";
	        $return["msgServer"] = "Data ditemukan.";
	        $return["data"] = $hasil;
        } else {
			$return["success"] = "FALSE";
	        $return["msgServer"] = "Tidak ada data.";
        }


        echo json_encode($return);
    }

    function get_ListRiwayatPetugas() {
        $id_user = ($this->input->post("id_user") != "") ? $this->input->post("id_user") : "";
        $nama_jabatan = ($this->input->post("nama_jabatan") != "") ? $this->input->post("nama_jabatan") : "";
        $id_penanganan = ($this->input->post("id_penanganan") != "") ? $this->input->post("id_penanganan") : "";
        $Sql = $this->Api_m->get_ListRiwayatPetugas($id_user, $id_penanganan, $nama_jabatan);

        if($Sql->num_rows() > 0) {
        	foreach ($Sql->result() as $Fields) {

        		if($Fields->lng != "") {
        			$alamat = $Fields->alamat_user;
        			$nama_kecamatan = $Fields->nama_kecamatan_laporan;
        			$nama_kelurahan = $Fields->nama_kelurahan_laporan;
        		} else {
        			$alamat = $Fields->alamat;
        			$nama_kecamatan = $Fields->nama_kecamatan_user;
        			$nama_kelurahan = $Fields->nama_kelurahan_user;
        		}

        		$hasil[] = array(
        			"id_kejadian" => $Fields->id_kejadian,
        			"tgl_kejadian" => date_format(date_create($Fields->tgl_kejadian), "d-m-Y"),
        			"nama_penduduk" => $Fields->nama_penduduk,
        			"alamat" => $alamat,
        			"nama_kecamatan" => $nama_kecamatan,
        			"nama_kelurahan" => $nama_kelurahan,
        			"nama_jenis_user" => $Fields->nama_jenis_user,
        			"nama_kekerasan" => $Fields->nama_kekerasan,
        			"narasi" => $Fields->narasi,
        			"penyelesaian" => $Fields->penyelesaian,
        			"id_jenis_user" => $Fields->id_jenis_user,
        			"id_kekerasan" => $Fields->id_kekerasan,
        			"id_kecamatan" => $Fields->id_kecamatan,
        			"id_kelurahan" => $Fields->id_kelurahan,
        			"cb_privasi" => $Fields->cb_privasi,
        			"penyelesaian_ext" => $Fields->penyelesaian_ext,
        			"lat" => $Fields->lat,
        			"lng" => $Fields->lng
        		);
        	}

	        $return["success"] = "TRUE";
	        $return["msgServer"] = "Data ditemukan.";
	        $return["data"] = $hasil;
        } else {
			$return["success"] = "FALSE";
	        $return["msgServer"] = "Tidak ada data.";
        }


        echo json_encode($return);
    }

}
