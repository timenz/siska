<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function base_index(){
    return base_url().'index.php/';
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

function get_lang($lang, $tipe, $view = '', $folder = ''){
    $array = array(
        'lang' => $lang,
        'tipe' => $tipe,
    );
    
    if($view != ''){
        $array['view_filename'] = $view;
    }
    
    if($folder != ''){
        $array['view_folder'] = $folder;
    }
    $out = array();
    foreach(out_where('web_lang', $array) as $row){
        $out[$row->code] = $row->value;
    }
    
    return $out;
}

// eof