<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Android extends CI_Controller {

    function __construct() {
        parent::__construct();

        // Custom untuk filter parsing dari android (alhamdulillah ketemu)
//        $token = ($this->input->get_request_header('X-api-token', TRUE) != "") ? $this->input->get_request_header('X-api-token', TRUE) : "";
//        if ($token == "") {
//            $this->Utility_M->Check_Login();
//        } else {
//            $query = $this->db->get_Where('m_user', array('token' => $token));
//
//            if ($query->num_rows() == 0) {
//                $return["success"] = FALSE;
//               
//            } else {
//                $return["success"] = TRUE;
//            }
//            $return["msgServer"] = $token;
//            echo json_encode($return);
//        }
	$this->load->model('Utility_M');
    }

    /* Contoh untuk test Notifikasi 
     * nek gak isoh
     * 
     */

    function tesNotif() {
        $this->load->model('Gcm_M');

        // Kirim Ke Android
        //$this->Gcm_M->kirimGCM("197701112003121002", "Tes", "Disposisi");
    }

    function do_testNotifikasi() {
        $Action = "Update";
        $Content = "Disposisi";
        $Content2 = "Verifikasi";
        $Data = "isi data";

        $kardonos = 'cnp5qatSxGQ:APA91bEpWLbc4KdJeQulu2xiU-f0Zh_rpTf_ZPQemKDM00YHOJRHK4M47uOZ7YFh21DVVoRuV7SFZI9KtoxuwBsdeLytmR-oIIQ03jcipeJz2stITLC5i_MEDtz4Ae2nsC88u_Mfh0iY';
        $registrationId2 = 'e6DQWkcVhaI:APA91bE7qSIqxcZr_dzBcyBqSunnyCHnyolRv9TbwuGuAj63SkktYG7kiFSfKkxDNODhHgGYrT5iXX2gjutn6xMPIdPdhTDqEgl6X9BG8WOshLxtigiT5VPlvQT5xvWOT9yr51uSmrv3';

//        $this->Utility_M->sendNotificationAndroid(array($kardonos), array('action' => $Action,
//            'content' => $Content,
//            'data' => $Data));
    }

    function updateLastLokasi() {

        $id_user = $this->input->post("id_user");
        $lokasi = $this->input->post("lokasi");

        $data = array(
            'id_user' => $id_user,
            'tgl_ins' => date('Y-m-d H:i:s')
        );

        $this->db->set('lokasi', 'POINT(' . $lokasi . ')', false);
        $this->db->insert('log_aktifitas', $data);
    }

    function do_list_berita() {

        //$nip = ($this->input->post("nip") != "") ? $this->input->post("nip") : "";
//        $this->db->select('a.id_surat_masuk,a.id_surat_masuk_ref,'
//                . ' a.id_unit, a.id_status,a.nip, a.no_surat, a.asal_ket, a.kepada_ket, '
//                . 'a.perihal, a.no_agenda, a.waktu_masuk, a.tgl_terima_surat, '
//                . 'a.keterangan,a.nama_penandatangan,a.surat_asli,a.surat_lampiran, c.id_kategori, c.nama_kategori,'
//                . ' d.nama_status,g.nama_jenis_surat');
//
//        $this->db->distinct();
        $this->db->from("t_berita a");
//        $this->db->join("t_disposisi_masuk b", "b.id_surat_masuk=a.id_surat_masuk", "left");
//        $this->db->join("m_kategori c", "c.id_kategori=a.id_kategori", "left");
//        $this->db->join("m_status_surat d", "d.id_status=a.id_status", "left");
//        $this->db->join("m_user_unit_kerja e", "e.id_unit=a.id_unit", "left");
//        $this->db->join("m_skpd f", "f.id_skpd=e.id_skpd", "left");
//        $this->db->join("m_jenis_surat g", "g.id_jenis_surat=a.id_jenis_surat", "left");
        // Surat Berdasarkan entry surat dan yang terkena dispisisi
//        $this->db->where('a.nip', $nip); // bisa dilihat user yang membuat
//        $this->db->or_where('b.nip_tujuan', $nip); // bisa dilihat user yang di disposisikan
	$this->db->order_by("a.id_berita", "DESC");
        $this->db->limit(10, 1);
        $query = $this->db->get();

        $items = array();
        foreach ($query->result() as $Fields) {
            $item = array(
                "id" => $Fields->id_berita,
                "tgl_berita" => $this->Utility_M->date_to_dbpostgres($Fields->tgl_entri, "human", "d"),
                "judul" => $Fields->judul,
		"url_file" => ($Fields->file != "") ? $Fields->file : "no_foto.jpg",
                "penulis" => "penulis",
                "narasi" => $Fields->narasi
            );
            array_push($items, $item);
        }

        echo json_encode($items);
    }

    function do_list_berita_paging() {

        $offset = ($this->input->post("offset") != "") ? $this->input->post("offset") : "";
        $limit = ($this->input->post("limit") != "") ? $this->input->post("limit") : "";

        $this->db->from("t_berita a");
        $this->db->order_by("a.id_berita", "DESC");
        $this->db->limit($limit, $offset);
        //$this->db->limit(5, 1);

        $query = $this->db->get();

        $items = array();
        $i=0;
        foreach ($query->result() as $Fields) {
            $i++;
            $item = array(
                "id" => $Fields->id_berita,
                "tgl_berita" => $this->Utility_M->date_to_dbpostgres($Fields->tgl_entri, "human", "d"),
                "judul" => $Fields->judul,
		"url_file" => ($Fields->file != "") ? $Fields->file : "no_foto.jpg",
                "penulis" => $i,
                "narasi" => $Fields->narasi
            );
            array_push($items, $item);
        }

        echo json_encode($items);
    }

    function do_berita() {

        $id_berita = ($this->input->post("id") != "") ? $this->input->post("id") : "";

        $this->db->from("t_berita a");
        $this->db->where("a.id_berita", $id_berita);
        $this->db->order_by("a.id_berita", "DESC");
        //$this->db->limit(5, 1);

        $query = $this->db->get();

        $items = array();
        $i = 0;
        foreach ($query->result() as $Fields) {
            $i++;
            $item = array(
                "id" => $Fields->id_berita,
                "tgl_berita" => $this->Utility_M->date_to_dbpostgres($Fields->tgl_entri, "human", "d"),
                "judul" => $Fields->judul,
                "penulis" => $i,
		"url_file" => ($Fields->file != "") ? $Fields->file : "no_foto.jpg",
                "narasi" => $Fields->narasi
            );
            array_push($items, $item);
        }

        echo json_encode($items);
    }
}
