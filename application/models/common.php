<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class common extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->view_dir = $this->page->tpl.'common/';
    }

    function homepage(){
        $this->page->title = 'Home Sistem Akademik';
        $this->page->set_slider = true;
        $this->page->set_sidebar = true;
        $this->page->set_welcome = true;
        $pengumuman = (array)out_where("select*from pengumuman_info order by id desc limit 5");

        /* query kalendar akademik untuk semua fakultas pada tahun ini */
        $kalendar_akademik = out_where("select  fakultas.nama as fakultas_nama,
                                                programstudi.nama as programstudi_nama,
                                                kalendar_informasi.tgl_kegiatan_start,
                                                kalendar_informasi.tgl_kegiatan_end,
                                                kalendar_informasi.judul,
                                                kalendar_informasi.deskripsi
                                        from kalendar_informasi
                                            join kalendar_akademik on kalendar_akademik.id = kalendar_informasi.kalendar_akademik_id
                                            join fakultas on fakultas.kode = kalendar_akademik.fakultas_kode
                                            join programstudi on programstudi.kode = kalendar_akademik.programstudi_kode
                                        where kalendar_akademik.tahun_akademik = '".date("Y")."'
                                        order by fakultas_nama asc, programstudi_nama asc, tgl_kegiatan_start asc
                                            ");

        $fakultas = out_where("select * from fakultas order by nama ");

        foreach($fakultas as $fak){
            $progdi = out_where("select * from programstudi where fakultas_kode = '".$fak->kode."' order by nama asc");

            /* fakultas_progdi */
            $fakultas_progdi[$fak->nama] = $progdi;

            /* query kalendar akademik untuk per fakultas & progdi pada tahun ini. */
            foreach($progdi as $prog){
                $kalendar_akademik_progdi[$fak->nama][$prog->nama] = out_where("select  fakultas.nama as fakultas_nama,
                                                programstudi.nama as programstudi_nama,
                                                kalendar_informasi.tgl_kegiatan_start,
                                                kalendar_informasi.tgl_kegiatan_end,
                                                kalendar_informasi.judul,
                                                kalendar_informasi.deskripsi
                                        from kalendar_informasi
                                            join kalendar_akademik on kalendar_akademik.id = kalendar_informasi.kalendar_akademik_id
                                            join fakultas on fakultas.kode = kalendar_akademik.fakultas_kode
                                            join programstudi on programstudi.kode = kalendar_akademik.programstudi_kode
                                        where kalendar_akademik.tahun_akademik = '".date("Y")."' and
                                            kalendar_akademik.fakultas_kode = '".$fak->kode."' and
                                            kalendar_akademik.programstudi_kode = '".$prog->kode."'
                                        order by fakultas_nama asc, programstudi_nama asc, tgl_kegiatan_start asc
                                            ");
            }

        }



        $array = array(
            'assets_url' => $this->page->assets_url,
            'pengumuman' => $pengumuman
        );
        $this->page->konten = $this->parser->parse($this->view_dir.'homepage', $array, true);
        //$this->buku_tamu->form_buku_tamu();
    }

    function about_us(){
        $this->page->title = 'Tentang Kami';
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url
        );
        $this->page->konten = $this->parser->parse($this->view_dir.'about_us', $array, true);
    }

    function contact_us(){
        $this->page->title = 'Buku Tamu';
        $this->page->set_sidebar = true;
        $array = array(
            'assets_url' => $this->page->assets_url,
        );
        $this->page->konten = $this->parser->parse($this->view_dir.'contact_us2', $array, true);
    }

    function list_pesan_bukutamu(){
        $row = out_where("select * from bukutamu where is_publish = '1' order by tgl_posting desc, id desc limit 10");
        $array = array(

            'row_bukutamu' => $row
        );

        exit($this->parser->parse($this->view_dir.'list_bukutamu', $array));
    }

    function get_listkota(){
        $out = array('valid' => false);
        $id = mysql_real_escape_string($this->input->post('propinsi'));
        $row = out_where('geo_kotakab', array('propinsi_id' => $id));

        if(count($row) > 0){
            $out = array(
                'valid' => true,
                'konten' => $row
            );
        }
        $this->page->konten = $out;
    }



}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
