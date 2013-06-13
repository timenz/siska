<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class mhs_jadwal extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'penjadwalan/';
    }

    function jadwal(){
        $this->page->title = 'HALAMAN DASHBOARD';

        $mhs = (array)$this->page->data_siswa;

        $kalendar_akademik = out_where('SELECT * FROM kalendar_akademik WHERE aktif = 1
                                        AND programstudi_kode = \''.$mhs['programstudi_kode'].'\'');

        $array = array();

        $array['krs'] = out_where('SELECT mk.nama, md.sks, mk.semester, pj.ruang, pj.jam_in, pj.jam_out, wk.nama as hari,
                        jk.id AS jadwal_krs_id, k.nama as nama_dosen
                        FROM jadwal_mahasiswa jm
                        JOIN jadwal_krs jk ON jk.id = jm.jadwal_krs_id
                        JOIN matkul_dosen md ON md.id = jk.matkul_dosen_id
                        JOIN dosen d ON d.id = md.dosen_id
                        JOIN karyawan k ON k.id = d.karyawan_id
                        JOIN penjadwalan pj ON pj.id = jk.penjadwalan_id
                        JOIN matakuliah mk ON mk.id = pj.id
                        JOIN siska.weekday wk ON wk.id = pj.weekday_id
                        WHERE jm.kalendar_akademik_id = '.$kalendar_akademik[0]->id.'
                        AND jm.mahasiswa_id = '.$mhs['id']);

        $array['mhs'] = $mhs;

        $this->page->konten = $this->parser->parse($this->views_dir.'jadwal', $array, true);
    }

    function dashboard(){
        $this->page->title = 'HALAMAN DASHBOARD';
        $array=array(
            'base_url' => base_url());
        $this->page->konten = $this->parser->parse($this->views_dir.'dashboard', $array, true);
    }

    function isi_krs(){
//SELECT SEMESTER
        $this->page->title = 'HALAMAN ISI KRS';

//checkBox
        $konten = array();


        $array = array(
            'heading' => array(
                'Pilih', 'MATA KULIAH', 'SKS', 'Semester', 'Pilih Ruang', 'Pilih Waktu', 'Pilih Hari', 'Keterangan'),
            'konten' => $konten,
            'action' => base_index().'mhs_jadwal/isi',
        );

        $mhs = (array)$this->page->data_siswa;

        $kalendar_akademik = out_where('SELECT * FROM kalendar_akademik WHERE aktif = 1
                             AND programstudi_kode = \''.$mhs['programstudi_kode'].'\'');

        // ini tambahan untuk mengirim data mahasiswa ke view
        $array = $array + array(
            'data_mhs' => (array)$this->page->data_siswa,
            'kalendar_akademik_id' => $kalendar_akademik[0]->id,
            'makuls' => out_where('SELECT mk.nama, md.sks, mk.semester, pj.ruang, pj.jam_in, wk.nama as hari,
                        jk.id AS jadwal_krs_id FROM jadwal_krs jk
                        JOIN matkul_dosen md ON md.id = jk.matkul_dosen_id
                        JOIN penjadwalan pj ON pj.id = jk.penjadwalan_id
                        JOIN matakuliah mk ON mk.id = pj.id
                        JOIN siska.weekday wk ON wk.id = pj.weekday_id WHERE mk.semester = '.$mhs['semester'].'
                        OR mk.semester = '.intval($mhs['semester']+2))
        );


        $this->page->konten = $this->parser->parse($this->views_dir.'isi_krs', $array, true, 'refresh');
    }

    function isi(){

        $id_kalendar_akademik = $this->input->post('id_kalendar_akademik');
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $id_jadwals = $this->input->post('id_jadwal_krs');
        $sks = $this->input->post('sks');

        $jumlah = 0;
        foreach($id_jadwals as $jadwal)
        {
            $jumlah += $this->input->post($jadwal);
        }
        if ($jumlah > 24)
        {
            $this->session->set_flashdata('warning','Maaf, SKS yang diambil melebihi batas (24 SKS)');
            $redirect = 'mhs_jadwal/isi_krs';
        }
        else
        {
            foreach($id_jadwals as $id_jadwal){
                $row = array('kalendar_akademik_id' => $id_kalendar_akademik, 'mahasiswa_id' => $id_mahasiswa,
                            'jadwal_krs_id' => $id_jadwal);
                $this->db->insert('jadwal_mahasiswa',$row);
            }

            $this->session->set_flashdata('message','Pengisian KRS berhasil.');

            $redirect = 'mhs_jadwal/dashboard';
        }

        redirect(base_index().$redirect);
    }

    function dashboard_krs(){
        $this->page->title = 'HALAMAN KRS SISWA';

        $mhs = (array)$this->page->data_siswa;
        $kalendar_akademik = out_where('SELECT * FROM kalendar_akademik WHERE aktif = 1
                             AND programstudi_kode = \''.$mhs['programstudi_kode'].'\'');

        $jadwal = out_where('SELECT * FROM jadwal_mahasiswa WHERE mahasiswa_id = '.$mhs['id']);

        $udah_diambil = out_where('SELECT mk.nama, md.sks, mk.semester, pj.ruang, pj.jam_in, wk.nama as hari,
                        jk.id AS jadwal_krs_id, k.nama as nama_dosen
                        FROM jadwal_mahasiswa jm
                        JOIN jadwal_krs jk ON jk.id = jm.jadwal_krs_id
                        JOIN matkul_dosen md ON md.id = jk.matkul_dosen_id
                        JOIN dosen d ON d.id = md.dosen_id
                        JOIN karyawan k ON k.id = d.karyawan_id
                        JOIN penjadwalan pj ON pj.id = jk.penjadwalan_id
                        JOIN matakuliah mk ON mk.id = pj.id
                        JOIN siska.weekday wk ON wk.id = pj.weekday_id WHERE jm.mahasiswa_id = '.$mhs['id']);

        $konten = array();
        $no = 1;
        foreach($udah_diambil as $data){
            $keterangan = 'sudah diambil';
            $konten[] = array($no, $data->nama, $data->sks, $keterangan);
            $no++;
        }

        $array = array(
            'sudah_isi_krs' => count($jadwal),
            'base_url' => base_url(),
            'heading' => array('No', 'Mata Kuliah', 'SKS', 'Keterangan'),
            'konten' => $konten,
            'action' => base_index().'mhs_jadwal/isi_krs',
            'nim' => $this->session->userdata("id_user"),
            'nama' => $mhs['nama'],
            'mhs' => $mhs,
            'tahun_akademik' => $kalendar_akademik[0]->tahun_akademik

        );

        // ini tambahan untuk mengirim data mahasiswa yang login ke view
        $array = $array + array('data_mhs' => (array)$this->page->data_siswa);

        $this->page->konten = $this->parser->parse($this->views_dir.'dashboard_krs', $array, true);
    }
}