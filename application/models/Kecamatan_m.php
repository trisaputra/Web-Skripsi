<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan_m extends CI_Model {

    function getDataComboBox($id_label = "", $id_selected = "") {
        $options = array();
        $items = array();
        $this->db->order_by("nama_kecamatan", "asc");
        $query = $this->db->get('m_kecamatan');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $i++;
                if ($i == 1) {
                    $items[""] = "";
                }
                $items[$row->id_kecamatan] = $row->nama_kecamatan;
            }
            $options = $items;
        }
        return form_dropdown($id_label, $options, $id_selected, 'id ="' . $id_label . '" Class="select2me form-control" data-placeholder="Pilih Kecamatan..."');
    }

    function getKecamatan($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "") {
        $this->db->from("m_kecamatan a");
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

    function getCountKecamatan($criteria = "", $keyword = "") {
        $this->db->from("m_kecamatan a");
        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        return $this->db->count_all_results();
    }

    function insert($nama_kecamatan = "", $maps_poly = "", $warna = "") {
        $data = array(
            "nama_kecamatan" => $nama_kecamatan,
            "maps_poly" => $maps_poly,
            "warna" => $warna
        );
        $this->db->insert("m_kecamatan", $data);
    }

    function update($id_kecamatan = "", $nama_kecamatan = "", $maps_poly = "", $warna = "") {
        $data = array(
            "nama_kecamatan" => $nama_kecamatan,
            "maps_poly" => $maps_poly,
            "warna" => $warna
        );
        $this->db->where('id_kecamatan', $id_kecamatan);
        $this->db->update('m_kecamatan', $data);
    }

    function delete($id_kecamatan = "") {
        if ($id_kecamatan) {
            $this->db->delete("m_kecamatan", array("id_kecamatan" => $id_kecamatan));
        }
    }

    /**
     *  Fungsi Untuk Chek Data
     */
    function Chek_Data($id_kecamatan = "", $nama_kecamatan = "") {
        if ($id_kecamatan) {
            $this->db->where("id_kecamatan", $id_kecamatan);
        } else {
            $this->db->where("nama_kecamatan", $nama_kecamatan);
        }
        $query = $this->db->get("m_kecamatan");
        return $query->num_rows();
    }

    /**
     *  Fungsi Untuk List Data
     */
    function List_Data($id_kecamatan = "") {
        $query = $this->db->get_where('m_kecamatan', array('id_kecamatan' => $id_kecamatan));
        return $query->row();
    }

}
