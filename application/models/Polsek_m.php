<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Polsek_m extends CI_Model {

    function getDataComboBox($id_label = "", $id_selected = "") {
        $options = array();
        $items = array();
        $this->db->order_by("nama_polsek", "asc");
        $query = $this->db->get('m_polsek');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $i++;
                if ($i == 1) {
                    $items[""] = "";
                }
                $items[$row->id_polsek] = $row->nama_polsek;
            }
            $options = $items;
        }
        return form_dropdown($id_label, $options, $id_selected, 'id ="' . $id_label . '" Class="select2me form-control" data-placeholder="Pilih Polsek..."');
    }

    function getPolsek($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "") {
        $this->db->from("m_polsek a");
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

    function getCountPolsek($criteria = "", $keyword = "") {
        $this->db->from("m_polsek a");
        $this->db->join("m_kecamatan b", "a.id_kecamatan=b.id_kecamatan", "left");
        $this->db->join("m_kelurahan c", "a.id_kelurahan=c.id_kelurahan", "left");
        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        return $this->db->count_all_results();
    }

    function insert($nama_polsek = "", $alamat_polsek = "", $no_telp = "", $lng = "", $lat = "", $id_kecamatan = "", $id_kelurahan = "") {
        $data = array(
            "nama_polsek" => $nama_polsek,
            "alamat_polsek" => $alamat_polsek,
            "no_telp" => $no_telp,
            "lng" => $lng,
            "lat" => $lat,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan
        );
        $this->db->insert("m_polsek", $data);
    }

    function update($id_polsek = "", $nama_polsek = "", $alamat_polsek = "", $no_telp = "", $lng = "", $lat = "", $id_kecamatan = "", $id_kelurahan = "") {
        $data = array(
            "nama_polsek" => $nama_polsek,
            "alamat_polsek" => $alamat_polsek,
            "no_telp" => $no_telp,
            "lng" => $lng,
            "lat" => $lat,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan
        );
        $this->db->where('id_polsek', $id_polsek);
        $this->db->update('m_polsek', $data);
    }

    function delete($id_polsek = "") {
        if ($id_polsek) {
            $this->db->delete("m_polsek", array("id_polsek" => $id_polsek));
        }
    }

    /**
     *  Fungsi Untuk Chek Data
     */
    function Chek_Data($id_polsek = "", $nama_polsek = "") {
        if ($id_polsek) {
            $this->db->where("id_polsek", $id_polsek);
        } else {
            $this->db->where("nama_polsek", $nama_polsek);
        }
        $query = $this->db->get("m_polsek");
        return $query->num_rows();
    }

    /**
     *  Fungsi Untuk List Data
     */
    function List_Data($id_polsek = "") {
        $query = $this->db->get_where('m_polsek', array('id_polsek' => $id_polsek));
        return $query->row();
    }

}
