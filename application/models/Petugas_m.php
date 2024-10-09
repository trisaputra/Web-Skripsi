<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Petugas_m extends CI_Model {

    function getDataComboBox($id_label = "", $id_selected = "") {
        $options = array();
        $items = array();
        $this->db->order_by("nama_petugas", "asc");
        $query = $this->db->get('m_petugas');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $i++;
                if ($i == 1) {
                    $items[""] = "";
                }
                $items[$row->id_petugas] = $row->nama_petugas;
            }
            $options = $items;
        }
        return form_dropdown($id_label, $options, $id_selected, 'id ="' . $id_label . '" Class="select2me form-control" data-placeholder="Pilih Petugas..."');
    }

    function getPetugas($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "") {
        $this->db->select("a.*, b.nama_jabatan");
        $this->db->from("m_petugas a");
        $this->db->join("m_jabatan b", "a.id_jabatan=b.id_jabatan", "left");
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

    function getCountPetugas($criteria = "", $keyword = "") {
        $this->db->select("a.*, b.nama_jabatan");
        $this->db->from("m_petugas a");
        $this->db->join("m_jabatan b", "a.id_jabatan=b.id_jabatan", "left");
        if ($criteria && $keyword) {
            $this->db->like($criteria, $keyword);
        }
        return $this->db->count_all_results();
    }

    function insert($username = "", $passwd = "", $flag_password_user = "", $nama_petugas = "", $nohp = "", $alamat = "", $status = "", $id_jabatan = "") {
        $data = array(
            "nama_petugas" => $nama_petugas,
            "nohp" => $nohp,
            "alamat" => $alamat,
            "username" => $username,
            "id_jabatan" => $id_jabatan
        );
        if ($status == "on") {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        if ($flag_password_user == "true") {
            $data['passwd'] = md5($passwd);
        } else {
            $data['passwd'] = md5('123456');
        }
        $this->db->insert("m_petugas", $data);
    }

    function update($id_petugas = "", $username = "", $passwd = "", $flag_password_user = "", $nama_petugas = "", $nohp = "", $alamat = "", $status = "", $id_jabatan = "") {
        $data = array(
            "nama_petugas" => $nama_petugas,
            "nohp" => $nohp,
            "alamat" => $alamat,
            "username" => $username,
            "id_jabatan" => $id_jabatan
        );
        if ($status == "on") {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        if ($flag_password_user == "true") {
            $data['passwd'] = md5($passwd);
        }
        $this->db->where('id_petugas', $id_petugas);
        $this->db->update('m_petugas', $data);
    }

    function delete($id_petugas = "") {
        if ($id_petugas) {
            $this->db->delete("m_petugas", array("id_petugas" => $id_petugas));
        }
    }

    /**
     *  Fungsi Untuk Chek Data
     */
    function Chek_Data($id_petugas = "", $username = "") {
        if ($id_petugas) {
            $this->db->where("id_petugas", $id_petugas);
        } else {
            $this->db->where("username", $username);
        }
        $query = $this->db->get("m_petugas");
        return $query->num_rows();
    }

    /**
     *  Fungsi Untuk List Data
     */
    function List_Data($id_petugas = "") {
        $query = $this->db->get_where('m_petugas', array('id_petugas' => $id_petugas));
        return $query->row();
    }

}
