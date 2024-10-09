<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Puskesmas_m extends CI_Model {

    function getDataComboBox($id_label = "", $id_selected = "") {
        $options = array();
        $items = array();
        $this->db->order_by("nama_puskesmas", "asc");
        $query = $this->db->get('m_puskesmas');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $i++;
                if ($i == 1) {
                    $items[""] = "";
                }
                $items[$row->id_puskesmas] = $row->nama_puskesmas;
            }
            $options = $items;
        }
        return form_dropdown($id_label, $options, $id_selected, 'id ="' . $id_label . '" Class="select2me form-control" data-placeholder="Pilih Puskesmas..."');
    }

    function getPuskesmas($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "") {
        $this->db->from("m_puskesmas a");
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

    function getCountPuskesmas($criteria = "", $keyword = "") {
        $this->db->from("m_puskesmas a");
        $this->db->join("m_kecamatan b", "a.id_kecamatan=b.id_kecamatan", "left");
        $this->db->join("m_kelurahan c", "a.id_kelurahan=c.id_kelurahan", "left");
        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        return $this->db->count_all_results();
    }

    function insert($nama_puskesmas = "", $alamat_puskesmas = "", $no_telp = "", $lng = "", $lat = "", $id_kecamatan = "", $id_kelurahan = "") {
        $data = array(
            "nama_puskesmas" => $nama_puskesmas,
            "alamat_puskesmas" => $alamat_puskesmas,
            "no_telp" => $no_telp,
            "lng" => $lng,
            "lat" => $lat,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan
        );
        $this->db->insert("m_puskesmas", $data);
    }

    function update($id_puskesmas = "", $nama_puskesmas = "", $alamat_puskesmas = "", $no_telp = "", $lng = "", $lat = "", $id_kecamatan = "", $id_kelurahan = "") {
        $data = array(
            "nama_puskesmas" => $nama_puskesmas,
            "alamat_puskesmas" => $alamat_puskesmas,
            "no_telp" => $no_telp,
            "lng" => $lng,
            "lat" => $lat,
            "id_kecamatan" => $id_kecamatan,
            "id_kelurahan" => $id_kelurahan
        );
        $this->db->where('id_puskesmas', $id_puskesmas);
        $this->db->update('m_puskesmas', $data);
    }

    function delete($id_puskesmas = "") {
        if ($id_puskesmas) {
            $this->db->delete("m_puskesmas", array("id_puskesmas" => $id_puskesmas));
        }
    }

    /**
     *  Fungsi Untuk Chek Data
     */
    function Chek_Data($id_puskesmas = "", $nama_puskesmas = "") {
        if ($id_puskesmas) {
            $this->db->where("id_puskesmas", $id_puskesmas);
        } else {
            $this->db->where("nama_puskesmas", $nama_puskesmas);
        }
        $query = $this->db->get("m_puskesmas");
        return $query->num_rows();
    }

    /**
     *  Fungsi Untuk List Data
     */
    function List_Data($id_puskesmas = "") {
        $query = $this->db->get_where('m_puskesmas', array('id_puskesmas' => $id_puskesmas));
        return $query->row();
    }

}
