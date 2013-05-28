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
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_pendaftaran/form_edit_pembayaran/'.int2kal($row->id).'">edit</a></div>';
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

    function konfirmasi_pembayaran_accepted(){
        $rows = out_where("select a.*, b.nama, c.nama as kary_nama from konfirmasi_pembayaran a, calon_mahasiswa b, karyawan c where a.calon_mahasiswa_id = b.id and a.karyawan_id = c.id and status = 'reject' order by id desc limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $konten[] = array($no, $row->tgl_konfirmasi, $row->nama, $row->no_transaksi_transfer, $row->bank, $row->tgl_validasi, $row->kary_nama);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Tanggal Konfirmasi', 'Nama Calon', 'No Transaksi Transfer', 'Nama Bank', 'Tgl Validasi', 'Karyawan'),
            'konten' => $konten,
            'page_title' => 'Konfirmasi Pembayaran biaya Pendaftaran Accepted',
            'link_add' => array()
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function konfirmasi_pembayaran_rejected(){
        $rows = out_where("select a.*, b.nama, c.nama as kary_nama from konfirmasi_pembayaran a, calon_mahasiswa b, karyawan c where a.calon_mahasiswa_id = b.id and a.karyawan_id = c.id and status = 'accept' order by id desc limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $konten[] = array($no, $row->tgl_konfirmasi, $row->nama, $row->no_transaksi_transfer, $row->bank, $row->tgl_validasi, $row->kary_nama);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Tanggal Konfirmasi', 'Nama Calon', 'No Transaksi Transfer', 'Nama Bank', 'Tgl Validasi', 'Karyawan'),
            'konten' => $konten,
            'page_title' => 'Konfirmasi Pembayaran biaya Pendaftaran Accepted',
            'link_add' => array()
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_edit_pembayaran(){
        $id = kal2int(mysql_real_escape_string(urinext('form_edit_pembayaran')));
        $row = (array)out_row("select a.*, b.nama from konfirmasi_pembayaran a, calon_mahasiswa b where a.calon_mahasiswa_id = b.id and a.id = ".$id);

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_pendaftaran/request_konfirmasi_pembayaran');}

        $array = array(
            'page_title' => 'Form Edit Pembayaran',
            'row' => $row,
            'action' => base_index().'admin/admin_pendaftaran/edit_pembayaran',
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_pembayaran', $array, true);
    }

    function edit_pembayaran(){
        $id = mysql_real_escape_string($this->input->post('id'));
        $row = out_row('konfirmasi_pembayaran', array('id' => $id));

        $user = $this->page->data_user;

        if($id < 1 and count($row) < 1){
            redirect(base_index().'admin/admin_pendaftaran/request_konfirmasi_pembayaran');
        }

        $this->db->trans_start();
        $array = array(
            'status' => $this->input->post('status'),
            'tgl_validasi' => date('Y-m-d H:i:s'),
            'karyawan_id' => $user->id_karyawan
        );

        if($array['status'] == 'accept'){
            $this->db->update('calon_mahasiswa', array('status_pmb' => 'calon'), array('id' => $row->calon_mahasiswa_id));
        }

        $this->db->update('konfirmasi_pembayaran', $array, array('id' => $id));
        $this->db->trans_complete();

        redirect(base_index().'admin/admin_pendaftaran/konfirmasi_pembayaran_accepted');
    }



    function calon_mahasiswa(){
        $rows = out_where("select a.*, b.nama_kota from calon_mahasiswa a, geo_kotakab b where a.kota_kab_id = b.id order by id desc limit 100");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_pendaftaran/detail_calon_mahasiswa/'.int2kal($row->id).'">detail</a></div>';
            $konten[] = array($no, $row->tanggal_register, $row->nama, $row->email, $row->nama_kota,
                $row->telp, $row->transkrip_nilai, $row->programstudi_kode, $row->status_pmb, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Tanggal Register', 'Nama Calon', 'Email', 'Kota Asal', 'No Telp', 'Nilai', 'Program', 'Status',  '#'),
            'konten' => $konten,
            'page_title' => 'Daftar calon Mahasiswa',
            'link_add' => array()
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function detail_calon_mahasiswa(){
        $this->page->konten = 'Halaman ini masih dalam proses develop';
    }

    function form_input_ujiandaftar(){
        $rows = out_where("select a.* from calon_mahasiswa a where status_pmb = 'calon' order by id desc limit 100");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $input = '<div class="btn-group"><input type="text"  style="width:60px;" /></div>';

            $konten[] = array($no, $row->tanggal_register, $row->nama, $row->email,
                $row->telp, $row->transkrip_nilai, date('Y').'.'.$row->programstudi_kode.'.00'.$row->id,  $input);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Tanggal Register', 'Nama Calon', 'Email', 'No Telp', 'Nilai', 'No Ujian', '#'),
            'konten' => $konten,
            'page_title' => 'Daftar calon Mahasiswa',
            'link_add' => array()
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
