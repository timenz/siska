<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class zdev_permission extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'zdev_permission/';
    }

    function list_permission(){
        $filter = $this->input->get('role');
        $sql = "select a.*, b.value from web_permission a left join web_lang b on concat('lang_', a.method) = b.code and b.tipe = 'menu'";
        if($filter != ''){
            $sql .= " where permission = '".mysql_real_escape_string($filter)."' ";
        }
        $sql .= " limit 1000";
        $rows = out_where($sql);
        $konten = array();
        $no = 1;
        foreach($rows as $row){
            $link = '<div class="btn-group"><a class="btn btn-mini btn-success" href="'.base_index().'admin/zdev_permission/form_edit_permission/'.int2kal($row->id).'">edit</a></div>';

            $parentz = 'none';
            $parent = out_row('web_permission', array('id' => $row->parent_model));
            if(count($parent) > 0){$parentz = $parent->model.'/'.$parent->method;}

            $konten[] = array($no, $row->value, $parentz, $row->model, $row->method, $row->permission, $row->urutan, $row->is_visible, $link);
            $no++;
        }

        $role = (array)out_where('web_role', array());

        $array = array(
            'heading' => array('', 'Title', 'Parent', 'Model', 'Method', 'Permission', 'Urutan', 'Top Menu', ''),
            'konten' => $konten,
            'page_title' => 'Listing Permission',
            'role' => $role,
            'filter_action' => base_index().'admin/zdev_permission/list_permission'
        );
        $this->page->konten = $this->parser->parse($this->views_dir.'listing_permission', $array, true);
    }

    function form_add_permission(){
        $array = array(
            'page_title' => 'Form Tambah User',
            'row_role' => out_where('web_role', array()),
            'row_karyawan' => out_where('karyawan', array()),
            'action' => base_index().'admin/zdev_permission/save_add_permission'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_add_permission', $array, true);
    }

    function read_dir($dir = ''){
        $dirname = APPPATH.'models/'.$dir;
        $list = array();
        if ($handle = opendir($dirname)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if($entry == '.' or $entry == '..' or $entry == 'index.html'){continue;}
                if(is_dir($dirname.$entry)){
                    $r_list = $this->read_dir($entry.'/');
                    if(count($r_list) > 0){
                        $list = array_merge($list, $r_list);
                    }
                    //$list[] = $dirname.$entry;

                }else{
                    $list[] = array('name' => str_replace('.php', '', $entry), 'dir' => substr($dir, 0, -1));
                }

            }

            closedir($handle);
            return $list;
        }
    }

    function form_edit_permission(){


        $array = array(
            'page_title' => 'Form Edit Permission',
            'parent_permission' => out_where("select*from web_permission where is_visible = 'Y' "),
            'row_model' => $this->read_dir(),
            'action' => base_index().'admin/zdev_permission/save_edit_permission'
        );

        $this->page->konten = $this->parser->parse($this->views_dir.'form_edit_permission', $array, true);
    }

    function save_edit_permission(){

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
