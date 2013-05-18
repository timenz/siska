<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class pendaftaran extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'pendaftaran/';

    }

    function info_pendaftaran(){
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
            'base_index' => base_index()
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'info_pendaftaran', $array, true);
    }

    function form_pendaftaran(){
        if(!$this->mahasiswa->is_login() or $this->page->web_mode != 'calon_mahasiswa'){ redirect(base_index(), 'refresh'); }
        $row = (array)$this->page->data_siswa;
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
            'row' => $row,
            'base_index' => base_index(),
            'propinsi' => (array)out_where('geo_propinsi'),
            'jenjang_pendidikan' => (array)out_where('jenjang_pendidikan'),
            'progdi' => (array)out_where("select a.*, b.nama as fname from programstudi a left join fakultas b on a.fakultas_kode = b.kode"),
            'jenis_pendaftaran' => (array)out_where('jenis_pendaftaran'),
        );
        $this->page->title = 'Form Pendaftaran';
        $this->page->konten = $this->parser->parse($this->views_dir.'form_pendaftaran', $array, true);
    }

    function form_registrasi(){
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
            'base_index' => base_index(),
            'action' => base_index().'post/pendaftaran/simpan_registrasi',
            'progdi' => (array)out_where("select a.*, b.nama as fname from programstudi a left join fakultas b on a.fakultas_kode = b.kode"),

        );
        $this->page->title = 'Form Registrasi';
        $this->page->konten = $this->parser->parse($this->views_dir.'form_registrasi', $array, true);
    }

    function simpan_registrasi(){
        $email = $this->input->post('email');

        if(!cek_captcha()){
            redirect(base_index().'pendaftaran/pesan_registrasi/wrongc/', 'refresh');
            return;
        }

        $row = out_row('calon_mahasiswa', array('email' => $email));
        if(count($row) > 0){
            redirect(base_index().'pendaftaran/pesan_registrasi/femail/'.$email, 'refresh');
            return;
        }
        $array = array(
            'tanggal_register' => date('Y-m-d H:i:s'),
            'nama' => $this->input->post('nama'),
            'telp' => $this->input->post('telp'),
            'programstudi_kode' => $this->input->post('programstudi_kode'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
        );
        $this->db->insert('calon_mahasiswa', $array);
        redirect(base_index().'pendaftaran/pesan_registrasi/sukses/'.$email, 'refresh');
    }

    function pesan_registrasi(){
        $key = urinext('pesan_registrasi');
        if(!isset($_SERVER['HTTP_REFERER'])){
            redirect(base_index().'page_not_found', 'refresh');
        }

        $array = array(
            'base_index' => base_index(),
            'assets_url' => $this->page->assets_url,
            'judul' => '',
            'pesan' => ''
        );

        switch($key){
            case 'sukses' :
                $array['judul'] = 'Registrasi Berhasil';
                $array['pesan'] = 'Registrasi Berhasil, silakan lakukan konfirmasi email (sistem email diskip / agar mudah diaplikasikan di sistem lokal), silakan login, untuk melanjutkan ke pendaftaran';
                break;
            case 'femail' :
                $array['judul'] = 'Email Pernah Didaftarkan';
                $array['pesan'] = 'Email '.urinext('femail').' sudah pernah didaftarkan, silakan gunakan email lain';
                break;
            case 'wrongc' :
                $array['judul'] = 'Kode Keamanan Salah';
                $array['pesan'] = 'Kode keamanan yang Anda masukkan kurang benar, silakan ulangi kembali.';
        }

        $this->page->set_sidebar = true;
        $this->page->title = $array['judul'];
        $this->page->konten = $this->parser->parse($this->views_dir.'pesan_registrasi', $array, true);
        //$this->page->konten = $_SERVER['HTTP_REFERER'];
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
