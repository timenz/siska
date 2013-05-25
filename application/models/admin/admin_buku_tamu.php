<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_buku_tamu extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'buku_tamu/';
    }

    function homepage(){
        $this->page->title = 'Home Sistem Akademik - Buku Tamu';
        $array = array(

        );

        $this->page->konten = $this->parser->parse($this->page->tpl.'dashboard', $array, true);
    }

    function list_buku_tamu(){
        $keyword = "";
        if($_POST){
            $keyword = $this->input->post("keyword");
            $rows = out_where(" select *
                                from bukutamu
                                where   nama like \"%".$keyword."%\" or
                                        email like \"%".$keyword."%\" or
                                        subject like \"%".$keyword."%\" or
                                        message like \"%".$keyword."%\" or
                                        alamat like \"%".$keyword."%\" or
                                        telp like \"%".$keyword."%\"
                                order by id desc limit 1000");
        }
        else{
            $rows = out_where("select * from bukutamu order by id desc limit 1000");
        }

        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_buku_tamu/hapus/'.int2kal($row->id).'">Hapus</a></div>';
            $link .= '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/admin_buku_tamu/reply/'.int2kal($row->id).'">Lihat</a></div>';
            $konten[] = array($no, date("j F Y",strtotime($row->tgl_posting)), $row->nama, $row->email, $row->alamat, $row->telp, $row->subject, ($row->is_read == 1)?"Yes":"No", ($row->is_reply == 1)?"Yes":"No",($row->is_publish == 1)?"Yes":"No",$link);
            $no++;
        }

        $array = array(
            'heading' => array('', 'Tgl Posting', 'Nama', 'Email', 'Alamat', 'Telp', 'Subject', 'Sudah Dibaca', 'Sudah Dibalas', 'Tampil', 'Action'),
            'konten' => $konten,
            'keyword' => $keyword,
            'page_title' => 'Listing Buku Tamu',
            'action' => base_index().'admin/admin_buku_tamu/list_buku_tamu',
            //'link_add' => array('name' => 'Tambah User', 'link' => base_index().'admin/user/form_add_user')
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'list_buku_tamu', $array, true);
    }

    function hapus(){
        $id = kal2int(mysql_real_escape_string(urinext('hapus')));
        if (!$id){redirect("admin/admin_buku_tamu/list_buku_tamu");}
            $this->db->delete("bukutamu", array("id" => $id));

        $this->page->konten = "";
        redirect("admin/admin_buku_tamu/list_buku_tamu");
    }

    function publish(){
        $id = kal2int(mysql_real_escape_string(urinext('publish')));
        if (!$id){redirect("admin/admin_buku_tamu/list_buku_tamu");}
        $this->db->update("bukutamu", array("is_publish" => "1"),array("id" => $id));

        $this->page->konten = "";
        redirect("admin/admin_buku_tamu/list_buku_tamu");
    }

    function unpublish(){
        $id = kal2int(mysql_real_escape_string(urinext('unpublish')));
        if (!$id){redirect("admin/admin_buku_tamu/list_buku_tamu");}
        $this->db->update("bukutamu", array("is_publish" => "0"),array("id" => $id));

        $this->page->konten = "";
        redirect("admin/admin_buku_tamu/list_buku_tamu");
    }

    function reply($id = false){
        if($_POST){
            $id = mysql_real_escape_string($this->input->post('id'));

            if (!$id){redirect("admin/admin_buku_tamu/list_buku_tamu");}

            $arr_in['reply_message'] = $this->input->post('reply_message');
            $arr_in['tgl_reply'] = date("Y-m-d H:i:s");
            $arr_in['is_reply'] = 1;
            $arr_in['is_read'] = 1;
            $arr_in['karyawan_id'] = $this->session->userdata("id_user");

            $this->db->update('bukutamu', $arr_in, array('id' => $id));

            if (!empty($arr_in['reply_message'])){
                $pesan = out_row("select * from bukutamu where id = '".$id."'");
                $this->load->library('email');

                $config['protocol'] = 'mail';
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);

                $this->email->from('webmaster@dinus.ac.id', 'Admin Web Sofwate Engineering');
                $this->email->to($pesan->email);

                $this->email->subject('Re : '. $pesan->subject);
                $this->email->message($pesan->reply_message);

                if(!$this->email->send()){
                    echo $this->email->print_debugger();
                    exit();
                }
            }

            redirect(base_index().'admin/admin_buku_tamu/list_buku_tamu');
        }

        $id = kal2int(mysql_real_escape_string(urinext('reply')));
        $arr_in['is_read'] = 1;
        $this->db->update('bukutamu', $arr_in, array('id' => $id));

        $row = (array)out_row("select * from bukutamu where id = ".$id. " limit 1");

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/admin_buku_tamu/list_buku_tamu');}

        if ($row["is_publish"]){
            $btn_publish = anchor("admin/admin_buku_tamu/unpublish/".int2kal($row["id"]), "Un Publish", "class='btn btn-gebo btn-small'");
        }
        else{
            $btn_publish = anchor("admin/admin_buku_tamu/publish/".int2kal($row["id"]), "Publish", "class='btn btn-gebo btn-small'");
        }

        $array = array(
            'page_title' => 'Reply Pesan',
            'action' => base_index().'admin/admin_buku_tamu/reply',
            'link_back' => anchor("admin/admin_buku_tamu/list_buku_tamu", "Back", "class='btn btn-gebo btn-small'"),
            'link_publish' => $btn_publish,
            'row_bukutamu' => $row
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_buku_tamu', $array, true);
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
