<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class mahasiswa extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->views_dir = $this->page->tpl.'mahasiswa/';
        
    }
    function is_login(){
        $id = $this->session->userdata('ms_id');
        if(strlen($id) > 0){
            $row = out_row('mahasiswa', array('id' => $id));
            if(count($row) > 0){
                $this->page->data_siswa = $row;
                $this->page->web_mode = 'mahasiswa';
                return true;
            }
        }

        $id = $this->session->userdata('cms_id');
        if(strlen($id) > 0){
            $row = out_row('calon_mahasiswa', array('id' => $id));
            if(count($row) > 0){
                $this->page->data_siswa = $row;
                $this->page->web_mode = 'calon_mahasiswa';
                return true;
            }
        }

        return false;
    }
    
    function login_form(){
        if($this->is_login()){ redirect(base_index(), 'refresh'); }
        $array = array(
            'assets_url' => $this->page->assets_url,
            'action' => base_index().'mahasiswa/cek_login'
        );
        $this->page->title = 'Halaman Login Siswa';
        $this->page->konten = $this->parser->parse($this->views_dir.'form_login', $array, true);
    }

    function cek_login(){
        if($this->is_login()){
            redirect(base_index(), 'refresh');
        }
        $isc = $this->input->post('is_calon');
        $tb = 'mahasiswa';
        $ses = 'ms_id';
        if($isc == 1){
            $ses = 'cms_id';
            $tb = 'calon_mahasiswa';
        }

        $array = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
        );

        $row = out_row($tb, $array);

        if(count($row) > 0){
            $this->session->set_userdata($ses, $row->id);
        }

        redirect(base_index().'mahasiswa/login_form', 'refresh');
    }

    function logout(){
        $this->session->unset_userdata('ms_id');
        $this->session->unset_userdata('cms_id');
        redirect(base_index().'mahasiswa/login_form', 'refresh');
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
