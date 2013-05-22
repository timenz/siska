<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_dosen extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'dosen/';
    }


    function list_dosen(){
        $rows = out_where("select a.id as id, a.nid as nid, b.nama as nama, b.alamat as alamat, b.jenis_kelamin as jenis_kelamin, b.telp as telp
                from dosen as a, karyawan as b where a.karyawan_id = b.id limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_dosen/form_edit_dosen/'.int2kal($row->id).'">edit</a></div>';
            $konten[] = array($no, $row->nid, $row->nama, $row->alamat, $row->jenis_kelamin, $row->telp, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'NID', 'Nama Dosen', 'Alamat', 'Jenis Kelamin', 'No Telp', '#'),
            'konten' => $konten,
            'page_title' => 'Listing Dosen',
            'link_add' => array('name' => 'Tambah Dosen', 'link' => base_index().'admin/admin_dosen/form_add_dosen')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_dosen(){
        $array = array(
            'row_fakultas' => out_where('fakultas', array()),
            'row_prodi' => out_where('programstudi', array()),
            'row_karyawan' => out_where('karyawan', array()),
            'page_title' => 'Form Tambah dosen',
            'action' => base_index().'admin/admin_dosen/add_dosen'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_dosen', $array, true);
    }

    function add_dosen(){
        $array = array(
            'nid' => $this->input->post('nid'),
            'karyawan_id' => $this->input->post('karyawan_id'),
            'programstudi_kode' => $this->input->post('programstudi_kode'),
            'fakultas_kode' => $this->input->post('fakultas_kode')
        );

        $this->db->insert('dosen', $array);
        redirect(base_index().'admin/admin_dosen/list_dosen');
    }

    function form_edit_dosen(){
        $id = kal2int(mysql_real_escape_string(urinext('form_edit_dosen')));
        $row = out_row("select * from dosen where id = ".$id);

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_dosen/list_dosen');}

        $array = array(
            'page_title' => 'Form Edit Dosen',
            'id' => $row->id,
            'fakultas_kode' => $row->fakultas_kode,
            'programstudi_kode' => $row->programstudi_kode,
            'karyawan_id' => $row->karyawan_id,
            'nid' => $row->nid,
            'row_fakultas' => out_where('fakultas', array()),
            'row_prodi' => out_where('programstudi', array()),
            'row_karyawan' => out_where('karyawan', array()),
            'action' => base_index().'admin/admin_dosen/edit_dosen',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_dosen', $array, true);
    }

    function edit_dosen(){
        $id = mysql_real_escape_string($this->input->post('id'));
        if($id < 1){redirect(base_index().'admin/admin_dosen/list_dosen');}

        $array = array(
            'id' => $this->input->post('id'),
            'nid' => $this->input->post('nid'),
            'karyawan_id' => $this->input->post('karyawan_id'),
            'programstudi_kode' => $this->input->post('programstudi_kode'),
            'fakultas_kode' => $this->input->post('fakultas_kode')
        );

        $this->db->update('dosen', $array, array('id' => $id));
        redirect(base_index().'admin/admin_dosen/list_dosen');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
