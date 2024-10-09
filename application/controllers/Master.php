<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Jabatan_m');
        $this->load->model('Petugas_m');
        $this->load->model('Penduduk_m');
        $this->load->model('Kekerasan_m');
        $this->load->model('Kecamatan_m');
        $this->load->model('Polsek_m');
        $this->load->model('Puskesmas_m');
        $this->load->model('Kelurahan_m');

        $this->Layout_m->Check_Login();
    }

    /*
     * Master Jabatan
     */

    public function jabatan() {
        $data['nama_menu'] = "Jabatan";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/jabatan_v', $data);
    }

    function do_Tabel_Jabatan() {

        $records["aaData"] = array();
        $aColumns = array('id_jabatan', 'nama_jabatan');
        //default
        $sort = "id_jabatan";
        $dir = "asc";
        $criteria = "upper(nama_jabatan)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Jabatan_m->getCountJabatan($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Jabatan_m->getJabatan($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->nama_jabatan,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_jabatan . '" data-name="' . $Fields->nama_jabatan . '" class="btn btn-sm yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_jabatan . '" data-name="' . $Fields->nama_jabatan . '" class="btn btn-sm btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Jabatan() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_jabatan = ($this->input->post("id_jabatan") != "") ? $this->input->post("id_jabatan") : "";
        $nama_jabatan = ($this->input->post("nama_jabatan") != "") ? $this->input->post("nama_jabatan") : "";

        if ($mode_form == "Tambah") {
            if ($this->Jabatan_m->Chek_Data("", $nama_jabatan) == 0) {
                $this->Jabatan_m->insert($nama_jabatan);
            } else {
                $error = "Maaf, Data Jabatan Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Jabatan_m->Chek_Data($id_jabatan) > 0) {
                $this->Jabatan_m->update($id_jabatan, $nama_jabatan);
            } else {
                $error = "Maaf, Data Jabatan Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Jabatan Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Jabatan Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Jabatan() {
        $id_jabatan = ($this->input->post("id_jabatan") != "") ? $this->input->post("id_jabatan") : "";
        $this->Jabatan_m->delete($id_jabatan);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Jabatan Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Jabatan Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Jabatan() {
        $return = array();
        $itemList = array();
        $id_jabatan = ($this->input->post("id_jabatan") != "") ? $this->input->post("id_jabatan") : "";
        if ($this->Jabatan_m->Chek_Data($id_jabatan) > 0) {
            $Fields = $this->Jabatan_m->List_Data($id_jabatan);
            $item = array(
                "mode_form" => "Ubah",
                "id_jabatan" => $Fields->id_jabatan,
                "nama_jabatan" => $Fields->nama_jabatan
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Jabatan Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

    /*
     * Master Polsek
     */

    public function polsek() {
        $data['nama_menu'] = "Polsek";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/polsek_v', $data);
    }

    function do_Tabel_Polsek() {

        $records["aaData"] = array();
        $aColumns = array('id_polsek', 'nama_polsek');
        //default
        $sort = "id_polsek";
        $dir = "asc";
        $criteria = "upper(nama_polsek)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Polsek_m->getCountPolsek($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Polsek_m->getPolsek($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->nama_polsek,
                    $Fields->no_telp,
                    $Fields->alamat_polsek . "<br>Kel. " . $Fields->nama_kelurahan . " Kec. " . $Fields->nama_kecamatan,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_polsek . '" data-name="' . $Fields->nama_polsek . '" class="btn btn-sm yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_polsek . '" data-name="' . $Fields->nama_polsek . '" class="btn btn-sm btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Polsek() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_polsek = ($this->input->post("id_polsek") != "") ? $this->input->post("id_polsek") : "";
        $nama_polsek = ($this->input->post("nama_polsek") != "") ? $this->input->post("nama_polsek") : "";
        $alamat_polsek = ($this->input->post("alamat_polsek") != "") ? $this->input->post("alamat_polsek") : "";
        $no_telp = ($this->input->post("no_telp") != "") ? $this->input->post("no_telp") : "";
        $lng = ($this->input->post("lng") != "") ? $this->input->post("lng") : "";
        $lat = ($this->input->post("lat") != "") ? $this->input->post("lat") : "";
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : "";

        if ($mode_form == "Tambah") {
            if ($this->Polsek_m->Chek_Data("", $nama_polsek) == 0) {
                $this->Polsek_m->insert($nama_polsek, $alamat_polsek, $no_telp, $lng, $lat, $id_kecamatan, $id_kelurahan);
            } else {
                $error = "Maaf, Data Polsek Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Polsek_m->Chek_Data($id_polsek) > 0) {
                $this->Polsek_m->update($id_polsek, $nama_polsek, $alamat_polsek, $no_telp, $lng, $lat, $id_kecamatan, $id_kelurahan);
            } else {
                $error = "Maaf, Data Polsek Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Polsek Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Polsek Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Polsek() {
        $id_polsek = ($this->input->post("id_polsek") != "") ? $this->input->post("id_polsek") : "";
        $this->Polsek_m->delete($id_polsek);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Polsek Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Polsek Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Polsek() {
        $return = array();
        $itemList = array();
        $id_polsek = ($this->input->post("id_polsek") != "") ? $this->input->post("id_polsek") : "";
        if ($this->Polsek_m->Chek_Data($id_polsek) > 0) {
            $Fields = $this->Polsek_m->List_Data($id_polsek);
            $item = array(
                "mode_form" => "Ubah",
                "id_polsek" => $Fields->id_polsek,
                "nama_polsek" => $Fields->nama_polsek,
                "alamat_polsek" => $Fields->alamat_polsek,
                "no_telp" => $Fields->no_telp,
                "lng" => $Fields->lng,
                "lat" => $Fields->lat,
                "id_kecamatan" => $Fields->id_kecamatan,
                "id_kelurahan" => $Fields->id_kelurahan
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Polsek Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

    /*
     * Master Puskesmas
     */

    public function puskesmas() {
        $data['nama_menu'] = "Puskesmas";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/puskesmas_v', $data);
    }

    function do_Tabel_Puskesmas() {

        $records["aaData"] = array();
        $aColumns = array('id_puskesmas', 'nama_puskesmas');
        //default
        $sort = "id_puskesmas";
        $dir = "asc";
        $criteria = "upper(nama_puskesmas)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Puskesmas_m->getCountPuskesmas($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Puskesmas_m->getPuskesmas($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->nama_puskesmas,
                    $Fields->no_telp,
                    $Fields->alamat_puskesmas . "<br>Kel. " . $Fields->nama_kelurahan . " Kec. " . $Fields->nama_kecamatan,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_puskesmas . '" data-name="' . $Fields->nama_puskesmas . '" class="btn btn-sm yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_puskesmas . '" data-name="' . $Fields->nama_puskesmas . '" class="btn btn-sm btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Puskesmas() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_puskesmas = ($this->input->post("id_puskesmas") != "") ? $this->input->post("id_puskesmas") : "";
        $nama_puskesmas = ($this->input->post("nama_puskesmas") != "") ? $this->input->post("nama_puskesmas") : "";
        $alamat_puskesmas = ($this->input->post("alamat_puskesmas") != "") ? $this->input->post("alamat_puskesmas") : "";
        $no_telp = ($this->input->post("no_telp") != "") ? $this->input->post("no_telp") : "";
        $lng = ($this->input->post("lng") != "") ? $this->input->post("lng") : "";
        $lat = ($this->input->post("lat") != "") ? $this->input->post("lat") : "";
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : "";

        if ($mode_form == "Tambah") {
            if ($this->Puskesmas_m->Chek_Data("", $nama_puskesmas) == 0) {
                $this->Puskesmas_m->insert($nama_puskesmas, $alamat_puskesmas, $no_telp, $lng, $lat, $id_kecamatan, $id_kelurahan);
            } else {
                $error = "Maaf, Data Puskesmas Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Puskesmas_m->Chek_Data($id_puskesmas) > 0) {
                $this->Puskesmas_m->update($id_puskesmas, $nama_puskesmas, $alamat_puskesmas, $no_telp, $lng, $lat, $id_kecamatan, $id_kelurahan);
            } else {
                $error = "Maaf, Data Puskesmas Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Puskesmas Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Puskesmas Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Puskesmas() {
        $id_puskesmas = ($this->input->post("id_puskesmas") != "") ? $this->input->post("id_puskesmas") : "";
        $this->Puskesmas_m->delete($id_puskesmas);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Puskesmas Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Puskesmas Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Puskesmas() {
        $return = array();
        $itemList = array();
        $id_puskesmas = ($this->input->post("id_puskesmas") != "") ? $this->input->post("id_puskesmas") : "";
        if ($this->Puskesmas_m->Chek_Data($id_puskesmas) > 0) {
            $Fields = $this->Puskesmas_m->List_Data($id_puskesmas);
            $item = array(
                "mode_form" => "Ubah",
                "id_puskesmas" => $Fields->id_puskesmas,
                "nama_puskesmas" => $Fields->nama_puskesmas,
                "alamat_puskesmas" => $Fields->alamat_puskesmas,
                "no_telp" => $Fields->no_telp,
                "lng" => $Fields->lng,
                "lat" => $Fields->lat,
                "id_kecamatan" => $Fields->id_kecamatan,
                "id_kelurahan" => $Fields->id_kelurahan
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Puskesmas Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

    /*
     * Master Petugas
     */

    public function petugas() {
        $data['nama_menu'] = "Petugas";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/petugas_v', $data);
    }

    function do_Tabel_Petugas() {

        $records["aaData"] = array();
        $aColumns = array('id_petugas', 'nama_petugas');
        //default
        $sort = "id_petugas";
        $dir = "asc";
        $criteria = "upper(nama_petugas)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Petugas_m->getCountPetugas($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Petugas_m->getPetugas($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->username,
                    $Fields->nama_petugas,
                    $Fields->nohp,
                    $Fields->nama_jabatan,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_petugas . '" data-name="' . $Fields->nama_petugas . '" class="btn btn-sm yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_petugas . '" data-name="' . $Fields->nama_petugas . '" class="btn btn-sm btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Petugas() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_petugas = ($this->input->post("id_petugas") != "") ? $this->input->post("id_petugas") : "";
        $nama_petugas = ($this->input->post("nama_petugas") != "") ? $this->input->post("nama_petugas") : "";
        $nohp = ($this->input->post("nohp") != "") ? $this->input->post("nohp") : "";
        $alamat = ($this->input->post("alamat") != "") ? $this->input->post("alamat") : "";
        $username = ($this->input->post("username") != "") ? $this->input->post("username") : "";
        $passwd = ($this->input->post("passwd") != "") ? $this->input->post("passwd") : "";
        $status = ($this->input->post("status") != "") ? $this->input->post("status") : "";
        $id_jabatan = ($this->input->post("id_jabatan") != "") ? $this->input->post("id_jabatan") : "";
        $flag_password_user = ($this->input->post("flag_password_user") != "") ? $this->input->post("flag_password_user") : "";

        if ($mode_form == "Tambah") {
            if ($this->Petugas_m->Chek_Data("", $username) == 0) {
                $this->Petugas_m->insert($username, $passwd, $flag_password_user, $nama_petugas, $nohp, $alamat, $status, $id_jabatan);
            } else {
                $error = "Maaf, Data Petugas Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Petugas_m->Chek_Data($id_petugas) > 0) {
                $this->Petugas_m->update($id_petugas, $username, $passwd, $flag_password_user, $nama_petugas, $nohp, $alamat, $status, $id_jabatan);
            } else {
                $error = "Maaf, Data Petugas Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Petugas Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Petugas Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Petugas() {
        $id_petugas = ($this->input->post("id_petugas") != "") ? $this->input->post("id_petugas") : "";
        $this->Petugas_m->delete($id_petugas);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Petugas Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Petugas Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Petugas() {
        $return = array();
        $itemList = array();
        $id_petugas = ($this->input->post("id_petugas") != "") ? $this->input->post("id_petugas") : "";
        if ($this->Petugas_m->Chek_Data($id_petugas) > 0) {
            $Fields = $this->Petugas_m->List_Data($id_petugas);
            $item = array(
                "mode_form" => "Ubah",
                "id_petugas" => $Fields->id_petugas,
                "nama_petugas" => $Fields->nama_petugas,
                "nohp" => $Fields->nohp,
                "alamat" => $Fields->alamat,
                "username" => $Fields->username,
                "status" => $Fields->status,
                "id_jabatan" => $Fields->id_jabatan,
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Petugas Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

    /*
     * Master Penduduk
     */

    public function penduduk() {
        $data['nama_menu'] = "Penduduk";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/penduduk_v', $data);
    }

    function do_Tabel_Penduduk() {

        $records["aaData"] = array();
        $aColumns = array('id_penduduk', 'nama_penduduk');
        //default
        $sort = "id_penduduk";
        $dir = "asc";
        $criteria = "upper(nama_penduduk)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Penduduk_m->getCountPenduduk($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Penduduk_m->getPenduduk($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->nik,
                    $Fields->nama_penduduk,
                    $Fields->nama_kecamatan,
                    $Fields->nama_kelurahan,
                    $Fields->nohp,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_penduduk . '" data-name="' . $Fields->nama_penduduk . '" class="btn btn-xs yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_penduduk . '" data-name="' . $Fields->nama_penduduk . '" class="btn btn-xs btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Penduduk() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_penduduk = ($this->input->post("id_penduduk") != "") ? $this->input->post("id_penduduk") : "";
        $nik = ($this->input->post("nik") != "") ? $this->input->post("nik") : "";
        $nama_penduduk = ($this->input->post("nama_penduduk") != "") ? $this->input->post("nama_penduduk") : "";
        $tempat_lahir = ($this->input->post("tempat_lahir") != "") ? $this->input->post("tempat_lahir") : "";
        $tgl_lahir = ($this->input->post("tgl_lahir") != "") ? $this->input->post("tgl_lahir") : "";
        $alamat = ($this->input->post("alamat") != "") ? $this->input->post("alamat") : "";
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : "";
        $nohp = ($this->input->post("nohp") != "") ? $this->input->post("nohp") : "";
        $status = ($this->input->post("status") != "") ? $this->input->post("status") : "";

        if ($mode_form == "Tambah") {
            if ($this->Penduduk_m->Chek_Data("", $nik) == 0) {
                $this->Penduduk_m->insert($nik, $nama_penduduk, $tempat_lahir, $tgl_lahir, $alamat, $id_kecamatan, $id_kelurahan, $nohp, $status);
            } else {
                $error = "Maaf, Data Penduduk Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Penduduk_m->Chek_Data($id_penduduk) > 0) {
                $this->Penduduk_m->update($id_penduduk, $nik, $nama_penduduk, $tempat_lahir, $tgl_lahir, $alamat, $id_kecamatan, $id_kelurahan, $nohp, $status);
            } else {
                $error = "Maaf, Data Penduduk Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Penduduk Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Penduduk Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Penduduk() {
        $id_penduduk = ($this->input->post("id_penduduk") != "") ? $this->input->post("id_penduduk") : "";
        $this->Penduduk_m->delete($id_penduduk);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Penduduk Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Penduduk Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Penduduk() {
        $return = array();
        $itemList = array();
        $id_penduduk = ($this->input->post("id_penduduk") != "") ? $this->input->post("id_penduduk") : "";
        if ($this->Penduduk_m->Chek_Data($id_penduduk) > 0) {
            $Fields = $this->Penduduk_m->List_Data($id_penduduk);
            $item = array(
                "mode_form" => "Ubah",
                "id_penduduk" => $Fields->id_penduduk,
                "nik" => $Fields->nik,
                "nama_penduduk" => $Fields->nama_penduduk,
                "tempat_lahir" => $Fields->tempat_lahir,
                "tgl_lahir" => date_format(date_create($Fields->tgl_lahir), 'd-m-Y'),
                "alamat" => $Fields->alamat,
                "id_kecamatan" => $Fields->id_kecamatan,
                "id_kelurahan" => $Fields->id_kelurahan,
                "nohp" => $Fields->nohp,
                "status" => $Fields->status
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Penduduk Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

    function do_cari_Kelurahan() {

        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";

        $this->db->from("m_kecamatan a");
        $this->db->join("m_kelurahan b", "b.id_kecamatan=a.id_kecamatan", "left");
        $this->db->where("b.id_kecamatan", $id_kecamatan);
        $this->db->order_by('b.nama_kelurahan', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $Fields) {
                $item = array(
                    "id_kelurahan" => $Fields->id_kelurahan,
                    "nama_kelurahan" => $Fields->nama_kelurahan
                );
                $itemList[] = $item;
            }
            $return["success"] = TRUE;
            $return["results"] = $itemList;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Kelurahan Tidak Ditemukan.";
        }
        echo json_encode($return);
    }

    /*
     * Master Kecamatan
     */

    public function kecamatan() {
        $data['nama_menu'] = "Kecamatan";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/kecamatan_v', $data);
    }

    function do_Tabel_Kecamatan() {

        $records["aaData"] = array();
        $aColumns = array('id_kecamatan', 'nama_kecamatan', 'warna');
        //default
        $sort = "id_kecamatan";
        $dir = "asc";
        $criteria = "upper(nama_kecamatan || warna)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Kecamatan_m->getCountKecamatan($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Kecamatan_m->getKecamatan($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->nama_kecamatan,
                    $Fields->warna,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_kecamatan . '" data-name="' . $Fields->nama_kecamatan . '" class="btn btn-sm yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_kecamatan . '" data-name="' . $Fields->nama_kecamatan . '" class="btn btn-sm btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Kecamatan() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $nama_kecamatan = ($this->input->post("nama_kecamatan") != "") ? $this->input->post("nama_kecamatan") : "";
        $maps_poly = ($this->input->post("maps_poly") != "") ? $this->input->post("maps_poly") : "";
        $warna = ($this->input->post("warna") != "") ? $this->input->post("warna") : "";

        if ($mode_form == "Tambah") {
            if ($this->Kecamatan_m->Chek_Data("", $nama_kecamatan) == 0) {
                $this->Kecamatan_m->insert($nama_kecamatan, $maps_poly, $warna);
            } else {
                $error = "Maaf, Data Kecamatan Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Kecamatan_m->Chek_Data($id_kecamatan) > 0) {
                $this->Kecamatan_m->update($id_kecamatan, $nama_kecamatan, $maps_poly, $warna);
            } else {
                $error = "Maaf, Data Kecamatan Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Kecamatan Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Kecamatan Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Kecamatan() {
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $this->Kecamatan_m->delete($id_kecamatan);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Kecamatan Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Kecamatan Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Kecamatan() {
        $return = array();
        $itemList = array();
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        if ($this->Kecamatan_m->Chek_Data($id_kecamatan) > 0) {
            $Fields = $this->Kecamatan_m->List_Data($id_kecamatan);
            $item = array(
                "mode_form" => "Ubah",
                "id_kecamatan" => $Fields->id_kecamatan,
                "nama_kecamatan" => $Fields->nama_kecamatan,
                "maps_poly" => $Fields->maps_poly,
                "warna" => $Fields->warna
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Kecamatan Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

    /*
     * Master Kelurahan
     */

    public function kelurahan() {
        $data['nama_menu'] = "Kelurahan";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/kelurahan_v', $data);
    }

    function do_Tabel_Kelurahan() {

        $records["aaData"] = array();
        $aColumns = array('id_kelurahan', 'nama_kelurahan', 'nama_kecamatan', 'warna');
        //default
        $sort = "id_kelurahan";
        $dir = "asc";
        $criteria = "upper(nama_kelurahan || warna || nama_kecamatan)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Kelurahan_m->getCountKelurahan($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Kelurahan_m->getKelurahan($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->nama_kecamatan,
                    $Fields->nama_kelurahan,
                    $Fields->warna,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_kelurahan . '" data-name="' . $Fields->nama_kelurahan . '" class="btn btn-sm yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_kelurahan . '" data-name="' . $Fields->nama_kelurahan . '" class="btn btn-sm btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Kelurahan() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : "";
        $id_kecamatan = ($this->input->post("id_kecamatan") != "") ? $this->input->post("id_kecamatan") : "";
        $nama_kelurahan = ($this->input->post("nama_kelurahan") != "") ? $this->input->post("nama_kelurahan") : "";
        $maps_poly = ($this->input->post("maps_poly") != "") ? $this->input->post("maps_poly") : "";
        $warna = ($this->input->post("warna") != "") ? $this->input->post("warna") : "";

        if ($mode_form == "Tambah") {
            if ($this->Kelurahan_m->Chek_Data("", $nama_kelurahan, $id_kecamatan) == 0) {
                $this->Kelurahan_m->insert($nama_kelurahan, $maps_poly, $warna, $id_kecamatan);
            } else {
                $error = "Maaf, Data Kelurahan Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Kelurahan_m->Chek_Data($id_kelurahan) > 0) {
                $this->Kelurahan_m->update($id_kelurahan, $nama_kelurahan, $maps_poly, $warna, $id_kecamatan);
            } else {
                $error = "Maaf, Data Kelurahan Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Kelurahan Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Kelurahan Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Kelurahan() {
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : "";
        $this->Kelurahan_m->delete($id_kelurahan);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Kelurahan Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Kelurahan Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Kelurahan() {
        $return = array();
        $itemList = array();
        $id_kelurahan = ($this->input->post("id_kelurahan") != "") ? $this->input->post("id_kelurahan") : "";
        if ($this->Kelurahan_m->Chek_Data($id_kelurahan) > 0) {
            $Fields = $this->Kelurahan_m->List_Data($id_kelurahan);
            $item = array(
                "mode_form" => "Ubah",
                "id_kelurahan" => $Fields->id_kelurahan,
                "id_kecamatan" => $Fields->id_kecamatan,
                "nama_kelurahan" => $Fields->nama_kelurahan,
                "maps_poly" => $Fields->maps_poly,
                "warna" => $Fields->warna
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Kelurahan Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

    /*
     * Master Kekerasan
     */

    public function kekerasan() {
        $data['nama_menu'] = "Kekerasan";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $this->parser->parse('master/kekerasan_v', $data);
    }

    function do_Tabel_Kekerasan() {

        $records["aaData"] = array();
        $aColumns = array('id_kekerasan', 'nama_kekerasan');
        //default
        $sort = "id_kekerasan";
        $dir = "asc";
        $criteria = "upper(nama_kekerasan)";

        $sSearch = ($this->input->post("sSearch") != "") ? strtoupper(quotes_to_entities($this->input->post("sSearch"))) : "";
        $iDisplayLength = ($this->input->post("iDisplayLength") != "") ? $this->input->post("iDisplayLength") : "";
        $iDisplayStart = ($this->input->post("iDisplayStart") != "") ? $this->input->post("iDisplayStart") : "";
        $sEcho = ($this->input->post("sEcho") != "") ? $this->input->post("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($this->input->post("iSortCol_0") != "") ? $this->input->post("iSortCol_0") : "";
        $iSortingCols = ($this->input->post("iSortingCols") != "") ? $this->input->post("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($this->input->post('iSortCol_' . $i))];
                $dir = ($this->input->post('sSortDir_' . $i) != "") ? $this->input->post('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->Kekerasan_m->getCountKekerasan($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->Kekerasan_m->getKekerasan($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if ($query->num_rows() > 0) {
            $no = $iDisplayStart;
            foreach ($query->result() as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    '<center>' . $no . '.</center>',
                    $Fields->nama_kekerasan,
                    '<center><a href="javascript:;" data-id="' . $Fields->id_kekerasan . '" data-name="' . $Fields->nama_kekerasan . '" class="btn btn-sm yellow btn-circle btn-editable"><i class="fa fa-pencil"></i> Ubah</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id_kekerasan . '" data-name="' . $Fields->nama_kekerasan . '" class="btn btn-sm btn-circle red btn-removable"><i class="fa fa-times"></i> Hapus</a></center>');
            }
        }
        echo json_encode($records);
    }

    function do_Simpan_Kekerasan() {
        $return = array();
        $error = "";

        $mode_form = ($this->input->post("mode_form") != "") ? $this->input->post("mode_form") : "";
        $id_kekerasan = ($this->input->post("id_kekerasan") != "") ? $this->input->post("id_kekerasan") : "";
        $nama_kekerasan = ($this->input->post("nama_kekerasan") != "") ? $this->input->post("nama_kekerasan") : "";

        if ($mode_form == "Tambah") {
            if ($this->Kekerasan_m->Chek_Data("", $nama_kekerasan) == 0) {
                $this->Kekerasan_m->insert($nama_kekerasan);
            } else {
                $error = "Maaf, Data Kekerasan Sudah ada. !!!";
            }
        } else if ($mode_form == "Ubah") {
            if ($this->Kekerasan_m->Chek_Data($id_kekerasan) > 0) {
                $this->Kekerasan_m->update($id_kekerasan, $nama_kekerasan);
            } else {
                $error = "Maaf, Data Kekerasan Tidak ditemukan. !!!";
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $return["msgServer"] = "Simpan Data Kekerasan Gagal. !!!";
            $return["success"] = FALSE;
        } else {
            if ($error != "") {
                $return["msgServer"] = $error;
                $return["success"] = FALSE;
            } else {
                $return["msgServer"] = "Simpan Data Kekerasan Berhasil.";
                $return["success"] = TRUE;
            }
        }

        echo json_encode($return);
    }

    function do_Hapus_Kekerasan() {
        $id_kekerasan = ($this->input->post("id_kekerasan") != "") ? $this->input->post("id_kekerasan") : "";
        $this->Kekerasan_m->delete($id_kekerasan);
        if ($this->db->trans_status() === false) {
            $return["msgServer"] = "Maaf, Hapus Data Kekerasan Gagal.";
            $return["success"] = false;
        } else {
            $return["msgServer"] = "Hapus Data Kekerasan Berhasil.";
            $return["success"] = true;
        }

        echo json_encode($return);
    }

    function do_Ubah_Kekerasan() {
        $return = array();
        $itemList = array();
        $id_kekerasan = ($this->input->post("id_kekerasan") != "") ? $this->input->post("id_kekerasan") : "";
        if ($this->Kekerasan_m->Chek_Data($id_kekerasan) > 0) {
            $Fields = $this->Kekerasan_m->List_Data($id_kekerasan);
            $item = array(
                "mode_form" => "Ubah",
                "id_kekerasan" => $Fields->id_kekerasan,
                "nama_kekerasan" => $Fields->nama_kekerasan
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Maaf, Data Kekerasan Tidak Ditemukan.";
        }

        echo json_encode($return);
    }

}
