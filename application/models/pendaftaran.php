<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class pendaftaran extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'pendaftaran/';

    }

    function info_pendaftaran(){
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
            'base_index' => base_index()
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'info_pendaftaran', $array, true);
    }

    function form_pendaftaran(){
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
            'base_index' => base_index()
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'form_pendaftaran', $array, true);
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
