<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class common extends CI_Model {
    public function __construct() {
        parent::__construct();
        
    }
    
    function homepage(){
        $this->page->title = 'Home Sistem Akademik';
        //$this->page->konten = '';
        $this->load->model('buku_tamu');
        $this->buku_tamu->form_buku_tamu();
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
