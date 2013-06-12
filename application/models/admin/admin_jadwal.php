<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_jadwal extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'jadwal/';
    }

    function search(){
        $this->page->title = 'HALAMAN PENCARIAN MAHASISWA';
        $array=array();
        $this->page->konten = $this->parser->parse($this->views_dir.'search', $array, true);
    }

    function urutan(){
        $this->page->title = 'HALAMAN LIST MAHASISWA';
        $array=array();
        $this->page->konten = $this->parser->parse($this->views_dir.'urutan', $array, true);
    }

    function print_krs(){
        $this->page->title = 'HALAMAN PRINT KRS';
        $array=array();
        $this->page->konten = $this->parser->parse($this->views_dir.'print_krs', $array, true);
    }
}