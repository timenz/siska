<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_khs  extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'dosen/';
    }
    // untuk menambah nilai
    function list_khs(){
        //query untuk nama dosen
        $iduser = ($this->session->userdata("id_user"));

        $rows2 = out_where("select karyawan.nama
                            from karyawan, web_user
                            where web_user.id_karyawan = karyawan.id and web_user.id = \"".$iduser."\" ");
        $konten2 = array();
        $no2=1;

        foreach (@$rows2 as $row2) {
            $konten2 [] = array ('Nama Dosen :', $row2->nama);
            $no2++;
        }

        //query untuk nama jadwal
        $rows3 = out_where("select d.nama as hari,i.nama, c.ruang as ruang, c.jam_in as jamin, c.jam_out as jamout
                            from jadwal_mahasiswa as a, jadwal_krs as b, penjadwalan as c, weekday as d, matkul_dosen as e,
                                dosen as f, karyawan as g, web_user as h, matakuliah as i, kalendar_akademik as j
                            where d.id=c.weekday_id and c.id=b.penjadwalan_id and b.id=a.jadwal_krs_id and b.matkul_dosen_id=e.id
                                  and e.dosen_id=f.id and f.karyawan_id=g.id and h.id_karyawan = g.id and h.id = \"".$iduser."\"
                                  and e.matakuliah_id=i.id and j.id=a.kalendar_akademik_id");
        $konten3 = array();
        $no3=1;

        foreach (@$rows3 as $row3) {
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_khs/form_add_nilai/'.int2kal($row->id).'">Tambah Nilai</a></div>';
            $konten3 [] = array ($row3->hari, $row3->nama, $row3->ruang , $row3->jamin, $row3->jamout);
            $no3++;
        }

        //query untuk daftar nama mahasiswa
        $rows = out_where("select mahasiswa.nim, calon_mahasiswa.nama
                            from mahasiswa, calon_mahasiswa
                            where mahasiswa.calon_mahasiswa_id=calon_mahasiswa.id");
        $konten = array();
        $no=1;

        foreach (@$rows as $row) {
            $nilai = '<input type="text" name="nilai" class="input-xlarge">';
            $konten [] = array ($no, $row->nim, $row->nama, $nilai);
            $no++;
        }




        //untuk di tampilkan
        $array = array(
            'heading' => array('#', 'NIM', 'NAMA MAHASISWA', 'NILAI'),
            'heading3' => array('hari', 'makul', 'ruang', 'jam masuk', 'jam keluar', ),
            'konten' => $konten,
            'page_title' => 'FORM TAMBAH NILAI',
            'title2' => 'Jadwal:',
            'konten2' => $konten2,
            'konten3' => $konten3,

        );

        $this->page->konten = 'Halaman Admin untuk KHS';

        $this->page->konten = $this->parser->parse($this->page->tpl.'khs/Form_add_nilai.php',$array, true);

    }





    // untuk melihat nilai
    function look_khs(){
        $this->page->konten = 'Halaman Admin Dosen';
    }

    function form_add_nilai(){
        $this->page->konten = 'Halaman Admin Dosen';
    }
}
