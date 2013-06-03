<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_jadwal extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'penjadwalan/';
    }

    function home1(){
        $this->page->title = 'HALAMAN DASHBOARD';
        $array=array();
        $this->page->konten = $this->parser->parse($this->views_dir.'home1', $array, true);
    }

    function dashboard(){
        $this->page->title = 'HALAMAN DASHBOARD';
        $array=array(
            "baseurl" => base_url()
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'dashboard', $array, true);
    }

    function isi_krs(){
        $today=date('Y');
        $this->page->title = 'HALAMAN ISI KRS';
        $iduser=$this->session->userdata("id_user");
        $user = out_row('select * from web_user join karyawan on karyawan.id = web_user.id_karyawan
                        where web_user.id = "'.$this->session->userdata("id_user").'" ');

        $queries = out_where("select matakuliah.*, matkul_dosen.sks as matkul_dosen_sks
                            from matakuliah
                            join matkul_dosen on matkul_dosen.matakuliah_id = matakuliah.id");

        $query_ruang = out_where("select * from penjadwalan order by ruang asc");
        $row_penjadwalan[""] = "::Pilih Waktu";
        foreach($query_ruang as $ruang){
            $row_penjadwalan[$ruang->id] = $ruang->ruang;
        }

        $konten = array();

//checkBox
//        $query="select * from matakuliah join jadwal_krs on jadwal_krs.id = matakuliah.";
//        $hasil= mysql_query($query);
//        $semester= $today;
//        while ($data=mysql_fetch_array($hasil)){
            $item1 = '<input type="checkbox" name="row_sel">';

//        }

/*        $no=1;
        $jumMK=$_POST['jumMK'];
        for($i = 1; $i <= $jumMK; $i++)
        {
            $mk = $_POST['matakuliah'.$i];
            if (!empty($mk))
            {
                $query = "INSERT INTO jadwal_krs VALUES('$kalendar_akademik_id', '$jadwal_krs_id', '$mahasiswa_nim', 0)";
                mysql_query($query);
            }
        }
*/

//DROPDOWN
        $dropdown_ruang = form_dropdown("penjadwalan_id",$row_penjadwalan, "", "id='penjadwalan_id'");
        $link = '<div class="btn"><a role="button" data-toggle="modal" href = "'.base_index().'admin/admin_jadwal/isi_krs/#myModal" >View</a></div>';

//        $smtr_mhs=out_where("select mahasiswa.tahun_masuk as mahasiswa_masuk, mahasiswa.nim as mahasiswa_nim from mahasiswa");

        foreach($queries as $query){
            $konten[] = array($item1, $query->nama, $query->matkul_dosen_sks, $dropdown_ruang, "", $link);
        }

        $array = array(
            'heading' => array('Pilih', 'Mata Kuliah', 'SKS', 'Ruang', 'Hari','Keterangan'),
            'konten' => $konten,
            'nim' => $iduser,
//            'kategori' => ,
            'nama' => $user -> nama,

        );
        $this->page->konten = $this->parser->parse($this->views_dir.'isi_krs', $array, true);
    }

    function isi(){
        $array=array(
            'ruang' => $this->input->post('ruang'),
        );
        $this->db->insert('jadwal_mahasiswa', $array);
        redirect(base_index().'admin/admin_jadwal/isi_krs');
    }

    function jadwal(){
        $this->page->title = 'HALAMAN KRS MAHASISWA';
        $array=array(
            "baseurl" => base_url()
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'jadwal', $array, true);
    }

    function test_pop(){
        $this->page->title = 'HALAMAN KRS MAHASISWA';
        $array=array(
            "baseurl" => base_url()
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'test_pop', $array, true);
    }

    function dashboard_krs(){
        $this->page->title = 'HALAMAN KRS SISWA';

        $user = out_row('select * from web_user join karyawan on karyawan.id = web_user.id_karyawan where web_user.id = "'.$this->session->userdata("id_user").'" ');

        $queries = out_where("select matakuliah.*, matkul_dosen.sks as matkul_dosen_sks from matakuliah join matkul_dosen on matkul_dosen.matakuliah_id = matakuliah.id");

        $konten = array();
        $no = 1;
        foreach($queries as $query){
            $keterangan = 'sudah diambil';
            $konten[] = array($no, $query->nama, $query->matkul_dosen_sks, $keterangan);
            $no++;
        }

        $array = array(
            'heading' => array('No', 'Mata Kuliah', 'SKS', 'Keterangan'),
            'konten' => $konten,
            'action' => base_index().'admin/admin_jadwal/isi_krs',
            'nim' => $this->session->userdata("id_user"),
            'nama' => $user -> nama

        );
        $this->page->konten = $this->parser->parse($this->views_dir.'dashboard_krs', $array, true);
    }

}