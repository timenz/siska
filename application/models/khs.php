<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class khs extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'khs/';

    }

    function list_nilai(){
        $this->page->set_sidebar = true;
        $this->page->konten = $this->parser->parse($this->views_dir.'list_nilai', array(), true);
    }
}