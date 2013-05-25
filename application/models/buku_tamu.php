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
        $this->load->library('form_validation');
        $fields = $this->input->post(null, true);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Pesan', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $data["status"] = "error";
            $data["message"] = validation_errors();
        }
        else
        {
            $fields = $this->input->post(null, true);
            $fields["tgl_posting"] = date("Y-m-d H:i:s");
            $fields["is_publish"] = "1";
            $this->db->insert("bukutamu", $fields);

            if ($this->db->affected_rows()){
                $data["status"] = "success";
                $data["message"] = "Terimakasih atas masukannya";
            }
            else{
                $data["status"] = "error";
                $data["message"] = "Pesan gagal disimpan ";
            }
        }
        echo json_encode($data);
        $this->page->konten = "";
    }
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
