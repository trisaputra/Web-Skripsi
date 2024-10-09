<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kekerasan_m extends CI_Model {

    function getDataComboBox($id_label = "", $id_selected = "") {
        $options = array();
        $items = array();
        $this->db->order_by("nama_kekerasan", "asc");
        $query = $this->db->get('m_kekerasan');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $i++;
                if ($i == 1) {
                    $items[""] = "";
                }
                $items[$row->id_kekerasan] = $row->nama_kekerasan;
            }
            $options = $items;
        }
        return form_dropdown($id_label, $options, $id_selected, 'id ="' . $id_label . '" Class="select2me form-control" data-placeholder="Pilih Kekerasan..."');
    }

    function getKekerasan($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "") {
        $this->db->from("m_kekerasan a");
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

    function getCountKekerasan($criteria = "", $keyword = "") {
        $this->db->from("m_kekerasan a");
        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        return $this->db->count_all_results();
    }

    function insert($nama_kekerasan = "") {
        $data = array(
            "nama_kekerasan" => $nama_kekerasan
        );
        $this->db->insert("m_kekerasan", $data);
    }

    function update($id_kekerasan = "", $nama_kekerasan = "") {
        $data = array(
            "nama_kekerasan" => $nama_kekerasan
        );
        $this->db->where('id_kekerasan', $id_kekerasan);
        $this->db->update('m_kekerasan', $data);
    }

    function delete($id_kekerasan = "") {
        if ($id_kekerasan) {
            $this->db->delete("m_kekerasan", array("id_kekerasan" => $id_kekerasan));
        }
    }

    /**
     *  Fungsi Untuk Chek Data
     */
    function Chek_Data($id_kekerasan = "", $nama_kekerasan = "") {
        if ($id_kekerasan) {
            $this->db->where("id_kekerasan", $id_kekerasan);
        } else {
            $this->db->where("nama_kekerasan", $nama_kekerasan);
        }
        $query = $this->db->get("m_kekerasan");
        return $query->num_rows();
    }

    /**
     *  Fungsi Untuk List Data
     */
    function List_Data($id_kekerasan = "") {
        $query = $this->db->get_where('m_kekerasan', array('id_kekerasan' => $id_kekerasan));
        return $query->row();
    }

}
