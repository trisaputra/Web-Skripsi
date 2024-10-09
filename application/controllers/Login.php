<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->view('login_v');
    }

    function do_login() {
        $return = array();

        $username = $this->input->post("username");
        $passwd = $this->input->post("passwd");

        $this->db->select("a.*, b.nama_jabatan");
        $this->db->from("m_petugas a");
        $this->db->join("m_jabatan b", "b.id_jabatan=a.id_jabatan", "left");
        $this->db->where(array('a.username' => $username, 'a.passwd' => md5($passwd), 'b.id_jabatan' => 1, 'status' => true));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $Fields = $query->row();

            $newdata = array(
                "id_petugas" => $Fields->id_petugas,
                "nama_petugas" => $Fields->nama_petugas,
                "nohp" => $Fields->nohp,
                "alamat" => $Fields->alamat,
                "nama_jabatan" => $Fields->nama_jabatan,
                "id_jabatan" => $Fields->id_jabatan,
                "username" => $Fields->username,
                "logged" => TRUE
            );
            $this->session->set_userdata($newdata);

            $return["page"] = 'welcome';
            $return["success"] = TRUE;
            $return["msgServer"] = "Login Sukses.";
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Username atau Password Salah.";
        }

        echo json_encode($return);
    }

    function do_Logout() {
        $this->Layout_m->Check_Logout();
    }

}
