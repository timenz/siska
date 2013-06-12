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

        $kalendar_akademik = out_where('SELECT * FROM kalendar_akademik WHERE aktif = 1 AND programstudi_kode = \''.$mhs['programstudi_kode'].'\'');

        $array = array();

        $array['krs'] = out_where('SELECT mk.nama, md.sks, mk.semester, pj.ruang, pj.jam_in, wk.nama as hari, jk.id AS jadwal_krs_id, k.nama as nama_dosen
                        FROM jadwal_mahasiswa jm
                        JOIN jadwal_krs jk ON jk.id = jm.jadwal_krs_id
                        JOIN matkul_dosen md ON md.id = jk.matkul_dosen_id
                        JOIN dosen d ON d.id = md.dosen_id
                        JOIN karyawan k ON k.id = d.karyawan_id
                        JOIN penjadwalan pj ON pj.id = jk.penjadwalan_id
                        JOIN matakuliah mk ON mk.id = pj.id
                        JOIN siska.weekday wk ON wk.id = pj.weekday_id WHERE jm.kalendar_akademik_id = '.$kalendar_akademik[0]->id.'
                        AND jm.mahasiswa_id = '.$mhs['id']);

        $array['mhs'] = $mhs;

        $this->page->konten = $this->parser->parse($this->views_dir.'jadwal', $array, true);
    }

    function dashboard(){
        $this->page->title = 'HALAMAN DASHBOARD';
//        $iduser=$this->session->userdata("id_user");
        $user = out_row('select * from web_user join mahasiswa on mahasiswa.id = web_user.id_karyawan
                        where web_user.id = "'.$this->session->userdata("id_user").'" ');
        $iduser=$this->session->userdata("id_user");

//        $x=out_row("select * from mahasiswa where email = $_P");
        $array=array(
            'base_url' => base_url(),
            'nim' => "2013-FIK-TI-007",

        );

        $this->page->konten = $this->parser->parse($this->views_dir.'dashboard', $array, true);
    }

    function isi_krs(){
//SELECT SEMESTER
        $this->page->title = 'HALAMAN ISI KRS';
        $iduser=$this->session->userdata("id_user");
        $user = out_row('select * from web_user join mahasiswa on mahasiswa.id = web_user.id_karyawan
                        where web_user.id = "'.$this->session->userdata("id_user").'" ');

        $today=date('Y');

//PEMBATASAN RUANG
        $penjadwalan=out_where("SELECT COUNT(penjadwalan.id) FROM penjadwalan, jadwal_krs, jadwal_mahasiswa
                            WHERE jadwal_krs.penjadwalan_id=penjadwalan.id AND jadwal_krs.id=jadwal_mahasiswa.jadwal_krs_id
                            GROUP BY ruang asc");
        $btsruang=array('$penjadwalan->quota');
//        if($penjadwalan<$btsruang){
//            echo "Full";
//        } else{echo"Empty";}

//DROPDOWN
        $query_waktu = out_where("select * from penjadwalan order by jam_in asc");
        $row_penjadwalan[" "] = " ";
        foreach($query_waktu as $waktu){
            $row_penjadwalan["$waktu->jam_in"] = $waktu->jam_in;
        }
        $dropdown_waktu = form_dropdown("penjadwalan_id",$row_penjadwalan, "id='penjadwalan_id'");

        $link = '<div class="btn"><a role="button" data-toggle="modal" href = "'.base_index().'mhs_jadwal/dashboard/#myModal" >View</a></div>';

        $query_hari = out_where("select * from weekday");
        $row_hari[" "]=" ";
        foreach($query_hari as $hari){
            $row_hari[$hari->nama]=$hari->nama;
        }
        $dropdown_hari = form_dropdown("weekday_id",$row_hari,"id='weekday_id'");

        $query_ruang = out_where("select penjadwalan.ruang from penjadwalan order by ruang asc");
        $row_ruang[" "]=" ";
        foreach($query_ruang as $ruang){
            $row_ruang[$ruang->ruang]=$ruang->ruang;
        }
        $dropdown_ruang = form_dropdown("penjadwalan_id",$row_ruang,"id='penjadwalan_id'");

///Perbandingan Semester tiap siswa
        $semester= 1;

        if($semester==1){
            $mks1=2;    $mks2=4;
        } elseif($semester==2){
            $mks1=3;    $mks2=5;
        } elseif($semester==3){
            $mks1=4;    $mks2=6;
        } elseif($semester==4){
            $mks1=5;    $mks2=7;
        } elseif($semester==5){
            $mks1=6;    $mks2=8;
        } elseif($semester==6){
            $mks1=7;    $mks2=0;
        } elseif($semester==7){
            $mks1=8;    $mks2=0;
        } else{
            $mks1=0;    $mks2=0;
        }

        $queries = out_where("select matakuliah.*, matkul_dosen.sks as matkul_dosen_sks
                            from matakuliah
                            join matkul_dosen on matkul_dosen.matakuliah_id = matakuliah.id
                            where matakuliah.semester=$mks1 or matakuliah.semester=$mks2 and matakuliah.fakultas_kode='FIK'");

//ISI VIEWS
        $konten = array();
        $no=1;

        foreach($queries as $query){
            $item1 = "<input type='checkbox' name='id[]'
                     value='$query->nama, $query->matkul_dosen_sks, $query->semester, $dropdown_waktu, $dropdown_hari, $link'
                     id=$no>
                     <td>$query->nama</td><td><center>$query->matkul_dosen_sks</center></td><td><center>$query->semester</center></td><td>$dropdown_ruang</td><td>$dropdown_waktu</td><td>$dropdown_hari</td><td><center>$link</center></td>";
            $no++;
            $konten[] = array($item1);
        }

//checkBox


        $array = array(
            'heading' => array('Pilih', 'MATA KULIAH', 'SKS', 'Semester', 'Pilih Ruang', 'Pilih Waktu', 'Pilih Hari', 'Keterangan'),
            'konten' => $konten,
//            'nim' => $iduser,
            'semester' => $semester,
//            'nama' => $user -> nama,
            'action' => base_index().'mhs_jadwal/isi',
        );

        $mhs = (array)$this->page->data_siswa;

        $kalendar_akademik = out_where('SELECT * FROM kalendar_akademik WHERE aktif = 1 AND programstudi_kode = \''.$mhs['programstudi_kode'].'\'');

        // ini tambahan untuk mengirim data mahasiswa ke view
        $array = $array + array(
            'data_mhs' => (array)$this->page->data_siswa,
            'kalendar_akademik_id' => $kalendar_akademik[0]->id,
            'makuls' => out_where('SELECT mk.nama, md.sks, mk.semester, pj.ruang, pj.jam_in, wk.nama as hari, jk.id AS jadwal_krs_id FROM jadwal_krs jk
                        JOIN matkul_dosen md ON md.id = jk.matkul_dosen_id
                        JOIN penjadwalan pj ON pj.id = jk.penjadwalan_id
                        JOIN matakuliah mk ON mk.id = pj.id
                        JOIN siska.weekday wk ON wk.id = pj.weekday_id WHERE mk.semester = '.$mhs['semester'])
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
            $this->session->set_flashdata('warning','Maaf, SKS yang diambil melibihi batas (24 SKS)');
            $redirect = 'mhs_jadwal/isi_krs';
        }
        else
        {
            foreach($id_jadwals as $id_jadwal){
                $row = array('kalendar_akademik_id' => $id_kalendar_akademik, 'mahasiswa_id' => $id_mahasiswa, 'jadwal_krs_id' => $id_jadwal);
                $this->db->insert('jadwal_mahasiswa',$row);
            }

            $this->session->set_flashdata('message','Pengisian KRS berhasil.');

            $redirect = 'mhs_jadwal/dashboard';
        }

        redirect(base_index().$redirect);
    }

    function dashboard_krs(){
        $this->page->title = 'HALAMAN KRS SISWA';

        $user = out_row('select * from web_user join karyawan on karyawan.id = web_user.id_karyawan where web_user.id = "'.$this->session->userdata("id_user").'" ');

        $queries = out_where("select matakuliah.*, matkul_dosen.sks as matkul_dosen_sks from matakuliah join matkul_dosen on matkul_dosen.matakuliah_id = matakuliah.id");

        $mhs = (array)$this->page->data_siswa;
        $kalendar_akademik = out_where('SELECT * FROM kalendar_akademik WHERE aktif = 1 AND programstudi_kode = \''.$mhs['programstudi_kode'].'\'');

        $jadwal = out_where('SELECT * FROM jadwal_mahasiswa WHERE mahasiswa_id = '.$mhs['id']);

        $udah_diambil = out_where('SELECT mk.nama, md.sks, mk.semester, pj.ruang, pj.jam_in, wk.nama as hari, jk.id AS jadwal_krs_id, k.nama as nama_dosen
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
            'nama' => $user -> nama,
            'mhs' => $mhs,
            'tahun_akademik' => $kalendar_akademik[0]->tahun_akademik

        );

        // ini tambahan untuk mengirim data mahasiswa yang login ke view
        $array = $array + array('data_mhs' => (array)$this->page->data_siswa);

        $this->page->konten = $this->parser->parse($this->views_dir.'dashboard_krs', $array, true);
    }

    function home1(){
        $this->page->title = 'HALAMAN DASHBOARD';
        $array=array();
        $this->page->konten = $this->parser->parse($this->views_dir.'home1', $array, true);
    }
}