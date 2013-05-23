<?php
/**
 * Created by JetBrains PhpStorm.
 * User: memordial_aganza
 * Date: 5/19/13
 * Time: 12:00 PM
 * To change this template use File | Settings | File Templates.
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_pengumuman_info extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'pengumuman_info/';
    }

    function homepage(){
        $this->page->title = 'Home Sistem Akademik - Pengumuman Info';
        $array = array(
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'dashboard', $array, true);
    }

    function list_pengumuman_info(){
        $rows = out_where(" select pengumuman_info.*, karyawan.nama as karyawan_nama
                            from pengumuman_info
                            join web_user on web_user.id = \"".$this->session->userdata("id_user")."\"
                            join karyawan on karyawan.id = web_user.id_karyawan
                            order by tgl_kegiatan desc limit 1000");

        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_pengumuman_info/form_edit_pengumuman_info/'.int2kal($row->id).'">Edit</a></div>';
            $link .= '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_pengumuman_info/hapus/'.int2kal($row->id).'">Hapus</a></div>';
            $konten[] = array($no, date("j F Y",strtotime($row->tgl_kegiatan)), $row->jam, $row->judul, $row->deskripsi, $row->karyawan_nama, $link);
            $no++;
        }

        $array = array(
            'heading' => array('', 'Tanggal Kegiatan','Jam','Judul', 'Deskripsi','Nama Karyawan',' Action'),
            'konten' => $konten,
            'action' => base_index().'admin/admin_pengumuman_info/list_pengumuman_info',
            'page_title' => 'Pengumuman Info',
            'link_add' => array('name' => 'Tambah Pengumuman', 'link' => base_index().'admin/admin_pengumuman_info/form_add_pengumuman_info')
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'list_pengumuman_info', $array, true);
    }

    function form_add_pengumuman_info(){
        if($_POST){
            $fields = $this->input->post(NULL, TRUE);
            $fields["karyawan_id"] = $this->session->userdata("id_user");
            $this->db->insert('pengumuman_info', $fields);
            redirect(base_index().'admin/admin_pengumuman_info/list_pengumuman_info');
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
            'page_title' => 'Tambah Pengumuman Info',
            'action' => base_index().'admin/admin_pengumuman_info/form_add_pengumuman_info',
            'link_back' => anchor("admin/admin_pengumuman_info/list_pengumuman_info", "Back", "class='btn btn-gebo btn-small'"),
            'id_pengumuman_info' => "",
            'tgl_kegiatan' => "",
            'jam' => "",
            'judul' => "",
            'deskripsi' => ""
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_pengumuman_info', $array, true);
    }

    function form_edit_pengumuman_info(){
        if($_POST){
            $id = mysql_real_escape_string($this->input->post('id'));
            if ($id){
                $fields = $this->input->post(NULL, TRUE);
                $fields["karyawan_id"] = $this->session->userdata("id_user");
                $this->db->update('pengumuman_info', $fields, array('id' => $id));
            }
            redirect(base_index().'admin/admin_pengumuman_info/list_pengumuman_info');
        }

        $id = kal2int(mysql_real_escape_string(urinext('form_edit_pengumuman_info')));
        if (!$id){redirect("admin/admin_pengumuman_info/list_pengumuman_info");}

        $row = (array)out_row("select * from pengumuman_info where id = ".$id." limit 1");
        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_pengumuman_info/list_pengumuman_info');}

        $array = array(
            'page_title' => 'Update Pengumuman Info',
            'action' => base_index().'admin/admin_pengumuman_info/form_edit_pengumuman_info',
            'link_back' => anchor("admin/admin_pengumuman_info/list_pengumuman_info", "Back", "class='btn btn-gebo btn-small'"),
            'id_pengumuman_info' => $row["id"],
            'jam' => $row["jam"],
            'tgl_kegiatan' => $row["tgl_kegiatan"],
            'judul' => $row["judul"],
            'deskripsi' => $row["deskripsi"]
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_pengumuman_info', $array, true);
    }

    function  hapus(){
        $id = kal2int(mysql_real_escape_string(urinext('hapus')));

        if ($id){
            $this->db->delete("pengumuman_info", array("id" => $id));
        }

        $this->page->konten = "";
        redirect("admin/admin_pengumuman_info/list_pengumuman_info");
    }
}