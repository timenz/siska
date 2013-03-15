<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_common extends CI_Model {
    public function __construct() {
        parent::__construct();
        
    }
    
    function homepage(){
        $this->page->title = 'Home Sistem Akademik';
        $this->page->konten = 'Welcome';

        if(!$this->user->is_login()){

        }

    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
