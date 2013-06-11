<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function base_index(){
    //return base_url().'index.php/';
    return base_url();
}

function urinext($var='') {
    $CI = & get_instance();
    if (!empty($var)) {
        $CI->uri_next = $CI->uri->uri_to_assoc(2);
        if (!empty($CI->uri_next[$var])) {
            return $CI->uri_next[$var];
        } else {
            $CI->uri_next = $CI->uri->uri_to_assoc(1);
            if (!empty($CI->uri_next[$var])) {
                return $CI->uri_next[$var];
            }
        }
    } else {
        return false;
    }
}

function out_where($tb, $where = array()) {
    $CI = & get_instance();

    if (count(explode(' ', $tb, 2)) > 1) {
        $query = $CI->db->query($tb);
    } else {
        $query = $CI->db->get_where($tb, $where);
    }
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }
}


function out_row($tb, $where = array()) {
    $CI = & get_instance();
    if (count(explode(' ', $tb, 2)) > 1) {
        $query = $CI->db->query($tb);
    } else {
        $query = $CI->db->get_where($tb, $where);
    }
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return array();
    }
}

function out_field($tb, $where = array(), $field = 'id') {
    $CI = & get_instance();
    if (count(explode(' ', $tb, 2)) > 1) {
        $query = $CI->db->query($tb);
    } else {
        $query = $CI->db->get_where($tb, $where);
    }
    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->$field;
    }
    return '';
}

function get_lang($tipe, $view = ''){
    $CI = & get_instance();
    $array = array(
        'lang' => $CI->config->item('lang'),
        'tipe' => $tipe,
    );
    
    if($view != ''){
        $array['view_filename'] = $view;
    }

    $out = array();
    foreach(out_where('web_lang', $array) as $row){
        $out[$row->code] = $row->value;
    }
    
    return $out;
}

function get_lang_by_code($code){
    return out_field('web_lang', array('code' => 'lang_'.$code), 'value');
}

function re_captcha() {
    $ci = & get_instance();
    $ci->load->helper('recaptcha');
    // Get a key from https://www.google.com/recaptcha/admin/create
    $publickey = "6LdcEc0SAAAAADmSHkLqTYjcQqbxRp8daAtWlYFP";

    # the error code from reCAPTCHA, if any
    $error = null;

    # was there a reCAPTCHA response?

    return recaptcha_get_html($publickey, $error);
}

function cek_captcha() {
    $ci = & get_instance();
    $ci->load->helper('recaptcha');
    $privatekey = "6LdcEc0SAAAAAIaDXkUqkQD48JWR4u7HzRFPsVe7";
    # the response from reCAPTCHA
    $resp = null;
    if ($ci->input->post("recaptcha_response_field")) {
        $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
            return true;
        } else {
            return false;
        }
    }
}

function int2kal($int) {
    $abil = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan");
    $out = '';
    foreach (str_split($int) as $item) {
        $out .= $abil[$item] . ' ';
    }
    return str_replace(' ', '-', trim($out));
}

function kal2int($words) {
    $abil = array("nol" => 0, "satu" => 1, "dua" => 2, "tiga" => 3, "empat" => 4, "lima" => 5, "enam" => 6, "tujuh" => 7, "delapan" => 8, "sembilan" => 9);
    $out = '';
    $i = 0;
    foreach (explode('-', $words) as $word) {
        if (isset($abil[$word])) {
            $out .= $abil[$word];
            $i++;
        }
    }

    if($i > 0){
        return $out;
    }
    return ;
}

//function 'Y-m-d h:m:s' to unix / epoch time
function to_epochtime($data) {
    if ($data == '' or $data == '0000-00-00' or $data == '0000-00-00 00:00:00') {
        return false;
    }
    $mode = '';
    if (filter_var($data, FILTER_VALIDATE_FLOAT)) {

        return $data;
    } elseif (preg_match('[-]', $data)) {
        $data = str_replace('-', ' ', $data);
    } elseif (preg_match('[/]', $data)) {
        $data = str_replace('/', ' ', $data);
    } else {
        return false;
    }
    $set = explode(' ', $data);
    if (count($set) >= 3) {
        if (strlen($set[0]) == 4) {
            if (empty($set[3])) {
                $set[3] = '0:0:0';
            }
            $time = explode(":", $set[3]);
            $tgl = mktime($time[0], $time[1], $time[2], $set[1], $set[2], $set[0]);
            return $tgl;
        } elseif (strlen($set[2]) == 4) {
            if (empty($set[3])) {
                $set[3] = '0:0:0';
            }
            $time = explode(":", $set[3]);
            $tgl = mktime($time[0], $time[1], $time[2], $set[1], $set[0], $set[2]);
            return $tgl;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function cetak_pdf($array, $tpl, $file_name, $format = 'D', $debug = false){
    $ci =& get_instance();
    //$format = 'D'; // D I
    //$tpl = 'assets/ver_1/pdf_tpl/siska_kartu_ujian.pdf';

    //$array[] = array('posx' => 36, 'posy' => 56, 'size' => 8, 'color' => '102 102 102', 'val' => 'asdasfeaf' );

    $ci->load->library('fpdi');

    if(!file_exists($tpl)){
        exit('template not found');
    }
    $ci->fpdi->setSourceFile($tpl);
    $tplidx = $ci->fpdi->importPage(1, '/MediaBox');
    $size = $ci->fpdi->getTemplateSize($tplidx);
    $width = $size['w']; $height = $size['h'];

    if($debug){
        $i = 0;
        while($i < $width){  $array[] = array('posx' => $i, 'posy' => 95, 'size' => 6, 'val' => '|'.$i); $i = $i + 10; }
        $i = 0;
        while($i < $height){ $array[] = array('posx' => 5, 'posy' => $i, 'size' => 6, 'val' => '_'.$i); $i = $i + 10; }
    }


    $ci->fpdi->addPage();

    $ci->fpdi->useTemplate($tplidx, null, null, $width, $height, true);

    foreach($array as $key=>$item){
        if(!isset($arr[$key])){$arr[$key] = '';}
        $st = '';
        if(isset($item['style'])){$st = $item['style'];}
        $ci->fpdi->SetFont('Arial', $st, $item['size']);
        $ci->fpdi->SetXY(0, 0);
        $ci->fpdi->SetTextColor(0, 0, 0);
        if(isset($item['color'])){
            $cl = explode(' ', $item['color']);
            $ci->fpdi->SetTextColor($cl[0], $cl[1], $cl[2]);
        }

        $ci->fpdi->Text($item['posx'], $item['posy'], $item['val'].$arr[$key]);
    }


    $x = $ci->fpdi->Output($file_name, $format);
    if($format = 'S'){
        return array('str' => $x, 'name' => $file_name);
    }
}

// eof