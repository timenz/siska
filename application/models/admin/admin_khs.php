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
        $query_jadwal = out_where("   select b.id as id, d.nama as hari,i.nama, c.ruang as ruang, c.jam_in as jamin, c.jam_out as jamout
                            from jadwal_krs as b, penjadwalan as c, weekday as d, matkul_dosen as e,
                                dosen as f, karyawan as g, web_user as h, matakuliah as i
                            where d.id=c.weekday_id and c.id=b.penjadwalan_id and b.matkul_dosen_id=e.id
                                  and e.dosen_id=f.id and f.karyawan_id=g.id and h.id_karyawan = g.id and h.id = \"".$iduser."\"
                                  and e.matakuliah_id=i.id");
        $row_jadwal[""] = ":: matakuliah ::";
        foreach($query_jadwal as $jadwal){
            $row_jadwal[$jadwal->id] = $jadwal->nama." - ".$jadwal->ruang." - ".$jadwal->jamin." - ".$jadwal->jamout ;
        }


        //query untuk daftar nama mahasiswa
            //tombom daftar mhs
            $id = (isset($_POST["jadwal_krs_id"]) and !empty($_POST["jadwal_krs_id"]))?$_POST["jadwal_krs_id"]:"";

        $rows = out_where("select a.nim, b.nama, c.id
                            from mahasiswa as a, calon_mahasiswa as b, jadwal_mahasiswa as c, jadwal_krs as d
                            where a.calon_mahasiswa_id=b.id and a.id=c.mahasiswa_id and c.jadwal_krs_id=d.id and d.id='".$id."'");
        $konten = array();
        $no=1;


        foreach (@$rows as $row) {
            //query untuk nilai
            $query_nilai = out_where ("select nama, id from grade ");
            $rownilai[""] = ":: nilai ::";
            foreach($query_nilai as $nilai){
                $rownilai[$nilai->id] = $nilai->nama;
            }


            $konten [] = array ($no, $row->nim, $row->nama, (form_dropdown("grade_id", $rownilai ,"", "id='grade_id' ")));
            $no++;
        }

        //insert khs
        if (isset($_POST["Submit"]) and $_POST["Submit"] == "SAVE"){
        $jadwal_mahasiswa_id= $_POST["jadwal_mahasiswa_id"];
        $grade_id= $_POST["grade_id"];


            $simpankhs= out_where("insert khs set id='',jadwal_mahasiswa_id='$jadwal_mahasiswa_id', grade_id='$grade_id'");
        }





        //untuk di tampilkan
        $array = array(
            'page_title' => 'FORM TAMBAH NILAI',
            'konten2' => $konten2,
            'title2' => 'Jadwal:',
            'dropdown_jadwal'=> form_dropdown("jadwal_krs_id",$row_jadwal,"", "id='jadwal_krs_id' "),
            'heading' => array('#', 'NIM', 'NAMA MAHASISWA', 'NILAI'),
            'konten' => $konten,
        );

        $this->page->konten = $this->parser->parse($this->page->tpl.'khs/Form_add_nilai.php',$array, true);

    }





    // untuk melihat nilai
    function look_khs(){
        $rows = out_where("select a.nama, f.nama as nilai, f.bobot, b.sks
                            from matakuliah as a, matkul_dosen as b, jadwal_krs as c,jadwal_mahasiswa as d, khs as e, grade as f
                            where a.id=b.matakuliah_id and b.id=c.matkul_dosen_id and c.id=d.jadwal_krs_id and d.id=e.jadwal_mahasiswa_id
                                and e.grade_id=f.id and d.mahasiswa_id='2'");//
        $konten = array();
        $no=1;
        $total=0;
        $tot_sks=0;

        foreach (@$rows as $row) {
            $konten [] = array ($no, $row->nama, $row->nilai, $row->bobot, $row->sks);
            $total=($row->bobot* $row->sks)+$total;
            $tot_sks=$row->sks+$tot_sks;
            $no++;
        }
        $ipk = $total / $tot_sks;
        $array = array(
            'page_title' => 'KARTU HASIL STUDY',
            'ipk=' => 'IPK =',
            'heading' => array('#', 'MAKUL', 'NILAI', 'BOBOT', 'SKS'),
            'ipk' => $ipk,
            'konten' => $konten,

        );

        $this->page->konten = 'Halaman Admin Dosen';
        $this->page->konten = $this->parser->parse($this->page->tpl.'khs/Form_lihat_khs.php',$array, true);
    }


}
