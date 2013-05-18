<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_ruang extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'ruang/';
    }

    function list_ruang(){
        $rows = out_where("select * from penjadwalan as a, weekday as b where a.weekday_id = b.id limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_ruang/form_edit_ruang/'.$row->id.'">edit</a></div>';
            $konten[] = array($no, $row->ruang, $row->nama, $row->jam_in, $row->jam_out, $row->kuota, $row->keterangan, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Ruang', 'Weekday', 'Jam Masuk', 'Jam keluar', 'Kuota', 'Keterangan', '#'),
            'konten' => $konten,
            'page_title' => 'Listing Ruang',
            'link_add' => array('name' => 'Tambah Ruang', 'link' => base_index().'admin/admin_ruang/form_add_ruang')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_ruang(){
        $array = array(
            'page_title' => 'Form Tambah Ruang',
            'row_weekday' => out_where('weekday', array()),
            'action' => base_index().'admin/admin_ruang/add_ruang'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_ruang', $array, true);
    }

    function add_ruang(){
        $array = array(
            'ruang' => $this->input->post('ruang'),
            'weekday_id' => $this->input->post('weekday_id'),
            'jam_in' => $this->input->post('jam_in'),
            'jam_out' => $this->input->post('jam_out'),
            'kuota' => $this->input->post('kuota'),
            'keterangan' => $this->input->post('keterangan')
        );

        $this->db->insert('penjadwalan', $array);
        redirect(base_index().'admin/admin_ruang/list_ruang');
    }

    function form_edit_ruang(){
        $id = mysql_real_escape_string(urinext('form_edit_ruang'));
        $row = out_row("select * from penjadwalan where id = ".$id);

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_ruang/list_ruang');}

        $array = array(
            'id' => $id,
            'page_title' => 'Form Edit Ruang',
            'ruang' => $row->ruang,
            'weekday_id' => $row->weekday_id,
            'jam_in' => $row->jam_in,
            'jam_out' => $row->jam_out,
            'kuota' => $row->kuota,
            'keterangan' => $row->keterangan,
            'row_weekday' => out_where('weekday', array()),
            'action' => base_index().'admin/admin_ruang/edit_ruang',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_ruang', $array, true);
    }

    function edit_ruang(){
        if($id = mysql_real_escape_string($this->input->post('id'))){
            $array = array(
                'id' => $this->input->post('id'),
                'ruang' => $this->input->post('ruang'),
                'weekday_id' => $this->input->post('weekday_id'),
                'jam_in' => $this->input->post('jam_in'),
                'jam_out' => $this->input->post('jam_out'),
                'kuota' => $this->input->post('kuota'),
                'keterangan' => $this->input->post('keterangan')
            );

            $this->db->update('penjadwalan', $array, array('id' => $id));
        }
        redirect(base_index().'admin/admin_ruang/list_ruang');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
