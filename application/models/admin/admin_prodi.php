<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_prodi extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'prodi/';
    }


    function list_prodi(){
        $rows = out_where("select a.kode as kode, a.nama as prodi, b.nama as fakultas from programstudi as a,
            fakultas as b where a.fakultas_kode = b.kode limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_prodi/form_edit_prodi/'.$row->kode.'">edit</a></div>';
            $konten[] = array($no, $row->kode, $row->prodi, $row->fakultas, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Kode Prodi', 'Nama Prodi', 'Fakultas', '#'),
            'konten' => $konten,
            'page_title' => 'Listing Prodi',
            'link_add' => array('name' => 'Tambah Prodi', 'link' => base_index().'admin/admin_prodi/form_add_prodi')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_prodi(){
        $array = array(
            'page_title' => 'Form Tambah Prodi',
            'row_fakultas' => out_where('fakultas', array()),
            'action' => base_index().'admin/admin_prodi/add_prodi'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_prodi', $array, true);
    }

    function add_prodi(){
        $array = array(
            'kode' => $this->input->post('kode'),
            'fakultas_kode' => $this->input->post('fakultas_kode'),
            'nama' => $this->input->post('nama')
        );

        $this->db->insert('programstudi', $array);
        redirect(base_index().'admin/admin_prodi/list_prodi');
    }

    function form_edit_prodi(){
        $id = mysql_real_escape_string(urinext('form_edit_prodi'));
        $row = out_row("select * from programstudi where kode = '".$id."'");

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_prodi/list_prodi');}

        $array = array(
            'page_title' => 'Form Edit Prodi',
            'kode' => $row->kode,
            'nama' => $row->nama,
            'fakultas_kode' => $row->fakultas_kode,
            'row_fakultas' => out_where('fakultas', array()),
            'action' => base_index().'admin/admin_prodi/edit_prodi',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_prodi', $array, true);
    }

    function edit_prodi(){
        if($id = mysql_real_escape_string($this->input->post('kode'))){
            $array = array(
                'kode' => $this->input->post('kode'),
                'fakultas_kode' => $this->input->post('fakultas_kode'),
                'nama' => $this->input->post('nama'),

            );

            $this->db->update('programstudi', $array, array('kode' => $id));
        }
        redirect(base_index().'admin/admin_prodi/list_prodi');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
