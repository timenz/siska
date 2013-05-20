<?php
/**
 * Created by JetBrains PhpStorm.
 * User: memordial_aganza
 * Date: 5/19/13
 * Time: 12:00 PM
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
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_kalendar_akademik/form_edit_kalendar_akademik/'.int2kal($row->id).'">Edit</a></div>';
            $konten[] = array($no, $row->tahun_akademik, $row->semester, $row->fakultas_nama, $row->programstudi_nama,   $link);
            $no++;
        }

        $array = array(
            'heading' => array('', 'Tahun Akademik', 'Semester', 'Fakultas', 'Program Studi',' Action'),
            'konten' => $konten,
            'page_title' => 'Daftar Kalendar akademik',
            'link_add' => array('name' => 'Tambah Kalendar Akademik', 'link' => base_index().'admin/admin_kalendar_akademik/form_add_kalendar_akademik')
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'list_kalendar_akademik', $array, true);
    }

    function form_add_kalendar_akademik(){
        if($_POST){
            $fields = $this->input->post(NULL, TRUE);
            unset($fields["id"]);
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
            'action' => base_index().'admin/admin_kalendar_akademik/form_add_kalendar_akademik',
            'link_back' => anchor("admin/admin_kalendar_akademik/list_kalendar_akademik", "Back", "class='btn btn-gebo btn-small'"),
            'id_kalendar_akademik' => "",
            'dropdown_fakultas' => form_dropdown("fakultas_kode",$row_fakultas, "", "id='fakultas_kode'"),
            'dropdown_programstudi' => form_dropdown("programstudi_kode",$row_programstudi,"", "id='programstudi_kode'"),
            'dropdown_semester' => form_dropdown("semester",array("genap" => "Genap", "ganjil" => "Ganjil"),"", "id='semester'"),
            'tahun_akademik' => date("Y"),
            'row_fakultas' => $row_fakultas,
            'row_programstudi' => $row_programstudi,
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_kalendar_akademik', $array, true);
    }

    function form_edit_kalendar_akademik(){

        if($_POST){
            $id = mysql_real_escape_string($this->input->post('id'));
            if (!$id){redirect("admin/admin_kalendar_akademik/list_kalendar_akademik");}
            $fields = $this->input->post(NULL, TRUE);
            $this->db->update('kalendar_akademik', $fields, array('id' => $id));
            redirect(base_index().'admin/admin_kalendar_akademik/list_kalendar_akademik');
        }

        $id = kal2int(mysql_real_escape_string(urinext('form_edit_kalendar_akademik')));
        if (!$id){redirect("admin/admin_kalendar_akademik/list_kalendar_akademik");}
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
            'action' => base_index().'admin/admin_kalendar_akademik/form_edit_kalendar_akademik',
            'link_back' => anchor("admin/admin_kalendar_akademik/list_kalendar_akademik", "Back", "class='btn btn-gebo btn-small'"),
            'id_kalendar_akademik' => $row["id"],
            'dropdown_fakultas' => form_dropdown("fakultas_kode",$row_fakultas, $row["fakultas_kode"], "id='fakultas_kode'"),
            'dropdown_programstudi' => form_dropdown("programstudi_kode",$row_programstudi,$row["programstudi_kode"], "id='programstudi_kode'"),
            'dropdown_semester' => form_dropdown("semester",array("genap" => "Genap", "ganjil" => "Ganjil"),$row["semester"], "id='semester'"),
            'tahun_akademik' => $row["tahun_akademik"],
            'row_fakultas' => $row_fakultas,
            'row_programstudi' => $row_programstudi,
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_kalendar_akademik', $array, true);
    }

    /*
     * get a last record or few kalendar akademik */
    function get_kalendar_akademik($fakultas_kode = false, $programstudi = false, $year = false, $semester = false){

        if ($fakultas_kode){
            $this->db->where("fakultas_kode" ,$fakultas_kode);
        }

        if ($programstudi){
            $this->db->where("programstudi" ,$programstudi);
        }

        if ($year){
            $this->db->where("year" ,$year);
        }
        if ($semester){
            $this->db->where("semester" ,$semester);
        }

        $query = $this->db->get("kalendar_akademik");
        if ($query->num_rows() > 0){
            return $this->db->result();
        }
        else{
            return false;
        }

    }
}