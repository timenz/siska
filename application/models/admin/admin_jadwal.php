<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_jadwal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->views_dir = $this->page->tpl . 'jadwal/';
    }

    function search()
    {
        $this->page->title = 'HALAMAN PENCARIAN MAHASISWA';

        $array = array();

        // where
        $where = '';
        if ($this->input->post('q')) {
            $where = ' WHERE nama LIKE \'' . $this->input->post('q') . '%\' OR nim = \'' . $this->input->post('q') . '\'';
        }
        // get mahasiswa
        $array['mahasiswa'] = out_where('SELECT * FROM mahasiswa' . $where);

        $this->page->konten = $this->parser->parse($this->views_dir . 'search', $array, true);
    }

//    function urutan(){
//        $this->page->title = 'HALAMAN LIST MAHASISWA';
//        $array=array();
//        $this->page->konten = $this->parser->parse($this->views_dir.'urutan', $array, true);
//    }

    function print_krs()
    {
        $this->page->title = 'HALAMAN PRINT KRS';
        $array = array();
        $this->page->konten = $this->parser->parse($this->views_dir . 'print_krs', $array, true);
    }

    function lihat_krs()
    {
        $this->page->title = 'HALAMAN LIHAT KRS';

        $array = array();

        $mhs = out_where('SELECT * FROM mahasiswa WHERE id=' . $this->uri->segment(4));

        $kalendar_akademik = out_where('SELECT * FROM kalendar_akademik WHERE aktif = 1
                             AND programstudi_kode = \'' . $mhs[0]->programstudi_kode . '\'');

        $array = array();

        $array['krs'] = out_where(
            'SELECT
              mk.nama
              , md.sks
              , mk.semester
              , pj.ruang
              , pj.jam_in
              , wk.nama AS hari
              , jk.id AS jadwal_krs_id
              , k.nama AS nama_dosen
            FROM
              jadwal_mahasiswa jm
              JOIN jadwal_krs jk
                ON jk.id = jm.jadwal_krs_id
              JOIN matkul_dosen md
                ON md.id = jk.matkul_dosen_id
              JOIN dosen d
                ON d.id = md.dosen_id
              JOIN karyawan k
                ON k.id = d.karyawan_id
              JOIN penjadwalan pj
                ON pj.id = jk.penjadwalan_id
              JOIN matakuliah mk
                ON mk.id = md.matakuliah_id
              JOIN weekday wk
                ON wk.id = pj.weekday_id
            WHERE jm.kalendar_akademik_id = ' . $kalendar_akademik[0]->id . '
                                    AND jm.mahasiswa_id = ' . $mhs[0]->id
        );

        $array['mhs'] = $mhs;

        $this->page->konten = $this->parser->parse($this->views_dir . 'print_krs', $array, true);
    }

    function jadwal_makul()
    {
        // jika input jadwal
        if ($this->input->post()) {
            $inputs = $this->input->post();

            $this->db->insert('jadwal_krs', array(
                'matkul_dosen_id' => $inputs['matkul_dosen_id'],
                'penjadwalan_id' => $inputs['penjadwalan_id']
            ));

            $this->session->set_flashdata('message', 'Input jadwal matakuliah berhasil.');
        }

        $this->page->title = 'HALAMAN PENCARIAN MAHASISWA';

        $array = array();

        // get penjadwalan
        $array['jadwal'] = out_where(
            "SELECT
               p.id AS id,
               CONCAT(ruang, ' - ', w.nama, ' - ', jam_in) AS jadwal
             FROM
               penjadwalan p
               JOIN weekday w
                 ON w.id = p.weekday_id
             WHERE p.id NOT IN
               (SELECT
                 penjadwalan_id
               FROM
                 jadwal_krs)
             ORDER BY p.ruang");

        // get matakuliah
        $array['makul'] = out_where(
            "SELECT
               md.id AS id,
               mk.nama
             FROM
               matkul_dosen md
               JOIN matakuliah mk
                 ON md.matakuliah_id = mk.id
             WHERE md.id NOT IN
               (SELECT
                 jk.matkul_dosen_id
               FROM
                 jadwal_krs jk)
             ORDER BY mk.nama");

        // get jadwal
        $array['jadwal_krs'] = out_where(
            "SELECT
               mk.nama
               , md.sks
               , mk.semester
               , pj.ruang
               , pj.jam_in
               , wk.nama AS hari
               , jk.id AS jadwal_krs_id
               , k.nama AS nama_dosen
             FROM
               jadwal_krs jk
               JOIN matkul_dosen md
                 ON jk.matkul_dosen_id = md.id
               JOIN penjadwalan pj
                 ON jk.penjadwalan_id = pj.id
               JOIN matakuliah mk
                 ON md.matakuliah_id = mk.id
               JOIN weekday wk
                 ON pj.weekday_id = wk.id
               JOIN dosen d
                 ON md.dosen_id = d.id
               JOIN karyawan k
                 ON d.karyawan_id = k.id
             ORDER BY mk.nama");

        $this->page->konten = $this->parser->parse($this->views_dir . 'form_jadwal_krs', $array, true);
    }

}