<?php 

class FileUploaderComponent extends Component{

    public $tempFile = "";
    public $fileName = "";
    public $ext = "";
    public $allowedExtension = array("xlsx","xls","csv");
    public $message = array();
    
    
    public function initialize(Controller $controller) {
        $this->controller = $controller;
        
    }

    public function upload(){
        
        $this->tempFile =  $this->controller->request->data['FileUpload']['file']['tmp_name'];
        $this->fileName =   $this->controller->request->data['FileUpload']['file']['name'];
        $allowed = $this->checkFileExtension();

        if($this->fileName == ""){
            return array(
                "message" => "Please upload your file",
                "error" => 1,
                "file" => ""
            );
        } 


        if($allowed == false){
            return array(
                "message" =>  "only files with following extensions are allowed: csv,xls,xlsx",
                "error" => 1,
                "file" => ""
            );
        } 

        return array(
            "error" => 0,
            "file" => $this->moveFile(),
            "ext" => $this->ext
        );
      }
    
    function moveFile(){
        $file = 'files/uploaded/'.date("Ymdhis"). ".".$this->ext;
        move_uploaded_file($this->tempFile,$file);
        return $file;
    }  


    function checkFileExtension(){
       $this->ext  = end((explode(".", $this->fileName )));
       return in_array($this->ext,$this->allowedExtension);
    }


}

?>