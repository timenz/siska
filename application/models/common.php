<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class common extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->view_dir = $this->page->tpl.'common/';
    }
    
    function homepage(){
        $this->page->title = 'Home Sistem Akademik';
        $this->page->set_slider = true;
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url
        );
        $this->page->konten = $this->parser->parse($this->view_dir.'homepage', $array, true);
        //$this->buku_tamu->form_buku_tamu();
    }

    function about_us(){
        $this->page->title = 'Tentang Kami';
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url
        );
        $this->page->konten = $this->parser->parse($this->view_dir.'about_us', $array, true);
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
