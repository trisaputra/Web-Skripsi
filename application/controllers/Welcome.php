<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->Layout_m->Check_Login();
    }

    public function index() {
        $data['nama_menu'] = "Home";

        $data['setMeta'] = $this->Layout_m->setMeta($data['nama_menu']);
        $data['setHeader'] = $this->Layout_m->setHeader();
        $data['setMenu'] = $this->Layout_m->setMenu();
        $data['setFooter'] = $this->Layout_m->setFooter();
        $data['setJS'] = $this->Layout_m->setJS();

        $data['jmlKejadian'] = number_format($this->Layout_m->getJmlKejadian());
        $data['jmlSelesai'] = number_format($this->Layout_m->getJmlSelesai());
        $data['jmlPetugas'] = number_format($this->Layout_m->getJmlPetugas());
        $data['jmlPenduduk'] = number_format($this->Layout_m->getJmlPenduduk());
        
        $data['mstPenanganan'] = $this->Layout_m->getMstPenanganan();

        $this->parser->parse('home_v', $data);
    }

}
