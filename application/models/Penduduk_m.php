<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penduduk_m extends CI_Model {

    function getDataComboBox($id_label = "", $id_selected = "") {
        $options = array();
        $items = array();
        $this->db->order_by("nama_penduduk", "asc");
        $query = $this->db->get('m_penduduk');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $i++;
                if ($i == 1) {
                    $items[""] = "";
                }
                $items[$row->id_penduduk] = $row->nama_penduduk;
            }
            $options = $items;
        }
        return form_dropdown($id_label, $options, $id_selected, 'id ="' . $id_label . '" Class="select2me form-control" data-placeholder="Pilih Penduduk..."');
    }

    function getPenduduk($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "") {
        $this->db->from("m_penduduk a");
        $this->db->join("m_kecamatan b", "a.id_kecamatan=b.id_kecamatan", "left");
        $this->db->join("m_kelurahan c", "a.id_kelurahan=c.id_kelurahan", "left");
        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        if ($sort && $dir) {
            $this->db->order_by($sort, $dir);
        }
        if ($start != "" && $limit != "") {
            $this->db->limit($limit, $start);
        }
        return $this->db->get();
    }

    function getCountPenduduk($criteria = "", $keyword = "") {
        $this->db->from("m_penduduk a");
        $this->db->join("m_kecamatan b", "a.id_kecamatan=b.id_kecamatan", "left");
        $this->db->join("m_kelurahan c", "a.id_kelurahan=c.id_kelurahan", "left");
        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        return $this->db->count_all_results();
    }

    function insert($nik = "", $nama_penduduk = "", $tempat_lahir = "", $tgl_lahir = "", $alamat = "", $id_kecamatan = "", $id_kelurahan = "", $nohp = "", $status = "") {
        $data = array(
            "nik" => $nik,
            "nama_penduduk" => $nama_penduduk,
            "tempat_lahir" => $tempat_lahir,
            "tgl_lahir" => date_format(date_create($tgl_lahir), 'Y-m-d'),
            "alamat" => $alamat,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan,
            "nohp" => $nohp
        );
        if ($status == "on") {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        $this->db->insert("m_penduduk", $data);
    }

    function update($id_penduduk = "", $nik = "", $nama_penduduk = "", $tempat_lahir = "", $tgl_lahir = "", $alamat = "", $id_kecamatan = "", $id_kelurahan = "", $nohp = "", $status = "") {
        $data = array(
            "nik" => $nik,
            "nama_penduduk" => $nama_penduduk,
            "tempat_lahir" => $tempat_lahir,
            "tgl_lahir" => date_format(date_create($tgl_lahir), 'Y-m-d'),
            "alamat" => $alamat,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan,
            "nohp" => $nohp
        );
        if ($status == "on") {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        $this->db->where('id_penduduk', $id_penduduk);
        $this->db->update('m_penduduk', $data);
    }

    function delete($id_penduduk = "") {
        if ($id_penduduk) {
            $this->db->delete("m_penduduk", array("id_penduduk" => $id_penduduk));
        }
    }

    /**
     *  Fungsi Untuk Chek Data
     */
    function Chek_Data($id_penduduk = "", $nik = "") {
        if ($id_penduduk) {
            $this->db->where("id_penduduk", $id_penduduk);
        } else {
            $this->db->where("nik", $nik);
        }
        $query = $this->db->get("m_penduduk");
        return $query->num_rows();
    }

    /**
     *  Fungsi Untuk List Data
     */
    function List_Data($id_penduduk = "") {
        $query = $this->db->get_where('m_penduduk', array('id_penduduk' => $id_penduduk));
        return $query->row();
    }

}
