<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class zdev_permission extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'user/';
    }

    function list_permission(){
        $rows = out_where("select * from web_permission limit 1000");
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<a href="'.base_index().'admin/zdev_permission/form_edit_permission/'.int2kal($row->id).'">edit</a>';

            $parentz = 'none';
            $parent = out_row('web_permission', array('id' => $row->parent_model));
            if(count($parent) > 0){$parentz = $parent->model.'/'.$parent->method;}

            $konten[] = array($no, $parentz, $row->model, $row->method, $row->permission, $row->urutan, $row->is_visible, $link);
            $no++;
        }

        $array = array(
            'heading' => array('', 'Parent', 'Model', 'Method', 'Permission', 'Urutan', 'Top Menu', ''),
            'konten' => $konten,
            'page_title' => 'Listing Permission',
            'link_add' => array('name' => 'Tambah Permission', 'link' => base_index().'admin/zdev_permission/form_add_permission')
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

    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
