<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class penjadwalan extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'penjadwalan/';

    }

    function input_krs(){
        $this->page->set_sidebar = true;
        $row = $this->page->data_siswa;

        $y = date('Y');
        $m = date('m');
        $smt = 'genap';
        if($m < 7){
            $smt = 'ganjil';
        }

        $kal_aka = out_row("select*from kalender_akademik where semester = ".$smt." and tahun_akademik = ".$y."");
        if(count($kal_aka) < 1){
            $array = array('title' => 'Error', 'pesan' => 'Belum waktunya pengisian KRS');
            $this->page->konten = $this->parser->parse($this->page->tpl.'message', $array, true);
            return;
        }
        $smt_no = 1;
        $last_smt = out_row("select b.* from mahasiswa a, jadwal_mahasiswa b, kalendar_akademik c where a.id = b.mahasiswa_id and b.kalendar_akademik_id = c.id and  a.id =  ".$row->id."");
        if(count($last_smt) > 0){

        }
        $array = array('title' => 'Error', 'pesan' => 'Belum waktunya pengisian KRS');
        $this->page->konten = $this->parser->parse($this->page->tpl.'message', $array, true);

        //$this->page->konten = $this->parser->parse($this->views_dir.'input_krs', array(), true);
    }
}