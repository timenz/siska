<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/page');
    }

    public function index() {
        $uri = $this->uri->segment(2, '');
        if( $uri == 'post' or $uri == 'json_print'){
            return $this->post($uri);
        }

        if( $uri == 'page_not_found'){
            return $this->page_not_found();
        }

        return $this->main();
    }

    function main(){
        $model = $this->uri->segment(2, 'admin_common');
        $method = $this->uri->segment(3, 'homepage');

        $tpl = 'home_admin';

        $this->page->model = $model;
        $this->page->method = $method;

        if(!$this->page->is_login()){
            $this->page->model = 'user';
            $this->page->method = 'login_form';
            $tpl = 'login';
        }

        $lang = get_lang($this->page->lang, 'view_file', $tpl);

        $array = $this->page->get_data();
        $out = array_merge($array, $lang);
        $this->parser->parse($this->page->tpl.$tpl, $out);
    }

    function post($uri){
        $model = $this->uri->segment(3, '');
        $method = $this->uri->segment(4, '');
        $this->page->model = $model;
        $this->page->method = $method;

        if($model == '' or $method == ''){
            return '';
        }

        if($uri == 'post'){
            return $this->page->get_data('post');
        }
        print(json_encode($this->page->get_data('post')));
        return '';
    }

    function page_not_found(){
        $array = array(
            'assets_url' => $this->page->assets_url,
            'title' => 'page_not_found'
        );
        $this->parser->parse($this->page->tpl.'page_not_found', $array);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */