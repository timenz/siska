<?php
/**
 * Created by JetBrains PhpStorm.
 * User: memordial_aganza
 * Date: 5/19/13
 * Time: 12:00 PM
 * To change this template use File | Settings | File Templates.
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_kalendar_informasi extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'kalendar_akademik/';
    }

    function homepage(){
        $this->page->title = 'Home Sistem Akademik - Kalendar informasi';
        $array = array(
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'dashboard', $array, true);
    }

    function list_kalendar_informasi(){
        $year = $this->input->post("year", true);
        if (!empty($year)) {
            $rows = out_where(" select
                                kalendar_informasi.*,
                                fakultas.nama as fakultas_nama,
                                programstudi.nama as programstudi_nama,
                                kalendar_akademik.semester,
                                kalendar_akademik.tahun_akademik,
                                concat(kalendar_akademik.tahun_akademik,' - ', kalendar_akademik.semester,' [ ', fakultas.nama,' - ', programstudi.nama,' ] ' ) as kalendar_akademik
                            from kalendar_informasi
                                join kalendar_akademik on kalendar_akademik.id = kalendar_informasi.kalendar_akademik_id
                                join fakultas on fakultas.kode= kalendar_akademik.fakultas_kode
                                join programstudi on programstudi.kode= kalendar_akademik.programstudi_kode and programstudi.fakultas_kode = fakultas.kode
                            where tahun_akademik = \"".$year."\"
                            order by kalendar_akademik.tahun_akademik desc
                            limit 1000");
        }
        else{
            $rows = out_where(" select
                                kalendar_informasi.*,
                                fakultas.nama as fakultas_nama,
                                programstudi.nama as programstudi_nama,
                                kalendar_akademik.semester,
                                kalendar_akademik.tahun_akademik,
                                concat(kalendar_akademik.tahun_akademik,' - ', kalendar_akademik.semester,' [ ', fakultas.nama,' - ', programstudi.nama,' ] ' ) as kalendar_akademik
                            from kalendar_informasi
                                join kalendar_akademik on kalendar_akademik.id = kalendar_informasi.kalendar_akademik_id
                                join fakultas on fakultas.kode= kalendar_akademik.fakultas_kode
                                join programstudi on programstudi.kode= kalendar_akademik.programstudi_kode and programstudi.fakultas_kode = fakultas.kode
                            order by kalendar_akademik.tahun_akademik desc
                            limit 1000");
            $year = date("Y");
        }


        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_kalendar_informasi/form_edit_kalendar_informasi/'.int2kal($row->id).'">Edit</a></div>';
            $link .= '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_kalendar_informasi/hapus/'.int2kal($row->id).'">Hapus</a></div>';
            $konten[] = array($no, $row->kalendar_akademik, date("j F Y",strtotime($row->tgl_kegiatan_start))." - ".date("j F Y",strtotime($row->tgl_kegiatan_end)), $row->judul, $row->deskripsi, $link);
            $no++;
        }

        $query_kaldik = out_where("   select kalendar_akademik.tahun_akademik
                                      from kalendar_akademik
                                      join fakultas on fakultas.kode= kalendar_akademik.fakultas_kode
                                      join programstudi on programstudi.kode= kalendar_akademik.programstudi_kode and programstudi.fakultas_kode = fakultas.kode
                                      group by tahun_akademik
                                      order by tahun_akademik desc, semester asc
                                      limit 1000");

        foreach($query_kaldik as $kaldik){
            $row_kaldik[$kaldik->tahun_akademik] = $kaldik->tahun_akademik;
        }

        $array = array(
            'heading' => array('', 'Kalendar Akademik', 'Tanggal Kegiatan','Judul', 'Deskripsi',' Action'),
            'konten' => $konten,
            'action' => base_index().'admin/admin_kalendar_informasi/list_kalendar_informasi',
            'dropdown_tahun'=> form_dropdown("year",$row_kaldik,$year, "id='year' class='span1' style='margin-bottom:0'"),
            'page_title' => 'Daftar Kalendar Informasi',
            'link_add' => array('name' => 'Tambah Kalendar Informasi', 'link' => base_index().'admin/admin_kalendar_informasi/form_add_kalendar_informasi')
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'list_kalendar_informasi', $array, true);
    }

    function form_add_kalendar_informasi(){
        if($_POST){
            $fields = $this->input->post(NULL, TRUE);
            $fields["karyawan_id"] = $this->session->userdata("id_user");
            $this->db->insert('kalendar_informasi', $fields);
            redirect(base_index().'admin/admin_kalendar_informasi/list_kalendar_informasi');
        }

        $query_kaldik = out_where("   select *, fakultas.nama as fakultas_nama, programstudi.nama as programstudi_nama
                                      from kalendar_akademik
                                      join fakultas on fakultas.kode= kalendar_akademik.fakultas_kode
                                      join programstudi on programstudi.kode= kalendar_akademik.programstudi_kode and programstudi.fakultas_kode = fakultas.kode
                                      order by tahun_akademik desc, semester asc
                                      limit 1000");

        foreach($query_kaldik as $kaldik){
            $row_kaldik[$kaldik->id] = $kaldik->tahun_akademik." - ".$kaldik->semester." [".$kaldik->fakultas_nama." - ".$kaldik->programstudi_nama."]";
        }

        $array = array(
            'page_title' => 'Tambah Kalendar Informasi',
            'action' => base_index().'admin/admin_kalendar_informasi/form_add_kalendar_informasi',
            'link_back' => anchor("admin/admin_kalendar_informasi/list_kalendar_informasi", "Back", "class='btn btn-gebo btn-small'"),
            'id_kalendar_informasi' => "",
            'dropdown_kalendar_akademik'=> form_dropdown("kalendar_akademik_id",$row_kaldik,"", "id='kalendar_akademik_id' "),
            'tgl_kegiatan_start' => "",
            'tgl_kegiatan_end' => "",
            'judul' => "",
            'deskripsi' => ""
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_kalendar_informasi', $array, true);
    }

    function form_edit_kalendar_informasi(){
        if($_POST){
            $id = mysql_real_escape_string($this->input->post('id'));
            if (!$id){redirect(base_index().'admin/admin_kalendar_informasi/list_kalendar_informasi');}

            $fields = $this->input->post(NULL, TRUE);
            $fields["karyawan_id"] = $this->session->userdata("id_user");
            $this->db->update('kalendar_informasi', $fields, array('id' => $id));
            redirect(base_index().'admin/admin_kalendar_informasi/list_kalendar_informasi');
        }

        $id = kal2int(mysql_real_escape_string(urinext('form_edit_kalendar_informasi')));
        if (!$id){redirect("admin/admin_kalendar_akademik/list_kalendar_akademik");}

        $row = (array)out_row("select * from kalendar_informasi where id = ".$id." limit 1");
        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_kalendar_akademik/list_kalendar_akademik');}

        $query_kaldik = out_where("   select *, fakultas.nama as fakultas_nama, programstudi.nama as programstudi_nama
                                      from kalendar_akademik
                                      join fakultas on fakultas.kode= kalendar_akademik.fakultas_kode
                                      join programstudi on programstudi.kode= kalendar_akademik.programstudi_kode and programstudi.fakultas_kode = fakultas.kode
                                      order by tahun_akademik desc, semester asc
                                      limit 1000");

        foreach($query_kaldik as $kaldik){
            $row_kaldik[$kaldik->id] = $kaldik->tahun_akademik." - ".$kaldik->semester." [".$kaldik->fakultas_nama." - ".$kaldik->programstudi_nama."]";
        }

        $array = array(
            'page_title' => 'Update Kalendar Informasi',
            'action' => base_index().'admin/admin_kalendar_informasi/form_edit_kalendar_informasi',
            'link_back' => anchor("admin/admin_kalendar_informasi/list_kalendar_informasi", "Back", "class='btn btn-gebo btn-small'"),
            'id_kalendar_informasi' => $row["id"],
            'dropdown_kalendar_akademik'=> form_dropdown("kalendar_akademik_id",$row_kaldik,$row["kalendar_akademik_id"], "id='kalendar_akademik_id' "),
            'tgl_kegiatan_start' => $row["tgl_kegiatan_start"],
            'tgl_kegiatan_end' => $row["tgl_kegiatan_end"],
            'judul' => $row["judul"],
            'deskripsi' => $row["deskripsi"]
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_kalendar_informasi', $array, true);
    }

    function  hapus(){
        $id = kal2int(mysql_real_escape_string(urinext('hapus')));

        if ($id){
            $this->db->delete("kalendar_informasi", array("id" => $id));
        }


        $this->page->konten = "";
        redirect("admin/admin_kalendar_informasi/list_kalendar_informasi");
    }
}