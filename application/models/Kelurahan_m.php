<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelurahan_m extends CI_Model {

    function getDataComboBox($id_label = "", $id_selected = "") {
        $options = array();
        $items = array();
        $this->db->order_by("nama_kelurahan", "asc");
        $query = $this->db->get('m_kelurahan');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $i++;
                if ($i == 1) {
                    $items[""] = "";
                }
                $items[$row->id_kelurahan] = $row->nama_kelurahan;
            }
            $options = $items;
        }
        return form_dropdown($id_label, $options, $id_selected, 'id ="' . $id_label . '" Class="select2me form-control" data-placeholder="Pilih Kelurahan..."');
    }

    function getKelurahan($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "") {
        $this->db->select("a.*, b.nama_kecamatan");
        $this->db->from("m_kelurahan a");
        $this->db->join("m_kecamatan b", "a.id_kecamatan=b.id_kecamatan", "left");

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

    function getCountKelurahan($criteria = "", $keyword = "") {
        $this->db->select("a.*, b.nama_kecamatan");
        $this->db->from("m_kelurahan a");
        $this->db->join("m_kecamatan b", "a.id_kecamatan=b.id_kecamatan", "left");

        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        return $this->db->count_all_results();
    }

    function insert($nama_kelurahan = "", $maps_poly = "", $warna = "", $id_kecamatan = "") {
        $data = array(
            "nama_kelurahan" => $nama_kelurahan,
            "maps_poly" => $maps_poly,
            "warna" => $warna,
            "id_kecamatan" => $id_kecamatan
        );
        $this->db->insert("m_kelurahan", $data);
    }

    function update($id_kelurahan = "", $nama_kelurahan = "", $maps_poly = "", $warna = "", $id_kecamatan = "") {
        $data = array(
            "nama_kelurahan" => $nama_kelurahan,
            "maps_poly" => $maps_poly,
            "warna" => $warna,
            "id_kecamatan" => $id_kecamatan
        );
        $this->db->where('id_kelurahan', $id_kelurahan);
        $this->db->update('m_kelurahan', $data);
    }

    function delete($id_kelurahan = "") {
        if ($id_kelurahan) {
            $this->db->delete("m_kelurahan", array("id_kelurahan" => $id_kelurahan));
        }
    }

    /**
     *  Fungsi Untuk Chek Data
     */
    function Chek_Data($id_kelurahan = "", $nama_kelurahan = "", $id_kecamatan = "") {
        if ($id_kelurahan) {
            $this->db->where("id_kelurahan", $id_kelurahan);
        } else {
            $this->db->where("nama_kelurahan", $nama_kelurahan);
            $this->db->where("id_kecamatan", $id_kecamatan);
        }
        $query = $this->db->get("m_kelurahan");
        return $query->num_rows();
    }

    /**
     *  Fungsi Untuk List Data
     */
    function List_Data($id_kelurahan = "") {
        $query = $this->db->get_where('m_kelurahan', array('id_kelurahan' => $id_kelurahan));
        return $query->row();
    }

}
