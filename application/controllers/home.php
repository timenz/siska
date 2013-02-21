<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('page');
    }
    
    public function index() {
        $uri = $this->uri->segment(1, '');
        if( $uri == 'post' or $uri == 'json_print'){
            return $this->post($uri);
        }
        return $this->main();
    }
    
    function main(){
        $model = $this->uri->segment(1, 'common');
        $method = $this->uri->segment(2, 'homepage');
        
        $tpl = 'home_view';
        
        if(!$this->page->siswa_islogin()){
            $model = 'siswa';
            $method = 'login_form';
            $tpl = 'login_form';
            
        }
        $lang = get_lang($this->page->lang, 'view_file', $tpl);
        
        $array = $this->page->get_data($model, $method);
        $out = array_merge($array, $lang);
        $this->parser->parse($this->page->tpl.$tpl, $out);
    }
    
    function post($uri){
        $model = $this->uri->segment(2, '');
        $method = $this->uri->segment(3, '');
        if($model == '' or $method == ''){
            return '';
        }
        
        if($uri == 'post'){
            return $this->page->get_data($model, $method, 'post');
        }
        print(json_encode($this->page->get_data($model, $method, 'post')));
        return '';
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */