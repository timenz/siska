<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_makul extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'makul/';
    }


    function list_makul(){
        $rows = out_where("select a.id as id, a.nama as nama, b.nama as fakultas, c.nama as prodi, e.nama as kordinator, a.semester as semester
                from matakuliah as a, fakultas as b, programstudi as c,  dosen as d, karyawan as e
                where a.fakultas_kode = b.kode and a.programstudi_kode = c.kode and a.dosenkoordinator_id = d.id and d.karyawan_id = e.id
                limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_makul/form_edit_makul/'.int2kal($row->id).'">edit</a></div>';
            $konten[] = array($no, $row->nama, $row->fakultas, $row->prodi, $row->kordinator, $row->semester, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Nama Makul', 'Fakultas', 'Program Studi', 'Koordinator', 'Semester', '#'),
            'konten' => $konten,
            'page_title' => 'Listing makul',
            'link_add' => array('name' => 'Tambah makul', 'link' => base_index().'admin/admin_makul/form_add_makul')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_makul(){
        $array = array(
            'page_title' => 'Form Tambah Makul',
            'row_fakultas' => out_where('fakultas', array()),
            'row_prodi' => out_where('programstudi', array()),
            'row_dosen' => out_where('select a.id as id, b.nama as nama from dosen as a, karyawan as b where a.karyawan_id = b.id'),
            'action' => base_index().'admin/admin_makul/add_makul'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_makul', $array, true);
    }

    function add_makul(){
        $array = array(
            'fakultas_kode' => $this->input->post('fakultas_kode'),
            'programstudi_kode' => $this->input->post('programstudi_kode'),
            'dosenkoordinator_id' => $this->input->post('dosenkoordinator_id'),
            'nama' => $this->input->post('nama'),
            'semester' => $this->input->post('semester'),
            'keterangan' => $this->input->post('keterangan'),
        );

        $this->db->insert('matakuliah', $array);
        redirect(base_index().'admin/admin_makul/list_makul');
    }

    function form_edit_makul(){
        $id = kal2int(mysql_real_escape_string(urinext('form_edit_makul')));
        $row = out_row("select * from matakuliah where id = ".$id);

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_makul/list_makul');}

        $array = array(
            'page_title' => 'Form Edit Makul',
            'id' => $row->id,
            'nama' => $row->nama,
            'fakultas_kode' => $row->fakultas_kode,
            'programstudi_kode' => $row->programstudi_kode,
            'dosenkoordinator_id' => $row->dosenkoordinator_id,
            'semester' => $row->semester,
            'keterangan' => $row->keterangan,
            'row_fakultas' => out_where('fakultas', array()),
            'row_prodi' => out_where('programstudi', array()),
            'row_dosen' => out_where('select a.id as id, b.nama as nama from dosen as a, karyawan as b where a.karyawan_id = b.id'),
            'action' => base_index().'admin/admin_makul/edit_makul',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_makul', $array, true);
    }

    function edit_makul(){
        $id = mysql_real_escape_string($this->input->post('id'));
        if($id < 1){redirect(base_index().'admin/admin_makul/list_makul');}

        $array = array(
            'fakultas_kode' => $this->input->post('fakultas_kode'),
            'programstudi_kode' => $this->input->post('programstudi_kode'),
            'dosenkoordinator_id' => $this->input->post('dosenkoordinator_id'),
            'nama' => $this->input->post('nama'),
            'semester' => $this->input->post('semester'),
            'keterangan' => $this->input->post('keterangan'),
        );

        $this->db->update('matakuliah', $array, array('id' => $id));
        redirect(base_index().'admin/admin_makul/list_makul');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

