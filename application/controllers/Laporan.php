<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->Layout_m->Check_Login();
    }

    public function index() {
        $data['nama_menu'] = "Laporan";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('laporan_v', $data);
    }

    function do_Kejadian() {
        $kriteria = ($this->input->post("kriteria") != "") ? $this->input->post("kriteria") : "";
        $tgl_sekarang = ($this->input->post("tgl_sekarang") != "") ? $this->input->post("tgl_sekarang") : "";
        $tgl_awal = ($this->input->post("tgl_awal") != "") ? $this->input->post("tgl_awal") : "";
        $tgl_akhir = ($this->input->post("tgl_akhir") != "") ? $this->input->post("tgl_akhir") : "";
        $id_tahun = ($this->input->post("id_tahun") != "") ? $this->input->post("id_tahun") : "";

        if ($kriteria == "by_tanggal") {
            $periode = "Tanggal " . $tgl_sekarang;
            $getData = $this->Layout_m->getData($tgl_sekarang)->result();
        } elseif ($kriteria == "by_bulan") {
            $periode = "Dari Tanggal " . $tgl_awal . " s/d " . $tgl_akhir;
            $getData = $this->Layout_m->getData("", $tgl_awal, $tgl_akhir)->result();
        } else {
            $periode = "Tahun " . $id_tahun;
            $getData = $this->Layout_m->getData("", "", "", $id_tahun)->result();
        }

        if ($this->db->trans_status() === FALSE) {
            $return["success"] = FALSE;
            $return["msgServer"] = "Ambil data kejadian gagal. !!!";
        } else {
            $return["periode"] = $periode;
            $return["hasil"] = $getData;
            $return["success"] = TRUE;
            $return["msgServer"] = "Ambil data kejadian berhasil.";
        }
        echo json_encode($return);
    }

    function doCetak($kriteria = "", $tgl_sekarang = "", $tgl_awal = "", $tgl_akhir = "", $id_tahun = "") {
        if ($kriteria == "by_tanggal") {
            $data['periode'] = "Tanggal " . $tgl_sekarang;
            $data['getData'] = $this->Layout_m->getData($tgl_sekarang)->result();
        } elseif ($kriteria == "by_bulan") {
            $data['periode'] = "Dari Tanggal " . $tgl_awal . " s/d " . $tgl_akhir;
            $data['getData'] = $this->Layout_m->getData("", $tgl_awal, $tgl_akhir)->result();
        } else {
            $data['periode'] = "Tahun " . $id_tahun;
            $data['getData'] = $this->Layout_m->getData("", "", "", $id_tahun)->result();
        }

        $this->parser->parse('excel_v', $data);
    }

}
