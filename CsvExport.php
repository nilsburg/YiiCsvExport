<?php
/**
 * YiiCsvExport widget
 *
 * @author Nils van der Burg <nilsvdburg@gmail.com>
 * @version 1.0
 * @license public domain (http://unlicense.org)
 * @package extensions.yiicsvexport
 * @link 
 */

class YiiCsvExport extends CWidget{
    /**
     * @var array Data rows
     */
    public $data = [];
    /**
     * @var bool Download csv
     */
    public $download = true;
    /**
     * @var string the directory where to save the csv file
     */
    public $saveDir = "";
    /**
     * @var string the resulting filename
     */
    public $filename = "export.csv";

    /**
     * Init widget
     */
    public function init(){
        if(!$this->saveDir) $this->saveDir = Yii::app()->basePath."/runtime";
        if(!file_exists($this->saveDir)) mkdir($this->saveDir, 0777, true);
    }

    /**
     * run Widget
     */
    public function run(){
        $filename = $this->filename;        
        $fields = false;
        if($this->download){
            $fp = fopen('php://output', 'w');
            header("Content-type: application/vnd.ms-excel;charset=utf-8");
            header( 'Content-Disposition: attachment;filename='.$filename);
        }else{
            $fp = fopen($this->saveDir."/".$this->filename, 'w');
        }
        foreach($this->data as $data){
            if(!$fields){
                $fields = array_keys($data);
                fputcsv($fp, $fields, ";");
            }
            $row = array_map('utf8_decode', $data);
            fputcsv($fp, $row, ";");
        }
        fclose($fp);
    }
} 