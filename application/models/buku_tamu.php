<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class buku_tamu extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->view_dir = $this->page->tpl.'alumni_bukutamu/';
    }
    
    function form_buku_tamu(){
        $this->page->title = 'Home Sistem Akademik';
        $this->page->konten = '';
        $array = array(
            'action' => base_index().'post/buku_tamu/simpan_komentar',
            'assets_url' => $this->page->assets_url,
        );
        
        $this->page->konten = $this->parser->parse($this->view_dir.'form_buku_tamu', $array, true);
    }
    
    function simpan_komentar(){
    
        if (cek_captcha())
        {
            $fields = $this->input->post(null, true);
            unset($fields["recaptcha_challenge_field"]);
            unset($fields["recaptcha_response_field"]);
            $this->db->insert("bukutamu", $fields);
        }
        $array = array(
            'action' => base_index().'post/buku_tamu/simpan_komentar',
            'assets_url' => $this->page->assets_url,
        );
        redirect("buku_tamu/form_buku_tamu");
        
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
