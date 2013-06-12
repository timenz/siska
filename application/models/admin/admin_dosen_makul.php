<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_dosen_makul extends CI_Model {

    var $matakuliah_id;

    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'dosen_makul/';
    }

    function list_dosen_makul(){
        $where_makul = '';
        $id_user = $this->session->userdata('id_user');
        $userdata = out_row("select b.id as makul_id
            from web_user as a, matakuliah as b, dosen as c
            where a.id_karyawan = c.karyawan_id and b.dosenkoordinator_id = c.id and a.id = $id_user ");

        if($this->matakuliah_id = $userdata->makul_id){
            $where_makul = "and d.id = $this->matakuliah_id";
        }
        $rows = out_where("select c.id as id, a.nip as nip, b.nama as nama, d.nama as matakuliah, c.sks as sks
                from dosen as a, karyawan as b, matkul_dosen as c, matakuliah as d
                where a.karyawan_id = b.id and a.id = c.dosen_id and c.matakuliah_id = d.id ".$where_makul."
                limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_dosen_makul/form_edit_dosen_makul/'.int2kal($row->id).'">edit</a></div>';
            $konten[] = array($no, $row->nip, $row->nama, $row->matakuliah, $row->sks, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'NIP', 'Nama Dosen', 'Mata Kulian', 'SKS', '#'),
            'konten' => $konten,
            'page_title' => 'Listing Dosen',
            'link_add' => array('name' => 'Tambah Dosen', 'link' => base_index().'admin/admin_dosen_makul/form_add_dosen_makul')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_dosen_makul(){
        $id_user = $this->session->userdata('id_user');
        $userdata = out_row("select b.id as makul_id
            from web_user as a, matakuliah as b, dosen as c
            where a.id_karyawan = c.karyawan_id and b.dosenkoordinator_id = c.id and a.id = $id_user ");
        $array = array(
            'matakuliah_id' => $userdata->makul_id,
            'row_dosen' => out_where('select a.id as id, b.nama as nama from dosen as a, karyawan as b where a.karyawan_id = b.id', array()),
            'page_title' => 'Form Tambah dosen',
            'action' => base_index().'admin/admin_dosen_makul/add_dosen_makul'
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_dosen_makul', $array, true);
    }

    function add_dosen_makul(){
        $array = array(
            'matakuliah_id' => $this->input->post('matakuliah_id'),
            'dosen_id' => $this->input->post('dosen_id'),
            'sks' => $this->input->post('sks')
        );

        $this->db->insert('matkul_dosen', $array);
        redirect(base_index().'admin/admin_dosen_makul/list_dosen_makul');
    }

    function form_edit_dosen_makul(){
        $id = kal2int(mysql_real_escape_string(urinext('form_edit_dosen_makul')));
        $row = out_row("select * from matkul_dosen where id = ".$id);

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_dosen_makul/list_dosen_makul');}

        $array = array(
            'page_title' => 'Form Edit Dosen - Mata Kuliah',
            'id' => $row->id,
            'matakuliah_id' => $row->matakuliah_id,
            'dosen_id' => $row->dosen_id,
            'sks' => $row->sks,
            'row_dosen' => out_where('select a.id as id, b.nama as nama from dosen as a, karyawan as b where a.karyawan_id = b.id', array()),
            'action' => base_index().'admin/admin_dosen_makul/edit_dosen_makul',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_dosen_makul', $array, true);
    }

    function edit_dosen_makul(){
        $id = mysql_real_escape_string($this->input->post('id'));
        if($id < 1){redirect(base_index().'admin/admin_dosen_makul/list_dosen_makul');}

        $array = array(
            'id' => $this->input->post('id'),
            'sks' => $this->input->post('sks'),
            'dosen_id' => $this->input->post('dosen_id'),
            'matakuliah_id' => $this->input->post('matakuliah_id')
        );

        $this->db->update('matkul_dosen', $array, array('id' => $id));
        redirect(base_index().'admin/admin_dosen_makul/list_dosen_makul');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
