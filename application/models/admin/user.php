<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class user extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'user/';
    }

    function is_login(){
        $id = $this->session->userdata('id_user');
        if(strlen($id) < 1){
            return false;
        }


        $row = out_row("select a.*, b.role, c.nama, c.alamat, c.telp from web_user a, web_role b, karyawan c where a.id_role = b.id and a.id_karyawan = c.id and a.id = $id ");
        if(count($row) > 0){
            $this->page->data_user = $row;
            $this->page->web_mode = $row->role;
            return true;
        }
        return false;
    }

    function login_form(){

        $array = array(
            'action' => base_index().'admin/post/user/cek_login'
        );
        $this->page->title = 'Halaman Login User Admin';
        $this->page->konten = $this->parser->parse($this->views_dir.'form_login', $array, true);
    }

    function cek_login(){
        $array = array(
            'username' => mysql_real_escape_string($this->input->post('username')),
            //'password' => mysql_real_escape_string($this->input->post('password')),
            'password' => md5(mysql_real_escape_string($this->input->post('password'))),
        );

        $row = out_row('web_user', $array);
        if(count($row) > 0){
            $this->session->set_userdata('id_user', $row->id);
        }
        redirect(base_index().'admin');

    }

    function logout(){
        $this->page->konten = '';
        $this->session->unset_userdata('id_user');
        redirect(base_index().'admin');
    }

    function list_user(){
        $rows = out_where("select a.*, b.role, c.nama from web_user a, web_role b, karyawan c where a.id_role = b.id and a.id_karyawan = c.id limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-small btn-success" href="'.base_index().'admin/user/form_edit_user/'.int2kal($row->id).'">edit</a></div>';
            $konten[] = array($no, $row->username, $row->role, $row->nama, $link);
            $no++;
        }

        $array = array(
            'heading' => array('#', 'Username', 'Role','Nama Karyawan', '#'),
            'konten' => $konten,
            'page_title' => 'Listing User',
            'link_add' => array('name' => 'Tambah User', 'link' => base_index().'admin/user/form_add_user')
        );
        $this->page->konten = $this->parser->parse($this->page->tpl.'listing', $array, true);
    }

    function form_add_user(){
        $array = array(
            'page_title' => 'Form Tambah User',
            'row_role' => out_where('web_role', array()),
            'row_karyawan' => out_where('karyawan', array()),
            'action' => base_index().'admin/user/add_user'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_user', $array, true);
    }

    function add_user(){
        $array = array(
            'username' => mysql_real_escape_string($this->input->post('username')),
            'password' => md5(mysql_real_escape_string($this->input->post('username'))),
            'id_karyawan' => mysql_real_escape_string($this->input->post('id_karyawan')),
            'id_role' => mysql_real_escape_string($this->input->post('id_role')),
        );

        $this->db->insert('web_user', $array);
        redirect(base_index().'admin/user/list_user');
    }

    function form_edit_user(){
        $id = kal2int(mysql_real_escape_string(urinext('form_edit_user')));
        $row = (array)out_row("select a.*, b.nama from web_user a, karyawan b where a.id = ".$id." and a.id_karyawan = b.id");

        if(count($row) < 1 and $id < 1){redirect(base_url().'admin/user/list_user');}

        $array = array(
            'page_title' => 'Form Edit User',
            'row_role' => out_where('web_role', array()),
            'row_karyawan' => out_where('karyawan', array()),
            'action' => base_index().'admin/user/edit_user',
            'row_user' => $row
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_user', $array, true);
    }

    function edit_user(){
        $id = mysql_real_escape_string($this->input->post('id'));
        $passwd = mysql_real_escape_string($this->input->post('password'));
        if($id < 1){redirect(base_index().'admin/user/list_user');}

        $arr_in = array('id_role' => mysql_real_escape_string($this->input->post('id_role')));
        if(strlen($passwd) > 0){
            $arr_in['password'] = md5($passwd);
        }

        $this->db->update('web_user', $arr_in, array('id' => $id));
        redirect(base_index().'admin/user/list_user');
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
