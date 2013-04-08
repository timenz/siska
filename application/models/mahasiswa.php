<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class mahasiswa extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'alumni_bukutamu/';
        
    }
    function is_login(){
        $id = $this->session->userdata('id_mahasiswa');
        if(strlen($id) < 1){
            return false;
        }
        
        $row = out_row('mahasiswa', array('id' => $id));
        if(count($row) > 0){
            $this->page->data_siswa = $row;
            $this->page->web_mode = 'mahasiswa';
            return true;
        }
        return false;
    }
    
    function login_form(){
        $array = array();
        $this->page->title = 'Halaman Login Siswa';
        $this->page->konten = $this->parser->parse($this->views_dir.'form_login', $array, true);
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
