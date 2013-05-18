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

    function contact_us(){
        $this->page->title = 'Hubungi Kami';
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url
        );
        $this->page->konten = $this->parser->parse($this->view_dir.'contact_us2', $array, true);
    }

    function get_listkota(){
        $out = array('valid' => false);
        $id = mysql_real_escape_string($this->input->post('propinsi'));
        $row = out_where('geo_kotakab', array('propinsi_id' => $id));

        if(count($row) > 0){
            $out = array(
                'valid' => true,
                'konten' => $row
            );
        }
        $this->page->konten = $out;
    }


    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
