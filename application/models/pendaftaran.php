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

    function d_dashboard(){
        if(!$this->mahasiswa->is_login() or $this->page->web_mode != 'calon_mahasiswa'){ redirect(base_index(), 'refresh'); }
        $row = $this->page->data_siswa;

        if($row->status_pmb == 'register'){
            return $this->form_pendaftaran();
        }

        if($row->status_pmb == 'daftar'){
            return $this->form_konfirmasi_pembayaran();
        }

        if($row->status_pmb == 'konfirm_bayar'){
            redirect(base_index().'pendaftaran/pesan_registrasi/wait_validate/', 'refresh');
            return;
        }


    }

    function form_pendaftaran(){
        if(!$this->mahasiswa->is_login() or $this->page->web_mode != 'calon_mahasiswa'){ redirect(base_index(), 'refresh'); }
        $row = (array)$this->page->data_siswa;


        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
            'row' => $row,
            'base_index' => base_index(),
            'action' => base_index().'pendaftaran/simpan_pendaftaran',
            'propinsi' => (array)out_where('geo_propinsi'),
            'jenjang_pendidikan' => (array)out_where('jenjang_pendidikan'),
            'progdi' => (array)out_where("select a.*, b.nama as fname from programstudi a left join fakultas b on a.fakultas_kode = b.kode"),
            'jenis_pendaftaran' => (array)out_where('jenis_pendaftaran'),
            'valid' => false
        );

        if($row['nama'] != '' and
            $row['tempat_lahir'] != '' and
            $row['tgl_lahir'] != '' and
            $row['jenis_kelamin'] != '' and
            $row['programstudi_kode'] != '' and
            $row['propinsi_id'] != '' and
            $row['kota_kab_id'] != '' and
            $row['kodepos'] != '' and
            $row['alamat'] != '' and
            $row['telp'] != '' and
            $row['jenjang_pendidikan_id'] != '' and
            $row['asal_sekolah'] != '' and
            $row['transkrip_nilai'] != ''
        ){
            $array['valid'] = true;
        }


        $this->page->title = 'Form Pendaftaran';
        $this->page->konten = $this->parser->parse($this->views_dir.'form_pendaftaran', $array, true);
    }

    function simpan_pendaftaran(){
        /*
         * berdasarkan update terakir pendaftaran disederhanakan hanya untuk pendaftar fresh saja maka
         * jenis_pendaftaran_id, asal_universitas, dan skhu diabaikan.
         */

        $array = array(
            'tanggal_register' => date('Y-m-d H:i:s'),
            'nama' => $this->input->post('nama'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tgl_lahir' => $this->input->post('thn').'-'.$this->input->post('bln').'-'.$this->input->post('tgl'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'programstudi_kode' => $this->input->post('programstudi_kode'),
            //'email' => $this->input->post('email'),
            //'password' => md5($this->input->post('password')),
            'propinsi_id' => $this->input->post('propinsi_id'),
            'kota_kab_id' => $this->input->post('kota_kab_id'),
            'kodepos' => $this->input->post('kodepos'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
            'jenjang_pendidikan_id' => $this->input->post('jenjang_pendidikan_id'),
            'asal_sekolah' => $this->input->post('asal_sekolah'),
            'transkrip_nilai' => $this->input->post('transkrip_nilai'),
            'status_pmb' => 'register',
        );

        $this->db->update('calon_mahasiswa', $array, array('id' => $this->input->post('id')));
        redirect(base_index().'pendaftaran/d_dashboard', 'refresh');
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
            //redirect(base_index().'pendaftaran/pesan_registrasi/wrongc/', 'refresh');
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
            'status_pmb' => 'register'
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
                break;
            case 'terdaftar' :
                $array['judul'] = 'Selamat Anda Sudah Terdaftar';
                $array['pesan'] = 'Untuk proses selanjutnya silakan melakukan pembayaran biaya pendaftaran ke rekening yang disediakan, kemudian melakukan konfirmasi pembayaran.';
                break;
            case 'wait_validate' :
                $array['judul'] = 'Proses Validasi Pembayaran';
                $array['pesan'] = 'Kami sudah menerima konfirmasi pembayaran Anda, silakan tunggu untuk prosesnya.';
                break;
        }

        $this->page->set_sidebar = true;
        $this->page->title = $array['judul'];
        $this->page->konten = $this->parser->parse($this->views_dir.'pesan_registrasi', $array, true);
        //$this->page->konten = $_SERVER['HTTP_REFERER'];
    }

    function set_mendaftar(){
        $this->load->model('mahasiswa');
        if(!$this->mahasiswa->is_login() or $this->page->web_mode != 'calon_mahasiswa'){ redirect(base_index(), 'refresh'); }
        $row = $this->page->data_siswa;
        $this->db->update('calon_mahasiswa', array('status_pmb' => 'daftar'), array('id' => $row->id));
        redirect(base_index().'pendaftaran/pesan_registrasi/terdaftar', 'refresh');
    }

    function form_konfirmasi_pembayaran(){
        if(!$this->mahasiswa->is_login() or $this->page->web_mode != 'calon_mahasiswa'){ redirect(base_index(), 'refresh'); }
        $row = $this->page->data_siswa;
        $kon = out_row("select*from konfirmasi_pembayaran where calon_mahasiswa_id = ".$row->id." and status = 'request'");

        if(count($kon) > 0){
            redirect(base_index().'pendaftaran/pesan_registrasi/wait_validate', 'refresh');
            return ;
        }
        $this->page->set_sidebar = true;
        $array = array(
            'action' => base_index().'pendaftaran/simpan_konfirmasi'
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'form_konfirmasi_pembayaran', $array, true);
    }

    function simpan_konfirmasi(){
        $this->load->model('mahasiswa');
        if(!$this->mahasiswa->is_login() or $this->page->web_mode != 'calon_mahasiswa'){ redirect(base_index(), 'refresh'); }
        $row = $this->page->data_siswa;

        $array = array(
            'calon_mahasiswa_id' => $row->id,
            'tgl_konfirmasi' => date('Y-m-d H:i:s'),
            'no_transaksi_transfer' => $this->input->post('no_transaksi_transfer'),
            'bank' => $this->input->post('bank'),
            'status' => 'request'
        );

        $this->db->insert('konfirmasi_pembayaran', $array);
        $this->db->update('calon_mahasiswa', array('status_pmb' => 'konfirm_bayar'), array('id' => $row->id));
        redirect(base_index().'pendaftaran/d_dashboard', 'refresh');
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
