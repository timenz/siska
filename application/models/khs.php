<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class khs extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'khs/';

    }

    function list_nilai(){
        //$iduser = ($this->session->userdata("id_user"));

        $rows = out_where("select a.nama, f.nama as nilai, f.bobot, b.sks, g.nama as mhs
                            from matakuliah as a, matkul_dosen as b, jadwal_krs as c,jadwal_mahasiswa as d, khs as e, grade as f, mahasiswa as g
                            where a.id=b.matakuliah_id and b.id=c.matkul_dosen_id and c.id=d.jadwal_krs_id and d.id=e.jadwal_mahasiswa_id
                                and e.grade_id=f.id and d.mahasiswa_id='2' and g.id=d.mahasiswa_id");//   \"".$iduser."\"
        $konten = array();
        $no=1;
        $total=0;
        $tot_sks=0;

        foreach ($rows as $row) {
            $a=($row->bobot* $row->sks);
            $konten [] = array ($no, $row->nama, $row->sks, $row->nilai, $row->bobot, $a);
            $nama = $row->mhs;
            $total=$a+$total;
            $tot_sks=$row->sks+$tot_sks;
            $no++;
        }
        $ipk = $total / $tot_sks;
        $array = array(
            'page_title' => 'KARTU HASIL STUDY',
            'ipk=' => 'IPK = ',
            'sks' => 'TOTAL SKS = ',
            'heading' => array('#', 'MATA KULIAH', 'SKS', 'NILAI HURUF', 'NILAI ANGKA', 'SKS x NA'),
            'ipk' => $ipk,
            'selamat' => 'SELAMAT DATANG, ', 'nama' => $nama,
            'tot_sks' => $tot_sks,
            'konten' => $konten,
            'ket' => 'Jika ada kekeliruan dapat konfirmasi ke Tata Usaha'

        );






        $this->page->set_sidebar = true;
        $this->page->konten = $this->parser->parse($this->views_dir.'list_nilai', array(), true);
    }
}