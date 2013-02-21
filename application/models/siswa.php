<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class siswa extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'siswa/';
        
    }
    function is_login(){
        $id = $this->session->userdata('id_siswa');
        if(strlen($id) < 1){
            return false;
        }
        
        $row = out_row('siswa', array('id' => $id));
        if(count($row) > 0){
            $this->page->data_siswa = $row;
            return true;
        }
        return false;
    }
    
    function login_form(){
        //$array = array();
        //$login_form = $this->parser->parse($this->views_dir.'login_form', $array, true);
        $this->page->title = 'Halaman Login Siswa';
        $this->page->konten = '';
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
