<?php

class FileUpload extends AppModel {


    function import($filename) {
        
        $row = 1;
        $arr = array();
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
             if($row != 1){ 
                $arr[] =  array(
                    "name" =>  $data[0],
                    "email" =>  $data[1],
                );
            }
            $row++;   
              
            }

            $this->create();
            $this->saveMany($arr);
            fclose($handle);
        }
        
    }


}