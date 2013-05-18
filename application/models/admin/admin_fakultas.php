<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_fakultas extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'fakultas/';
    }


    function list_fakultas(){
        $rows = out_where("select * from fakultas limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_fakultas/form_edit_fakultas/'.$row->kode.'">edit</a></div>';
            $konten[] = array($no, $row->kode, $row->nama, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Kode Fakultas', 'Nama Fakultas', '#'),
            'konten' => $konten,
            'page_title' => 'Listing Fakultas',
            'link_add' => array('name' => 'Tambah Fakultas', 'link' => base_index().'admin/admin_fakultas/form_add_fakultas')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_fakultas(){
        $array = array(
            'page_title' => 'Form Tambah Fakultas',
            'action' => base_index().'admin/admin_fakultas/add_fakultas'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_fakultas', $array, true);
    }

    function add_fakultas(){
        $array = array(
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama')
        );

        $this->db->insert('fakultas', $array);
        redirect(base_index().'admin/admin_fakultas/list_fakultas');
    }

    function form_edit_fakultas(){
        $id = mysql_real_escape_string(urinext('form_edit_fakultas'));
        $row = out_row("select * from fakultas where kode = '".$id."'");

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_fakultas/list_fakultas');}

        $array = array(
            'page_title' => 'Form Edit Fakultas',
            'kode' => $row->kode,
            'nama' => $row->nama,
            'action' => base_index().'admin/admin_fakultas/edit_fakultas',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_fakultas', $array, true);
    }

    function edit_fakultas(){
        if($id = mysql_real_escape_string($this->input->post('kode'))){

            $array = array(
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama')
            );

            $this->db->update('fakultas', $array, array('kode' => $array['kode']));
        }
        redirect(base_index().'admin/admin_fakultas/list_fakultas');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
