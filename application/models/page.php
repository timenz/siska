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
    }
    
    function get_data($model, $method, $mode = ''){
        $this->cek_permission($model, $method);
        
        if($mode == 'post'){
            return $this->konten;
        }
        
        $array = array(
            'base_url' => base_url(),
            'base_index' => base_index(),
            'assets_url' => $this->assets_url,
            'title' => $this->title,
            'description' => $this->description,
            'keyword' => $this->keyword,
            'konten' => $this->konten,
            'top_menu' => $this->top_menu,
        );
        
        
        
        return $array;
    }
    
    function cek_permission($model, $method){
        $array = array(
            'model' => $model,
            'method' => $method
        );
        $row = out_row('web_permission', $array);
        if(count($row) > 0){
            $this->permission = $row;
            $this->load->model($model);
            $this->$model->{$method}();
        }
    }
    
    function siswa_islogin(){
        $this->load->model('siswa');
        $this->siswa->is_login();
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
