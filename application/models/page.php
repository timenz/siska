<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class page extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->lang = $this->config->item('lang');
        $this->tpl = $this->config->item('tpl');
        $this->assets_url = base_url().'assets/'.$this->tpl;
        $this->title = 'Home';
        $this->description = '';
        $this->author = '';
        $this->keyword = '';
        $this->top_menu = '';
        $this->web_mode = 'umum';
    }
    
    function get_data($mode = ''){
        $this->cek_permission();
        
        if($mode == 'post'){
            return $this->konten;
        }
        
        $this->set_top_menu();
        
        $array = array(
            'base_url' => base_url(),
            'base_index' => base_index(),
            'assets_url' => $this->assets_url,
            'title' => $this->title,
            'description' => $this->description,
            'keyword' => $this->keyword,
            'konten' => $this->konten,
            'top_menu' => $this->top_menu,
            'model' => $this->model,
            'method' => $this->method
        );
        return $array;
    }
    
    function cek_permission(){
        $model = $this->model;
        $method = $this->method;
        $array = array(
            'model' => $model,
            'method' => $method
        );
        $row = out_row('web_permission', $array);
        if(count($row) > 0){
            $this->permission = $row;
            $this->load->model($model);
            $this->$model->{$method}();
        }else{
            redirect(base_index().'page_not_found/');
        }
    }
    
    function mahasiswa_is_login(){
        $this->load->model('mahasiswa');
        $this->mahasiswa->is_login();
    }
    
    function set_top_menu(){
        $sql = "select*from web_permission where permission = '".$this->web_mode."' and is_visible = 'Y' order by urutan";
        $array = array();
        foreach(out_where($sql) as $row){
            $method = $row->method;
            if($method == 'home'){$method = '';}
            $array[] = array(
                'model' => $row->model,
                'method' => $method,
                'lang_method' => get_lang_by_code($row->method),
            );
        }
        $this->top_menu = $array;
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
