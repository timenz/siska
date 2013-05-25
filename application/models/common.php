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
        $this->page->title = 'Buku Tamu';
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
        );
        $this->page->konten = $this->parser->parse($this->view_dir.'contact_us2', $array, true);
    }

    function list_pesan_bukutamu(){
        $row = out_where("select * from bukutamu where is_publish = '1' order by tgl_posting desc, id desc limit 10");
        $array = array(

            'row_bukutamu' => $row
        );

        exit($this->parser->parse($this->view_dir.'list_bukutamu', $array));
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
