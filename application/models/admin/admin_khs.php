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
        //$id = (isset($_POST["jadwal_krs_id"]) and !empty($_POST["jadwal_krs_id"]))?$_POST["jadwal_krs_id"]:"";

        $id = $this->input->get('jadwal_krs_id');
        $konten = array();
        $show_tb = false;
        $selected_mk = '';
        if($id > 0){
            $selected_mk = $id;

            $rows = out_where("select a.nim, a.nama, c.id
                                from mahasiswa as a,  jadwal_mahasiswa as c, jadwal_krs as d
                                where a.id=c.mahasiswa_id and c.jadwal_krs_id=d.id and d.id='".$id."'");

            $no=1;

            if(count($rows) < 1){
                $this->page->konten = 'data nilai tidak ditemukan';
                return;
            }

            foreach ($rows as $row) {
                //query untuk nilai
                $query_nilai = out_where ("select nama, id from grade ");
                $rownilai[""] = ":: nilai ::";
                foreach($query_nilai as $nilai){
                    $rownilai[$nilai->id] = $nilai->nama;
                }
                $sel = '';
                $khs = out_row('khs', array('jadwal_mahasiswa_id' => $row->id));
                if(count($khs) > 0){
                    $sel = $khs->grade_id;
                }


                $konten [] = array ($no, $row->nim, $row->nama, (form_dropdown("grade_id[".$row->id."]", $rownilai ,$sel, "id='grade_id' ")));
                $no++;
            }

            $show_tb = true;

        }

        //untuk di tampilkan
        $array = array(
            'page_title' => 'FORM TAMBAH NILAI',
            //'konten2' => $konten2,
            'title2' => 'Jadwal:',
            'dropdown_jadwal'=> form_dropdown("jadwal_krs_id",$row_jadwal, $selected_mk, "id='jadwal_krs_id' "),
            'heading' => array('#', 'NIM', 'NAMA MAHASISWA', 'NILAI'),
            'konten' => $konten,
            'show_tb' => $show_tb,
			'action' => base_index().'admin/post/admin_khs/save_nilai?jadwal_krs_id='.$id
        );

        $this->page->konten = $this->parser->parse($this->page->tpl.'khs/form_add_nilai.php',$array, true);

    }

    function save_nilai(){
        //print_r($this->input->post());
        $url = '';
        $krs_id = $this->input->get('jadwal_krs_id');

        if($krs_id > 0){
            $url = '?jadwal_krs_id='.$krs_id;
        }

        $grade = $this->input->post('grade_id');

        if(count($grade) < 1){
            redirect(base_index().'admin/admin_khs/list_khs'.$url);
            return;
        }

        foreach($grade as $key => $item){
            if($item < 1){continue;}
            $khs = out_row('khs', array('jadwal_mahasiswa_id' => $key));
            if(count($khs) > 0){
                $this->db->update("khs",array('grade_id' => $item), array('jadwal_mahasiswa_id' => $key));
            } else{
                $this->db->insert("khs",array('jadwal_mahasiswa_id' => $key, 'grade_id' => $item));
            }

        }
        //echo $this->db->last_query();
        $this->page->konten = '';
        redirect(base_index().'admin/admin_khs/list_khs'.$url);

    }


    //untuk melihat nilai dari sisi dosen
    function lihat_khs(){
        $iduser = ($this->session->userdata("id_user"));
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

        //daftar mahasiswa
        $id = (isset($_POST["jadwal_krs_id"]) and !empty($_POST["jadwal_krs_id"]))?$_POST["jadwal_krs_id"]:"";

        $rows = out_where("select a.nim, a.nama, c.id, f.nama as nilai, f.bobot
                            from mahasiswa as a,  jadwal_mahasiswa as c, jadwal_krs as d, khs as e, grade as f
                            where a.id=c.mahasiswa_id and c.id=e.jadwal_mahasiswa_id and e.grade_id=f.id and c.jadwal_krs_id=d.id and d.id='".$id."' ");
        $konten = array();
        $no=1;
        foreach (@$rows as $row) {
           // $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_karyawan/form_edit_khs/'.int2kal($row->id).'">edit</a></div>';
            $konten [] = array ($no, $row->nama, $row->nilai, $row->bobot);
            $no++;
        }



        $array=array(
            'page_title' => 'FORM LIHAT NILAI',
            'title2' => 'Jadwal:',
            'dropdown_jadwal'=> form_dropdown("jadwal_krs_id",$row_jadwal,"", "id='jadwal_krs_id' "),
            'heading' => array('#', 'NAMA MAHASISWA', 'NILAI', 'BOBOT'),
            'konten' => $konten,
			
        );

        $this->page->konten = $this->parser->parse($this->page->tpl.'khs/Form_lihat_nilai.php',$array, true);

    }


    // untuk melihat nilai dari sisi mahasiswa
    function look_khs(){
        $iduser = ($this->session->userdata("id_user"));

        $rows = out_where("select a.nama, f.nama as nilai, f.bobot, b.sks, g.nama as mhs
                            from matakuliah as a, matkul_dosen as b, jadwal_krs as c,jadwal_mahasiswa as d, khs as e, grade as f, mahasiswa as g
                            where a.id=b.matakuliah_id and b.id=c.matkul_dosen_id and c.id=d.jadwal_krs_id and d.id=e.jadwal_mahasiswa_id
                                and e.grade_id=f.id and d.mahasiswa_id=\"".$iduser."\" and g.id=d.mahasiswa_id");//
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

        $this->page->konten = 'Halaman Admin Dosen';
        $this->page->konten = $this->parser->parse($this->page->tpl.'khs/Form_look_khs.php',$array, true);
    }


}
