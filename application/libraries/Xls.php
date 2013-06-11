<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('PHPExcel.php');

class CI_Xls {
    
    var $array_table = array();
    var $fl = 1;
    
    function load($tpl = "") {
        if ($tpl == "")
            die('No Template Selected');
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        return $objReader->load($tpl);
    }

    function init($param = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    function load_xlsx($tpl = "") {
        if ($tpl == "")
            die('No Template Selected');
        $objReader = new PHPExcel_Reader_Excel2007();
        return $objReader->load($tpl);
    }

    function create() {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Timen Chad")
                ->setLastModifiedBy("Timen Chad")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");
        return $objPHPExcel;
    }

    function add_array($xls, $array = array()) {
        $no = 0;
        $ro = $this->fl;
        $width = array();
        $abj = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        if(count($array) < 1){return $xls;}
        
        $xls_ac = $xls->getActiveSheet();
        
        foreach($array as $items){
            $col = 1;
            if($no == 0){$ro++;}
            foreach($items as $key=>$item){
                
                $style = array(
                    'font' => array('color' => array('rgb' => '333333')),
                    'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'CCCCCC')))
                );
                $xls->getActiveSheet()->getStyle($abj[$col].$ro)->applyFromArray($style);
                
                
                if($col == 1 and $no != 0){
                    $co = $col - 1;$ri = $ro - 1;
                    $xls_ac->setCellValue($abj[$co].$ri, $no);
                    $xls->getActiveSheet()->getStyle($abj[$co].$ri)->applyFromArray($style);
                }
                
                if($no == 0){
                    $ri = $ro - 1;
                    $xls_ac->setCellValue($abj[$col].$ri, ucwords(str_replace('_', ' ', $key)));
                    $xls->getActiveSheet()->getStyle($abj[$col].$ri)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $xls->getActiveSheet()->getStyle($abj[$col].$ri)->getFill()->getStartColor()->setRGB('EEEEEE');

                    $style = array(
                        'font' => array('bold' => true, 'color' => array('rgb' => '999999')),
                        'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'DDDDDD'))),
                        
                    );
                    $xls->getActiveSheet()->getStyle($abj[$col].$ri)->applyFromArray($style);
                    if($col == 1){
                        $co = $col - 1;
                        //echo 'asdf'.$abj[$co].$ri;
                        $xls_ac->setCellValue($abj[$co].$ri, 'No');
                        $xls->getActiveSheet()->getStyle($abj[$co].$ri)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $xls->getActiveSheet()->getStyle($abj[$co].$ri)->getFill()->getStartColor()->setRGB('EEEEEE');
                        $xls->getActiveSheet()->getStyle($abj[$co].$ri)->applyFromArray($style);
                    }
                    
                }
                
                
                $xls_ac->setCellValue($abj[$col].$ro, $item);
                
                $len = strlen($item);
                if(!isset($width[$col])){
                    $width[$col] = $len;
                }else if($width[$col] < $len) {
                    $width[$col] = $len;
                }
                
                $col++;
                if($col > 25){break;}
            }
            $no++;
            $ro++;
        }
        foreach($width as $key => $w){
            if($w > 70){
                $w = 70;
            }else if($w < 10){
                $w = 10;
            }
            $w += 3;
            $xls->getActiveSheet()->getColumnDimension($abj[$key])->setWidth($w);
        }
        
        return $xls;
    }
    
    

    function save_xls($obj, $filename = 'output', $format = 'xls') {
        if ($format == 'xlsx') {
            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        } else {
            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
        }

        header('Content-Disposition: attachment;filename="' . $filename . '.' . $format . '"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
    
    function save_string($obj, $filename = 'output', $format = 'xls') {
        ob_start();
        if ($format == 'xlsx') {
            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        } else {
            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        }
        $objWriter->save('php://output');
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

}