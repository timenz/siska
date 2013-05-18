<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_buku_tamu extends CI_Model {
    public function __construct() {
        parent::__construct();

    }

    function homepage(){
        $this->page->title = 'Home Sistem Akademik';
        $array = array(

        );

        $this->page->konten = $this->parser->parse($this->page->tpl.'dashboard', $array, true);


    }

    function list_buku_tamu(){
        $rows = out_where("select a.* from buku_tamu a order by id limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/user/admin_buku_tamu/edi_buku_tamu'.int2kal($row->id).'">edit</a></div>';
            $konten[] = array($no, $row->username, $row->role, $link);
            $no++;
        }

        $array = array(
            'heading' => array('', 'Tgl Posting', 'Nama', 'Email', 'Subject', 'Sudah Dibaca', 'Sudah Dibalas'),
            'konten' => $konten,
            'page_title' => 'Listing Buku Tamu',
            'link_add' => array('name' => 'Tambah User', 'link' => base_index().'admin/user/form_add_user')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
