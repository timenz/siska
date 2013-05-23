<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_pendaftaran extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'pendaftaran/';
    }


    function request_konfirmasi_pembayaran(){
        $rows = out_where("select a.*, b.nama from konfirmasi_pembayaran a, calon_mahasiswa b where a.calon_mahasiswa_id = b.id and status = 'request' order by id desc limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_karyawan/form_edit_karyawan/'.int2kal($row->id).'">edit</a></div>';
            $konten[] = array($no, $row->tgl_konfirmasi, $row->nama, $row->no_transaksi_transfer, $row->bank, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Tanggal Konfirmasi', 'Nama Calon', 'No Transaksi Transfer', 'Nama Bank', '#'),
            'konten' => $konten,
            'page_title' => 'Request Konfirmasi Pembayaran biaya Pendaftaran',
            'link_add' => array()
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_karyawan(){
        $array = array(
            'page_title' => 'Form Tambah karyawan',
            'action' => base_index().'admin/admin_karyawan/add_karyawan'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_karyawan', $array, true);
    }

    function add_karyawan(){
        $array = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'telp' => $this->input->post('telp'),
        );

        $this->db->insert('karyawan', $array);
        redirect(base_index().'admin/admin_karyawan/list_karyawan');
    }

    function form_edit_karyawan(){
        $id = kal2int(mysql_real_escape_string(urinext('form_edit_karyawan')));
        $row = out_row("select*from karyawan where id = ".$id);

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_karyawan/list_karyawan');}

        $array = array(
            'page_title' => 'Form Edit karyawan',
            'id' => $row->id,
            'nama' => $row->nama,
            'alamat' => $row->alamat,
            'jenis_kelamin' => $row->jenis_kelamin,
            'telp' => $row->telp,
            'action' => base_index().'admin/admin_karyawan/edit_karyawan',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_karyawan', $array, true);
    }

    function edit_karyawan(){
        $id = mysql_real_escape_string($this->input->post('id'));
        if($id < 1){redirect(base_index().'admin/admin_karyawan/list_karyawan');}

        $array = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'telp' => $this->input->post('telp'),
        );

        $this->db->update('karyawan', $array, array('id' => $id));
        redirect(base_index().'admin/admin_karyawan/list_karyawan');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
