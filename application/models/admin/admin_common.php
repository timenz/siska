<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_common extends CI_Model {
    public function __construct() {
        parent::__construct();
        
    }
    
    function homepage(){
        $this->page->title = 'Home Sistem Akademik';
        $array = array(

        );

        $this->page->konten = $this->parser->parse($this->page->tpl.'dashboard', $array, true);


    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
