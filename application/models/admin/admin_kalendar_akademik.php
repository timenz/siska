<?php
/**
 * Created by JetBrains PhpStorm.
 * User: memordial_aganza
 * Date: 5/18/13
 * Time: 11:05 PM
 * To change this template use File | Settings | File Templates.
 */


if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_kalendar_akademik extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'kalendar_akademik/';
    }

    function homepage(){
        $this->page->title = 'Home Sistem Akademik - Kalendar akademik';
        $array = array(

        );

        $this->page->konten = $this->parser->parse($this->page->tpl.'dashboard', $array, true);
    }

    function list_kalendar_akademik(){
        $rows = out_where(" select kalendar_akademik.*, fakultas.nama as fakultas_nama, programstudi.nama as programstudi_nama
                            from kalendar_akademik
                            join fakultas on fakultas.kode= kalendar_akademik.fakultas_kode
                            join programstudi on programstudi.kode= kalendar_akademik.programstudi_kode and programstudi.fakultas_kode = fakultas.kode
                            order by tahun_akademik desc, id desc
                            limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_kalendar_akademik/edit/'.int2kal($row->id).'">Edit</a></div>';
            $konten[] = array($no, $row->fakultas_nama, $row->programstudi_nama, $row->semester, $row->tahun_akademik, $link);
            $no++;
        }

        $array = array(
            'heading' => array('', 'Fakultas', 'Program Studi', 'Semester', 'Tahun Akademik',' Action'),
            'konten' => $konten,
            'page_title' => 'Daftar Kalendar akademik',
            'link_add' => array('name' => 'Tambah Kalendar Akademik', 'link' => base_index().'admin/admin_kalendar_akademik/form_add_kalendar')
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'list_kalendar_akademik', $array, true);
    }

    function form_add_kalendar(){

        if($_POST){
            $fields = $this->input->post(NULL, TRUE);

            $this->db->insert('kalendar_akademik', $fields);
            redirect(base_index().'admin/admin_kalendar_akademik/list_kalendar_akademik');
        }

        $query_fakultas = out_where("select * from fakultas order by nama asc");
        $row_fakultas[""] = ":: Pilih Fakultas";
        foreach($query_fakultas as $fakultas){
            $row_fakultas[$fakultas->kode] = $fakultas->nama;
        }

        $query_programstudi = out_where("select * from programstudi order by fakultas_kode asc, nama asc");
        $row_programstudi[""] = ":: Pilih Program Studi";
        foreach($query_programstudi as $programstudi){
            $row_programstudi[$programstudi->kode] = $programstudi->nama;
        }

        $array = array(
            'page_title' => 'Tambah Kalendar Akademik',
            'action' => base_index().'admin/admin_kalendar_akademik/form_add_kalendar',
            'link_back' => anchor("admin/admin_kalendar_akademik/list_kalendar_akademik", "Back", "class='btn btn-gebo btn-small'"),
            'row_fakultas' => $row_fakultas,
            'row_programstudi' => $row_programstudi,
            'row_semester' => array("genap" => "Genap", "ganjil" => "Ganjil"),
            );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_kalendar_akademik', $array, true);
    }

    function edit($id = false){

        if($_POST){
            $id = mysql_real_escape_string($this->input->post('id'));

            if (!$id){redirect("admin/admin_kalendar_akademik/list_kalendar_akademik");}

            $fields = $this->input->post(NULL, TRUE);
            $this->db->update('kalendar_akademik', $fields, array('id' => $id));
            redirect(base_index().'admin/admin_kalendar_akademik/list_kalendar_akademik');
        }
        else{
            $id = kal2int(mysql_real_escape_string(urinext('edit')));
            if (!$id){redirect("admin/admin_kalendar_akademik/list_kalendar_akademik");}

        }

        $row = (array)out_row("select * from kalendar_akademik where id = ".$id. " limit 1");

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_kalendar_akademik/list_kalendar_akademik');}

        $query_fakultas = out_where("select * from fakultas order by nama asc");
        $row_fakultas[""] = ":: Pilih Fakultas";
        foreach($query_fakultas as $fakultas){
            $row_fakultas[$fakultas->kode] = $fakultas->nama;
        }

        $query_programstudi = out_where("select * from programstudi order by fakultas_kode asc, nama asc");
        $row_programstudi[""] = ":: Pilih Program Studi";
        foreach($query_programstudi as $programstudi){
            $row_programstudi[$programstudi->kode] = $programstudi->nama;
        }

        $array = array(
            'page_title' => 'Update Kalendar Akademik',
            'action' => base_index().'admin/admin_kalendar_akademik/edit',
            'link_back' => anchor("admin/admin_kalendar_akademik/list_kalendar_akademik", "Back", "class='btn btn-gebo btn-small'"),
            'row_fakultas' => $row_fakultas,
            'row_programstudi' => $row_programstudi,
            'row_kalendar_akademik' => $row,
            'row_semester' => array("genap" => "Genap", "ganjil" => "Ganjil"),
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_kalendar_akademik', $array, true);
    }
}