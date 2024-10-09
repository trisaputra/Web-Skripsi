<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout_m extends CI_Model {

    function setMeta($title = "") {
        $text = '<head>
                    <meta charset="utf-8" />
                    <title>' . $title . ' | Aplikasi Emergency Call Kasus Kekerasan Pada Perempuan dan Anak Berbasis Android</title>
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta content="width=device-width, initial-scale=1" name="viewport" />
                    <meta content="" name="description" />
                    <meta content="" name="author" />
                    <link href="' . base_url() . 'assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
                    <link href="' . base_url() . 'assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
                    <link href="' . base_url() . 'assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                    <link href="' . base_url() . 'assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
                    <link href="' . base_url() . 'assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
                    <link href="' . base_url() . 'assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
                    <link href="' . base_url() . 'assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
                    <link href="' . base_url() . 'assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
                    <link href="' . base_url() . 'assets/layouts/layout2/css/themes/dark.min.css" rel="stylesheet" type="text/css" id="style_color" />
                    <link href="' . base_url() . 'assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
                    <link rel="shortcut icon" href="' . base_url() . 'assets/global/img/logo_surabaya.png" /> 
                </head>';
        return $text;
    }

    function setHeader() {
        $text = '<div class="page-header navbar navbar-fixed-top">
                    <div class="page-header-inner ">
                        <div class="page-logo">
                            <a href="' . site_url() . 'welcome">
                                <!--img src="' . base_url() . 'assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /-->
                            </a>
                            <div class="menu-toggler sidebar-toggler">
                            </div>
                        </div>
                        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                        <div class="page-top">
                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <li class="dropdown dropdown-user">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <span class="username username-hide-on-mobile"> ' . $this->session->userdata('nama_petugas') . ' ( ' . $this->session->userdata('nama_jabatan') . ' ) </span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-default">
                                            <!--li>
                                                <a href="page_user_profile_1.html">
                                                    <i class="icon-user"></i> My Profile </a>
                                            </li-->
                                            <li>
                                                <a href="' . site_url() . 'login/do_Logout">
                                                    <i class="icon-key"></i> Log Out </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>';
        return $text;
    }

    function setMenu() {
        $text = '<div class="page-sidebar-wrapper">
                    <div class="page-sidebar navbar-collapse collapse">
                        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li id="mn_home" class="nav-item">
                                <a href="' . site_url() . 'welcome" >
                                    <i class="fa fa-home"></i>
                                    <span class="title">Home</span>
                                </a>
                            </li>
                            <li id="mn_master" class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-gears"></i>
                                    <span class="title">Setting</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li id="mnm_petugas" class="nav-item">
                                        <a href="' . site_url() . 'master/petugas" class="nav-link ">
                                            <i class="fa fa-users"></i>
                                            <span class="title">Petugas</span>
                                        </a>
                                    </li>
                                    <li id="mnm_penduduk" class="nav-item">
                                        <a href="' . site_url() . 'master/penduduk" class="nav-link ">
                                            <i class="fa fa-user-secret"></i>
                                            <span class="title">Data Penduduk</span>
                                        </a>
                                    </li>
                                    <li id="mnm_kekerasan" class="nav-item ">
                                        <a href="' . site_url() . 'master/kekerasan" class="nav-link ">
                                            <i class="fa fa-houzz"></i>
                                            <span class="title">Kekerasan</span>
                                        </a>
                                    </li>
                                    <li id="mnm_jabatan" class="nav-item ">
                                        <a href="' . site_url() . 'master/jabatan" class="nav-link ">
                                            <i class="fa fa-shield"></i>
                                            <span class="title">Jabatan</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li id="mn_master_kordinat" class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-map-marker"></i>
                                    <span class="title">Master Kordinat</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li id="mnm_kecamatan" class="nav-item">
                                        <a href="' . site_url() . 'master/kecamatan" class="nav-link ">
                                            <i class="fa fa-university"></i>
                                            <span class="title">Kacamatan</span>
                                        </a>
                                    </li>
                                    <li id="mnm_kelurahan" class="nav-item ">
                                        <a href="' . site_url() . 'master/kelurahan" class="nav-link ">
                                            <i class="fa fa-home"></i>
                                            <span class="title">Kelurahan</span>
                                        </a>
                                    </li>
                                    <li id="mnm_polsek" class="nav-item ">
                                        <a href="' . site_url() . 'master/polsek" class="nav-link ">
                                            <i class="fa fa-institution"></i>
                                            <span class="title">Polsek</span>
                                        </a>
                                    </li>
                                    <li id="mnm_puskesmas" class="nav-item ">
                                        <a href="' . site_url() . 'master/puskesmas" class="nav-link ">
                                            <i class="fa fa-hospital-o"></i>
                                            <span class="title">Puskesmas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item" id="mn_laporan">
                                <a href="' . site_url() . 'laporan" class="nav-link nav-toggle">
                                    <i class="fa fa-book"></i>
                                    <span class="title">Laporan Kejadian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>';
        return $text;
    }

    function setFooter() {
        $text = '<div class="page-footer">
                    <div class="page-footer-inner"> 2020 &copy; Aplikasi Emergency Call Kasus Kekerasan Pada Perempuan dan Anak Berbasis Android.</div>
                    <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
                    </div>
                </div>';
        return $text;
    }

    function setJS() {
        $text = '<script src="' . base_url() . 'assets/global/plugins/jquery.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/moment.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/scripts/app.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>';
        return $text;
    }

    function Check_Login() {
        $logged = $this->session->userdata("logged");
        if ($logged == FALSE) {
            redirect(site_url(), "refresh");
        } else {
            
        }
    }

    function Check_Logout() {
        $this->session->sess_destroy();
        redirect(site_url(), "refresh");
    }

    function getJmlKejadian() {
        $thnSkrang = date("Y");
        $Sql = $this->db->query("select * from t_kejadian where to_char(tgl_int, 'yyyy')='" . $thnSkrang . "'");
        return $Sql->num_rows();
    }

    function getJmlSelesai() {
        $thnSkrang = date("Y");
        $Sql = $this->db->query("select * from t_kejadian where to_char(tgl_int, 'yyyy')='" . $thnSkrang . "' and st_kejadian=true");
        return $Sql->num_rows();
    }

    function getJmlPetugas() {
        $Sql = $this->db->query("select * from m_petugas");
        return $Sql->num_rows();
    }

    function getJmlPenduduk() {
        $Sql = $this->db->query("select * from m_penduduk");
        return $Sql->num_rows();
    }

    function getMstPenanganan() {
        $Sql = $this->db->query("select * from m_penanganan");
        return $Sql->result();
    }

    function getDataPenanganan($id_penanganan = "") {
        $Sql = $this->db->query("select * from t_kejadian where to_char(tgl_int, 'yyyy')='" . date('Y') . "' and  id_penanganan=" . $id_penanganan);
        return $Sql->num_rows();
    }

    function getData($tgl_sekarang = "", $tgl_awal = "", $tgl_akhir = "", $tahun = "") {
        $Query = "select a.*, to_char(a.tgl_int, 'dd-mm-yyyy') as tgl_kejadian, b.nama_penduduk, b.alamat as alamat_user, c.nama_kecamatan as nama_kecamatan_user, d.nama_kelurahan as nama_kelurahan_user, e.nama_kecamatan as nama_kecamatan_laporan, f.nama_kelurahan as nama_kelurahan_laporan, h.nama_kekerasan, g.nama_jenis_user from t_kejadian a 
                left join m_penduduk b on a.id_penduduk=b.id_penduduk
                left join m_kecamatan c on b.id_kecamatan=c.id_kecamatan
                left join m_kelurahan d on b.id_kelurahan=d.id_kelurahan
                left join m_kecamatan e on a.id_kecamatan=e.id_kecamatan
                left join m_kelurahan f on a.id_kelurahan=f.id_kelurahan
                left join m_jenis_user g on a.id_jenis_user=g.id_jenis_user
                left join m_kekerasan h on a.id_kekerasan=h.id_kekerasan";
        if ($tgl_sekarang != "") {
            $Query .= " where to_char(a.tgl_int, 'dd-mm-yyyy') = '" . $tgl_sekarang . "'";
        } elseif ($tgl_awal != "" && $tgl_akhir != "") {
            $Query .= " where to_char(a.tgl_int, 'yyyy-mm-dd')::date between '" . date_format(date_create($tgl_awal), 'Y-m-d') . "' and '" . date_format(date_create($tgl_akhir), 'Y-m-d') . "'";
        } else {
            $Query .= " where to_char(a.tgl_int, 'yyyy') = '" . $tahun . "'";
        }
        $Query .= " order by id_kejadian desc";
        $Sql = $this->db->query($Query);
        return $Sql;
    }

}
